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

	$table = 'tbl_user';

	// sanitize data
	$postdata = sanitizeData($_POST['Form']);
}

if(!empty($_POST) OR $_GET["v"] == 'export_csv'){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create":
		
			sort($postdata['assigned_client']);
			$postdata['assigned_client'] = implode(',', $postdata['assigned_client']);

			$column = "display_name,username,password,position,email,color,role,access";
			$values = "
				'{$postdata['display_name']}',
				'{$postdata['username']}',
				'{$postdata['password']}',
				'{$postdata['position']}',

				'{$postdata['email']}',
				'{$postdata['color']}',
				'2',
				'1'
			";
			$new = insertRow($table,$column,$values);

			$destination = "Location: ../{$postdata['return']}{$new}";
			header($destination);

		break;

		case "update":
			
			// Array
			// (
			//     [id] => 73
			//     [return] => index.php?o=user&v=update&id=73&alert=updated
			//     [display_name] => Luki Lie
			//     [username] => luki
			//     [password] => luki123
			//     [position] => Senior Helpdesk
			//     [email] => luki.foxel@gmail.com
			//     [color] => linear-gradient(141deg, #4a5cc5, #4152b4)
			//     [assigned_client] => Array
			//         (
			//             [0] => 24
			//             [1] => 29
			//             [2] => 6
			//             [3] => 9
			//             [4] => 4
			//             [5] => 3
			//             [6] => 1
			//             [7] => 7
			//         )
			// )

			// if no assigned client check found, get them
			if(!isset($postdata['assigned_client'])){
				$modifiedUser = getRow('tbl_user',$postdata['id']);
				$modifiedUser['assigned_client'] = explode(',',$modifiedUser['assigned_client']);
				$postdata['assigned_client'] = $modifiedUser['assigned_client'];
			}
			
			sort($postdata['assigned_client']);
			$postdata['assigned_client'] = implode(',', $postdata['assigned_client']);

			foreach($postdata AS $key => $val){
				updateRow($table,"{$key}='{$val}'",$postdata['id']);
			}

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

		case "update_clients":

			// Array
			// (
			//     [id] => 84
			//     [return] => index.php?o=user&v=clients&id=84&alert=updated
			//     [assigned_to] => Array
			//         (
			//             [0] => 5
			//             [1] => 4
			//             [2] => 6
			//         )
			// )
			
			$table = 'tbl_user_client';

			deleteMm($table,'user',$postdata['id']);

			foreach($postdata['assigned_to'] AS $key => $val){
				$column = "user,client";
				$values = "
					'{$postdata['id']}',
					'{$val}'
				";
				insertRow($table,$column,$values);
			}

			$destination = "Location: ../{$postdata['return']}";
			header($destination);

		break;

		case "update_permission":
			
			// Array
			// (
			//     [id] => 73
			//     [return] => index.php?o=user&v=update&id=73&alert=updated
			//     [permissions] => Array
			//         (
			//             [0] => 30
			//             [1] => 40
			//             [2] => 42
			//         )
			// )

			$table = 'tbl_user_permission';

			deleteMm($table,'user',$postdata['id']);

			foreach($postdata['permissions'] AS $key => $val){
				$column = "user,permission";
				$values = "
					'{$postdata['id']}',
					'{$val}'
				";
				insertRow($table,$column,$values);
			}

			$destination = "Location: ../{$postdata['return']}";
			header($destination);


		break;

		case "ajax_getUserFromClient":

			// Array
			// (
			//     [client_id] => 73
			// )

			$output = '';

			$users = getMMresults('tbl_user_client',$postdata['client_id'],'client','user');

			foreach ($users as $key => $value) {
				
				$user = getRow('tbl_user',$value);

				$output .= '
					<option class="rsjk" value="'.$user['id'].'">'.$user['display_name'].'</option>
				';
			}

			echo $output;

		break;

		case "ajax_getUserEmails":

			// Array
			// (
			//     [client_id] => 73
			// )

			$view = '';

			$client = getRow('tbl_client',$postdata['client_id']);
			$emails = getUserEmailsInClients($client);
			$all = 0;

			foreach ($emails as $key => $value) {
				
				if(!empty($value)){
					$view .= '
						<li>'.$value.'</li>
					';
					$all++;
				}
				
			}

			if($all == 0){
				$view = '<li>No users will be notified. Please assign users to clients first, or check for blank emails on assigned users.</li>';
			}

			$output = '
				<blockquote class="sm c-lightgrey jyskk">
				  <p>Email notification will be sent to pic of this client:</p>
				  <ul>
				    '.$view.'
				  </ul>
				</blockquote>
			';

			echo $output;

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>