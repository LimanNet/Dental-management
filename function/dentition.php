<?php


require_once( '../classes/Tooth.php' );
require_once( '../classes/Dentition.php' );

new DentinationFunction($_REQUEST);

class DentinationFunction{
	
	private $session = null;
	private $idDoctor = null;
	private $idPatient = null;
	private $idTooth = null;
	private $op = null;			// Операция над зубом
	
	private $works = null;
	private $diagnosis = null;
	
	private $id_state = null;		// Состояние зуба
	private $part = null;		// Часть зыба
	
	function __construct( $data=array() ){
		
		//print_r($data);
		
		$this->session = isset($data['session']) ? $data['session'] : null;
		$this->idDoctor = isset($data['idDoctor']) ? $data['idDoctor'] : null;
		$this->idPatient = isset($data['idPatient']) ? $data['idPatient'] : null;
		$this->idTooth =  isset($data['idTooth']) ? $data['idTooth'] : null;
		$this->works = isset($data['works']) ? $data['works'] : null;
		$this->diagnosis = isset($data['diagnosis']) ? $data['diagnosis'] : null;
		
		$this->id_state = isset($data['id_state']) ? $data['id_state'] : null;
		$this->part = isset($data['part']) ? $data['part'] : null;
		
		$this->op = isset($data['op']) ? $data['op'] : null;
		
		switch($this->op){
			case 'stateTooth':
				$this->stateTooth();
			break;
			case 'setWorksIdTooth':
				$this->setWorksIdTooth();
			break;
			case 'getWorksIdTooth':
				$this->getWorksIdTooth();
			break;
			
			case 'getSelectTooth':
				$this->getSelectTooth();
			break;
			case 'setStateTooth':
				$this->setStateTooth();
			break;
			case 'setDiagnosisIdTooth':
				$this->setDiagnosisIdTooth();
			break;
			default:
				return;
		}
		
	}
	
	function getSelectTooth(){
			$this->getStateTooth();
	}
	
	function setStateTooth(){
		$data = array(
			'session' => $this->session,
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth,
			$this->part => $this->id_state
		);
		$res = new Dentition($data);
		$res = $res->setStateTooth();
		
		$this->getSelectTooth();
	}
	
	function getStateTooth(){
		$result = null;
		
		$data = array(
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth,
			'session' => $this->session
		);
		
		$dentition = new Dentition($data);
		$getStateTooth = $dentition->getStateTooth();
		
		require_once ( '../classes/catalog/ToothState.php' );
		$toothState = new ToothState();
		$toothState = $toothState->getAll();
				
			// Вывод параметра зуба
		echo '<table>';
		echo '<caption><h4>Состояние зуба</h4></caption>';
		if( $getStateTooth==null ){
			echo '';
		}else{
			// Поиск нужного зуба
			foreach( $getStateTooth as $par=>$val ){
				if($par==$this->idTooth){
					$result = $val;
				}
			}
			if($result!=null){
				foreach( $result as $par=>$val ){
					foreach($toothState as $resSt=>$valSt){
						if($val==$valSt['id']){
							echo '
								<tr>
									<td>
										<tr>
											<td>'.$par.'</td>
										</tr>
										<tr>
											<td style="background:'.$valSt['color'].';">'.$valSt['name'].'</td>
										</tr>
									
									</td>
								</tr>
							';
						}
					}
					
				}
			}else{
				echo '<tr><td></td><td></td><td></td></tr>';
			}
		}
		echo '</table>';
		
		$getWorksIdTooth = $this->getWorksIdTooth();
		echo '<table>';
			echo '<caption><h4>Работы</h4></caption>';
			// Вывод работ над зубом
			if($getWorksIdTooth!=null){
				
				foreach( $getWorksIdTooth as $par=>$val ){
					
					echo '<tr><td>'.$val.'</td><td>del</td></tr>';
					
				}
				
			}else{
				echo '<tr><td></td><td></td><td></td></tr>';
			}
		echo '</table>';
		
		$getDiagnosisIdTooth = $this->getDiagnosisIdTooth();
		echo '<table>';
			echo '<caption><h4>Диагноз</h4></caption>';
			// Вывод работ над зубом
			if($getDiagnosisIdTooth!=null){
				foreach( $getDiagnosisIdTooth as $par=>$val ){
					echo '<tr><td>'.$par.'</td><td>'.$val.'</td><td>del</td></tr>';
				}
			}else{
				echo '<tr><td></td><td></td><td></td></tr>';
			}
			echo '</table>';
		
	}
	
	function setWorksIdTooth(){
		$data = array(
			'session' => $this->session,
			'idDoctor' => $this->idDoctor,
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth,
			'works' => $this->works
		);
		
		$dentition = new Dentition($data);
		$setWorksIdTooth = $dentition->setWorksIdTooth();
		
		$this->getWorksIdTooth();
	}
	
	function getWorksIdTooth(){
		$data = array(
			'session' => $this->session,
			'idDoctor' => $this->idDoctor,
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth,
			'works' => $this->works
		);
		
		$dentition = new Dentition($data);
		//var_dump( $dentition->getWorksTooth() );
		$getWorksIdTooth = $dentition->getWorksIdTooth();
		//var_dump( $dentition->getWorksIdTooth() );
		return $getWorksIdTooth;
	}
	
	function getDiagnosisIdTooth(){
		$data = array(
			'session' => $this->session,
			'idDoctor' => $this->idDoctor,
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth
		);
		
		$dentition = new Dentition($data);
		//var_dump( $dentition->getDiagnosisTooth() );
		$getDiagnosisIdTooth = $dentition->getDiagnosisIdTooth();
		//var_dump( $dentition->getDiagnosisIdTooth() );
		return $getDiagnosisIdTooth;
	}
	
	function setDiagnosisIdTooth(){
		$data = array(
			'session' => $this->session,
			'idDoctor' => $this->idDoctor,
			'idPatient' => $this->idPatient,
			'idTooth' => $this->idTooth,
			'diagnosis' => $this->diagnosis
		);
		
		$dentition = new Dentition($data);
		$setDiagnosisIdTooth = $dentition->setDiagnosisIdTooth();
		
		$this->getDiagnosisIdTooth();
		
	}
	
}
?>