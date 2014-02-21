<?php

/*
 Verifica se um endereзo de email jб foi cadastrado ou se й o mesmo antes ao preencher o campo.
Retorna a resposta (true ou false) ao Javascript (Jquery.validate).
*/

include_once '..\config.php';
require_once ROOT.'/controller/UsuariosController.php';
$usuarioController = new UsuariosController(new UsuarioModel());

$email;
session_start();

	//Verifica o email no form de alteraзгo de cadastro.
	if (isset($_SESSION['id']))
	{
		if (isset($_POST['email_novo']))
		{
			$email = strtolower(trim($_POST['email_novo']));
			echo $usuarioController->verificaEmailAction($_SESSION['id'], $email);
		}
	}
	else 
	{
		//Verifica o email no form de registrar novo usuбrio.
		if (isset($_POST['email']))
		{
			$email = strtolower(trim($_POST['email']));
			echo $usuarioController->verificaEmailAction(null, $email);
		}
	}	
?>