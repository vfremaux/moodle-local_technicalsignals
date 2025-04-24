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
 * Main renderer.
 *
 * @package     local_technicalsignal
 * @category    local
 * @author      Valery Fremaux <valery.fremaux@gmail.com>
 * @copyright   Valery Fremaux <valery.fremaux@gmail.com> (MyLearningFactory.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['technicalsignals:manage'] = 'Manage technical signals';

// Privacy
$string['privacy:metadata'] = 'The Local Technical Signals plugin does not store any personal data about any user.';

$string['pluginname'] = 'Exploitation technical advices';

$string['configadminmessage'] = 'Administrator message';
$string['configadminmessage_desc'] = 'Technical notice to users at screen top. Leave blanck to disable';
$string['configadminmessagecolor'] = 'Technical notice background color';
$string['configadminmessageholdtime'] = 'Hold time';
$string['exploitation'] = 'Exploitation';
$string['configglobaladminmessage'] = 'Global MNET tech notice';
$string['configglobaladminmessage_desc'] = 'Technical notice displayed on all nodes of the MNET. Leave blank to disable';
$string['configglobaladminmessagecolor'] = 'Global tech notice background color';
$string['configglobaladminmessageholdtime'] = 'Global message hold time';
$string['configinframessagelocation'] = 'Infra level message location';
$string['configinframessagelocation_desc'] = 'If this UTF-8 file is found, then its ocntent is added as infra notification. It should be located in a place all running moodles can find.';
$string['inframessageprefix'] = '<b>Service d\'infrastructure</b> ';
$string['globalmessageprefix'] = '<b>Global network notice</b>';
$string['hide'] = 'Hide the message';
$string['undefinedmainhost'] = 'No main host match your given mainhostprefix : {$a}. Check main host prefix should start with http:// (or https://) and be registered in known Mnet peers. The prefix can be setup using the publishflow block, or directly in the config file of Moodle.';
$string['red'] = 'Red';
$string['orange'] = 'Orange';
$string['yellow'] = 'Yellow';
$string['green'] = 'Green';
$string['blue'] = 'Blue';
$string['remove'] = 'Erase signal';
$string['always'] = 'Always';
$string['onehour'] = 'One hour';
$string['threehours'] = 'Three hours';
$string['twelvehours'] = 'Twelve hours';
$string['oneday'] = 'One day';
$string['threedays'] = 'Three days';

