<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client;

use Meup\Api\Client\Api\ApiInterface;
use Meup\Api\Client\HttpClient\Message\ResponseParser;

/**
 * Pager class for supporting Hateoas pagination.
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class ResultPager implements ResultPagerInterface
{
    /**
     * The 1001pharmacies Api Client to use for pagination.
     *
     * @var \Meup\Api\Client\MeupApiClient
     */
    protected $client;

    /**
     * Comes from pagination headers in Meup\Api API results.
     *
     * @var array
     */
    protected $pagination;

    /**
     * The client to use for pagination.
     *
     * This must be the same instance that you got the Api instance from.
     *
     * Example code:
     *
     * $client  = new \Meup\Api\Client\MeupApiClient();
     * $api     = $client->api('someApi');
     * $pager   = new \Meup\Api\ResultPager($client);
     *
     * @param \Meup\Api\Client\MeupApiClient $client
     */
    public function __construct(MeupApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * {@inheritdoc}
     */
    public function fetch(ApiInterface $api, $method, array $parameters = array())
    {
        $result = call_user_func_array(array($api, $method), array($parameters));
        $this->postFetch();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll(ApiInterface $api, $method, array $parameters = array())
    {
        $result = call_user_func_array(array($api, $method), array($parameters));
        $this->postFetch();

        $finalResult = $result['_embedded']['items'];
        while ($this->hasNext()) {
            $nextResult = $this->fetchNext();
            $finalResult = array_merge($finalResult, $nextResult['_embedded']['items']);
        }

        return $finalResult;
    }

    /**
     * {@inheritdoc}
     */
    public function postFetch()
    {
        $lastResponse = $this->client->getHttpClient()->getLastResponse();
        $this->pagination = ResponseParser::getPagination($lastResponse);
    }

    /**
     * {@inheritdoc}
     */
    public function hasNext()
    {
        return $this->has('next');
    }

    /**
     * {@inheritdoc}
     */
    public function fetchNext()
    {
        return $this->get('next');
    }

    /**
     * {@inheritdoc}
     */
    public function hasPrevious()
    {
        return $this->has('previous');
    }

    /**
     * {@inheritdoc}
     */
    public function fetchPrevious()
    {
        return $this->get('previous');
    }

    /**
     * {@inheritdoc}
     */
    public function fetchFirst()
    {
        return $this->get('first');
    }

    /**
     * {@inheritdoc}
     */
    public function fetchLast()
    {
        return $this->get('last');
    }

    /**
     * {@inheritdoc}
     */
    protected function has($key)
    {
        return !empty($this->pagination) && isset($this->pagination[$key]);
    }

    /**
     * {@inheritdoc}
     */
    protected function get($key)
    {
        if ($this->has($key)) {
            $result = $this->client->getHttpClient()->get($this->pagination[$key]);
            $this->postFetch();

            return ResponseParser::getContent($result);
        }

        return null;
    }
}
