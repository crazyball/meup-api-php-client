<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Api;

/**
 * Product API
 *
 * @link   http://developers.1001pharmacies.com/docs/v1/products.html
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Product extends AbstractApi
{
    /**
     * Get Product by it's unique id
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $sku product unique id
     *
     * @return array|null products
     */
    public function findBySku($sku)
    {
        return $this->get('api/product/sku/' . $sku);
    }

    /**
     * Get Product by it's ean
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $ean product ean code
     *
     * @return array|null products
     */
    public function findByEan($ean)
    {
        return $this->get('api/product/ean/' . $ean);
    }

    /**
     * Get Product by it's reference
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $reference product reference
     *
     * @return array|null products
     */
    public function findByReference($reference)
    {
        return $this->get('api/product/reference/' . $reference);
    }
}
