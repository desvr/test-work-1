<?php

declare(strict_types=1);

namespace Shop;

use Shop\Strategy\Contracts\StrategyHandlerInterface;
use Shop\Strategy\Contracts\StrategyManagerInterface;

final class Shop
{
    /**
     * @var Item[]
     */
    private $items;

    /**
     * @var StrategyManagerInterface
     */
    private $strategyManager;

    /**
     * @var
     */
    private $strategyHandler;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function setStrategyManager(StrategyManagerInterface $strategyManager)
    {
        $this->strategyManager = $strategyManager;
    }

    public function setStrategyHandler(StrategyHandlerInterface $strategyHandler)
    {
        $this->strategyHandler = $strategyHandler;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            try {
                $strategyItem = $this->strategyManager::getStrategy($item->name);
                $this->strategyHandler->setStrategy($strategyItem);
                $this->strategyHandler->handle($item);
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage() . PHP_EOL;
            }
        }
    }
}
