<?php

namespace Exceptional\Handler;

use Exceptional\Error\Error;

class Formatter implements FormatterInterface
{

    /**
     * Base path that will be removed from stack traces to make them more readable.
     *
     * @var string
     */
    protected $path;

    /**
     * @param string $path
     */
    function __construct($path)
    {
        isset($path) && $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPath($value)
    {
        $this->path = $value;
        return $this;
    }

    /**
     * @param Error $error
     * @return string
     */
    function format(Error $error)
    {

        // Combine message and stack trace into a more readable form with left margins.

        $margin     = '   ';
        $message    = $error->getMessage();
        $trigger    = $margin . ' → ' . $error->getTriggerFile() . ' (' . $error->getTriggerLine() . ')';
        $stackTrace = preg_replace("/\n/", "\n" . $margin, $margin . $error->getStackTraceAsString());

        isset($this->path) && $stackTrace = str_replace($this->path, '', $stackTrace);

        return $message . "\n" . $trigger . "\n" . $stackTrace;
    }
}