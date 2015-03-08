<?php

namespace Exceptional\Exception\User\Http;

use Exceptional\Error\Constant\Type;
use Exceptional\Exception\User\UserException;

/**
 * Request exceptions are thrown when the user makes invalid request and the application doesn't know how to handle it
 * or doesn't allow it. Normally such exceptions are for informative purposes and should contain information how to
 * avoid it.
 */
class HttpException extends UserException
{

    /**
     * @var string
     */
    protected $type = Type::REQUEST;

}