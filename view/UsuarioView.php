<?php
require_once ROOT.'/model/UsuarioModel.php';

/**
 * Classe view do Usuário.
 * @author Vinicius Silva
 *
 */
class UsuarioView
{
	private $usuarioModel;
	
	public function __construct($usuarioModel)
	{
		$this->usuarioModel = $usuarioModel;
	}
	
	/**
	 * Imprime os dados do usuário diretamente no documento html.
	 */
	public function imprimeDadosUsuario()
	{
		echo '<p>Nome completo: '.$this->usuarioModel->getNome()." ".$this->usuarioModel->getsobrenome()."</p>";  
		echo '<p>E-mail: '.$this->usuarioModel->getEmail()."</p>";
		echo '<p>Data de nascimento: '.$this->usuarioModel->getDataNascimento()."</p>";
	}
	
	/**
	 * Imprime o nome completo do usuário no documento html.
	 */
	public function imprimeNomeCompleto()
	{
		echo $this->usuarioModel->getNome()." ".$this->usuarioModel->getsobrenome();
	}
}