<?php
/**
 * Copyright (c) Enalean, 2018-Present. All Rights Reserved.
 * Copyright (c) Xerox Corporation, Codendi Team, 2001-2009. All rights reserved
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

require_once('SanitizerTestCase.class.php');

class SimpleSanitizerTestCase extends SanitizerTestCase {
    function __construct($test_name = false) {
        parent::__construct($test_name);
    }

    function setUp() {
        trigger_error("setUp method must be implemented and must instanciate this->sanitizer");
    }
    /**
     * Test the main function of the sanitizer : sanitize()
     *
     */
    function testSanitize() {
        $bad_tag   = "<tag";
        $html      = "Lorem ipsum dolor sit amet,".$bad_tag." consectetuer adipiscing elit.";
        $result    = $this->sanitizer->sanitize($html);

        $this->assertNoPattern("/".$bad_tag."/",$result);
    }
}

//We just tells SimpleTest to always ignore this testcase
SimpleTest::ignore('SimpleSanitizerTestCase');
?>