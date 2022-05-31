<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Block\Adminhtml\Lister;

use AliTopaloglu\EventObserverLister\Model\ResourceModel\Lister\CollectionFactory as ListerFactory;
use Exception;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\Exception\FileSystemException;

class Grid extends Extended
{
    protected ListerFactory $listerFactory;
    private Yesno $yesno;

    /**
     * @param Context $context
     * @param Data $backendHelper
     * @param ListerFactory $listerFactory
     * @param Yesno $yesno
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        Data $backendHelper,
        ListerFactory $listerFactory,
        Yesno $yesno,
        array $data = []
    ) {
        $this->listerFactory = $listerFactory;
        $this->yesno = $yesno;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     * @throws FileSystemException
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection(): Grid
    {
        $collection = $this->listerFactory->create();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @throws Exception
     */
    protected function _prepareColumns(): Grid
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

        $this->addColumn(
            'event_name',
            [
                'header' => __('Event Name'),
                'index' => 'event_name',
            ]
        );

        $this->addColumn(
            'observer_name',
            [
                'header' => __('Observer Name'),
                'index' => 'observer_name',
            ]
        );

        $this->addColumn(
            'instance',
            [
                'header' => __('Instance'),
                'index' => 'instance',
            ]
        );

        $this->addColumn(
            'shared',
            [
                'header' => __('Shared'),
                'index' => 'shared',
                'type' => 'options',
                'options' => $this->yesno->toArray()
            ]
        );

        $this->addColumn(
            'disabled',
            [
                'header' => __('Disabled'),
                'index' => 'disabled',
                'type' => 'options',
                'options' => $this->yesno->toArray()
            ]
        );

        //$this->addExportType($this->getUrl('marketplace/*/exportCsv', ['_current' => true]), __('CSV'));
        //$this->addExportType($this->getUrl('marketplace/*/exportExcel', ['_current' => true]), __('Excel XML'));

        return parent::_prepareColumns();
    }
}
