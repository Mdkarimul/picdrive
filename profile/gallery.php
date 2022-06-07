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
<script type="text/javascript" src="js/edit_photo.js"></script>
<style type="text/css">
	
	span:focus{
		outline: 2px dashed rgb(100,0,30);
		padding: 2px 5px;
	}
</style>

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


<div class="container mt-5">
<div class="row load-image">

</div>
</div>


<div class="modal my-5 animated bounceIn" id="pic_show">
	<div class="modal-dialog">
		<i style="cursor: pointer;background-color: white;" class="fa fa-times-circle float-right p-1" data-dismiss="modal"></i>
		<div class="modal-content">
		<div class="progress w-100 bg-dark" style="height=10px;border-left-radius:0;border-right-radius:0;">
		<div class="progress-bar image-loader text-warning">
		</div>
		</div>
			<div class="modal-body">
				<h1>Wellcome to us</h1>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
     $(".pic").each(function(){
     	$(this).click(function(){
			 $(".image-loader").css({
				 width :'0%'
			 });
			 $("#pic_show").modal();
     		var img = document.createElement("IMG");
     		var url = img.src=$(this).attr('data-location');
			 $.ajax({
				 type : "POST",
				 url : url,
				 xhr : function() {
                  var r = new XMLHttpRequest();
				  r.responseType = "blob";
				  r.onprogress = function(e)
				  {
					  console.log(e);
                    var per =  Math.floor((e.loaded*100)/e.total);
					
					$(".image-loader").css({
                     width : per+"%"
					});
					$(".image-loader").html(per+"%");
				  }
				  return r;
				 },
				 beforeSend : function(){
					 $(".modal-body").html("Please wait...");
				 },
				 success : function(response){
                   console.log(response);
				   var img_url = URL.createObjectURL(response);
				   img.src = img_url;
				   img.style.width ="100%";
				   $(".modal-body").html(img);
				 }
			 });
     		
     	});
     });
	});


	//load image

	$(document).ready(function(){
		var s_point = 0;
		var e_point = 12;
		function load_image(s_point,e_point)
		{
			$.ajax({
				type :"POST",
				url : "load_image.php",
				cache : false,
				data : {
                s : s_point,
				e : e_point
				},
				success : function(response){
                 $(".load-image").append(response);
				}
			});
		}
		load_image(s_point,e_point);
		

		//load image on scroll
		$(window).scroll(function(){
			var s_top = $(window).scrollTop();
			var w_height = $(window).height();
			var max_height = s_top+w_height;
			var webpage_height = $(document).height();
			if(max_height>=webpage_height-60)
			{
				s_point = s_point+e_point;
              load_image(s_point,e_point);
			}
			

		});
	});

	
</script>
</body>
</html>