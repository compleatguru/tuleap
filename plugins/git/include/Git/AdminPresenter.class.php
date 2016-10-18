<?php
/**
 * Copyright (c) Enalean, 2012 - 2016. All Rights Reserved.
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

class Git_AdminPresenter {

    public $title;

    public $csrf_input;

    public $manage_gerrit           = false;
    public $manage_mirrors          = false;
    public $manage_gitolite_config  = false;
    public $manage_general_settings = false;

    public $mirrors_active          = '';
    public $general_settings_active = '';
    public $gerrit_active           = '';
    public $gitolite_config_active  = '';

    public function __construct($title, CSRFSynchronizerToken $csrf) {
        $this->title      = $title;
        $this->csrf_input = $csrf->fetchHTMLInput();
    }

    public function gerrit_tab_name() {
        return $GLOBALS['Language']->getText('plugin_git','gerrit_tab_name');
    }

    public function general_settings_tab_name() {
        return $GLOBALS['Language']->getText('plugin_git','general_settings_tab_name');
    }

    public function mirror_tab_name() {
        return $GLOBALS['Language']->getText('plugin_git','mirror_tab_name');
    }

    public function gitolite_config_tab_name() {
        return $GLOBALS['Language']->getText('plugin_git','gitolite_config_tab_name');
    }
}
