<?php 

$page['parent'] = 'Labels';
$page['model'] = 'label';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		// permissions
		$page['id'] = 70;
		lockPage($admin,$page);

		$page['title'] = 'Labels';

		$_GET['trash'] = (isset($_GET['trash']) ? $_GET['trash'] : 0);

		// begin fetching data
		$output = getLabelAdmin($admin,$_GET);

	break;


	case "create":

		// permissions
		$page['id'] = 71;
		lockPage($admin,$page);
		
		$page['title'] = 'New label';
		

	break;

	case "update":

		// permissions
		$page['id'] = 73;
		lockPage($admin,$page);

		$page['title'] = 'Edit label';

		// begin fetching data
		$model = getRowRedirectError('tbl_tag',$_GET['id']);

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