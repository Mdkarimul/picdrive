$(document).ready(function(){
	$(".a-btn").click(function(e){
		e.preventDefault();
		
	var code = 	btoa($("#code").val());
	var email = btoa($(".user-email").val());
    
    $.ajax({
    	type : "POST",
    	url  : "php/activator.php",
    	data : {
    		code : code,
    		username : email
    	},
    	beforeSend : function(){
      $(".a-btn").html("please wait...");
    	},
    	success : function(response){
            alert(response);
    		$(".a-btn").html("Activate now");
         if(response.trim() == "user verified")
         {
         	window.location = "login.php";
         }
         else if(response.trim() =="verification failed")
         {
         	 var message = document.createElement("DIV");
             message.className = "alert alert-warning";
             message.innerHTML="<b>"+response+"</b>";
             $('.active-message').append(message);
             setTimeout(function(){
             	$(".active-message").html("");
             },6000);
         }
         else if(response.trim() =="wrong activation code")
         {
         	  var message = document.createElement("DIV");
             message.className = "alert alert-warning";
             message.innerHTML="<b>"+response+"</b>";
             $('.active-message').append(message);
             setTimeout(function(){
             	$(".active-message").html("");
             },6000);
         }
         else if(response.trim() =="user not found")
         {
         	 var message = document.createElement("DIV");
             message.className = "alert alert-warning";
             message.innerHTML="<b>"+response+"</b>";
             $('.active-message').append(message);
             setTimeout(function(){
             	$(".active-message").html("");
             },6000);
         }
    	}
    });

	});
});