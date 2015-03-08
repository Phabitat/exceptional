<?php

namespace Exceptional\Error;

use Exception;
use Exceptional\Error\Constant\Type;
use Exceptional\Exception\User\Http\HttpException;

class ExceptionError extends Error
{

    /**
     * @var Exception
     */
    protected $exception;

    /**
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->setException($exception);
        parent::__construct();
    }

    /**
     * @return Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $value
     * @return $this
     */
    public function setException(Exception $value = null)
    {
        $this->exception = $value;

        if (isset($value)) {
            $this->message     = $value->getMessage();
            $this->triggerFile = $value->getFile();
            $this->triggerLine = $value->getLine();
            $this->stackTrace  = $value->getTrace();
            $this->type        = $value instanceof HttpException ? Type::REQUEST : Type::APPLICATION;
        } else {
            $this->message     = null;
            $this->triggerFile = null;
            $this->triggerLine = null;
            $this->stackTrace  = null;
            $this->type        = null;
        }

        return $this;
    }
}