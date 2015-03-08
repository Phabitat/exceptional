<?php

namespace Exceptional\Error\Constant;

use Spl\Constant\AbstractConstant;

/**
 * @codeCoverageIgnore
 */
final class Type extends AbstractConstant
{

    /**
     * Exceptions caused by the application – this is the default exception type.
     */
    const APPLICATION = 'application';

    /**
     * Exceptions created by invalid user input, including invalid request methods, invalid form data, etc.
     */
    const REQUEST = 'request';

}