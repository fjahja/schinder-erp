<?php 

// custom scripts for each view
$scripts = array();

switch($_GET["v"]){

	case "login":
	break;

	case "dashboard":

		$page['title'] = 'Dashboard';
		
	break;

	case "error":

		$page['parent'] = '';
		$page['title'] = 'Error';
		$page['model'] = '';

	break;

	case "error_notallowed":

		$page['parent'] = '';
		$page['title'] = 'Permission Denied';
		$page['model'] = '';

	break;

	case "slf_blog":

		// permissions
		$page['id'] = 229;
		lockPage($admin,$page);

		$page['title'] = 'SLF Blog';

		// custom scripts
		$scripts = array(
			'blog.php',
		);

		$_GET['lang'] = (isset($_GET['lang']) ? $_GET['lang'] : 'eng');

		// get current directory
		$blog = getSlfBlog($_GET);

	break;

	case "signage":

		// permissions
		$page['id'] = 300;
		lockPage($admin,$page);

		$signage = getSignage();

		// staff ordering
		// left to right, top to bottom
		

	break;
}

if($_GET["v"] == 'login' OR $_GET["v"] == 'signage'){
	require('views/'.$_GET['o'] .'/'.$_GET['v'].'.php');
} else {
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
}


?>