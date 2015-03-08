<?php

namespace Exceptional\Handler;

use Exceptional\Error\Error;

interface FormatterInterface
{

    /**
     * @param Error $error
     * @return string
     */
    function format(Error $error);
}