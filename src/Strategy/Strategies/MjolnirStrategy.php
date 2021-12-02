<?php

namespace Shop\Strategy\Strategies;

use Shop\Item;

class MjolnirStrategy extends BaseItemStrategy
{
    const QUALITY_MAX = 80;

    /**
     * @param  Item  $item
     */
    public function handle(Item $item): void {
        if ($item->quality != static::QUALITY_MAX)
            $item->quality = static::QUALITY_MAX;
    }
}