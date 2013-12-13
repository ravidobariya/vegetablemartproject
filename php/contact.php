<?php

$db = new PDO ( "mysql:host=127.8.66.130;dbname=vegetablemart;port=3306","adminunkFGYh", "6gAqvZF7i1ak" );
print_r($_POST);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$detail = $_POST['comments'];
$stmt = $db->prepare("INSERT INTO inquiry (firstName,lastName,email,comments) VALUES(?,?,?,?)");
$stmt->execute(array($fname,$lname,$email,$detail));
$count = $stmt->rowCount();
if(count == 1)
{
	echo "success";
}

//header("Location:http://vegetablemart-cadfinal.rhcloud.com/#contact");

?>