<?php
require_once('../../php/database.php');
$p_name =  $_POST['p_name'];
$p_path = $_POST['p_path'];
$pathinfo = pathinfo($p_path);


$dir_name = $pathinfo['dirname'];
$extension = $pathinfo['extension'];
$n_path = "../".$dir_name."/".$p_name.".".$extension;
 $final_name = $p_name.".".$extension;
session_start();
$table = $_SESSION['table_name'];




if(file_exists($n_path))
{
	echo "File already exit enter another name";
	
}
else
{
 if(rename("../".$p_path,$n_path))
 {
 	$full_path = "../".$p_path;
 	$update = "UPDATE $table SET img_path='$n_path',img_name='$final_name'  WHERE img_path='$full_path'";
    $response =  $db->query($update);
    if($response)
    {

    	echo "success";
    }
 }

}


?>