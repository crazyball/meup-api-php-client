<?php

namespace Meup\Api\Client\Api;

/**
 * Brand API
 *
 * @link   http://developers.1001pharmacies.com/docs/v1/brands.html
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Brand extends AbstractApi
{
    /**
     * Get Brands list
     *
     * @link http://developers.1001pharmacies.com/docs/v1/brands.html#tocAnchor-1-3-1
     *
     * @return null|array sav reasons
     */
    public function all()
    {
        return $this->get('api/brands');
    }

    /**
     * Get Brand Products list
     *
     * @link http://developers.1001pharmacies.com/docs/v1/brands.html#tocAnchor-1-3-2
     *
     * @param string $brandId
     *
     * @return array|null sav reasons
     */
    public function getProducts($brandId)
    {
        return $this->get(sprintf('api/brands/%s/products/', $brandId));
    }
}
