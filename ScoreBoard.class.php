<?php

require_once 'Player.class.php';

class ScoreBoard
{
    private $_players = [];
    private $_currentPlayer = 0;

    public function addPlayer($player)
    {
        $this->_players[] = $player;
    } 

    public function getCurrentPlayer()
    {
        $player = $this->_players[$this->_currentPlayer];
        return $player;
    }

    public function nextPlayer()
    {
        $this->_currentPlayer++;
        if($this->_currentPlayer >= $this->getNumPlayers()) {
            $this->_currentPlayer = 0;
        }
    }
    
    public function getNumPlayers()
    {
        return count($this->_players);
    }

    public function registerPinsDown($firstPins, $secondPins)
    {
        $player = $this->getCurrentPlayer();
        $lastTwoThrows = $player->getLastTwoThrows();
        $tempScore = $firstPins + $secondPins;

        if($lastTwoThrows != null) {
            if(isset($lastTwoThrows[0]) && isset($lastTwoThrows[1])) {
                if($lastTwoThrows[0] == 10) {
                    $tempScore += $tempScore;
                } else if($lastTwoThrows[0] + $lastTwoThrows[1] == 10) {
                    $tempScore += $firstPins;
                }
            }
        }

        $player->setScore($player->getScore()+$tempScore);
    }
    
    public function registerPinsDownLastRound($pins)
    {
        $player = $this->getCurrentPlayer();
        $player->setScore($player->getScore()+$pins);

    }

    public function printStatus()
    {
        foreach($this->_players as $player){
            echo "Name: ".$player->getName().", Score: ".$player->getScore().PHP_EOL;
        }
    }

    public function getWinner()
    {
        $max=0;
        $final_player;
        foreach($this->_players as $player){
            if($max < (float)$player->getScore()) {
                $max = $player->getScore();
                $final_player = $player;
            }
        }
        return $final_player;
    }
}