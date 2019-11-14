<?php

new medicalInfo($_REQUEST);

class medicalInfo{
	
	$idPatient = null;
	$op = null;
	
	$Illness = null;
		
	function __construct( $data = array() ){
		
		$this->Illness = isset($data['Illness']) ? $data['Illness'] : null ;
		
		$this->idPatient = isset($data['idPatient']) ? $data['idPatient'] : null ;
		$this->op = isset($data['op']) ? $data['op'] : null ;
		$this->op( $this->op );
	
	}
	
	private op( $op ){
		switch($op){
			case 'get':
				$this->get();
			break;
			case 'set':
				$this->set();
			break;
			default:
				return;
		}
	}
	
	function getAll(){
		require_once( '../classes/Catalog/Illness.php' );
		
		$illness = new Illness();
		$illness = $illness->getAll;
		
		print_r($illness);
		
	}
	
}
?>