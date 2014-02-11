<?php

/*
 Verifica se a senha atual esta correta. Usado na alteracao de cadastro de usuario.
Retorna a resposta (true ou false) ao Javascript (Jquery.validate).
*/

include_once '..\config.php';
require_once ROOT.'/controller/UsuariosController.php';
$usuarioController = new UsuariosController(new UsuarioModel());


$senha;

	if (isset($_POST['senha_atual']))
	{
		$senha = trim($_POST['senha_atual']);
		echo $usuarioController->verificaSenhaAction($senha);
	}
?>