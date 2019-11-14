<?php

require_once('config.php');
class TypeBite{
	
	private $id = null;
	private $archived = null;
	private $name = null;
	private $description = null;
	
	function __construct( $data = array() ){
		
		$this->id = isset($data['id']) ? $data['id'] : null ;
		$this->archived = isset($data['archived']) ? $data['archived'] : null ;
		$this->name = isset($data['name']) ? $data['name'] : null ;
		$this->description = isset($data['description']) ? $data['description'] : null ;
		
	}
	
	private function DBH(){
		
		$DBH = new PDO( DB_DSN,DB_USERNAME,DB_PASSWORD );
		$DBH->exec('set CHARACTER SET utf8');
		
		return $DBH;
	}
	
	function getAll(){
		
		$DBH = $this->DBH();
		
		$STH = $DBH->prepare('SELECT * FROM clinicbase.type_bite ORDER BY id;');
		$STH->execute();
		$result = $STH->fetchAll();
		$DBH = null;
		
		return $result;
	}
		
	function set( $data=array() ){
		foreach( $data as $param=>$value ){
			$this->$param = $value;
		}
	}
	
	
	
	function insert($array = array()){
		
		$insert = $this->get();
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$total = count( $insert );
		$sql = 'INSERT INTO  clinicbase.type_bite (';
				$counter = 0;
				foreach( $insert as $param=>$value ){
					$counter++;
					if($param=='id'){}else{
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
					if($param!='id'){
						if( $counter == $total ){
							$sql .= ':'.$param;
						} else{
							$sql .= ':'.$param.', ';
						}
					}
				}
			$sql .= ' )';
			
		$STH = $DBH->prepare($sql);
		foreach ($insert as $param => $value) {
				if($param!='id'){
					if ( is_numeric($value) ){
						$STH->bindValue( ":".$param, $value, PDO::PARAM_INT);
					} elseif( $value == null ){
						$STH->bindValue( ":".$param, 'NULL', PDO::PARAM_NULL);
						echo $param;
					} else {
						$STH->bindValue( ":".$param , $value, PDO::PARAM_STR);
					}
				}
		}
		$STH->execute();

			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000) echo "SQL ошибка: " . $error_array[2] . '<br />';
			$result = 'success';
		$DBH = null;
		
		return $result;
	}
	
	function update(){
		
		$class = new IllDestination();
		$a = get_class_vars(get_class($class));
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$query = '
			UPDATE clinicbase.type_bite
				SET ';
				$total = count($a);
				$counter = 0;
				foreach ($a as $param=>$value) {
					$counter++;
					if ( $counter == $total ) {
						$query .= " ".$param." = :".$param;
					}elseif ( $param != '' && $param != 'id' ){
						$query .= "".$param." = :".$param." ,";
					}
				}
		$query .= '
			WHERE id = :id;
			"
		';
		
		$STH = $DBH->prepare($query);
		foreach ($a as $param => $value) {
				if( $this->$param == null ){
					$STH->bindValue( ":".$param, null, PDO::PARAM_NULL);
				} elseif ( is_numeric( $this->$param ) ){
					$STH->bindValue( ":".$param, $this->$param, PDO::PARAM_INT);
				} else {
					$STH->bindValue( ":".$param , $this->$param, PDO::PARAM_STR);
				}
		}
		$STH->execute();
			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000) echo "SQL ошибка: " . $error_array[2] . '<br />';
			$result = 'success';		
		$DBH = null;
		
		return $result;
	}
	
	function setID($id){
		$this->id = $id;
	}
	function delete(){
		print_r($this->id);
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$DBH->exec("delete from clinicbase.type_bite where id='".$this->id."';");
		$error_array = $DBH->errorInfo();
			if($DBH->errorCode() != 0000) echo "SQL ошибка: " . $error_array[2] . '<br />';
			$result = '<b>Удаление прошло успешно!</b>';		
		$DBH = null;
		
		return $result;
	}
	
}
?>