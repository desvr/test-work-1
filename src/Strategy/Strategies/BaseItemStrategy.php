<?php

namespace Shop\Strategy\Strategies;

use Shop\Item;

abstract class BaseItemStrategy
{
    const QUALITY_MIN = 0;
    const QUALITY_MAX = 50;
    const QUALITY_STEP = 1;
    const SELL_MIN = 0;
    const SELL_STEP = 1;

    const ADD_ACTION = '+';
    const SUB_ACTION = '-';

    /**
     * Проверка текущего срока хранения товара
     * @param  int  $currentSell
     * @return bool
     */
    protected function checkSellExpired(int $currentSell): bool {
        return $currentSell < static::SELL_MIN;
    }

    /**
     * Сокращение срока хранения товара
     * @param  int  $currentSell
     * @return int
     */
    protected function decreaseSell(int $currentSell): int {
        $sell = $currentSell - static::QUALITY_STEP;
        return $sell;
    }

    /**
     * Пересчет ценности товара
     * @param  int  $currentQuality
     * @param  string  $action
     * @param  int  $factorQualityStep
     * @return int
     */
    protected function calculateQuality(int $currentQuality, string $action, int $factorQualityStep = 1): int {
        switch ($action) {
            case '+':
                $quality = ($currentQuality < (static::QUALITY_MAX - static::QUALITY_STEP))
                    ? $currentQuality + static::QUALITY_STEP * $factorQualityStep
                    : static::QUALITY_MAX;
                break;
            case '-':
                $quality = ($currentQuality > (static::QUALITY_STEP * $factorQualityStep))
                    ? $currentQuality - static::QUALITY_STEP * $factorQualityStep
                    : static::QUALITY_MIN;
                break;
        }

        return $quality;
    }

    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void {
        $item->sell_in -= static::SELL_STEP;

        if ($item->quality > static::QUALITY_MIN) {
            $factorQualityStep = ($this->checkSellExpired($item->sell_in)) ? 2 : 1;
            $item->quality = $this->calculateQuality($item->quality, static::SUB_ACTION, $factorQualityStep);
        }
    }
}