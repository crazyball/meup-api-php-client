<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client;

/**
 * Class Api
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class Api
{
    const ORDERS = 'order';
    const PRODUCTS = 'product';
    const REASONS = 'reason';
    const BRANDS = 'brand';

    public static function all()
    {
        return array(
            self::ORDERS,
            self::PRODUCTS,
            self::REASONS,
            self::BRANDS
        );
    }
}
