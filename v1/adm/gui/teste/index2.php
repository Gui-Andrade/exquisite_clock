<?php
	session_start();
	include("../../external.php");
	include("../inc/db.php");
	include("../inc/functions.php");
	include("../inc/myerrorhandler.php");

	$DB = new DB();

	include("package.php");

	
	function createTag($tag){
		$obj = new Tag();
		$obj->setTag($tag);
		$obj->storeObj();
	}


	
	// ---------------------------------------- Insere TAGS
	// Para criar uma tag isoladamente 
	createTag("cinema");
	createTag("comida");
	createTag("verde");
	createTag("filme");
	createTag("hist�ria");
	createTag("aventura");
	createTag("caf�");

	
	// ---------------------------------------- CLOCK
	$clock = new Clock();
	
	$clock->load(20);
	$tags = array("antena","verde","foto","casa","aventura","desenho");
	// ap�s a cria��o ou edi��o de um aimagem de clock
	// deve-se armazenar as tags associadas da seguinte forma
	$ct = new ClockTag();
	$ct->storeTags($clock->getId(),$tags); // cria as tags inexistentes e associa todas � imagem	
	
		
	// Testa exclus�o de uma tag; deve-se verificar se os registros referente 
	// � esta tag na tabela de relacionamento ClockTag foram excluidos
	$obj = new Tag();
	$obj->loadByTag("aventura");
	$obj->del();


	// Testa a elimina��o de uma tag apenas de uma imagem
	$tags = array("antena","verde","foto","casa");
	// ap�s a cria��o ou edi��o de um aimagem de clock
	// deve-se armazenar as tags associadas da seguinte forma
	$ct = new ClockTag();
	$ct->storeTags($clock->getId(),$tags); // cria as tags inexistentes e associa todas � imagem	


?>
	