<?php
	include("../inc/common.php");
	
	if(getVar("id") == 1){
		$error = toHtmlEnt("N�o � permitido excluir o usu�rio de Adminsitra��o 'ROOT'.");
		restricError("list.php",0,$error);
		exit;
	}
	$user = new User("","","");
	$user->del(getVar("id"));
	
	header("location: list.php");

?>
