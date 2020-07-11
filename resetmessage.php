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
 * @category  local
 * @copyright 2008 Valery Fremaux (valery.fremaux@gmail.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

$returnurl = required_param('returnurl', PARAM_URL);
$global = optional_param('global', 0, PARAM_BOOL);

// Security.

require_login();
require_capability('local/technicalsignals:manage', context_system::instance());

if ($global) {
    $oldvalue = get_config('core', 'globaladminmessagecolor');
    set_config('globaladminmessagecolor', 0);
    add_to_config_log('globaladminmessagecolor', $oldvalue, '', 'moodle');
} else {
    $oldvalue = get_config('core', 'adminmessagecolor');
    set_config('adminmessagecolor', 0);
    add_to_config_log('adminmessagecolor', $oldvalue, '', 'moodle');
}

redirect($returnurl);