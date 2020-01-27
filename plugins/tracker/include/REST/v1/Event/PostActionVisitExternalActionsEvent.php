<?php
/**
 * Copyright (c) Enalean, 2020 - Present. All Rights Reserved.
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

namespace Tuleap\Tracker\REST\v1\Event;

use Transition_PostAction;
use Tuleap\Event\Dispatchable;
use Tuleap\Tracker\REST\v1\Workflow\PostAction\PostActionRepresentation;

class PostActionVisitExternalActionsEvent implements Dispatchable
{
    public const NAME = 'postActionVisitExternalActionsEvent';

    /**
     * @var Transition_PostAction
     */
    private $post_action;

    /**
     * @var PostActionRepresentation|null
     */
    private $representation;

    public function __construct(Transition_PostAction $post_action)
    {
        $this->post_action = $post_action;
    }

    public function getPostAction(): Transition_PostAction
    {
        return $this->post_action;
    }

    /**
     * @return PostActionRepresentation|null
     */
    public function getRepresentation(): ?PostActionRepresentation
    {
        return $this->representation;
    }

    public function setRepresentation(PostActionRepresentation $representation): void
    {
        $this->representation = $representation;
    }
}
