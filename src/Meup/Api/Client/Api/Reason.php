<?php

namespace Meup\Api\Client\Api;

/**
 * Reason API
 *
 * @link   http://developers.1001pharmacies.com/docs/v1/tickets.html
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Reason extends AbstractApi
{
    /**
     * Get Sav Reason list
     *
     * @link http://developers.1001pharmacies.com/docs/v1/tickets.html#tocAnchor-1-3-1
     *
     * @return null|array sav reasons
     */
    public function all()
    {
        return $this->get('api/sav/reasons/');
    }
}
