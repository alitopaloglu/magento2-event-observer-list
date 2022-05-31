<?php

namespace AliTopaloglu\EventObserverLister\Setup;

use AliTopaloglu\EventObserverLister\Helper\Data as Helper;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    private Helper $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @throws Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $listTableName =  $this->helper->getListTable();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            if (!$installer->tableExists($listTableName)) {
                $listTable = $installer->getConnection()
                    ->newTable($installer->getTable($listTableName))
                    ->addColumn(
                        'entity_id',
                        Table::TYPE_INTEGER,
                        10,
                        ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
                    )
                    ->addColumn('event_name', Table::TYPE_TEXT, 255, ['nullable' => false])
                    ->addColumn('observer_name', Table::TYPE_TEXT, 255, ['nullable' => false])
                    ->addColumn('instance', Table::TYPE_TEXT, 255, ['nullable' => false])
                    ->addColumn('shared', Table::TYPE_BOOLEAN, 1, ['nullable' => false, 'default' => 1])
                    ->addColumn('disabled', Table::TYPE_BOOLEAN, 1, ['nullable' => false, 'default' => 0])
                    ->addColumn(
                        'created_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                        'Created At'
                    )
                    ->addColumn(
                        'updated_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At'
                    );

                $installer->getConnection()->createTable($listTable);
            }
        }

        $installer->endSetup();
    }
}
