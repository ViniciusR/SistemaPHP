<?php
require_once ROOT.'/model/UsuarioModel.php';
require_once ROOT.'/view/UsuarioView.php';

/**
 * Classe de controle do usu�rio, respons�veis pelas a��es das funcionalidades do sistema.
 * @author Vinicius Silva
 *
 */
class UsuariosController
{
	private $usuarioModel;
	private $usuarioView;
	

	function __construct($usuarioModel)
	{
		$this->usuarioModel = $usuarioModel;
		$this->usuarioView = new UsuarioView($this->usuarioModel);
	}

	/**
	 *  Realiza a a��o de registrar um novo usu�rio no sistema.
	 */
	public function registrarUsuarioAction()
	{
		$this->usuarioModel->setNome(trim($_POST['nome_registrar']));
		$this->usuarioModel->setSobrenome(trim($_POST['sobrenome_registrar']));
		$this->usuarioModel->setEmail(trim($_POST['email_registrar']));
		$this->usuarioModel->setSenha(trim($_POST['senha_registrar']));
		
		//Trata a data do nascimento para o formato do MySQL.
		$data = str_replace('/', '-', $_POST['data_nasc_registrar']);
		$timestamp = strtotime($data);
		$dataNascimento = date("Y-m-d", $timestamp);
		$this->usuarioModel->setDataNascimento($dataNascimento);
		
		$this->usuarioModel->salvar();
	}
	
	/**
	 * Realiza a a��o de login do usu�rio no sistema.
	 */
	public function loginUsuarioAction()
	{
		$email =   strtolower(trim($_POST['email_login']));
		$senha =   trim($_POST['senha_login']);
			
		$this->usuarioModel->entrar($email, $senha);
	}
	
	/**
	 * Realiza a a��o de alterar cadastro do usu�rio.
	 * @param bool $senhaMudou Flag que indica se o usu�rio entrou com uma nova senha.
	 */
	public function alterarUsuarioAction($senhaMudou)
	{
		$this->usuarioModel->setNome(trim($_POST['nome_novo']));
		$this->usuarioModel->setSobrenome(trim($_POST['sobrenome_novo']));
		$this->usuarioModel->setEmail(trim($_POST['email_novo']));
		
		//Trata a data do nascimento para o formato do MySQL.
		$data = str_replace('/', '-', $_POST['data_nasc_nova']);
		$timestamp = strtotime($data);
		$dataNascimento = date("Y-m-d", $timestamp);
		$this->usuarioModel->setDataNascimento($dataNascimento);
		
		if ($senhaMudou == true)
		{
			$this->usuarioModel->setSenha(trim($_POST['senha_nova']));
		}
		
		$this->usuarioModel->alterar($senhaMudou);		
	}
	
	/**
	 * Realiza a a��o de deletar o cadastro do usu�rio.
	 */
	public function excluirUsuarioAction()
	{
		$this->usuarioModel->excluir();
	}
	
	/**
	 * Realiza a a��o de logout do usu�rio.
	 */
	public function logoutUsuarioAction()
	{
		$this->usuarioModel->sair();
	}
	
	/**
	 * Verifica se a senha digitada corresponde � cadastrada.
	 * Usado para alterar o cadastro de usuario e confirmar a senha atual.
	 */
	public function verificaSenhaAction($senha)
	{			
		session_start();
		$this->usuarioModel->verificaSenha($_SESSION['id'], $senha);
	}
	
	/**
	 * Verifica se o endere�o de email digitado est� dispon�vel.
	 * @param int $id O id do usu�rio.
	 * @param string $email O email do usu�rio.
	 */
	public function verificaEmailAction($id, $email)
	{
		$this->usuarioModel->verificaEmail($id, $email);
	}
	
	
	/**
	 * Imprime os dados do usu�rio.
	 */
	public function exibeDadosUsuarioAction()
	{
		$this->usuarioView->imprimeDadosUsuario();
	}
	
	/**
	 * Imprime o nome completo do usu�rio.
	 */
	public function exibeNomeCompletoUsuarioAction()
	{
		$this->usuarioView->imprimeNomeCompleto();
	}
	
	/**
	 * Retorna o objeto UsuarioModel com os dados do usu�rio.
	 */
	public function getUsuarioModel()
	{
		return $this->usuarioModel;
	}
	
	/**
	 * Define o objeto UsuarioModel.
	 * @param UsuarioModel $usuarioModel o objeto UsuarioModel.
	 */
	public function setUsuarioModel($usuarioModel)
	{
		$this->usuarioModel = $usuarioModel;
	}
}