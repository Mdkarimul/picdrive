$(document).ready(function(){
	$(".email").on("input",function(){
  if($(this).val() != "")
  {
  	  $.ajax({
      type : "POST",
      url : "php/user_check.php",
      data : {
      	email : btoa($(this).val())
      },
      beforeSend : function(){
     $(".email-loader").removeClass("d-none");

      },
      success : function(response){
        
        
        $(".email-loader").removeClass("fa fa-circle-o-notch fa-spin");
      	 if(response.trim() =="user found")
      	 {
      	 	$(".email-loader").removeClass("fa fa-circle-o-notch fa-spin");
      	 	$(".email-loader").addClass("fa fa-times-circle text-warning");
      	 	$(".s-btn").attr("disabled","disabled");
      	 }
      	 else
      	 {
      	 	$(".email-loader").removeClass("fa fa-times-circle text-warning");
      	 	$(".email-loader").addClass("fa fa-check-circle text-primary");
      	 	$(".s-btn").removeAttr("disabled");
      	 }
      }
      });
  }
    


	});
});