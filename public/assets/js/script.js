	window.addEventListener('scroll', function () {
    const header = document.querySelector('.navbar');

    if (window.scrollY > 100) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

$(document).ready(function(){
		$('.sm-clickScroll').on('click',function(e){
			var elemenScroll= $(this).attr('href');
			$('html,body').animate({
				scrollTop: $(elemenScroll).offset().top
			},1200);
			e.preventDefault();
		});

		
	});


