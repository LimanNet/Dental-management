<?php
class ToothState{
	
	private $id = null;
	private $archived = null;
	private $name = null;
	private $color = null;
	private $ids_tooth_part = null;
	
	
	function setID($id){
		$this->id = $id;
	}
		
	function set( $data=array() ){
		
		foreach( $data as $param=>$value ){
			if( is_array($value) ){
				$value = implode("," ,$value);
			}
			$this->$param = $value;	
		}
	}
	
	function get(){
		$list = array();
		
		$class = new ToothState();
		$a = get_class_vars(get_class($class));
		
		foreach ($a as $param => $value) {
			$list[$param] = $this->$param;
		}
		return $list;	
		
	}

	
	function getAll(){
		
		$list = array();
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$STH = $DBH->query('SELECT * FROM clinicbase.tooth_state WHERE archived IS NULL ORDER BY name;');
		$result = $STH->fetchAll(PDO::FETCH_ASSOC);
		$DBH = null;
		
		foreach($result as $param=>$value){
			$this->set($value);
			$list[] = $this->get();
		}
		
		return $list;
	}
	function archive(){
		
		$list = array();
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$STH = $DBH->query('SELECT * FROM clinicbase.tooth_state WHERE archived IS NOT NULL ORDER BY name;');
		$result = $STH->fetchAll(PDO::FETCH_ASSOC);
		$DBH = null;
		
		foreach($result as $param=>$value){
			$this->set($value);
			$list[] = $this->get();
		}
		
		return $list;
	}
	
	function insert(){
		
		$insert = $this->get();
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$total = count( $insert );
		$sql = 'INSERT INTO  clinicbase.tooth_state (';
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
						$STH->bindValue( ":".$param, NULL, PDO::PARAM_NULL);
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
		
		$class = new ToothState();
		$a = get_class_vars(get_class($class));
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$query = '
			UPDATE clinicbase.tooth_state
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
	
	function delete(){

		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$DBH->exec("delete from clinicbase.tooth_state where id='".$this->id."';");
		$error_array = $DBH->errorInfo();
			if($DBH->errorCode() != 0000) echo "SQL ошибка: " . $error_array[2] . '<br />';
			$result = '<b>Удаление прошло успешно!</b>';		
		$DBH = null;
		
		return $result;
	}
/*	
	function getID($id){
		
		$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$DBH->exec('SET CHARACTER SET utf8');
		
		$STH = $DBH->prepare('SELECT * FROM clinicbase.tooth_state WHERE id=:id');
		$STH->bindParam(':id', $id, PDO::PARAM_INT);
		$STH->execute();
		$result = $STH->fetch(PDO::FETCH_ASSOC);
		$DBH = null;
		
		$this->set($result);
		$result = $this->get();
		
		return $result;
	}
*/
	
}
?>