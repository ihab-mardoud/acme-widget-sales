<?php

declare(strict_types=1);

namespace Acme\WidgetSales\Tests;

use PHPUnit\Framework\TestCase;
use Acme\WidgetSales\BasketFactory;
use Acme\WidgetSales\ProductNotFoundException;
use Acme\WidgetSales\NegativePriceException;

class BasketTest extends TestCase
{
    public function testBasketTotals(): void
    {
        $testCases = [
            [['B01', 'G01'], 37.85],
            [['R01', 'R01'], 54.37],
            [['R01', 'G01'], 60.85],
            [['B01', 'B01', 'R01', 'R01', 'R01'], 98.27],
        ];

        foreach ($testCases as [$products, $expectedTotal]) {
            $basket = BasketFactory::create();
            foreach ($products as $product) {
                $basket->add($product);
            }
            $this->assertEqualsWithDelta($expectedTotal, $basket->total(), 0.01);
        }
    }

    public function testEmptyBasket(): void
    {
        $basket = BasketFactory::create();
        $this->assertEquals(0, $basket->total());
    }

    public function testInvalidProductCode(): void
    {
        $this->expectException(ProductNotFoundException::class);
        $basket = BasketFactory::create();
        $basket->add('INVALID');
    }

    public function testNegativePrice(): void
    {
        $this->expectException(NegativePriceException::class);
        new \Acme\WidgetSales\Product('NEG', 'Negative Price Product', -10.00);
    }

    public function testMultipleBuyOneGetOneHalfPriceOffers(): void
    {
        $basket = BasketFactory::create();
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEqualsWithDelta(98.85, $basket->total(), 0.01);
    }
}