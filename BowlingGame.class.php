<?php
require_once 'ScoreBoard.class.php';
require_once 'Player.class.php';

class BowlingGame
{
    private $_scoreboard;

    function __construct($scoreboard)
    {
        $this->_scoreboard = $scoreboard;
    }

    public function start()
    {
        for($r = 1;$r<=10;$r++){
            echo "Round: $r".PHP_EOL;
            for($p = 0;$p<$this->_scoreboard->getNumPlayers();$p++){
                $player = $this->_scoreboard->getCurrentPlayer();
                $throws;
                $pins;

                echo "It's your turn ".$player->getName().": what was your first throw?".PHP_EOL;
                $first_throw = intval(readline());
                while($first_throw > 10 || $first_throw < 0) {
                    echo "$first_throw is not a correct pin number".PHP_EOL;
                    echo "It's your turn ".$player->getName().": what was your first throw?".PHP_EOL;
                    $first_throw = intval(readline());
                }

                $second_throw = 0;
                if($first_throw != 10) {
                    echo "It's your turn ".$player->getName().": what was your second throw?".PHP_EOL;
                    $second_throw = intval(readline()); 
                    while($second_throw > 10-$first_throw || $second_throw < 0) {
                        echo "$second_throw is not a correct pin number".PHP_EOL;
                        echo "It's your turn ".$player->getName().": what was your second throw?".PHP_EOL;
                        $second_throw = intval(readline());
                    }

                    $throws = [$first_throw, $second_throw];

                    if($first_throw + $second_throw >= 10) {
                        echo "Spare!".PHP_EOL;
                    }

                    
                } else {
                    echo "Strike!".PHP_EOL;
                    $throws = [$first_throw, 0];
                    $pins = $first_throw;
                }
                $this->_scoreboard->registerPinsDown($first_throw, $second_throw);
                $player->setLastTwoThrows($throws);

                $third_throw = 0;
                if($r == 10 && $first_throw == 10) {
                    echo "It's your turn ".$player->getName().": what was your second throw?".PHP_EOL;
                    $second_throw = intval(readline()); 
                    while($second_throw > 10 || $second_throw < 0) {
                        echo "$second_throw is not a correct pin number".PHP_EOL;
                        echo "It's your turn ".$player->getName().": what was your second throw?".PHP_EOL;
                        $second_throw = intval(readline());
                    }

                    if($second_throw == 10) {
                        echo "It's your turn ".$player->getName().": what was your third throw?".PHP_EOL;
                        $third_throw = intval(readline()); 
                        while($third_throw > 10 || $third_throw < 0) {
                            echo "$third_throw is not a correct pin number".PHP_EOL;
                            echo "It's your turn ".$player->getName().": what was your third throw?".PHP_EOL;
                            $third_throw = intval(readline());
                        }
                    }
                    $this->_scoreboard->registerPinsDownLastRound($second_throw + $third_throw);
                } else if($r == 10 && $first_throw + $second_throw == 10) {
                    echo "It's your turn ".$player->getName().": what was your third throw?".PHP_EOL;
                    $third_throw = intval(readline()); 
                    while($third_throw > 10 || $third_throw < 0) {
                        echo "$third_throw is not a correct pin number".PHP_EOL;
                        echo "It's your turn ".$player->getName().": what was your third throw?".PHP_EOL;
                        $third_throw = intval(readline());
                    }

                    $this->_scoreboard->registerPinsDownLastRound($third_throw);
                }

                $this->_scoreboard->nextPlayer();
            }
            $this->_scoreboard->printStatus();
        }
    }
}
