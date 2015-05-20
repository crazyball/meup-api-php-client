<?php

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
        parent::__construct('You have reached Meup\Api hour limit! Actual limit is: '. $limit, $code, $previous);
    }
}
