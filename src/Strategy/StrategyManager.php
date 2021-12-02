<?php

namespace Shop\Strategy;

use Shop\Strategy\Contracts\StrategyManagerInterface;
use Shop\Strategy\Strategies\BaseItemStrategy;

class StrategyManager implements StrategyManagerInterface
{
    /**
     * @param  string  $itemName
     * @return BaseItemStrategy
     * @throws \Exception
     */
    public static function getStrategy(string $itemName): BaseItemStrategy {
        $strategyClass = __NAMESPACE__ . '\\Strategies\\'
            . str_replace(' ', '', ucwords($itemName . 'Strategy'));

        if (!class_exists($strategyClass))
            throw new \Exception("Класс [$strategyClass] не существует.");

        return new $strategyClass();
    }
}