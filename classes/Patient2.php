<?php

require_once('./config.php');

class Patient{

	private $id = null;
	private $idDoctor;
	private $surName;
	private $firstName;
	private $middleName;
	private $dateOfBirth;
	private $sex;
	private $phone;
	private $email;
	private $photo;
	private $profession;
	private $recommend;
	private $allergy;
	private $dateFirstVisit;
	private $dateLastVisit;
	private $datePlanned;
	
	public function __construct( $data=array() ){
			
		if ( isset($data['id']) )				$this->id = (int) $data['id'];
		if ( isset($data['idDoctor']) )			$this->idDoctor = (int) $data['idDoctor'];
		if ( isset($data['surName']) )			$this->surName =  $data['surName'];
		if ( isset($data['firstName']) )		$this->firstName =  $data['firstName'] ;
		if ( isset($data['middleName']) )		$this->middleName =  $data['middleName'] ;
		if ( isset($data['dateOfBirth']) )		$this->dateOfBirth = $data['dateOfBirth'];
		if ( isset($data['sex']) )				$this->sex =  $data['sex'] ;
		if ( isset($data['tel']) )				$this->tel = (int) $data['tel'];
		if ( isset($data['email']) )			$this->email = $data['email'];
		if ( isset($data['photo']) )			$this->photo = $data['photo'];
		if ( isset($data['profession']) )		$this->profession = $data['profession'];
		if ( isset($data['recommend']) )		$this->recommend = $data['recommend'];
		if ( isset($data['allerg']) )			$this->allerg = $data['allerg'];
		if ( isset($data['dateFirstVisit']) )	$this->dateFirstVisit = date($data['dateFirstVisit']);
		if ( isset($data['dateLastVisit']) )	$this->dateLastVisit = date($data['dateLastVisit']);
		if ( isset($data['datePlanned']) )		$this->datePlanned = date($data['datePlanned']);
		
	}
	
	public function getPatient(){
		$list = array();
		
		$list['id'] = $this->id;
		$list['idDoctor'] = $this->idDoctor;
		$list['surName'] = $this->surName;
		$list['firstName'] = $this->firstName;
		$list['middleName'] = $this->middleName;
		$list['dateOfBirth'] = $this->dateOfBirth;
		$list['sex'] = $this->sex;
		$list['phone'] = $this->phone;
		$list['email'] = $this->email;
		$list['photo'] = $this->photo;
		$list['profession'] = $this->profession;
		$list['recommend'] = $this->recommend;
		$list['allergy'] = $this->allergy;
		$list['dateFirstVisit'] = $this->dateFirstVisit;
		$list['dateLastVisit'] = $this->dateLastVisit;
		$list['datePlanned'] = $this->datePlanned;

		return $list;
	}
	
	public function getAllPatients($idDoctor){
			try{
				
				$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
				$conn -> exec("SET CHARACTER SET utf8");
				
				$sql = "SELECT  * FROM patients WHERE idDoctor = :idDoctor";
				$st = $conn->prepare( $sql );
				$st->bindValue( ":idDoctor", $idDoctor, PDO::PARAM_INT );
				$st->execute();
				
				$row_count = $st->rowCount();
				if($row_count==0) $row_count = 'Заполненых карт пока нет.';
				
				$list = array();
				while ( $row = $st->fetch() ) {
					$patient = new Patient( $row );
					$list[] = $patient->getPatient();
				}

				$conn = null;
				return ( array ( "results" => $list, "row_count" => $row_count ) );
				
			} catch(PDOExeption $e){
				die('Error: '.$e->getMassage());
			}
	}
	
	public function getById($id){
	
		try{
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$conn -> exec("SET CHARACTER SET utf8");
			
			$sql = "SELECT * FROM patients WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			
			$patient = new Patient( $row );
			$result = $patient->getPatient();
			
			if ( $result ) return $result;
			
		} catch(PDOExeption $e){
			die ( 'Error:' .$e->getMassage() );
		}
	}
	function insert(){
		try{
			
			 // Does the Patient object already have an ID?
			if ( !is_null( $this->id ) ) trigger_error ( "Attempt to insert an Patient object that already has its ID property set (to $this->id).", E_USER_ERROR );
			
			echo $this->id;
			echo $this->id_doctor;
			echo $this->surName;
			echo $this->firstName;
			echo $this->middleName;
			echo $this->dateOfBirth;
			echo $this->sex;
			echo $this->tel;
			echo $this->email;
			echo $this->photo;
			echo $this->profession;
			echo $this->recommend;
			echo $this->allergy;
			echo $this->dateFirstVisit;
			echo $this->dateLastVisit;
			echo $this->datePlanned;
			
			
			// Insert the Patient
			$conn = new PDO (DB_DSN, DB_USERNAME, DB_PASSWORD);
			$conn -> exec("SET CHARACTER SET utf8");
			
			$sql = "INSERT INTO patients (
				id_doctor,
				surName,
				firstName,
				middleName,
				dateOfBirth,
				sex,
				tel,
				email,
				photo,
				profession,
				recommend,
				allergy,
				dateFirstVisit,
				dateLastVisit,
				datePlanned
			)
				VALUES (
							:id_doctor,
							:surName,
							:firstName,
							:middleName,
							:dateOfBirth,
							:sex,
							:tel,
							:email,
							:photo,
							:profession,
							:recommend,
							:allergy,
							:dateFirstVisit,
							:dateLastVisit,
							:datePlanned
			)";
			$st = $conn->prepare ( $sql );
			$st->bindValue( ":id_doctor",	$this->id_doctor, PDO::PARAM_INT );
			$st->bindValue( ":surName",		$this->surName, PDO::PARAM_STR );
			$st->bindValue( ":firstName",	$this->firstName, PDO::PARAM_STR );
			$st->bindValue( ":middleName",	$this->middleName, PDO::PARAM_STR );
			$st->bindValue( ":dateOfBirth",	$this->dateOfBirth, PDO::PARAM_INT );
			$st->bindValue( ":sex",			$this->sex, PDO::PARAM_STR );
			$st->bindValue( ":tel",			$this->tel, PDO::PARAM_STR );
			$st->bindValue( ":email",		$this->email, PDO::PARAM_STR );
			$st->bindValue( ":photo",		$this->photo, PDO::PARAM_STR );
			$st->bindValue( ":profession",	$this->profession, PDO::PARAM_STR );
			$st->bindValue( ":recommend",	$this->recommend, PDO::PARAM_STR );
			$st->bindValue( ":allergy",		$this->allergy, PDO::PARAM_STR );
			$st->bindValue( ":dateFirstVisit",	$this->dateFirstVisit, PDO::PARAM_INT );
			$st->bindValue( ":dateLastVisit",	$this->dateLastVisit, PDO::PARAM_INT );
			$st->bindValue( ":datePlanned",	$this->datePlanned, PDO::PARAM_INT );
			$st->execute();
			
			$this->id = $conn->lastInsertId();
			$conn = null;
			
		}catch(PDOExeption $e){
			die('Error: ' . $e->getMassage());
		}
	}
	

}

?>