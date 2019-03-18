<?php
namespace Badge\BadgeLabel\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
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
            'badge_label',
            [
                'type' => 'text',
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend', //модель magento для multiselect аттрибута. Если ее не указать, то аттрибут появится в админке, но значение этого аттрибута не будет сохраняться.
                'source' => 'Badge\BadgeLabel\Model\Entity\Attribute\Source\AllowedBadgeLabels',//модель в кастомном модуле, в которой указаны значения. Удобство в том, что значения можно изменить после того как отработает код создания аттрибута.
                'label' => 'Badge Label',
                'input' => 'multiselect',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false
            ]
        );


        $setup->endSetup();
    }
}