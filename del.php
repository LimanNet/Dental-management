<?php
// устанавливаем кодировку по умолчанию 
setlocale (LC_ALL, "ru_RU.UTF-8");
header('Content-type: text/html; charset=UTF-8');

require ("classes/Calendar.php");

$allEvents = new Calendar();
$allEvents = $allEvents->getAll();

print_r($allEvents);







?>