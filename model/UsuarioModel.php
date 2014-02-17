<?php
require_once ROOT.'/conexao.php';

/**
 * Classe que define o modelo do usu�rio.
 * @author Vinicius Silva
 *
 */
class UsuarioModel
{
	private $id;
	private $nome;
	private $sobrenome;
	private $email;
	private $senha;
	private $dataNascimento;
	
	/**
	 * Retorna os dados de um usu�rio do banco de dados a partir de seu id.
	 * @param int $id O id do usu�rio.
	 */
	public function getUsuario($id)
	{
		$mysqli = getConexao();
		$sqlSelect = $mysqli->prepare("SELECT * FROM usuarios WHERE id = ?");
		$sqlSelect->bind_param('i', $id);
		$sqlSelect->execute();						
		$sqlSelect->bind_result($this->id, $this->nome, $this->sobrenome, $this->email, $this->senha, $this->dataNascimento);
		$sqlSelect->fetch();
		$sqlSelect->close();
	}

	/**
	 * Cadastra um novo usu�rio, salvando no banco de dados.
	 */
	public function salvar()
	{
		$senhaBD = hash('sha512', $this->senha);		
		$mysqli = getConexao();
		
		$sqlInserir = $mysqli->prepare("INSERT INTO usuarios(nome, sobrenome, email, senha, data_nascimento) VALUES (?, ?, ?, ?, ?)");
		$sqlInserir->bind_param('sssss', $this->nome, $this->sobrenome, $this->email, $senhaBD, $this->dataNascimento);
		
		if ($sqlInserir->execute())
		{
			session_start();
			$this->id = $mysqli->insert_id;	
			$_SESSION['nome'] = $this->nome;
			$_SESSION['sobrenome'] = $this->sobrenome;
			$_SESSION['logado'] = true; //Flag que vai verificar se o usuario ja esta logado.
			$_SESSION['id'] = $this->id;
			$sqlInserir->close();
			header('Location: public_html/area_usuario.php?id='.$this->id);
		}
		else
		{
			echo "Erro ao salvar usu�rio no banco de dados. ".$sqlInserir->error();
		}
	}
	
	/**
	 * Faz o login do usu�rio.
	 * @param string $email O email do usu�rio.
	 * @param string $senha	A senha do usu�rio.
	 */
	public function entrar($email, $senha)
	{
		$senhaBD = hash('sha512', $senha);
		$mysqli = getConexao();
		$sqlLogin = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
		$sqlLogin->bind_param('ss', $email, $senhaBD);
		$sqlLogin->execute();
		$sqlLogin->store_result();
		
				
		if ($sqlLogin->num_rows)
		{
			
			$sqlLogin->bind_result($this->id, $this->nome, $this->sobrenome, $this->email, $this->senha, $this->dataNascimento);
			$sqlLogin->fetch();
				
			session_start();
			$_SESSION['nome']  =  $this->nome;
			$_SESSION['sobrenome']  =  $this->sobrenome;
			$_SESSION['logado'] = true; //Flag que vai verificar se o usuario ja esta logado.
			$_SESSION['id'] = $this->id;
			echo $this->id;
			$sqlLogin->close();
		}
		else
		{
			echo "erro"; //Erro ao acessar conta do usu�rio.
		}
	}
	
	/**
	 * Altera dados do usu�rio no banco de dados.
	 * @param bool $senhaMudou flag que identifica se o usuario digitou uma nova senha.
	 */
	public function alterar($senhaMudou)
	{
		$sqlUpdate;
		$mysqli = getConexao();
		$sqlUpdate;
		
		if ($senhaMudou == true)
		{
			$senhaBD = hash('sha512', $this->senha);
			$sqlUpdate = $mysqli->prepare("UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, senha = ?, data_nascimento = ? WHERE id = ?");
			$sqlUpdate->bind_param('sssssi', $this->nome, $this->sobrenome, $this->email, $senhaBD, $this->dataNascimento, $this->id);
		}
		else 
		{
			$sqlUpdate = $mysqli->prepare("UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, data_nascimento = ? WHERE id = ?");
			$sqlUpdate->bind_param('ssssi', $this->nome, $this->sobrenome, $this->email,  $this->dataNascimento, $this->id);
		}
		
		$sqlUpdate->execute();
		$sqlUpdate->store_result();
		
		if ($sqlUpdate->affected_rows)
		{
			$_SESSION['nome']  =  $this->nome;
			$_SESSION['sobrenome']  =  $this->sobrenome;
			header('Location: area_usuario.php?id='.$this->id);
		}		
	}
	
	/**
	 * Exclui o usu�rio do banco de dados.
	 */
	public function excluir()
	{
		$mysqli = getConexao();
		
		$sqlExcluir =  $mysqli->prepare("DELETE from usuarios where id = ?");
		$sqlExcluir->bind_param('i', $this->id);
		$sqlExcluir->execute();
		$sqlExcluir->store_result();
		
		if ($sqlExcluir->affected_rows)
		{
			session_start();
			session_unset();
			session_destroy();
		}
	}
	
	/*
	 * Faz o logout do usu�rio.
	 */
	public function sair()
	{
		session_start();
		session_unset();
		session_destroy();
		header("Location: index.php");
		//exit();
	}
	
	
	/**
	 * Verifica se a senha digitada corresponde � cadastrada.
	 * Usado para alterar o cadastro de usuario e confirmar a senha atual.
	 */
	public function verificaSenha($id, $senha)
	{
		$senhaBD = hash('sha512', $senha);
		$mysqli = getConexao();
		$sql = $mysqli->prepare("SELECT * FROM usuarios WHERE id = ? AND senha = ?");
		$sql->bind_param('ss', $id, $senhaBD);
		$sql->execute();
		$sql->store_result();
		
		if ($sql->num_rows)
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	
	/**
	 * Verifica se o endere�o de email digitado est� dispon�vel.
	 * @param int $id O id do usu�rio.
	 * @param string $email O email do usu�rio.
	 */
	public function verificaEmail($id, $email)
	{
		$sql;
		$mysqli = getConexao();
		
		if ($id == null) //No caso de estar registrando novo usuario
		{		
			$sql = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ?");
			$sql->bind_param('s', $email);
		}
		else //No caso de estar alterando o cadastro de um usuario.
		{
			$sql = $mysqli->prepare("SELECT * FROM usuarios WHERE email = ? AND id != ?");
			$sql->bind_param('si', $email, $id);
		}	
		
		$sql->execute();
		$sql->store_result();
		
		
		if ($sql->num_rows)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	
	/**
	 * Retorna o id do usu�rio.
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Define o id do usu�rio.
	 * @param int $id o id do usu�rio.
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * Retorna o nome do usu�rio.
	 */
	public function getNome()
	{
		return $this->nome;
	}
	
	/**
	 * Define o nome do usu�rio.
	 * @param string $nome O nome do usu�rio.
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	/**
	 * Retorna o sobrenome do usu�rio.
	 */
	public function getSobrenome()
	{
		return $this->sobrenome;
	}
	
	/**
	 * Define o sobrenome do usu�rio.
	 * @param string $sobrenome O sobrenome do usu�rio.
	 */
	public function setSobrenome($sobrenome)
	{
		$this->sobrenome = $sobrenome;
	}
	
	/**
	 * Retorna o email do usu�rio.
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Define o email do usu�rio.
	 * @param string $email O email do usu�rio.
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * Retorna a senha do usu�rio.
	 */
	public function getSenha()
	{
		return $this->senha;
	}
	
	/**
	 * Define a senha do usu�rio.
	 * @param string $senha A senha do usu�rio.
	 */
	public function setSenha($senha)
	{
		$this->senha = $senha;
	}
	
	/**
	 * Retorna a data de nascimento do usu�rio.
	 */
	public function getDataNascimento()
	{
		$dataFormatada = date("d/m/Y", strtotime($this->dataNascimento));
		return $dataFormatada;
		//return $this->dataNascimento;
	}
	
	/**
	 * Define a data de nascimento do usu�rio.
	 * @param string $senha A data de nascimento do usu�rio.
	 */
	public function setDataNascimento($dataNascimento)
	{
		$this->dataNascimento = $dataNascimento;
	}
}