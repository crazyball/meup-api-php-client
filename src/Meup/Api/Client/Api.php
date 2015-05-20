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

    public static function all()
    {
        return array(self::ORDERS);
    }
}
