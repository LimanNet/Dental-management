<?php


//if( $_POST['directory']=='MedicalInfo'){new medInfo($_POST);}


class medInfo{

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
	
	private $op = null;
	
	function __construct($data=array()){
		
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->idTypeBite = isset($data['idTypeBite']) ? $data['idTypeBite'] : null;
		$this->idVitaColor = isset($data['idVitaColor']) ? $data['idVitaColor'] : null;
		$this->idsDoctors = isset($data['idsDoctors']) ? $data['idsDoctors'] : null;
		$this->allergyAnamnesis = isset($data['allergyAnamnesis']) ? $data['allergyAnamnesis'] : null;
		$this->idsIllness = isset($data['idsIllness']) ? $data['idsIllness'] : null;
		$this->evolutionDisease = isset($data['evolutionDisease']) ? $data['evolutionDisease'] : null;
		$this->objectiveResearch = isset($data['objectiveResearch']) ? $data['objectiveResearch'] : null;
		$this->indexPIPMA = isset($data['indexPIPMA']) ? $data['indexPIPMA'] : null;
		$this->xRayData = isset($data['xRayData']) ? $data['xRayData'] : null;
		
		$this->op = isset( $data['op']) ?  $data['op'] : null ;
		$this->op( $this->op );
	
	}
	
	private function op( $op ){
		switch($op){
			case 'get':
				$this->get();
			break;
			case 'set':
				$this->set();
			break;
			case 'edit':
				$this->edit();
			break;
			default:
				return;
		}
	}
	
	function edit(){
		echo "Edittttttt";
		print_r($_POST);
	}
	
	function getAll(){
		require_once( 'classes/Patient.php' );
		
		/*
		// Список типов прикуса
		*/
		require_once( 'classes/Catalog/TypeBite.php' );
		
		$typeBite = new TypeBite();
		$typeBite = $typeBite->getAll();
		
		$result['typeBite'] = $typeBite;
		
		/*
		// Список цветов по Vita
		*/
		require_once( 'classes/Catalog/VitaColor.php' );
		
		$vitaColor = new VitaColor();
		$vitaColor = $vitaColor->getAll();
		
		$result['vitaColor'] = $vitaColor;
		
		/*
		// Список врачей
		*/
		require_once( 'classes/Doctors.php' );
		
		$doctors = new Doctors();
		$doctors = $doctors->getAll();
		
		$result['doctors'] = $doctors;
		
		/*
		//	Список перенесённых болезней
		*/
		require_once( 'classes/Catalog/Illness.php' );
		
		$illness = new Illness();
		$illness = $illness->getAll();
		
		$result['illness'] = $illness;
		
		return $result;	
		
	}

}
?>