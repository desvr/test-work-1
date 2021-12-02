<?php

namespace Shop\Strategy;

use Shop\Item;
use Shop\Strategy\Contracts\StrategyHandlerInterface;
use Shop\Strategy\Strategies\BaseItemStrategy;

class StrategyHandler implements StrategyHandlerInterface
{
    private $strategy;

    /**
     * @param  BaseItemStrategy  $strategy
     */
    public function setStrategy(BaseItemStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void
    {
        $this->strategy->handle($item);
    }
}