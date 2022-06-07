<?php
require_once('database.php');


$username =  base64_decode($_POST['username']);
$password = md5(base64_decode($_POST['password']));

$sql = "SELECT user_name FROM user WHERE user_name='$username'";

$reponse = $db->query($sql);
if($reponse->num_rows != 0)
{
	$pass = "SELECT password FROM user WHERE password='$password' AND user_name='$username'";
	$response = $db->query($pass);
	if($response->num_rows != 0)
	{
		echo "Login success";
		session_start();
		$_SESSION['username'] = $username;
	}
	else
	{
		echo "wrong password";
	}
}
else
{
	echo "user not found";
}

?>