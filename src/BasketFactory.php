<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

class BasketFactory
{
    public static function create(): Basket
    {
        $catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];

        $deliveryChargeRule = new TieredDeliveryChargeRule([
            ['threshold' => 90, 'charge' => 0],
            ['threshold' => 50, 'charge' => 2.95],
            ['threshold' => 0, 'charge' => 4.95],
        ]);

        $offers = [
            new BuyOneGetOneHalfPriceOffer('R01'),
        ];

        return new Basket($catalogue, $deliveryChargeRule, $offers);
    }
}