<?php

/* Зубная формула */

require_once('include/menu.php');

//require_once( CLASS_PATH . "/Patient.php" );

	$idPatient = (int) isset($_SESSION['patientId']) ? $_SESSION['patientId'] : $_GET['patientId'];
	$idDoctor = (int) isset($_SESSION['idDoctor']) ? $_SESSION['idDoctor'] : "";
	$session = (int) isset($_SESSION['session']) ? $_SESSION['session'] : "";
	
	$patient = new Patient;
	$results['patient'] = $patient->getById($idPatient);
	
	require_once ( CLASS_PATH . '/Tooth.php');

	$tooth = new Tooth();
		$tooth->setIdPatient($idPatient);
	$results['toothes'] =	$tooth->getAll();

	// вычисляем возраст
	$year = (int)date('Y') - (int)date("Y", strtotime( $results['patient']['dateOfBirth'] ));
	print_r($_SESSION);
?>


<script>
$(document).ready(function(){
	
	var session  = $("[name=session]").val();
	var idPatient = $("[name=idPatient]").val();
	var idDoctor  = $("[name=idDoctor]").val();
	var idTooth = null;
	
	
  $(".left").toggle('slow');
  $(".tab").toggle();
	$(".title").click(function(e){
		e.preventDefault();
		var tab = $(this).attr('toggel');
		$("."+tab).toggle();
	});
	// Modal Box
	$(".modalbox").click(function(e){
		e.preventDefault();
		var id = $(this).attr('modalbox');
		var overlayHeight = $(document).height(); 
		var overlayWidth = $(window).width(); 
		$('#overlay').css({'width':overlayWidth,'height':overlayHeight}); 
		$('#overlay').fadeIn(500); 
   
		var winH = $(window).height(); 
		var winW = $(window).width(); 
		$(id).css('top', winH/2-$(id).height()/2); 
		$(id).css('left', winW/2-$(id).width()/2); 
		$(id).fadeIn(500);
	});
	$('.window .close').click(function (e) { 
		e.preventDefault(); 
		$('#overlay, .window').fadeOut(200); 
	}); 
	$('#overlay').click(function () { 
		$(this).fadeOut(200); 
		$('.window').fadeOut(200); 
	});
	
	$(".title10").click(function(){$(".tab").hide();$(".tab10").toggle();});
	$(".title11").click(function(){$(".tab").hide();$(".tab11").toggle();});
	
	
	
	
		/**
		*
		* Выбор зуба
		*
		**/
	$("input[name=number_tooth]:radio").change(function(){
			
			idTooth = $(this).val();
			console.log("number_tooth: "+idTooth+' :selectTooth');
			data = {
				op: 'getSelectTooth',
				session: session,				
				idTooth: idTooth,
				idPatient: idPatient,
				idDoctor: idDoctor
			};
			$.ajax({
				type: "POST",  
				url: "function/dentition.php",  
			
				data: data,
			// data: "idPatient="+idPatient+"&idDoctor="+idDoctor+"&number_tooth="+number_tooth+"&"+data,  
				success: function(result){  
					$("#satTooth").html(result);
				}
			});
			//defPost( data, vidget );
	});
	
		/**
		*
		* Состояние зуба
		*
		**/
	$("input.toothstat:radio").change(function(){
		
		if (session == '')  
		{  
			alert ("Эти действия функционирууют, только в рамках начатого приёма.");  
			return false;  
		}
		
		$("input:radio[name="+id_name+"]:checked").val();
		
		var id_name = $(this).attr('name');
		var val = $(this).val();
		console.log(id_name+": "+val);
		data = {
			op: "setStateTooth",
			session: session,
			idPatient: idPatient,
			idTooth: idTooth,
			part: id_name,
			id_state: val
		};
		$.ajax({
			type: "POST",  
			url: "function/dentition.php",  
			
			data: data,
			success: function(result){  
				$("#satTooth").html(result);
			}
		});
	});
	
		/**
		*
		* Работы над зубом
		*
		**/
	$(".work").click(function(){
		var val = $(this).attr('value');
		
		var idPatient = $("[name=idPatient]").val();
		if (idPatient =='')  
		{  
			alert ("Пациент не выбран!"); 
			return false;  
		}
		var idDoctor  = $("[name=idDoctor]").val();
		if (idDoctor == null)  
		{  
			alert ("Вас не удалось распознать, перезайдите ещё раз!");  
			return false;  
		}
		var session  = $("[name=session]").val();
		if (session == '')  
		{  
			alert ("Приём не начат.");  
			return false;  
		}
		var number_tooth  = $("input:radio[name=number_tooth]:checked").val();
		if ( number_tooth==null )  
		{  
			$(this).removeAttr("checked");
			alert ("Выберите зуб!");  
			return false;  
		}
		
		data = {
			op: "setWorksIdTooth",
			session: session,
			idDoctor: idDoctor,
			idPatient: idPatient,
			idTooth: idTooth,
			works: val
		};
		$.ajax({
			type: "POST",  
			url: "function/dentition.php",  
			
			data: data,
			success: function(result){  
				$("#worksis").html(result);
			}
		});
		//vidget = "#worksis";
		
	});
	
		/**
		*
		* Диагноз зуба
		*
		**/
	$(".diagnosis").click(function(){
		var val = $(this).attr('value');
		
		var idPatient = $("[name=idPatient]").val();
		if (idPatient =='')  
		{  
			alert ("Пациент не выбран!"); 
			return false;  
		}
		var idDoctor  = $("[name=idDoctor]").val();
		if (idDoctor == null)  
		{  
			alert ("Вас не удалось распознать, перезайдите ещё раз!");  
			return false;  
		}
		var session  = $("[name=session]").val();
		if (session == '')  
		{  
			alert ("Приём не начат.");  
			return false;  
		}
		var number_tooth  = $("input:radio[name=number_tooth]:checked").val();
		if ( number_tooth==null )  
		{  
			$(this).removeAttr("checked");
			alert ("Выберите зуб!");  
			return false;  
		}
		
		data = {
			op: "setDiagnosisIdTooth",
			session: session,
			idDoctor: idDoctor,
			idPatient: idPatient,
			idTooth: idTooth,
			diagnosis: val
		};
		$.ajax({
			type: "POST",  
			url: "function/dentition.php",  
			
			data: data,
			success: function(result){  
				$("#diagnosis").html(result);
			}
		});
		
	});
	
	
});
function defPost( data, vidget ){
	console.log(data);
	var idPatient = $("#idPatient").val();
		if (idPatient =='')  
		{  
			alert ("Пациент не выбран!"); 
			return false;  
		}
		var idDoctor  = $("#idDoctor").val();
		if (idDoctor =='')  
		{  
			alert ("Вас не удалось распознать, перезайдите ещё раз!");  
			return false;  
		}
		var session  = $("[name=session]").val();
		if (session == '')  
		{  
			alert ("Приём не начат.");  
			return false;  
		}
		var number_tooth  = $("input:radio[name=number_tooth]:checked").val();
		if ( number_tooth==null )  
		{  
			$(this).removeAttr("checked");
			alert ("Выберите зуб!");  
			return false;  
		}
		
		if(vidget==null)vidget="span";
		var def = {
				session: session,
				idPatient: idPatient,
				idDoctor: idDoctor,
				number_tooth: number_tooth
			};
		data = $.extend(def,data);
		$.ajax({  
			type: "POST",  
			url: "function/dentition.php",  
			
			data: data,
			//data: "idPatient="+idPatient+"&idDoctor="+idDoctor+"&number_tooth="+number_tooth+"&"+data,  
			success: function(result){  
				$(vidget).html(result);
			}  
		});
}
</script>
<div id="boxes">
  <div id="overlay"></div> 
</div>
<span></span>
<link rel="stylesheet" type="text/css" href="css/dentition.css">
<div class="card box">
	
	<div class='head cart' style='text-align:center;'>
		<h3>Зубная формула</h3>
		<h4>
			<?php echo htmlspecialchars( $results['patient']['familyName'] );?>
			<?php echo htmlspecialchars( $results['patient']['firstName'] );?>
			<?php echo htmlspecialchars( $results['patient']['patronymic'] );?>
			<?php echo $year . " лет";?>
		</h4>
	</div>
	
<div class='description'>
<form id="dentition" action='function/dentition.php' name='dentition' method="post">
	<input type='hidden' name='session' value='<?php echo $session; ?>'>
	<input type='hidden' name='idPatient' value='<?php echo htmlspecialchars( (int)$results['patient']['id'] ); ?>'>
	<input type='hidden' name='idDoctor' value='<?php echo $idDoctor; ?>'>
	<div class='dentition box'>
		<div class='toothformul'>
			<div class='upper'>
				<?php
					for($i=18;$i>=11;$i--){
						echo "<input type='radio' id='tooth".$i."' name='number_tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna crown'></div>";
							echo "<div class='decna gingiva'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna add_crown'></div>";
							
							echo "<div class='decna toothnumber'>".$i."</div>";
							if($i<=13){
								echo "<div class='tootharea4'>";
		
									echo "<div class='tootharea4right'></div>";
									echo "<div class='tootharea4top'></div>";
									echo "<div class='tootharea4bottom'></div>";
									echo "<div class='tootharea4left'></div>";
	
								echo "</div>";
							}else{
								echo "<div class='tootharea'>";
									echo "	<div class='toothareatop'></div>";
									echo "	<div class='tootharealeft'></div>";
									echo "	<div class='toothareacenter'></div>";
									echo "	<div class='tootharearight'></div>";
									echo "	<div class='toothareadown'></div>";
								echo "</div>";
							}
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
					for($i=21;$i<=28;$i++){
						echo "<input type='radio' id='tooth".$i."' name='number_tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna crown'></div>";
							echo "<div class='decna gingiva'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna add_crown'></div>";
							
							echo "<div class='decna toothnumber'>".$i."</div>";
							if($i<=23){
								echo "<div class='tootharea4'>";
		
									echo "<div class='tootharea4right'></div>";
									echo "<div class='tootharea4top'></div>";
									echo "<div class='tootharea4bottom'></div>";
									echo "<div class='tootharea4left'></div>";
	
								echo "</div>";
							}else{
								echo "<div class='tootharea'>";
									echo "	<div class='toothareatop'></div>";
									echo "	<div class='tootharealeft'></div>";
									echo "	<div class='toothareacenter'></div>";
									echo "	<div class='tootharearight'></div>";
									echo "	<div class='toothareadown'></div>";
								echo "</div>";
							}
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
				?>
			</div>

			<div class="lower">
				<?php
					for($i=48;$i>=41;$i--){
						echo "<input type='radio' id='tooth".$i."' name='number_tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth lotooth'>";
						echo "<div>";
							echo "<div class='decna crown'></div>";
							echo "<div class='decna gingiva'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna add_crown'></div>";
							
							echo "<div class='decna toothnumber'>".$i."</div>";
							if($i<=43){
								echo "<div class='tootharea4'>";
		
									echo "<div class='tootharea4right'></div>";
									echo "<div class='tootharea4top'></div>";
									echo "<div class='tootharea4bottom'></div>";
									echo "<div class='tootharea4left'></div>";
	
								echo "</div>";
							}else{
								echo "<div class='tootharea'>";
									echo "	<div class='toothareatop'></div>";
									echo "	<div class='tootharealeft'></div>";
									echo "	<div class='toothareacenter'></div>";
									echo "	<div class='tootharearight'></div>";
									echo "	<div class='toothareadown'></div>";
								echo "</div>";
							}
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
					for($i=31;$i<=38;$i++){
						echo "<input type='radio' id='tooth".$i."' name='number_tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth lotooth'>";
						echo "<div>";
							echo "<div class='decna crown'></div>";
							echo "<div class='decna gingiva'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna add_crown'></div>";
							
							echo "<div class='decna toothnumber'>".$i."</div>";
							if($i<=33){
								echo "<div class='tootharea4'>";
		
									echo "<div class='tootharea4right'></div>";
									echo "<div class='tootharea4top'></div>";
									echo "<div class='tootharea4bottom'></div>";
									echo "<div class='tootharea4left'></div>";
	
								echo "</div>";
							}else{
								echo "<div class='tootharea'>";
									echo "	<div class='toothareatop'></div>";
									echo "	<div class='tootharealeft'></div>";
									echo "	<div class='toothareacenter'></div>";
									echo "	<div class='tootharearight'></div>";
									echo "	<div class='toothareadown'></div>";
								echo "</div>";
							}
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
				?>
				
			</div>
		</div>
	</div>
	
		<div id="infopanel" class="box">
			<p>
				<h4>Состояние зуба</h4>
				<div id="satTooth"></div>
			</p>
			<p>
				<h4>Работы</h4>
				<div id="worksis"></div>
			</p>
			<p>
				<h4>Диагноз</h4>
				<div id="diagnosis"></div>
			</p>
		</div>
	<div class="clear"></div>

<div>
	
		<p>
			<?php
				//echo 'Лечущий врач:';
				//echo htmlspecialchars( $results['patient']['doctors'] );
				//echo '<br/>';
			?>
		</p>
		<div class="blockColumnsx3">
			<div class="colx3 col">

	

		<p>
			<ul>
			<?php
				require_once ( CLASS_PATH . '/catalog/ToothPart.php' );
				require_once ( CLASS_PATH . '/catalog/ToothState.php' );
				$toothPart = new ToothPart();
				$toothPart = $toothPart->getAll();
				$toothState = new ToothState();
				$toothState = $toothState->getAll();
				
				foreach($toothPart as $result=>$value){
					echo '<li class="title" toggel="toothPart'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab toothPart'.$value['id'].'">';
						foreach($toothState as $res=>$val){
							$val['ids_tooth_part'] = explode(",", $val['ids_tooth_part']);
							if( in_array($value['id'],$val['ids_tooth_part']) ){
								
								if($value['name']=='Коронковая часть'){
									echo '<li><div class="modalbox" modalbox="#dialog'.$val['id'].'"><div>'.$val['name'].'</div><div class="color" style="background:'.$val['color'].'"></div></div></li>';
									echo '<div id="boxes">
									<div id="dialog'.$val['id'].'" class="window box">
										<input class="toothstat" type="radio" id="crown_first'.$val['id'].'"	name="crown_first"	value="'.$val['id'].'"/><label for="crown_first'.$val['id'].'">Часть 1</label><br/>
										<input class="toothstat" type="radio" id="crown_second'.$val['id'].'"	name="crown_second"	value="'.$val['id'].'"/><label for="crown_second'.$val['id'].'">Часть 2</label><br/>
										<input class="toothstat" type="radio" id="crown_thrid'.$val['id'].'"	name="crown_thrid"	value="'.$val['id'].'"/><label for="crown_thrid'.$val['id'].'">Часть 3</label><br/>
										<input class="toothstat" type="radio" id="crown_fourth'.$val['id'].'"	name="crown_fourth"	value="'.$val['id'].'"/><label for="crown_fourth'.$val['id'].'">Часть 4</label><br/>
										<input class="toothstat" type="radio" id="crown_fifth'.$val['id'].'"	name="crown_fifth"	value="'.$val['id'].'"/><label for="crown_fifth'.$val['id'].'">Часть 5</label><br/>
										<input class="toothstat" type="radio" id="crown_sixth'.$val['id'].'"	name="crown_sixth"	value="'.$val['id'].'"/><label for="crown_sixth'.$val['id'].'">Часть 6</label><br/>
									</div><div id="overlay"></div></div>';
								}elseif($value['name']=='Корневая часть'){
									echo '<li><div class="modalbox" modalbox="#dialog'.$val['id'].'"><div>'.$val['name'].'</div><div class="color" style="background:'.$val['color'].'"></div></div></li>';
									echo '<div id="boxes">
									<div id="dialog'.$val['id'].'" class="window box">
										<input class="toothstat" type="radio" id="root_first'.$val['id'].'"		name="root_first"	value="'.$val['id'].'"/><label for="root_first'.$val['id'].'">Корень 1</label><br/>
										<input class="toothstat" type="radio" id="root_second'.$val['id'].'"	name="root_second"	value="'.$val['id'].'"/><label for="root_second'.$val['id'].'">Корень 2</label><br/>
										<input class="toothstat" type="radio" id="root_thrid'.$val['id'].'"		name="root_thrid"	value="'.$val['id'].'"/><label for="root_thrid'.$val['id'].'">Корень 3</label><br/>
									</div><div id="overlay"></div> </div>';
								}elseif($value['name']=='Канал'){
									echo '<li><div class="modalbox" modalbox="#dialog'.$val['id'].'"><div>'.$val['name'].'</div><div class="color" style="background:'.$val['color'].'"></div></div></li>';
									echo '<div id="boxes">
									<div id="dialog'.$val['id'].'" class="window box">
										<input class="toothstat" type="radio" id="canal_first'.$val['id'].'"	name="canal_first"	value="'.$val['id'].'"/><label for="canal_first'.$val['id'].'">Канал 1</label><br/>
										<input class="toothstat" type="radio" id="canal_second'.$val['id'].'"	name="canal_second"	value="'.$val['id'].'"/><label for="canal_second'.$val['id'].'">Канал 2</label><br/>
										<input class="toothstat" type="radio" id="canal_thrid'.$val['id'].'"	name="canal_thrid"	value="'.$val['id'].'"/><label for="canal_thrid'.$val['id'].'">Канал 3</label><br/>
										<input class="toothstat" type="radio" id="canal_fourth'.$val['id'].'"	name="canal_fourth"	value="'.$val['id'].'"/><label for="canal_fourth'.$val['id'].'">Канал 4</label><br/>
										<input class="toothstat" type="radio" id="canal_fifth'.$val['id'].'"	name="canal_fifth"	value="'.$val['id'].'"/><label for="canal_fifth'.$val['id'].'">Канал 5</label><br/>
									</div><div id="overlay"></div> </div>';
								}elseif($value['name']=='Имплантант'){
									echo '<li><div class="modalbox" modalbox="#dialog'.$val['id'].'"><div>'.$val['name'].'</div><div class="color" style="background:'.$val['color'].'"></div></div></li>';
									echo '<div id="boxes">
										<div id="dialog'.$val['id'].'" class="window box">
											<input class="toothstat" type="radio" id="implant_first'.$val['id'].'"	name="implant_first"	value="'.$val['id'].'"><label for="implant_first'.$val['id'].'">Имплантант 1</label><br/>
											<input class="toothstat" type="radio" id="implant_second'.$val['id'].'"	name="implant_second"	value="'.$val['id'].'"><label for="implant_second'.$val['id'].'">Имплантант 2</label><br/>
											<input class="toothstat" type="radio" id="implant_thrid'.$val['id'].'"	name="implant_thrid"	value="'.$val['id'].'"><label for="implant_thrid'.$val['id'].'">Имплантант 3</label><br/>
										</div></div>';
								}else{
									echo '<div>
										<li>
											<input class="toothstat" type="radio" id="'.$value['name_en'].$val['id'].'"	name="'.$value['name_en'].'"	value="'.$val['id'].'" />
											<label for="'.$value['name_en'].$val['id'].'">
											<div>'.$val['name'].'</div>
											<div class="color" style="background:'.$val['color'].'"></div>
											</label>
										</li></div>';
								}
								
							}
						}
					echo '</ul>';
					echo '<div class="clear"></div>';
				}
			?>
			</ul>	
		
		</div>
		<div class="colx3 col">

		<p>
			<ul>
			<?php
				//echo 'Тип диагнозов';
				require_once ( CLASS_PATH . '/catalog/WorkGroup.php' );
				require_once ( CLASS_PATH . '/catalog/Price.php' );
				$workGroup = new WorkGroup();
				$workGroup = $workGroup->getAll();
				
				$price = new Price();
				$price = $price->getAll();
				
				
				foreach($workGroup as $result=>$value){
					echo '<li class="title" toggel="tab'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab tab'.$value['id'].'">';
						foreach($price as $res=>$val){
							$val['ids_work_group'] = explode(",", $val['ids_work_group']);
							if( in_array($value['id'],$val['ids_work_group']) ){
								echo '<li><div class="work" value="'.$val['id'].'" >'.$val['name'].' ('.$val['summ'].')'.'</div></li>';
							}
						}
					echo '</ul>';
				}
			?>
			</ul>	
		</p><br />
		</div>
		<div class="colx3 col">

		<p>
			<ul>
			<?php
				require_once ( CLASS_PATH . '/catalog/Diagnosis_type.php' );
				require_once ( CLASS_PATH . '/catalog/Diagnosis.php' );
				$diagnosisType = new Diagnosis_Type();
				$diagnosisType = $diagnosisType->getAll();
				$diagnosis = new Diagnosis();
				$diagnosis = $diagnosis->getAll();
				
				foreach($diagnosisType as $result=>$value){
					echo '<li class="title" toggel="diagType'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab diagType'.$value['id'].'">';
						foreach($diagnosis as $res=>$val){
							$val['id_diagnosis_type'] = explode(",", $val['id_diagnosis_type']);
							if( in_array($value['id'],$val['id_diagnosis_type']) ){
								echo '<li><div class="diagnosis" value="'.$val['id'].'" id="diagnos'.$val['id'].'">'.$val['name_full'].' ('.$val['name'].')'.'</div></li>';
							}
						}
					echo '</ul>';
				}
			?>
			</ul>	
		</p>
		</div>
		</div>
		<div class="clear"></div>
		<br />
		
	</div>
	<input type='submit'>
</form>
</div>