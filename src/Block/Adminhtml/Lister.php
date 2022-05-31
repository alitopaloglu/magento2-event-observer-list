<?php

declare(strict_types=1);

namespace AliTopaloglu\EventObserverLister\Block\Adminhtml;

use AliTopaloglu\EventObserverLister\Block\Adminhtml\Lister\Grid;
use Magento\Backend\Block\Widget\Container;
use Magento\Framework\Exception\LocalizedException;

class Lister extends Container
{
    /**
     * @var string
     */
    protected $_template = 'lister.phtml';

    /**
     * Prepare button and grid
     *
     * @return Lister
     * @throws LocalizedException
     */
    protected function _prepareLayout(): Lister
    {
        $this->setChild('grid', $this->getLayout()->createBlock(Grid::class, 'eventobserverlister_lister_grid'));
        return parent::_prepareLayout();
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml(): string
    {
        return $this->getChildHtml('grid');
    }
}
