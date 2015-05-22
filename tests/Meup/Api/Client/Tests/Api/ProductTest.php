<?php

namespace Meup\Api\Client\Tests\Api;

/**
 * Class ProductTest
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function findBySkuTest()
    {
        $expectedArray = array('sku' => '2059');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/sku/2059')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findBySku('2059'));
    }
    /**
     * @test
     */
    public function findByEanTest()
    {
        $expectedArray = array('ean' => '3700281702385');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/ean/3700281702385')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByEan('3700281702385'));
    }
    /**
     * @test
     */
    public function findByReferenceTest()
    {
        $expectedArray = array('reference' => '5117623');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/reference/5117623')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByReference('5117623'));
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Product';
    }
}
