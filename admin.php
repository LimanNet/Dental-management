<?php //define( '_JEXEC', 1 );?>
<?php

require( "config.php" );
	
session_start();

  /**
  * Проверка браузера
  *
  * Чтобы отсечь возможность использования сессии с другого браузера (компьютера),
  * следует ввести проверку поля HTTP-заголовка user-agent:
  *
  */
	if (isset($_SESSION['HTTP_USER_AGENT'])){
		if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])){
			echo 'Ваша учётная запись не работает. Войдите пожалуйста ещё раз.';
			logout();
			return false;
		}
	}else{
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	}

	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$docName = isset( $_SESSION['docName'] ) ? $_SESSION['docName'] : "";

if ( $action != "login" && $action != "logout" && !$docName ) {
  login();
  exit;
}else{

	switch ( $action ) {
		case 'login':
			login();
			break;
		case 'logout':
			logout();
			break;
		case 'Calendar':
			calendar();
			break;
		case 'Doctors':
			doctors();
			break;
		case 'Patients':
			patients();
			break;
		case 'catalog':
			catalog();
			break;
		default:
			patients();
	}
}
function login() {

	$results = array();
	$results['pageTitle'] = "Вход в управление";
	
	if (!$_REQUEST){
		// User has not posted the login form yet: display the form
		require( TEMPLATE_PATH . "/loginForm.php" );
		return;
	}elseif ( isset( $_POST['login'] ) ) {

		// User has posted the login form: attempt to log the user in
	
		$ident_doc = isset($_POST['docName']) ? $_POST['docName'] : null;
		$ident_pass = isset($_POST['password']) ? $_POST['password'] : null;
		require_once( CLASS_PATH . '/Doctor.php' );
		$doc = new Doctor();
		//Определяем тип введённых данных
		if(is_numeric($ident_doc)){
			$doc->setCell($ident_doc);
		}
		else{
			$doc->setEmail($ident_doc);			
		}
		$doc->setPassword($ident_pass);
		$doc = $doc->loginDoctor();
	
		if($doc){
			print_r($doc);
			// Login successful: Create a session and redirect to the admin homepage
			$_SESSION['docName'] = $doc['familyName'];
			$_SESSION['id_doctor'] = $doc['id'];
			$expire=time()+60*60*24*30;
			
			setcookie("user", $doc['familyName'], $expire);
			header( "Location: admin.php" );

		} else {
			$_REQUEST = null;
			// Login failed: display an error message to the user
			$results['errorMessage'] = "Incorrect docName or password. Please try again.";

			require( TEMPLATE_PATH . "/loginForm.php" );
			
		}
	}
}

function calendar(){
	$results['pageTitle'] = "Распорядок работы";
	require_once( 'calendar.php' );
}

function logout() {
  unset( $_SESSION['docName'] );
  session_destroy(); // уничтожаем сессию
  header( "Location: ." );
}

function workTable(){
	$results = array();
	
	$results['pageTitle'] = "Рабочий стол";
	
	require_once( TEMPLATE_PATH . '/workTable.php');
}

  /**
  * Functions for Doctors.
  */

function doctors(){
	require_once( CLASS_PATH . '/Doctor.php' );
	require_once( '/function/doctors.php' );
}



  /**
  * Functions for Patients.
  */

function patients() {
	//require( CLASS_PATH . "/Patient.php" );
	require_once( 'function/Patients.php' );
}


  /**
  * Functions for Catalog.
  */
function catalog(){
	require( 'function/catalog.php' );
}

?>