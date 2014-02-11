<?php
include_once '..\config.php';
require_once ROOT.'/controller/UsuariosController.php';
$usuarioController = new UsuariosController(new UsuarioModel());

   if (isset($_POST['email_login']) && isset($_POST['senha_login']))
	{
		$usuarioController->loginUsuarioAction();
	}
?>