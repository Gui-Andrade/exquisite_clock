<?phpclass Tag extends TagRoot{ 	/* *************** Pattern constructor *************** */	function Tag(){		parent::TagRoot();	}	/* *************** Install functions *************** */	function install(){		parent::install();	}	function setTag($var){		parent::setTag(strtolower($var));	}	function del(){ 		if(toInt($this->id)>0){ 			parent::del();			$strSQL = "DELETE FROM clockTag WHERE tagId = ".$this->id .""; 			$this->DB->exe("".$this->className." :: function del(".$this->id.") - Tag del ClockTag",$strSQL); 		} 	} 	function truncate(){ 		$strSQL = "TRUNCATE tag "; 		$this->DB->exe("".$this->className." :: function truncate()",$strSQL); 	} 	function loadByTag($tag){		$strSQL = "" . 			"SELECT * " . 			"FROM ".$this->dbTable." " . 			"WHERE 1=1 " . 			"AND tag='$tag' " . 			"LIMIT 0,1"; 		$result = $this->DB->getObj("".$this->className." :: function loadByTag($tag)",$strSQL); 		$row = mysql_fetch_array($result); 		$this->setFromRow($row); 	}}?>