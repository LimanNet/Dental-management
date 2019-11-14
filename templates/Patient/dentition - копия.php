<?php

/* Зубная формула */

include ('include/menu.php');


?>
<?php
	$year = (int)date('Y') - (int)date("Y", strtotime( $results['patient']['dateOfBirth'] )); // вычисляем возраст
?>


<script>
$(document).ready(function(){
  $(".left").toggle('slow');
  $(".tab").toggle();
	$(".title1").click(function(){$(".tab1").toggle();});
	$(".title2").click(function(){$(".tab").hide();$(".tab2").toggle();});
	$(".title3").click(function(){$(".tab").hide();$(".tab3").toggle();});
	$(".title4").click(function(){$(".tab").hide();$(".tab4").toggle();});
	$(".title5").click(function(){$(".tab").hide();$(".tab5").toggle();});
	$(".title6").click(function(){$(".tab").hide();$(".tab6").toggle();});
	$(".title7").click(function(){$(".tab").hide();$(".tab7").toggle();});
	$(".title8").click(function(){$(".tab").hide();$(".tab8").toggle();});
	$(".title9").click(function(){$(".tab").hide();$(".tab9").toggle();});
	$(".title10").click(function(){$(".tab").hide();$(".tab10").toggle();});
	$(".title11").click(function(){$(".tab").hide();$(".tab11").toggle();});
	
});
</script>
<link rel="stylesheet" type="text/css" href="css/dentition.css">
<div class="card box">
	
	<div class="head cart" style="text-align:center;">
		<h3>Зубная формула</h3>
		<h4>
			<?php echo htmlspecialchars( $results['patient']['familyName'] );?>
			<?php echo htmlspecialchars( $results['patient']['firstName'] );?>
			<?php echo htmlspecialchars( $results['patient']['patronymic'] );?>
			<?php echo $year . " год";?>
		</h4>
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
						<input type="checkbox" id="TATop18" name="TATop" value="1">
						<label for="TATop18"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft18" name="TALeft" value="1">
						<label for="TALeft18"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter18" name="TACenter" value="1">
						<label for="TACenter18"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight18" name="TARight" value="1">
						<label for="TARight18"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown18" name="TADown" value="1">
						<label for="TADown18"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop17" name="TATop" value="1">
						<label for="TATop17"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft17" name="TALeft" value="1">
						<label for="TALeft17"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter17" name="TACenter" value="1">
						<label for="TACenter17"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight17" name="TARight" value="1">
						<label for="TARight17"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown17" name="TADown" value="1">
						<label for="TADown17"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop16" name="TATop" value="1">
						<label for="TATop16"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft16" name="TALeft" value="1">
						<label for="TALeft16"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter16" name="TACenter" value="1">
						<label for="TACenter16"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight16" name="TARight" value="1">
						<label for="TARight16"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown16" name="TADown" value="1">
						<label for="TADown16"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop15" name="TATop" value="1">
						<label for="TATop15"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft15" name="TALeft" value="1">
						<label for="TALeft15"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter15" name="TACenter" value="1">
						<label for="TACenter15"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight15" name="TARight" value="1">
						<label for="TARight15"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown15" name="TADown" value="1">
						<label for="TADown15"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop14" name="TATop" value="1">
						<label for="TATop14"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft14" name="TALeft" value="1">
						<label for="TALeft14"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter14" name="TACenter" value="1">
						<label for="TACenter14"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight14" name="TARight" value="1">
						<label for="TARight14"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown14" name="TADown" value="1">
						<label for="TADown14"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop13" name="TATop" value="1">
						<label for="TATop13"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft13" name="TALeft" value="1">
						<label for="TALeft13"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter13" name="TACenter" value="1">
						<label for="TACenter13"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight13" name="TARight" value="1">
						<label for="TARight13"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown13" name="TADown" value="1">
						<label for="TADown13"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop12" name="TATop" value="1">
						<label for="TATop12"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft12" name="TALeft" value="1">
						<label for="TALeft12"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter12" name="TACenter" value="1">
						<label for="TACenter12"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight12" name="TARight" value="1">
						<label for="TARight12"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown12" name="TADown" value="1">
						<label for="TADown12"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop11" name="TATop" value="1">
						<label for="TATop11"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft11" name="TALeft" value="1">
						<label for="TALeft11"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter11" name="TACenter" value="1">
						<label for="TACenter11"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight11" name="TARight" value="1">
						<label for="TARight11"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown11" name="TADown" value="1">
						<label for="TADown11"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop21" name="TATop" value="1">
						<label for="TATop21"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft21" name="TALeft" value="1">
						<label for="TALeft21"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter21" name="TACenter" value="1">
						<label for="TACenter21"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight21" name="TARight" value="1">
						<label for="TARight21"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown21" name="TADown" value="1">
						<label for="TADown21"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop22" name="TATop" value="1">
						<label for="TATop22"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft22" name="TALeft" value="1">
						<label for="TALeft22"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter22" name="TACenter" value="1">
						<label for="TACenter22"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight22" name="TARight" value="1">
						<label for="TARight22"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown22" name="TADown" value="1">
						<label for="TADown22"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop23" name="TATop" value="1">
						<label for="TATop23"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft23" name="TALeft" value="1">
						<label for="TALeft23"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter23" name="TACenter" value="1">
						<label for="TACenter23"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight23" name="TARight" value="1">
						<label for="TARight23"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown23" name="TADown" value="1">
						<label for="TADown23"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop24" name="TATop" value="1">
						<label for="TATop24"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft24" name="TALeft" value="1">
						<label for="TALeft24"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter24" name="TACenter" value="1">
						<label for="TACenter24"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight24" name="TARight" value="1">
						<label for="TARight24"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown24" name="TADown" value="1">
						<label for="TADown24"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop25" name="TATop" value="1">
						<label for="TATop25"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft25" name="TALeft" value="1">
						<label for="TALeft25"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter25" name="TACenter" value="1">
						<label for="TACenter25"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight25" name="TARight" value="1">
						<label for="TARight25"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown25" name="TADown" value="1">
						<label for="TADown25"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop26" name="TATop" value="1">
						<label for="TATop26"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft26" name="TALeft" value="1">
						<label for="TALeft26"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter26" name="TACenter" value="1">
						<label for="TACenter26"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight26" name="TARight" value="1">
						<label for="TARight26"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown26" name="TADown" value="1">
						<label for="TADown26"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop27" name="TATop" value="1">
						<label for="TATop27"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft27" name="TALeft" value="1">
						<label for="TALeft27"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter27" name="TACenter" value="1">
						<label for="TACenter27"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight27" name="TARight" value="1">
						<label for="TARight27"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown27" name="TADown" value="1">
						<label for="TADown27"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop28" name="TATop" value="1">
						<label for="TATop28"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft28" name="TALeft" value="1">
						<label for="TALeft28"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter28" name="TACenter" value="1">
						<label for="TACenter28"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight28" name="TARight" value="1">
						<label for="TARight28"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown28" name="TADown" value="1">
						<label for="TADown28"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop48" name="TATop" value="1">
						<label for="TATop48"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft48" name="TALeft" value="1">
						<label for="TALeft48"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter48" name="TACenter" value="1">
						<label for="TACenter48"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight48" name="TARight" value="1">
						<label for="TARight48"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown48" name="TADown" value="1">
						<label for="TADown48"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop47" name="TATop" value="1">
						<label for="TATop47"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft47" name="TALeft" value="1">
						<label for="TALeft47"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter47" name="TACenter" value="1">
						<label for="TACenter47"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight47" name="TARight" value="1">
						<label for="TARight47"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown47" name="TADown" value="1">
						<label for="TADown47"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop46" name="TATop" value="1">
						<label for="TATop46"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft46" name="TALeft" value="1">
						<label for="TALeft46"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter46" name="TACenter" value="1">
						<label for="TACenter46"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight46" name="TARight" value="1">
						<label for="TARight46"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown46" name="TADown" value="1">
						<label for="TADown46"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop45" name="TATop" value="1">
						<label for="TATop45"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft45" name="TALeft" value="1">
						<label for="TALeft45"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter45" name="TACenter" value="1">
						<label for="TACenter45"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight45" name="TARight" value="1">
						<label for="TARight45"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown45" name="TADown" value="1">
						<label for="TADown45"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop44" name="TATop" value="1">
						<label for="TATop44"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft44" name="TALeft" value="1">
						<label for="TALeft44"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter44" name="TACenter" value="1">
						<label for="TACenter44"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight44" name="TARight" value="1">
						<label for="TARight44"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown44" name="TADown" value="1">
						<label for="TADown44"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop43" name="TATop" value="1">
						<label for="TATop43"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft43" name="TALeft" value="1">
						<label for="TALeft43"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter43" name="TACenter" value="1">
						<label for="TACenter43"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight43" name="TARight" value="1">
						<label for="TARight43"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown43" name="TADown" value="1">
						<label for="TADown43"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop42" name="TATop" value="1">
						<label for="TATop42"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft42" name="TALeft" value="1">
						<label for="TALeft42"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter42" name="TACenter" value="1">
						<label for="TACenter42"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight42" name="TARight" value="1">
						<label for="TARight42"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown42" name="TADown" value="1">
						<label for="TADown42"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop41" name="TATop" value="1">
						<label for="TATop41"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft41" name="TALeft" value="1">
						<label for="TALeft41"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter41" name="TACenter" value="1">
						<label for="TACenter41"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight41" name="TARight" value="1">
						<label for="TARight41"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown41" name="TADown" value="1">
						<label for="TADown41"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop31" name="TATop" value="1">
						<label for="TATop31"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft31" name="TALeft" value="1">
						<label for="TALeft31"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter31" name="TACenter" value="1">
						<label for="TACenter31"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight31" name="TARight" value="1">
						<label for="TARight31"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown31" name="TADown" value="1">
						<label for="TADown31"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop32" name="TATop" value="1">
						<label for="TATop32"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft32" name="TALeft" value="1">
						<label for="TALeft32"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter32" name="TACenter" value="1">
						<label for="TACenter32"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight32" name="TARight" value="1">
						<label for="TARight32"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown32" name="TADown" value="1">
						<label for="TADown32"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop33" name="TATop" value="1">
						<label for="TATop33"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft33" name="TALeft" value="1">
						<label for="TALeft33"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter33" name="TACenter" value="1">
						<label for="TACenter33"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight33" name="TARight" value="1">
						<label for="TARight33"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown33" name="TADown" value="1">
						<label for="TADown33"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop34" name="TATop" value="1">
						<label for="TATop34"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft34" name="TALeft" value="1">
						<label for="TALeft34"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter34" name="TACenter" value="1">
						<label for="TACenter34"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight34" name="TARight" value="1">
						<label for="TARight34"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown34" name="TADown" value="1">
						<label for="TADown34"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop35" name="TATop" value="1">
						<label for="TATop35"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft35" name="TALeft" value="1">
						<label for="TALeft35"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter35" name="TACenter" value="1">
						<label for="TACenter35"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight35" name="TARight" value="1">
						<label for="TARight35"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown35" name="TADown" value="1">
						<label for="TADown35"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop36" name="TATop" value="1">
						<label for="TATop36"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft36" name="TALeft" value="1">
						<label for="TALeft36"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter36" name="TACenter" value="1">
						<label for="TACenter36"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight36" name="TARight" value="1">
						<label for="TARight36"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown36" name="TADown" value="1">
						<label for="TADown36"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop37" name="TATop" value="1">
						<label for="TATop37" for="tooth37"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft37" name="TALeft" value="1">
						<label for="TALeft37"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter37" name="TACenter" value="1">
						<label for="TACenter37"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight37" name="TARight" value="1">
						<label for="TARight37"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown37" name="TADown" value="1">
						<label for="TADown37"><div class="toothareadown ttharea"></div></label>
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
						<input type="checkbox" id="TATop38" name="TATop" value="1">
						<label for="TATop38"><div class="toothareatop ttharea"></div></label>
						<input type="checkbox" id="TALeft38" name="TALeft" value="1">
						<label for="TALeft38"><div class="tootharealeft ttharea"></div></label>
						<input type="checkbox" id="TACenter38" name="TACenter" value="1">
						<label for="TACenter38"><div class="toothareacenter ttharea"></div></label>
						<input type="checkbox" id="TARight38" name="TARight" value="1">
						<label for="TARight38"><div class="tootharearight ttharea"></div></label>
						<input type="checkbox" id="TADown38" name="TADown" value="1">
						<label for="TADown38"><div class="toothareadown ttharea"></div></label>
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
								echo '<li>'.$val['name'].'</li>';
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
</div>