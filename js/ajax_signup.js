$(document).ready(function(){
	$(".s-btn").click(function(e){
     e.preventDefault();
      
      $.ajax({
      	type :"POST",
      	url : "php/signup.php",
      	data : {
      		full_name :  btoa($(".full_name").val()),
      		email :  btoa($(".email").val()),
      		password : btoa($(".password").val())
      	},
      	beforeSend : function(){
        $(".s-btn").html("Processing please wait");
        $(".s-btn").attr('disabled','disabled');
      	},
      	success : function(response){
      		$(".s-btn").attr("disabled","disabled");
      		$(".s-btn").html("Register now");
           $(".email-loader").addClass("fa fa-circle-o-notch fa-spin");
           $(".email-loader").addClass("d-none");
           if(response.trim() == "email send to the user")
           {
            $("form").fadeOut(500,function(){
            	$(".activator").removeClass("d-none");

            });
            $("form").trigger('reset');
           }

           else if(response.trim() =="failed to send email")
           {
             var message = document.createElement("DIV");
             message.className = "alert alert-warning";
             message.innerHTML="<b>Something went wrong  try again !</b>";
             $('.signup-notice').append(message);
             setTimeout(function(){
             	$(".signup-notice").html("");
             },6000);
             //$("form").trigger('reset');
           }
           else if(response.trim() =="signup failed")
           {
             var message = document.createElement("DIV");
             message.className = "alert alert-warning";
             message.innerHTML="<b>Something went wrong  try again !</b>";
             $('.signup-notice').append(message);
             setTimeout(function(){
             	$(".signup-notice").html("");
             },6000);
             $("form").trigger('reset');
           }

      alert(response);
      	}
      });

	});
});