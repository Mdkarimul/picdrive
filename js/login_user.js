$(document).ready(function(){
	$(".l-btn").click(function(e){
		e.preventDefault();
		var email = btoa($(".email").val());
		var password = btoa($(".password").val());

        	$.ajax({
			type : "post",
			url : "php/login.php",
			data : {
				username : email,
				password : password
			},
			beforeSend : function(){
              $(".l-btn").html("Processing please wait");
              $(".l-btn").attr("disabled","disabled");
			},
			success : function(response){
             $(".l-btn").html("Login now");
              $(".l-btn").removeAttr("disabled");
			
               if(response.trim() =="Login success")
               {
               window.location = "profile/profile.php";
               }
               else if(response.trim() =="wrong password")
               {
                var message = document.createElement("DIV");
                message.className = "alert alert-warning";
                message.innerHTML="<b>"+ response +"</b>";
                $(".login-notice").append(message);
                setTimeout(function(){
                $(".login-notice").html("");
                },5000);
                $("form").trigger('reset');
               }

               else if(response.trim() =="user not found")
               {
                var message = document.createElement("DIV");
                message.className = "alert alert-warning";
                message.innerHTML="<b>"+ response +"</b>";
                $(".login-notice").append(message);

                setTimeout(function(){
                $(".login-notice").html("");
                },5000);
                $("form").trigger('reset');
               }
			}
		});
	});
});