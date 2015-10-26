<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   local_technicalsignals
 * @copyright 2008 Valery Fremaux (valery.fremaux@gmail.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * this will preinstall some "safe to transmit" configuration keys through the datatransfer interface
 */
function xmldb_local_technicalsignals_install() {
    global $CFG;

    $safekeys = explode(',', @$CFG->dataexchangesafekeys);

    if (!in_array('globaladminmessage', $safekeys)) {
        $safekeys[] = 'globaladminmessage';
        $safekeys[] = 'globaladminmessagecolor';
    }

    set_config('dataexchangesafekeys', implode(',', $safekeys));

    return true;
}