<?php

namespace Exceptional\Exception\Application;

use Exceptional\Error\Constant\Type;
use Exceptional\Exception\Exception;

/**
 * Application exceptions are thrown when the application fails to function as expected due to the logic in the
 * code. Such exceptions should lead directly to a fix in the code.
 */
class ApplicationException extends Exception
{

    /**
     * @var string
     */
    protected $type = Type::APPLICATION;

}