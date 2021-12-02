<?php

namespace Shop\Strategy\Contracts;

use Shop\Item;
use Shop\Strategy\Strategies\BaseItemStrategy;

interface StrategyHandlerInterface
{
    /**
     * @param  BaseItemStrategy  $strategy
     */
    public function setStrategy(BaseItemStrategy $strategy): void;

    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void;
}