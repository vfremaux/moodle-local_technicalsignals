<?php

/**
* prints an administrator message in the screen where called. 
* usually called as first prints of the body in theme header.
* 
* @uses configuration key globaladminmessage and globaladminmessagecolor
* @uses configuration mainhostprefix for network extension
*/
function local_print_administrator_message(){
	global $CFG;

	// network admin meesage needs MNET structure to be defined
	if (!empty($CFG->mainhostprefix)){
		require_once $CFG->dirroot.'/blocks/vmoodle/plugins/libs/genericlib/lib.php';

		// get a potentially global information message
		$mainhost = get_record_select('mnet_host', " wwwroot LIKE '{$CFG->mainhostprefix}%' ");
		if (@$mainhost->wwwroot != $CFG->wwwroot){
			if ($text = vmoodle_get_remote_config($mainhost, 'globaladminmessage')){
				$color = vmoodle_get_remote_config($mainhost, 'globaladminmessagecolor');
			}
		} else {
			$text = @$CFG->globaladminmessage;
			$color = @$CFG->globaladminmessagecolor;
		}
		if (!empty($text)){
			$globalmessagestr = get_string('globalmessageprefix', 'local');
			echo "<div class=\"administratormessage\" style=\"padding:2px 2px 2px 10px;font-size:10px;background-color:{$color}\">{$globalmessagestr}: {$text}</div>";	
		}
	}
	if (!empty($CFG->adminmessage)){
		echo "<div class=\"administratormessage\" style=\"padding:2px 2px 2px 10px;font-size:10px;background-color:$CFG->adminmessagecolor\">{$CFG->adminmessage}</div>";
	}
}
