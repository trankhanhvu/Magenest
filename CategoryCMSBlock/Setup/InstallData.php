<?php
namespace Magenest\CategoryCMSBlock\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{

    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'landing_page2',
            [
                'type'         => 'int',
                'label'        => 'CMS Block 2',
                'input'        => 'select',
                'sort_order'   => 100,
                'source'       => 'Magento\Catalog\Model\Category\Attribute\Source\Page',
                'global'       => 1,
                'visible'      => true,
                'required'     => false,
                'user_defined' => false,
                'default'      => null
            ]
        );
    }
}
