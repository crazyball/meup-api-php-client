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
use Meup\Api\Client\Api\Product;
use Meup\Api\Client\Model\ProductIdentifierType;

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

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
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

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
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
    public function findByAcl7Test()
    {
        $expectedArray = array('acl7' => '5117623');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/acl7/5117623')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByAcl7('5117623'));
    }

    /**
     * @test
     */
    public function findByReferenceTest()
    {
        $expectedArray = array('reference' => '5117623');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/acl7/5117623')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByReference('5117623'));
    }

    /**
     * @test
     */
    public function findByAcl13Test()
    {
        $expectedArray = array('acl13' => '3401051176231');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/acl13/3401051176231')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByAcl13('3401051176231'));
    }

    /**
     * @test
     */
    public function findByExternalReferenceTest()
    {
        $expectedArray = array('external' => 'ABCDEF012345');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/external/ABCDEF012345')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->findByExternalReference('ABCDEF012345'));
    }

    /**
     * @test
     */
    public function findTest()
    {
        $expectedArray = array('reference' => '5117623');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/product/reference/5117623')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->find(ProductIdentifierType::IDENTIFIER_REF, '5117623'));
    }

    /**
     * @test
     */
    public function destockTest()
    {
        $expectedArray = json_decode('
            [
              {
                "acl13": "1234567890",
                "ean": "1234567890",
                "id": 1234567890,
                "acl7": "1234567890",
                "product_name": "xxxxxxxxx",
                "brand_name": "xxxx",
                "brand_sku": 38,
                "suggested_price": 11.54,
                "currency": "EUR",
                "price": 11.44,
                "active": false,
                "quantity": 98,
                "warn_quantity": 99
              }
            ]
        ');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('post')
            ->with('api/product/sku/1234567890/destock')
            ->will($this->returnValue($expectedArray));

        $result = $api->destock(ProductIdentifierType::IDENTIFIER_SKU, '1234567890', 5);
        $this->assertEquals($expectedArray, $result);
    }

    /**
     * @test
     */
    public function updateQuantityTest()
    {
        $expectedArray = json_decode('
            [
              {
                "acl13": "1234567890",
                "ean": "1234567890",
                "id": 1234567890,
                "acl7": "1234567890",
                "product_name": "xxxxxxxxx",
                "brand_name": "xxxx",
                "brand_sku": 38,
                "suggested_price": 11.54,
                "currency": "EUR",
                "price": 11.44,
                "active": false,
                "quantity": 98,
                "warn_quantity": 99
              }
            ]
        ');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('patch')
            ->with('api/product/sku/1234567890/quantity')
            ->will($this->returnValue($expectedArray));

        $result = $api->updateQuantity(ProductIdentifierType::IDENTIFIER_SKU, '1234567890', 5);
        $this->assertEquals($expectedArray, $result);
    }

    /**
     * @test
     */
    public function updateWarnQuantityTest()
    {
        $expectedArray = json_decode('
            [
              {
                "acl13": "1234567890",
                "ean": "1234567890",
                "id": 1234567890,
                "acl7": "1234567890",
                "product_name": "xxxxxxxxx",
                "brand_name": "xxxx",
                "brand_sku": 38,
                "suggested_price": 11.54,
                "currency": "EUR",
                "price": 11.44,
                "active": false,
                "quantity": 98,
                "warn_quantity": 99
              }
            ]
        ');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('patch')
            ->with('api/product/sku/1234567890/warnquantity')
            ->will($this->returnValue($expectedArray));

        $result = $api->updateWarningQuantity(ProductIdentifierType::IDENTIFIER_SKU, '1234567890', 5);
        $this->assertEquals($expectedArray, $result);
    }

    /**
     * @test
     */
    public function updateProductTest()
    {
        $expectedArray = json_decode('
            {
              "errors": 0,
              "success": 1,
              "parsed": 1,
              "founds": 1
            }
        ');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('put')
            ->with('api/products/update')
            ->will($this->returnValue($expectedArray));

        $result = $api->update(
            ProductIdentifierType::IDENTIFIER_SKU,
            '1234567890',
            5,
            4,
            10.20,
            true
        );
        $this->assertEquals($expectedArray, $result);
    }

    /**
     * @test
     */
    public function bulkUpdateProductTest()
    {
        $data = json_decode('
            [
              {
                "acl13": "1234567890",
                "ean": "1234567890",
                "id": 1234567890,
                "acl7": "1234567890",
                "product_name": "xxxxxxxxx",
                "brand_name": "xxxx",
                "brand_sku": 38,
                "suggested_price": 11.54,
                "currency": "EUR",
                "price": 11.44,
                "active": false,
                "quantity": 98,
                "warn_quantity": 99
              },
              {
                "acl13": "1234567890",
                "ean": "1234567890",
                "id": 1234567890,
                "acl7": "1234567890",
                "product_name": "xxxxxxxxx",
                "brand_name": "xxxx",
                "brand_sku": 38,
                "suggested_price": 11.54,
                "currency": "EUR",
                "price": 11.44,
                "active": false,
                "quantity": 98,
                "warn_quantity": 99
              }
            ]
        ');

        $expectedArray = json_decode('
            {
              "errors": 0,
              "success": 2,
              "parsed": 2,
              "founds": 2
            }
        ');

        /** @var Product|\PHPUnit_Framework_MockObject_MockObject $api */
        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('put')
            ->with('api/products/update')
            ->will($this->returnValue($expectedArray));

        $result = $api->bulkUpdate($data, Product::BULK_UPLOAD_MERGE);
        $this->assertEquals($expectedArray, $result);
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Product';
    }
}
