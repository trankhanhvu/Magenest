<?php

namespace Magenest\LocationSelect\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * @param Config $eavConfig
     * @param EavSetupFactory $eavSetupFactory
     * @param AttributeSetFactory $attributeSetFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->eavConfig            = $eavConfig;
        $this->_eavSetupFactory     = $eavSetupFactory;
        $this->attributeSetFactory  = $attributeSetFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'city_id', [
            'type' => 'int',
            'input' => 'text',
            'label' => 'City ID',
            'visible' => false,
            'required' => false,
            'user_defined' => false,
            'system'=> false,
            'group'=> 'General',
            'global' => true,
            'visible_on_front' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'district_id', [
            'type' => 'int',
            'input' => 'text',
            'label' => 'District ID',
            'visible' => false,
            'required' => false,
            'user_defined' => false,
            'system'=> false,
            'group'=> 'General',
            'global' => true,
            'visible_on_front' => false,
        ]);

        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'ward_id', [
            'type' => 'int',
            'input' => 'text',
            'label' => 'Ward ID',
            'visible' => false,
            'required' => false,
            'user_defined' => false,
            'system'=> false,
            'group'=> 'General',
            'global' => true,
            'visible_on_front' => false,
        ]);
        $setup->endSetup();
    }
}