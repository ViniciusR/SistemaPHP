<?php
include_once '../config.php';
/*Just for your server-side code
* O HTML com a codificacao UTF-8 exibe os caracteres especiais corretamente,
* mas o PHP nao.
*/
header('Content-Type: text/html; charset=ISO-8859-1');
//include ROOT.'/public_html/header.php';
session_start();
require_once ROOT.'/controller/UsuariosController.php';


  $usuarioModel;
  
  if (!isset($_SESSION['logado']) || !$_SESSION['logado'])
  {
  	//redirecionar para pagina de login se não estiver logado.
  	header('Location: ..\login');
  }
  
  if (isset($_GET['id']) && isset($_SESSION['id']))
  {
  	//if ($_GET['id'] == $_SESSION['id'])
  	//{
  		$usuarioModel = new UsuarioModel();
  		$usuarioModel->getUsuario($_GET['id']);
  		$usuarioController = new UsuariosController($usuarioModel);
  	/*}
  	else
  	{
  		//"Voce nao esta autorizado a visualizar esta pagina."
  	}*/
  }
?>

<!DOCTYPE html>
<html>
<head>
	<?php			
		if ($_GET['id'] == $_SESSION['id'])
		{ ?>
			<title>Bem-vindo, <?php echo $_SESSION['nome'];?></title>			
		<?php 
		} else
			 ?>
			<title><?php $usuarioController->exibeNomeCompletoUsuarioAction();?></title>		 		
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Vinicius Silva">
    <meta name="language" content="pt"/>
    <meta name="location" content="br"/>
    <!-- estilo -->
    <link href="..\public_html/css/meuestilo.css" rel="stylesheet" media="screen">    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
</head>

<body>
	<div class="container">
		<?php			
			if ($_GET['id'] == $_SESSION['id'])
			{
				echo '<div class="header-usuario">';
				echo '<h1 style="float: left;">Bem-vindo, '. $_SESSION['nome'].'</h1>';  
				echo '<a href="/SistemaPHP/index.php?action=logout" class="botao-vermelho botao-sair">Sair</a>';
				echo '</div>';
			}
			else
			{
				echo '<h1>'; 
					$usuarioController->exibeNomeCompletoUsuarioAction();
				echo '</h1>';
			}
			echo '<h3>Dados do usuário</h3>';
			$usuarioController->exibeDadosUsuarioAction(); 
		?>				
		
		<br>
		
		<!-- Exibe o menu de opcoes se o usuario estiver na sua propria area do usuario. -->
		<?php 
		if ($_GET['id'] == $_SESSION['id'])
  			{ ?>
			<div>
			<h4>Opções</h4>
				<div style="float: left">
					<a href="alterar_cadastro.php?id=<?php echo $_SESSION['id'];?>">Alterar cadastro</a>
				</div>
				<div style="float: left; margin-left: 10px">
					<a href="#" onclick="excluiUsuario(<?php echo $_GET['id'];?>)">Excluir cadastro</a>
				</div>
			</div>
			<br>
		<?php } ?>
		
		
		
		<!-- <hr> -->
		<footer>
        	<p>&copy; Vinicius Silva 2014</p>
    	</footer>
	</div>
	
			
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="..\public_html/js/bootstrap.min.js"></script>
	<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.11.1/jquery.validate.js" ></script>	
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	
	<script>
	  function excluiUsuario($id) {
	    $("#dialog-confirm" ).dialog({
	      resizable: false,
	      height:250,
	      width: 500,
	      modal: true,
	      buttons: {
	        "Excluir": function() {
	        	$.ajax({
					type: "GET",
					url: "../lib/excluirUsuario.php?id=" + $id,
					success: function()
					{
						window.location = "../index.php";
					}
				});
	        },
	        "Cancelar": function() {
	          $( this ).dialog("close");
	        }
	      }
	    });
	  }
  </script>
</head>
<body>
 
<div hidden="true" id="dialog-confirm" title="Excluir conta?">
  <p><span style="float:left; margin:0 7px 20px 0;"></span>O seu cadastro será excluído permanentemente, esta ação não poderá ser desfeita.</p>
</div>
	
</body>
</html>