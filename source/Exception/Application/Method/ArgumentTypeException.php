<?php

namespace Exceptional\Exception\Application\Method;

class ArgumentTypeException extends ArgumentException
{

    /**
     * @param string $argument
     * @param string $type
     */
    public function __construct($argument = null, $type = null)
    {
        parent::__construct('The specified argument is of a wrong type.');
        $this->isDisplayable = false;
    }
}