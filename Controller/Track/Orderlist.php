<?php
namespace Razecode\Trackorder\Controller\Track;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
class Orderlist extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    
	protected $_request;

    protected $_coreRegistry;

	public function __construct(
		Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry)
	{
        $this->_pageFactory = $pageFactory;
        $this->_request = $context->getRequest();
        $this->_coreRegistry = $coreRegistry;
		return parent::__construct($context);
	}

	public function execute()
	{
        $this->_coreRegistry->register('order_detail', $this->_request->getParams());
        return $this->_pageFactory->create();
    }
}