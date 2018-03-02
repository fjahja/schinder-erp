<?php 

$page['parent'] = 'Categories';
$page['model'] = 'category';

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "admin":

		// permissions
		$page['id'] = 100;
		lockPage($admin,$page);

		$page['title'] = 'Categories';

		$_GET['trash'] = (isset($_GET['trash']) ? $_GET['trash'] : 0);

		// begin fetching data
		$output = getCategoryAdmin($_GET,$admin);

	break;

	case "create":

		// permissions
		$page['id'] = 101;
		lockPage($admin,$page);

		$page['title'] = 'New category';

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