<?php include( TEMPLATE_PATH . '/include/header.php' );?>
<link rel="stylesheet" type="text/css" href="css/calendar.css" />
<?php
	
	/* Распорядок работы */
	$idDoctor = isset($_SESSION['id_doctor']) ? $_SESSION['id_doctor'] : null;
	echo '<input type="hidden" name="idDoctor" value="'.$idDoctor.'" />';
	
	$patientId =  isset($_GET['patientId']) ? $_GET['patientId'] : null;
	$session =  isset($_GET['session']) ? $_GET['session'] : null;
	
	//$_SESSION['session'] =  7;
	// Образуем сессию в сессии

		if( $session ){
			if( $session == 'end' ){
				$_SESSION['session'] = null;
				$_SESSION['patientId'] = null;
			}elseif( $session!=$_SESSION['session'] ){
				$_SESSION['session'] =  $session;
				$_SESSION['patientId'] = $patientId;
					header( "Location: ?action=viewPatient&patientId=".$patientId );
			}else{
				echo "<b style='red'>Для начала этого приёма, закройте предидущий!</b>";
			}
			
		}
	
	print_r($_SESSION);
	$session = isset($_SESSION['session']) ? $_SESSION['session'] : null;
	echo '<input type="hidden" name="session" value="'.$session.'" />';
?>

 
 
<script>

  var year = new Date().getFullYear();
  var month = new Date().getMonth();
  var day = new Date().getDate();
  
	var idDoctor = $("input[name=idDoctor]");
	var session = $("input[name=session]");
	var sessionStartEnd = $( "#sessionStartEnd" )
  
	$(document).ready(function(){
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var startEvent;
		var endEvent;
		var titleEvent;
		var idEvent;
		var dayDeltaEvent;
		var minuteDeltaEvent;
		
		var idPatientEvent = null;
		var idDoctorEvent = null;
		
		var calendar = $('#calendar').fullCalendar({
			
			header: {
				left: 'prev,next today',
				center: 'prev title next',
				right: 'month,agendaWeek,agendaDay'
			},
			
			//defaultView: 'agendaWeek',
			firstDay: 1,
			
			timeFormat:  'HH:mm { - HH:mm}',
			axisFormat: 'HH:mm { - HH:mm}',
			agenda: 'h:mm{ - h:mm}', // 5:00 - 6:30
			
			firstHour: 8,
			//minTime: 7,
			//maxTime: 22,
			
			hourLine: true,
			timeslotsPerHour: 6,
			
			allDaySlot: false,
			timeslotHeigh: 30,
			slotMinutes: 10,
			
			selectable: true,
			selectHelper: true,
			editable: true,
			handleWindowResize: false,
			// Руссифицируем Календарь
			allDayText: 'Ежедневно',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв.','Фев.','Март','Апр.','Май','Июнь','Июль','Авг.','Сент.','Окт.','Ноя.','Дек.'],
			dayNames: ["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
			dayNamesShort: ["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
			buttonText: {
				today: "Сегодня",
				month: "Месяц",
				week: "Неделя",
				day: "День"
			},
			
			
			events: 'function/calendar.php?op=getAllEvents',		// Приёмы
			
			
			/**
			* 
			*	Создание приёма
			*
			**/
			
			select: function(start, end, allDay) {
				// Проверка на прошедшее время
				if (start < date )
				{
					alert('Нельзя производить действия над прошедшими приёмами!');
					return false;
				}
				
				// Пациент
				$( "#add-form" ).dialog( "open" );
				
				myStart = start;
				myEnd = end;
				
				
				calendar.fullCalendar('unselect');
			},
			
			
			
			
			// Двойное нажатие на приём
			eventRender: function(event, element) {
				element.bind('contextmenu', function() {
					event.title = "Started!";
				});
			},
			
			/**
			* 
			*	Запуск или окончание приёма
			*
			**/
			// Нажатие на приём
			eventClick: function(event, element) {
				
				// Проверка на прошедшее время
				if ( event.end < date ){
					alert('Нельзя производить действия над прошедшими приёмами!');
					return false;
				}
					
					idPatientEvent = event.idPatient;
					idEvent = event.id;
					startEvent = event.start;
					endEvent = event.end;
					dayDeltaEvent = event.dayDelta;
					minuteDeltaEvent = event.minuteDelta;
				
				if( !session.val() || (startEvent == null) || (endEvent == null) ){
					$( "#sessionStartEnd" ).dialog( "open" );
				}else if( session.val() == event.id ){
					$( "#endSession" ).dialog( "open" );
				}else{
					alert('Вам необходимо завершить прежний приём!');
					return false;
				}
								
				calendar.fullCalendar('updateEvent', event);

			},
			
			

			
			/**
			* 
			*	Перенисение приёма на другой день и время
			*
			**/
			eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
			/*
				alert(
					event.title + " was moved " +
					dayDelta + " days and " +
					minuteDelta + " minutes."
				);
			
				if (allDay) {
					alert("Event is now all-day");
				}else{
					alert("Event has a time-of-day");
				}
			*/
				if (confirm("Вы действительно желаете внести эти изменения?")) {
					$.ajax({
						type: 'POST',
						url: 'function/calendar.php',
						data:
							{
								id: event.id,
								title: event.title,
								dayDelta: dayDelta,
								minuteDelta: minuteDelta,
								op: 'editDropEvent'
							},
						success: function(result){
							alert('Изменения внесены!');
							$('#res').html(result);
						}
					});
					
				}else{revertFunc();}
				calendar.fullCalendar('unselect');
			},
			
			
			/**
			* 
			*	Изменения продолжительности приёма
			*
			**/
			eventResize: function(event,dayDelta,minuteDelta,revertFunc){
			/*
				alert(
					"The end date of " + event.title + "has been moved " +
						dayDelta + " days and " +
						minuteDelta + " minutes."
				);
			*/
				if(confirm("is this okay?")){
					$.ajax({
						type: "POST",
						url: "function/calendar.php",
						data:
							{
								id: event.id,
								dayDelta: dayDelta,
								minuteDelta: minuteDelta,
								op: "editResizeEvent"
							},
						success: function(result){
							alert('Изменения внесены!');
							$('#res').html(result);
						}
					});
				}else{revertFunc();}
				
			}
			
		});
		
	/** Вид и отправка формы **/

	var name = $( "#name" );
	var email = $( "#email" );
	var password = $( "#password" );
	var allFields = $( [] ).add( name ).add( email ).add( password );
	var tips = $( ".validateTips" );
	
	var opClient = $("input[name=opClient]");
	var myTitle = $("input[name=patientFamilyName]");
	var idPatient = $("input[name=idPatient]");
	
	var familyName = $("input[name=familyName]");
	var firstName = $("input[name=firstName]");
	var patronymic = $("input[name=patronymic]");
	
	
	
	function updateTips( t ) {
		tips
		.text( t )
		.addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
	}
	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
			min + " and " + max + "." );
			return false;
		} else {
			return true;
		}
	}
	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}
	$( "#add-form" ).dialog({
		autoOpen: false,
		height: 500,
		width: 850,
		modal: true,
		buttons: {
			"Create an account": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				if(opClient=="choicePatient"){
					bValid = bValid && checkRegexp( idPatient, /^([0-9])+$/, "Password field only allow : 0-9" );
					bValid = bValid && checkRegexp( myTitle, /^([а-яА-ЯёЁ])+$/, "Фамилия может состоять только из русских букв: а-я А-Я" );
				}else if(opClient=="createPatient"){
					bValid = bValid && checkRegexp( familyName, /^([а-яА-ЯёЁ])+$/, "Фамилия может состоять только из русских букв: а-я А-Я" );
					bValid = bValid && checkRegexp( firstName, /^([а-яА-ЯёЁ])+$/, "Имя может состоять только из русских букв: а-я А-Я" );
					bValid = bValid && checkRegexp( patronymic, /^([а-яА-ЯёЁ])+$/, "Отчество может состоять только из русских букв: а-я А-Я" );
				}else{bValid = false;}
				if ( bValid ) {
					
					var frm = $("form").serializeArray();
					var data;
					if(opClient=="choicePatient"){
						data = ({
							op: 'addEvent',
							opClient: "choicePatient",
							title: myTitle.val(),
							start: myStart,
							end: myEnd,							
							idPatient: idPatient.val(),
							idDoctor: idDoctor.val()
						});
					}else if(opClient=="createPatient"){
						data = ({
							op: 'addEvent',
							opClient: "createPatient",	
							title: familyName.val(),
							start: myStart,
							end: myEnd,													
							familyName: familyName.val(),
							firstName: firstName.val(),
							patronymic: patronymic.val(),
							idDoctor: idDoctor.val()
						});
					}
						console.log(data);
					if(data){
						console.log(data);
						$.ajax({
							type: 'POST',
							url: 'function/calendar.php',
							data: data,
							success: function(result) {
								$('#res').html(result);
								calendar.fullCalendar('unselect');
							},
							complete: function() { idPatient.val('');},
							error: function() { alert('При создании приёма произошёл сбой, попробуйте ещё раз!'); },
						});
						calendar.fullCalendar('unselect');
					}
					$( this ).dialog( "close" );
					calendar.fullCalendar('unselect');
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
				calendar.fullCalendar('unselect');
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
			calendar.fullCalendar('unselect');
		}
	});
	
	
		/**
		* 
		*	Диалоговые окна
		*
		**/
	// Объявление диалогового окна действий
	$(function() {
		$( "#sessionStartEnd" ).dialog( { autoOpen: false } );
		$( "#endSession" ).dialog( { autoOpen: false } );
	});
	
	// Объявление вкладок
	$( "#tabs" ).tabs();
		// Выбор пациента
		$("#choicePatient").click(function(){
			opClient = "choicePatient";
		});
		// Создание пациента
		$("#createPatient").click(function(){
			opClient = "createPatient";
			
		});
		
		/**
		* 
		*	Запрос на пациента
		*
		**/
	$("[name=client]").keyup(function(event){
		
		//console.log(this.value);
					
		$.ajax({
			type: "POST",
			url: "function/calendar.php",
			data: {
				letters: this.value,
				op : 'searhByLetter'
			},
			success: function(result){
				$('#patientList').html(result);
			}
		});
		
	});
	
	$("#removeEvent").click(function(){
		console.log( "removeEvent: " + idPatientEvent );
		calendar.fullCalendar( 'removeEvents' , idEvent );
		$.ajax({
			type: "POST",
			url: "function/calendar.php",
			data: {
				op: "removeEvents",
				id: idEvent
			}
		});
		$( "#startEndSession" ).dialog( "close" );
	});
	
	$("#sessionStart").click(function(){
		if( !session.val() ){
			$.ajax({
				type: "POST",
				url: "function/calendar.php",
				data: {
					op: "sessionStart",
					id: idEvent,
					idPatient: idPatientEvent,
					idDoctor: idDoctor.val(),
					start: startEvent,
					end: endEvent,
					dayDelta: dayDeltaEvent,
					minuteDelta: minuteDeltaEvent
				},
				success: function(result){
					$('#res').html(result);
					location="?action=Calendar&session="+result+"&patientId="+idPatientEvent;
					
				}
			});
			$( "#startEndSession" ).dialog(  "close"  );
			//if( session.val()!=null ){ location="?action=viewPatient&patientId="+idPatientEvent; }
		}
			
	});
	$("#sessionEnd").click(function(){
		if( session.val() == idEvent ){ // Завершить можно только начатый приём
			$.ajax({
				type: "POST",
				url: "function/calendar.php",
				data: {
					op: "sessionEnd",
					id: idEvent,
					idPatient: idPatientEvent,
					idDoctor: idDoctor.val(),
					start: startEvent,
					end: endEvent,
					dayDelta: dayDeltaEvent,
					minuteDelta: minuteDeltaEvent
				},
				success: function(result){
					$('#res').html(result);
					location="?action=Calendar&session=end";
				}
			});
			$( "#startEndSession" ).dialog(  "close"  );
			
		} else {
			alert("Этот приём не может быть завершён, так как не был начат.");
		}
		//location="?action=viewPatient&patientId="+idPatientEvent;
	});
	
	
});	


					
					
				/**
				* 
				*	Выбор пациента
				*
				**/
	
				function selectPatient( idPatient,patientFamilyName ){
					//var patientId = $(this).attr("patientId");
					$("li").removeClass('select');
					$("input[name=opClient]").val( "choicePatient" );
					$("input[name=idPatient]").val( idPatient );
					$("input[name=patientFamilyName]").val( patientFamilyName );
					$("#pat"+idPatient).addClass("select");
					console.log( "patient id: " + idPatient + " : " + patientFamilyName +" : "+ $("input[name=opClient]").val( ) );
				}
				
</script>
<div id='calendar'></div>
<div class='clear'></div>

<div id="res"></div>

<h2 class="demoHeaders">Dialog</h2>

<?php // Форма для создания приёмов ?>

	<div>
		<div id="add-form">
			<form>
			<ul>
				<!-- <li><a href="#choicePatient">Выбрать клинта</a></li> -->
				<!-- <li><a href="#createPatient">Создать новую карту</a></li> -->
				<input type="hidden" name="opClient" value="" />
				
				<input type="hidden" name="idPatient" value="" />
				<input type="hidden" name="patientFamilyName" value="" />
				<div class="text ui-widget-content ui-corner-all"></div>
			</ul>
			<div id="choicePatient">
				<p>
				<label for="searchClient">Найти</label>
				<input id="serchClient" type="search" name="client" />
				</p>
				<p>Выбрать клинта</p>
				<div id="patientList"></div>
			</div>
			<div id="createPatient">
			<!--	
				<p class="validateTips">Создать новую карту.</p>
				<p>Не работает</p>
				<fieldset>
					<label for="familyName">Фамилия</label>
					<input type="text" name="familyName" class="text ui-widget-content ui-corner-all" />
					<label for="firstName">Имя</label>
					<input type="text" name="firstName" value="" class="text ui-widget-content ui-corner-all" />
					<label for="patronymic">Отчество</label>
					<input type="text" name="patronymic" value="" class="text ui-widget-content ui-corner-all" />
				</fieldset>
			-->
			</div>
			</form>
		</div>
	</div>
	

<?php // Начать окончить или отменить приём ?>
<div id="sessionStartEnd">
	<div id="sessionStart" class="button big icon clock">Начать приём</div>
	<!-- <div id="sessionEnd" class="button big icon approve">Закончить приём</div> -->
	<!-- <div id="editReception" class="button danger icon edit">Изменить</div> -->
	<div id="removeEvent" class="button danger icon trash">Удалить</div>
</div>
<div id="endSession">
	<!-- <div id="sessionStart" class="button big icon clock">Начать приём</div> -->
	<div id="sessionEnd" class="button big icon approve">Закончить приём</div>
	<!-- <div id="editReception" class="button danger icon edit">Изменить</div> -->
	<!-- <div id="removeEvent" class="button danger icon trash">Удалить</div> -->
</div>
<?php include( TEMPLATE_PATH . '/include/footer.php' );?>