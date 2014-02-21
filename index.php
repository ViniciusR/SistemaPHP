<?php
	include_once 'config.php';

	if (isset($_GET['action']) && $_GET['action'] == "logout")
	{
		include ROOT.'/lib/logout.php';
	}
	
	//include ROOT.'/public_html/header.php';
	//include ROOT.'/public_html/principal.html';
	header ('Location: login');	
?>
