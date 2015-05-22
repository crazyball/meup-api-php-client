<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Tests\Functional;

/**
 * @group functional
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function shouldShowOrderData()
    {
        $orderId = '14-12-0026-0173';

        $order = $this->client->api('order')->find($orderId);

        $this->assertArrayHasKey('sku', $order);
    }
}
