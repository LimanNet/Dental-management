<?php

require_once( "../classes/Patient.php" );
require_once( "../classes/Calendar.php" );

new CalendarWork();
class CalendarWork{
		
	private $id		= null;
	private $title	= null;
	private $start	= null;
	private $end	= null;
	private $type	= null;
	private $dayDelta = null;
	private $minuteDelta = null;
	private $op		= null;
	private $idPatient		= null;
	private $idDoctor		= null;
		
	function __construct(  ){
		
		$this->id			= isset($_POST['id'])			? $_POST['id'] : '';
		$this->title		= isset($_POST['title'])		? $_POST['title'] : null;
		$this->start		= isset($_POST['start'])		? $_POST['start'] : '';
		$this->end			= isset($_POST['end'])			? (new DateTime($_POST['end']))->format('Y-m-d H:i:s') : '';
		$this->type			= isset($_POST['type'])			? $_POST['type']: '';
		$this->dayDelta 	= isset($_POST['dayDelta'])		? $_POST['dayDelta']: '';
		$this->minuteDelta 	= isset($_POST['minuteDelta']) 	? $_POST['minuteDelta'] : '';
		$this->op			= isset($_REQUEST['op'])		? mysql_real_escape_string($_REQUEST['op']) : '';
		$this->idPatient 	= isset($_POST['idPatient']) 	? $_POST['idPatient'] : '';
		$this->idDoctor 	= isset($_POST['idDoctor']) 	? $_POST['idDoctor'] : '';
		
		$this->option();
		
		
	}
	function option(){
		switch ($this->op) {
	
			case 'addEvent':					// Создание приёма
				$this->addEvent();
			break;
			case 'editDropEvent':			// Перенесение приёма на другую дату и время
				$this->editDropEvent();
			break;
	
			case 'editResizeEvent':			// Изменение времени события
				$this->editResizeEvent();
			break;
			case 'getAllEvents':			// Вывод всех событий
				$this->getAllEvents();
			break;
			case 'removeEvents':
				$this->removeEvents();
			break;
			case 'sessionStart':			// Запуск события
				$this->sessionStart();
			break;
			case 'sessionEnd':				// Остановка события
				$this->sessionEnd();
			break;
			case 'searhByLetter':
				$this->searhByLetter();
			break;
			default:
				return;
		}
	}


function addEvent(){
	
	$insert = new Calendar($_POST);
	$insert = $insert->insert();
	if($insert){
		//echo "INSERT SUCCESS!!!".$insert;
	}
	
}

function getAllEvents(){
	
	$allEvents = new Calendar();
	$allEvents = $allEvents->getAll();
	echo $allEvents;
	$allEvents = null;
	return;
	
}

	function editDropEvent(){
				
		$data = array(
			'id' => $this->id,
			'dayDelta' => $this->dayDelta,
			'minuteDelta' => $this->minuteDelta
		);
		
		$editDrop = new Calendar($data);
		$editDrop = $editDrop->editDrop();
		
		if($editDrop){echo $editDrop;}
		
	}

	function editResizeEvent(){
	
		$data = array(
			'id' => $this->id,
			'dayDelta' => $this->dayDelta,
			'minuteDelta' => $this->minuteDelta
		);
		
		$editResize = new Calendar($data);
		$editResize = $editResize->editResize();
		
		if($editResize){echo $editResize;}
	
	}
	function searhByLetter(){
		$letters = isset($_POST["letters"]) ? mysql_real_escape_string($_POST['letters']) : null;
	
	
		$patient = new Patient();
		$listPatients = $patient->searhByLetter($letters);
	
		if($listPatients==null){echo "Запрос не найден!";}
	
		echo '<ul>';
		foreach($listPatients as $param=>$value){
			echo '<li class="listPatient" id="pat'.$value['id'].'" onclick="selectPatient('.$value['id'].',\''.$value['familyName'].'\')">'.$value['familyName'].' '.$value['firstName'].' '.$value['patronymic'].'</li>';
		}
		echo '</ul>';
		return;
		
	}
	function removeEvents(){
		$data = array(
			"id" => $this->id
		);
		print_r($data);
		$remove = new Calendar($data); 
		$remove = $remove->remove();
		
		if($remove){echo $remove;}
	}
	function sessionStart(){
		try{
			
			$data = array(
				'id' => $this->id,
				'idPatient' => $this->idPatient,
				'idDoctor' => $this->idDoctor,
				'start' => $this->start,
				'end' => $this->end
			);
			
			$sessionStart = new Calendar($data);
			$sessionStart = $sessionStart->start();
			
			echo $sessionStart;
			
		}catch(Except $e){
			die( "Error: " . $e->getMessage() );
		}
		
		
	}
	function sessionEnd(){
		try{
			
			$data = array(
				'id' => $this->id,
				'idPatient' => $this->idPatient,
				'idDoctor' => $this->idDoctor,
				'start' => $this->start,
				'end' => $this->end
			);
			print_r($data);
			$sessionEnd = new Calendar($data);
			$sessionEnd = $sessionEnd->end();
			
			echo $sessionEnd;
			
			
		}catch(Except $e){
			die( "Error: " . $e->getMessage() );
		}
		
		
	}
}
?>
