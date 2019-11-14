<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Стоматологическая база</title>
	<base href="http://localhost/clinicbaseAdmin/">
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/gh-buttons.css" />
	<link href="./js/jquery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	
	<script src="./js/jquery-1.9.1.js"></script>
	<script src="./js/jquery-ui-1.10.3.custom.js"></script>
	<script src="./js/jquery-ui-timepicker-addon.js"></script>
	<?php
		$calendar = isset($_GET['action'])?$_GET['action']:'';
		if($calendar =='Calendar'){
			echo "
				<link rel='stylesheet' type='text/css' href='./fullcalendar/fullcalendar.css' />
				<link rel='stylesheet' type='text/css' href='./fullcalendar/fullcalendar.print.css' media='print' />
				<script type='text/javascript' src='./fullcalendar/fullcalendar.min.js'></script>
			";
		}
	?>
	
	
<script>
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
</script>
  </head>
  <body onload="startTime()">
    <div id="container">
<!--
      <a href="."><img id="logo" src="images/logo.jpg" alt="Clinic Base" /></a>
-->	  
<header id="header">

        <div class='logo'>
			<a href='.'><h1>Стоматологическая база</h1></a>
			<h5>Планирование, документация, отчёты.</h5>
		</div>
       
		<div class='clock'>
	<?php
		echo date( "<p>Сегодня</p><p>d.m.y</p>" );
			$time = strtotime("+1 day");
			$fecha = date("Y-m-d", $time);
		//echo '| Завтра ' . $fecha;
	?>	
		<p><div id="txt"></div></p>
		</div>
		<div class='control'>
			<p><b><?php echo htmlspecialchars( $_SESSION['docName']) ?></b></p>
			<a href="admin.php?action=logout">Завершить работу</a>
		</div>
		<div class='clear'></div>
</header>
<nav>
	<div class="button-group">
	<a href="?action=Calendar" class="button big icon calendar">Распорядок работы</a>
	<a href="?action=Patients" class="button big icon log">Картотека</a>
	<a href="?action=catalog" class="button big icon settings">Справочники</a>
	<a href="?action=Doctors" class="button big icon user">Специалисты</a>
	<!-- <a href="?action=newPatient">New Patient</a> -->
	<!-- <a href="?action=viewPatient">View Patient</a> -->
	</div>
</nav>
<hr>