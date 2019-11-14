<?php
require_once( '../config.php' );
class Session{
	
	private $id = null;
	private $idPatient = null;
	private $idDoctor = null;
	private $start = null;
	private $end = null;
	private $condition = null;
	
	function __construct( $data = array() ){
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->idPatient = isset($data['idPatient']) ? $data['idPatient'] : null;
		$this->idDoctor = isset($data['idDoctor']) ? $data['idDoctor'] : null;
		$this->condition = isset($data['condition']) ? $data['condition'] : null;
		
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
		
	}
	
	private function DBH(){
		try{
			$DBH = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$DBH->exec('SET CHARACTER SET utf8');
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			return $DBH;
		}catch(PDOExeption $e){
			echo "../Errors.txt";  
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	function start(){
		try{
			
			$nowTime = new DateTime('NOW', new DateTimeZone('Europe/Minsk'));
			$nowTime = $nowTime->format('Y-m-d H:i:s');
			
			$sql = "
				INSERT INTO session
				(
					idPatient,
					idDoctor,
					start
				)
				VALUE
				(
					:idPatient,
					:idDoctor,
					:start
				);
				
			";
			
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':idPatient',$this->idPatient,PDO::PARAM_INT);
				$STH->bindValue(':idDoctor',$this->idDoctor,PDO::PARAM_INT);
				$STH->bindValue(':start',$nowTime,PDO::PARAM_STR);
				$STH->bindValue(':end',$this->end,PDO::PARAM_STR);
				$STH->execute();
			$idLast = $DBH->lastInsertId();
			return $idLast;
			
			
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Session.start: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
	
}
?>