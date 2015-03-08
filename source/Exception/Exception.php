<?php

namespace Exceptional\Exception;

use Spl\Traits\InstanceTrait;

class Exception extends \Exception
{
    use InstanceTrait;

    /**
     * @inheritdoc
     */
    public function __construct($message = null, \Exception $previous = null, $code = null)
    {
        parent::__construct($message, $code, $previous);
    }
}