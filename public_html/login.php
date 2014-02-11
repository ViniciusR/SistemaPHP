<?php
/*Just for your server-side code
 * O HTML com a codificacao UTF-8 exibe os caracteres especiais corretamente,
* mas o PHP nao.
*/
header('Content-Type: text/html; charset=ISO-8859-1');

session_start();

	if (isset($_SESSION['logado']) && $_SESSION['logado'])
	{
		header('Location: public_html/area_usuario.php?id='.$_SESSION['id']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Entrar</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Util para telas menores, como smarthones. Possibilita a melhor visualizacao do website em diferetes resolucoes telas.-->
	<link href="public_html/css/meuestilo.css" rel="stylesheet" media="screen">
</head>

<body>
	<div class="login-container">
		<form id="formLogin"name="formLogin" class="form-login" action="" method="post" >
			<fieldset>
				<legend>Faça login para continuar</legend>
					<div class="input-group">
						<label class="login-label" for="email_login">E-mail</label>
						<input class="login-input" id="email_login" name="email_login"type="text">
					</div>
					<div class="input-group">
						<label class="login-label" for="senha_login">Senha</label>
						<input class="login-input" id="senha_login" name="senha_login" type="password">
					</div>
					
					<div>
  						<span class="msg-erro" id="erro_login"></span>
  					</div>
  							
					<div>
						<button type="submit" id="submit_login" style="float: right;" class="botao-azul">Entrar</button> 
					</div>
			</fieldset>
		</form>

		<div style="margin-top: 20px;">
			<a href="registrar">Não possui uma conta? Crie uma agora!</a>
		</div>
	
		<footer>&copy; Vinicius Silva 2014</footer>
	</div>
	
	
	<!-- JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/jquery.validate.js" ></script>
	<script type="text/javascript" src="public_html/js/validar_login.js" charset="ISO-8859-1"></script>
</body>
</html>