<?php
/*
This file is part of SeAT

Copyright (C) 2015  Leon Jacobs

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

namespace Seat\Eveapi\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CharacterAssetList
 * @package Seat\Eveapi\Models
 */
class CharacterAssetList extends Model
{

    /**
     * @var array
     */
    protected $filliable = [
        'characterID', 'itemID', 'locationID', 'typeID', 'quantity', 'flag',
        'singleton', 'rawQuantity'
    ];

    /**
     * Returns the contents of an asset item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {

        return $this->hasMany(
            'Seat\Eveapi\Models\CharacterAssetListContents', 'itemID', 'itemID');
    }
}