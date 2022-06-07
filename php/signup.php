<?php

require_once("database.php");

$full_name = base64_decode($_POST['full_name']);
$email = base64_decode($_POST['email']);
$password = md5(base64_decode($_POST['password']));

$pattern = "050697841236753";
$length =  strlen($pattern)-1;

$code = [];
for($i=0;$i<4;$i++)
{
$number = 	rand(0,$length);
  $code[] =   $pattern[$number];
}


$activation_code =  implode($code);


$store_user = "INSERT INTO user(full_name,user_name,password,activation_code)
 VALUES('$full_name','$email','$password','$activation_code')
";

$response =  $db->query($store_user);

if($response)
{
 $check_mail =  mail($email,"Picdrive activation code ","Thank you for choosing our products your activation code is : ".$activation_code);

 if($check_mail)
 {
 	echo "email send to the user";
 }
 else
 {
 	echo "failed to send email";
 }

}
else
{
	echo "signup failed";
}

?>