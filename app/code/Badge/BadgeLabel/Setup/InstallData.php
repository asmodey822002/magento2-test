<?php

namespace Badge\BadgeLabel\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface
{
    private $_eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(Product::ENTITY, 'badge_label');

        $eavSetup->addAttribute(
            Product::ENTITY,
            'badge_label',//programmatic attribute name to be accessed in code
            [
                'type' => 'text',// or varchar
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend', //magento model for multiselect attribute. If you do not specify it, the attribute will appear in the admin panel, but the value of this attribute will not be saved.
                'source' => 'Badge\BadgeLabel\Model\Entity\Attribute\Source\AllowedBadgeLabels',//model in a custom module in which values ​​are specified. The convenience is that the values ​​can be changed after the attribute creation code has been completed.
                'label' => 'Badge Label',//attribute name to display on pages
                'input' => 'multiselect',//input form in admin
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,//where to show
                'visible' => true,
                'required' => true,// mandatory or not (true / false)
                'user_defined' => false,
                'searchable' => true,//is involved in the search
                'filterable' => true,//participates in filters on the left on category pages
                'comparable' => true,//availability for comparison
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,//uniqueness
            ]
        );

        $setup->endSetup();
    }
}
