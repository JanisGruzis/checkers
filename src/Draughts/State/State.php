<?php

namespace Draughts\State;

/**
 * Class State
 *
 * @package Draughts\State
 */
class State
{
    /**
     * B (black) or W (white)
     *
     * @var string
     */
    protected $turn;

    /**
     * @var array
     */
    protected $positions = [
        'W' => [],
        'B' => [],
    ];

    /**
     * @var array
     */
    protected $kings = [];

    /**
     * State constructor.
     *
     * @param string $fen
     */
    public function __construct(string $fen)
    {
        $this->setFen($fen);
    }

    /**
     * @return string
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @return array
     */
    public function getWhitePositions()
    {
        return $this->positions['W'];
    }

    /**
     * @return array
     */
    public function getBlackPositions()
    {
        return $this->positions['B'];
    }

    /**
     * @return array
     */
    public function getKings()
    {
        return $this->kings;
    }

    /**
     * @param string $fen
     *
     * @throws \Exception
     */
    public function setFen(string $fen)
    {
        $fen = trim(strtoupper($fen));
        preg_match('/("(?<G1>.*)"|\'(?<G2>.*)\')/', $fen, $matches);
        $content = $matches['G1'] ?? $matches['G2'] ?? null;

        if (!$content) {
            throw new \Exception('FEN content not found.');
        }

        if (!in_array($content[0], ['W', 'B'])) {
            throw new \Exception('FEN turn not found.');
        }

        $this->turn = $content[0];
        $content = substr($content, 1, strlen($content) - 1);
        $contents = [];

        preg_match('/W(?<group>((K{0,1}\d+\,)*(K{0,1}\d+)|(K{0,1}\d+)| *))/', $content, $matches);
        $contents['W'] = $matches['group'] ?? null;

        if (empty($matches[0])) {
            throw new \Exception('FEN white content not found.');
        }

        preg_match('/B(?<group>((K{0,1}\d+\,)*(K{0,1}\d+)|(K{0,1}\d+)| *))/', $content, $matches);
        $contents['B'] = $matches['group'] ?? null;

        if (empty($matches[0])) {
            throw new \Exception('FEN black content not found.');
        }

        foreach ($contents as $color => $content) {
            if (empty($content)) {
                continue;
            }

            $positions = explode(',', $content);

            foreach ($positions as $pos) {
                $pos = trim($pos);

                if ($pos[0] === 'K') {
                    $pos = intval(substr($pos, 1, strlen($pos) - 1));
                    $this->kings[$pos] = true;
                }

                $pos = intval($pos);
                $this->positions[$color][] = $pos;
            }
        }
    }

    /**
     * @return string
     */
    public function getFen()
    {
        $kings = $this->getKings();

        $fen = '[FEN "'.$this->getTurn().":W";
        $whitePositionParts = [];
        $whitePositions = $this->getWhitePositions();
        sort($whitePositions);

        foreach ($whitePositions as $position) {
            $whitePositionParts[] = (($kings[$position] ?? null) ? 'K' : '').$position;
        }

        $fen .= implode(',', $whitePositionParts).':B';
        $blackPositionParts = [];
        $blackPositions = $this->getBlackPositions();
        sort($blackPositions);

        foreach ($blackPositions as $position) {
            $blackPositionParts[] = (($kings[$position] ?? null) ? 'K' : '').$position;
        }

        $fen .= implode(',', $blackPositionParts).'"]';

        return $fen;
    }
}
