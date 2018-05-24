<?php

namespace Draughts\Factory;

use Draughts\Client\InternationalDraughts;

/**
 * Class DraughtsFactory
 *
 * @package Draughts\Factory
 */
class DraughtsFactory
{
    /**
     * @param string $type
     *
     * @return InternationalDraughts
     * @throws \Exception
     */
    public function create(string $type)
    {
        switch ($type) {
            case InternationalDraughts::TYPE:
                return new InternationalDraughts();
            default:
                throw new \Exception(sprintf('Type %s is not supported.', $type));
        }
    }
}
