<?php
	
class Doctors{

	private $id = null;
	private $archived = null;		// Действующий или в увольнении
	private $accessLevel = null;	// Уровень доступа
	private $familyName = null;		// Фамилия
	private $firstName = null;		// Имя
	private $patronymic = null;		// Отчество
	private $dateOfBirth = null;	// Дата Рождения
	private $photo = null;			// Фото
	private $password = null;		// Пароль
	private $email = null;			// Электронная почта
	private $phoneMobile = null;	// Телефон мобильный
	private $phoneHome = null;		// Телефон домашний
	private $phoneExtension = null;	// Телефон дополнительный
	private $sex = null;			// Пол
	private $job = null;			// Должность
	private $education = null;		// Образование
	private $address = null;		// Адрес
	
	function __construct( $data = array() ){
		
		if ($data) {
			
			if( isset($data['id']) ){
				$this->id = filter_var( $data["id"], FILTER_SANITIZE_NUMBER_INT );
			}
			if( isset($data['familyName']) ){
				$this->familyName = filter_var($data['familyName'], FILTER_SANITIZE_STRING);
			}
			if( isset($data['firstName']) ){
				$this->firstName = filter_var($data['firstName'], FILTER_SANITIZE_STRING);
			}
			if( isset($data['patronymic']) ){
				$this->patronymic = filter_var($data['patronymic'], FILTER_SANITIZE_STRING);
			}
			if( isset($data['dateOfBirth']) ){
				$this->dateOfBirth = filter_var($data['dateOfBirth'], FILTER_SANITIZE_STRING);
			}
			if( isset($data['password']) ){
				$this->password = filter_var( $data['password'], FILTER_SANITIZE_STRING );
			}
			if( isset($data['email']) ){
				$this->email = filter_var( $data['email'], FILTER_VALIDATE_EMAIL );
			}
			if( isset($data['phoneMobile']) ){
				$this->phoneMobile = filter_var($data['phoneMobile'], FILTER_SANITIZE_NUMBER_INT);
				//$this->phoneMobile = ($this->phoneMobile == 10) ? '8'.$data['phoneMobile'] : null;
			}
			if( isset($data['sex']) ){
				$this->sex = $data['sex'];
			}
			if( isset($data['job']) ){
				$this->job = $data['job'];
			}
			if( isset($data['photo']) ){
				$this->photo = $data['photo'];
			}
			if( isset($data['aboutMe']) ){
				$this->aboutMe = $data['aboutMe'];
			}
		
		}
		
	}
	private function DBH(){
		
		$DBH = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
		$DBH->exec("SET CHARACTER SET utf8");
		
		return $DBH;
		
	}
	
	function setId($id){
		$this->id = $id;
	}
	function getClassVars(){
		$doc = new Doctors();
		return get_class_vars(get_class($doc));
	}
	
	function setPhoneMobile($phoneMobile){
		$this->phoneMobile = filter_var($phoneMobile, FILTER_SANITIZE_NUMBER_INT);
		/*
		if(strlen($phoneMobile)>=10){
			if(strlen($phoneMobile)==10){$phoneMobile='8'.$phoneMobile;}
			$this->phoneMobile = filter_var($phoneMobile, FILTER_SANITIZE_NUMBER_INT);
		}
		*/
	}
	function setEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email;
		}
	}
	function setPassword($password){ $this->password = filter_var($password, FILTER_SANITIZE_STRING); }
	
	function getDoctor(){
		
		$list = array();
		$doctor = $this->getClassVars();
		
		foreach ($doctor as $param => $value) {
			$list[$param] = $this->$param;
		}
		
		return $list;
	}
	
	function getIdDoctor(){
		try{
			$list = array();
		
			$DBH = $this->DBH();
		
			$sql = "SELECT * FROM doctors WHERE id = :id";
			$STH = $DBH->prepare( $sql );
			$STH->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$STH->execute();
		
			$row = $STH->fetch();
		
			$DBH = null;
		
			$doctor = new Doctors($row);
			$list = $doctor->getDoctor();
		
			return $list;
		
		}catch(Exception $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Doctors.getIdDoctor: '.$e->getMessage(), FILE_APPEND);
		}
	}
	
	function getAllDoctors(){
		
		$list = array();
		
		$conn = new PDO ( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$conn->exec('SET CHARACTER SET utf8');
		
		$sql = "SELECT * FROM doctors";
		$st = $conn->prepare( $sql );
		$st->execute();
		
		$error_array = $st->errorInfo();
		if($st->errorCode() != 0000) echo "SQL ошибка: " . $error_array[2] . '<br />';
		
		$row_count = $st->rowCount();
		if($row_count==0) $row_count = 'Заполненых карт пока нет.';
		
		$list = array();
		while( $row = $st->fetch() ){
		
			$doctor = new Doctors($row);
			$list[] = $doctor->getDoctor();
			
		}
		$conn = null;
		
		return ( array ( "results" => $list, "row_count" => $row_count ) );
	}
	
	function getAll(){
		
		$DBH = $this->DBH();
		
		$sql = "SELECT id,familyName,firstName,patronymic FROM doctors";
		$STH = $DBH->prepare( $sql );
			$STH->execute();
		$result = $STH->fetchAll();
		
		$DBH = null;
		
		return $result;
	}
	
	function insert(){
		try{
			
			$sql = '
				INSERT clinicBase.doctor
					INTO
						( familyName,firstName,patronymic,dateOfBirth,sex,job,photo,aboutMe,phoneMobile,email )
					VALUE
						( :familyName,:firstName,:patronymic,:dateOfBirth,:sex,:job,:photo,:aboutMe,:phoneMobile,:email )
				;
			';
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				
				$STH->bindValue(':familyName',$this->familyName,PDO::PARAM_STR);
				$STH->bindValue(':firstName',$this->firstName,PDO::PARAM_STR);
				$STH->bindValue(':patronymic',$this->patronymic,PDO::PARAM_STR);
				$STH->bindValue(':dateOfBirth',$this->dateOfBirth,PDO::PARAM_STR);
				$STH->bindValue(':sex',$this->sex,PDO::PARAM_STR);
				$STH->bindValue(':job',$this->job,PDO::PARAM_STR);
				$STH->bindValue(':photo',$this->photo,PDO::PARAM_STR);
				$STH->bindValue(':aboutMe',$this->aboutMe,PDO::PARAM_STR);
				$STH->bindValue(':phoneMobile',$this->phoneMobile,PDO::PARAM_STR);
				$STH->bindValue(':email',$this->email,PDO::PARAM_STR);
				
			$STH->execute();
			
			$id = $DBH->lastInsertId();
			$sql = '
				INSERT clinicBase.medical_info
					INTO
						( id )
					VALUE
						( :id )
				;
			';
			$STH = prepare($sql);
				$STH->bindValue(':id',$id,PDO::PARAM_INT);
				$STH->execute;
			$DBH = null;
			
			
		}catch(Exception $e){
			die('Error: '.$e->getMassage());
		}
		
	}
	
	function update(){
		try{
			echo $this->id.$this->password;
			$sql = '
				UPDATE doctors SET
					familyName = :familyName,
					firstName = :firstName,
					patronymic = :patronymic,
					dateOfBirth = :dateOfBirth,
					sex = :sex,
					phoneMobile = :phoneMobile,
					email = :email,
					password = :password
				WHERE id = :id
			';
			$DBH = $this->DBH();
			$STH = $DBH->prepare($sql);
				
				$STH->bindValue(':id', $this->id, PDO::PARAM_INT);
				
				$STH->bindValue(':familyName',$this->familyName,PDO::PARAM_STR);
				$STH->bindValue(':firstName',$this->firstName,PDO::PARAM_STR);
				$STH->bindValue(':patronymic',$this->patronymic,PDO::PARAM_STR);
				$STH->bindValue(':sex',$this->sex,PDO::PARAM_STR);
				$STH->bindValue(':phoneMobile',$this->phoneMobile,PDO::PARAM_INT);
				$STH->bindValue(':email',$this->email,PDO::PARAM_STR);
				$STH->bindValue(':dateOfBirth',$this->dateOfBirth,PDO::PARAM_STR);
				$STH->bindValue(':password',$this->password,PDO::PARAM_STR);
				//$STH->bindValue(':job',$this->job,PDO::PARAM_STR);
				//$STH->bindValue(':aboutMe',$this->aboutMe,PDO::PARAM_STR);
			$res = $STH->execute();
			
			$DBH = null;
			if($res){return true;}
			else{return false;}
			
		}catch(PDOException $e){
			echo "Error!";  
			file_put_contents('../Errors.txt', 'Doctors.update: '.$e->getMessage(), FILE_APPEND);
		}
		
	}
	
	function loginDoctor(){
		try{
			// проверка на наличие входных данных
			if(($this->phoneMobile == null and $this->email == null) or $this->password == null){return false;}
		
			$list = array();
		
			$DBH = $this->DBH();
		
			$sql = " SELECT * FROM doctors WHERE password=:password AND (email=:email OR phoneMobile=:phoneMobile) ";
			$STH = $DBH->prepare( $sql );
				$STH->bindValue( ":phoneMobile", $this->phoneMobile, PDO::PARAM_INT );
				$STH->bindValue( ":email", $this->email, PDO::PARAM_STR );
				$STH->bindValue( ":password", $this->password, PDO::PARAM_STR );
				$STH->execute();
		
			$error_array = $STH->errorInfo();
			if($STH->errorCode() != 0000) return ( 'SQL ошибка: ' . $error_array[2] . '<br />');
		
			$row = $STH->fetch();
			$DBH = null;
		print_r($row);
			if(!$row){
				return false;
			}
			
			$doctor = new Doctors($row);
			$list = $doctor->getDoctor();
		
			return $list;
		}catch(Exception $e){
			echo "Error!";
			$mes = '<>phoneMobile:'.$this->phoneMobile.'<>email:'.$this->email;
			file_put_contents('../Errors.txt', 'Login: '.$e->getMessage(), FILE_APPEND);
		}
	}

}
	
?>