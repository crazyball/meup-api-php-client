<?php
/**
 * This file is part of the PHP Client for 1001 Pharmacies API.
 *
 * (c) 1001pharmacies <https://github.com/1001Pharmacies/meup-api-php-client>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
