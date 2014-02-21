<?php
include "config.php";

function getConexao(){
	// Create connection
	$mysqli = mysqli_connect(SERVIDOR, BD_USUARIO, BD_SENHA, BD_NOME);
	
	// Check connection
	if (mysqli_connect_errno())
	{
	  	echo "Erro ao conectar com o MySQL: " . mysqli_connect_error();
	}
	  
	  return $mysqli;
}
?>