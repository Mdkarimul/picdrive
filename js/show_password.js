$(document).ready(function(){
	$('.show-icon').click(function(e){
		e.preventDefault();
		if($(".password").attr('type') =="text")
		{
			$(".password").attr('type','password');
			$(this).css({
				'color' : '#050'
			});
		}
		else
		{
			$(".password").attr('type','text');
			$(this).css({
				'color' : '#000'
			});
		}
	});
});