<?php
	include_once 'config.php';
	/*Just for your server-side code
	* O HTML com a codificacao UTF-8 exibe os caracteres especiais corretamente,
	* mas o PHP nao.
	*/
	header('Content-Type: text/html; charset=UTF-8');
	
	if (isset($_GET['action']) && $_GET['action'] == "logout")
	{
		include ROOT.'/lib/logout.php';
	}
	
	//include ROOT.'/public_html/header.php';
	//include ROOT.'/public_html/principal.html';
	header ('Location: login');	
?>
