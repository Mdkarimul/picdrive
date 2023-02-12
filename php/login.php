<?php
require_once('database.php');


$username =  base64_decode($_POST['username']);
$password = md5(base64_decode($_POST['password']));

$sql = "SELECT username FROM users WHERE username='$username'";

$reponse = $db->query($sql);
if($reponse->num_rows != 0)
{
	$pass = "SELECT username,password FROM users WHERE password='$password' AND username='$username'";
	$response = $db->query($pass);
	if($response->num_rows != 0)
	{
		$check_status = "SELECT status FROM users  WHERE username='$username' AND password='$password' AND status='active'";
		$response_status = $db->query($check_status);
		if($response_status->num_rows !=0){

			echo "Login success";
		session_start();
		$_SESSION['username'] = $username;

		}else{
			echo "login pending";
		}
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