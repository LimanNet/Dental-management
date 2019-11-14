
<?php include( TEMPLATE_PATH . '/include/header.php' );?>
<link rel="stylesheet" type="text/css" href="css/calendar.css" />
<?php
	
	/* Распорядок работы */
	
	
?>

 
 
<script>

  var year = new Date().getFullYear();
  var month = new Date().getMonth();
  var day = new Date().getDate();
  
	$(document).ready(function(){
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var opClient;
		
		var calendar = $('#calendar').fullCalendar({
			
			header: {
				left: 'prev,next today',
				center: 'prev title next',
				right: 'month,agendaWeek,agendaDay'
			},
			
			defaultView: 'agendaWeek',
			firstDay: 1,
			
			timeFormat:  'HH:mm { - HH:mm}',
			axisFormat: 'HH:mm { - HH:mm}',
			agenda: 'h:mm{ - h:mm}', // 5:00 - 6:30
			
			firstHour: 8,
			minTime: 7,
			maxTime: 22,
			
			hourLine: true,
			timeslotsPerHour: 6,
			
			allDaySlot: false,
			timeslotHeigh: 30,
			slotMinutes: 30,
			
			selectable: true,
			selectHelper: true,
			editable: true,
			handleWindowResize: false,
			
			
			events: 'ajax.php?op=allEvents',		// Приёмы
			
			
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
				
				// Инициализация даты и длительности приёма
				$( "#datePicker" ).val( d + "." + m + "."+ y );
				$( "#add-form" ).dialog( "open" );
					
					var deltaTime = (end.getHours() - start.getHours())*60 + Math.abs(end.getMinutes() - start.getMinutes());
					
					var normStart = $.fullCalendar.formatDate( start, 'dd.MM.yyyy HH:mm' );
					var normEnd = $.fullCalendar.formatDate( end, 'dd.MM.yyyy HH:mm' );
					
				$('[name=startEvent]').val(  $.fullCalendar.formatDate( start, 'dd.MM.yyyy HH:mm' ) );
				$('[name=endEvent]').val( $.fullCalendar.formatDate( end, 'dd.MM.yyyy HH:mm' ) );
				$('[name=deltaEvent]').val( deltaTime );
				
				
				
					
				
				/*
				var title = prompt('Event Title:','');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: false
						},
						
						true // make the event "stick"
					);
				
					$.ajax({
						type: 'POST',
						//url: 'ajax.php',
						data:
						{
							title: title,
							start: start,
							end: end,
							allDay: false,
							op: 'add'
						},
						success: function(result) {
							$('#res').html(result);
						},
						complete: function() { alert("Завершение выполнения"); },
						error: function() { alert('there was an error while fetching events!'); },
						color: 'yellow',   // a non-ajax option
						textColor: 'black' // a non-ajax option
					});
				}*/
				
				calendar.fullCalendar('unselect');
			},
			
			
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
			
			// Двойное нажатие на приём
			eventRender: function(event, element) {
				element.bind('contextmenu', function() {
					event.title = "Started!";
				$('#startEvent').val(event.start);
				
				// Инициализация даты и длительности приёма
				$( "#datePicker" ).val( d + "." + m + "."+ y );
				$( "#add-form" ).dialog( "open" );
					
					//var hours = end.getHours() - start.getHours();
					//var minutes = end.getMinutes() - start.getMinutes();
					//if( minutes < 0 ){
					//	hours = hours - 1;
					//	minutes = Math.abs(minutes);
					//}
				//$( "#hoursAmount" ).val( hours );
				//$( "#minutesAmount" ).val( minutes );
				
				$('#endEvent').html(event.end);
				//$('#minuteDeltaAmount').html(end.getTime()-start.getTime());
				
				});
			},
			
			// Нажатие на приём
			eventClick: function(event, element) {
				// Проверка на прошедшее время
				if (event.end < date ){
					alert('Нельзя производить действия над прошедшими приёмами!');
					return false;
				}
				$(function() {
						$( "#startEndSession" ).dialog( "open" );
					});
				
				$('#calendar').fullCalendar('updateEvent', event);

			},
			
			

			
			/**
			* 
			*	Перенисение приёма на другой день и время
			*
			**/
			eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

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

				if (confirm("Вы действительно желаете внести эти изменения?")) {
					$.ajax({
						type: 'POST',
						url: 'ajax.php',
						data:
							{
								id: event.id,
								title: event.title,
								dayDelta: dayDelta,
								minuteDelta: minuteDelta,
								op: 'editDrop'
							},
						success: function(result){
							alert('Изменения внесены!');
							$('#res').html(result.id);
						}
					});
					
				}else{revertFunc();}

			},
			
			// Изменения времени приёма
			eventResize: function(event,dayDelta,minuteDelta,revertFunc){
				
				alert(
					"The end date of " + event.title + "has been moved " +
						dayDelta + " days and " +
						minuteDelta + " minutes."
				);
				
				if(confirm("is this okay?")){
					$.ajax({
						type: "POST",
						url: "ajax.php",
						data:
							{
								id: event.id,
								minuteDelta: minuteDelta,
								op: "editResize"
							},
						success: function(result){
							alert('Изменения внесены!');
							$('#res').html(result);
						}
					});
				}else{revertFunc();}
				
			}
			
		});
	
		/**
		* 
		*	Настройка datePickerа
		*
		**/
		$(".datePicker").datepicker({
			firstDay: 1,
			changeMonth: true,
			changeYear: true,
			dayNamesMin:		["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
			dayNames:			["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],
			monthNamesShort:	['Янв.','Фев.','Март','Апр.','Май','Июнь','Июль','Авг.','Сент.','Окт.','Ноя.','Дек.'],
			monthNames:			['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			minDate: date,
			dateFormat: "dd.mm.yy",
			showOn: "button",
			buttonImage: "images/calendar.gif",
			buttonImageOnly: true
			
		});
		
				
				
	
	// Объявление вкладок

	$( "#tabs" ).tabs();
	// Создание или выбор пациента
	$("#choicePatient").click(function(){
		opClient = "choicePatient";
	});
	$("#createPatient").click(function(){
		opClient = "createPatient";
	});

	/* Вид и отправка формы */

	var name = $( "#name" );
	var email = $( "#email" );
	var password = $( "#password" );
	var allFields = $( [] ).add( name ).add( email ).add( password );
	var tips = $( ".validateTips" );
	
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
				bValid = bValid && checkLength( name, "username", 3, 16 );
				bValid = bValid && checkLength( email, "email", 6, 80 );
				bValid = bValid && checkLength( password, "password", 5, 16 );
				bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				if ( bValid ) {
					$( "#users tbody" ).append(
						"<tr>" +
							"<td>" + name.val() + "</td>" +
							"<td>" + email.val() + "</td>" +
							"<td>" + password.val() + "</td>" +
						"</tr>"
					);
					$( this ).dialog( "close" );
				}
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$(function() {
		$( "#startEndSession" ).dialog( { autoOpen: false } );
	});
	
	
	
	
	
	
	
	$("[name=client]").keyup(function(event){
		
		console.log(this.value);
					
		$.ajax({
			type: "POST",
			url: "ajax.php",
			data: {
				letters: this.value,
				op : 'searhByLetter'
			},
			success: function(result){
				$('#patientList').html(result);
			}
		});
		
	});

	//  Диалоговое окно
	$("#editReception").click(function(){
	// Инициализация даты и длительности приёма
		$( "#datePicker" ).val( d + "-" + m + "-"+ y );
		$( "#add-form" ).dialog( "open" );
					
			var hours = end.getHours() - start.getHours();
			var minutes = end.getMinutes() - start.getMinutes();
			if( minutes < 0 ){
				hours = hours - 1;
				minutes = Math.abs(minutes);
			}
		$( "#hoursAmount" ).val( hours );
		$( "#minutesAmount" ).val( minutes );
		$('#startEvent').html(start);
		$('#endEvent').html(end);
		$('#minuteDeltaAmount').html(end.getTime()-start.getTime());
	});
	
	// Изменение длительности приёма
					$( "#minuteDeltaSlider" ).slider({
						range: "min",
						min: 5,
						max: 170,
						value: 30,
						step: 5,
						slide: function( event, ui ) {
							$( "[name=deltaEvent]" ).val( ui.value );
							//$( "[name=endEvent]" ).val( start+ui.value );
						}
					});
					$( "[name=deltaEvent]" ).val( $( "#minuteDeltaSlider" ).slider( "value" ) );
	
	
});	


					
					
				/**
				* 
				*	Выбор пациента
				*
				**/
	
				function selectPatient(patientId){
					//var patientId = $(this).attr("patientId");
					
					console.log("patient id: "+patientId);
				}
				
</script>
<div id='calendar'></div>
<div class='clear'></div>

<div id="res"></div>

<h2 class="demoHeaders">Dialog</h2>

<?php // Форма для создания приёмов ?>
<div id="add-form" title="Запланировать приём">

	<div class="leftForm">
		<div>Дата и продолжительность</div>
		<table style="width:100%">
			<tr>
				<td>Нач</td>
				<td>
					<input type="datetime" name="startEvent" />
				</td>
			</tr>
			<tr>
				<td>Кон</td>
				<td>
					<input type="datetime" name="endEvent" />
				</td>
			</tr>
			<tr>
				<td>Длит</td>
				<td>
					<div id="minuteDeltaId">					
						<input name="deltaEvent" />
					</div>
				</td>
			</tr>
			<tr>
				
				<td></td>
				<td>
					<div id="minuteDeltaSlider"></div>
				</td>
			</tr>
		</table>
	</div>
	<div class="rightForm">
		<div id="tabs">
			<ul>
				<li><a href="#choicePatient">Выбрать клинта</a></li>
				<li><a href="#cretePatient">Создать новую карту</a></li>
				<input type="hidden" id="doClient" value="choicePatient" />
			</ul>
			<div id="choicePatient">
				<p>
				<label for="searchClient">Найти</label>
				<input id="serchClient" type="search" name="client" />
				</p>
				<p>Выбрать клинта</p>
				<div id="patientList"></div>
			</div>
			<div id="cretePatient">
				
				<p class="validateTips">Создать новую карту.</p>
			<form>
				<fieldset>
					<label for="name">Name</label>
					<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
					<label for="password">Password</label>
					<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
				</fieldset>
			</form>
			</div>
		</div>
	</div>
	

</div>
<?php // Начать окончить или отменить приём ?>
<div id="startEndSession">
	<div class="button big icon clock">Начать приём</div>
	<div class="button big icon approve">Закончить приём</div>
	<div id="editReception" class="button danger icon edit">Изменить</div>
	<div class="button danger icon trash">Удалить</div>
</div>
<?php include( TEMPLATE_PATH . '/include/footer.php' );?>