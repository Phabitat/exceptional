<?php

namespace Exceptional\Error;

use Exceptional\Utility\ErrorUtility;

/**
 * Error class performs similar function to standard PHP <code>Exception</code> class. Major difference between the two
 * is that a thrown exception stops the execution of the code, whereas error doesn't. This allows us to internally
 * report and log them without affecting the user's workflow.
 */
class Error
{

    /**
     * Error string identificator.
     *
     * @var string
     */
    protected $identificator;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $stackTrace;

    /**
     * File which triggered this error.
     *
     * @var string
     */
    protected $triggerFile;

    /**
     * Line which triggered this error.
     *
     * @var int
     */
    protected $triggerLine;

    /**
     * @var string
     */
    protected $type;

    /**
     * @inheritdoc
     */
    function __construct()
    {
        $this->processStackTrace(debug_backtrace());
    }

    /**
     * @return string
     */
    public function getIdentificator()
    {
        return $this->identificator;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getStackTrace()
    {
        return $this->stackTrace;
    }

    public function getStackTraceAsString()
    {
        return ErrorUtility::getStackTraceAsString($this->stackTrace);
    }

    /**
     * @return string
     */
    public function getTriggerFile()
    {
        return $this->triggerFile;
    }

    /**
     * @return int
     */
    public function getTriggerLine()
    {
        return $this->triggerLine;
    }

    /**
     * Filters out last elements from the specified stack trace with the current error instance – we don't need extra
     * details about the trace linking back to internal calls.
     *
     * @param array $stackTrace
     */
    protected function processStackTrace(array $stackTrace)
    {
        $triggerFile = null;
        $triggerLine = null;

        while (isset($stackTrace[0]['object']) && $stackTrace[0]['object'] === $this) {
            $triggerFile = isset($stackTrace[0]['file']) ? $stackTrace[0]['file'] : null;
            $triggerLine = isset($stackTrace[0]['line']) ? $stackTrace[0]['line'] : null;
            array_shift($stackTrace);
        }

        $this->triggerFile = $triggerFile;
        $this->triggerLine = $triggerLine;
        $this->stackTrace  = $stackTrace;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return sprintf('%s (%s): %s', $this->triggerFile, $this->triggerLine, $this->message);
    }
}