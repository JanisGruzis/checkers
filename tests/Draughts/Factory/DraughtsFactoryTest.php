<?php

namespace Tests\Draughts\Factory;

use Draughts\Client\InternationalDraughts;
use Draughts\Factory\DraughtsFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class DraughtsFactoryTest
 *
 * @package Tests\Draughts\Factory
 */
class DraughtsFactoryTest extends TestCase
{
    /**
     * testCreate
     */
    public function testCreate()
    {
        $factory = new DraughtsFactory();

        $this->assertInstanceOf(InternationalDraughts::class, $factory->create(InternationalDraughts::getType()));
    }

    /**
     * @expectedException \Exception
     */
    public function testCreateException()
    {
        $factory = new DraughtsFactory();

        $this->assertInstanceOf(InternationalDraughts::class, $factory->create('nonExistantType'));
    }
}
