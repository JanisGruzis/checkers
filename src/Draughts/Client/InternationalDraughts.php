<?php

namespace Draughts\Client;

/**
 * Class InternationalDraughts
 *
 * @package Draughts\Client
 */
class InternationalDraughts extends AbstractDraughts
{
    const TYPE = 20;

    /**
     * @return int
     */
    public static function getType()
    {
        return self::TYPE;
    }
}
