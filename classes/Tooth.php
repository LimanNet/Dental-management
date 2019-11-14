<?php
class Tooth{
	
	private $id = null;
	
	private $number_tooth = null;
	private $id_patient = null;	/*** дублируем пациента ***/
	private $id_doctor = null;	/*** дублируем доктора ***/
	private $id_session = null;	/*** Информация о том, кто и когда, сделал запись  ***/

	private $state_tooth = null;	/*** Состояние зуба: отсутствует, молочный, постоянный, имплантант ***/
	
	/*** Коронковая часть зуба ***/
	private $crown = null;	/*** Состояние коронкой части: 4 или 5 ***/
	private $crown_first = null;	/*** id_tooth_state ***/
	private $crown_seconf = null;	/*** id_tooth_state ***/
	private $crown_third = null;	/*** id_tooth_state ***/
	private $crown_fourth = null;	/*** id_tooth_state ***/
	private $crown_fifth = null;	/*** id_tooth_state ***/
	/*** Короневая часть зуба ***/
	private $roots = null;	/*** Количество корней ***/
	private $root_first	 = null;	/*** id_tooth_state ***/
	private $root_second = null;	/*** id_tooth_state ***/
	private $root_third	 = null;	/*** id_tooth_state ***/
	/*** Каналы зуба ***/
	private $canals	 = null;	/*** Количество каналов ***/
	private $canal_first = null;	/*** id_tooth_state ***/
	private $canal_second = null;	/*** id_tooth_state ***/
	private $canal_third = null;	/*** id_tooth_state ***/
	/*** Стадии имплантантов ***/
	private $implant = null;	/*** Три стадии имплантирования ***/
	private $implant_impl = null;	/*** id_tooth_state ***/
	private $implant_fixvint = null;	/*** id_tooth_state ***/
	private $implant_abatment = null;	/*** id_tooth_state ***/
	/*** Надстройки на коронковой части ***/
	private $add_crown = null;	/*** id_tooth_state ***/
	/*** Десна ***/
	private $gingiva = null;	/*** id_tooth_state ***/
	/*** Кость ***/
	private $bone = null;	/*** id_tooth_state ***/
	
	
	
	function setId($id){
		$this->id = $id;
	}
	function setIdPatient($id_patient){
		$this->id_patient = $id_patient;
	}
	function getIdPatient(){
		return $this->id_patient;
	}
	
	function get(){
		$list = array();
		
		$class = new Tooth();
		$a = get_class_vars(get_class($class));
		
		foreach ($a as $param => $value) {
			if( $this->$param != null ){
				$list[$param] = $this->$param;
			}
		}
		return $list;	
		
	}
		
	function set( $data=array() ){
		
		foreach( $data as $param=>$value ){
			if($value!=null){
				if( is_array($value) ){
					$value = implode("," ,$value);
				}
				$this->$param = $value;	
			}
		}
	}
	
	function getAll(){
		
		$list = array();
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$STH = $DBH->prepare('SELECT * FROM clinicbase.ses_state_tooth WHERE id_patient=:id_patient;');
		$STH->bindValue(':id_patient',$this->id_patient);
		$STH->execute();
		$result = $STH->fetchAll();
		$DBH = null;
		
		foreach($result as $param=>$value){
			$this->set($value);
			$list[] = $this->get();
		}
		
		return $list;
	}
	
	function testTooth(){
		
	}
	
	function insert(){
		
		$insert = $this->get();
		print_r($insert);
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$total = count( $insert );
		$sql = 'INSERT INTO  clinicbase.ses_state_tooth (';
				$counter = 0;
				foreach( $insert as $param=>$value ){
					$counter++;
					if($param=='id' || $value==null){}else{
					if( $counter == $total ){
						$sql .= ' '.$param;
					} else{
						$sql .= ''.$param.', ';
					}
					}
				}
			$sql .= ' )VALUES ( ';
				$counter = 0;
				foreach( $insert as $param=>$value ){
					$counter++;
					if($param!='id' && $value!=null){
						if( $counter == $total ){
							$sql .= ':'.$param;
						} else{
							$sql .= ':'.$param.', ';
						}
					}
				}
			$sql .= ' )';
			
			echo $sql;
			
		$STH = $DBH->prepare($sql);
		foreach ($insert as $param => $value) {
				if($param!='id'){
					if ( is_numeric($value) ){
						$STH->bindValue( ":".$param, $value, PDO::PARAM_INT);
					} else {
						$STH->bindValue( ":".$param , $value, PDO::PARAM_STR);
					}
				}
		}
		$STH->execute();

		$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000){ $result = "Ошибка: " . $error_array[2] . '<br />'; }
			else {$result = 'success';}
		$DBH = null;
		
		return $result;
		
	}
}
?>