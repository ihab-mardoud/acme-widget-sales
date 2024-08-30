<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

class Product
{
    public function __construct(
        private string $code,
        private string $name,
        private float $price
    ) {
        if ($price < 0) {
            throw new NegativePriceException("Price cannot be negative for product {$code}");
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}