<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

class Basket
{
    private array $items = [];

    public function __construct(
        private array $catalogue,
        private DeliveryChargeRule $deliveryChargeRule,
        private array $offers
    ) {}

    public function add(string $productCode): void
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new ProductNotFoundException("Product code '$productCode' not found in catalogue.");
        }

        $this->items[] = $this->catalogue[$productCode];
    }

    public function total(): float
    {
        if (empty($this->items)) {
            return 0.0;
        }

        $subtotal = array_sum(array_map(fn($item) => $item->getPrice(), $this->items));
        
        $discount = array_sum(array_map(fn($offer) => $offer->apply($this->items), $this->offers));
        
        $totalBeforeDelivery = $subtotal - $discount;
        
        $deliveryCharge = $this->deliveryChargeRule->calculateCharge($totalBeforeDelivery);
        
        return max(0, $totalBeforeDelivery + $deliveryCharge);
    }
}