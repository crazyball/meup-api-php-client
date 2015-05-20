<?php

namespace Meup\Api\Client\Api;

/**
 * Api interface.
 *
 * @author Loïc Ambrosini <loic@1001pharmacies.com>
 */
interface ApiInterface
{
    public function getPerPage();

    public function setPerPage($perPage);
}
