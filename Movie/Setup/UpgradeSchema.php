<?php
namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '2.0.3') < 0) {
            $installer->getConnection()
                ->addIndex(
                    'magenest_movie',
                    'name',
                    [
                        'name'   // filed or column name
                    ],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT //type of index
                );

            $installer->getConnection()
                ->addIndex(
                    'magenest_movie',
                    'description',
                    [
                        'description'   // filed or column name
                    ],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT //type of index
                );

        }
        $installer->endSetup();
    }
}