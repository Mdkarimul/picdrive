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
$_SESSION['buyer_name'] = $data['full_name'];
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
<div class="row">
	<div class="col-md-6 p-5">
		<ul class="list-group w-100">
			<li class="list-group-item bg-success">
				<h3 class="text-center text-white">STARTER PLAN</h3>
			</li>
			<li class="list-group-item">
				1GB STORAGE
			</li>
			<li class="list-group-item" style="color:#ddd;">
				24*7 TECHNICAL SUPPORT
			</li>
			<li class="list-group-item" style="color:#ddd;">
				INSTANT EMAIL SOLUTION 
			</li>
			<li class="list-group-item" style="color:#ddd;">
				DATA SECURITY
			</li>
			<li class="list-group-item" style="color:#ddd;">
				SEO SERVICES
			</li>
			<li class="list-group-item bg-light text-center buy-btn" amount="99" plan="starter" style="cursor:pointer;">
				<h4><i class="fa fa-inr"></i>99.00/Monthly</h4>
			</li>
		</ul>
	</div>
	<div class="col-md-6 p-5">
			<ul class="list-group w-100">
			<li class="list-group-item bg-warning">
				<h3 class="text-center text-white">EXCLUSIVE PLAN</h3>
			</li>
			<li class="list-group-item">
				UNLIMITED STORAGE
			</li>
			<li class="list-group-item" >
				24*7 TECHNICAL SUPPORT
			</li>
			<li class="list-group-item">
				INSTANT EMAIL SOLUTION 
			</li>
			<li class="list-group-item">
				DATA SECURITY
			</li>
			<li class="list-group-item">
				SEO SERVICES
			</li>
			<li class="list-group-item bg-light text-center buy-btn" amount="500" plan="exclusive" style="cursor:pointer;">
				<h4><i class="fa fa-inr"></i>500/Monthly</h4>
			</li>
		</ul>
	</div>
</div>
</div>



<script type="text/javascript">
	
	$(document).ready(function(){
		$(".buy-btn").each(function(){
			$(this).click(function(){
				var amount = $(this).attr("amount");
				var plan = $(this).attr("plan");
				alert(plan);
				location.href = "php/pay.php?amount="+amount
			});
		});
	});
</script>

</body>
</html>