<?php

namespace Exceptional\Exception\User\Http\Request;

class FormatException extends RequestException
{

    /**
     * @inheritdoc
     */
    public function __construct($message = null, \Exception $previous = null, $code = null)
    {
        isset($message) || $message = 'Cannot provide response in the specified format.';
        parent::__construct($message, $code, $previous);
    }
}