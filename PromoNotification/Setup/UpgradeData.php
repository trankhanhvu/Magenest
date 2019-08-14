<?php
namespace Magenest\PromoNotification\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;


class UpgradeData implements UpgradeDataInterface {

    protected $customerSetupFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }


    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {

        if (version_compare($context->getVersion(), '2.0.1') < 0) {

            $setup->startSetup();
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'notification_received', [
                'type' => 'text',
                'label' => 'Notification Received',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => false,
                'sort_order' => 230,
                'position' => 230,
                'system' => false,
                'is_visible_in_grid' => false,
                'is_visible_on_front' => false
            ]);

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'notification_viewed', [
                'type' => 'text',
                'label' => 'Notification Viewed',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => false,
                'sort_order' => 230,
                'position' => 230,
                'system' => false,
                'is_visible_in_grid' => false,
                'is_visible_on_front' => false
            ]);

            $setup->endSetup();
        }
    }
}