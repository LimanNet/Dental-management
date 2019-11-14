<?php
/* Справочник */
?>

<?php 
if( isset($_REQUEST['hidden']) ){}
else{require_once( TEMPLATE_PATH . '/include/header.php');}
?>
<?php
	$cat = isset($_GET['cat']) ? $_GET['cat'] : "";
	
	switch($cat){
		case 'toothstate':
			toothState();
			break;
		case 'toothpart':
			toothPart();
			break;
		case 'diagnosis':
			diagnosis();
			break;
		case 'print043':
			print043();
			break;
		case 'workgroup':
			workGroup();
			break;
		case 'price':
			price();
			break;
		default:
			listCatalogs();
	}
	
	function listCatalogs(){
		
		require_once ( TEMPLATE_PATH . '/catalog/listCatalogs.php' );
		
	}	
	
	function toothPart(){
		require_once ( FUNCTION_PATH . '/ToothPart.php' );
	}
	function toothState(){
		require_once ( FUNCTION_PATH . '/ToothState.php' );	
	}
	function diagnosis(){
		require_once ( FUNCTION_PATH . '/diagnosis.php' );
	}
	function print043(){
		require_once ( FUNCTION_PATH . '/print043.php' );
	}
	function workGroup(){
		require_once ( FUNCTION_PATH . '/workgroup.php' );
	}
	function price(){
		require_once ( FUNCTION_PATH . '/price.php' );
	}
	
?>

<?php
if( isset($_REQUEST['hidden']) ){}
else{require_once( TEMPLATE_PATH . '/include/footer.php');} ?>