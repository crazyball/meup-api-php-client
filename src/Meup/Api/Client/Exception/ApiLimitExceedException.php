<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Exception;

/**
 * ApiLimitExceedException.
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class ApiLimitExceedException extends RuntimeException
{
    /**
     * @param int  $limit
     * @param int  $code
     * @param null $previous
     */
    public function __construct($limit = 5000, $code = 0, $previous = null)
    {
        parent::__construct(
            sprintf('You have reached Meup\Api hour limit! Actual limit is: %s', $limit),
            $code,
            $previous
        );
    }
}
