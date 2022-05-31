<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Helper;

use Exception;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Psr\Log\LoggerInterface;
use AliTopaloglu\EventObserverLister\Model\ResourceModel\Lister;

class Data extends AbstractHelper
{
    private AdapterInterface $connection;
    private LoggerInterface $logger;

    public function __construct(Context $context, ResourceConnection $resourceConnection, LoggerInterface $logger)
    {
        parent::__construct($context);
        $this->connection = $resourceConnection->getConnection();
        $this->logger = $logger;
    }

    public function getListTable(): string
    {
        return Lister::LIST_TABLE;
    }

    public function getConnection(): AdapterInterface
    {
        return $this->connection;
    }

    public function logException(Exception $e)
    {
        if ($this->isModuleReadyToWork()) {
            $this->logger->critical($e->getMessage());
        }
    }

    public function isModuleReadyToWork(): bool
    {
        $check = $this->getConnection()->fetchAll('SHOW TABLES LIKE "' . $this->getListTable() . '"');
        return !empty($check);
    }
}
