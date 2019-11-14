<?php
	echo '<table class="list" width="100%">';
	
	foreach ( $results['patients'] as $res ) {
		$year = (int)date('Y') - (int)date("Y", strtotime( $res['dateOfBirth'])); // вычисляем возраст
	
		$tr = "";
		if( isset($_GET['patientId']) && $_GET['patientId'] == $res['id'] ) $tr = "class='select'";
	
		echo <<<END
       
		<tr onclick="location='?action=viewPatient&amp;patientId=$res[id]'" $tr style="cursor:pointer;">
			
			<td>$res[id]</td>
			<td>$res[familyName]
			$res[firstName]
			$res[patronymic]</td>
			<td>100</td>
		</tr>
		
END;
	}
	echo '</table>';
?>