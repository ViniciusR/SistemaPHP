<?php
include_once '../config.php';
/*Just for your server-side code
 * O HTML com a codificacao UTF-8 exibe os caracteres especiais corretamente,
* mas o PHP nao.
*/
header('Content-Type: text/html; charset=ISO-8859-1');
//include ROOT.'/public_html/header.php';
require_once ROOT.'/controller/UsuariosController.php';
session_start();

	if (!isset($_SESSION['logado']) || !$_SESSION['logado'])
	{
		header('Location: ..\login');
	}

	
$usuarioModel;
$usuarioController;
	
	if (isset($_GET['id']) && isset($_SESSION['id']))
	{
		$usuarioModel = new UsuarioModel();
		
		if ($_GET['id'] != $_SESSION['id'])
		{
			header('Location: area_usuario.php?id='.$_GET['id']);
		}
		
		$usuarioModel->getUsuario($_GET['id']);
		$usuarioController = new UsuariosController($usuarioModel);
		
		if (isset($_POST['nome_novo']) && isset($_POST['sobrenome_novo']) && isset($_POST['email_novo']) 
			&& isset($_POST['senha_atual']))
		{
			if (!empty($_POST['senha_nova']))
			{
				$usuarioController->alterarUsuarioAction(true);
			}
			else
			{
				$usuarioController->alterarUsuarioAction(false);
			}
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alterar cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Vinicius Silva">
    <meta name="language" content="pt"/>
    <meta name="location" content="br"/>
    <!-- CSS -->
    <link href="..\public_html/css/meuestilo.css" rel="stylesheet" media="screen">
</head>

<body>

<div class="container">
	<form id="formAlterarCadastro" name="formAlterarCadastro" class="form-registrar" action="" method="post">
		<fieldset>
				<legend>Alterar cadastro</legend>
					<div class="name-group">
						<div class="input-group" style="float: left;">
							<label for="nome_novo">Nome</label>
							<input id="nome_novo" name="nome_novo" placeholder="Nome" value="<?php echo $usuarioModel->getNome();?>" type="text" style="width: 136px; margin-right: 11px;">
						</div>
						<div class="input-group">
							<input id="sobrenome_novo" name="sobrenome_novo"placeholder="Sobrenome" value="<?php echo $usuarioModel->getSobrenome();?>" type="text" style="width: 136px; margin-top: 25px;">
						</div>
					</div>
					<div class="input-group">
						<label for="data_nasc_nova">Data de nascimento</label>
						<input id="data_nasc_nova" name="data_nasc_nova" placeholder="dd/mm/aaaa" value="<?php echo $usuarioModel->getDataNascimento();?>" type="text">
					</div>
					<div class="input-group">
						<label for="cpf_novo">CPF</label>
						<input id="cpf_novo" name="cpf_novo" type="text">
					</div>
					
					<div class="input-group">
						<label for="email_novo">E-mail</label>
						<input id="email_novo" name="email_novo" value="<?php echo $usuarioModel->getEmail();?>" type="text">
					</div>
					<div class="input-group">
						<label for="senha_atual">Senha atual</label>
						<input id="senha_atual" name="senha_atual" type="password">
					</div>
					<div class="input-group">
						<label for="senha_nova">Senha nova</label>
						<input id="senha_nova" name="senha_nova" type="password">
					</div>
					<div class="input-group">
						<label for="confirmar_senha_nova">Confirme a senha nova</label>
						<input id="confirmar_senha_nova" name="confirmar_senha_nova" type="password">
					</div>
					
					
					<div>
  						<span class="msg-erro" id="erro_login"></span>
  					</div>
  												
					<div>
						<button type="submit" class="botao-azul" style="float: right;">Alterar</button> 
					</div>
					
							
  					<div style="float: right; margin-right: 20px">
						<a href="area_usuario.php?id=<?php echo $_GET['id'];?>"><button class="botao-padrao" type="button">Cancelar</button> </a>
					</div>
					
			</fieldset>
	</form>
	
	<footer>&copy; Vinicius Silva 2014</footer>
</div>


	
	
	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/jquery.validate.js" ></script>
	<script type="text/javascript" src="..\public_html/js/validar_alteracao_usuario.js" charset="ISO-8859-1"></script>
	<script src="http://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	
	
	<script type="text/javascript">
	 	$(document).ready(function(){
	 	//0: apenas numeros.
	 	//9: apenas numeros, mas opcional.
	 	//#: apenas numeros, mas "recursive".
	 	//A: numeros e letras.
	 	//S: apenas letras.
	 	//mask('0#', {maxlength: false});: sem mascara, mas permite apenas numeros.
	 	$('#cpf_novo').mask('000.000.000-00');
 		$('#data_nasc_nova').mask('00/00/0000'); 
 		});
	</script>
</body>
</html>
