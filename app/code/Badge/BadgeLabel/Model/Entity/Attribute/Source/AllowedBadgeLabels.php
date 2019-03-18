<?php

namespace Badge\BadgeLabel\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class AllowedBadgeLabels extends AbstractSource
{
    public function getAllOptions()
    {
        return [
            'badge1' => [
                'label' => 'Sale',
                'value' => 'sale'
            ],
            'badge2' => [
                'label' => 'Free Shipping',
                'value' => 'free_shipping'
            ],
            'badge3' => [
                'label' => 'Best Seller',
                'value' => 'best_seller'
            ]
        ];
    }
}
