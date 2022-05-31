<?php

namespace AliTopaloglu\EventObserverLister\Model\ResourceModel\Lister;

use AliTopaloglu\EventObserverLister\Model\ResourceModel\Lister;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AliTopaloglu\EventObserverLister\Model\Lister::class, Lister::class);
    }
}
