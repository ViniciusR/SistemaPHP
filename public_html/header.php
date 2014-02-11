<?php

	/**
	 * Seleciona o header (barra do cabecalho) adequado, quando o usuario esta ou nao logado, ou esta na pagina de registrar usuario.
	 */
	session_start();
	
	if (isset($_SESSION['logado']) && $_SESSION['logado'])
	{		
		include (ROOT."/public_html/header_logado.php");
	}
	else
	{
		if (basename($_SERVER['PHP_SELF']) == "registrar_usuario.php")
		{
			include ROOT.'/public_html/header_registrar.php';
		}
		else 
		{
			include ROOT.'/public_html/header_principal.php';
		}
	}
?>



