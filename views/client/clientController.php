<?php 

$page['parent'] = 'Clients';
$page['model'] = 'client';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		// permissions
		$page['id'] = 20;
		lockPage($admin,$page);

		$page['title'] = 'Clients';

		$_GET['mode'] = (isset($_GET['mode']) ? $_GET['mode'] : 'table'); // mode
		$_GET['trash'] = (isset($_GET['trash']) ? $_GET['trash'] : 0);

		// begin fetching data
		$output = getClientAdmin($admin,$_GET['mode'],$_GET['trash']);

	break;

	case "update":

		// permissions
		$page['id'] = 23;
		lockPage($admin,$page);

		$page['title'] = 'Edit client';

		// begin fetching data
		$model = getRowRedirectError('tbl_client',$_GET['id']);
		$jumper = jumperClient($model,array('client','update'));

	break;

	case "create":

		// permissions
		$page['id'] = 21;
		lockPage($admin,$page);

		$page['title'] = 'Create client';

	break;

	case "users":

		// permissions
		$page['id'] = 28;
		lockPage($admin,$page);

		$page['title'] = 'Assign users to client';

		// begin fetching data
		$model = getRowRedirectError('tbl_client',$_GET['id']);
		$model['assigned_client'] = getMMresults('tbl_user_client',$model['id'],'client','user');
		$jumper = jumperClient($model,array('client','users'));
		$select = mmSelect_ClientUsers($model);



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