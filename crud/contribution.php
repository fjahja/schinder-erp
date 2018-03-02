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

if(!empty($_POST) OR $_GET["v"] == 'ajax_measure'){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create_trackback":

			// Array
			// (
			//     [ticket] => 5
			//     [return] => index.php?o=ticket&v=view&alert=created&id=5&tab=contributions
			//     [start_time] => 11:00
			//     [start_date] => 2017-10-30
			//     [end_time] => 11:01
			//     [end_date] => 2017-10-30
			//     [subject] => 
			// )

			// convert to epoch first
			$postdata['session_start'] = $postdata['start_date'] . ' ' . $postdata['start_time'] . ':00';
			$postdata['session_end'] = $postdata['end_date'] . ' ' . $postdata['end_time']  . ':00';

			// // prepare for email sending
			// $email = array('assignee'=>'');

			// save to main table
			$column = "ticket,user,session_start,session_end,approved,subject";
			$values = "
				'{$postdata['ticket']}',
				'{$postdata['user']}',

				'{$postdata['session_start']}',
				'{$postdata['session_end']}',
				'1',
				'{$postdata['subject']}'
			";
			$new = insertRow('tbl_ticket_session',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "create_realtime":

			// Array
			// (
			//     [ticket] => 5
			//     [return] => index.php?o=ticket&v=view&alert=created&id=5&tab=contributions
			//     [start_time] => 11:00
			//     [start_date] => 2017-10-30
			//     [end_time] => 11:01
			//     [end_date] => 2017-10-30
			//     [subject] => 
			// )

			// convert to epoch first
			$postdata['session_start'] = date('Y-m-d G:i:s');

			// // prepare for email sending
			// $email = array('assignee'=>'');

			// save to main table
			$column = "type,running,ticket,user,session_start,approved,subject";
			$values = "
				'1',
				'1',
				'{$postdata['ticket']}',
				'{$user['id']}',

				'{$postdata['session_start']}',
				'1',
				'{$postdata['subject']}'
			";
			$new = insertRow('tbl_ticket_session',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "request_backtrack":

			// convert to epoch first
			$postdata['session_start'] = $postdata['start_date'] . ' ' . $postdata['start_time'] . ':00';
			$postdata['session_end'] = $postdata['end_date'] . ' ' . $postdata['end_time']  . ':00';

			// prevent same start and end
			if( strtotime($postdata['session_start']) == strtotime($postdata['session_end'])  ){

				$destination = "Location: ../index.php?o=contribution&v=request_backtrack&alert=same_val";
				header($destination);
				exit();
			}

			// prevent negative entry
			if( strtotime($postdata['session_start']) > strtotime($postdata['session_end'])  ){

				$destination = "Location: ../index.php?o=contribution&v=request_backtrack&alert=start_larger";
				header($destination);
				exit();
			}

			// Array
			// (
			//     [return] => index.php?o=ticket&v=admin&status=0&alert=created
			//     [ticket] => 48
			//     [start_time] => 12:00
			//     [start_date] => 2017-12-08
			//     [end_time] => 12:00
			//     [end_date] => 2017-12-08
			//     [subject] => test
			//     [session_start] => 2017-12-08 12:00:00
			//     [session_end] => 2017-12-08 12:00:00
			// )

			// save to main table
			$column = "ticket,user,session_start,session_end,subject";
			$values = "
				'{$postdata['ticket']}',
				'{$user['id']}',
				'{$postdata['session_start']}',
				'{$postdata['session_end']}',
				'{$postdata['subject']}'
			";
			$new = insertRow('tbl_ticket_session',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);


		break;

		case "update":

			// convert to epoch first
			$postdata['session_start'] = $postdata['start_date'] . ' ' . $postdata['start_time'] . ':00';
			$postdata['session_end'] = $postdata['end_date'] . ' ' . $postdata['end_time']  . ':00';

			foreach($postdata AS $key => $val){
				updateRow('tbl_ticket_session',"{$key}='{$val}'",$postdata['id']);
			}

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "ajax_measure":

			$now = strtotime(date('Y-m-d G:i:s'));
			$diff = $now - $postdata['starttime'];
			$output = measureTime($diff);
			echo $output;

		break;

		case "ajax_calculate_backtrack":

			// Array
			// (
			//     [start_time] => 17:45
			//     [start_date] => 2017-10-30
			//     [end_time] => 10:29
			//     [end_date] => 2017-10-30
			// )

			// convert to epoch first
			$start = strtotime($postdata['start_date'] . ' ' . $postdata['start_time']);
			$end = strtotime($postdata['end_date'] . ' ' . $postdata['end_time']);

			$diff = $end - $start;

			if($diff < 0){

				echo '<p class="c-red mt-xs"><em>ERROR: Start time have to be earlier than end time.</em></p>';

			} elseif($diff > 60*60*24) {

				echo '<p class="c-red mt-xs"><em>ERROR: Duration cannot be more than 24 hours.</em></p>';

			} else {

				$diff_min = floor($diff/60);

				if($diff_min < 60){
					
					echo '<p class="c-lightgrey mt-xs"><em>'.$diff_min.' minutes</em></p>';

				} else{
					$diff_hour = floor($diff/3600);
					$diff_min = floor(($diff % 3600)/60);

					if($diff_min == 0){
						echo '<p class="c-lightgrey mt-xs"><em>'.$diff_hour.' hours</em></p>';
					} else {
						echo '<p class="c-lightgrey mt-xs"><em>'.$diff_hour.' hours and '.$diff_min.' minutes</em></p>';
					}
				}
			}

		break;

		case "ajax_approve":

			// (
			//     [contribution_id] => 201
			// )

			$now = date('Y-m-d G:i:s',time());

			updateRow(
				'tbl_ticket_session',
				"approved='1'",
				$postdata['contribution_id']
			);

		break;

		case "ajax_stop":

			// (
			//     [contribution_id] => 201
			// )

			$now = date('Y-m-d G:i:s',time());

			updateRow(
				'tbl_ticket_session',
				"running='0',session_end='{$now}'",
				$postdata['contribution_id']
			);

		break;

		case "signage_check":

			echo getActiveUsers();

		break;

		case "active_user_tasks":

			echo getActiveUserTasks($postdata['user_id']);

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>