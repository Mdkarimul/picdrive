$(document).ready(function(){
	$(".upload-icon").click(function(){
		var input = document.createElement("INPUT");
		input.type = "file";
		input.accept = "image/*";
		input.click();
		input.onchange = function(){
			var file = new FormData();
			file.append("data",this.files[0]);
			console.log(this.files);
			$.ajax({
				type :"POST",
				url : "php/upload.php",
				data : file,
				contentType: false,
				processData: false,
				cache : false,
				xhr : function (){
                var  request = new XMLHttpRequest();
                request.upload.onprogress= function(e){
               var loaded = (e.loaded/1024/1024).toFixed(2);
               var total = (e.total/1024/1024).toFixed(2);
               var per = (loaded*100)/total;
               $(".progress-control").css({
               	width : per+"%"
               });
               $(".progress-per").html(per+ "%"+ " "+loaded+" MB /"+total+"MB");
                }
                return request;
				},
				beforeSend : function(){
                $(".upload-header").html("Please wait...");
                $(".upload-icon").css({
                	opacity : "0.5",
                	pointerEvents : "none",
                });
                $(".upload-progress-con").removeClass("d-none");
                $(".progress-details").removeClass("d-none");

				},
				success : function(response){
					if(response.trim()=="Update"){
						var message = document.createElement("DIV");
						message.className="alert alert-success shadow-lg rounded-0";
						message.innerHTML="<b>"+response+"</b>";
						$(".upload-notice").html(message);
						setTimeout(function(){
							$(".upload-header").html("Upload files");
							$(".upload-icon").css({
								opacity : "1",
								pointerEvents : "auto",
							});
							$(".upload-progress-con").addClass("d-none");
							$(".progress-control").css({
								width : "0"
							});
							$(".upload-notice").html("");
							setTimeout(function(){
								$(".progress-per").html("<b class='text-success'>Done !</b>");
							
								setTimeout(function(){
									$(".progress-per").html("");
								},6000);
							},5000);
						},3000);
						
						
					}else{
						var message = document.createElement("DIV");
						message.className="alert alert-danger shadow-lg rounded-0";
						message.innerHTML="<b>"+response+"</b>";
						$(".upload-notice").html(message);
						setTimeout(function(){
							$(".upload-header").html("Upload files");
							$(".upload-icon").css({
								opacity : "1",
								pointerEvents : "auto",
							});
							$(".upload-progress-con").addClass("d-none");
							$(".progress-control").css({
								width : "0"
							});
							$(".upload-notice").html("");
							setTimeout(function(){
								$(".progress-per").html("<b class='text-danger'>Ops try again !</b>");
								setTimeout(function(){
									$(".progress-per").html("");
								},3000);
							},3000);
						},3000);
					}
                  $.ajax({
                  	type : "POST",
                  	url : "php/count_photo.php",
                  	beforeSend : function(){
                     $("#count_photo").html("Updating...");
                  	},
                  	success : function(response){
                    $("#count_photo").html(response);
                  	}
                  });

                   $.ajax({
                  	type : "POST",
                  	url : "php/memory_status.php",
                  	beforeSend : function(){
                     
                  	},
                  	success : function(response){
                  		var data = JSON.parse(response);
                  		var free ="FREE SPACE : "+data[1];
                        $("#m_status").html(data[0]);
                        var per = data[2]+"%";
                        $(".m-progress").css({
                        	width : per
                        });
                        $("#free_memory").html(free);
                  	}
                  });
				}

			});
		}
	});
});