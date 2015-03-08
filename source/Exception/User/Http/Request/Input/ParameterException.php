<?php

namespace Exceptional\Exception\User\Http\Request\Input;

class ParameterException extends InputException
{
    /**
     * @inheritdoc
     */
    public static function composeMessage($param = null)
    {
        return isset($param)
            ? sprintf('The specified %s is not valid.', $param)
            : 'One of the specified parameters is not valid.';
    }

    /**
     * @param string $param
     * @param string $message
     */
    public function __construct($param = null, $message = null)
    {
        parent::__construct(isset($message) ? $message : self::composeMessage($param));
    }
}