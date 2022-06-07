<?php
require_once("../../php/database.php");
session_start();

$username = $_SESSION['username'];



$sql = "SELECT id FROM user WHERE user_name='$username'";
$response = $db->query($sql);

$data = $response->fetch_assoc();

$id = $data['id'];
$f_name = "user_".$id;

$f_name =  "../gallery/".$f_name;

$file = $_FILES['data'];

$name = strtolower($file['name']);
$tmp_name = $file['tmp_name'];
$extension = $file['type'];
$f_size = round($file['size']/1024/1024,2);
$table_name = "user_".$id;




//check free spaces

$c_space = "SELECT * FROM user WHERE user_name='$username'";
$response = $db->query($c_space);
$data = $response->fetch_assoc();

$u_storage = $data['used_storage'];
$storage = $data['storage'];

$free = $storage-$u_storage;

if($f_size<$free)
{
if(file_exists($f_name."/".$name))
{
	echo "file already exit !";
}
else
{
 $move = move_uploaded_file($tmp_name,$f_name."/".$name);

 if($move)
 {
 	$path = $f_name."/".$name;
  $thumb_path = $f_name."/".$name;
   $store = "INSERT INTO $table_name(img_name,img_path,thump_path,img_size)
   VALUES('$name','$path','$thumb_path','$f_size')
   ";

   $response = $db->query($store);
   if($response)
   {
   	//get used storeage data
     $get_used_store = "SELECT used_storage FROM user WHERE user_name='$username'";
     $response = $db->query($get_used_store);
     $used  = $response->fetch_assoc();
     $s_used = $used["used_storage"];

     $add = $s_used+$f_size;

     //update used storage here
     $update = "UPDATE user SET used_storage='$add'  WHERE user_name='$username'";
     $response = $db->query($update);

     if($response)
     {
     //	echo "Update";
     	//only for jpeg
    if($extension == "image/jpeg")
   {
   $img_pixels =  imagecreatefromjpeg($f_name."/".$name);
   $o_width = imagesx($img_pixels);
   $o_height = imagesy($img_pixels);
   $ratio = 100/$o_width;
   $height = $o_height*$ratio;
   $canvas = imagecreatetruecolor(100,$height);
   imagecopyresampled($canvas,$img_pixels,0,0,0,0,100,$height,$o_width,$o_height);
   if(imagejpeg($canvas,$thumb_path))
   {
    echo "update";
   }
 

   imagedestroy($img_pixels);
    }

    //only for png
   if($extension == "image/png")
   {
   $img_pixels =  imagecreatefrompng($f_name."/".$name);
   $o_width = imagesx($img_pixels);
   $o_height = imagesy($img_pixels);
   $ratio = 100/$o_width;
   $height = $o_height*$ratio;
   $canvas = imagecreatetruecolor(100,$height);
   imagecopyresampled($canvas,$img_pixels,0,0,0,0,100,$height,$o_width,$o_height);
   if(imagepng($canvas,$thumb_path))
   {
    echo "update";
   }
   imagedestroy($img_pixels);
    }

    //only for gif
   if($extension == "image/gif")
   {
   $img_pixels =  imagecreatefromgif($f_name."/".$name);
   $o_width = imagesx($img_pixels);
   $o_height = imagesy($img_pixels);
   $ratio = 100/$o_width;
   $height = $o_height*$ratio;
   $canvas = imagecreatetruecolor(100,$height);
   imagecopyresampled($canvas,$img_pixels,0,0,0,0,100,$height,$o_width,$o_height);
   if(imagegif($canvas,$thumb_path))
   {
    echo "update";
   }
   imagedestroy($img_pixels);
    }

    //only for bmp
   if($extension == "image/bmp")
   {
   $img_pixels =  imagecreatefrombmp($f_name."/".$name);
   $o_width = imagesx($img_pixels);
   $o_height = imagesy($img_pixels);
   $ratio = 100/$o_width;
   $height = $o_height*$ratio;
   $canvas = imagecreatetruecolor(100,$height);
   imagecopyresampled($canvas,$img_pixels,0,0,0,0,100,$height,$o_width,$o_height);
   if(imagebmp($canvas,$thumb_path))
   {
    echo "update";
   }
   imagedestroy($img_pixels);
   }

   //only for webp
   if($extension == "image/webp")
   {
   $img_pixels =  imagecreatefromwebp($f_name."/".$name);
   $o_width = imagesx($img_pixels);
   $o_height = imagesy($img_pixels);
   $ratio = 100/$o_width;
   $height = $o_height*$ratio;
   $canvas = imagecreatetruecolor(100,$height);
   imagecopyresampled($canvas,$img_pixels,0,0,0,0,100,$height,$o_width,$o_height);
   if(imagewebp($canvas,$thumb_path))
   {
    echo "update";
   }
   imagedestroy($img_pixels);
    }



     }
     else
     {
     	echo "Fialed to update used_storage !";
     }


   }
   else
   {
   	echo "Failed to upload image in database";
   }
 }
 else
 {
 	echo "Upload failed";
 }
}
}
else
{
	echo "File size to large kindly purchase some space";
}
?>