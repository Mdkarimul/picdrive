<!DOCTYPE html>
<html lang="en">
<head>
 <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  	<link rel="stylesheet" type="text/css" href="style/index.css">

  	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Francois+One&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="js/show_password_login.js"></script>
<script type="text/javascript" src="js/login_user.js"></script>
</head>
<body>
	
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4 p-4">
		</div>
		<div class="col-md-4 p-4">
			
			   
       <form autocomplete="off">
       	<h3 class="ml-2 mb-3">Login</h3>
       
        
        <div class="email-box">
       	<div class="form-group mb-3">
       	<input type="email"  name="email" placeholder="Enter your email " class="form-control email">
       	<i class="fa fa-circle-o-notch fa-spin email-loader d-none"></i>
         </div>
         </div>

        <div class="password-box">
        <div class="form-group mb-3">
       	<input type="password" name="password"  class="form-control password password">
       	<i class="fa fa-eye show-icon" style="font-size:18px;"></i>
         </div>
        </div>


      

     
         <button  class="btn l-btn m-3 " type="submit">Login now</button>
         
     
    


         <div class=" p-2 login-notice">
         	
         </div>
       </form>
         <div class="d-flex">
         <p>If you don't have a account signup now  <button type="button" class="btn  text-primary "><a href="index.php">Signup now</a></button></p>
         
         </div>


       <div class="px-2 d-none  activator">
       	<h3 class="ml-2 mb-3">Activate now</h3>
       	<span>Please check your email to get activation code</span>
       	<div class="form-group">
       		<input type="email" name="email" class="user-email" placeholder="Enter user email">
       		<input type="text" name="code" id="code"  class="my-3" placeholder="Activation code">
       		<button class="btn btn-dark a-btn">Activate now</button>
       	</div>
       </div>

		</div>
	</div>
</body>
</html>