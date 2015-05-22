<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Exception;

/**
 * MissingArgumentException.
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class MissingArgumentException extends ErrorException
{
    /**
     * @param string $required
     * @param int    $code
     * @param null   $previous
     */
    public function __construct($required, $code = 0, $previous = null)
    {
        if (is_string($required)) {
            $required = array($required);
        }

        parent::__construct(
            sprintf(
                'One or more of required ("%s") parameters is missing!',
                implode(
                    '", "',
                    $required
                )
            ),
            $code,
            $previous
        );
    }
}
