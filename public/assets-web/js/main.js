/*
|--------------------------------------------------------------------------
| General functions
|--------------------------------------------------------------------------
|
*/

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
})

// Disable Image Draging
window.ondragstart = function () { return false; }

// skrollr.init();

// Disable Right Click On Images
$("img").bind('contextmenu', function (e) { return false; });

/*
|--------------------------------------------------------------------------
| Document ready function
|--------------------------------------------------------------------------
|
*/

$(document).ready(function () {
    
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top 
        }, 0);
    });
        
	/* main slider in home */
    const slider = $(".slider-top-images-container");
    const slider_about = $(".slider-about-images-container");
    slider.each(function() {
        $(this).slick({
            dots: true,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: false,
            arrows: false,
            pauseOnHover: true,
            responsive: [{
                    arrows: false,
                    dots: true,
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                },
                {
                    breakpoint: 600,
                    arrows: false,
                    dots: true,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                },
                {
                    breakpoint: 480,
                    arrows: false,
                    dots: true,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
	});
	
	slider_about.each(function() {
        $(this).slick({
            dots: true,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: false,
            arrows: false,
            pauseOnHover: true,
            responsive: [{
                    arrows: false,
                    dots: true,
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                },
                {
                    breakpoint: 600,
                    arrows: false,
                    dots: true,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                },
                {
                    breakpoint: 480,
                    arrows: false,
                    dots: true,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
	/*
	|--------------------------------------------------------------------------
	| End Initialize Libraries
	|--------------------------------------------------------------------------
	*/
    AOS.refresh();
});
