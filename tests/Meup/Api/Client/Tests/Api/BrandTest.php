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

/**
 * Class BrandTest
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class BrandTest extends TestCase
{
    /**
     * @test
     */
    public function getAllBrandsTest()
    {
        $expectedArray = array('page' => '1');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/brands')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->all());
    }
    /**
     * @test
     */
    public function getProductsByBrandTest()
    {
        $expectedArray = array('page' => '1');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/brands/0123456789/products/')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->getProducts('0123456789'));
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Brand';
    }
}
