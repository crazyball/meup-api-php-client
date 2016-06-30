<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Tests\Api;

use Meup\Api\Client\Api\Order;

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
    public function findAllTest()
    {
        $expectedArray = array('complete_invoice_number' => '1234567890');

        /** @var Order|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('api/orders')
            ->willReturn($expectedArray);

        $this->assertEquals($expectedArray, $api->all());
    }

    /**
     * @test
     */
    public function findOrderTest()
    {
        $expectedArray = array('complete_invoice_number' => '1234567890');

        /** @var Order|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('api/orders/1234567890')
            ->willReturn($expectedArray);

        $this->assertEquals($expectedArray, $api->find('1234567890'));
    }

    /**
     * @test
     */
    public function generateParcelLabelTest()
    {
        $expectedArray = array(
            'uri' => 'http://www.1001pharmacies.com/etiquette/'
                    .'1234567890?token=115ff9df6a7904df8c5493649eeae4323fb0ead0&store=26'
        );

        /** @var Order|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('api/orders/1234567890/parcellabel')
            ->willReturn($expectedArray);

        $this->assertEquals($expectedArray, $api->parcellabel('1234567890'));
    }

    /**
     * @test
     */
    public function expediateOrderTest()
    {
        $expectedArray = array(
            'uri' => 'http://www.1001pharmacies.com/etiquette/'
                    .'/etiquette/1234567890?token=115ff9df6a7904df8c5493649eeae4323fb0ead0&store=26'
        );

        /** @var Order|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('api/orders/1234567890/expediate')
            ->willReturn($expectedArray);

        $this->assertEquals($expectedArray, $api->expediate('1234567890'));
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Order';
    }
}
