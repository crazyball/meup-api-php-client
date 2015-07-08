<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Meup\Api\Client\HttpClient;

use Meup\Api\Client\HttpClient\Cache\CacheInterface;
use Meup\Api\Client\HttpClient\Cache\FilesystemCache;

/**
 * Performs requests on 1001Pharmacies API using If-Modified-Since headers.
 * Returns a cached version if not modified
 * Avoids increasing the X-Rate-Limit when present.
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
class CachedHttpClient extends HttpClient
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Contains the lastResponse fetched from cache.
     *
     * @var \Guzzle\Http\Message\Response
     */
    private $lastCachedResponse;

    /**
     * Identifier used for the cache file(s).
     * $path + encoded query parameter(s) if they exist.
     *
     * @var string
     */
    private $id;

    /**
     * @return CacheInterface
     */
    public function getCache()
    {
        if (null === $this->cache) {
            $cacheDir = $this->options['cache_dir'] ?
                : sys_get_temp_dir().DIRECTORY_SEPARATOR.'meup-api-php-client-cache';
            $this->cache = new FilesystemCache($cacheDir);
        }

        return $this->cache;
    }

    /**
     * @param $cache CacheInterface
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function request(
        $path,
        $body = null,
        $httpMethod = 'GET',
        array $headers = array(),
        array $options = array()
    ) {
        $response = parent::request($path, $body, $httpMethod, $headers, $options);

        if (304 == $response->getStatusCode()) {
            $cacheResponse = $this->getCache()->get($this->id);
            $this->lastCachedResponse = $cacheResponse;

            return $cacheResponse;
        }

        $this->getCache()->set($this->id, $response);

        return $response;
    }

    /**
     * Create requests with If-Modified-Since headers.
     *
     * {@inheritdoc}
     */
    protected function createRequest(
        $httpMethod,
        $path,
        $body = null,
        array $headers = array(),
        array $options = array()
    ) {
        $request = parent::createRequest($httpMethod, $path, $body, $headers, $options);

        $this->id = $path;

        if (array_key_exists('query', $options) && !empty($options['query'])) {
            $this->id .= '?' . $request->getQuery();
        }

        if ($modifiedAt = $this->getCache()->getModifiedSince($this->id)) {
            $modifiedAt = new \DateTime('@'.$modifiedAt);
            $modifiedAt->setTimezone(new \DateTimeZone('GMT'));

            $request->addHeader(
                'If-Modified-Since',
                sprintf('%s GMT', $modifiedAt->format('l, d-M-y H:i:s'))
            );
        }
        if ($etag = $this->getCache()->getETag($this->id)) {
            $request->addHeader(
                'If-None-Match',
                $etag
            );
        }

        return $request;
    }

    /**
     * @param bool $force
     *
     * @return \Guzzle\Http\Message\Response
     */
    public function getLastResponse($force = false)
    {
        $lastResponse =  parent::getLastResponse();
        if (304 != $lastResponse->getStatusCode()) {
            $force = true;
        }

        return ($force) ? $lastResponse : $this->lastCachedResponse;
    }
}
