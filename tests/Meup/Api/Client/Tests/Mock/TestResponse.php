<?php

namespace Meup\Api\Client\Tests\Mock;

use Guzzle\Http\Message\Response;

/**
 * Class TestResponse
 */
class TestResponse extends Response
{
    protected $totalPages;
    protected $currentPage;
    protected $content;

    /**
     * @param string $totalPages
     * @param array  $content
     */
    public function __construct($totalPages, array $content = array())
    {
        parent::__construct(200, array(), $content);
        $this->totalPages  = $totalPages;
        $this->currentPage = 1;
        $this->content     = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function getBody($asString = false)
    {
        if ($this->currentPage > $this->totalPages) {
            return null;
        }

        if ($this->currentPage < $this->totalPages) {
            $this->content['_links']['next'] =
                array('href' => 'http://api.1001pharmacies.com/orders/?page='.($this->currentPage+1));
        } else {
            unset($this->content['_links']['next']);
        }

        if ($this->currentPage > 1) {
            $this->content['_links']['previous'] =
                array('href' => 'http://api.1001pharmacies.com/orders/?page='.($this->currentPage-1));
        } else {
            unset($this->content['_links']['previous']);
        }

        $this->currentPage++;
        return json_encode($this->content);
    }

    /**
     * @param null $header
     *
     * @return null|string
     */
    public function getHeader($header = null)
    {
        return $this->getHeader($header);
    }
}
