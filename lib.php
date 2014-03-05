<?php

/**
* prints an administrator message in the screen where called. 
* usually called as first prints of the body in theme header.
* 
* @uses configuration key globaladminmessage and globaladminmessagecolor
* @uses configuration mainhostprefix for network extension
*/
function local_print_administrator_message($return = false){
	global $CFG, $DB, $OUTPUT;

	// protect against some network back calls
	if (defined('MNET_SERVER')){
		return;
	}
	
	$str = '';

	// network admin meesage needs MNET structure to be defined
	if (!empty($CFG->mainhostprefix) && file_exists($CFG->dirroot.'/blocks/vmoodle/plugins/generic/lib.php')){
		require_once $CFG->dirroot.'/blocks/vmoodle/plugins/generic/lib.php';

		// get a potentially global information message
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
		if (!$mainhost = $DB->get_record_sql($sql, array($CFG->mainhostprefix.'%'))){
			echo $OUTPUT->notification(get_string('undefinedmainhost', 'local_technicalsignals', $CFG->mainhostprefix));
		}
		if (@$mainhost->wwwroot != $CFG->wwwroot){
			if ($text = vmoodle_get_remote_config($mainhost, 'globaladminmessage')){
				$color = vmoodle_get_remote_config($mainhost, 'globaladminmessagecolor');
			}
		} else {
			$text = @$CFG->globaladminmessage;
			$color = @$CFG->globaladminmessagecolor;
		}
		if (!empty($text)){
			$globalmessagestr = get_string('globalmessageprefix', 'local_technicalsignals');
			$str = "<div class=\"administratormessage\" style=\"padding:2px 2px 2px 10px;font-size:10px;background-color:{$color}\">{$globalmessagestr}: {$text}</div>";	
		}
	}
	
	// local messaging
	if (!empty($CFG->adminmessage)){
		$str = "<div class=\"administratormessage\" style=\"padding:2px 2px 2px 10px;font-size:10px;background-color:$CFG->adminmessagecolor\">{$CFG->adminmessage}</div>";
	}
	
	if ($return) return $str;
	echo $str;
}
