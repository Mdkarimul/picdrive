<?php
require_once("../php/database.php");


session_start();
$username = $_SESSION['username'];
if(empty($username))
{
 header("Location:../index.php");
 exit;
}

$starter = '<ul class="list-group w-100">
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
<li class="list-group-item bg-light text-center buy-btn" amount="99" plan="starter" storage="1024" style="cursor:pointer;">
	<h4><i class="fa fa-inr"></i>99.00/Monthly</h4>
</li>
</ul>';

$exclusive = '<ul class="list-group w-100">
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
<li class="list-group-item bg-light text-center buy-btn" amount="500" plan="exclusive" storage="unlimited" style="cursor:pointer;">
	<h4><i class="fa fa-inr"></i>500/Monthly</h4>
</li>
</ul>';

$get_plans = "SELECT plans FROM users WHERE username='$username'";
$response = $db->query($get_plans);
$data = $response->fetch_assoc();
$plans = $data['plans'];




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



<div class="container-fluid p-0 m-0">
<div class="row">
	<div class="col-md-6 p-5">
		<!--starter-->
		<?php
		if($plans=="free"){
       echo $starter;
		}else if($plans=="starter"){
			echo "<button class='btn btn-light shadow-lg'>
			 <h3>You are currently using starter plan</h3>
			</button>";
		}

		?>
	</div>
	<div class="col-md-6 p-5">
		<!--exclusive-->
		<?php
		if($plans=="free" || $plans=="starter"){
       echo $exclusive;
		}

		?>
	</div>
</div>


<div class="row">
<div class="col-md-4 p-5 text-center"></div>
	<div class="col-md-4 p-5 text-center">
    <?php
  if($plans=="exclusive"){
	echo "<button class='btn btn-light shadow-lg'>
	 <h3>You are currently using exclusive plan</h3>
	</button>";
	echo '<ul class="list-group w-100">
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
			
			</ul>';
}
	?>
	</div>
	<div class="col-md-4 p-5 text-center"></div>
</div>

</div>



<script type="text/javascript">
	
	$(document).ready(function(){
		$(".buy-btn").each(function(){
			$(this).click(function(){
				var amount = $(this).attr("amount");
				var plan = $(this).attr("plan");
				var storage = $(this).attr("storage"); 
				alert(plan);
				location.href = "php/pay.php?amount="+amount+"&plan="+plan+"&storage="+storage;
			});
		});
	});
</script>

</body>
</html>