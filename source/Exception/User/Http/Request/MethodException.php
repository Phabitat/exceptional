<?php

namespace Exceptional\Exception\User\Http\Request;

class MethodException extends RequestException
{

    /**
     * @param string $message
     */
    public function __construct($message = null)
    {
        parent::__construct(isset($message) ? $message : self::composeMessage());
    }

    /**
     * @inheritdoc
     */
    public static function composeMessage()
    {
        return 'The requested resource is not available via the specified method.';
    }
}