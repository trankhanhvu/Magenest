<?php
namespace Magenest\PromoNotification\Model\ResourceModel\Notification;
/**
 * Director Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct() {
        $this->_init('Magenest\PromoNotification\Model\Notification',
            'Magenest\PromoNotification\Model\ResourceModel\Notification');
    }
}