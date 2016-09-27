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

defined('MOODLE_EARLY_INTERNAL') || die('Early internal');

/**
 * @package   local_technicalsignals
 * @category  local
 * @copyright 2008 Valery Fremaux (valery.fremaux@gmail.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * prints an administrator message in the screen where called. 
 * usually called as first prints of the body in theme header.
 *
 * @uses configuration key globaladminmessage and globaladminmessagecolor
 * @uses configuration mainhostprefix for network extension
 */
function local_print_administrator_message($return = false) {
    global $CFG, $DB, $OUTPUT;

    $str = '';

    // protects some special scripts such as theme
    if (defined('ABORT_AFTER_CONFIG')) return '';

    // Protect against some network back calls.
    if (defined('MNET_SERVER')){
        return;
    }

    // Network admin meesage needs MNET structure to be defined.
    if (!empty($CFG->mainhostprefix) && file_exists($CFG->dirroot.'/blocks/vmoodle/plugins/generic/lib.php')){
        require_once $CFG->dirroot.'/blocks/vmoodle/plugins/generic/lib.php';

        // Get the mnet host that is considered as master.
        $sql = "
            SELECT
                mh.*
            FROM
                {mnet_host} mh,
                {mnet_application} ma
            WHERE
                mh.applicationid = ma.id AND
                deleted = 0 AND
                ma.name = 'moodle' AND
                wwwroot LIKE ?
        ";
        if (!$mainhost = $DB->get_record_sql($sql, array($CFG->mainhostprefix.'%'))) {
            // echo $OUTPUT->notification(get_string('undefinedmainhost', 'local_technicalsignals', $CFG->mainhostprefix));
        }
        if (@$mainhost->wwwroot != $CFG->wwwroot) {
            if ($text = vmoodle_get_remote_config($mainhost, 'globaladminmessage')) {
                $color = vmoodle_get_remote_config($mainhost, 'globaladminmessagecolor');
            }
        } else {
            $text = @$CFG->globaladminmessage;
            $color = @$CFG->globaladminmessagecolor;
        }
        if (!empty($text)) {
            $globalmessagestr = get_string('globalmessageprefix', 'local_technicalsignals');
            $str = '<div class="administratormessage" style="background-color:'.$color.'">'.$globalmessagestr.': '.$text.'</div>';
        }
    }

    $removediv = '';
    if (has_capability('local/technicalsignals:manage', context_system::instance())) {
        $eraseurl = new moodle_url('/local/technicalsignals/resetmessage.php', array('returnurl' => me()));
        $removediv = '<div class="administratormessageerase"><a href="'.$eraseurl.'"><input type="button" name="go_erase" value="'.get_string('remove', 'local_technicalsignals').'"></a></div>';
    }

    // Local messaging.
    if (!empty($CFG->adminmessage)) {
        $str = '<div class="administratormessage" style="background-color:'.$CFG->adminmessagecolor.'">'.$CFG->adminmessage.$removediv.'</div>';
    }

    if ($return) return $str;
    echo $str;
}
