	<?php
    require_once("../../php/database.php");
    session_start();
    $username = $_SESSION['username'];
                      
                      $get = "SELECT storage,used_storage FROM user WHERE user_name='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
                    $free_space = $total-$used;
                    $per = round(($used*100)/$total,2);
                    $response = [$used ."/" .$total."  MB",$free_space,$per];
                    echo json_encode($response);
                    $bg = '';
                    if($per>80)
                    {
                    $bg = "bg-danger";
                    }
                    else
                    {
                    $bg = "bg-primary";
                    } 
					?>