<?php

namespace Draughts\State;

use PHPUnit\Framework\TestCase;

/**
 * Class StateTest
 *
 * @package Draughts\State
 */
class StateTest extends TestCase
{
    /**
     * @param mixed $fan
     * @param mixed $turn
     * @param mixed $kings
     * @param mixed $whitePositions
     * @param mixed $blackPositions
     *
     * @dataProvider dataProviderSetFan
     */
    public function testSetFan($fan, $turn, $kings, $whitePositions, $blackPositions)
    {
        $state = new State($fan);
        $this->assertEquals($turn, $state->getTurn());
        $this->assertEquals($kings, $state->getKings());
        $this->assertEquals($whitePositions, $state->getWhitePositions());
        $this->assertEquals($blackPositions, $state->getBlackPositions());
    }

    /**
     * @return array
     */
    public function dataProviderSetFan()
    {
        return [
            ['[FEN "B:W1,2,3,4:B5,6,7,K8"]', 'B', [8 => true], [1, 2, 3, 4], [5, 6, 7, 8]],
            ['[FEN "B:WK1,K2,K3:BK6,K7,K8"]', 'B', [1 => true, 2 => true, 3 => true, 6 => true, 7 => true, 8 => true], [1, 2, 3], [6, 7, 8]],
            ['[FEN "W:W1,2,3,4:B5,6,7,K8"]', 'W', [8 => true], [1, 2, 3, 4], [5, 6, 7, 8]],
            ['[FEN "B:W:B5,6,7,K8"]', 'B', [8 => true], [], [5, 6, 7, 8]],
            ['[FEN "B:W1,2,3,4:B"]', 'B', [], [1, 2, 3, 4], []],
            ['[FEN "B:W:B"]', 'B', [], [], []],
        ];
    }
}
