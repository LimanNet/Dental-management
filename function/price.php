<?php	/******************************************************************************/	/***						Price function					                ***/	/***						Список услуг									***/	/******************************************************************************/		if($_GET['cat']=="price"){$results['cat'] = "price";}else{return;}		$results['link'] = "admin.php?action=catalog&cat=price";	$results['sAct'] = isset($_GET['sAct']) ? $_GET['sAct'] : null ;	$results['res'] = isset($_GET['res']) ? $_GET['res'] : null ;	$results['GETid'] = isset($_GET['id']) ? $_GET['id'] : null ;	require_once ( CLASS_PATH . '/catalog/Price.php' );	// Весь список объектов	$list = new Price();	$results['list'] = $list->getAll();		if(isset($_GET['archive']) && $_GET['archive']=='on'){		$results['list'] = $list->archive();		$results['link'] .= "&archive=on";	}	// Выборка выбранного объекта	$results['ids'] = isset($_GET['id']) ? $_GET['id'] : null;	if($results['ids']){		foreach($results['list'] as $param=>$value){			foreach($value as $par=>$val){				if($par=='id'){					if($val==$results['ids']){						$results['id']=$value;					}				}			}		}	}		// Получение сторонних данных	require_once ( CLASS_PATH . '/catalog/WorkGroup.php' );		$workGroup = new WorkGroup();		$results['workgroup'] = $workGroup->getAll();		// Проверка действий	$sAct = isset($_GET['sAct']) ? $_GET['sAct'] : "";	switch($sAct){		case 'new':				$results[] = $results['link'];				$results[] = $results['cat'];				newObject($results);			break;		case 'insert':				insert($_REQUEST);			break;		case 'update':				update($_REQUEST);			break;		case 'delete':				delete($results['GETid']);			break;		default:			if(isset($_REQUEST['hidden'])){				$results['list'] = null;				def($results);			}else{def($results);}				}	function def($results){		require_once ( TEMPLATE_PATH . '/catalog/price.php' );	}	function newObject($results){		require_once ( TEMPLATE_PATH . '/catalog/price.php' );	}	function insert($results){		$insert = new Price();				$insert->set($results);		$res =	$insert->insert();		header( "Location: admin.php?action=catalog&cat=price&res=".$res );	}	function update($results){		$update = new Price();				$update->set($results);		$res =	$update->update();		header( "Location: admin.php?action=catalog&cat=price&id=".$results['id']."&res=".$res );	}	function delete($id){		$delete = new Price();				$delete->setID($id);		$res =	$delete->delete();		header( "Location: admin.php?action=catalog&cat=price&res=".$res );	}	?>