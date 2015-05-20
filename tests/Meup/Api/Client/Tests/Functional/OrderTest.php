<?php

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
