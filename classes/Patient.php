<?php

if ( file_exists('config.php') ){
	require_once('config.php');
}elseif ( file_exists('../config.php') ){
	require_once('../config.php');
}

class Patient{

	private $id					= null;
	private $archived			= null;
	private $familyName			= null;
	private $firstName			= null;
	private $patronymic			= null;
	private $dateOfBirth		= null;
	private $sex				= null;
	private $profession			= null;
	private $email				= null;
	private $phoneHome			= null;	// Домшний номер телефона
	private $phoneWork			= null;	// Рабочий номер телефона
	private $phoneMobile		= null;	// Мобильный номер телефона	
	private $address			= null;
	private $photo				= null;
	private $recommend			= null;	
	private $doctors			= null;
	private $additionalData		= null;
	private $dateCreate			= null;
	
	function __construct( $data=array() ){
		if(isset($data['id'])){$this->id = $data['id'];}
		if(isset($data['familyName'])){$this->familyName = $data['familyName'];}
		if(isset($data['firstName'])){$this->firstName = $data['firstName'];}
		if(isset($data['patronymic'])){$this->patronymic = $data['patronymic'];}
		if(isset($data['dateOfBirth'])){$this->dateOfBirth = $data['dateOfBirth'];}
		if(isset($data['sex'])){$this->sex = $data['sex'];}
		if(isset($data['phoneHome'])){$this->phoneHome = preg_replace ( "/[^\$ 0-9()]/", "", $data['phoneHome']);}
		if(isset($data['phoneWork'])){$this->phoneWork = preg_replace ( "/[^\$ 0-9()]/", "", $data['phoneWork']);}
		if(isset($data['phoneMobile'])){$this->phoneMobile = preg_replace ( "/[^\$ 0-9()]/", "", $data['phoneMobile']);}
		if(isset($data['email'])){$this->email = preg_replace ( "/[^\.\@\$ a-zA-Z0-9()]/", "", $data['email']);}
		if(isset($data['address'])){$this->address = $data['address'];}
		if(isset($data['photo'])){$this->photo = $data['photo'];}
		if(isset($data['profession'])){$this->profession = $data['profession'];}
		if(isset($data['recommend'])){$this->recommend = $data['recommend'];}	
		if(isset($data['doctor'])){$this->doctor = $data['doctor'];}
		if(isset($data['additionalData'])){$this->additionalData = $data['additionalData'];}
		if(isset($data['dateCreate'])){$this->dateCreate = $data['dateCreate'];}	
	}
	
	private function DBH(){
		$DBH = new PDO('mysql:host=localhost;dbname=clinicbase','root','');
			$DBH->exec('SET CHARACTER SET utf8');
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
		return $DBH;
	}
	
	function getAll(){
		try{
				
			$DBH = $this->DBH();
			$sql = "SELECT  * FROM patients WHERE archived IS NULL";
			$STH = $DBH->prepare( $sql );
				$STH->execute();
			$result = $STH->fetchAll();
			
			return $result;
				
		} catch(PDOExeption $e){
			die('Error: '.$e->getMassage());
		}
	}
	
	function getById(){
		try{
			$DBH = $this->DBH();
			
			$sql = "SELECT * FROM patients WHERE id = :id";
			$STH = $DBH->prepare( $sql );
			$STH->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$STH->execute();
			
			$result = $STH->fetch();
			
			$DBH = null;
			
			return $result;
			
		} catch(PDOExeption $e){
			die ( 'Error:' .$e->getMassage() );
		}
	}

	function insert(){
		try{
			$dateCreate = Date('now');
			$sql = '
				INSERT INTO  clinicbase.patients (
					
					familyName,
					firstName,
					patronymic,
					dateOfBirth,
					sex,
					profession,
					email,
					phoneHome,
					phoneWork,
					phoneMobile,
					address,
					photo,
					recommend,
					doctors,
					additionalData,
					dateCreate

				)VALUES(
					
					:familyName,
					:firstName,
					:patronymic,
					:dateOfBirth,
					:sex,
					:profession,
					:email,
					:phoneHome,
					:phoneWork,
					:phoneMobile,
					:address,
					:photo,
					:recommend,
					:doctors,
					:additionalData,
					:dateCreate

				)';
				$DBH = $this->DBH();
				$STH->prepare($sql);
				
				$STH->bindValue( ":familyName",		$this->familyName, PDO::PARAM_STR );
				$STH->bindValue( ":firstName",		$this->firstName, PDO::PARAM_STR );
				$STH->bindValue( ":patronymic",		$this->patronymic, PDO::PARAM_STR );
				$STH->bindValue( ":dateOfBirth",	$this->dateOfBirth, PDO::PARAM_STR );
				$STH->bindValue( ":sex",			$this->sex, PDO::PARAM_STR );
				$STH->bindValue( ":profession",		$this->profession, PDO::PARAM_STR );
				$STH->bindValue( ":email",			$this->email, PDO::PARAM_STR );
				$STH->bindValue( ":phoneHome",		$this->phoneHome, PDO::PARAM_INT );
				$STH->bindValue( ":phoneWork",		$this->phoneWork, PDO::PARAM_INT );
				$STH->bindValue( ":phoneMobile",	$this->phoneMobile, PDO::PARAM_INT );
				$STH->bindValue( ":address",		$this->address, PDO::PARAM_STR );
				$STH->bindValue( ":photo",			$this->photo, PDO::PARAM_STR );
				$STH->bindValue( ":recommend",		$this->recommend, PDO::PARAM_STR );
				$STH->bindValue( ":doctors",		$this->doctors, PDO::PARAM_INT );
				$STH->bindValue( ":additionalData",	$this->additionalData, PDO::PARAM_STR );
				$STH->bindValue( ":dateCreate",		$dateCreate, PDO::PARAM_STR );
				
				$STH->execute();
			
			$id = $DBH->lastInserId();
			$sql = "
				INSERT INTO clnicbase.medical_info(id)
				VALUES (:id)
			";
			$STH = prepare($sql);
				$STH->bindValue(':id',$id,PDO::PARAM_INT);
				$STH->execute();
				
			$DBH = null;
		} catch (PDOExeption $e){
			echo "PDOError: " . $e->getMessage();
		}
	}

	function update() {
		try{
			$sql = "
			UPDATE patients
				SET
					familyName = :familyName,
					firstName = :firstName,
					patronymic = :patronymic,
					dateOfBirth = :dateOfBirth,
					sex = :sex,
					profession = :profession,
					email = :email,
					phoneHome = :phoneHome,
					phoneWork = :phoneWork,
					phoneMobile = :phoneMobile,
					address = :address,
					photo = :photo,
					recommend = :recommend,
					doctors = :doctors,
					additionalData = :additionalData
				WHERE id = :id
			";
			$DBH = $this->DBH();
			$STH = $DBH->prepare ( $sql );
		
				$STH->bindValue( ":id",				$this->id, PDO::PARAM_INT );
				$STH->bindValue( ":familyName",		$this->familyName, PDO::PARAM_STR );
				$STH->bindValue( ":firstName",		$this->firstName, PDO::PARAM_STR );
				$STH->bindValue( ":patronymic",		$this->patronymic, PDO::PARAM_STR );
				$STH->bindValue( ":dateOfBirth",	$this->dateOfBirth, PDO::PARAM_STR );
				$STH->bindValue( ":sex",			$this->sex, PDO::PARAM_STR );
				$STH->bindValue( ":profession",		$this->profession, PDO::PARAM_STR );
				$STH->bindValue( ":email",			$this->email, PDO::PARAM_STR );
				$STH->bindValue( ":phoneHome",		$this->phoneHome, PDO::PARAM_INT );
				$STH->bindValue( ":phoneWork",		$this->phoneWork, PDO::PARAM_INT );
				$STH->bindValue( ":phoneMobile",	$this->phoneMobile, PDO::PARAM_INT );
				$STH->bindValue( ":address",		$this->address, PDO::PARAM_STR );
				$STH->bindValue( ":photo",			$this->photo, PDO::PARAM_STR );
				$STH->bindValue( ":recommend",		$this->recommend, PDO::PARAM_STR );
				$STH->bindValue( ":doctors",		$this->doctors, PDO::PARAM_INT );
				$STH->bindValue( ":additionalData",	$this->additionalData, PDO::PARAM_STR );

			$STH->execute();
	
			$DBH = null;
		}catch(Exeption $e){
			die("Error: ".$e->getMessage());
		}
	}
	
	function getAllPatients(){
		try{
			$DBH = $this->DBH();
		
			$STH = $DBH->query('SELECT id,familyName,firstName,patronymic FROM patients WHERE archived IS NULL ORDER BY familyName ');
			$result = $STH->fetchAll(PDO::FETCH_ASSOC);
						
			$DBH = null;
		
			return $result;
		} catch (PDOException $e){
			die("Error: ".$e->getMassage());
		}		
	}
	
	function searhByLetter($letters){
		try{
			
			$letters = $letters."%";
			
			$DBH = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$DBH->exec("SET CHARACTER SET utf8");
			
			$sql = "SELECT id,familyName,firstName,patronymic FROM patients WHERE familyName LIKE :letters;  ";
			
			$STH = $DBH->prepare($sql);
			$STH->bindValue( ":letters", $letters, PDO::PARAM_STR);
			
			$STH->execute();
			$result = $STH->fetchAll(PDO::FETCH_ASSOC);
			
			$DBH = null;
			
			return $result;
			
		}catch(PDOExeption $e){
			die("Error: ".$e->getMassage());
		}
	}



}

?>