<?php

$db = new PDO ( "mysql:host=127.8.66.130;dbname=vegetablemart;port=3306","adminunkFGYh", "6gAqvZF7i1ak" );
// check if last part of url is numeric
$aUrls = explode('/', $_SERVER['REQUEST_URI']);

$nId = "";
$sTable = "";
$nExtra =  array_pop($aUrls);

print_r($aUrls);

if($nExtra == "")
{
	echo "A";
	$first = array_pop($aUrls);
	if(is_numeric($first))
	{
		echo "A1";
		echo $nId = $first;
		echo $sTable = array_pop($aUrls);
	}
	else
	{
		echo "A2";
		echo $sTable = $first;
	}
}else if(is_numeric($nExtra))
{
	echo "B";
	echo $nId = $nExtra;
	echo $sTable = array_pop($aUrls);
}
else
{
	echo "C";
	echo $sTable = $nExtra;
}
echo "id : ".$nId;
echo "table: ".$nTable;

//$sTable = array_pop($aUrls);
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