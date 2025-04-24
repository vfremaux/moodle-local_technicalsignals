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
// This is a bit more complex security resolution for script that may be called before setup.php.
if (!defined('MOODLE_EARLY_INTERNAL')) {
    defined('MOODLE_INTERNAL') || die();
}

/**
 * This function is not implemented in this plugin, but is needed to mark
 * the vf documentation custom volume availability.
 */
function local_technicalsignals_supports_feature() {
    assert(1);
}

/**
 * prints an administrator message in the screen where called.
 * usually called as first prints of the body in theme header.
 *
 * @uses configuration key globaladminmessage and globaladminmessagecolor
 * @uses configuration mainhostprefix for network extension
 */
function local_print_administrator_message() {
    global $CFG, $DB, $OUTPUT, $PAGE;

    $colors['red'] = '#fd6060';
    $colors['orange'] = '#fBc962';
    $colors['yellow'] = '#f5fd60';
    $colors['green'] = '#72ff5e';
    $colors['blue'] = '#5ee2ff';

    // Protects some special scripts such as theme.
    if (defined('ABORT_AFTER_CONFIG')) {
        return '';
    }

    // Protect against some network back calls.
    if (defined('MNET_SERVER')) {
        return;
    }

    $config = get_config('local_technicalsignals');

    $template = new StdClass;
    $filtermanager = filter_manager::instance();
    $context = context_system::instance();

    // Network admin message needs MNET structure to be defined.
    if (!empty($CFG->mainhostprefix) && file_exists($CFG->dirroot.'/local/vmoodle/plugins/generic/lib.php') && ($CFG->mnet_dispatcher_mode == 'strict')) {

        require_once($CFG->dirroot.'/local/vmoodle/plugins/generic/lib.php');

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
            if (debugging()) {
                return $OUTPUT->notification(get_string('undefinedmainhost', 'local_technicalsignals', $CFG->mainhostprefix));
            }
        }

        if ((@$mainhost->wwwroot != $CFG->wwwroot) &&
                        ($PAGE->pagetype != 'admin-mnet-peers')) {
            $islocal = false;
            // Protect the mnet peer page.
            if ($color = vmoodle_get_remote_config($mainhost, 'globaladminmessagecolor')) {
                $text = vmoodle_get_remote_config($mainhost, 'globaladminmessage');
            }
        } else {
            $islocal = true;
            $text = @$CFG->globaladminmessage;
            $color = @$CFG->globaladminmessagecolor;
        }

        if (!empty($color) && !empty($text)) {
            $template->globaladminmessage = true;
            $globalmessagestr = get_string('globalmessageprefix', 'local_technicalsignals');
            $template->globalmessagestr = $filtermanager->filter_string($globalmessagestr, $context);
            $template->color = $color;
            $template->text = $filtermanager->filter_string($text, $context);

            if ($islocal) {
                if (has_capability('local/technicalsignals:manage', context_system::instance())) {
                    $template->globalcanremove = true;
                    $template->deleteicon = $OUTPUT->pix_icon('t/delete', get_string('remove', 'local_technicalsignals'));
                    $params = array('returnurl' => me(), 'global' => 1);
                    $eraseurl = new moodle_url('/local/technicalsignals/resetmessage.php', $params);
                    $template->globaleraseurl = $eraseurl;
                }
            }
        }
    }

    // Local messaging.
    if (!empty($CFG->adminmessagecolor) && !empty($CFG->adminmessage)) {
        $template->style = 'background-color:'.$CFG->adminmessagecolor;
        $template->adminmessage = $filtermanager->filter_string($CFG->adminmessage, $context);
        if (has_capability('local/technicalsignals:manage', $context)) {
            $template->canremove = true;
            $template->deleteicon = $OUTPUT->pix_icon('t/delete', get_string('remove', 'local_technicalsignals'));
            $eraseurl = new moodle_url('/local/technicalsignals/resetmessage.php', array('returnurl' => me()));
            $template->eraseurl = $eraseurl;
        }
    }

    // Infra messaging.
     if (!empty($CFG->inframessagelocation)) {
        if (is_file($CFG->inframessagelocation) && is_readable($CFG->inframessagelocation)) {
            $inframessage = implode('', file($CFG->inframessagelocation));
            if (!empty($inframessage)) {
                if (preg_match('/^([^|]*?)\\|(.*)$/', $inframessage, $matches)) {
                    if (in_array($matches[1], array_keys($colors))) {
                        $template->style = 'background-color:'.$colors[$matches[1]];
                    } else {
                        $template->style = 'background-color: '.$colors['red'];
                    }
                    $inframessage = $matches[2];
                } else {
                    $template->style = 'background-color: '.$colors['red'];
                }
                $template->inframessage = $filtermanager->filter_string($inframessage, $context);
            }
        }
    }

    return $OUTPUT->render_from_template('local_technicalsignals/technicalsignal', $template);
}
