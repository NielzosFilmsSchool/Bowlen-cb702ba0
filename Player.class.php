<?php

class Speler
{
    private $_score = 0;
    private $_lastTwoThrows;
    private $_name;

    function __construct($name)
    {
        $this->_name = $name;
    }

    function getName()
    {
        return $this->_name;
    }

    function setScore($value)
    {
        $this->_score = $value;
    }

    function getScore()
    {
        return $this->_score;
    }

    function setLastTwoThrows($throws)
    {
        $this->_lastTwoThrows = $throws;
    }

    function getLastTwoThrows()
    {
        return $this->_lastTwoThrows;
    }
}