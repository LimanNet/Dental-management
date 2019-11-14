<?php

require_once( '../config.php' );

class Dentition{
	
	private $idSession = null;
	private $idDoctor = null;
	private $idPatient = null;
	private $idTooth = null;
	private $op = null;				// Операция над зубом
	
	private $works = null;
	private $diagnosis = null;
	
	private $id_state = null;		// Состояние зуба
	private $part = null;			// Часть зыба
	
	// Области
	
	// Десна
	private $gingiva = null;
	
	// Имплантант
	private $implant_first = null;
	private $implant_second = null;
	private $implant_thrid = null;
	
	// Канал
	private $canal_first = null;
	private $canal_second = null;
	private $canal_thrid = null;
	private $canal_fourth = null;
	private $canal_fifth = null;
	
	// Корень
	private $root_first = null;
	private $root_second = null;
	private $root_thrid = null;
	
	// Коронковая часть
	private $crown_first = null;
	private $crown_second = null;
	private $crown_thrid = null;
	private $crown_fourth = null;
	private $crown_fifth = null;
	private $crown_sixth = null;
	
	// 	Кость
	private $bone = null;
	
	// Надстройки на коронковой части
	private $add_crown = null;
	
	// Абатмент
	private $abatment = null;
	
	// Фиксирующий винт
	private $fixvint = null;
	
	
	function __construct( $data=array() ){
		$this->idSession = isset($data['session']) ? $data['session'] : null;
		$this->idDoctor = isset($data['idDoctor']) ? $data['idDoctor'] : null;
		$this->idPatient = isset($data['idPatient']) ? $data['idPatient'] : null;
		$this->idTooth =  isset($data['idTooth']) ? $data['idTooth'] : null;
		$this->works = isset($data['works']) ? $data['works'] : null;
		$this->diagnosis = isset($data['diagnosis']) ? $data['diagnosis'] : null;
		
		$this->id_state = isset($data['id_state']) ? $data['id_state'] : null;
		$this->part = isset($data['part']) ? $data['part'] : null;
		
		$this->op = isset($data['op']) ? $data['op'] : null;
		
		$this->gingiva = isset($data['gingiva']) ? $data['gingiva'] : null;
		$this->abatment = isset($data['abatment']) ? $data['abatment'] : null;
		$this->fixvint = isset($data['fixvint']) ? $data['fixvint'] : null;
	
			$this->implant_first = isset($data['implant_first']) ? $data['implant_first'] : null;
			$this->implant_second = isset($data['implant_second']) ? $data['implant_second'] : null;
			$this->implant_thrid = isset($data['implant_thrid']) ? $data['implant_thrid'] : null;
	
			$this->canal_first = isset($data['canal_first']) ? $data['canal_first'] : null;
			$this->canal_second = isset($data['canal_second']) ? $data['canal_second'] : null;
			$this->canal_thrid = isset($data['canal_thrid']) ? $data['canal_thrid'] : null;
			$this->canal_fourth = isset($data['canal_fourth']) ? $data['canal_fourth'] : null;
			$this->canal_fifth = isset($data['canal_fifth']) ? $data['canal_fifth'] : null;
	
			$this->root_first = isset($data['root_first']) ? $data['root_first'] : null;
			$this->root_second = isset($data['root_second']) ? $data['root_second'] : null;
			$this->root_thrid = isset($data['root_thrid']) ? $data['root_thrid'] : null;
	
			$this->crown_first = isset($data['crown_first']) ? $data['crown_first'] : null;
			$this->crown_second = isset($data['crown_second']) ? $data['crown_second'] : null;
			$this->crown_thrid = isset($data['crown_thrid']) ? $data['crown_thrid'] : null;
			$this->crown_fourth = isset($data['crown_fourth']) ? $data['crown_fourth'] : null;
			$this->crown_fifth = isset($data['crown_fifth']) ? $data['crown_fifth'] : null;
			$this->crown_sixth = isset($data['crown_sixth']) ? $data['crown_sixth'] : null;
	
			$this->bone = isset($data['bone']) ? $data['bone'] : null;
	
			$this->add_crown = isset($data['add_crown']) ? $data['add_crown'] : null;
	}
	
	private function DBH(){
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$DBH->exec("SET CHARACTER SET utf8");
		return $DBH;
	}
	
	function getStateTooth(){
		try{
			
			$result = null;
			
			$DBH = $this->DBH();
			$sql = "
				SELECT
					conditionTooth
				FROM session
				WHERE id = :idSession;
			";
			$STH = $DBH->prepare($sql);
				$STH->bindValue(":idSession", $this->idSession, PDO::PARAM_INT);
				$STH->execute();
			$result = $STH->fetch(PDO::FETCH_COLUMN);
			
			$DBH = null;
			
			$result = unserialize( $result );
						
			return $result;
			
		}catch(PDOException $e){
			die("Error: ".$e->getMessage());
		}
	}
	
	function setStateTooth(){
		try{
			$result = null;
			
				if( isset($this->gingiva) ){ $parD = 'gingiva';$parV=$this->gingiva; };
				if( isset($this->abatment) ){ $parD = 'abatment';$parV=$this->abatment; };
				if( isset($this->fixvint) ){ $parD = 'fixvint';$parV=$this->fixvint; };
				
				if( isset($this->implant_first) ){ $parD = 'implant_first'; $parV = $this->implant_first; };
				if( isset($this->implant_second) ){ $parD = 'implant_second'; $parV = $this->implant_second; };
				if( isset($this->implant_thrid) ){ $parD = 'implant_thrid'; $parV = $this->implant_thrid; };
	
				if( isset($this->canal_first) ){ $parD = 'canal_first'; $parV = $this->canal_first; };
				if(isset($this->canal_second) ){ $parD = 'canal_second'; $parV = $this->canal_second; };
				if(isset($this->canal_thrid) ){ $parD = 'canal_thrid'; $parV = $this->canal_thrid; };
				if(isset($this->canal_fourth) ){ $parD = 'canal_fourth'; $parV = $this->canal_fourth; };
				if(isset($this->canal_fifth) ){ $parD = 'canal_fifth'; $parV = $this->canal_fifth; };
	
				if(isset($this->root_first) ){ $parD = 'root_first'; $parV = $this->root_first; };
				if(isset($this->root_second) ){ $parD = 'root_second'; $parV = $this->root_second; };
				if(isset($this->root_thrid) ){ $parD = 'root_thrid'; $parV = $this->root_thrid; };
	
				if(isset($this->crown_first) ){ $parD = 'crown_first'; $parV = $this->crown_first; };
				if(isset($this->crown_second) ){ $parD = 'crown_second'; $parV = $this->crown_second; };
				if(isset($this->crown_thrid) ){ $parD = 'crown_thrid'; $parV = $this->crown_thrid; };
				if(isset($this->crown_fourth) ){ $parD = 'crown_fourth'; $parV = $this->crown_fourth; };
				if(isset($this->crown_fifth) ){ $parD = 'crown_fifth'; $parV = $this->crown_fifth; };
				if(isset($this->crown_sixth) ){ $parD = 'crown_sixth'; $parV = $this->crown_sixth; };
	
				if(isset($this->bone) ){ $parD = 'bone'; $parV = $this->bone; };
	
				if(isset($this->add_crown) ){ $parD = 'add_crown'; $parV = $this->add_crown; };
			
				
			$getState = $this->getStateTooth();
			$data[$this->idTooth] = array($parD=>$parV);
			
			if($getState==null){
				
				$result = $data;
				
			}else{
				foreach($getState as $par=>$val){
					// Поиск зуба
					if($par==$this->idTooth){
						// Поиск заданного параметра в найденом зубе
						if(array_key_exists($parD, $val )){
							
							// Меняем значение параметра
							$getState[$this->idTooth][$parD] = $parV;
							$result = $getState;
							
						}else{			
							
							// Добавляем параметр к массиву
							$result[$this->idTooth] = $getState[$this->idTooth] + array($parD=>$parV);
							
						}
					}else{
						
						// Добавляем зуб в массив
						$result = $getState + $data;
						
					}
				}
			}
			
			if($result==null){return null;}
			$result = serialize( $result );
			//echo $result;
			
			$sql = '
				UPDATE session SET
					conditionTooth = :conditionTooth
				WHERE id = :id
			';
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':id',$this->idSession,PDO::PARAM_INT);
				$STH->bindValue(':conditionTooth',$result,PDO::PARAM_INT);
				$STH->execute();
			$DBH = null;
			return $result;
		}catch(PDOExeption $e){
			die("Error: ".$e->getMessage());
		}	
		
	}
	
	function setWorksIdTooth(){
		try{
			
				$data = array();
				$getWorksTooth = $this->getWorksTooth();
				$getWorksTooth[$this->idTooth][] = $this->works;
				$data = serialize($getWorksTooth);
			
			$sql = '
				UPDATE session SET
					works = :works
				WHERE id = :id
			';
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':works',$data,PDO::PARAM_STR);
				$STH->bindValue(':id',$this->idSession,PDO::PARAM_INT);
				$STH->execute();
			echo $this->works .' : '.$this->idSession;
			$DBH = null;
			return;
			
		}catch(PDOExeption $e){
			die('Error: '.$e->getMassage());
		}
	}
	
	function getWorksTooth(){
		try{
			
			$sql = 'SELECT works FROM session WHERE id = :id;';
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':id',$this->idSession,PDO::PARAM_INT);
				$STH->execute();
			$result = $STH->fetch(PDO::FETCH_COLUMN);
			$result = unserialize( $result );
						
			$DBH = null;
			return $result;
			
		}catch(Exception $e){
			die('Error:'.$e->getMassage());
		}
	}
	
	function getWorksIdTooth(){
		try{
			$result = null;
			$getWorksTooth = $this->getWorksTooth();
			if( isset($getWorksTooth[$this->idTooth]) ){
				$result = $getWorksTooth[$this->idTooth];
			}
			return $result;
			
		}catch(Exception $e){
			die('Error:'.$e->getMassage());
		}
	}
	
	function setDiagnosisIdTooth(){
		try{
			
				$data = array();
				$getDiagnosisTooth = $this->getDiagnosisTooth();
				$getDiagnosisTooth[$this->idTooth][] = $this->diagnosis;
				$data = serialize($getDiagnosisTooth);
			
			$sql = '
				UPDATE session SET
					diagnosis = :diagnosis
				WHERE id = :id
			';
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':diagnosis',$data,PDO::PARAM_STR);
				$STH->bindValue(':id',$this->idSession,PDO::PARAM_INT);
				$STH->execute();
			echo $this->diagnosis .' : '.$this->idSession;
			$DBH = null;
			return;
			
		}catch(PDOExeption $e){
			die('Error: '.$e->getMassage());
		}
	}
	
	
	function getDiagnosisTooth(){
		try{
			
			$sql = 'SELECT diagnosis FROM session WHERE id = :id';
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				$STH->bindValue(':id',$this->idSession,PDO::PARAM_INT);
				$STH->execute();
			$result = $STH->fetch(PDO::FETCH_COLUMN);
			$result = unserialize( $result );
						
			$DBH = null;
			return $result;
			
		}catch(PDOExeption $e){
			die('Error: '.$e->getMassage());
		}
	}
	
	function getDiagnosisIdTooth(){
		try{
			$result = null;
			$getDiagnosisTooth = $this->getDiagnosisTooth();
			if( isset($getDiagnosisTooth[$this->idTooth]) ){
				$result = $getDiagnosisTooth[$this->idTooth];
			}
			return $result;
			
		}catch(Exception $e){
			die('Error:'.$e->getMassage());
		}
	}
	

}
?>