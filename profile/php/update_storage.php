<?php
session_start();
$username = $_SESSION['username'];
require("../../php/database.php");

$plan =  $_GET['plan'];
$storage =  $_GET['storage'];
$purchase_date = date('d/m/y');

if($plan=="starter" || $plan=="free"){
 
  //get free storage
$select_storage = "SELECT storage FROM users WHERE username='$username'";
$response = $db->query($select_storage);
$data = $response->fetch_assoc();
$final_storage = $data['storage']+$storage;

     //generate expiry date
     $cal_date = new DateTime($purchase_date);
     $cal_date->add(new DateInterval('P30D'));
     $expiry_date = $cal_date->format('Y-m-d');
//update storge 
$update_storage = "UPDATE users SET plans='$plan',storage='$final_storage',purchase_date='$purchase_date',expiry_date='$expiry_date' WHERE username='$username'";
if($db->query($update_storage)){
    header("Location:../profile.php");
}else{
    echo "update failed";
}
}else{
    //generate expiry date
   $cal_date = new DateTime($purchase_date);
   $cal_date->add(new DateInterval('P30D'));
   $expiry_date = $cal_date->format('Y-m-d');
    //update storge 
$update_storage = "UPDATE users SET plans='$plan',storage='0',purchase_date='$purchase_date',expiry_date='$expiry_date' WHERE username='$username'";
if($db->query($update_storage)){
    header("Location:../profile.php");
}else{
    echo "update failed";
}

}


?>