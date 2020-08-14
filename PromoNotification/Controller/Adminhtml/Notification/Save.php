<?php

namespace Magenest\PromoNotification\Controller\Adminhtml\Notification;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $id = $this->getRequest()->getParam('entity_id');

        $name = $this->getRequest()->getParam('name');

        $status=$this->getRequest()->getParam('status');

        $short_description=$this->getRequest()->getParam('short_description');

        $redirect_url=$this->getRequest()->getParam('redirect_url');

        //edit
        if($id != null)
        {
            $noti = $objectManager->create('Magenest\PromoNotification\Model\Notification')->load($id);
            $noti->setName($name);
            $noti->setStatus($status);
            $noti->setShort_description($short_description);
            $noti->setRedirect_url($redirect_url);
            $noti->save();
        }
        //add
        else
        {
            $noti = $objectManager->create('Magenest\PromoNotification\Model\Notification');
            $noti->setName($name);
            $noti->setStatus($status);
            $noti->setShort_description($short_description);
            $noti->setRedirect_url($redirect_url);
            $noti->save();

            if($status == 1)
            {
                $parameters =['idnoti'=>$noti->getEntity_id()];
                $this->_eventManager->dispatch('save_notification', $parameters);
            }

        }


        $this->messageManager->addSuccess(__('Successfully saved the item.'));
        $objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

        $this->_redirect('*/*/');
    }
}