<?php
require_once('database.php');
$username =  base64_decode($_POST['email']);


$sql = "SELECT username FROM users WHERE username ='$username'";
$response = $db->query($sql);
if($response->num_rows != 0)
{
	echo  "user found";
}
else
{
	echo "user not found";
}




?>