<?php

$db = new PDO ( "mysql:host=127.8.66.130;dbname=vegetablemart;port=3306","adminunkFGYh", "6gAqvZF7i1ak" );
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$detail = $_POST['comments'];
$stmt = $db->prepare("INSERT INTO inquiry (firstName,lastName,email,comments) VALUES(?,?,?,?)");
$stmt->execute(array($fname,$lname,$email,$detail));
$count = $stmt->rowCount();
if($count == 1)
{
	echo "Thank you for your information, We will contact you soon";
}

//header("Location:http://vegetablemart-cadfinal.rhcloud.com/#contact");

?>