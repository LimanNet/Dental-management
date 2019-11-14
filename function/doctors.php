<?php include(TEMPLATE_PATH . "/include/header.php"); ?>

<table border="1" width="100%">
	<tbody>
		<tr>
			<td></td>
			<td>
				<table>
					<tr>
						<td><a href="?action=Doctors&amp;tab=newDoctor">Новая</a></td>
						<td><a href="#">Расписание</a></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="30%">
				<table >
					<?php viewListDoctor() ?>
				</table>
			</td>
			<td>
				<table>
					<tr><?php viewTab(); ?></tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<?php include( TEMPLATE_PATH. '/include/footer.php' ); ?>
<?php
require_once(CLASS_PATH . '/Doctors.php');
function viewTab(){
$tab = (isset($_GET['tab']) ? $_GET['tab'] : null);

	switch( $tab ){
		case 'newDoctor':
			newDoctor();
			break;
		case 'editDoctor':
			editDoctor();
			break;
		case 'listDoctors':
			listDoctors();
			break;
		case 'viewDoctor':
			viewDoctor();
			break;
		case 'Doctors':
			doctors();
			break;
		default:
			view();
	}
}

function viewListDoctor(){
	
	$list = new Doctors();
	$list = $list->getAllDoctors();
	$row = $list["results"];

	
	foreach( $row as  $res){
	
echo <<<END
       
		<tr onclick="location='?action=Doctors&amp;id=$res[id]'" style="cursor:pointer;">
			
			<td>$res[id]</td>
			<td>$res[familyName]</td>
			<td>$res[firstName]</td>
			<td>$res[patronymic]</td>
			<td>$res[phoneMobile]</td>
			
			<td></td>
		</tr>
END;
	}
	
	//print_r($row);
	
}

function newDoctor(){
	
	$act = isset($_POST['act']) ? $_POST['act'] : null;
	
	if( $act=='addDoctor' ){
		$doctor = new Doctors($_POST);
		$doctor = $doctor->insert();
	}else{
		require_once(TEMPLATE_PATH . "/Doctor/newDoctor.php");
	}
	
	
}

function editDoctor(){
	
	$results = array();
	
	$idDoctor = (int) isset($_GET['id']) ? $_GET['id'] : '';
		if($idDoctor == '') return 'Вы не можете изменить этого доктора!';
	$act = isset($_POST['act']) ? $_POST['act'] : null;
	
	if( $act=='editDoctor' ){
		
		$doctor = new Doctors($_POST);
		$res = $doctor->update();
		if($res){
			header( "Location: ?action=Doctors&tab=editDoctor&id=".$idDoctor );
		}
		
			$doctor->setId($idDoctor);
		$results['doctor'] = $doctor->getIdDoctor();
		
	}else{
		$doctor = new Doctors();
			$doctor->setId($idDoctor);
		$results['doctor'] = $doctor->getIdDoctor();
	}
	
	require_once(TEMPLATE_PATH . '/Doctor/editDoctor.php');
}

function viewDoctor(){
	
	$results = array();
	$results['pageTitle'] = "Докторская карта";
	
	$doctor = new Doctors();
	
	require_once( TEMPLATE_PATH . '/Doctor/viewDoctor.php');
}

function listDoctors(){
	require_once( CLASS_PATH . '/Doctor.php' );
	
	$results = array();
	
	$results['pageTitle'] = "Кадры";
	
	$doctor = new Doctors();
	$getDoc = $doctor->getAllDoctors();
	$results['doctor'] = $getDoc["results"];
	
	require_once( TEMPLATE_PATH . '/Doctor/listDoctors.php' );
	
}

function view(){
	$idDoctor = (isset($_GET['id']) ? (int) $_GET['id'] : null);
	$doctor = new Doctors($idDoctor);
	$results['doctor'] = $doctor->getIdDoctor();
	$results['formAction'] = "editDoctor";
	//echo "a: ".$idDoctor;
	echo '
	
		<table>
			<tr>
				<td><a href="?action=Doctors&amp;tab=editDoctor&amp;id='.$idDoctor.'">Edit</a></td>
			</tr>
			<tr>
				<td>'.$idDoctor.'</td>
	';
	echo "
				<td>".$results['doctor']['familyName']."</td>
				<td>".$results['doctor']['firstName']."</td>
				<td>".$results['doctor']['patronymic']."</td>
			</TR>
		</table>";
		
	//include( TEMPLATE_PATH . "/Doctor/editDoctor.php");
}
?>