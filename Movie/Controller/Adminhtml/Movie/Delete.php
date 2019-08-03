<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

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
            $moviedelete = $objectManager->create('Magenest\Movie\Model\Movie')->load($id);
            $moviedelete->delete();
        }
        elseif(isset($_POST['excluded']))
        {
            $sql = "DELETE FROM magenest_movie";
            $connection->query($sql);
        }
        else
        {
            foreach ($_POST['selected'] as $item)
            {
                $moviedelete = $objectManager->create('Magenest\Movie\Model\Movie')->load($item);
                $moviedelete->delete();
            }
        }

        $this->messageManager->addSuccess(__('Successfully deleted the item.'));
        $objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

        $this->_redirect('*/*/');

    }
}