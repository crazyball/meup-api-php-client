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

use Meup\Api\Client\MeupApiClient;

/**
 * Class TestCase
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    abstract protected function getApiClass();

    protected function getApiMock()
    {
        $httpClient = $this->getMock(
            'Guzzle\Http\Client',
            array('send')
        )
        ;
        $httpClient->expects($this->any())
            ->method('send')
        ;
        $mock = $this->getMock(
            'Meup\Api\Client\HttpClient\HttpClient',
            array(),
            array(array(), $httpClient)
        )
        ;
        $client = new MeupApiClient("clientId", "clientSecret", $mock);

        return $this->getMockBuilder($this->getApiClass())
            ->setMethods(array('get', 'post', 'postRaw', 'patch', 'delete', 'put'))
            ->setConstructorArgs(array($client))
            ->getMock()
            ;
    }
}
