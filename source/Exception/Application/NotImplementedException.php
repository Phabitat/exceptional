<?php

namespace Exceptional\Exception\Application;

class NotImplementedException extends ApplicationException
{

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct('The occurred code block is not implemented and a placeholder error is currently put in place.');
    }
}