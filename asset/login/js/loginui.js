	$(document).ready(function(){
		//-- Hide tooltip on close
		//
		
		$('.toolTip .close').click(function(){
			$(this.parentNode).fadeOut(function(){
				$(this).remove();
			});
		});
	});