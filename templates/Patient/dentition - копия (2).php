<?php

/* Зубная формула */

include ('include/menu.php');
require_once ( CLASS_PATH . '/Tooth.php');

$tooth = new Tooth();
		$tooth->setIdPatient('1');
		$tooth->getIdPatient();
$res =	$tooth->getAll();
if($res==null){
	echo "null";
}
print_r($res);

			
				echo 'Лечущий врач:';
				echo htmlspecialchars( $results['patient']['doctors'] );
				echo '<br/>';
			
		


?>
<?php
	$year = (int)date('Y') - (int)date("Y", strtotime( $results['patient']['dateOfBirth'] )); // вычисляем возраст
?>


<script>
$(document).ready(function(){
  $(".left").toggle('slow');
  $(".tab").toggle();
	$(".title1").click(function(){$(".tab1").toggle();});
	$(".title2").click(function(){$(".tab2").toggle();});
	$(".title3").click(function(){$(".tab3").toggle();});
	$(".title4").click(function(){$(".tab4").toggle();});
	$(".title5").click(function(){$(".tab5").toggle();});
	$(".title6").click(function(){$(".tab6").toggle();});
	$(".title7").click(function(){$(".tab7").toggle();});
	$(".title8").click(function(){$(".tab8").toggle();});
	$(".title9").click(function(){$(".tab9").toggle();});
	$(".title10").click(function(){$(".tab").hide();$(".tab10").toggle();});
	$(".title11").click(function(){$(".tab").hide();$(".tab11").toggle();});
	
});
</script>
<link rel="stylesheet" type="text/css" href="css/dentition.css">
<div class="card box">
	
	<div class='head cart' style='text-align:center;'>
		<h3>Зубная формула</h3>
		<h4>
			<?php echo htmlspecialchars( $results['patient']['familyName'] );?>
			<?php echo htmlspecialchars( $results['patient']['firstName'] );?>
			<?php echo htmlspecialchars( $results['patient']['patronymic'] );?>
			<?php echo $year . " год";?>
		</h4>
	</div>
	
<div class='description'>
<form action='dentition.php' name='dentition'>
	<input type='hidden' name='id_patient' value='<?php echo htmlspecialchars( (int)$results['patient']['id'] );?>'>
	<input type='hidden' name='id_doctor' value='<?php echo htmlspecialchars( (int)$results['patient']['doctors'] );?>'>
	<div class='dentition box'>
		<div class='toothformul'>
			<div class='upper'>
				<?php
					for($i=18;$i>=11;$i--){
						echo "<input type='radio' id='tooth".$i."' name='tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna dec1'></div>";
							echo "<div class='decna dec2'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna dec3'></div>";
							
							echo "<div class='decna dec4'>".$i."</div>";
							echo "<div class='tootharea'>";
								echo "	<div class='toothareatop'></div>";
								echo "	<div class='tootharealeft'></div>";
								echo "	<div class='toothareacenter'></div>";
								echo "	<div class='tootharearight'></div>";
								echo "	<div class='toothareadown'></div>";
							echo "</div>";
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
					for($i=21;$i<=28;$i++){
						echo "<input type='radio' id='tooth".$i."' name='tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna dec1'></div>";
							echo "<div class='decna dec2'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna dec3'></div>";
							
							echo "<div class='decna dec4'>".$i."</div>";
							echo "<div class='tootharea'>";
								echo "	<div class='toothareatop'></div>";
								echo "	<div class='tootharealeft'></div>";
								echo "	<div class='toothareacenter'></div>";
								echo "	<div class='tootharearight'></div>";
								echo "	<div class='toothareadown'></div>";
							echo "</div>";
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
				?>
			</div>

			<div class="lower">
				<?php
					for($i=48;$i>=41;$i--){
						echo "<input type='radio' id='tooth".$i."' name='tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna dec1'></div>";
							echo "<div class='decna dec2'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna dec3'></div>";
							
							echo "<div class='decna dec4'>".$i."</div>";
							echo "<div class='tootharea'>";
								echo "	<div class='toothareatop'></div>";
								echo "	<div class='tootharealeft'></div>";
								echo "	<div class='toothareacenter'></div>";
								echo "	<div class='tootharearight'></div>";
								echo "	<div class='toothareadown'></div>";
							echo "</div>";
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
					for($i=31;$i<=38;$i++){
						echo "<input type='radio' id='tooth".$i."' name='tooth' value='".$i."'>";
						echo "<label for='tooth".$i."' class='tooth uptooth'>";
						echo "<div>";
							echo "<div class='decna dec1'></div>";
							echo "<div class='decna dec2'></div>";
							echo "<div class='zyb t".$i."'><img src='images/dentition/tooth".$i.".png' /></div>";
							echo "<div class='decna dec3'></div>";
							
							echo "<div class='decna dec4'>".$i."</div>";
							echo "<div class='tootharea'>";
								echo "	<div class='toothareatop'></div>";
								echo "	<div class='tootharealeft'></div>";
								echo "	<div class='toothareacenter'></div>";
								echo "	<div class='tootharearight'></div>";
								echo "	<div class='toothareadown'></div>";
							echo "</div>";
							echo "<div class='clear'></div>";
						echo "</div>";
						echo "</label>";
					}
				?>
				
			</div>
		</div>
	</div>
		
	<div class="description">
		<div class="dentition box">
		<div class="toothformul">
			<div class="upper">
				<input type='radio' id='tooth18' name='tooth'>
				<label for='tooth18' class="tooth uptooth">
				<div>					
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="zyb t18"><img src="images/cache/tooth18k3.png" /></div>
					<div class="decna dec3"></div>
					
					<div class="decna dec4">18</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth17' name='tooth'>
				<label for='tooth17' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t17"><img src="images/cache/tooth17k3.png" /></div>
					<div class="decna dec4">17</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth16' name='tooth'>
				<label for='tooth16' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t16"><img src="images/cache/tooth16k3.png" /></div>
					<div class="decna dec4">16</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth15' name='tooth'>
				<label for='tooth15' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t15"><img src="images/cache/tooth15k1.png" /></div>
					<div class="decna dec4">15</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth14' name='tooth'>
				<label for='tooth14' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t14"><img src="images/cache/tooth14k1.png" /></div>
					<div class="decna dec4">14</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth13' name='tooth'>
				<label for='tooth13' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t13"><img src="images/cache/tooth13k1.png" /></div>
					<div class="decna dec4">13</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth12' name='tooth'>
				<label for='tooth12' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t12"><img src="images/cache/tooth12k1.png" /></div>
					<div class="decna dec4">12</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth11' name='tooth'>
				<label for='tooth11' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t11"><img src="images/cache/tooth11k1.png" /></div>
					<div class="decna dec4">11</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth21' name='tooth'>
				<label for='tooth21' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t21"><img src="images/cache/tooth21k1.png" /></div>
					<div class="decna dec4">21</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth22' name='tooth'>
				<label for='tooth22' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t22"><img src="images/cache/tooth22k1.png" /></div>
					<div class="decna dec4">22</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth23' name='tooth'>
				<label for='tooth23' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t23"><img src="images/cache/tooth23k1.png" /></div>
					<div class="decna dec4">23</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth24' name='tooth'>
				<label for='tooth24' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t24"><img src="images/cache/tooth24k1.png" /></div>
					<div class="decna dec4">24</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth25' name='tooth'>
				<label for='tooth25' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t25"><img src="images/cache/tooth25k1.png" /></div>
					<div class="decna dec4">25</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth26' name='tooth'>
				<label for='tooth26' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t26"><img src="images/cache/tooth26k3.png" /></div>
					<div class="decna dec4">26</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth27' name='tooth'>
				<label for='tooth27' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t27"><img src="images/cache/tooth27k3.png" /></div>
					<div class="decna dec4">27</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth28' name='tooth'>
				<label for='tooth28' class="tooth uptooth">
				<div>
					<div class="decna dec1"></div>
					<div class="decna dec2"></div>
					<div class="decna dec3"></div>
					<div class="zyb t28"><img src="images/cache/tooth28k3.png" /></div>
					<div class="decna dec4">28</div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="clear"></div>
				</div>
				</label>
			</div>

			<div class="lower">
				<input type='radio' id='tooth48' name='tooth'>
				<label for='tooth48' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">48</div>
					<div class="zyb t48"><img src="images/cache/tooth48k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth47' name='tooth'>
				<label for='tooth47' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">47</div>
					<div class="zyb t47"><img src="images/cache/tooth47k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth46' name='tooth'>
				<label for='tooth46' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">46</div>
					<div class="zyb t46"><img src="images/cache/tooth46k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth45' name='tooth'>
				<label for='tooth45' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">45</div>
					<div class="zyb t45"><img src="images/cache/tooth45k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth44' name='tooth'>
				<label for='tooth44' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">44</div>
					<div class="zyb t44"><img src="images/cache/tooth44k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth43' name='tooth'>
				<label for='tooth43' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">43</div>
					<div class="zyb t43"><img src="images/cache/tooth43k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth42' name='tooth'>
				<label for='tooth42' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">42</div>
					<div class="zyb t42"><img src="images/cache/tooth42k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth41' name='tooth'>
				<label for='tooth41' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">41</div>
					<div class="zyb t41"><img src="images/cache/tooth41k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth31' name='tooth'>
				<label for='tooth31' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">31</div>
					<div class="zyb t31"><img src="images/cache/tooth31k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth32' name='tooth'>
				<label for='tooth32' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">32</div>
					<div class="zyb t32"><img src="images/cache/tooth32k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth33' name='tooth'>
				<label for='tooth33' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">33</div>
					<div class="zyb t33"><img src="images/cache/tooth33k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth34' name='tooth'>
				<label for='tooth34' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">34</div>
					<div class="zyb t34"><img src="images/cache/tooth34k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth35' name='tooth'>
				<label for='tooth35' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">35</div>
					<div class="zyb t35"><img src="images/cache/tooth35k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth36' name='tooth'>
				<label for='tooth36' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">36</div>
					<div class="zyb t36"><img src="images/cache/tooth36k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth37' name='tooth'>
				<label for='tooth37' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">37</div>
					<div class="zyb t37"><img src="images/cache/tooth37k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
				<input type='radio' id='tooth38' name='tooth'>
				<label for='tooth38' class="tooth lotooth">
				<div>
					<div class="tootharea">
						<div class="toothareatop"></div>
						<div class="tootharealeft"></div>
						<div class="toothareacenter"></div>
						<div class="tootharearight"></div>
						<div class="toothareadown"></div>
					</div>
					<div class="decna dec4">38</div>
					<div class="zyb t38"><img src="images/cache/tooth38k3.png" /></div>
					<div class="decna dec3"></div>
					<div class="decna dec2"></div>
					<div class="decna dec1"></div>
					
					<div class="clear"></div>
				</div>
				</label>
			</div>
			</div>
		</div>
			
		</div>
		<div id="infopanel" class="box">
			<p>
				<h4>Состояние зуба</h4>
				
			</p>
			<p>
				<h4>Диагноз</h4>
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
					echo '<li class="title title'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab tab'.$value['id'].'">';
						foreach($toothState as $res=>$val){
							$val['ids_tooth_part'] = explode(",", $val['ids_tooth_part']);
							if( in_array($value['id'],$val['ids_tooth_part']) ){
								echo '<li><div class="color" style="background:'.$val['color'].'"></div>'.$val['name'].'</li>';
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
				echo 'Тип диагнозов';
				require_once ( CLASS_PATH . '/catalog/WorkGroup.php' );
				require_once ( CLASS_PATH . '/catalog/Price.php' );
				$workGroup = new WorkGroup();
				$workGroup = $workGroup->getAll();
				
				$price = new Price();
				$price = $price->getAll();
				
				
				foreach($workGroup as $result=>$value){
					echo '<li class="title title'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab tab'.$value['id'].'">';
						foreach($price as $res=>$val){
							$val['ids_work_group'] = explode(",", $val['ids_work_group']);
							if( in_array($value['id'],$val['ids_work_group']) ){
								echo '<li>'.$val['name'].' ('.$val['summ'].')'.'</li>';
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
					echo '<li class="title title'.$value['id'].'">'.$value['name'].'</li>';
					echo '<ul class="tab tab'.$value['id'].'">';
						foreach($diagnosis as $res=>$val){
							$val['id_diagnosis_type'] = explode(",", $val['id_diagnosis_type']);
							if( in_array($value['id'],$val['id_diagnosis_type']) ){
								echo '<li>'.$val['name_full'].' ('.$val['name'].')'.'</li>';
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