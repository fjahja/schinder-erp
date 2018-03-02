<?php 

$page['parent'] = 'Tasks';
$page['model'] = 'task';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		$page['id'] = array(209,210);
		lockPage($admin,$page);

		$page['title'] = 'Tasks';

		$_GET['client'] = (isset($_GET['client']) ? $_GET['client'] : 'all');
		$_GET['status'] = (isset($_GET['status']) ? $_GET['status'] : '0');
		$_GET['searchtype'] = (isset($_GET['searchtype']) ? $_GET['searchtype'] : NULL);
		$_GET['search'] = (isset($_GET['search']) ? $_GET['search'] : NULL);
		$_GET['sort'] = (isset($_GET['sort']) ? $_GET['sort'] : 'timestamp');

		// begin fetching data
		$output = getTicketAdmin2($_GET,$currentUrl,$admin);

	break;

	case "admin2":

		$page['id'] = 30;
		lockPage($admin,$page);

		$page['title'] = 'Tasks';

		$_GET['mode'] = (isset($_GET['mode']) ? $_GET['mode'] : 'table'); 
		$_GET['client'] = (isset($_GET['client']) ? $_GET['client'] : 'all');
		$_GET['status'] = (isset($_GET['status']) ? $_GET['status'] : '0');
		$_GET['pg'] = (isset($_GET['pg']) ? $_GET['pg'] : 0);
		$_GET['searchtype'] = (isset($_GET['searchtype']) ? $_GET['searchtype'] : NULL);
		$_GET['search'] = (isset($_GET['search']) ? $_GET['search'] : NULL);
		$_GET['sort'] = (isset($_GET['sort']) ? $_GET['sort'] : 'timestamp');

		// begin fetching data
		$output = getTicketAdminLegacy(
			$_GET['mode'],
			$_GET['client'],
			$_GET['status'],
			$_GET['pg'],
			$currentUrl,
			$admin['assigned_client'],
			$_GET['search'],
			$_GET['searchtype'],
			$_GET['sort']
		);
		$filterClient = ticketFilterByClient(
			$_GET['client'],
			$admin['assigned_client'],
			'ticket'
		);

		// other corrections
		$prvpg_url = removeUrl($currentUrl,'pg') . '&pg=' . ($_GET['pg']-1);
		$nxpg_url = removeUrl($currentUrl,'pg') . '&pg=' . ($_GET['pg']+1);

	break;

	case "board":

		$page['id'] = 120;
		lockPage($admin,$page);

		$page['title'] = 'Task board';

		$_GET['client'] = (isset($_GET['client']) ? $_GET['client'] : 'all');
		$jumper = boardClientJumper($_GET,$admin);
		$client = getRow('tbl_client',$_GET['client']);

		// boards
		$table = boardTable($_GET,$admin);

	break;

	case "view":

		// permissions
		$page['id'] = 32;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'ajaxDeleteComment.php',
			'ajaxEditLabels.php',
			'ajaxEditAssignee.php',
			'ajaxStopContribution.php',
		);

		$page['title'] = '#'.$_GET['id'];
		$_GET['tab'] = (isset($_GET['tab']) ? $_GET['tab'] : 'home');

		// begin fetching data
		$model = getRowRedirectError('tbl_ticket',$_GET['id']);

		// record on tbl_ticket_read for unread count
		recordRead($admin,$model);

		// assigned task check
		if(!hasPermission($admin,array(209))){
			checkIfAssigned($model,$admin);
		}

		$agreement = getRow('tbl_agreement',$model['agreement']);
		$client = getRow('tbl_client',$model['client']);
		$category = getRow('tbl_ticket_category',$model['category']);
		$reporter = getRow('tbl_user',$model['creator']);
		$closer = getRow('tbl_user',$model['closed_by']);

		$activity = getActivityInTicket($_GET['id'],$admin['id']);

		// get tags
		$tags = getTags($_GET['id'],'ticket_view');
		$saved_tags = getMMresults('tbl_ticket_tag',$model['id'],'ticket','tag');
		$tags_checks = getTagsChecks($saved_tags);

		// get assignee
		$assignee = getAssignee($model['id']);
		$saved_assignee = getMMresults('tbl_ticket_assignee',$model['id'],'ticket','user');
		$assigneeCheck = getAssigneeCheck($client,$saved_assignee);

		// for resending notifications
		if(hasPermission($admin,array(227))){
			$assigneeForResend = getAssigneeForResend($model['id']);
			$adminForResend = getAdminForResend($model['id']);
		} else {
			$assigneeForResend = '';
			$adminForResend = '';
		}

		// contributions
		$contributions = getContributionsTable($model,$admin);

		// data corrections
		$model['_timestamp'] = date('j M, Y',strtotime($model['timestamp']));
		$model['_start_date'] = ( $model['start_date'] != '0000-00-00 00:00:00' ? date('j M, Y',strtotime($model['start_date'])) : false );
		$model['_due_date'] = ( $model['due_date'] != '0000-00-00 00:00:00' ? date('j M, Y',strtotime($model['due_date'])) : false );

		$is_owner = ($admin['id'] == $model['creator'] ? TRUE : FALSE);

	break;

	case "create":

		$page['id'] = array(214,215);
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'advancedForms.php',
			'ajaxTicketCreate.php',
		);
		
		$page['title'] = 'New Task';

		// begin fetching data
		$clientSelect = ticketCreateClientSelect($admin);
		$categorySelect = ticketCreateCategorySelect();
		$adminEmails = getAdminEmails();
		$users = getUsersToAssign();

	break;

	case "resend_workframe":

		$page['id'] = array(227);
		lockPage($admin,$page);

		echo 'test';

	break;

	case "update":

		// permissions
		$page['id'] = 33;
		lockPage($admin,$page);

		// custom scripts
		$scripts = array(
			'advancedForms.php',
			'ajaxTicketCreate.php',
		);

		$page['title'] = 'Edit task #'.$_GET['id'];

		// begin fetching data
		$model = getRowRedirectError('tbl_ticket',$_GET['id']);
		$agreement = getRow('tbl_agreement',$model['agreement']);
		if($agreement['client'] != '0'){
			$client = getRow('tbl_client',$model['client']);
		} else {
			$client = getRow('tbl_client',$agreement['client']);
		}
		
		$category = getRow('tbl_ticket_category',$model['category']);

		// begin fetching data
		$clientSelect = ticketCreateClientSelect($admin,$client['id']);
		$categorySelect = ticketCreateCategorySelect($model['category']);
		$agreement = getChosenAgreement($agreement);

		// data corrections
		$model['start_date'] = ($model['start_date'] != '0000-00-00 00:00:00' ? substr($model['start_date'],0,-9) : '') ;
		$model['due_date'] = ($model['due_date'] != '0000-00-00 00:00:00' ? substr($model['due_date'],0,-9) : '') ;

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