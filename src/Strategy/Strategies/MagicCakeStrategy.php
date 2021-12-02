<?php

namespace Shop\Strategy\Strategies;

class MagicCakeStrategy extends BaseItemStrategy
{
    const QUALITY_STEP = parent::QUALITY_STEP * 2;
}