<?php
require_once("database.php");

$username = base64_decode($_POST['username']);
$code = base64_decode($_POST['code']);


$check = "SELECT user_name FROM user WHERE user_name='$username'";

$response = $db->query($check);
if($response->num_rows !=0)
{
	$check_code = "SELECT activation_code FROM user WHERE activation_code='$code'";
$response =	$db->query($check_code);
if($response->num_rows !=0)
{
  $update_status = "UPDATE user SET status='active' WHERE user_name='$username' AND activation_code='$code'";
  $response = $db->query($update_status);
  if($response)
  {

  	$sql = "SELECT id FROM user WHERE user_name='$username' AND activation_code='$code'";
   $response = $db->query($sql);
   $data = $response->fetch_assoc();
   $id =  $data['id'];
   $t_name = "user_".$id;

  $create = "CREATE TABLE $t_name(
   id INT NOT NULL AUTO_INCREMENT,
   img_name VARCHAR(50),
   img_path VARCHAR(50),
   thump_path VARCHAR(50),
   img_size FLOAT(10),
   img_date DATETIME DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id)
)";
$response = $db->query($create);
if($response)
{
  mkdir("../profile/gallery/".$t_name);
  echo "user verified";
}
else
{
  echo "string";
}

  }
  else
  {
  	echo "verification failed";
  }
}
else
{
	echo "wrong activation code";
}
}
else
{
	echo "user not found";
}
?>