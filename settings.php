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
 * Global settings.
 *
 * @package     local_technicalsignals
 * @category    blocks
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   Valery Fremaux <valery.fremaux@gmail.com> (MyLearningFactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Settings default init.

if (is_dir($CFG->dirroot.'/local/adminsettings')) {

    // Integration driven code.
    require_once($CFG->dirroot.'/local/adminsettings/lib.php');
    list($hasconfig, $hassiteconfig, $capability) = local_adminsettings_access();
} else {
    // Standard Moodle code.
    $capability = 'moodle/site:config';
    $hasconfig = $hassiteconfig = has_capability($capability, context_system::instance());
}

if ($hassiteconfig) {
    $settings = new admin_settingpage('localtechnicalsignals', get_string('pluginname', 'local_technicalsignals'), 'local/technicalsignals:manage');

    $ADMIN->add('localplugins', $settings);

    $settings->add(new admin_setting_configtext('adminmessage', get_string('adminmessage', 'local_technicalsignals'), get_string('adminmessagedesc', 'local_technicalsignals'), '', PARAM_CLEANHTML));
    $coloropts['#FD6060'] = get_string('red', 'local_technicalsignals');
    $coloropts['#FBC962'] = get_string('orange', 'local_technicalsignals');
    $coloropts['#F5FD60'] = get_string('yellow', 'local_technicalsignals');
    $coloropts['#72FF5E'] = get_string('green', 'local_technicalsignals');
    $coloropts['#5EE2FF'] = get_string('blue', 'local_technicalsignals');
    $settings->add(new admin_setting_configselect('adminmessagecolor', get_string('adminmessagecolor', 'local_technicalsignals'), '', '#FD6060', $coloropts));

    $holdtimeopts = array();
    $holdtimeopts[0] = get_string('always', 'local_technicalsignals');
    $holdtimeopts[time() + HOURSECS] = get_string('onehour', 'local_technicalsignals');
    $holdtimeopts[time() + HOURSECS * 12] = get_string('twelvehours', 'local_technicalsignals');
    $holdtimeopts[time() + DAYSECS] = get_string('oneday', 'local_technicalsignals');
    $holdtimeopts[time() + DAYSECS * 3] = get_string('threedays', 'local_technicalsignals');
    $settings->add(new admin_setting_configselect('adminmessageholdtime', get_string('adminmessageholdtime', 'local_technicalsignals'), '', 'always', $holdtimeopts));

    // This is an acceptable heuristic of which is the leader of a VMoodle network.
    if (@$CFG->vmasterdbname == $CFG->dbname) {
        $settings->add(new admin_setting_configtext('globaladminmessage', get_string('globaladminmessage', 'local_technicalsignals'), get_string('adminmessagedesc', 'local_technicalsignals'), '', PARAM_CLEANHTML));
        $settings->add(new admin_setting_configselect('globaladminmessagecolor', get_string('globaladminmessagecolor', 'local_technicalsignals'), '', '#FD6060', $coloropts));

        $settings->add(new admin_setting_configselect('globaladminmessageholdtime', get_string('globaladminmessageholdtime', 'local_technicalsignals'), '', 'always', $holdtimeopts));
    }
}
