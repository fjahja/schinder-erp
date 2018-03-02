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

		case "create":

			// prepare for email sending
			$email = array(
				'assignee' => '',
				'recepients' => array(),
				'recepients_cc' => getAdminEmails(),
			);

			// echo '<pre>';
			// print_r($postdata);
			// echo '</pre>';
		
			// 2017-06-08 16:30:00
			// $postdata["timestamp"] = $postdata["date"];
			// $postdata["due_date"] = $postdata["due_date"];

			// save to main table
			$column = "start_date,due_date,creator,status,subject,category,issue,client,agreement";
			$values = "
				'{$postdata['start_date']}',
				'{$postdata['due_date']}',
				'{$user['id']}',
				'0',
				'{$postdata['subject']}',
				'{$postdata['category']}',
				'{$postdata['issue']}',
				'{$postdata['client']}',
				'{$postdata['agreement']}'
			";
			$new = insertRow('tbl_ticket',$column,$values);

			// save to tbl_ticket_assignee
			if (isset($postdata['assigned_to'])) {
				foreach ($postdata['assigned_to'] as $key => $value) {
					$column = "ticket,user";
					$values = "
						'{$new}',
						'{$value}'
					";
					insertRow('tbl_ticket_assignee',$column,$values);

					$assignee = getRow('tbl_user',$value);

					// for email sending
					$email['recepients'][] = $assignee['email'];	
					$email['assignee'] .= '<u><b>'.$assignee['display_name'].'</b></u>, ';
				}
			}

			// save to activity table
			$column = "user,ticket,activity_type";
			$values = "
				'{$user['id']}',
				'{$new}',
				'31'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			/*********************
				EMAIL SENDING 	
			*********************/
			$client = getRow('tbl_client',$postdata['client']);
			$issue = (empty($postdata['issue']) ? '<em>No issue description</em>' : ''.$postdata['issue']);
			$return = removeUrl($postdata['return'],'alert');
			$email['assignee'] = rtrim($email['assignee'],', ');

			// cc email
			// $ccUsers = getAdminEmails();
			// foreach ($ccUsers as $key => $val) {
			// 	$email['cc'][] = $val;
			// }

			$email['subject'] = 'Work Frame - ' . $client['name'] . ' | ' . $postdata['subject'] . ' (#'.$new.')';
			$email['body'] = '

				<p>'.$issue.'</p>

				<p>---------------------------------</p>

				<p>Task assigned to: <br>'.$email['assignee'].'</p>

				<p>Task created by <b><u>'.$user['display_name'].'</u></b><br>User IP address: '.$user['ip_address'].'</p>
				
				<p><a href="www.schinderlawfirm.com/task/?o=ticket&v=view&id='.$new.'">View task (require login)</a></p>
			';

			ticketCreateNotification($email);

			$destination = "Location: ../{$postdata['return']}&id={$new}";
			header($destination);
			exit();

			// echo '<pre>';
			// print_r($postdata);
			// echo '</pre>';

		break;

		case "resend_notification":

			// Array
			// (
			//     [return] => index.php?o=ticket&v=view&alert=resent
			//     [assigneeResend] => Array
			//         (
			//             [0] => 10
			//         )
			//     [adminResend] => Array
			//         (
			//             [0] => 10
			//         )
			// )

			if(empty($postdata['assigneeResend']) AND empty($postdata['adminResend'])){
				$destination = "Location: ../{$postdata['return']}&id={$postdata['ticket_id']}&alert=blank_resent";
				header($destination);
				exit();
			}

			// prepare for email sending
			$email = array(
				'assignee' => '',
				'recepients' => array(),
				'recepients_cc' => array(),
			);

			// add to trays
			foreach ($postdata['assigneeResend'] as $key => $value) {
				$assignee = getRow('tbl_user',$value);
				$email['recepients'][] = $assignee['email'];
			}

			// add to trays
			foreach ($postdata['adminResend'] as $key => $value) {
				$assignee = getRow('tbl_user',$value);
				$email['recepients_cc'][] = $assignee['email'];
			}

			// Array
			// (
			//     [assignee] => 
			//     [recepients] => Array
			//         (
			//             [0] => dewi@schinderlawfirm.com
			//         )
			//     [recepients_cc] => Array
			//         (
			//             [0] => roy@schinderlawfirm.com
			//             [1] => suryani@schinderlawfirm.com
			//             [2] => luki.foxel@gmail.com
			//         )
			// )

			/*********************
				EMAIL SENDING 	
			*********************/
			$ticket = getRow('tbl_ticket',$postdata['ticket_id']);
			$client = getRow('tbl_client',$ticket['client']);
			$creator = getRow('tbl_user',$ticket['creator']);
			$issue = (empty($ticket['issue']) ? '<em>No issue description</em>' : ''.$ticket['issue']);
			$return = removeUrl($postdata['return'],'alert');

			// get assignee of this ticket
			$saved_assignee = getMMresults('tbl_ticket_assignee',$postdata['ticket_id'],'ticket','user');
			foreach ($saved_assignee as $key => $value) {
				$assignee_list = getRow('tbl_user',$value);
				$email['assignee'] .= '<u><b>'.$assignee_list['display_name'].'</b></u>, ';
			}
			$email['assignee'] = rtrim($email['assignee'],', ');

			// start sending, really
			$email['subject'] = 'Work Frame (Resend) - ' . $client['name'] . ' | ' . $postdata['subject'] . ' (#'.$postdata['ticket_id'].')';
			$email['body'] = '

				<p>'.$issue.'</p>

				<p>---------------------------------</p>

				<p>Task assigned to: <br>'.$email['assignee'].'</p>

				<p>Task created by <b><u>'.$creator['display_name'].'</u></b></p>
				
				<p><a href="www.schinderlawfirm.com/task/?o=ticket&v=view&id='.$postdata['ticket_id'].'">View task (require login)</a></p>
			';

			ticketCreateNotification($email);

			$destination = "Location: ../{$postdata['return']}&id={$postdata['ticket_id']}&alert=resent";
			header($destination);
			exit();

			// echo '<pre>';
			// print_r($email);
			// echo '</pre>';

		break;

		case "attach_tag":
		
			// (
			//     [ticket_id] => 1261
			//     [tag_id] => 1
			// )

			// first check if ticket is already with that tag
			$query = "
				SELECT 
					*
				FROM tbl_ticket_tag tt
				WHERE 1
					AND (tt.ticket = {$postdata['ticket_id']})
					AND (tt.tag = {$postdata['tag_id']})
			";
			$result = mysqli_query($link,$query);
			$sum = mysqli_num_rows($result);

			if ($sum == 0) {
				// save to main table
				$column = "ticket,tag";
				$values = "
					'{$postdata['ticket_id']}',
					'{$postdata['tag_id']}'
				";
				insertRow('tbl_ticket_tag',$column,$values);

				// save to activity table
				$column = "user,ticket,tag,activity_type";
				$values = "
					'{$user['id']}',
					'{$postdata['ticket_id']}',
					'{$postdata['tag_id']}',
					'75'
				";
				$newActivity = insertRow('tbl_user_activity',$column,$values);
			}

			// push to view
			$tag = getRow('tbl_tag',$postdata['tag_id']);
			$output = '';
			$output .= '
				<span class="taglabel'.$tag['id'].'">
					<div class="label lbl side-lbl" style="background:'.$tag['color'].';">'.$tag['tag'].'</div>
				</span>
			';			

			echo $output;

		break;

		case "detach_tag":
		
			// (
			//     [ticket_id] => 1261
			//     [tag_id] => 1
			// )

			$query = "
				DELETE FROM tbl_ticket_tag WHERE 1
				AND (ticket = {$postdata['ticket_id']}) 
				AND (tag = {$postdata['tag_id']}) 
			";
			mysqli_query($link,$query);

			// save to activity table
			$column = "user,ticket,tag,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['ticket_id']}',
				'{$postdata['tag_id']}',
				'76'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

		break;

		case "attach_assignee":
		
			// (
			//     [ticket_id] => 1261
			//     [assignee_id] => 73
			// )

			// first check if ticket is already with that assginee
			$query = "
				SELECT 
					*
				FROM tbl_ticket_assignee tta
				WHERE 1
					AND (tta.ticket = {$postdata['ticket_id']})
					AND (tta.user = {$postdata['assignee_id']})
			";
			$result = mysqli_query($link,$query);
			$sum = mysqli_num_rows($result);

			if ($sum == 0) {
				// save to main table
				$column = "ticket,user";
				$values = "
					'{$postdata['ticket_id']}',
					'{$postdata['assignee_id']}'
				";
				insertRow('tbl_ticket_assignee',$column,$values);

				// save to activity table
				$column = "user,ticket,ticket_assignee,activity_type";
				$values = "
					'{$user['id']}',
					'{$postdata['ticket_id']}',
					'{$postdata['assignee_id']}',
					'95'
				";
				$newActivity = insertRow('tbl_user_activity',$column,$values);
			}

			// push to view
			$assignee = getRow('tbl_user',$postdata['assignee_id']);
			$assignee['initial'] = userInitial($assignee['display_name']);
			$output = '';
			$output .= '
				<div class="usr-header assg'.$assignee['id'].'" style="background:'.$assignee['color'].';" data-toggle="tooltip" data-placement="top" title="Assigned to '.$assignee['display_name'].'">'.$assignee['initial'].'</div>
			';			

			echo $output;

		break;

		case "detach_assignee":
		
			// (
			//     [ticket_id] => 1261
			//     [assignee_id] => 1
			// )

			$query = "
				DELETE FROM tbl_ticket_assignee WHERE 1
				AND (ticket = {$postdata['ticket_id']}) 
				AND (user = {$postdata['assignee_id']}) 
			";

			mysqli_query($link,$query);

			// save to activity table
			$column = "user,ticket,ticket_assignee,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['ticket_id']}',
				'{$postdata['assignee_id']}',
				'96'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

		break;

		case "delete":
			
			// mark as trash
			updateRow('tbl_ticket',"trash='1'",$postdata['id']);

			// save to activity table
			$ticket = getRow('tbl_ticket',$postdata['id']);

			$column = "user,ticket,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['id']}',
				'34'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "close":
			
			// modify table
			$now = date('Y-m-d G:i:s',time());

			updateRow(
				'tbl_ticket',
				"status='2',closed_by='{$user['id']}',closed_on='{$now}'",
				$postdata['id']
			);

			// save to activity table
			$ticket = getRow('tbl_ticket',$postdata['id']);

			$column = "user,ticket,activity_type";
			$values = "
				'{$user['id']}',
				'{$postdata['id']}',
				'35'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "reopen":

			// modify table
			updateRow('tbl_ticket',"status='0'",$postdata['id']);

			// save to activity table
			$column = "user,activity_type,ticket";
			$values = "
				'{$user['id']}',
				'36',
				'{$postdata['id']}'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "update":

			// 2017-06-08 16:30:00
			// $postdata["timestamp"] = $postdata["date"];

			foreach($postdata AS $key => $val){
				updateRow('tbl_ticket',"{$key}='{$val}'",$postdata['id']);
			}

			// save to activity table
			$column = "user,activity_type,ticket";
			$values = "
				'{$user['id']}',
				'33',
				'{$postdata['id']}'
			";
			$newActivity = insertRow('tbl_user_activity',$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "test":

			echo '<pre>';
			print_r($postdata);
			echo '</pre>';

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>