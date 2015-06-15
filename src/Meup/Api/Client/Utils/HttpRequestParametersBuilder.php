<?php
/**
 * This file is part of the Sherlock Project
 *
 * (c) 1001pharmacies <http://github.com/1001pharmacies/sherlock>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Utils;

class HttpRequestParametersBuilder
{
    public static function buildFromArray($parameters = array())
    {
        $queryString = "";
        if ($parameters) {
            $queryString .= "?";
            foreach ($parameters as $param => $value) {
                $queryString .= $param . "=" . $value . "&";
            }
            $queryString = rtrim($queryString, "&");
        }
        return $queryString;
    }
}
