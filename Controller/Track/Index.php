<?php
namespace Razecode\TrackOrder\Controller\Track;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RedirectFactory; 
use Magento\Framework\Registry;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
	protected $_request;

    protected $_coreRegistry;

    protected $resultRedirectFactory;

	public function __construct(
		Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry,
        RedirectFactory $resultRedirectFactory)
	{
        $this->_pageFactory = $pageFactory;
        $this->_request = $context->getRequest();
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->_coreRegistry = $coreRegistry;
		return parent::__construct($context);
	}

	public function execute()
	{
        $orderid = $this->_request->getParam('orderid');
        $orderby = $this->_request->getParam('contact')?$this->_request->getParam('contact'):0;
        $this->_coreRegistry->register('order_detail', $this->_request->getParams());
        if($orderby && !$orderid){
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('trackorder/track/orderlist',$this->_request->getParams());
            return $resultRedirect;
        }
        return $this->_pageFactory->create();
    }
}
