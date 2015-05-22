<?php
/**
 * This file is part of the Meup GeoLocation Bundle.
 *
 * (c) 1001pharmacies <http://github.com/1001pharmacies/geolocation-bundle>
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
