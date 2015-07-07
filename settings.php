<?php
defined('MOODLE_INTERNAL') || die;

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
    
    // This is an acceptable heuristic of which is the leader of a VMoodle network.
    if (@$CFG->vmasterdbname == $CFG->dbname) {
        $settings->add(new admin_setting_configtext('globaladminmessage', get_string('globaladminmessage', 'local_technicalsignals'), get_string('adminmessagedesc', 'local_technicalsignals'), '', PARAM_CLEANHTML));
        $settings->add(new admin_setting_configselect('globaladminmessagecolor', get_string('globaladminmessagecolor', 'local_technicalsignals'), '', '#FD6060', $coloropts));
    }
}
