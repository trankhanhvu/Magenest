<?php

namespace Magenest\PromoNotification\Controller\Adminhtml\Notification;

use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $id = $this->getRequest()->getParam('id');

        if($id != null)
        {
            $noti = $objectManager->create('Magenest\PromoNotification\Model\Notification')->load($id);
            $noti->delete();
        }

        $this->messageManager->addSuccess(__('Successfully deleted the item.'));
        $objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

        $this->_redirect('*/*/');

    }
}