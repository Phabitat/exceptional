<?php

namespace Exceptional\Exception\Constant;

use Spl\Constant\AbstractConstant;

/**
 * @codeCoverageIgnore
 */
final class ExceptionCode extends AbstractConstant
{

    const BAD_REQUEST = 400;

    const NOT_FOUND = 404;

    const METHOD_NOT_ALLOWED = 405;

    const APPLICATION_ERROR = 500;

    public static function getMessages()
    {
        return [
            self::NOT_FOUND         => 'Could not locate the requested resource.',
            self::APPLICATION_ERROR => 'The server is experiencing some issues, this error has been reported and will be looked into shortly.'
        ];
    }

    public static function getMessage($code)
    {
        $messages = self::getMessages();
        return isset($messages[$code]) ? $messages[$code] : null;
    }
} 