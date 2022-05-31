<?php

namespace AliTopaloglu\EventObserverLister\Model;

use Magento\Framework\ObjectManagerInterface;

class ListerFactory
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
     * @return Lister
     */
    public function create(array $arguments = []): Lister
    {
        return $this->_objectManager->create(Lister::class, $arguments);
    }
}
