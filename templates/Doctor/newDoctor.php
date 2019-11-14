<?php //include(TEMPLATE_PATH . "/include/header.php")?>

<form action="index.php?action=Doctors&tab=newDoctor" method="POST">
	<input type="hidden" name="act" value="addDoctor" />
	<label>Фамилия:</label>
	<input type="text" name="familyName" /><br/>
	<label>Имя:</label>
	<input type="text" name="firstName" /><br/>
	<label>Отчество:</label>
	<input type="text" name="patronymic" /><br/>
	<label>Телефон:</label>
	<input type="text" name="cell" /><br/>
	<label>Электронный адрес:</label>
	<input type="text" name="email" /><br/>
	<label>Пароль:</label>
	<input type="text" name="password" /><br/>
	
	<input type="submit" value="Создать" />
</form>

<?php //include(TEMPLATE_PATH . "/include/footer.php")?>