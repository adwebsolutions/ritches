(function($) {
  "use strict";
/* 
* Insperia - Multi-purpose Responsive HTML5 Theme, designed by Hashim Bilal -- (http://www.oscodo.com)
	------------------------------------------------------------------------------------------
	Script to detect mobile devices and makes menu dropdowns open on click tather than on hover
	--------------------------------------------------------------------------------------------- */
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {} else {
		//alert('not mobile');
		(function ($, window, delay) {
			var theTimer = 0;
			var theElement = null;
			var theLastPosition = {
				x: 0,
				y: 0
			};
			$('[data-toggle]')
				.closest('li')
				.on('mouseenter', function (inEvent) {
					if (theElement) theElement.removeClass('open');
					window.clearTimeout(theTimer);
					theElement = $(this);
	
					theTimer = window.setTimeout(function () {
						theElement.addClass('open');
					}, delay);
				})
				.on('mousemove', function (inEvent) {
					if (Math.abs(theLastPosition.x - inEvent.ScreenX) > 4 ||
						Math.abs(theLastPosition.y - inEvent.ScreenY) > 4) {
						theLastPosition.x = inEvent.ScreenX;
						theLastPosition.y = inEvent.ScreenY;
						return;
					}
	
					if (theElement.hasClass('open')) return;
					window.clearTimeout(theTimer);
					theTimer = window.setTimeout(function () {
						theElement.addClass('open');
					}, delay);
				})
				.on('mouseleave', function (inEvent) {
					window.clearTimeout(theTimer);
					theElement = $(this);
					theTimer = window.setTimeout(function () {
						theElement.removeClass('open');
					}, delay);
				});
		})($, window, 50); // 50 is the delay in milliseconds
	}
	

//document.ready function
$(document).ready(function(){
		$(window).scroll(function () { // scroll event
			
			var bannerHeight = $('.splash-banner').innerHeight();
			var winHeight = $(window).innerHeight();
			var pageId = $('body').attr('id');
			
			
			if($('body').hasClass( 'body-navbar-hidden' )){var checkHidden = true;}else{var checkHidden = false;}
			
			//splash banner DOWNLOAD btn
			if(pageId == 'intro' && checkHidden == false){
				if ($(window).scrollTop()+winHeight >= bannerHeight) {
					$('#download').css('position', 'absolute');
				} else {
					$('#download').removeAttr('style');
				}
		
				if ($(window).scrollTop() >= bannerHeight) {
					$('.navbar').addClass('navbar-fixed-top');
					$('body').css('padding-top', '60px');
				} else {
					$('.navbar').removeClass('navbar-fixed-top');
					$('body').removeAttr('style');
				}
			} else {
				if(checkHidden){
					if(pageId == 'intro'){
						if ($(window).scrollTop() > $(".navbar.navbar-hidden").height()+30) {
							$("#intro .navbar.navbar-hidden").addClass("show-nav");
						} else {
							$('body').css('padding-top', '0px');
							$("#intro .navbar.navbar-hidden").removeClass("show-nav");
							$("#intro .navscroll").collapse({toggle: false});
							$("#intro .navscroll").collapse("hide");
							$("#intro .navbar-toggle").addClass("collapsed");
						}
					}
				}
			}
			
		});
	
		// Single page scroll effect
		jQuery('.bouncing-arrow').click(function(){	
			var el = jQuery(this).attr('href');
			var elWrapped = jQuery(el);		
			scrollToDiv(elWrapped,59);
			return false;	
		});
		function scrollToDiv(element,navheight){	
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop-navheight;
			
			jQuery('body,html').animate({
					scrollTop: totalScroll
			}, 500);
		
		}
	
		//ticker in main banner on home page
		$(function(){
			if ($('#vertical-ticker').length > 0) {
				$('#vertical-ticker').totemticker({
					row_height	:	'80px',
					next		:	'#ticker-next',
					previous	:	'#ticker-previous',
					stop		:	'#stop',
					start		:	'#start',
					mousestop	:	true,
					max_items   :   1,
					speed       :   800,
					interval    :   3000
				});
			}
		});

	  
	//portfolio filter options
	  var $filterType = $('.options-list li.active a').attr('class');
	  var $holder = $('.portfolio');
	  var $data = $holder.clone();

		$('.options-list li a').click(function(e) {
			$('.options-list li').removeClass('active');
			var $filterType = $(this).attr('class');
			$(this).parent().addClass('active');
			if ($filterType == 'all') {
				var $filteredData = $data.find('li');
			} 
			else {
				var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
			}
			
			// call quicksand and assign transition parameters
			$holder.quicksand($filteredData, {
				duration: 800,
				easing: 'easeInOutQuad',
				useScaling: true,
				adjustHeight: 'dynamic'
			});
			return false;
		});
	//portfolio filter options (END)
	
	//search form open-close
	

	$('.search-nav > a').click(function(){
		$('.search-form').animate({
				top: '0'
			}, 500);
	});
	$('.search-form .btn').click(function(){
		$('.search-form').animate({
				top: '-62'
			}, 500);
	});
	

	//portfolio category filter options
	//dropdown menu
	$('.cat-toggle').click(function(){
		$(this).next().slideToggle();
	});
	$('.filter-options .options-list li a').click(function(){
		var selectedCat = $(this).text();
		$('.cat-title span').text(selectedCat);
	});
	
	//Comparison Charts
	$('.chart-controls .btn-group label').click(function(){
		if($(this).attr('id') == 'monthByMonth'){
			$('.column .annual, .column .two-year').slideUp();
			$('.column .monthly').slideDown();
		}else
		if($(this).attr('id') == 'annualBilling'){
			$('.column .monthly, .column .two-year').slideUp();
			$('.column .annual').slideDown();
		}else
		if($(this).attr('id') == 'twoYearBilling'){
			$('.column .annual, .column .monthly').slideUp();
			$('.column .two-year').slideDown();
		}
	});

	//Inner page's header TEXT parallax
	$(window).scroll(function () {
		textParallax();
	});
	
	
});// document.ready function
})(jQuery);

//Utilcarousel "about_creative.html" function
function aboutCreativeCarousels(){
	 "use strict";	
			//util-carousel
			jQuery('#carouselFirst').utilCarousel({
				responsiveMode : 'itemWidthRange',
				itemWidthRange : [260, 320],
					autoPlay : true,
					interval : 3000,
					itemAnimation:'util-flip-in-x'
			});
			jQuery('#carouselSecond').utilCarousel({
				responsiveMode : 'itemWidthRange',
				itemWidthRange : [160, 180],
					autoPlay : true,
					interval : 3000,
					itemAnimation:'util-fade-in'
			});
			jQuery('#team-showcase').utilCarousel({
				responsiveMode : 'itemWidthRange',
				itemWidthRange : [300, 360],
					autoPlay : true,
					interval : 3000,
					itemAnimation:'util-flip-in-y'
			});
			
			jQuery('#team-showcase-two').utilCarousel({
				responsiveMode : 'itemWidthRange',
				itemWidthRange : [260, 320],
					autoPlay : true,
					interval : 3000,
					itemAnimation:'util-flip-in-y'
			});
			
			jQuery('#logo-showcase-gray').utilCarousel({
				showItems : 5,
				responsiveMode : 'itemWidthRange',
				itemWidthRange : [200, 210],
				interval : 3000,
				autoPlay : true,
				pagination : false
			});			
			
			jQuery('#util-carousel-portfolio').utilCarousel({
					pagination : false,
					breakPosints : [[1200, 4], [992, 3], [768, 2], [480, 1]]
				});			
			
}//Utilcarousel "about_creative.html" end


//Utilcarousel function "Home2.html"
function homeCreativeCarousels(){
	 "use strict";
	jQuery('#fullwidth').utilCarousel({
					breakPoints : [[600, 1], [900, 2], [1200, 3], [1500, 4], [1800, 5]],
					mouseWheel : true,
					rewind : false
				});
}//Utilcarousel function "Home2.html" end


function loadingDivHide()
{

	if ( jQuery("#loading_div").length ) {	 
		document.getElementById("loading_div").style.display = "none";	 
	}

	if ( jQuery("#loaded").length ) {	 
		document.getElementById("loaded").style.display = "block";	 
	}	  

  allCommonFunctions();
  aboutCreativeCarousels();
  homeCreativeCarousels();
  flipCountDown();  
}

//All common functions
function allCommonFunctions(){
	 "use strict";
	//wow onload content animation
	var wow = new WOW(
	  {
		animateClass: 'animated',
		offset:       100
	  }
	);
	wow.init();
	
	/* fun-facts countTo animation */
	jQuery(function($) {
		$(".fact").appear(function(){
			$('.fact').each(function(){
		       	var dataperc = $(this).attr('data-perc');
				$(this).find('.factor').delay(3000).countTo({
			        from: 0,
			        to: dataperc,
			        speed: 3000,
			        refreshInterval: 50,
	            
        		});  
			});
		});
	});

	
	/* PiE Chart init function */
	jQuery('.chart').appear(function(){
		initPieChart();
	});	
	//pie chart (on about.html page)
	/* PiE Charts */
	var initPieChart = function() {
			jQuery('.percentage-light').easyPieChart({
				barColor: '#232425',
				trackColor: 'rgba(230, 230, 230, 0.2)',
				scaleColor: false,
				lineCap: 'round',
				rotate: -90,
				lineWidth: 10,
				size: 120,
				animate: 2000,
				onStep: function(value) {
					this.$el.find('span').text(~~value);
				}
			});
	
	};
	
	//carousel (smple image slider)
	jQuery('.carousel').carousel();
	
	//mediaelementpalyer
	if (jQuery(".my-video, .my-audio").length > 0) {	
		jQuery(".my-video, .my-audio").mediaelementplayer();
	}
	//masonry blog
	if (jQuery('#masonryBlog').length > 0) {
		jQuery('#masonryBlog').masonry({
			itemSelector: '.masonry-item'
		});
	}

	
	//initializing all parallax elements
	jQuery('.parallax').parallax("50%", 0.5);
	
	//flexslider for testimonials
	jQuery('.flexslider').flexslider({
		animation: "fade",
		touch: true,
	});
	
	//nivo lightbox
	if (jQuery('.zoom').length > 0) {
		jQuery('.zoom').nivoLightbox({
			effect: 'fade',                             // The effect to use when showing the lightbox
			theme: 'default',                           // The lightbox theme to use
			keyboardNav: true,                          // Enable/Disable keyboard navigation (left/right/escape)
			clickOverlayToClose: true,                  // If false clicking the "close" button will be the only way to close the lightbox
			errorMessage: 'The requested content cannot be loaded. Please try again later.' // Error message when content can't be loaded
		});
	}
	//tool tip
	jQuery('.tip').tooltip();
	
	//popover
	jQuery('.pop-over').popover()
	
	//loading state button		
  jQuery('.loading').click(function () {
    var btn = $(this)
    btn.button('loading')
  });
	
}//all common functions end


function flipCountDown(){
	"use strict";
		var clock;

		var fullDate = new Date();
		var twoDigitMonth;
		var twoDigitDay;
		
		if(fullDate.getMonth() + 1 < 10){
			twoDigitMonth = fullDate.getMonth() + 1
			twoDigitMonth = '0' + twoDigitMonth;
		} else {
			twoDigitMonth = fullDate.getMonth() + 1;
		}

		if(fullDate.getDate() + 1 < 10){
			twoDigitDay = fullDate.getDate() + 1
			twoDigitDay = '0' + twoDigitDay;
		} else {
			twoDigitDay = fullDate.getDate() + 1;
		}		
		
		var FutureDate = jQuery('#future').attr('data-year') + "-" + jQuery('#future').attr('data-month') + "-" + jQuery('#future').attr('data-day');			
		
		var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDay;
		
		jQuery('#future').addClass(currentDate);
		
		var start = new Date(currentDate),
			end   = new Date(FutureDate),
			diff  = new Date(end - start),
			days  = diff/1000/60/60/24;		
		
		if (jQuery('#future').length > 0) {
			clock = jQuery('#future').FlipClock(3600 * 24 * days, {
				clockFace: 'DailyCounter',
				countdown: true
			});
		}

}


//Inner page's header TEXT parallax
function textParallax() {
	var myScroll = jQuery(this).scrollTop();
	jQuery('.page-header-wrap .container').css({
		'opacity': 1 - (myScroll / 200)
	});
}


//Revolution Slider plugin setup function
function myRevSlider(){
	"use strice"
				
					$('.tp-banner').show().revolution(
					{
						dottedOverlay:"none",
						delay:16000,
						startwidth:1170,
						startheight:700,
						hideThumbs:200,
						thumbWidth:100,
						thumbHeight:50,
						thumbAmount:5,
						navigationType:"bullet",
						navigationArrows:"solo",
						navigationStyle:"preview4",
						touchenabled:"on",
						onHoverStop:"on",
						swipe_velocity: 0.7,
						swipe_min_touches: 1,
						swipe_max_touches: 1,
						drag_block_vertical: false,
						parallax:"mouse",
						parallaxBgFreeze:"on",
						parallaxLevels:[7,4,3,2,5,4,3,2,1,0],					
						keyboardNavigation:"off",
						navigationHAlign:"center",
						navigationVAlign:"bottom",
						navigationHOffset:0,
						navigationVOffset:20,
						soloArrowLeftHalign:"left",
						soloArrowLeftValign:"center",
						soloArrowLeftHOffset:20,
						soloArrowLeftVOffset:0,
						soloArrowRightHalign:"right",
						soloArrowRightValign:"center",
						soloArrowRightHOffset:20,
						soloArrowRightVOffset:0,	
						shadow:0,
						fullWidth:"on",
						fullScreen:"on",
						spinner:"spinner4",
						stopLoop:"off",
						stopAfterLoops:-1,
						stopAtSlide:-1,
						shuffle:"off",
						autoHeight:"off",						
						forceFullWidth:"off",						
						hideThumbsOnMobile:"off",
						hideNavDelayOnMobile:1500,						
						hideBulletsOnMobile:"off",
						hideArrowsOnMobile:"off",
						hideThumbsUnderResolution:0,
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						startWithSlide:0,
						fullScreenOffsetContainer: ".header",
						hideTimerBar: "on"	
					});
}