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

$sql = "SELECT full_name FROM users WHERE username='$username'";
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

<div class="upload-notice fixed-top">

</div>
<div class="container-fluid p-0 m-0">
	<div class="row p-0 m-0">
		<div class="col-md-3 p-4  border">
			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<i class="fa fa-folder-open upload-icon" style="font-size:100px;cursor: pointer;"></i>
				<h4 class="upload-header">Upload files</h4>
				<span id="free_memory">
					
					<?php
                      $get = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
					$plans = $data['plans'];
					if($plans=="starter" || $plans=="free")
					{
                    $free_space = $total-$used;
                    $per = round(($used*100)/$total,2);
                    echo "FREE SPACE : ".$free_space ." MB";
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
					echo "Used Storage ".$used." MB";
				   }
					?>
				</span>
				<div class=" upload-progress-con d-none  progress bg-dark w-50 my-2" style="height:5px;">
					<div class=" progress-control progress-bar progress-bar-animated progress-bar-striped" style=" width:<?php    ?>"></div>
				</div>

                <div class="progress-details d-none">
                	<span class="progress-per"><?php  echo $per."%";  ?></span>
                </div>
			</div>

			<div class="d-flex flex-column justify-content-center align-items-center bg-white w-100 shadow-lg" style="height:250px;">
				<i class="fa fa-database" style="font-size:100px;"></i>
				<h4>Memory status</h4>
				<span id="m_status">
					<?php
                      
                      $get = "SELECT storage,used_storage,plans FROM users WHERE username='$username'";
                      $response = $db->query($get);
                     $data =  $response->fetch_assoc();
                    $total =  $data['storage'];
                    $used =  $data['used_storage'];
					$plans = $data['plans'];
					$per = 0;
					
					if($plans=="starter" || $plans =="free")
					{
						$display = "";
						$per = round(($used*100)/$total,2);
                    echo $used ."/" .$total."  MB";
                    $bg = '';
                    if($per>80)
                    {
                    $bg = "bg-danger";
                    }
                    else
                    {
                    $bg = "bg-success";
                    } 
					}
					else{
						$display = "d-none";
					}
					?>
				</span>
				<div class="progress w-50  my-2 bg-dark <?php echo $display ?>  " style="height:5px;">
					<div class=" m-progress progress-bar <?php  echo $bg; ?>  "style="width:<?php echo $per."%"; ?>"></div>
				</div>

                <div>
                	<span class="<?php echo  $plans=="free" || $plans=="starter" ? $bg : "bg-success"  ?> p-1 px-4" ><?php echo $plans=="starter" || $plans=="free" ?   $per."/100 Percent" :  "Used ". $used." MB From UNLIMITED "; ?></span>
                	<!-- <i class="fa fa-pause-circle"></i>
                	<i class="fa fa-times-circle"></i> -->
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
                    $get_id = "SELECT id FROM users WHERE username='$username'";
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

<?php 

$current_date = date('Y-m-d');
$get_expiry_date = "SELECT expiry_date,plans,full_name FROM users WHERE username='$username'";
$response = $db->query($get_expiry_date);
$data = $response->fetch_assoc();
$plans = $data['plans'];
if($plans !="free"){
	$expiry_date = $data['expiry_date'];
	$cal_date = new DateTime($expiry_date);
	$cal_date->sub(new DateInterval('P5D'));
	$five_days_before = $cal_date->format('Y-m-d');
	if($current_date == $five_days_before){
		echo  "<div class='alert alert-warning rounded-0 shadow-lg fixed-top py-3'><i class='fa fa-times-circle close' data-dismiss='alert'></i>You have only 5 days left to renew your plan</div";
	}else if($current_date < $five_days_before){
		$manual_expiry_date = date_create($expiry_date);
		$manual_current_date = date_create($current_date);
		$date_diff = date_diff($manual_current_date,$manual_expiry_date);
		$left_days = $date_diff->format('%a');
		echo  "<div class='alert alert-warning rounded-0 shadow-lg fixed-top py-3'><i class='fa fa-times-circle close' data-dismiss='alert'></i>You have only ".$left_days." days left to renew your plan</div";
	}else if($current_date >= $expiry_date){
		$amount;
		$storage;
		if($plans=="starter"){
			$amount = 99;
			$storage = 1024;
		}else{
			$amount = 99;
			$storage ='unlimited';
		}
		$renew_link = "php/pay.php?amount=".$amount."&plans=".$plans."&storage=".$storage;
        $_SESSION['renew'] = "yes";
		$_SESSION['buyer_name'] = $data['full_name'];
		
		echo  "<div class='d-flex alert alert-warning rounded-0 shadow-lg fixed-top '>
		<h4 class='flex-fill'>Plan expired choose an action !</h4>
		<a href='".$renew_link."' class=' btn btn-primary mx-3'>Renew old product</a>
		<a href='shopping.php' class='btn btn-danger mr-3'>Purchase new plan</a>
		<a href='php/logout.php' class='btn btn-light mr-3'>Logout</a>
		</div";

		echo "<style>
		.upload-icon{
			pointer-events:none;

		}
		</style>";

	}
}
?>