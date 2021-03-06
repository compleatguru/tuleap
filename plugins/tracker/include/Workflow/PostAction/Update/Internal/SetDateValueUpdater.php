<?php
/**
 * Copyright (c) Enalean, 2019. All Rights Reserved.
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
 *
 */

namespace Tuleap\Tracker\Workflow\PostAction\Update\Internal;

use DataAccessQueryException;
use Transition;
use Tuleap\Tracker\Workflow\PostAction\Update\PostActionCollection;
use Tuleap\Tracker\Workflow\Transition\OrphanTransitionException;

class SetDateValueUpdater implements PostActionUpdater
{
    /**
     * @var SetDateValueRepository
     */
    private $repository;
    /**
     * @var SetDateValueValidator
     */
    private $validator;

    public function __construct(SetDateValueRepository $repository, SetDateValueValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Update (and replace) all set date value post actions with those included in given collection.
     * @throws DataAccessQueryException
     * @throws InvalidPostActionException
     * @throws OrphanTransitionException
     */
    public function updateByTransition(PostActionCollection $actions, Transition $transition): void
    {
        $actions->validateSetDateValueActions($this->validator, $transition->getWorkflow()->getTracker());
        $this->repository->deleteAllByTransition($transition);

        foreach ($actions->getSetDateValuePostActions() as $action) {
            $this->repository->create($transition, $action);
        }
    }
}
