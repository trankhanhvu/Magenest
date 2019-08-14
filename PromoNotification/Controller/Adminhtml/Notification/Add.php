<?php

namespace Magenest\PromoNotification\Controller\Adminhtml\Notification;

use Magento\Backend\App\Action;

class Add extends \Magento\Backend\App\Action
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
        $this->_setActiveMenu('Magenest_PromoNotification::notification_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('New Notification'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_PromoNotification::all_notification');
    }
}