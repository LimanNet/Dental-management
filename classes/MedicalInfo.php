<?php
require_once( 'config.php' );
class MedicalInfo{
	
	private $id = null;
	private $idTypeBite = null;			// Тип прикуса
	private $idVitaColor = null;		// Цвет по Vita
	private $idsDoctors = null;			// Список врачей, лечащих данного пациента
	private $allergyAnamnesis = null;	// Аллергологический анамнез
	private $idsIllness = null;			// Перенесённые и сопутствующие заболевания
	private $evolutionDisease = null;	// Развитие текущего заболевания
	private $objectiveResearch = null;	// Данные объективного исследования, внешний вид, состояния зубов
	private $indexPIPMA = null;			// Состояние слизистой оболочки рта, дёсен, альвеолярных отростков и нёба. Индексы PI и PMA
	private $xRayData = null;			// Данные ренгеновских, лабораторных исследований
	
	function __construct( $data = array() ){
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->idTypeBite = isset($data['idTypeBite']) ? $data['idTypeBite'] : null;
		$this->idVitaColor = isset($data['idVitaColor']) ? $data['idVitaColor'] : null;
		if(isset($data['idsDoctors'])){
			if(is_array($data['idsDoctors'])){
				$this->idsDoctors = implode(',', $data['idsDoctors']);
			}else{
				$this->idsDoctors = $data['idsDoctors'];
			}
			
		}
		$this->allergyAnamnesis = isset($data['allergyAnamnesis']) ? $data['allergyAnamnesis'] : null;
		if(isset($data['idsIllness'])){
			if(is_array($data['idsIllness'])){
				$this->idsIllness = implode(',', $data['idsIllness']);
			}else{
				$this->idsIllness =  $data['idsIllness'];
			}
		}
		$this->evolutionDisease = isset($data['evolutionDisease']) ? $data['evolutionDisease'] : null;
		$this->objectiveResearch = isset($data['objectiveResearch']) ? $data['objectiveResearch'] : null;
		$this->indexPIPMA = isset($data['indexPIPMA']) ? $data['indexPIPMA'] : null;
		$this->xRayData = isset($data['xRayData']) ? $data['xRayData'] : null;
	}
	
	private function DBH(){
		try{
			$DBH = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
			$DBH->exec('SET CHARACTER SET utf8');
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			return $DBH;
		}catch(PDOExeption $e){
			echo "Error!";  
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	function insert(){
		try{
			
			$sql = "
				INSERT INTO clinicBase.patients_medical_info
				(
					id					
				)
				VALUE
				(
					:id					
				);
				
			";
			
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				
				$STH->bindValue(':idPatient',$this->idPatient,PDO::PARAM_INT);
				
				$STH->execute();
			$idLast = $DBH->lastInsertId();
			return $idLast;
			
			
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Class: MedicalInfo.insert: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
	
	function getById(){
	try{
		$DBH = $this->DBH();
		
		$sql = "SELECT * FROM clinicBase.medical_info WHERE id=:id";
		
		$STH = $DBH->prepare($sql);
			$STH->bindValue(':id',$this->id,PDO::PARAM_INT);
			$STH->execute();
		$result = $STH->fetch();
		
		$DBH = null;
		return $result;
	}catch(Exception $e){
		die("Error: ".$e->getMessage());
	}
	}
	
	function update(){
		try{
			
			$sql = '
				UPDATE clinicBase.medical_info SET
					
					idTypeBite = :idTypeBite,
					idVitaColor = :idVitaColor,
					idsDoctors = :idsDoctors,
					allergyAnamnesis = :allergyAnamnesis,
					idsIllness = :idsIllness,
					evolutionDisease = :evolutionDisease,
					objectiveResearch = :objectiveResearch,
					indexPIPMA = :indexPIPMA,
					xRayData = :xRayData
					
				WHERE id = :id;
			';
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				
				$STH->bindValue(':id', $this->id, PDO::PARAM_INT);
				
				$STH->bindValue(':idTypeBite',$this->idTypeBite,PDO::PARAM_STR);
				$STH->bindValue(':idVitaColor',$this->idVitaColor,PDO::PARAM_STR);
				$STH->bindValue(':idsDoctors',$this->idsDoctors,PDO::PARAM_STR);
				$STH->bindValue(':allergyAnamnesis',$this->allergyAnamnesis,PDO::PARAM_STR);
				$STH->bindValue(':idsIllness',$this->idsIllness,PDO::PARAM_STR);
				$STH->bindValue(':evolutionDisease',$this->evolutionDisease,PDO::PARAM_STR);
				$STH->bindValue(':objectiveResearch',$this->objectiveResearch,PDO::PARAM_STR);
				$STH->bindValue(':indexPIPMA',$this->indexPIPMA,PDO::PARAM_STR);
				$STH->bindValue(':xRayData',$this->xRayData,PDO::PARAM_STR);
			$STH->execute();
			
			$DBH = null;
			
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Class: MedicalInfo.update: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
	
}
?>