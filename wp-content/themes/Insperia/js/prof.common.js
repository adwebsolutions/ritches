jQuery(document).ready(function($){

"use strict";
	var TimeValue = '';
	
	$(".insperia-single-row").each(function() {
		$(this).wrapInner("<div class='homepage-container-design-inner'></div>");
	});
	  
	
	$(".product-summary .cart .single_add_to_cart_button").each(function() {
		$(this).append('<i class="fa fa-shopping-cart fa-white"></i>');
	});
	
	
	$(".single-product .shop .alert .button").each(function() {
		$(this).append('<i class="fa fa-shopping-cart"></i>');
	});
	

	var checkExist = setInterval(function() {
	   if ($('.tweet-details time').length) {
			$(".tweet-details time").each(function() {
				TimeValue = $(this).attr('data-loctitle');
				$(this).text();
				$(this).timeago();
				$(this).prepend('<i class="fa fa-twitter"></i>');
			});	
			clearInterval(checkExist);
	   }
	}, 1000);
	
	$(".dropdown.cart-nav").mouseover(function() {
		$(this).find(".cart_list.dropdown-menu").addClass("insperia-open");
		$(this).find("ul.cart_list.product_list_widget").addClass("insperia-open");
	  }).mouseout(function(){	
		$(this).find(".cart_list.dropdown-menu").removeClass("insperia-open");
		$(this).find("ul.cart_list.product_list_widget").removeClass("insperia-open");
	});


	$(".nav.navbar-nav .page_item_has_children").mouseover(function() {
		$(this).addClass("open");
	  }).mouseout(function(){	
		$(this).removeClass("open");
	});

	$("a.add_to_cart_button").live("click",function() {
		setTimeout(function() {
			$("html, body").animate({ scrollTop: 0 },"slow");
		}, 1000);	
		
		setTimeout(function() {
			$(".dropdown.cart-nav .cart_list.dropdown-menu").addClass("insperia-open");
		}, 2000);			
		
		setTimeout(function() {
			$(".dropdown.cart-nav .cart_list.dropdown-menu").removeClass("insperia-open");
		}, 5000);
		return false;
	});		
	
	/*Navigation Scrolling		*/
	$(function() {
	  $('.navbar a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top - 80
			}, 1200);
			
			$(".container .navbar-nav li a").each(function() {
				$(this).removeClass("insperia-onepage-active");
			});
			
			$(this).addClass("insperia-onepage-active");		
			
			return false;
		  }
		}
	  });
	});		
	
});

