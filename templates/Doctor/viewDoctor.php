<?php include(TEMPLATE_PATH . "/include/header.php"); ?>
<a href="?action=editDoctor<?php echo $results['doctor']['id']; ?>">Edit Doctor</a>
<table border="1">
	<tbody>
		<tr>
			<td width="30%">
				<table>
					<?php viewListDoctor() ?>
				</table>
			</td>
			<td>
				<table>
					<?php viewIdDoctor(); ?>
				</table>
			</td>
		</tr>
	</tbody>
</table>

<?php include( TEMPLATE_PATH. '/include/footer.php' ); ?>
<?php
//require_once( CLASS_PATH . '/Doctor.php' );

function viewListDoctor(){
	
	$list = new Doctor();
	$list = $list->getAllDoctors();
	$row = $list["results"];

	
	foreach( $row as  $res){
	
echo <<<END
       
		<tr onclick="location='?action=viewDoctor&amp;id=$res[id]'" style="cursor:pointer;">
			
			<td>$res[id]</td>
			<td>$res[familyName]</td>
			<td>$res[firstName]</td>
			<td>$res[patronymic]</td>
			<td>$res[cell]</td>
			
			<td></td>
		</tr>
END;
	}
	
	print_r($row);
	
}


function viewIdDoctor(){
	$a = (isset($_GET['id']) ? $_GET['id'] : "1");
	echo "a: ".$a;
	include( TEMPLATE_PATH . "/Doctor/editDoctor.php");
}
?>