<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015 to 2020 Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace Seat\Eveapi\Jobs\Corporation;

use Seat\Eveapi\Jobs\AbstractCorporationJob;
use Seat\Eveapi\Models\Corporation\CorporationMemberLimits;

/**
 * Class MembersLimit.
 * @package Seat\Eveapi\Jobs\Corporation
 */
class MembersLimit extends AbstractCorporationJob
{
    /**
     * @var string
     */
    protected $method = 'get';

    /**
     * @var string
     */
    protected $endpoint = '/corporations/{corporation_id}/members/limit/';

    /**
     * @var string
     */
    protected $version = 'v1';

    /**
     * @var string
     */
    protected $scope = 'esi-corporations.track_members.v1';

    /**
     * @var array
     */
    protected $roles = ['Director'];

    /**
     * @var array
     */
    protected $tags = ['corporation', 'members', 'limit'];

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     */
    protected function job(): void
    {
        $limit = $this->retrieve([
            'corporation_id' => $this->getCorporationId(),
        ]);

        if ($limit->isCachedLoad()) return;

        if (! property_exists($limit, 'scalar'))
            return;

        CorporationMemberLimits::firstOrNew([
            'corporation_id' => $this->getCorporationId(),
        ])->fill([
            'limit' => $limit->scalar,
        ])->save();
    }
}
