<?php

namespace Magenest\Cybergame\Block\RoomExtraOption;

use Magento\Framework\View\Element\Template;

class Update extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;

    protected $_request;

    public function __construct(Template\Context $context,
                                \Magento\Customer\Model\Session $session,
                                \Magento\Framework\App\RequestInterface $request,
                                array $data = [])
    {
        $this->customerSession = $session;
        $this->_request = $request;
        parent::__construct($context, $data);
    }

    public function getRoomExtraOption()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $roomExtraOption = $objectManager->create('Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\Collection');
        return $roomExtraOption;
    }

    public function checkCyberManager()
    {
        $is_manager = $this->customerSession->getCustomer()->getDataByKey('is_manager');
        return $is_manager;
    }

    public function getRoomInfo()
    {
        $id = $this->_request->getParam('id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $infor = $objectManager->create('Magenest\Cybergame\Model\RoomExtraOption')->load($id);
        return $infor;
    }
}