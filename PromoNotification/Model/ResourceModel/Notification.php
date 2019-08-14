<?php
namespace Magenest\PromoNotification\Model\ResourceModel;
class Notification extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct() {
        $this->_init('promo_notification',
            'entity_id');
    }
}