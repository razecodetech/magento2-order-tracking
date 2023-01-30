<?php
namespace Razecode\TrackOrder\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollection;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;
use Magento\Sales\Model\ResourceModel\Order\Address\CollectionFactory as OrderAddressCollection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Catalog\Helper\ImageFactory;

class Track extends \Magento\Framework\View\Element\Template
{
    protected $orderItem;

    protected $_coreRegistry;

    protected $_orderCollectionFactory;

    protected $orderRepository;

    protected $_productCollectionFactory;

    protected $_addressCollection;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProductFactory $productFactory,
        ProductCollection $productCollectionFactory, 
        OrderCollection $orderCollectionFactory,
        OrderRepositoryInterface $orderRepository,
        OrderAddressCollection $addressCollection,
        ImageFactory $imageHelperFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_productFactory = $productFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_orderRepository = $orderRepository;
        $this->_addressCollection = $addressCollection;
        $this->_imageHelperFactory = $imageHelperFactory;
        parent::__construct($context, $data);
    }
 
    /* Load Order data by order_id */
    public function getOrderData()
    {
        $orderdetail = $this->_coreRegistry->registry('order_detail');
        $order_inc_id = $orderdetail['orderid'];
        $collection = $this->_orderCollectionFactory->create()
        ->addAttributeToSelect('*')
        ->addFieldToFilter('increment_id',
            ['eq' => $order_inc_id]
        ); 
        
        $order = $collection->getData();
        if(empty($order)){
            return 0;
        }
        try {
            $orderitem = $this->_orderRepository->get($order[0]['entity_id']);
        } catch (NoSuchEntityException $e) {
            throw new LocalizedException(__('This order no longer exists.'));
        }
        return $orderitem;
    }
    public function getOrderByData()
    {
        $orderdetail = $this->_coreRegistry->registry('order_detail');
        $findby = $orderdetail['findby'];
        $contact = $orderdetail['contact'];
        if($findby == "customer_email"){
            $collection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addFieldToFilter($findby,
                 ['eq' => $contact]
            )
            ->setOrder('entity_id','DESC')
            ->setPageSize(20); 
            
            $order = $collection->getData();
        }else{
            $address = $this->_addressCollection->create()
            ->addAttributeToSelect('parent_id')
            ->addFieldToFilter('telephone',['like' => '%'.$contact.'%'])
            ->distinct(true)
            ->setOrder('entity_id','DESC')
            ->setPageSize(20)
            ->getData();
            foreach($address as $id){
                $orderid[] = $id['parent_id'];
            }

            $collection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('entity_id',
                 ['in' => $orderid]
            )
            ->setOrder('entity_id','DESC')
            ->setPageSize(20);
            
            $order = $collection->getData();
        }
        
        if(empty($order)){
            return 0;
        }
        return $order;
    }

    public function getProductById($productId)
	{
		return $this->_productCollectionFactory->create()->load($productId);
	}

    public function getProductImage($productId)
    {
        $product = $this->_productFactory->create()->load($productId);
        return $this->_imageHelperFactory->create()->init($product, 'product_thumbnail_image')->getUrl();
    }
}
