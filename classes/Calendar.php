<?php
require_once('../config.php');
class Calendar{

	private $id		= null;
	private $title	= null;
	private $start	= null;
	private $end	= null;
	private $minuteDelta	= null;
	private $dayDelta	= null;
	private $idDoctor	= null;
	private $idPatient	= null;
	
	function __construct( $data=array() ){
		
		if(isset($data['start'])){
			$date = new DateTime($data['start']);
			$start = $date->format('Y-m-d H:i:s');
			$this->start = $start;
		}
		if(isset($data['end'])){
			$date = new DateTime($data['end']);
			$end = $date->format('Y-m-d H:i:s');
			$this->end = $end;
		}
		
		$this->id		= isset($data['id']) ?	(int)$data['id'] : null;
		$this->title	= isset($data['title']) ? $data['title'] : null;
		$this->minuteDelta	= isset($data['minuteDelta']) ? $data['minuteDelta'] : null;
		$this->dayDelta	= isset($data['dayDelta']) ? $data['dayDelta'] : null;
		$this->type		= isset($data['type']) ? $data['type'] : null;
		$this->idDoctor		= isset($data['idDoctor']) ? $data['idDoctor'] : null;
		$this->idPatient		= isset($data['idPatient']) ? $data['idPatient'] : null;
		
	}
	
	private function DBH(){
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec("SET CHARACTER SET utf8");
		return $DBH;
	}
	
	function get(){
		$class = new Calendar();
		$fields = get_class_vars(get_class($class));
		print_r($fields);
	}
	
	function insert(){
		try{
			$DBH = $this->DBH();
		
			$sql = "
				INSERT INTO session
				(
					title,
					start,
					end,
					idDoctor,
					idPatient
				)
				VALUES
				(
					:title,
					:start,
					:end,
					:idDoctor,
					:idPatient
				);			
			";
			$STH = $DBH->prepare($sql);
			$STH->bindValue(":title", $this->title, PDO::PARAM_STR);
			$STH->bindValue(":start", $this->start, PDO::PARAM_STR);
			$STH->bindValue(":end", $this->end, PDO::PARAM_STR);
			$STH->bindValue(":idDoctor", $this->idDoctor, PDO::PARAM_INT);
			$STH->bindValue(":idPatient", $this->idPatient, PDO::PARAM_INT);
			$STH->execute();
			
			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success';}
		
			$DBH = null;
			return $result;
		}catch(PDOExeption $e){
			echo "Error!";
			file_put_contents('../Errors.txt', $e->getMessage(), FILE_APPEND);
			return $e->getMessage();
		}
	}
	
	function getAll(){
		$DBH = $this->DBH();
		$sql="
			SELECT
				id,
				title,
				start,
				end,
				idDoctor,
				idPatient
			FROM session;
		";
		$STH = $DBH->query($sql);
		$results = $STH->fetchAll();
		$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success';}
		$DBH = null;
		
		$json = Array();
		foreach($results as $row) {
			$nowTime = new DateTime('NOW', new DateTimeZone('Europe/Minsk'));
			$nowTime = $nowTime->format('Y-m-d h:i:s');
			$endTime = new DateTime($row['end']);
			$endTime = $endTime->format('Y-m-d h:i:s');
			$color = $endTime < $nowTime ? "LightGray" : false ;
			//$color = "'red'";
			
			$json[] = array(
				'id'		=> $row['id'],
				'title' 	=> $row['title'],
				'start'		=> $row['start'],
				'end'		=> $row['end'],
				'color'		=> $color,
				'allDay'	=> false,
				'idDoctor'	=>  $row['idDoctor'],
				'idPatient'	=>  $row['idPatient']
			);
		}
		
		return json_encode($json);
	}
	
	function editResize(){
		
		$DBH = $this->DBH();
		
		$sql = '
			UPDATE session SET
				end = DATE_ADD(DATE_ADD(end, INTERVAL :dayDelta DAY), INTERVAL :minuteDelta MINUTE)
			WHERE id = :id
		';
		$STH = $DBH->prepare($sql);
			$STH->bindValue(':id', $this->id, PDO::PARAM_INT);
			$STH->bindValue(':dayDelta', $this->dayDelta, PDO::PARAM_INT);
			$STH->bindValue(':minuteDelta', $this->minuteDelta, PDO::PARAM_INT);
			$STH->execute();
		
		$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success';}
		
		$DBH = null;
		
		return $result;
	}
	
	function editDrop(){

		$DBH = $this->DBH();
		$sql = '
			UPDATE session SET
				start = DATE_ADD(DATE_ADD(start, INTERVAL :dayDelta DAY), INTERVAL :minuteDelta MINUTE),
				end = DATE_ADD(DATE_ADD(end, INTERVAL :dayDelta DAY), INTERVAL :minuteDelta MINUTE)
			WHERE id = :id
		';
		$STH = $DBH->prepare($sql);
		$STH->bindValue(':id',$this->id,PDO::PARAM_INT);
		$STH->bindValue(':dayDelta',$this->dayDelta,PDO::PARAM_INT);
		$STH->bindValue(':minuteDelta',$this->minuteDelta,PDO::PARAM_INT);
		$STH->execute();
			
			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success';}
		
		$DBH = null;
		
		return $result;
	}
	
	function remove(){
		
		$DBH = $this->DBH();
		
		$sql = 'DELETE FROM session WHERE id = :id';
		
		$STH = $DBH->prepare($sql);
		$STH->bindValue(':id',$this->id,PDO::PARAM_INT);
		$STH->execute();
			
			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success: '.$this->id;}
		
		$DBH = null;
		
		return $result;
	}
	
	function start(){
		try{
			
			$nowTime = new DateTime('NOW', new DateTimeZone('Europe/Minsk'));
			$nowTime = $nowTime->format('Y-m-d H:i:s');
			
			$sql = "
				UPDATE session SET
					start = :start,
					idDoctor = :idDoctor
				WHERE id = :id				
			";
			
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':id',$this->id,PDO::PARAM_INT);
				$STH->bindValue(':idDoctor',$this->idDoctor,PDO::PARAM_INT);
				$STH->bindValue(':start',$nowTime,PDO::PARAM_STR);
				$STH->execute();
			
			$DBH = null;
			
			return $this->id;
			
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Session.start: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
	
	function end(){
		try{
			
			$nowTime = new DateTime('NOW', new DateTimeZone('Europe/Minsk'));
			$nowTime = $nowTime->format('Y-m-d H:i:s');
			
			$sql = "
				UPDATE session SET
					end = :end
				WHERE id = :id				
			";
			
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':id',$this->id,PDO::PARAM_INT);
				$STH->bindValue(':end',$nowTime,PDO::PARAM_STR);
				$STH->execute();
			
			//return;
			
			
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Session.start: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
}
?>