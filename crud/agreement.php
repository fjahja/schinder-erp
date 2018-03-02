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

	$table = 'tbl_agreement';

	// sanitize data
	$postdata = sanitizeData($_POST['Form']);
}

if(!empty($_POST)){ // if POST data is detected, run a processor

	switch($_GET["v"]){

		case "create":
		
			$column = "agreement_date,signed_date,client,creator,category,agreement_number,agreement_value";
			$values = "
				'{$postdata['agreement_date']}',
				'{$postdata['signed_date']}',
				'{$postdata['client']}',
				'{$user['id']}',
				'{$postdata['category']}',
				'{$postdata['agreement_number']}',
				'{$postdata['agreement_value']}'
			";
			$new = insertRow($table,$column,$values);

			$destination = "Location: ../{$postdata['return']}";
			header($destination);
			exit();

			// echo '<pre>';
			// print_r($postdata);
			// echo '</pre>';

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



		case "ajax_getAgreementsFromClient":

			// Array
			// (
			//     [client_id] => 73
			// )

			$output = '';

			$agreements = getMMresults('tbl_agreement',$postdata['client_id'],'client','id');

			foreach ($agreements as $key => $value) {
				
				$agreement = getRow('tbl_agreement',$value);

				$output .= '
					<option class="rsjk" value="'.$agreement['id'].'">'.$agreement['agreement_number'].'</option>
				';
			}

			echo $output;

		break;

	}

} else { // if no POST data, redirect to error page
	echo 'No POST data is received.';
}

?>