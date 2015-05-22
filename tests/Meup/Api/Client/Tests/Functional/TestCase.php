<?php

namespace Meup\Api\Client\Tests\Functional;

use Meup\Api\Client\HttpClient\HttpClient;
use Meup\Api\Client\MeupApiClient;
use Meup\Api\Client\Exception\ApiLimitExceedException;
use Meup\Api\Client\Exception\RuntimeException;

/**
 * @group functional
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        // You have to specify authentication here to run full suite
        $client = new MeupApiClient(
            '1_meuptech',
            'meuptech',
            'latest'
        );

        try {
            $order = $client->api('order')->find('14-12-0026-0173');
        } catch (ApiLimitExceedException $e) {
            $this->markTestSkipped('API limit reached. Skipping to prevent unnecessary failure.');
        } catch (RuntimeException $e) {
            if ('Requires authentication' == $e->getMessage()) {
                $this->markTestSkipped('Test requires authentication. Skipping to prevent unnecessary failure.');
            }
        }

        $this->client = $client;
    }
}