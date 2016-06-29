<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Api;

use Meup\Api\Client\Utils\HttpRequestParametersBuilder;

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
        return $this->get(
            sprintf(
                '%s/orders/%s',
                self::BASE_API_PATH,
                rawurlencode($identifier)
            )
        );
    }

    /**
     * Get a list of orders awaiting preparation without details.
     *
     * @link http://developers.1001pharmacies.com/docs/v1/orders.html#tocAnchor-1-3-1
     *
     * @param array $parameters
     *
     * @return array|null orders found
     */
    public function all($parameters = array())
    {
        return $this->get(
            sprintf(
                '%s/orders%s',
                self::BASE_API_PATH,
                HttpRequestParametersBuilder::buildFromArray($parameters)
            )
        );
    }

    /**
     * Generate parcel label for given order.
     *
     * @link http://developers.1001pharmacies.com/docs/v1/orders.html#tocAnchor-1-3-1
     *
     * @param string $identifier the order identifier
     *
     * @return array|null orders found
     */
    public function parcellabel($identifier)
    {
        return $this->get(
            sprintf('%s/orders/%s/parcellabel',
                self::BASE_API_PATH,
                $identifier
            )
        );
    }

    /**
     * Expediate given order
     *
     * @link http://developers.1001pharmacies.com/docs/v1/orders.html#tocAnchor-1-3-1
     *
     * @param string $identifier the order identifier
     *
     * @return array|null orders found
     */
    public function expediate($identifier)
    {
        return $this->post(
            sprintf('%s/orders/%s/expediate',
                self::BASE_API_PATH,
                $identifier
            ),
            array(),
            array(
                'Content-Type' => 'application/json'
            )
        );
    }
}
