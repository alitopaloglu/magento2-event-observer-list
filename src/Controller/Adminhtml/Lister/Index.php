<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Controller\Adminhtml\Lister;

use AliTopaloglu\EventObserverLister\Controller\Adminhtml\AbstractList;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends AbstractList
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPage;
    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return Page
     */
    public function execute(): Page
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AliTopaloglu_EventObserverLister::event_observer_lister_list');
        $resultPage->addBreadcrumb(__('AliTopaloglu'), __('AliTopaloglu'));
        $resultPage->addBreadcrumb(__('Event Observer List'), __('Event Observer List'));
        $resultPage->getConfig()->getTitle()->prepend(__('Event Observer List'));

        return $resultPage;
    }
}
