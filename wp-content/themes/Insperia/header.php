	<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->


<!-- Head Section Started
================================================== -->
<head>


	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php wp_title('|', true, 'right'); ?></title>
	
	
	<!-- Get Variables and include files
  ================================================== -->	
	<?php			

		global $prof_default, $woocommerce; ;
        $insperia_body_hidden = '';
        $insperia_front_page = '';
		if((is_front_page() && !is_home())){ $insperia_header_stick = ''; $bodyID = 'intro';} else { $bodyID = 'internal'; $insperia_header_stick = 'navbar-fixed-top';}	
		if(is_user_logged_in()) {$insperia_user_logged = 'insperia-user-logged';$insperia_search_logged = 'insperia-search-logged';} else {$insperia_user_logged = ''; $insperia_search_logged = 'insperia-search-not-logged';}
		if((is_front_page() && !is_home()) && of_get_option('insperia_header',$prof_default) == 'HeaderThree'){$insperia_hidden_menu = 'navbar-hidden'; $insperia_body_hidden = 'body-navbar-hidden';$insperia_header_stick = 'navbar-fixed-top';}else{$insperia_hidden_menu = '';}
		if(of_get_option('select_ajax',$prof_default) == 'On'){$loading = 'loading_div'; $loaded = 'loaded';} else {$loading = 'not_loading_div'; $loaded = 'not_loaded';}
		
	?>

	
	<!-- Responsive is enabled 
	================================================== -->	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo esc_url(of_get_option('theme_favicon',$prof_default)); ?>" type="image/vnd.microsoft.icon"/>	
	
	<?php wp_head(); ?>
	
</head>
<!-- Head Section End
================================================== -->




<!-- Body Section Started
================================================== -->
<?php
	$insperia_body_hidden = esc_attr($insperia_body_hidden);
?>
<body id="<?php echo esc_attr($bodyID); ?>" onload="loadingDivHide();" <?php body_class($insperia_body_hidden); ?>>

	<div id="<?php echo $loading; ?>"> <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/loading.gif" height="66" width="66" alt="Insperia">
		<p><?php _e("Loading..." , "insperia"); ?></p>
	</div>

	<div id="<?php echo $loaded; ?>" class="<?php echo esc_attr($insperia_front_page); ?>">
		<header>
			<?php if(is_front_page() && !is_home() && of_get_option('insperia_header',$prof_default) == 'HeaderOne'){ ?>
				<?php if(of_get_option('page_slider_option',$prof_default) == 'On'){ ?>	
						<section class="splash-banner">
						
							<!-- Slider Section Started
							================================================== -->						
							<section class="insperia-revolution-slider">
								<?php echo do_shortcode(of_get_option('page_slider',$prof_default)); ?>
							</section>
							<!-- Slider Section End
							================================================== -->							
							
						</section>
				<?php } else { ?>
						<?php if(of_get_option('slider_background_option',$prof_default) == 'Video'){ ?>
							<!-- Video Section Started
							================================================== -->						
							<video poster="<?php echo esc_url(of_get_option('slider_background_image',$prof_default)); ?>" preload="none" class="no-svg bg-video" autoplay loop muted> 
								<!-- MP4 source must come first for iOS -->
								<source type="video/mp4" src="<?php echo esc_url(of_get_option('slider_background_video',$prof_default)); ?>" />
								<!-- WebM for Firefox 4 and Opera -->
								<source type="video/webm" src="<?php echo esc_url(of_get_option('slider_background_video_webm',$prof_default)); ?>" />
								<!-- OGG for Firefox 3 -->
								<source type="video/ogg" src="<?php echo esc_url(of_get_option('slider_background_video_ogv',$prof_default)); ?>" />
								<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
								<object width="360" height="203" type="application/x-shockwave-flash" data="../build/flashmediaelement.swf">
									<param name="movie" value="../build/flashmediaelement.swf" />
									<param name="flashvars" value="controls=true&amp;poster=../media/echo-hereweare.jpg&amp;file=media/<?php echo esc_url(of_get_option('slider_background_video',$prof_default)); ?>" />
									<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed --> 
									<img src="<?php echo esc_url(of_get_option('slider_background_image',$prof_default)); ?>" width="640" height="360" alt="Video" 
												title="No video playback capabilities" />
								</object>
							</video>
							<!-- Video Section End
							================================================== -->								
						<?php } ?>
						
						<!-- Static Header Section Started
						================================================== -->							
						<section class="splash-banner">
							<div class="pattern-wrap color1">
								<div class="container">
									<div class="row">
										<div class="col-md-10 col-md-offset-1 wow fadeInUp">
											<a href="<?php  echo esc_url(home_url()) ; ?>" class="splash-icon">
												<img src="<?php echo esc_url(of_get_option('slider_logo_image',$prof_default)); ?>" alt="<?php bloginfo( 'name' ) ?>">
											</a>
											<h1 class="splash-heading uppercase"><?php echo esc_attr(of_get_option('main_text_slider',$prof_default)); ?></h1>
											<div class="ticker">
												<hr>
												<?php
													$sliderDesc  = esc_attr(of_get_option('main_description_slider',$prof_default));
													$pieces = explode(",", $sliderDesc);
													$textCount = count($pieces);
													$fullText = '';
													$x = '';
													for ($x = 0; $x < $textCount; $x++) {
														$fullText .= '<li>' . $pieces[$x] . '</li>';
													} 
												?>
												<ul id="vertical-ticker" class="vertical-ticker">
													<?php echo $fullText; ?>
												</ul>
												<hr>
											</div>
											<?php if(of_get_option('slider_arrow_option',$prof_default) == 'On'){ ?>
												<a href="#contentWrap" class="bouncing-arrow"> <i class="fa fa-chevron-down"></i> </a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</section>
						<!-- Static Header Section End
						================================================== -->							
				<?php } ?>        
            <?php } ?>    
            
			<!-- Main navigation bar Started
			================================================== -->				
			<div class="navbar navbar-default <?php echo esc_attr($insperia_header_stick) . ' ' . esc_attr($insperia_user_logged) . ' ' . esc_attr($insperia_hidden_menu); ?>">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
						</button>
						<a href="<?php  echo esc_url(home_url()); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home" class="navbar-brand">
							<?php if(of_get_option('select_display_logo',$prof_default) == 'On'){ ?>
								<img src="<?php echo esc_url(of_get_option('theme_logo',$prof_default)); ?>" alt="Logo" class="logo-icon" />
							<?php } else { ?>
								<h3 class="insperia-logo-heading"><?php echo esc_attr(of_get_option('theme_site_logo_text',$prof_default)); ?></h3>							
							<?php } ?>
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right insperia-search-margin">
							
							<?php	
								if (of_get_option('select_sheadersearch',$prof_default) == 'On') {	
							?>							
								<li class="search-nav <?php echo esc_attr($insperia_search_logged); ?>"> <a href="javascript:void(0);"> <i class="fa fa-search"></i> </a> </li>
							<?php } ?>
							
							<?php	
								global $woocommerce; 
								if (class_exists('Woocommerce') && of_get_option('select_shoppingcart',$prof_default) == 'On') {	
							?>						
									<li class="dropdown cart-nav">
										<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="dropdown-toggle insperia-cart-contents" data-toggle="dropdown">
											<i class="fa fa-shopping-cart"></i> <span class="label label-primary"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
										</a>
										<div class="widget_shopping_cart_content dropdown cart-nav"><?php echo insperia_get_header_cart(); ?></div>                               
									</li>
							<?php } ?>
						</ul>
						<?php wp_nav_menu( array(
							'theme_location' => 'header-menu' ,
							'container' => false,
							'menu_class' => 'nav navbar-nav navbar-right ',
							'fallback_cb' => 'insperia_menu_fall_back',
							'walker' => new Insperia_description_walker()
							)); ?>
					</div>
					
					<!-- Header Search Section Started
					================================================== -->
					<?php	
						if (of_get_option('select_sheadersearch',$prof_default) == 'On') {	
					?>						
						<form action="<?php echo esc_url(get_site_url()); ?>" class="search-form" id="searchform" method="get" role="search">						
							<input type="search" id="s" name="s" value=""  class="form-control search-field" placeholder="Type your text here">
							<button type="button" class="btn btn-default btn-line"><i class="fa fa-times"></i></button>
						</form>
					<?php } ?>					
					<!-- Header Search Section End
					================================================== -->	
					
				</div>
			</div>
			<!-- Main navigation bar End
			================================================== -->	
			
			<!-- Checking other Header styles Started
			================================================== -->				
            <?php if(is_front_page() && !is_home() && (of_get_option('insperia_header',$prof_default) == 'HeaderTwo' || of_get_option('insperia_header',$prof_default) == 'HeaderThree')){ ?>
                <?php if(of_get_option('page_slider_option',$prof_default) != 'On'){ ?>
					<?php if(of_get_option('slider_background_option',$prof_default) == 'Video'){ ?>				
						
						<!-- Video Header Section Started
						================================================== -->							
						
						<video poster="<?php echo esc_url(of_get_option('slider_background_image',$prof_default)); ?>" preload="none" class="no-svg bg-video" autoplay loop muted> 
							<!-- MP4 source must come first for iOS -->
							<source type="video/mp4" src="<?php echo esc_url(of_get_option('slider_background_video',$prof_default)); ?>" />
							<!-- WebM for Firefox 4 and Opera -->
							<source type="video/webm" src="<?php echo esc_url(of_get_option('slider_background_video_webm',$prof_default)); ?>" />
							<!-- OGG for Firefox 3 -->
							<source type="video/ogg" src="<?php echo esc_url(of_get_option('slider_background_video_ogv',$prof_default)); ?>" />
							<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
							<object width="360" height="203" type="application/x-shockwave-flash" data="../build/flashmediaelement.swf">
								<param name="movie" value="../build/flashmediaelement.swf" />
								<param name="flashvars" value="controls=true&amp;poster=../media/echo-hereweare.jpg&amp;file=media/<?php echo esc_url(of_get_option('slider_background_video',$prof_default)); ?>" />
								<!-- Image fall back for non-HTML5 browser with JavaScript turned off and no Flash player installed --> 
								<img src="<?php echo esc_url(of_get_option('slider_background_image',$prof_default)); ?>" width="640" height="360" alt="Video" 
											title="No video playback capabilities" />
							</object>
						</video>
						
						<!-- Video Header Section End
						================================================== -->
						
					<?php } ?>
				
					<!-- Static Header Section Started
					================================================== -->						
					<section class="splash-banner">
						<div class="pattern-wrap color1">
							<div class="container">
								<div class="row">
									<div class="col-md-10 col-md-offset-1 wow fadeInUp">
										<a href="<?php  echo esc_url(home_url()); ?>" class="splash-icon">
											<img src="<?php echo esc_url(of_get_option('slider_logo_image',$prof_default)); ?>" alt="<?php bloginfo( 'name' ) ?>">
										</a>
										<h1 class="splash-heading uppercase"><?php echo esc_attr(of_get_option('main_text_slider',$prof_default)); ?></h1>
										<div class="ticker">
											<hr>
											<?php
												$sliderDesc  = esc_attr(of_get_option('main_description_slider',$prof_default));
												$pieces = explode(",", $sliderDesc);
												$textCount = count($pieces);
												$fullText = '';
												$x = '';
												for ($x = 0; $x < $textCount; $x++) {
													$fullText .= '<li>' . $pieces[$x] . '</li>';
												} 
											?>
											<ul id="vertical-ticker" class="vertical-ticker">
												<?php echo $fullText; ?>
											</ul>
											<hr>
										</div>
										<?php if(of_get_option('slider_arrow_option',$prof_default) == 'On'){ ?>
											<a href="#contentWrap" class="bouncing-arrow"> <i class="fa fa-chevron-down"></i> </a>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</section>
					
					<!-- Static Header Section End
					================================================== -->	
					
                <?php } ?>
            <?php } ?>
            
		</header>
		
		<!-- Home Content Wrap Section Started
		================================================== -->			
        <section class="home-content-wrap">	
     
        <?php if(is_front_page() && !is_home() && (of_get_option('insperia_header',$prof_default) == 'HeaderTwo' || of_get_option('insperia_header',$prof_default) == 'HeaderThree')){ ?>

				<!-- Slider Section Started
				================================================== -->					
				<?php if(of_get_option('page_slider_option',$prof_default) == 'On'){ ?>				
					<section class="insperia-revolution-slider">
						<?php echo do_shortcode(of_get_option('page_slider',$prof_default)); ?>
					</section>
                <?php } ?>
        <?php } ?>
        