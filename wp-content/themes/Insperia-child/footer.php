<?php

	global $prof_default;

?>
 
<!-- Footer Start
================================================== -->		


	<!-- Footer Social Icons
	================================================== -->
	<?php
		if(of_get_option('social_animation',$prof_default) == 'up') {$animation = 'wow fadeInUp';} elseif(of_get_option('social_animation',$prof_default) == 'down') {$animation = 'wow fadeInDown';} elseif(of_get_option('social_animation',$prof_default) == 'left') {$animation = 'wow fadeInLeft';} elseif(of_get_option('social_animation',$prof_default) == 'right') {$animation = 'wow fadeInRight';} else {$animation = '';}
	?>
	<?php if (of_get_option('facebook_user_account',$prof_default) != '' || of_get_option('linkedin_user_account',$prof_default) != '' || of_get_option('twitter_user_account',$prof_default) != '' || of_get_option('dribbble_user_account',$prof_default) != '' || of_get_option('pinterest_user_account',$prof_default) != '' || of_get_option('deviantart_user_account',$prof_default) != '' || of_get_option('skype_user_account',$prof_default) != '' || of_get_option('rss_user_account',$prof_default) != '') { ?>
		<section class="section footer-social-links social-links <?php echo esc_attr($animation); ?>">
			<span>SÍGUENOS: </span>

			<?php if (of_get_option('facebook_user_account',$prof_default) != '') { ?>
				<a target="_blank" title="<?php _e("Facebook" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('facebook_user_account',$prof_default)); ?>"> <i class="fa fa-facebook"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('linkedin_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("LinkedIn" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('linkedin_user_account',$prof_default)); ?>"> <i class="fa fa-linkedin"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('twitter_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Twitter" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('twitter_user_account',$prof_default)); ?>"> <i class="fa fa-twitter"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('dribbble_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Dribbble" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('dribbble_user_account',$prof_default)); ?>"> <i class="fa fa-dribbble"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('pinterest_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Pinterest" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('pinterest_user_account',$prof_default)); ?>"> <i class="fa fa-pinterest"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('deviantart_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Deviantart" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('deviantart_user_account',$prof_default)); ?>"> <i class="fa fa-deviantart"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('skype_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Skype" , "insperia"); ?>" href="<?php echo esc_attr(of_get_option('skype_user_account',$prof_default)); ?>"> <i class="fa fa-skype"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('rss_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("RSS" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('rss_user_account',$prof_default)); ?>"> <i class="fa fa-rss"></i> </a>
			<?php } ?>
			
			<?php if (of_get_option('google_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Google+" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('google_user_account',$prof_default)); ?>"> <i class="fa fa-google"></i> </a>
			<?php } ?>			

			<?php if (of_get_option('instagram_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("Instagram" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('instagram_user_account',$prof_default)); ?>"> <i class="fa fa-instagram"></i> </a>
			<?php } ?>

			<?php if (of_get_option('youtube_user_account',$prof_default) != '') { ?>			
				<a target="_blank" title="<?php _e("YouTube" , "insperia"); ?>" href="<?php echo esc_url(of_get_option('youtube_user_account',$prof_default)); ?>"> <i class="fa fa-youtube"></i> </a>
			<?php } ?>			
		</section>
	<?php } ?>
	
 
	<!-- Footer Columns
	================================================== -->	 
	<footer>
		<div class="container">
			<div class="row">
				<div class="insperia-footer-col-handler col-md-3 col-sm-6 ft-col wow fadeInLeft ">
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-Col-I')) { ?> 
							<?php dynamic_sidebar('Footer-Col-I'); ?>
					<?php } ?>
				</div>				
				<div class="insperia-footer-col-handler col-md-3 col-sm-6 ft-col wow fadeInLeft ">						
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-Col-II')) { ?>  		
							<?php dynamic_sidebar('Footer-Col-II'); ?>
					<?php } ?>
				</div>										
				<div class="insperia-footer-col-handler col-md-3 col-sm-6 ft-col wow fadeInRight ">					
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-Col-III')) { ?>   			
							<?php dynamic_sidebar('Footer-Col-III'); ?>
					<?php } ?>
				</div>										
				<div class="insperia-footer-col-handler col-md-3 col-sm-6 ft-col wow fadeInRight ">						
					<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer-Col-IV')) { ?>  		
							<?php dynamic_sidebar('Footer-Col-IV'); ?>
					<?php } ?>				
				</div>										
			</div>
		</div>
		<div class="copyright-info">
			<div class="container">
				<div class="row">
					<div class="col-sm-5">
						<?php if (of_get_option('select_copyrights_columns',$prof_default) == 'On') { ?>
							<p><?php echo of_get_option('footer_text',$prof_default); ?></p>
						<?php } ?>						
					</div>
					<div class="col-sm-7">
						<?php
							if (of_get_option('select_menu_footer',$prof_default) == 'On') {
									wp_nav_menu( array( 'theme_location' => 'extra-menu' ) );
							} else {
								 if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_credits_sidebar')) {
								 dynamic_sidebar('footer_credits_sidebar');
								}
							}
						?>				
					</div>
				</div>
			</div>
		</div>
	</footer>


</section>

<!-- Footer End
================================================== -->		

</div>

<?php wp_footer(); ?>
</body>
</html>

