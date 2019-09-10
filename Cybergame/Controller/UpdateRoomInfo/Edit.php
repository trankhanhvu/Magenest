<?php
namespace Magenest\Cybergame\Controller\UpdateRoomInfo;

class Edit extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
