$(document).ready(function(){
		$('.sm-clickScroll').on('click',function(e){
			var elemenScroll= $(this).attr('href');
			$('html,body').animate({
				scrollTop: $(elemenScroll).offset().top
			},1200);
			e.preventDefault();
		});

		
	});