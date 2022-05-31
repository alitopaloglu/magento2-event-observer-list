<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Plugin;

use AliTopaloglu\EventObserverLister\Helper\Data as Helper;
use Exception;
use Magento\Framework\Event\ConfigInterface;

class Manager
{
    const UNIQUE_SEPARATOR = '_';

    private Helper $helper;
    private ConfigInterface $eventConfig;

    private array $list = [];

    /**
     * @param ConfigInterface $eventConfig
     * @param Helper $helper
     */
    public function __construct(ConfigInterface $eventConfig, Helper $helper)
    {
        $this->helper = $helper;
        $this->eventConfig = $eventConfig;
    }

    public function beforeDispatch(\Magento\Framework\Event\Manager $subject, string $eventName, array $data)
    {
        try {
            $this->initList();
            $eventName = mb_strtolower($eventName);

            foreach ($this->eventConfig->getObservers($eventName) as $observerConfig) {
                $observer = [
                    'event_name' => $eventName,
                    'observer_name' => $observerConfig['name'],
                    'instance' => $observerConfig['instance'],
                    'shared' => $this->getIsShared($observerConfig),
                    'disabled' => $this->getIsDisabled($observerConfig)
                ];
                $uniqueKey = $this->getUniqueKey($observer);

                if (!$this->isExistInList($uniqueKey)) {
                    $this->addToList($uniqueKey, $observer);
                }
            }
        } catch (Exception $e) {
            $this->helper->logException($e);
        }

        return null;
    }

    private function initList(): void
    {
        if (empty($this->list)) {
            $listTableName = $this->helper->getListTable();

            $query = $this->helper->getConnection()->select()->from($listTableName);
            $list = $this->helper->getConnection()->fetchAll($query);

            if (!empty($list)) {
                foreach ($list as $observer) {
                    $uniqueKey = $this->getUniqueKey($observer);
                    $this->list[$uniqueKey] = $observer;
                }
            }
        }
    }

    private function getUniqueKey($observer): string
    {
        return $observer['event_name'] . self::UNIQUE_SEPARATOR . $observer['observer_name'];
    }

    private function isExistInList($uniqueKey): bool
    {
        return array_key_exists($uniqueKey, $this->list);
    }

    private function getIsShared($observerConfig): bool
    {
        if (array_key_exists('shared', $observerConfig) && $observerConfig['shared'] === false) {
            return false;
        }

        return true;
    }

    private function getIsDisabled($observerConfig): bool
    {
        if (array_key_exists('disabled', $observerConfig) && $observerConfig['disabled'] === true) {
            return true;
        }

        return false;
    }

    private function addToList(string $uniqueKey, array $metaData)
    {
        $this->helper->getConnection()->insert($this->helper->getListTable(), $metaData);
        $this->list[$uniqueKey] = $metaData;
    }
}
