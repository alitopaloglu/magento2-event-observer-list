<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const LIST_TABLE = 'alitopaloglu_event_observer_lister';

    public function getListTable(): string
    {
        return self::LIST_TABLE;
    }
}
