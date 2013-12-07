<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link href='../css/main.css' rel='stylesheet' type='text/css'>
<title>Contact Page</title>
</head>
<body>
<div id="contactform">
<img src="../images/contactimg.jpg" height="300" width="600" />
<h2><i>Contact Us</i></h2>
<p><h4>We are available for your service day and night to provide you with the best assistance</h4></p>
<form id="contact" action="" method="post">
<div id="data">
<label for="firstname">First Name:</label>
<input type="text" name="fname" id="fname" /><br />
</br>
<label for="lastname">Last Name:</label>
<input type="text" name="lname" id="lname" /><br />
</br>
<label for="lastname">E-mail:</label>
<input type="text" name="email" id="email" /><br />
</br>
<label>Comments:</label><br />
<textarea name="comments" id="comments" rows="4" cols="50">
Please mention your suggestions or complaints here. We will contact you soon.
</textarea>
</div>
<div id="buttons">
<input type="submit" name="submit" value="submit" />
<input type="reset" name="reset" value="reset" />
</div>
</form>
<div id="message"></div>
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
if($count == 1)
{
	echo "Thanks for your information. We will contact you soon.";
}
else 
{
	echo "We are sorry for inconviniance, we could not process your request this time, please try again letter.";
}


?>
<p><h4>Send us a text file or word file with your queries and we will get back to you</h4></p> 
<input type="file" id="upload" name="upload" style="visibility: hidden; width: 1px; height: 1px" multiple />
<a href="" onclick="document.getElementById('upload').click(); return false"><b>Upload</b></a>
</div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!--  <script src="../js/contact.js"></script>-->
<script></script>
</script>
</html>


