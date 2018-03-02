<?php 

$page['parent'] = 'Contributions';
$page['model'] = 'contribution';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "create_backtrack":

		$page['id'] = 45;
		lockPage($admin,$page);

		$scripts = array(
			'advancedForms.php',
			'ajaxBacktrack.php',
		);
		
		$page['title'] = 'New Contribution';

		// begin fetching data
		$ticket = getRowRedirectError('tbl_ticket',$_GET['ticket']);
		$userSelect = backtrackUserSelect($admin);
		

	break;

	case "request_backtrack":

		$page['id'] = 219;
		lockPage($admin,$page);

		$scripts = array(
			'advancedForms.php',
			'ajaxBacktrack.php',
		);
		
		$page['title'] = 'Backtrack Request';

		// begin fetching data
		$tasks = getMyAssignedTasks($admin);
		

	break;

	case "manage_backtrack":

		$page['id'] = 220;
		lockPage($admin,$page);

		$scripts = array(
			'ajaxManageBacktrack.php',
		);
		
		$page['title'] = 'Backtrack Requests';
		$_GET['approved'] = (isset($_GET['approved']) ? $_GET['approved'] : 1);

		// begin fetching data
		$table = getPendingBacktracks();

	break;

	case "create_realtime":

		$page['id'] = 46;
		lockPage($admin,$page);
		
		$page['title'] = 'New Contribution';

		// begin fetching data
		$ticket = getRowRedirectError('tbl_ticket',$_GET['ticket']);

		// assigned task check
		if(!hasPermission($admin,array(209))){
			checkIfAssigned($ticket,$admin);
		}
		
		
	break;

	case "admin":

		// permissions
		$page['id'] = array(222);
		lockPage($admin,$page);

		$scripts = array(
			'datePickerMonthOnly.php',
		);

		$page['title'] = 'Manage Contributions';
		$_GET['time'] = (isset($_GET['time']) ? strtotime($_GET['time']) : time()); 

		// begin fetching data
		$model = getRow('tbl_user',$_GET['id']);
		$table = getUserContributions($admin,$_GET);
		$jumper = jumperUser($model,array('contribution','admin',$admin));
		
	break;

	case "mycontributions":

		// permissions
		$page['id'] = array(217,218);
		lockPage($admin,$page);

		$scripts = array(
			'datePickerMonthOnly.php',
		);

		$page['title'] = 'My Contributions';
		$_GET['time'] = (isset($_GET['time']) ? strtotime($_GET['time']) : time()); 

		// begin fetching data
		$table = getMyContributions($admin,$_GET);
		if (hasPermission($admin,array(218))){
			$jumper = jumperUser($model,array('contribution','mycontributions',$admin));
		}
		
	break;

	case "running":

		// permissions
		$page['id'] = 223;
		lockPage($admin,$page);

		$scripts = array('ajaxStopContribution.php');
		
		$page['title'] = 'Runnning Contributions';
		$_GET['running'] = (isset($_GET['running']) ? $_GET['running'] : 'all');
		$_GET['client'] = (isset($_GET['client']) ? $_GET['client'] : 'all');
		$_GET['search'] = (isset($_GET['search']) ? $_GET['search'] : NULL);

		// begin fetching data
		$client = getRow('tbl_client',$_GET['client']);
		
		// output tables
		$_GET['user'] = 'all';
		$table = tableContributionRunning($_GET,$client);
		// $clientFilter = contributionRunningClientFilter($client,$currentUrl);
		
	break;

	case "update":

		$page['id'] = 41;
		lockPage($admin,$page);

		$scripts = array(
			'advancedForms.php',
			'ajaxBacktrack.php',
		);
		
		$page['title'] = 'Update Contribution';

		// begin fetching data
		$model = getRowRedirectError('tbl_ticket_session',$_GET['id']);
		$ticket = getRowRedirectError('tbl_ticket',$model['ticket']);

		// corrections
		$model['start_time'] = date('G:i',strtotime($model['session_start']));
		$model['end_time'] = date('G:i',strtotime($model['session_end']));
		$model['start_date'] = date('Y-m-d',strtotime($model['session_start']));
		$model['end_date'] = date('Y-m-d',strtotime($model['session_end']));

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