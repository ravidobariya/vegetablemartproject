<?php

$db = new PDO ( "mysql:host=127.8.66.130;dbname=vegetablemart;port=3306","adminunkFGYh", "6gAqvZF7i1ak" );
if($db)
	echo "connected";
echo count($_POST);
print_r($_POST);
echo $fname = $_POST('fname');
echo $lname = $_POST('lname');
echo $email = $_POST('email');
echo $detail = $_POST('comments');

$stmt = $db->prepare("INSERT INTO Inquiry (firstName,lastName,email,comments) VALUES ($fname,$lname,$email,$detail)");
$stmt->execute();
$count = $stmt->rowCount();
echo "inserted rows".$count;

?>