<?php

namespace Meup\Api\Client\Tests\Api;

/**
 * Class OrderTest
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class OrderTest extends TestCase
{
    /**
     * @test
     */
    public function findOrderTest()
    {
        $expectedArray = array('complete_invoice_number' => '1234567890');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('api/orders/1234567890')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->find('1234567890'));
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Order';
    }
}
