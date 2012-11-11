<?php
/**
 * Enrise RestfulApi  (http://enrise.com/)
 *
 * @link      https://github.com/Enrise/EnriseRestfulApi for the canonical source repository
 * @copyright Copyright (c) 2012 Dolf Schimmel - Freeaqingme (dolfschimmel@gmail.com)
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license   New BSD License, see LICENSE.MD
 */

namespace Enrise\RestfulApi\Stdlib;

/**
 * @category   Glitch
 * @package    Glitch_Stdlib
 */
class SubstringSearcher
{

    public static function searchArray($array, $value, $directOnly = true, $separator = '\\')
    {
        $value .= $separator;
        $length = strlen($value);
        $filtered = array();
        array_walk($array, function ($value, $key) use (&$filtered, $value, $directOnly, $length, $separator)
        {
            if (substr($key, 0, $length) != $value) {
                return;
            }

            $strrpos = strrpos($key, $separator);
            if (!$directOnly || !$strrpos  || $strrpos <= $length-1) {
                $filtered[$key] = $value;
            }
        });

        return array_keys($filtered);
    }
}
