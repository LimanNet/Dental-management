<?php
	/******************************************************************************/
	/***						ToothPart function				                ***/
	/***							Области зубов								***/
	/******************************************************************************/
	
	if($_GET['cat']=="toothpart"){$results['cat'] = "toothpart";}else{return;}
	
	$results['link'] = "index.php?action=catalog&cat=toothpart";
	$results['sAct'] = isset($_GET['sAct']) ? $_GET['sAct'] : null ;
	$results['res'] = isset($_GET['res']) ? $_GET['res'] : null ;
	$results['GETid'] = isset($_GET['id']) ? $_GET['id'] : null ;

	require_once ( CLASS_PATH . '/catalog/ToothPart.php' );

	// Весь список объектов
	$list = new ToothPart();
	$results['list'] = $list->getAll();
	
	if(isset($_GET['archive']) && $_GET['archive']=='on'){
		$results['list'] = $list->archive();
		if( $results['sAct']!='new' ){
			$results['link'] .= "&archive=on";
		}
	}
	// Выборка выбранного объекта
	$results['ids'] = isset($_GET['id']) ? $_GET['id'] : null;
	if($results['ids']){
		foreach($results['list'] as $param=>$value){
			foreach($value as $par=>$val){
				if($par=='id'){
					if($val==$results['ids']){
						$results['id']=$value;
					}
				}
			}
		}
	}
	
	// Проверка действий
	$sAct = isset($_GET['sAct']) ? $_GET['sAct'] : "";
	switch($sAct){
		case 'new':
				$results[] = $results['link'];
				$results[] = $results['cat'];
				newObject($results);
			break;
		case 'insert':
				insert($_REQUEST);
			break;
		case 'update':
				update($_REQUEST);
			break;
		case 'delete':
				delete($results['ids']);
			break;
		default:
			if(isset($_REQUEST['hidden'])){
				$results['list'] = null;
				def($results);
			}else{def($results);}
			
	}

	function def($results){
		require_once ( TEMPLATE_PATH . '/catalog/toothPart.php' );
	}
	function newObject($results){
		require_once ( TEMPLATE_PATH . '/catalog/toothPart.php' );
	}
	function insert($results){
		$insert = new ToothPart();
				$insert->set($results);
		$res =	$insert->insert();
		header( "Location: ?action=catalog&cat=toothpart&res=".$res );
	}
	function update($results){
		$update = new ToothPart();
				$update->set($results);
		$res =	$update->update();
		header( "Location: ?action=catalog&cat=toothpart&id=".$results['id']."&res=".$res );
	}
	function delete($id){
		$delete = new ToothPart();
				$delete->setID($id);
		$res =	$delete->delete();
		header( "Location: ?action=catalog&cat=toothpart&res=".$res );
	}
	
?>