<?php

require_once ('include/menu.php');

?>
<div class="box">

<?php
	echo 'Редактирование Медицинской информации';
?>

<?php
	echo '<form action="?action=patients&tab=editMedicalInfo&patientId='.$idPatient.'" method="post">';
	echo '<input type="hidden" name="id" value="'.$idPatient.'" />';
	echo '
		<input type="hidden" name="tab" value="editMedicalInfo" />
		<input type="hidden" name="op" value="edit" />
	';
?>
	<label>Тип прикуса</label>
	<select name="idTypeBite">
		<option></option>
		<?php
			foreach($result['typeBite'] as $par=>$val){
				if($val['id']==$medicalInfo['idTypeBite']){
					echo '<option value="'.$val['id'].'" selected>'.$val['name'].'</option>';
				}
				echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		?>
	</select>
	<br/>
	<label>Цвет по Vita</label>
	<select name="idVitaColor">
		<option></option>
		<?php
			foreach($result['vitaColor'] as $par=>$val){
				if($val['id']==$medicalInfo['idVitaColor']){
					echo '<option value="'.$val['id'].'" selected>'.$val['name'].'</option>';
				}
				echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		?>
	</select><br />
	<label>Список врачей, лечащих данного пациента</label>
		<br/>
		<?php
			$medicalInfo['idsDoctors'] = explode(',', $medicalInfo['idsDoctors']);
			foreach($result['doctors'] as $par=>$val){
				if(in_array($val['id'],$medicalInfo['idsDoctors'])){
					echo '<input type="checkbox" name="idsDoctors[]" value="'.$val['id'].'" checked>'.$val['familyName'].' '.$val['firstName'].' '.$val['patronymic'].'<br/>';
				}else{
					echo '<input type="checkbox" name="idsDoctors[]" value="'.$val['id'].'">'.$val['familyName'].' '.$val['firstName'].' '.$val['patronymic'].'<br/>';
				}
				
			}
		?>
		<br />
	<label>Аллергологический анамнез:</label><br/>
		<?php
			echo '<textarea name="allergyAnamnesis">'.$medicalInfo['allergyAnamnesis'].'</textarea><br/>';
		?>
	<label>Перенесённые и сопутствующие заболевания</label><br/>
	<?php
		
		$medicalInfo['idsIllness'] = explode(',', $medicalInfo['idsIllness']);
		foreach( $result['illness'] as $par=>$val ){
			if(in_array($val['id'],$medicalInfo['idsIllness'])){
				if($val['description']){
					echo '<input type="checkbox" name="idsIllness[]" value="'.$val['id'].'" checked>'.$val['name'].' - '.$val['description'].'<br/>';
				}else{
					echo '<input type="checkbox" name="idsIllness[]" value="'.$val['id'].'" checked>'.$val['name'].'<br/>';
				}
			}
			if($val['description']){
				echo '<input type="checkbox" name="idsIllness[]" value="'.$val['id'].'">'.$val['name'].' - '.$val['description'].'<br/>';
			}else{
				echo '<input type="checkbox" name="idsIllness[]" value="'.$val['id'].'">'.$val['name'].'<br/>';
			}
		}
	?>
	<br />
	<label>Развитие текущего заболевания</label><br/>
		<?php
			echo '<textarea name="evolutionDisease">'.$medicalInfo['evolutionDisease'].'</textarea><br/>';
		?>
		
	<label>Данные объективного исследования, внешний вид, состояния зубов</label><br/>
		<?php
			echo '<textarea name="objectiveResearch">'.$medicalInfo['objectiveResearch'].'</textarea><br/>';
		?>
		
	<label>Состояние слизистой оболочки рта, дёсен, альвеолярных отростков и нёба. Индексы PI и PMA</label><br/>
		<?php
			echo '<textarea name="indexPIPMA">'.$medicalInfo['indexPIPMA'].'</textarea><br/>';
		?>
		
	<label>Данные ренгеновских, лабораторных исследований</label><br/>
		<?php
			echo '<textarea name="xRayData">'.$medicalInfo['xRayData'].'</textarea><br/>';
		?>		
	
	
	<input type="submit" name="saveChanges" />
</form>

</div class="box">