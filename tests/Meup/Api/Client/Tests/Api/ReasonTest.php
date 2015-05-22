<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Tests\Api;

/**
 * Class ReasonTest
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class ReasonTest extends TestCase
{
    /**
     * @test
     */
    public function getAllReasonsTest()
    {
        $expectedArray = array('page' => '1');

        $api = $this->getApiMock();
        $api
            ->expects($this->once())
            ->method('get')
            ->with('api/sav/reasons')
            ->will($this->returnValue($expectedArray));

        $this->assertEquals($expectedArray, $api->all());
    }

    protected function getApiClass()
    {
        return 'Meup\Api\Client\Api\Reason';
    }
}
