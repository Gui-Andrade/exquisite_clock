<?php
	session_start();
	include("../../external.php");
	include("../inc/db.php");
	include("../inc/functions.php");
	include("../inc/myerrorhandler.php");

	$DB = new DB();

	include("package.php");

	$obj = new Tag();
	$obj->truncate();
	
	// Titulo para o teste
	function testTitle($title){
		echo "<h1>$title</h1>";
	}
	
	//Lista identificadores do relacionamento ClockTag
	function listClockTag($clockId){
		echo "============================<br/>List CLOCK TAG: <br/>";
		$obj = new ClockTag();
		$all = $obj->loadByClockId($clockId);
		for ($i = 0; $i < sizeof($all); $i++) {
			$x = $all[$i];
			echo "[".$x->getClockId()."] ".$x->getTagId()."<br/>";
		}	
	}
	function createTag($tag){
		$obj = new Tag();
		$obj->setTag($tag);
		$obj->storeObj();
	}
	// Lista tags e seus IDs
	function listTagIds(){
		echo "============================<br/>List TAG: <br/>";
		$obj = new Tag();
		$all = $obj->loadAll("id");
		for ($i = 0; $i < sizeof($all); $i++) {
			$x = $all[$i];
			echo $i.") [".$x->getId()."] ".$x->getTag()."<br/>";
		}	
	}
	// Lista as tags de um determinado clocl (imagem)
	function listTagOfClock($clockId){
		echo "============================<br/>List TAG of Clock ID $clockId : <br/>";
		$obj = new ClockTag();
		$all = $obj->loadTagsByClockId($clockId);
		for ($i = 0; $i < sizeof($all); $i++) {
			$x = $all[$i];
			echo $i.") [".$x->getId()."] ".$x->getTag()."<br/>";
		}	
		
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

	// Se a tag j� existe, a cria��o � ignorada
	createTag("cinema");
	createTag("comida");
	createTag("verde");
	createTag("filme");
	createTag("hist�ria");
	createTag("aventura");
	createTag("caf�");

	// Reconhecimento da tag � NAO CASE SENSITIVE
	createTag("CiNemA");
	createTag("cOMiDA");
	createTag("VERDE");
	createTag("filME");
	createTag("Hist�ria");
	createTag("AveNTURA");
	createTag("CaF�");
	testTitle("Inclus�o de TAGs");
	listTagIds();
	
	// ---------------------------------------- CLOCK
	$clock = new Clock();
	
	$clock->load(20);
	$tags = array("antena","verde","foto","casa","aventura","desenho");
	// ap�s a cria��o ou edi��o de um aimagem de clock
	// deve-se armazenar as tags associadas da seguinte forma
	$ct = new ClockTag();
	$ct->storeTags($clock->getId(),$tags); // cria as tags inexistentes e associa todas � imagem	
	
	testTitle("Associa��o de TAGs � uma imagem");
	listTagIds();
	listClockTag($clock->getId());
	listTagOfClock($clock->getId());
	
	// Testa exclus�o de uma tag; deve-se verificar se os registros referente 
	// � esta tag na tabela de relacionamento ClockTag foram excluidos
	$obj = new Tag();
	$obj->loadByTag("aventura");
	$obj->del();

	testTitle("Exclus�o da TAG 'aventura'");
	listClockTag($clock->getId());
	listTagOfClock($clock->getId());


	// Testa a elimina��o de uma tag apenas de uma imagem
	$tags = array("antena","verde","foto","casa");
	// ap�s a cria��o ou edi��o de um aimagem de clock
	// deve-se armazenar as tags associadas da seguinte forma
	$ct = new ClockTag();
	$ct->storeTags($clock->getId(),$tags); // cria as tags inexistentes e associa todas � imagem	
	testTitle("Novas associa��es de TAGs � imagem - foi retirada a associ��o com 'desenho'");
	listClockTag($clock->getId());
	listTagOfClock($clock->getId());
	
	
	
//	$clock->del();
//	listClockTag(339);
	
	/**
	 * Salvar clock
	 * Insere tags (com IGNORE)
	 * Insere clock-tag (clockId + select tag where tag IN)
	 */
?>
	