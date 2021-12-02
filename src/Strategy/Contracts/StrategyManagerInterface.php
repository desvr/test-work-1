<?php

namespace Shop\Strategy\Contracts;

use Shop\Strategy\Strategies\BaseItemStrategy;

interface StrategyManagerInterface
{
    /**
     * @param  string  $itemName
     * @return BaseItemStrategy
     */
    public static function getStrategy(string $itemName): BaseItemStrategy;
}