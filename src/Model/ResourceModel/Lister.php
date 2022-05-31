<?php
namespace AliTopaloglu\EventObserverLister\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Lister extends AbstractDb
{
    const LIST_TABLE = 'alitopaloglu_event_observer_lister';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::LIST_TABLE, 'entity_id');
    }
}
