<?php

namespace Draughts\Client;

/**
 * Interface DraughtsInterface
 *
 * @package Draughts\Client
 */
interface DraughtsInterface
{
    /**
     * 0: Chess
     * 1: Chinese chess
     * 2-19: future chess expansion
     * 20: 10x10 draughts (international)
     * 21: English draughts (kings only move 1 step at a time)
     * 22: Italian draughts (as English, Men cannot take kings, must capture max)
     * 23: American pool draughts (as 10x10, not obliged to take max)
     * 24: Spanish pool  draughts (as 10x10 rules, but men cannot capture backwards)
     * 25: Russian draughts
     * 26: Brazilian 8x8  draughts (same as 10x10 rules)
     * 27: Canadian 12x12  draughts (same as 10x10 rules)
     * 28: Portuguese draughts
     * 29: Czech draughts
     * 30: Turkish draughts
     * 31: Thai draughts
     * 40: Frisian draughts
     * 41: Spantsiretti (Russian draughts 10x8)
     * 32-39, 42-49: Future draughts expansion
     * 50: Othello
     * 51..  Future expansion.
     *
     * @link https://en.wikipedia.org/wiki/Portable_Draughts_Notation
     *
     * @return int
     */
    public static function getType();
}
