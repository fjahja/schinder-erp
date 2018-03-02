<?php 

// model specific vars
$page['parent'] = 'Users';
$page['model'] = 'user';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "profile":

		// permissions
		// $page['id'] = 12;
		// lockPage($admin,$page);

		$scripts = array('ajaxStopContribution.php');

		$page['title'] = 'My Profile';

		$_GET['tab'] = (isset($_GET['tab']) ? $_GET['tab'] : 1); // mode
		$_GET['mode'] = (isset($_GET['mode']) ? $_GET['mode'] : 'table'); // mode
		

		// recent activity tab
		$activity = getActivity($admin);

		// my contributions tab
		$_GET['running'] = 'all';
		$_GET['client'] = 'all';
		$_GET['user'] = $admin['id'];
		$_GET['limit'] = 50;

		$contributions = tableContributionRunning($_GET,'all');

	break;

	case "billable":

		// permissions
		$page['id'] = 48;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'datePickerMonthOnly.php',
			'scrollToFix.php'
		);

		$page['title'] = 'Record Of Billable Hours For Lawyers';
		$_GET['time'] = (isset($_GET['time']) ? strtotime($_GET['time']) : time()); 

		// data fetching
		$model = getRow('tbl_user',$_GET['id']);
		$table = billableTableNew($_GET,$model,40);
		$jumper = jumperUser($model,array('user','billable',$admin));

	break;

	case "billable_own":

		// permissions
		$page['id'] = 203;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'datePickerMonthOnly.php',
			'scrollToFix.php'
		);

		$page['title'] = 'Record Of Billable Hours For Lawyers';
		$_GET['time'] = (isset($_GET['time']) ? strtotime($_GET['time']) : time()); 

		// data fetching
		$table = billableTableNew($_GET,$admin,50);
		
	break;

	case "admin":

		// permissions
		$page['id'] = 10;
		lockPage($admin,$page);

		$page['title'] = 'Users';

		$_GET['mode'] = (isset($_GET['mode']) ? $_GET['mode'] : 'table'); // mode
		$_GET['trash'] = (isset($_GET['trash']) ? $_GET['trash'] : 0);

		// begin fetching data
		$output = getUserAdmin($admin,$_GET);

	break;

	case "log":

		// permissions
		$page['id'] = 19;
		lockPage($admin,$page);

		// main data fetch
		$model = getRowRedirectError('tbl_user',$_GET['id']);

		$page['title'] = 'User Activity Log';

		// various filters
		$_GET['at'] = (isset($_GET['at']) ? $_GET['at'] : 'all'); // activity_type
		$_GET['day'] = (isset($_GET['day']) ? $_GET['day'] : intval(date('j')));
		$_GET['month'] = (isset($_GET['month']) ? $_GET['month'] : intval(date('n')));
		$_GET['year'] = (isset($_GET['year']) ? $_GET['year'] : intval(date('Y')));

		// 2017-10-16 04:49:58
		$timestamp = $_GET['year'] .'-'. $_GET['month'] .'-'. $_GET['day'];

		// data fetching
		$activity = getActivity(
		  $_GET,
		  $_GET['at'],
		  $timestamp
		);
		$users = userLogSelect($_GET['id'],$currentUrl);

	break;

	case "create":

		// permissions
		$page['id'] = 121;
		lockPage($admin,$page);

		$page['title'] = 'Create user';

	break;

	case "update":

		// permissions
		$page['id'] = 13;
		lockPage($admin,$page);

		$page['title'] = 'Edit user';

		// begin fetching data
		$model = getRowRedirectError('tbl_user',$_GET['id']);
		$jumper = jumperUser($model,array('user','update'));

	break;

	case "permission":

		// permissions
		$page['id'] = 11;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array('userPermissionMatrix.php');
		
		$page['title'] = 'Edit user permissions';

		// begin fetching data
		$model = getRowRedirectError('tbl_user',$_GET['id']);
		$permissionTable = getPermissionTable($_GET['id']);
		$jumper = jumperUser($model,array('user','permission'));

	break;

	case "clients":

		// permissions
		$page['id'] = 18;
		lockPage($admin,$page);
		
		$page['title'] = 'Edit assigned clients';

		// begin fetching data
		$model = getRowRedirectError('tbl_user',$_GET['id']);
		$model['assigned_client'] = getMMresults('tbl_user_client',$model['id'],'user','client');

		$jumper = jumperUser($model,array('user','clients'));
		$select = mmSelect_UserClients($model);

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