<?php
namespace Badge\BadgeLabel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Block\Product\View\Gallery;
use Magento\Framework\View\Element\Template;

class CmsPageList extends Template implements ArgumentInterface
{
    protected $_registry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        return $this->_registry->registry('current_product');
    }
}
