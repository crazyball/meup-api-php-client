<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Model;

/**
 * Products Identifiers Availables
 *
 * @author Loïc AMBROSINI <loic@1001pharmacies.com>
 */
abstract class ProductIdentifierType
{
    const IDENTIFIER_SKU      = 'sku';
    const IDENTIFIER_EAN      = 'ean';
    const IDENTIFIER_ACL7     = 'acl7';
    const IDENTIFIER_ACL13    = 'acl13';
    const IDENTIFIER_REF      = 'reference';
    const IDENTIFIER_EXTERNAL = 'external';
}
