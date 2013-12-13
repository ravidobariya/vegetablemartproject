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
header("Location:http://")
if($count == 1)
{
	echo "Thanks for your information. We will contact you soon.";
}
else 
{
	echo "We are sorry for inconviniance, we could not process your request this time, please try again letter.";
}


?>