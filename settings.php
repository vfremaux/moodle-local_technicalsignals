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

if ($hassiteconfig) {
    $label = get_string('pluginname', 'local_technicalsignals');
    $settings = new admin_settingpage('localtechnicalsignals', $label, 'local/technicalsignals:manage');

    $ADMIN->add('localplugins', $settings);

    $key = 'adminmessage';
    $label = get_string('configadminmessage', 'local_technicalsignals');
    $desc = get_string('configadminmessage_desc', 'local_technicalsignals');
    $settings->add(new admin_setting_configtext($key, $label, $desc, '', PARAM_TEXT));

    $key = 'adminmessagecolor';
    $coloropts['0'] = get_string('hide', 'local_technicalsignals');
    $coloropts['#FD6060'] = get_string('red', 'local_technicalsignals');
    $coloropts['#FBC962'] = get_string('orange', 'local_technicalsignals');
    $coloropts['#F5FD60'] = get_string('yellow', 'local_technicalsignals');
    $coloropts['#72FF5E'] = get_string('green', 'local_technicalsignals');
    $coloropts['#5EE2FF'] = get_string('blue', 'local_technicalsignals');
    $label = get_string('configadminmessagecolor', 'local_technicalsignals');
    $settings->add(new admin_setting_configselect($key, $label, '', '#FD6060', $coloropts));

    $key = 'adminmessageholdtime';
    $holdtimeopts = array();
    $holdtimeopts[0] = get_string('always', 'local_technicalsignals');
    $holdtimeopts[time() + HOURSECS] = get_string('onehour', 'local_technicalsignals');
    $holdtimeopts[time() + HOURSECS * 12] = get_string('twelvehours', 'local_technicalsignals');
    $holdtimeopts[time() + DAYSECS] = get_string('oneday', 'local_technicalsignals');
    $holdtimeopts[time() + DAYSECS * 3] = get_string('threedays', 'local_technicalsignals');
    $label = get_string('configadminmessageholdtime', 'local_technicalsignals');
    $desc = '';
    $default = 'always';
    $settings->add(new admin_setting_configselect($key, $label, $desc, $default, $holdtimeopts));

    // This is an acceptable heuristic of which is the leader of a VMoodle network.
    if (@$CFG->vmasterdbname == $CFG->dbname) {
        $key = 'globaladminmessage';
        $label = get_string('configglobaladminmessage', 'local_technicalsignals');
        $desc = get_string('configadminmessage_desc', 'local_technicalsignals');
        $default = '';
        $settings->add(new admin_setting_configtext($key, $label, $desc, $default, PARAM_TEXT));

        $key = 'globaladminmessagecolor';
        $label = get_string('configglobaladminmessagecolor', 'local_technicalsignals');
        $desc = '';
        $default = '#fd6060';
        $settings->add(new admin_setting_configselect($key, $label, $desc, $default, $coloropts));

        $key = 'globaladminmessageholdtime';
        $label = get_string('configglobaladminmessageholdtime', 'local_technicalsignals');
        $desc = '';
        $default = 'always';
        $settings->add(new admin_setting_configselect($key, $label, $desc, $default, $holdtimeopts));
    }

    $key = 'inframessagelocation';
    $label = get_string('configinframessagelocation', 'local_technicalsignals');
    $desc = get_string('configinframessagelocation_desc', 'local_technicalsignals');
    $default = '/var/www/moodle_infra.txt';
    $settings->add(new admin_setting_configtext($key, $label, $desc, $default, PARAM_TEXT));
}
