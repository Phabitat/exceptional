<?php

namespace Exceptional\Handler;

use Exceptional\Error\Error;
use Exceptional\Logging\LoggerInterface;
use Spl\Traits\InstanceTrait;

class Handler
{
    use InstanceTrait;

    /**
     * All handled errors.
     *
     * @var Error[]
     */
    protected $errors = [];

    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     * @param FormatterInterface $formatter
     */
    function __construct(LoggerInterface $logger = null, FormatterInterface $formatter = null)
    {
        isset($logger) && $this->logger = $logger;
        isset($formatter) && $this->formatter = $formatter;
    }

    /**
     * @return Error[]
     */
    public function getErrors()
    {
        return array_values($this->errors);
    }

    /**
     * @return FormatterInterface
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param FormatterInterface $value
     * @return $this
     */
    public function setFormatter(FormatterInterface $value = null)
    {
        $this->formatter = $value;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $value
     * @return $this
     */
    public function setLogger(LoggerInterface $value = null)
    {
        $this->logger = $value;
        return $this;
    }

    /**
     * @return Error
     */
    public function getLastError()
    {
        return empty($this->errors) ? null : end($this->errors);
    }

    /**
     * Handles the specified error, this is the entry point where the error handling starts.
     *
     * @param Error $error
     * @return $this
     */
    public function handle(Error $error)
    {
        if (isset($this->errors[$hash = spl_object_hash($error)])) {
            return $this;
        } elseif (($error = $this->filter($error)) === null) {
            return $this;
        }

        $this->errors[$hash] = $error;
        $this->process($error);

        return $this;
    }

    /**
     * Filters the error before processing it.
     *
     * @param Error $error
     * @return Error
     */
    protected function filter(Error $error)
    {
        return $error;
    }

    /**
     * Processes the error.
     *
     * @param Error $error
     * @return $this
     */
    protected function process(Error $error)
    {
        isset($this->logger, $this->formatter) && $this->logger->logError($this->formatter->format($error));
        return $this;
    }
}
