<?php
/* Графика зубной формулы */
/* Graphics Dentition */
?>

<?php
	
	//print_r($result['list']);
	
?>

<table border="1" width="100%">
<thead>
	Графика зубной формулы
	<?php 
		if(isset($_GET['res'])){
			if($_GET['res']=='success'){ echo" | Операция выполнена успешно.";}
			else{echo" | " . $_GET['res'];}
		}
	?>
</thead>
<tbody>
	<tr>
		<td width="30%">
			<table>
				<tr>
					<th>Цвет</th>
					<th>Название</th>
				</tr>
				<?php 
				foreach( $result['list'] as $value ){
					if( isset($_GET['idGraph']) and $value['idGraph']==$_GET['idGraph'] ){
					echo "<tr id=\"selected\" onclick=\"location='admin.php?action=catalog&cat=graphicsDentition&idGraph=".$value['idGraph']."'\"> ";
					}
					else{
						echo "<tr onclick=\"location='admin.php?action=catalog&cat=graphicsDentition&idGraph=".$value['idGraph']."'\"> ";
					}
						echo "<td style='background:".$value['color'].";'></td>";
						echo "<td>".$value['name']."</td>";
					echo "</tr>";
				}
				?>
			</table>
				
		</td>
		<td width="70%">
			
			<?php
				if(isset($_GET['sAct']) or isset($_GET['idGraph'])){
					activeForm($result);
				}
			?>
			
		</td>
	</tr>
</tbody>
</table>

<?php
function activeForm($result){
	$idGraph = isset($_GET['idGraph']) ? $_GET['idGraph'] : "";
	$sAct = isset($_GET['sAct']) ? $_GET['sAct'] : "" ;

// Кнопки
	echo '
		<form id="graph">
			<input type="hidden" name="action" value="catalog" />
			<input type="hidden" name="cat" value="graphicsDentition" />
	';
	if($sAct == "new"){
		echo '<input type="hidden" name="sAct" value="insert" />';
	}else{ echo '<input type="hidden" name="sAct" value="update" />'; }
	echo '<button><a href="?action=catalog&cat=graphicsDentition&sAct=new">Новая</a></button>';
	
	if($sAct == "new"){
		echo '<input form="graph" type="submit" value="Сохранить" />';
		echo '<input form="graph" type="reset" value="Очистить" />';
	}else{
		echo '<input form="graph" type="submit" value="Внести изменения" />';
		echo '<input form="graph" type="reset" value="Отменить" />';
	}
	
	echo '<input form="graph" type="reset" value="Удалить" />';
	echo '<button><a href="?action=catalog&cat=graphicsDentition">Выйти</a></button>';
	echo '</form>';
	echo '<hr />';

// Рабочая форма
	if($idGraph){echo '<input form="graph" type="hidden" name="idGraph" value="'.$idGraph.'" />';}
	if(isset($result["idGraph"]["name"])){
	echo "Название * <input form='graph' type='text' name='name' value='".$result["idGraph"]["name"]."' size='90' required /><br/>";
	}else{
		echo "Название * <input form='graph' type='text' name='name' size='90' required autofocus /><br/>";
	}
	if(isset($result['idGraph']['color'])){
		echo 'Выбор цвета для обозначения <input form="graph" type="color" name="color" value="'.$result['idGraph']['color'].'" /><br/>';
	}
	else{
		echo 'Выбор цвета для обозначения <input form="graph" type="color" name="color" /><br/>';
	}

// Области зубов

	echo <<<theTooth
		<p>
			Назначить доступные области для обозначения<br/>

		</p>
theTooth;
	
	//print_r($result['listAreaTooth']);
	
	foreach( $result['listAreaTooth'] as $value ){
		
		if(isset($result['idGraph'][$value["name_en"]])){
			echo '<input form="graph" type="checkbox" name="'.$value["name_en"].'" checked />';
			echo $value['name'];
			echo "<br/>";
		}else{
			echo '<input form="graph" type="checkbox" name="'.$value["name_en"].'" />';
			echo $value['name'];
			echo "<br/>";
		}
	}
	

		
}
?>