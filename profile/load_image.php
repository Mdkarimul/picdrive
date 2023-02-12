<?php
require_once("../php/database.php");

 $s = $_POST['s'];
 $e = $_POST['e'];


session_start();
$table = $_SESSION['table_name'];
$get_path = "SELECT * FROM $table ORDER BY id ASC LIMIT $s , $e";
$response = $db->query($get_path);
while($data = $response->fetch_assoc())
{
$thump =  str_replace("../","",$data['thump_path']);
$path =  str_replace("../","",$data['img_path']);
$img_name = $data['img_name'];
$only_name =  pathinfo($img_name)['filename'];
$response_arr[] = [$thump,$path,$img_name,$only_name];
}

echo json_encode($response_arr);
?>