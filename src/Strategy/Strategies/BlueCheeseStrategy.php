<?php

namespace Shop\Strategy\Strategies;

use Shop\Item;

class BlueCheeseStrategy extends BaseItemStrategy
{
    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void {
        $item->sell_in = $this->decreaseSell($item->sell_in);

        $factorQualityStep = ($this->checkSellExpired($item->sell_in)) ? 2 : 1;
        $item->quality = $this->calculateQuality($item->quality, static::ADD_ACTION, $factorQualityStep);
    }
}