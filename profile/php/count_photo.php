<?php
require_once("../../php/database.php");
session_start();
$username = $_SESSION['username'];


                    $get_id = "SELECT id FROM user WHERE user_name='$username'";
                    $response = $db->query($get_id);
                   $data =  $response->fetch_assoc();
                   $t_name =  "user_".$data['id'];
                   
                   $count = "SELECT count(id) FROM $t_name";
                  $response =   $db->query($count);
                  $data = $response->fetch_assoc();
                  $photos = ($data['count(id)']);
                  echo $photos. " PHOTOS" ;
                 

					?>