<?php

/*
 Verifica se um endereco de email ja foi cadastrado ou se e o mesmo antes ao preencher o campo.
Retorna a resposta (true ou false) ao Javascript (Jquery.validate).
*/

include_once '..\config.php';
require_once ROOT.'/controller/UsuariosController.php';
$usuarioController = new UsuariosController(new UsuarioModel());

$email;
session_start();

	if (isset($_SESSION['id']))
	{
		if (isset($_POST['email_novo']))
		{
			$email = trim($_POST['email_novo']);
			echo $usuarioController->verificaEmailAction($_SESSION['id'], $email);
		}
	}
	else 
	{
		if (isset($_POST['email']))
		{
			$email = trim($_POST['email']);
			echo $usuarioController->verificaEmailAction(null, $email);
		}
	}	
?>