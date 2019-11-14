<?php

class GraphicsDentition{

	private $GraphicsDentition = array();
	
	function get_GraphicsDentition( $id ){
		
		try{
		
			$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$DBH->exec("SET CHARACTER SET utf8");
		
			$STH = $DBH->prepare('SELECT  * FROM clinicbase.cat_graphicsdentition WHERE idGraph = :idGraph ');  
			$STH->bindParam(':idGraph', $id, PDO::PARAM_INT);
			$STH->execute();
			$result = $STH->fetch(PDO::FETCH_ASSOC);
			
			$conn = null;
			return $result;
		
		}
		catch(PDOExeption $e){
			echo "I'm sorry. I'm afraid I can't do that.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
		
	}
	
	function set_GraphicsDentition( $set=array() ){
		try{
			
			$result = $this::get_GraphicsDentition( "1" );
			
			foreach($result as $param=>$value){
				if(isset($set[$param])){$set[$param]=$set[$param];}else{$set[$param]=null;}
				$this->GraphicsDentition[$param] = $set[$param];
			}
		
		}
		catch(PDOExeption $e){
			echo "I'm sorry. I'm afraid I can't do that.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	public function update_GraphicsDentition(){
		try{
		
			$DBH = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$DBH->exec('SET CHARACTER SET utf8');
			$query = '
				UPDATE clinicbase.cat_graphicsdentition
					SET
						name = :name ,
						color = :color
			';
			foreach($this->GraphicsDentition as $param=>$value){
				if($param=="idGraph" or $param=="name" or $param=="color"){}else{
					$query .= ", ".$param." = :".$param;
				}
			}
			$query .= '
					WHERE idGraph = :idGraph;
			';
		
			$STH = $DBH->prepare($query);
			$STH->bindParam(':idGraph', $this->GraphicsDentition['idGraph'], PDO::PARAM_STR);
			$STH->bindParam(':name', $this->GraphicsDentition['name'], PDO::PARAM_STR);
			$STH->bindParam(':color', $this->GraphicsDentition['color'], PDO::PARAM_STR);
			foreach($this->GraphicsDentition as $param=>$value){
				if($param=="idGraph" or $param=="name" or $param=="color"){}else{
					$STH->bindParam(':'.$param, $this->GraphicsDentition[$param], PDO::PARAM_BOOL);
				}
			}
		
			$STH->execute();
		
			$DBH = null;
			
			return "Изменения внесены успешно.";
		}
		catch(PDOExeption $e){
			return "Извините, но заданная операция не выполнима.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	public function insert_GraphicsDentition(){
		
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$conn -> exec('SET CHARACTER SET utf8');
			$conn -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		$sql = '
			INSERT clinicbase.cat_graphicsdentition(
				name ,
				color
		';
			foreach($this->GraphicsDentition as $param=>$value){
				if($param=="idGraph" or $param=="name" or $param=="color"){}else{
					$sql .= ", ".$param;
				}
			}
		$sql .= '
			)VALUES(
				:name ,
				:color
		';
			foreach($this->GraphicsDentition as $param=>$value){
				if($param=="idGraph" or $param=="name" or $param=="color"){}else{
					$sql .= ", :".$param;
				}
			}
		$sql .= '
		)
		';

		$st = $conn->prepare($sql);
		$st->bindValue( ":name",		$this->GraphicsDentition['name'], PDO::PARAM_STR );
		$st->bindValue( ":color",		$this->GraphicsDentition['color'], PDO::PARAM_STR );
			foreach($this->GraphicsDentition as $param=>$value){
				if($param=="idGraph" or $param=="name" or $param=="color"){}else{
					$st->bindParam(':'.$param, $this->GraphicsDentition[$param], PDO::PARAM_BOOL);
				}
			}
		
		$st->execute();
			
			$error_array = $st->errorInfo();
			if($st->errorCode() != 0000){
				$result = "Ошибка: " . $error_array[2] . '<br />';
			}
			else{$result = "success";}
			
			$conn = null;
		return $result;
	}
	public function del_GraphicsDentition(){
		try {
			$DBH = new PDO( DB_DNS, DB_USERNAME, DB_PASSWORD );
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			# UH-OH! Typed DELECT instead of SELECT!
			$DBH->prepare('DELECT name FROM people');
		}
		catch(PDOException $e) {
			echo "I'm sorry, Dave. I'm afraid I can't do that.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	public function getAll_GraphicsDentition(){
		
		try{
		
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$conn->exec("SET CHARACTER SET utf8");
		
			$st = $conn->query('SELECT  * FROM clinicbase.cat_graphicsdentition ORDER BY name');  
			$result = $st->fetchAll(PDO::FETCH_ASSOC);
			
			$conn = null;
			return $result;
		
		}
		catch(PDOExeption $e){
			echo "I'm sorry. I'm afraid I can't do that.";
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
		
	}

}

?>