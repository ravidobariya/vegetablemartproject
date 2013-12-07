<?php

$db = new PDO ( "mysql:host=127.8.66.130;dbname=vegetablemart;port=3306","adminunkFGYh", "6gAqvZF7i1ak" );
if($db)
	echo "connected";
echo count($_POST);
print_r($_POST);
$fname = $_POST['fname'];
echo $fname;
$lname = $_POST['lname'];
echo $lname;
$email = $_POST['email'];
echo $email;
$detail = $_POST['comments'];
echo $detail;

$stmt = $db->prepare("INSERT INTO inquiry (firstName,lastName,email,comments) VALUES(?,?,?,?)");
$stmt->execute(array($fname,$lname,$email,$detail));
$count = $stmt->rowCount();
echo "inserted rows".$count;

?>