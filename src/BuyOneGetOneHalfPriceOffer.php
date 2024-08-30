<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

class BuyOneGetOneHalfPriceOffer implements Offer
{
    public function __construct(private string $productCode)
    {}

    public function apply(array $items): float
    {
        $discount = 0;
        $eligibleItems = array_filter($items, fn($item) => $item->getCode() === $this->productCode);
        $pairCount = floor(count($eligibleItems) / 2);
        
        if ($pairCount > 0 && !empty($eligibleItems)) {
            $discount = $pairCount * ($eligibleItems[array_key_first($eligibleItems)]->getPrice() / 2);
        }

        return $discount;
    }
}