<?php 

$page['parent'] = 'CRM Companies';
$page['model'] = 'crm_company';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		// permissions
		$page['id'] = 430;
		lockPage($admin,$page);

		$page['title'] = 'CRM Companies';

		$_GET['trash'] = (isset($_GET['trash']) ? $_GET['trash'] : 0);
		$_GET['searchtype'] = (isset($_GET['searchtype']) ? $_GET['searchtype'] : NULL);
		$_GET['search'] = (isset($_GET['search']) ? $_GET['search'] : NULL);
		$_GET['idx'] = (isset($_GET['idx']) ? $_GET['idx'] : NULL);

		// begin fetching data
		$output = getCrmCompanyAdmin($_GET,$admin);

	break;

	case "view":

		// permissions
		$page['id'] = 430;
		lockPage($admin,$page);

		$page['title'] = 'CC'.$_GET['id'];

		// begin fetching data
		$model = getRowRedirectError('tbl_crm_account',$_GET['id']);
		$contacts = getContactsInCompanies($model);

		// custom scripts
		$scripts = array(
			'ajaxCrm.php',
		);

		// data corrections
		$model['_timestamp'] = date('j M, Y',strtotime($model['timestamp']));

	break;

	case "create":

		// permissions
		$page['id'] = 101;
		lockPage($admin,$page);

		$page['title'] = 'New company';

	break;

	case "update":

		// permissions
		$page['id'] = 103;
		lockPage($admin,$page);

		$page['title'] = 'Edit category';

		// begin fetching data
		$model = getRowRedirectError('tbl_ticket_category',$_GET['id']);

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