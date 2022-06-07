<?php
require_once("../php/database.php");


session_start();
$username = $_SESSION['username'];
if(empty($username))
{
 header("Location:../index.php");
 exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style/profile.css">

<script type="text/javascript" src="js/profile.js"></script>

</head>
<body style="background-color: #ccc;">
	
<nav class="nav-bar nav-bar-expand-md bg-dark navbar-dark px-2">
	
	<a href="" class="navbar-brand">
		
<?php

$sql = "SELECT full_name FROM user WHERE user_name='$username'";
$response = $db->query($sql);
$data = $response->fetch_assoc();
echo $data['full_name'];
?>


	</a>

	<ul class="navbar-nav float-right">
		<li class="nav-item">
			<a href="php/logout.php" class="nav-link">
				<i class="fa fa-sign-out" style="font-size:18px;"></i> Logout
			</a>
		</li>
	</ul>
</nav>
<br>


<div class="container-fluid p-0 m-0">
	<div class="row p-0 m-0">
		<div class="col-md-3 p-4  border">
			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<i class="fa fa-folder-open upload-icon" style="font-size:100px;cursor: pointer;"></i>
				<h4 class="upload-header">Upload files</h4>
				<span id="free_memory">
					
					<?php
                      $get = "SELECT storage,used_storage FROM user WHERE user_name='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
                    $free_space = $total-$used;
                    $per = round(($used*100)/$total,2);
                    echo "FREE SPACE : ".$free_space ."MB";
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


				</span>
				<div class=" upload-progress-con d-none progress bg-dark w-50 my-2" style="height:5px;">
					<div class=" progress-control progress-bar progress-bar-animated progress-bar-striped" style=" width:<?php    ?>"></div>
				</div>

                <div class="progress-details d-none">
                	<span class="progress-per"><?php  echo $per."%";  ?></span>
                	
                </div>
			</div>

			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<i class="fa fa-database" style="font-size:100px;cursor: pointer;"></i>
				<h4>Memory status</h4>
				<span id="m_status">
					<?php
                      
                      $get = "SELECT storage,used_storage FROM user WHERE user_name='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
                    $per = round(($used*100)/$total,2);
                    echo $used ."/" .$total."  MB";
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
				</span>
				<div class="progress w-50  my-2 bg-dark  " style="height:5px;">
					<div class=" m-progress progress-bar <?php  echo $bg; ?>  "style="width:<?php echo $per."%"; ?>"></div>
				</div>

                <div>
                	<span><?php echo $per."%"; ?></span>
                	<i class="fa fa-pause-circle"></i>
                	<i class="fa fa-times-circle"></i>
                </div>
			</div>
		</div>
		<div class="col-md-6 p-4 border"></div>
		<div class="col-md-3 p-4 border">
			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<a href="gallery.php"><i class="fa fa-image" style="font-size:100px;cursor: pointer;"></i></a>
				<h4>Gallery</h4>
				<span id="count_photo">
					
					<?php
                    $get_id = "SELECT id FROM user WHERE user_name='$username'";
                    $response = $db->query($get_id);
                   $data =  $response->fetch_assoc();
                   $t_name =  "user_".$data['id'];
                   
                   $count = "SELECT count(id) FROM $t_name";
                  $response =   $db->query($count);
                  $data = $response->fetch_assoc();
                  $photos = ($data['count(id)']);
                  echo $photos. " PHOTOS" ;
                  $_SESSION['table_name'] =$t_name;

					?>
				</span>
				
			</div>




			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<a href="shopping.php"><i class="fa fa-shopping-cart" style="font-size:100px;cursor: pointer;"></i></a>
				<h4>Memory shopping</h4>
				<span id="count_photo">
					
					STARTS FROM 99.00/Manthly
				</span>
				

               
			</div>
		</div>
	</div>
</div>


</body>
</html>