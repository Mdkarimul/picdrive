//rename
$(document).ready(function(){
	$(".edit-icon").each(function(){
		$(this).click(function(){
			var location = $(this).attr('data-location');
		var parent = this.parentElement;
	var span = 	parent.getElementsByTagName("SPAN")[0];
	var save = 	parent.getElementsByClassName("save-icon")[0];
	var loader = 	parent.getElementsByClassName("loader-icon")[0];
	var edit = this;
	span.contentEditable = true;
	span.focus();
	var old_name = span.innerHTML;
	$(this).addClass('d-none');
	$(save).removeClass("d-none");
     $(save).click(function(e){
     	e.preventDefault();
     	var p_name = span.innerHTML;
     	$.ajax({
     		type : "POST",
     		url : "php/edit.php",
     		data : {
     			p_name : p_name,
     			p_path : $(this).attr('data-location')
     		},
     		beforeSend : function(){
     			$(save).addClass('d-none');
                $(loader).removeClass('d-none');
     		},
     		success : function(response){
     			alert(response);
     			$(loader).addClass('d-none');
     			$(edit).removeClass('d-none');
     			if(response.trim() =="File already exit enter another name")
     			{
     				span.focus();
     				alert(response);
     			}
     			else if(response.trim() =="success")
     			{
     				span.innerHTML=p_name;
     				span.contentEditable = false;
     				alert(response);
     				var previous_download_link = parent.getElementsByClassName("download-icon")[0].getAttribute("data-location");
                    var current_download_link =  previous_download_link.replace(old_name,p_name);
                     parent.getElementsByClassName("download-icon")[0].setAttribute("data-location",current_download_link);
                    parent.getElementsByClassName("download-icon")[0].setAttribute("file-name",p_name);
     			}
     		}
     	});
     });

		});
	});
});

//download 
$(document).ready(function(){
	$(".download-icon").each(function(){
		$(this).click(function(){
			var download_link = $(this).attr('data-location');
			var name = $(this).attr("file-name");
			var a  = document.createElement("A");
			a.href=download_link;
			a.download = name;
			a.click();
		});
	});
});


//delete photo

$(document).ready(function(){
	$(".delete-icon").each(function(){
		$(this).click(function(){
		 var location = $(this).attr("data-location");
		 var parent = this.parentElement;
		 var del = 	parent.getElementsByClassName("delete-icon")[0];
		 
		 $.ajax({
		 	type : "POST",
		 	url : 'php/delete.php',
		 	data : {
		 		location : location
		 	},
		 	beforeSend : function(){
		 		$(del).removeClass("fa fa-trash");
		 		$(del).addClass("fa fa-spinner fa-spin");
		 	},
		 	success : function(response){
		 		$(del).removeClass("fa fa-spinner fa-spin");
		 		$(del).addClass("fa fa-trash");
		 		alert(response);

		 		if(response.trim() =="Delete success")
		 		{
		 			parent.parentElement.remove();
		 		}
		 	}
		 });
		});
	});
});