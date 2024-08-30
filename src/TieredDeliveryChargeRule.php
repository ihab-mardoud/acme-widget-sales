<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

class TieredDeliveryChargeRule implements DeliveryChargeRule
{
    public function __construct(private array $tiers)
    {
        // Sort tiers by threshold in descending order
        usort($this->tiers, fn($a, $b) => $b['threshold'] <=> $a['threshold']);
    }

    public function calculateCharge(float $subtotal): float
    {
        foreach ($this->tiers as $tier) {
            if ($subtotal >= $tier['threshold']) {
                return $tier['charge'];
            }
        }
        return $this->tiers[count($this->tiers) - 1]['charge']; // Default to the lowest tier
    }
}