<?php
session_start();
require_once("../../php/database.php");
$location =   $_POST['location'];
$username = $_SESSION['username'];
$path = "../".$location;
if(unlink($path))
{
	$table = $_SESSION['table_name'];

     $get_used_storage = "SELECT used_storage FROM user WHERE user_name='$username'";
    $response =  $db->query($get_used_storage);
   $data =  $response->fetch_assoc();
   $used = $data['used_storage'];

   //get deleted image size

   $get_size = "SELECT img_size FROM $table WHERE img_path='$path'";
  $response_size =  $db->query($get_size);
  $size =  $response_size->fetch_assoc();

  $img_size =  $size['img_size'];

  $final_storage = $used-$img_size;

  $update = "UPDATE user SET used_storage='$final_storage' WHERE user_name='$username'";
 $response =  $db->query($update);
 if($response)
 {
 	  $delete_query = "DELETE FROM $table WHERE img_path='$path'";

	$response = $db->query($delete_query);
	if($response)
	{
		echo "Delete success";
	}
 }

 
	
}
else
{
echo "Failed to delete";
}


?>