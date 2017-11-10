// Drop down element
function clickSlide(options){

	var defaults ={
		trigger: '.trigger',
		target: '.target',
		speed: 'slow'
	}
	var settings = $.extend({}, defaults, options);

	$(settings.trigger).on('click', function(e){
		e.preventDefault();
		$(settings.target).slideToggle(settings.speed);
	});
}

// Load on document ready	
$(document).ready(function(){
	
	// Image header position
	$("#img-header").css({
		'padding-top' : $("#top-bar").outerHeight(true)
	});

	// Click slide only for mobile
	if( $(window).width() <= 768){

		clickSlide({
			trigger: '#special-offers h1 a',
			target: '#special'
		});
		clickSlide({
			trigger: '#quick-contact h1 a',
			target: '#form-contact-wrapper'
		});
	}
	


	// Normal nagivation
    jQuery('ul.sf-menu').superfish();
    
  
	// When clicking the burger
	$('.toggle-nav').click(function() {
		$('ul.sf-menu').slideToggle('fast');
		return false;
	});
	
	// Slideshow
	$('#img-header').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  autoplay: true,
	  autoplaySpeed: 1500,
	});
	
	
	// For testimonial guest
	$('.testimonial').slick({
	      centerMode: false,
		  centerPadding: '60px',
		  slidesToShow: 3,
		  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '10px',
		        slidesToShow: 1,
		      }
		    },
		    {
		      breakpoint: 500,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '5px',
		        slidesToShow: 1,
				slidesToScroll: 1,
		      }
		    }
		  ]
	  });

	// Tab
	$('#villa-tabs').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        closed: 'accordion', // Start closed if in accordion view
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function (event) { // Callback function if tab is switched
        }
    });

  	// fancybox
  	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none',
		padding: 3,
		margin: 10
	});

	// justified gallery
	$(".gallery-image").justifiedGallery({
		rowHeight: 115,
		maxRowHeight: 115,
		captions: false,
		margins: 5,
		border: 0,
		lastRow: 'nojustify'
	});
});