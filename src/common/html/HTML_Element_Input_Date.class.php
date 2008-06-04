<?php
/*
 * Copyright (c) Xerox, 2008. All Rights Reserved.
 *
 * Originally written by Nicolas Terray, 2008. Xerox Codex Team.
 *
 * This file is a part of CodeX.
 *
 * CodeX is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * CodeX is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CodeX; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

require_once('HTML_Element_Input_Text.class.php');

/**
 * Define a html input date field, with the calendar widget
 */
class HTML_Element_Input_Date extends HTML_Element_Input_Text {
    public function  __construct($label, $name, $value, $desc="") {
        //provide a readable date
        $value = ($value != 0 ? date("Y-m-d",$value) : '');
        
        parent::__construct($label, $name, $value, 10, $desc);
        $this->params['maxlength'] = 10;
    }
    
    public function renderValue() {
        $html = parent::renderValue();
        $today = date('Y-m-d', date('now'));
        $timeval  = ($today ? 'null' : "document.edit_chart_form['".$this->name."'].value");
        $html .= '<a href="javascript:show_calendar(\'document.'. 'edit_chart_form' .'[\\\''.$this->name.'\\\']\','.$timeval.',\''.util_get_css_theme().'\',\''.util_get_dir_image_theme().'\');">'.
            '<img src="'.util_get_image_theme("calendar/cal.png").'" width="16" height="16" border="0" alt="'.$GLOBALS['Language']->getText('plugin_graphontrackers_gantt_prop','pick_date').'"></a>';
        return $html;
    }
}

?>
