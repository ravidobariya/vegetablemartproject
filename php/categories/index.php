<?php

$db = new PDO ( "mysql:host=localhost;dbname=swag", "root", "" );

// check if last part of url is numeric
$aUrls = explode('/', $_SERVER['REQUEST_URI']);
$nId =  array_pop($aUrls);

$sTable = array_pop($aUrls);
$sSQL = "SELECT * FROM ";
$sWhere = "";
$aBinds = array();
switch($sTable){
	case 'categories':
		$sSQL .= 'categories';
		if(is_numeric($nId)){
			$sWhere .= 'id = ?';
			array_push($aBinds, $nId);
		}
		break;
	case 'products':
		$sSQL = 'SELECT a.*, b.url FROM products AS a, images AS b';
		$sWhere .= 'a.id = b.item_id AND b.sequence_id = 1 AND category_id = ?';
		array_push($aBinds, array_pop($aUrls));
		if(is_numeric($nId)){
			$sWhere .= ' AND a.id = ?';
			array_push($aBinds, $nId);
		}
		break;
	case 'images':
		$sSQL .= 'images';
		$sWhere .= 'item_id = ?';
		array_push($aBinds, array_pop($aUrls));
		if(is_numeric($nId)){
			$sWhere .= ' AND sequence_id = ?';
			array_push($aBinds, $nId);
		}
		break;
	default:
		throw(new Exception("bad path " . $sTable));
}
if(is_numeric($nId)){
	// get a single item
	$stmt = $db->prepare($sSQL . " WHERE ". $sWhere);
	$stmt->execute($aBinds);
	$result = $stmt->fetchObject();
} else {
	// get all of the items
	if($sWhere != ""){
		$sSQL .= " WHERE " . $sWhere;
	}
	$stmt = $db->prepare($sSQL);
	$stmt->execute($aBinds);
	$result = $stmt->fetchAll ( PDO::FETCH_OBJ );
}
echo json_encode($result);

?>