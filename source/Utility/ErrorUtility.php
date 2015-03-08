<?php

namespace Exceptional\Utility;

use Spl\Utility\AbstractUtility;

final class ErrorUtility extends AbstractUtility
{

    /**
     * Returns the specified stack trace as a formatted string.
     *
     * @param array $stackTrace
     * @return string
     */
    public static function getStackTraceAsString(array $stackTrace)
    {
        $levelCount = sizeof($stackTrace);
        $levelPad   = strlen((string) $levelCount);
        $string     = '';

        foreach ($stackTrace as $level => $frame) {
            empty($string) || $string .= "\n";

            $string .= sprintf('#%s %s: ',
                str_pad($level + 1, $levelPad),
                isset($frame['file'], $frame['line'])
                    ? $frame['file'] . ' (' . $frame['line'] . ')'
                    : '[internal function]');

            isset($frame[$property = 'class']) && $string .= $frame[$property];
            isset($frame[$property = 'type']) && $string .= $frame[$property];

            if (isset($frame[$property = 'function'])) {
                $argsString = '';

                // Add all function arguments to the output, we cut all scalar arguments down to 50 chars… It also
                // happens that sometimes args are not set.

                foreach (isset($frame['args']) ? $frame['args'] : [] as $arg) {
                    empty($argsString) || $argsString .= ', ';

                    if (is_scalar($arg)) {
                        $isString = is_string($arg);
                        $arg      = (string) $arg;

                        $isString && $argsString .= '\'';
                        $argsString .= substr($arg, 0, 50);
                        $isString && $argsString .= strlen($arg) > 50 ? '…\'' : '\'';
                    } elseif (is_object($arg)) {
                        $argsString .= 'Object(' . get_class($arg) . ')';
                    } elseif (is_array($arg)) {
                        $argsString .= 'Array';
                    }
                }

                $string .= $frame[$property] . '(' . $argsString . ')';
            }
        }

        // Add manually the final {mail} frame.

        $string .= "\n" . '#' . str_pad($levelCount + 1, $levelPad) . ' {main}';

        return $string;
    }
} 