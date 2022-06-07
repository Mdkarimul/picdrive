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
echo "<div class='col-md-3 px-2 pb-5'>
<div class='card shadow-lg'>
<div class='card-body d-flex justify-content-center align-items-center'>
<img src='".$thump."' data-location='".$path."' width='100' height='150px' class='rounded-circle pic'>
</div>
<div class='card-footer d-flex justify-content-around align-items-center'>
<div class='d-flex align-items-center' style='text-wrap:wrap;height:20px;width:90px;position:relative;'>
<span style='position:absolute;top:-4px;'>".$only_name."</span>
</div>
<i title='save' class='fa fa-save save-icon d-none' style='cursor:pointer;' data-location='".$path."'></i>
<i class='fa fa-spinner loader-icon d-none' style='cursor:pointer;' data-location='".$path."'></i>
<i title='edit' class='fa fa-edit edit-icon' style='cursor:pointer;' data-location='".$path."'></i>
<i title='download' class='fa fa-download download-icon' style='cursor:pointer;' data-location='".$path."' file-name='".$img_name."'></i>
<i title='Delete' class='fa fa-trash delete-icon' style='cursor:pointer;' data-location='".$path."'></i>

</div>
</div>
</div>";
}
?>