<?php

declare(strict_types=1);

namespace Acme\WidgetSales;

interface Offer
{
    public function apply(array $items): float;
}