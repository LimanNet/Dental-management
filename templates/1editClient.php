<?php //include "templates/include/header.php" ?>

<h2>Изменение карточки пациента(ки)</h2>

<form action='admin.php' >
		<input type='hidden' name='idDoctor' value='1' />
	<label>Фамилия:</label>
		<input type='text' name='surName' placeholder="Фамилия" autofocus /><br />
	<label>Имя:</label>
		<input type='text' name='firstName' placeholder="Имя" /><br />
	<label>Отчество:</label>
		<input type='text' name='middleName' placeholder="Отчество" /><br />
	<label>Дата рождения:</label>
		<input type='date' name='birthday' /><br />
	<label>Пол:</label>
		М<input type='radio' name='sex' value="male" />
		Ж<input type='radio' name='sex' value="female" checked /><br />
	<label>Телефон:</label>
		<input type='tel' data-name="phone" name='phone' pattern="\+380[0-9]{9}" value='+380' maxlength="13" placeholder="+380507181617" autocomplete="off" /><br />
	<label>Эллектронный адресс:</label>
		<input border="1" id="email" name="email" type="email" placeholder="ex@mail.com" autocomplete="off" />
	<label>Фото:</label>
		<input type='file' name='photo' /><br />
	<label>Профессия:</label>
		<input type='text' name='profession' /><br />
	<label>Рекомендован(а):</label>
		<input type='text' name='recommend' /><br />
	<label>Алергия:</label>
		<input type='text' name='allergy' /><br />
	<label>Первый визит:</label>
		<input type='datetime' name='dateFirstVisit' /><br />
	<label>Последний визит:</label>
		<input type='datetime' name='dateLastVisit' /><br />
	<label>Назначить следующий визит:</label>
		<input type='datetime' name='datePlanned' /><br />
	<label>Ведение лечения:</label>
		<textarea></textarea><br />
	
	
	<input type="submit" />
	
</form>


<?


?>