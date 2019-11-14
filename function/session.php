<?php
if( isset($_REQUEST) ){
	
	require_once('../classes/Session.php');
	new SessionFunction($_REQUEST);

}else{
	return false;
}

class SessionFunction{
	
	private $op = null;
	private $id = null;
	private $idPatient = null;
	private $idDoctor = null;
	private $start = null;
	private $end = null;
	
	
	function __construct( $data = array() ){
		
		$this->op = isset($data['op']) ? $data['op'] : null;
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->idPatient = isset($data['idPatient']) ? $data['idPatient'] : null;
		$this->idDoctor = isset($data['idDoctor']) ? $data['idDoctor'] : null;
		$this->start = isset($data['start']) ? $data['start'] : null;
		$this->end = isset($data['end']) ? $data['end'] : null;
		
		switch($data['op']){
			case 'startSession':
				$this->startSession();
			break;
			default:
				return false;
		}
		
	}
	
	function startSession(){
		try{
			
			$data = array(
				'id' => $this->id,
				'idPatient' => $this->idPatient,
				'idDoctor' => $this->idDoctor,
				'start' => $this->start,
				'end' => $this->end
			);
			//print_r($data);
			$startSession = new Session($data);
			$startSession = $startSession->start();
			
			echo $startSession;
			
			
		}catch(Except $e){
			die( "Error: " . $e->getMessage() );
		}
		
		
	}
	
	
}
?>