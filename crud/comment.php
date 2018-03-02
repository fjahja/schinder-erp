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

	// sanitize data
	$postdata = sanitizeData($_POST['Form']);
}

if(!empty($_POST) OR $_GET["v"] == 'export_csv'){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create_ticket":

			// begin main
			$column = "user,ticket,comment";
			$values = "
				'{$user['id']}',
				'{$postdata['ticket_id']}',
				'{$postdata['comment']}'
			";
			$new = insertRow('tbl_ticket_comment',$column,$values);

			// save to activity table
			$column = "user,ticket,ticket_comment,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['ticket_id']}',
				'{$new}',
				'51'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "create_asset":

			$column = "user,asset,comment";
			$values = "
				'{$user['id']}',
				'{$postdata['asset_id']}',
				'{$postdata['comment']}'
			";
			$new = insertRow('tbl_asset_comment',$column,$values);

			// save to activity table
			$column = "user,asset,asset_comment,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['asset_id']}',
				'{$new}',
				'61'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "delete":

			// delete
			deleteRow('tbl_ticket_comment',$postdata['comment_id']);

			// delete
			deleteMm('tbl_user_activity','ticket_comment',$postdata['comment_id']);

		break;

		case "delete_asset":

			// delete
			deleteRow('tbl_asset_comment',$postdata['comment_id']);

			deleteMm('tbl_user_activity','asset_comment',$postdata['comment_id']);

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>