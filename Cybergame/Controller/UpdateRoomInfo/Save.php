<?php

namespace Magenest\Cybergame\Controller\UpdateRoomInfo;

use Magento\Framework\App\Action\Context;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_request;
    protected $room;

    public function __construct(Context $context,
                                \Magento\Framework\App\RequestInterface $request,
                                \Magenest\Cybergame\Model\RoomExtraOptionFactory $room)
    {
        $this->_request = $request;
        $this->room = $room;
        parent::__construct($context);
    }

    public function execute()
    {
        $info = $this->_request->getParams();
        $roomExtra = $this->room->create()->load($info['id']);
        $roomExtra->setData('number_pc',$info['number_pc']);
        $roomExtra->setData('address',$info['address']);
        $roomExtra->setData('food_price',$info['food_price']);
        $roomExtra->setData('drink_price',$info['drink_price']);
        $roomExtra->save();

        $this->_redirect('*/*/');
    }
}