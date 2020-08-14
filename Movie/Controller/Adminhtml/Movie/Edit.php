<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context,\Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        /*$resultPage->setActiveMenu('Packt_HelloWorld::subscription');
        $resultPage->addBreadcrumb(__('Subscriptions'),__('Subscriptions'));
        $resultPage->addBreadcrumb(__('Manage Subscriptions'), __('Manage Subscriptions'));*/
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Movie'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_Movie::movie_movie');
    }


}