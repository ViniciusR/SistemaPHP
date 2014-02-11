<?php
include_once '../config.php';
require_once ROOT.'/controller/UsuariosController.php';

	if (isset($_GET['id']))
	{
		$usuarioModel = new UsuarioModel();
		$usuarioModel->getUsuario($_GET['id']);
		$usuarioController = new UsuariosController($usuarioModel);
		$usuarioController->excluirUsuarioAction();
	}
?>