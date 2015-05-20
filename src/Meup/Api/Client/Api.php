<?php

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
