<?php

namespace Meup\Api\Client;

/**
 * Class ApiVersions
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class ApiVersions
{
    const LATEST = 'latest';
    const V1      = '1.0';

    public static function all()
    {
        return array(self::LATEST, self::V1);
    }
}
