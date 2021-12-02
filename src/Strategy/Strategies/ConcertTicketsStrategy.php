<?php

namespace Shop\Strategy\Strategies;

use Shop\Item;

class ConcertTicketsStrategy extends BaseItemStrategy
{
    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void {
        $factorQualityStep = 1;
        if ($item->sell_in > 5 && $item->sell_in <= 10) {
            $factorQualityStep = 2;
        } elseif ($item->sell_in > 0 && $item->sell_in <= 5) {
            $factorQualityStep = 3;
        }

        $item->sell_in = $this->decreaseSell($item->sell_in);

        $item->quality = ($this->checkSellExpired($item->sell_in))
            ? static::QUALITY_MIN
            : $this->calculateQuality($item->quality, static::ADD_ACTION, $factorQualityStep);
    }
}