<?php
	print_r($results);
	echo '<br/>';


echo '<form action="index.php?action=Doctors&tab=editDoctor&id='.$results['doctor']['id'].'" method="POST">'
?>
	<input type="hidden" name="id" value="<?php echo  $results['doctor']['id']; ?>" />
	<input type="hidden" name="act" value="editDoctor" />
	<label>Фамилия:</label>
	<input type="text" name="familyName" value="<?php echo $results['doctor']['familyName'];?>" /><br/>
	<label>Имя:</label>
	<input type="text" name="firstName" value="<?php echo $results['doctor']['firstName'];?>" /><br/>
	<label>Отчество:</label>
	<input type="text" name="patronymic" value="<?php echo $results['doctor']['patronymic'];?>" /><br/>
	<label>Пол:</label><br/>
		<input name='dzen' type='​radio' value='pdzen' checked>​<br/>
		<?php
			
			if($results['doctor']['sex']=="мужчина"){
				echo '<input type="radio" name="sex" value="мужчина" checked >Мужчина<br/>';
				echo '<input type="radio" name="sex" value="женщина" >Женщина<br/>';
			}elseif($results['doctor']['sex']=='женщина'){
				echo '<input type="radio" name="sex" value="мужчина" >Мужчина<br/>';
				echo '<input type="radio" name="sex" value="женщина" checked >Женщина<br/>';
			}else{
				echo '<input type="radio" name="sex" value="мужчина" >Мужчина<br/>';
				echo '<input type="radio" name="sex" value="женщина" >Женщина<br/>';
			}
			
		?>
		
	<label>День рождения:</label>
	<input type="date" name="dateOfBirth" value="<?php echo $results['doctor']['dateOfBirth'];?>" /><br/>
	<label>Телефон мобильный*:</label>
	<input type="text" name="phoneMobile" value="<?php echo $results['doctor']['phoneMobile']?>" /><br/>
	<label>Электронная почта*:</label>
	<input type="text" name="email" value="<?php echo $results['doctor']['email']?>" /><br/>
	<label>Пароль*:</label>
	<input type="text" name="password" value="<?php echo $results['doctor']['password']?>" /><br/>
	
	<input type="submit" value="Сохранить изменения" />
</form>

<?php //include(TEMPLATE_PATH . "/include/footer.php")?>