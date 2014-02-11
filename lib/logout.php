<?php
//include_once '..\config.php';
require_once ROOT.'/controller/UsuariosController.php';
$usuarioController = new UsuariosController(new UsuarioModel());

   //if ($_SESSION['logado'] == true)
	//{
		$usuarioController->logoutUsuarioAction();
	//}
?>