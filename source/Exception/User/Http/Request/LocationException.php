<?php

namespace Exceptional\Exception\User\Http\Request;

class LocationException extends RequestException
{
    /**
     * @param string $resource
     * @param string $message
     */
    public function __construct($resource = null, $message = null)
    {
        parent::__construct(isset($message) ? $message : self::composeMessage($resource));
    }

    /**
     * @inheritdoc
     */
    public static function composeMessage($resource = null)
    {
        return isset($resource)
            ? sprintf('The specified %s resource was not found.', $resource)
            : 'The specified resource was not found.';
    }
}