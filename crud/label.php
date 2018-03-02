<?php

// Load global settings and configs
require('../dbconnect.php');
require('../functions.php');

// Open up the cookie box
if(!empty($_COOKIE["slf_tasker"])){
	$user_cookie = unserialize($_COOKIE["slf_tasker"]);

	// Create vars based on that cookie info
	$user['id'] = intval($user_cookie["id"]);
	$user = getRow('tbl_user',$user['id']);
	$user['ip_address'] = getVisitorIp();

	$table = 'tbl_tag';

	// sanitize data
	$postdata = sanitizeData($_POST['Form']);
}

if(!empty($_POST) OR $_GET["v"] == 'export_csv'){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create":
		
			$column = "tag,color,explanation";
			$values = "
				'{$postdata['tag']}',
				'{$postdata['color']}',
				'{$postdata['explanation']}'
			";
			$new = insertRow($table,$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "delete":
			
			// mark as trash
			updateRow($table,"trash='1'",$postdata['id']);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "restore":
			
			// mark as trash
			updateRow($table,"trash='0'",$postdata['id']);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "update":
			
			foreach($postdata AS $key => $val){
				updateRow($table,"{$key}='{$val}'",$postdata['id']);
			}

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>