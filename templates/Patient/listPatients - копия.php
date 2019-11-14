<?php //include "templates/include/header.php" ?>

<?php
	echo '<br>Всего пациентов: ' . $results['totalRows'];
	//echo ' | <a href="?action=newPatient">Новая карта</a>';
?>

<table>
	<thead>
        <tr>
			<th>Id</th>
			<th>Фамилия</th>
			<th>Имя</th>
			<th>Отчество</th>
			<th>Возраст</th>
			<th>Последний визит</th>
			<th>Запланированный визит</th>
        </tr>
	</thead>
	<tbody class='text-center'>

<?php

foreach ( $results['patients'] as $res ) {

$year = (int)date('Y') - (int)date("Y", strtotime( $res['dateOfBirth'])); // вычисляем возраст
echo <<<END
       
		<tr onclick="location='?action=viewPatient&amp;patientId=$res[id]'" style="cursor:pointer;">
			
			<td>$res[id]</td>
			<td>$res[familyName]</td>
			<td>$res[firstName]</td>
			<td>$res[patronymic]</td>
			<td>$year</td>
			<td>$res[dateLastVisit]</td>
			<td>$res[datePlanned]</td>
			
			<td></td>
		</tr>
END;
} ?>
</tbody>
</table>

<?php// include "templates/include/footer.php" ?>