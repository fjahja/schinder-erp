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

	$table = 'tbl_crm_contact';

	// sanitize data
	$postdata = sanitizeData($_POST['Form']);
}

if(!empty($_POST) OR $_GET["v"] == 'export_csv'){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create":
		
			$column = "name,notes";
			$values = "
				'{$postdata['name']}',
				'{$postdata['notes']}'
			";
			$new = insertRow($table,$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);
			exit();

			// echo '<pre>';
			// print_r($postdata);
			// echo '</pre>';

		break;

		case "restore":
			
			// mark as trash
			updateRow($table,"trash='0'",$postdata['id']);

			// save to activity table
			$ticket = getRow($table,$postdata['id']);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);
			exit();

		break;

		case "delete":
			
			// mark as trash
			updateRow($table,"trash='1'",$postdata['id']);

			// save to activity table
			$ticket = getRow($table,$postdata['id']);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);
			exit();

		break;

		case "empty_trash":

			// delete connection first
			$query = "
				SELECT FROM {$table} 
				WHERE (trash = 1)
			";
			$result = mysql_fetch_array(mysqli_query($link,$query));
			while($row = mysqli_fetch_array($result)){
				$query = "
					DELETE FROM tbl_crm_contact_account x
					WHERE (x.contact = {$row['id']})
				";
				mysqli_query($link,$query);
			}
			
			// then hard delete
			$query = "
				DELETE FROM {$table} 
				WHERE (trash = 1)
			";
			mysqli_query($link,$query);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);
			exit();

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

		case "ajax_autocompleteCompanies":

			$output = '';

			$query = "
				SELECT *
				FROM tbl_crm_account x
				WHERE 1
					AND (x.trash = 0)
					AND (x.name LIKE '%{$postdata['input']}%')
			";
			$result = mysqli_query($link,$query);
			$sum = mysqli_num_rows($result);

			if($sum != 0){
				while($row = mysqli_fetch_array($result)){

					// search enhancements
					$name = preg_replace("/".preg_quote($postdata['input'],'/')."/i", '<span style="background-color: yellow;">$0</span>', $row['name']);

					$output .= '
						<div class="entry" data-name="'.$row['name'].'"  data-company-id="'.$row['id'].'">
							<i class="fa fa-building-o c-lightgrey"></i>
							'.$name.'
						</div>
					';
				}
			} else {
				$output = '
					<div class="entry"><em class="c-lightgrey">No result found</em></div>
				';
			}
			

			echo $output;

		break;

		case "ajax_attachContactToCompany":

			$column = "account,contact,position";
			$values = "
				'{$postdata['company_id']}',
				'{$postdata['contact_id']}',
				'{$postdata['position']}'
			";
			$new = insertRow('tbl_crm_contact_account',$column,$values);

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