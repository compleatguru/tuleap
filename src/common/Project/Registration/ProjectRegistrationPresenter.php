<?php
/**
 * Copyright (c) Enalean, 2019 - present. All Rights Reserved.
 *
 *  This file is a part of Tuleap.
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

declare(strict_types = 1);

namespace Tuleap\Project\Registration;

use ForgeConfig;
use Tuleap\Project\Registration\Template\TemplatePresenter;

/**
 * @psalm-immutable
 */
class ProjectRegistrationPresenter
{
    /**
     * @var string
     */
    public $tuleap_templates;
    /**
     * @var bool
     */
    public $has_templates;
    /**
     * @var bool
     */
    public $are_restricted_users_allowed;
    /**
     * @var string
     */
    public $project_default_visibility;
    /**
     * @var bool
     */
    public $projects_must_be_approved;
    /**
     * string
     */
    public $trove_categories;

    public function __construct(string $project_default_visibility, array $trove_categories, TemplatePresenter ...$tuleap_templates)
    {
        $this->tuleap_templates             = json_encode($tuleap_templates);
        $this->has_templates                = count($tuleap_templates) > 0;
        $this->are_restricted_users_allowed = (bool) ForgeConfig::areRestrictedUsersAllowed();
        $this->project_default_visibility   = $project_default_visibility;
        $this->projects_must_be_approved    = (bool) ForgeConfig::get(\ProjectManager::CONFIG_PROJECT_APPROVAL, true);
        $this->trove_categories             = json_encode($trove_categories, JSON_THROW_ON_ERROR);
    }
}
