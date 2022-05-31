<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class AbstractList extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'AliTopaloglu_EventObserverLister::event_observer_lister_list';
}
