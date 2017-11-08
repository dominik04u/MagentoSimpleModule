<?php
/**
 * Created by PhpStorm.
 * User: dominik.adamski
 * Date: 27.10.2017
 * Time: 09:07
 */

namespace Form\Post\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

/**
 * Class InstallSchema
 * @package Form\Post\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable("customer_example_post");
        if ($setup->getConnection()->isTableExists($tableName) != true) {
            $table = $setup->getConnection()->newTable($tableName)
                ->addColumn(
                    'post_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )
                ->addColumn(
                    'firstname',
                    Table::TYPE_TEXT,
                    50,
                    ['nullable' => false],
                    'First Name'
                )
                ->addColumn(
                    'lastname',
                    Table::TYPE_TEXT,
                    50,
                    ['nullable' => false],
                    'Last Name'
                )
                ->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post Content'
                )
                ->addColumn(
                    'sent_at',
                    Table::TYPE_DATETIME,
                    null,
                    [],
                    'Sent At'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true],
                    'Customer ID'
                )->addIndex(
                    $setup->getIdxName('customer_example_post',
                        array('customer_entity')),
                    ['customer_id']
                )
                ->addForeignKey(
                    $setup->getFkName('customer_example_post',
                        'customer_id',
                        'customer_entity',
                        'entity_id'),
                    'customer_id',
                    $setup->getTable('customer_entity'),
                    'entity_id',
                    Table::ACTION_SET_NULL
                )
                ->setComment('Customer Example Post')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}