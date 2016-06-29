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

use Meup\Api\Client\Model\ProductType;

/**
 * Product API
 *
 * @link   http://developers.1001pharmacies.com/docs/v1/products.html
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Product extends AbstractApi
{
    const BULK_UPLOAD_MERGE   = 'merge';
    const BULK_UPLOAD_REPLACE = 'replace';

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
        return $this->find(ProductType::IDENTIFIER_SKU, $sku);
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
        return $this->find(ProductType::IDENTIFIER_EAN, $ean);
    }

    /**
     * Get Product by it's acl7
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $acl7 product acl7
     *
     * @return array|null products
     */
    public function findByAcl7($acl7)
    {
        return $this->find(ProductType::IDENTIFIER_ACL7, $acl7);
    }

    /**
     * Get Product by it's reference
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $reference product reference
     *
     * @deprecated reference now called acl7
     *
     * @return array|null products
     */
    public function findByReference($reference)
    {
        return $this->findByAcl7($reference);
    }

    /**
     * Get Product by it's acl13
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $acl13 product acl13
     *
     * @return array|null products
     */
    public function findByAcl13($acl13)
    {
        return $this->find(ProductType::IDENTIFIER_ACL13, $acl13);
    }

    /**
     * Get Product by it's external reference
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $externalReference product external (partner) reference
     *
     * @return array|null products
     */
    public function findByExternalReference($externalReference)
    {
        return $this->find(ProductType::IDENTIFIER_EXTERNAL, $externalReference);
    }

    /**
     * Find a product by it's given identifier
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-3
     *
     * @param string $identifierType   (see: self::PRODUCT_ID_TYPE_*)
     * @param string $identifier       Product id
     *
     * @return array|null products
     */
    public function find($identifierType, $identifier)
    {
        return $this->get(sprintf('%s/product/%s/%s', self::BASE_API_PATH, $identifierType, $identifier));
    }

    /**
     * Destock a quantity for given product
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-5
     *
     * @param string $identifierType   (@see: Meup\Api\Client\Model\ProductType)
     * @param string $identifier       Product id
     * @param int    $quantity         Quantity to destock
     *
     * @return array|null products
     */
    public function destock($identifierType, $identifier, $quantity)
    {
        return $this
            ->post(
                sprintf('%s/product/%s/%s/destock', self::BASE_API_PATH, $identifierType, $identifier),
                array(
                    'quantity' => $quantity
                ),
                array(
                    'Content-Type' => 'application/json'
                )
            )
        ;
    }

    /**
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-6
     *
     * @param string $identifierType   (@see: Meup\Api\Client\Model\ProductType)
     * @param string $identifier       Product id
     * @param int    $quantity         Product stock to set
     *
     * @return array|null products
     */
    public function updateQuantity($identifierType, $identifier, $quantity)
    {
        return $this
            ->patch(
                sprintf('%s/product/%s/%s/quantity', self::BASE_API_PATH, $identifierType, $identifier),
                array(
                    'quantity' => $quantity
                ),
                array(
                    'Content-Type' => 'application/json'
                )
            )
        ;
    }

    /**
     *
     * @link http://developers.1001pharmacies.com/docs/v1/products.html#tocAnchor-1-1-7
     *
     * @param string $identifierType   (@see: Meup\Api\Client\Model\ProductType)
     * @param string $identifier       Product id
     * @param int    $warnQuantity     Warning quantity for stock alerts
     *
     * @return array|null products
     */
    public function updateWarningQuantity($identifierType, $identifier, $warnQuantity)
    {
        return $this
            ->patch(
                sprintf('%s/product/%s/%s/warnquantity', self::BASE_API_PATH, $identifierType, $identifier),
                array(
                    'warn_quantity' => $warnQuantity
                ),
                array(
                    'Content-Type' => 'application/json'
                )
            )
        ;
    }

    /**
     * Update a specific product
     *
     * @param string $identifierType    (@see: Meup\Api\Client\Model\ProductType)
     * @param string $identifier        Product id
     * @param int    $quantity          Product stock
     * @param int    $warnQuantity      Warning quantity for stock alerts
     * @param string $price             Product price
     * @param float  $active            Is product active on 1001Pharmacies ?
     *
     * @return array|null               Product update result
     */
    public function update(
        $identifierType,
        $identifier,
        $quantity = null,
        $warnQuantity = null,
        $price = null,
        $active = null
    ) {
        $data = array();
        $data[$identifierType] = $identifier;
        if (!is_null($quantity)) {
            $data['quantity'] = $quantity;
        }
        if (!is_null($warnQuantity)) {
            $data['warn_quantity'] = $warnQuantity;
        }
        if (!is_null($price)) {
            $data['price'] = $price;
        }
        if (!is_null($active)) {
            $data['active'] = $active;
        }

        return $this
            ->put(
                sprintf('%s/products/update', self::BASE_API_PATH),
                array($data),
                array(
                    'Content-Type' => 'application/json'
                )
            )
        ;
    }

    /**
     * Bulk update a list of products inventory (see documentation for data parameters)
     *
     * @description :
     *
     * ```JSON
     *  [
     *      {
     *      "ean": "xxx",
     *      "reference": "xxx",
     *      "sku": "xxx",
     *      "price": "xxx.xx",
     *      "active": true|false,
     *      "quantity": xxx,
     *      "warn_quantity": xxx
     *      },
     *      ...
     *  ]
     * ```
     *
     * You have to specify at least one product identifier (ean / reference / sku).
     * /!\ Ean or References may correspond to more than one product, so update will be on each product.
     *
     * @param array  $products      List of products inventory
     * @param string $updateType    Fusion type for bulk update (see: self::BULK_UPLOAD_*)
     *
     * @return array|null       Product update result
     */
    public function bulkUpdate(array $products, $updateType = self::BULK_UPLOAD_MERGE)
    {
        return $this
            ->put(
                sprintf(
                    '%s/products/update%s',
                    self::BASE_API_PATH,
                    ($updateType == self::BULK_UPLOAD_REPLACE ? '?type=' . self::BULK_UPLOAD_REPLACE : null)
                ),
                $products,
                array(
                    'Content-Type' => 'application/json'
                )
            )
        ;
    }
}
