<?php
include_once '../config.php';
/*Just for your server-side code
* O HTML com a codificacao UTF-8 exibe os caracteres especiais corretamente,
* mas o PHP nao.
*/
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
require_once ROOT.'/controller/UsuariosController.php';

if (isset($_SESSION['logado']) && $_SESSION['logado'])
{
	header('Location: public_html/area_usuario.php?id='.$_SESSION['id']);
}

$usuarioController = new UsuariosController(new UsuarioModel());

	if (isset($_POST['nome_registrar']) && isset($_POST['sobrenome_registrar']) && 
		isset($_POST['email_registrar']) && isset($_POST['senha_registrar']) && 
		isset($_POST['data_nasc_registrar'])) 
	{
		$usuarioController->registrarUsuarioAction();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registrar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Util para telas menores, como smarthones. Possibilita a melhor visualizacao do website em diferetes resolucoes telas.-->
	<link href="public_html/css/meuestilo.css" rel="stylesheet" media="screen">
</head>

<body>
<div class="container">
	<form id="formRegistrar" name="formRegistrar" class="form-registrar" action="" method="post">
		<fieldset>
				<legend>Crie uma conta</legend>
					<div class="name-group">
						<div class="input-group" style="float: left;">
							<label for="nome_registrar">Nome</label>
							<input id="nome_registrar" name="nome_registrar" placeholder="Nome" type="text" style="width: 136px; margin-right: 11px;">
						</div>
						<div class="input-group">
							<input id="sobrenome_registrar" name="sobrenome_registrar"placeholder="Sobrenome" type="text" style="width: 136px; margin-top: 25px;">
						</div>
					</div>
					<div class="input-group">
						<label for="data_nasc_registrar">Data de nascimento</label>
						<input id="data_nasc_registrar" name="data_nasc_registrar" placeholder="dd/mm/aaaa" type="text">
					</div>
					<div class="input-group">
						<label for="cpf_registrar">CPF</label>
						<input id="cpf_registrar" name="cpf_registrar" type="text">
					</div>
					
					<div class="input-group">
						<label for="telefone_registrar">Telefone</label>
						<input id="telefone_registrar" name="telefone_registrar" type="text">
					</div>
					
					<div class="input-group">
						<label for="email_registrar">E-mail</label>
						<input id="email_registrar" name="email_registrar" type="text">
					</div>
					<div class="input-group">
						<label for="senha_registrar">Senha</label>
						<input id="senha_registrar" name="senha_registrar" type="password">
					</div>
					<div class="input-group">
						<label for="confirmar_senha_registrar">Confirmar senha</label>
						<input id="confirmar_senha_registrar" name="confirmar_senha_registrar" type="password">
					</div>
					
					
					<div>
  						<span class="msg-erro" id="erro_login"></span>
  					</div>
  							
					<div>
						<button type="submit" id="submit_login" class="botao-azul" style="float: right;">Criar conta</button> 
					</div>
			</fieldset>
	</form>
	
	<footer>&copy; Vinicius Silva 2014</footer>
</div>


<!-- JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
	<script src="http://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="public_html/js/validar_registro.js" charset="ISO-8859-1"></script>
	
	
	<script type="text/javascript">
	 	$(document).ready(function(){
	 	//0: apenas numeros.
	 	//9: apenas numeros, mas opcional.
	 	//#: apenas numeros, mas "recursive".
	 	//A: numeros e letras.
	 	//S: apenas letras.
	 	//mask('0#', {maxlength: false});: sem mascara, mas permite apenas numeros.
 		$('#data_nasc_registrar').mask('00/00/0000'); 
 		$('#telefone_registrar').mask('(00) 0000-0000');
 		$('#cpf_registrar').mask('000.000.000-00');
 		});
	</script>
</body>
</html>