<?php

namespace Meup\Api\Client\Api;

/**
 * Order API
 *
 * @link   http://developer.1001pharmacies.com/docs/v1/orders.html
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Order extends AbstractApi
{
    /**
     * Get Order by it's identifier (complete_invoice_number).
     *
     * @link http://developers.1001pharmacies.com/docs/v1/orders.html#tocAnchor-1-3-1
     *
     * @param string $identifier the identifier to search
     *
     * @return null|array order found
     */
    public function find($identifier)
    {
        return $this->get('api/orders/'.rawurlencode($identifier));
    }

    /**
     * Get a list of orders awaiting preparation without details.
     *
     * @link http://developers.1001pharmacies.com/docs/v1/orders.html#tocAnchor-1-3-1
     *
     * @return null|array orders found
     */
    public function all()
    {
        return $this->get('api/orders/');
    }
}
