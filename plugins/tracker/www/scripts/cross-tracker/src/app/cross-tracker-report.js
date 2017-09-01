/**
 * Copyright (c) Enalean, 2017. All Rights Reserved.
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

import ExtendableError from 'extendable-error';

export default class CrossTrackerReport {
    constructor() {
        this.trackers = new Map();
    }

    addTracker(project, tracker) {
        if (this.trackers.size === 10) {
            throw new TooManyTrackersSelectedError();
        }
        if (this.trackers.has(tracker.id)) {
            throw new CannotAddTheSameTrackerTwiceError();
        }

        this.trackers.set(tracker.id, {
            project,
            tracker
        });
    }

    removeTracker(tracker_id) {
        this.trackers.delete(tracker_id);
    }

    hasTrackerWithId(tracker_id) {
        return this.trackers.has(tracker_id);
    }
}

export class TooManyTrackersSelectedError extends ExtendableError {}
export class CannotAddTheSameTrackerTwiceError extends ExtendableError {}
