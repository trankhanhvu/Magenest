<?php
namespace Magenest\PromoNotification\Controller\Customer;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Helper\Image;
use Magento\Store\Model\StoreManager;

class NotificationOfCustomer extends \Magento\Framework\App\Action\Action
{
    protected $productFactory;
    protected $imageHelper;
    protected $listProduct;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        ProductFactory $productFactory,
        StoreManager $storeManager,
        Image $imageHelper
    )
    {
        $this->productFactory = $productFactory;
        $this->imageHelper = $imageHelper;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $customerSession = $objectManager->create('Magento\Customer\Model\Session');
            $customerID = $customerSession->getId();

            $customer = $objectManager->create('Magento\Customer\Model\Customer')->load($customerID);
            $notification_received = explode(',',$customer->getData('notification_received')) ;

            $notification_viewed = explode(',',$customer->getData('notification_viewed')) ;

            $notificationList = $objectManager->create('Magenest\PromoNotification\Model\ResourceModel\Notification\Collection')
                ->addFieldToFilter('entity_id', array('in' => $notification_received));

            foreach ($notificationList as $list)
            {
                if(in_array($list->getData('entity_id'),$notification_viewed))
                {
                    $list['viewed'] = 1 ;
                }
            }

            $returnList = [];

            foreach ($notificationList as $l)
            {
                $returnList[] = [
                    'entity_id' => $l['entity_id'],
                    'name' => $l['name'],
                    'status' => $l['status'],
                    'created_at' => $l['created_at'],
                    'short_description' => $l['short_description'],
                    'redirect_url' => $l['redirect_url'],
                    'viewed' => $l['viewed']
                ];
            }
            echo json_encode($returnList);
            return;

    }
}