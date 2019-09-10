<?php

namespace Magenest\Cybergame\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //Install gamer_account_list table

        $table = $installer->getConnection()->newTable(
            $installer->getTable('gamer_account_list')
        )
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Gamer Account ID'
            )
            ->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false,'unsigned' => true],
                'Product ID'
            )
            ->addColumn(
                'account_name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Account Name'
            )
            ->addColumn(
                'password',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Password'
            )
            ->addColumn(
                'hour',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [],
                'Hour'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At')
            ->addIndex(
                $installer->getIdxName('gamer_account_list', ['product_id']),
                ['product_id']
            )
            ->addIndex(
                $installer->getIdxName('gamer_account_list', ['account_name']),
                ['account_name']
            )
            ->setComment('Gamer Account List');

        $installer->getConnection()->createTable($table);

        //Install room_extra_option table

        $table = $installer->getConnection()->newTable(
            $installer->getTable('room_extra_option')
        )
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Room ID'
            )
            ->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false,'unsigned' => true],
                'Product ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Room Name'
            )
            ->addColumn(
                'price',
                \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                null,
                [],
                'Price'
            )
            ->addColumn(
                'number_pc',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [],
                'Number PC'
            )
            ->addColumn(
                'address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'Address'
            )
            ->addColumn(
                'food_price',
                \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                null,
                [],
                'Food Price'
            )
            ->addColumn(
                'drink_price',
                \Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
                null,
                [],
                'Drink Price'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At')
            ->addIndex(
                $installer->getIdxName('room_extra_option', ['product_id']),
                ['product_id']
            )
            ->setComment('Room Extra Option');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}