<?php
/**
 * Copyright (c) Enalean, 2019-Present. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Tuleap\Taskboard\Tracker;

use Tracker;

final class TrackerPresenter
{
    /** @var int */
    public $id;
    /** @var bool */
    public $can_update_mapped_field;
    /** @var int|null  */
    public $title_field_id;

    public function __construct(TaskboardTracker $tracker, bool $can_update_mapped_field, ?int $title_field_id)
    {
        $this->id                      = $tracker->getTrackerId();
        $this->can_update_mapped_field = $can_update_mapped_field;
        $this->title_field_id          = $title_field_id;
    }
}
