<?php 

$page['parent'] = 'Legal Templates';
$page['model'] = 'file';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		// permissions
		$page['id'] = 228;
		lockPage($admin,$page);

		$page['title'] = $page['parent'];

		// get current directory
		$_GET['path'] = (isset($_GET['path']) ? $_GET['path'] : '');
		$directory = getFileTree($_GET);

	break;

	case "create":

		$page['id'] = 205;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'advancedForms.php',
			'ajaxTicketCreate.php',
		);
		
		$page['title'] = 'New Agreement';

		// begin fetching data
		$clientSelect = ticketCreateClientSelect($admin);
		$categorySelect = ticketCreateCategorySelect();

	break;

	case "update":

		// permissions
		$page['id'] = 206;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'advancedForms.php',
		);

		$page['title'] = 'Edit agreement';

		// begin fetching data
		$model = getRowRedirectError('tbl_agreement',$_GET['id']);

		// begin fetching data
		$clientSelect = ticketCreateClientSelect($admin,$model['client']);
		$categorySelect = ticketCreateCategorySelect($model['category']);

		// data corrections
		$model['agreement_date'] = substr($model['agreement_date'],0,-9);
		$model['signed_date'] = ( $model['signed_date'] != '0000-00-00 00:00:00' ? substr($model['signed_date'],0,-9) : '');

	break;

	case "view":

		// permissions
		$page['id'] = 225;
		lockPage($admin,$page);

		$page['title'] = 'A'.$_GET['id'];

		// begin fetching data
		$model = getRowRedirectError('tbl_agreement',$_GET['id']);
		$_GET['tab'] = (isset($_GET['tab']) ? $_GET['tab'] : 'home');

		$client = getRow('tbl_client',$model['client']);
		$category = getRow('tbl_ticket_category',$model['category']);
		$creator = getRow('tbl_user',$model['creator']);

		// data corrections
		$model['_timestamp'] = date('j M, Y',strtotime($model['timestamp']));
		$model['_agreement_date'] = ( $model['agreement_date'] != '0000-00-00 00:00:00' ? date('j M, Y',strtotime($model['agreement_date'])) : false );
		$model['_signed_date'] = ( $model['signed_date'] != '0000-00-00 00:00:00' ? date('j M, Y',strtotime($model['signed_date'])) : false );

		// tasks
		$tasks = getTasksInAgreement($model);

	break;
}

require('snippets/html_head.php');
require('views/'.$_GET['o'] .'/'.$_GET['v'].'.php');
require('snippets/html_footer.php');

// custom footer scripts
require('scripts/general.php');
if(!empty($scripts)){
	foreach ($scripts as $key => $script_path) {
		require('scripts/'.$script_path);
	}
}
require('snippets/html_close.php');

?>