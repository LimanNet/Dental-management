<?php
include (TEMPLATE_PATH . '/include/header.php');
?>
	<a href="?action=newDoctor">New Doctor</a>
	<table width="200px" border="1">
	<thead>
	</thead>
	<tbody>
		<tr>
			<th>id</th>
			<th>familyName</th>
			<th>Name</th>
			<th>patronymic</th>
		</tr>
		
		
<?php
	
	foreach( $results['doctor'] as  $res){
	
echo <<<END
       
		<tr onclick="location='?action=viewDoctor&id=$res[id]'" style="cursor:pointer;">
			
			<td>$res[id]</td>
			<td>$res[familyName]</td>
			<td>$res[firstName]</td>
			<td>$res[patronymic]</td>
			<td>$res[cell]</td>
			
			<td></td>
		</tr>
END;
	}
?>

	</tbody>
	</table>

<?php
include (TEMPLATE_PATH . '/include/footer.php');
?>