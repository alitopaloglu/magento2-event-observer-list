<?php

namespace AliTopaloglu\EventObserverLister\Model\ResourceModel\Lister;

use Magento\Framework\ObjectManagerInterface;

class CollectionFactory
{
    /**
     * @var ObjectManagerInterface
     */
    protected ObjectManagerInterface $_objectManager;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    /**
     * Create new country model
     *
     * @param array $arguments
     * @return Collection
     */
    public function create(array $arguments = []): Collection
    {
        return $this->_objectManager->create(Collection::class, $arguments);
    }
}
