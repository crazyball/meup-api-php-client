<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\Tests\HttpClient\Cache;

use Guzzle\Http\Message\Response;
use Meup\Api\Client\HttpClient\Cache\FilesystemCache;

/**
 * Class FilesystemCacheTest
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class FilesystemCacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldStoreAResponseForAGivenKey()
    {
        $cache = new FilesystemCache('/tmp/github-api-test');

        $cache->set('test', new Response(200));

        $this->assertNotNull($cache->get('test'));
    }

    /**
     * @test
     */
    public function shouldGetATimestampForExistingFile()
    {
        $cache = new FilesystemCache('/tmp/github-api-test');

        $cache->set('test', new Response(200));

        $this->assertInternalType('int', $cache->getModifiedSince('test'));
    }

    /**
     * @test
     */
    public function shouldNotGetATimestampForInexistingFile()
    {
        $cache = new FilesystemCache('/tmp/meup-api-php-client-cache');

        $this->assertNull($cache->getModifiedSince('test2'));
    }
}
