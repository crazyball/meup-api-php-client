<?php

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
        $result = call_user_func_array(array($api, $method), $parameters);
        $this->postFetch();

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchAll(ApiInterface $api, $method, array $parameters = array())
    {
        // get the perPage from the api
        $perPage = $api->getPerPage();

        // set parameters per_page to 1001Pharmacies max to minimize number of requests
        $api->setPerPage(100);

        $result = call_user_func_array(array($api, $method), $parameters);
        $this->postFetch();

        while ($this->hasNext()) {
            $result = array_merge($result, $this->fetchNext());
        }

        // restore the perPage
        $api->setPerPage($perPage);

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function postFetch()
    {
        $this->pagination = ResponseParser::getPagination($this->client->getHttpClient()->getLastResponse());
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
        return $this->has('prev');
    }

    /**
     * {@inheritdoc}
     */
    public function fetchPrevious()
    {
        return $this->get('prev');
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
