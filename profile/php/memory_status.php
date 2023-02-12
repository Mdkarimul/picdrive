	<?php
    require_once("../../php/database.php");
    session_start();
    $username = $_SESSION['username'];
                      $get = "SELECT plans,storage,used_storage FROM users WHERE username='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $plans = $data['plans'];
                     if($plans=="starter" || $plans=="free"){
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
                    $free_space = $total-$used;
                    $per = round(($used*100)/$total,2);
                    $response = [$used ."/" .$total."  MB ",$free_space." MB ",$per];
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
                     }else{
                        $response = [$data['used_storage']." MB "," UNLIMITED ",0];
                        echo json_encode($response);
                     }
                  
					?>