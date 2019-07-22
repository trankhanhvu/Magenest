<?php

namespace Magenest\Movie\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //Install Director table
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_director')
        )
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Director ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Director Name'
            )
            ->setComment('Director Table');

        $installer->getConnection()->createTable($table);


        //Install Actor table
        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_actor')
        )
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Actor ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Actor Name'
            )
            ->setComment('Actor Table');

        $installer->getConnection()->createTable($table);


        //Install magenest_movie table

        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie')
        )
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'Movie ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Movie Name'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable => false'],
                'Description'
            )
            ->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Rating'
            )
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false,'unsigned' => true],
                'Director ID'
            )
            ->addForeignKey(
                $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                'director_id',
                $installer->getTable('magenest_director'),
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Movie Table');

        $installer->getConnection()->createTable($table);


        //Install magenest_movie_actor table

        $table = $installer->getConnection()->newTable(
            $installer->getTable('magenest_movie_actor')
        )
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [

                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Movie ID'
            )
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [

                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Actor ID'
            )
            ->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'movie_id',
                $installer->getTable('magenest_movie'),
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'actor_id',
                $installer->getTable('magenest_actor'),
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Actor Table');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}