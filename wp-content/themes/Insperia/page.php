<?php
/**
 * Default Page
 */
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Page Title Section
================================================== -->

<?php 

	if ( (class_exists( 'WooCommerce' ) && is_cart()) || (class_exists( 'WooCommerce' ) && is_checkout()) || (class_exists( 'WooCommerce' ) && is_account_page())) {
		?>
			<?php
				if (is_cart()){
					$WooTitle = __("Your Cart" , "insperia");
				} elseif(is_checkout()) {
					$WooTitle = __("Checkout" , "insperia");
				} elseif(is_account_page()) {
					$WooTitle = __("My Account" , "insperia");
				}
			?>
			<?php
				if(is_cart() || is_checkout()){
			?>
			<section class="splash-banner page-header-wrap parallax">
				<div class="section pattern-wrap color1">
					<div class="container">
						<h1 class="page-header h1 wow fadeInUp"><i class="fa fa-shopping-cart"></i></h1>
						<p class="page-sub-title wow fadeInUp"><?php echo esc_attr($WooTitle); ?></p>
						<ol class="breadcrumb">
							<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
							<li class="active"><?php echo get_the_title(); ?></li>
						</ol>
					</div>
				</div>
			</section>
			<?php } elseif(is_account_page()) { ?>
			<section class="splash-banner page-header-wrap parallax">
				<div class="section pattern-wrap color1">
					<div class="container">
						<h1 class="page-header h1 wow fadeInUp"><i class="fa fa-user"></i></h1>
						<p class="page-sub-title wow fadeInUp"><?php echo esc_attr($WooTitle); ?></p>
						<ol class="breadcrumb">
							<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
							<li class="active"><?php echo get_the_title(); ?></li>
						</ol>
					</div>
				</div>
			</section>			
			<?php } ?>
		<?php
	} else {
		?>
			<section class="splash-banner page-header-wrap parallax">
				<div class="section pattern-wrap color1">
					<div class="container">
						<h1 class="page-header h1 wow fadeInUp"><?php echo get_the_title(); ?></h1>
						<?php
							if(get_post_meta(get_the_ID(), 'Title Description', true) != ''){ ?>
								<p class="page-sub-title wow fadeInUp"><?php echo esc_attr(get_post_meta(get_the_ID(), 'Title Description', true)); ?></p>
						<?php } ?>
						<ol class="breadcrumb">
							<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
							<?php
								 if($post->post_parent > 0) {
									echo '<li class="active"><a href="' . esc_url(get_permalink($post->post_parent)) .'">'.get_the_title($post->post_parent).'</a></li>';
								 }
							?>							
							<li class="active"><?php echo get_the_title(); ?></li>
						</ol>
					</div>
				</div>
			</section>				
		<?php
	
	}
?>


<!-- WooCommerce Cart Page - Start
================================================== -->
<?php 
	if ( (class_exists( 'WooCommerce' ) && is_cart()) || (class_exists( 'WooCommerce' ) && is_checkout()) || (class_exists( 'WooCommerce' ) && is_account_page())) {
?>
	<div class="section shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php 
						if(have_posts()) : while(have_posts()) : the_post();
							the_content();
						endwhile; endif;
					?>
				</div>
			</div>
		</div>
	</div>
<?php
	} else {
?>
<!-- WooCommerce Cart Page - End
================================================== -->


<!-- Page Default Body Started
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	 <div class="middle-container">
		<div class="container">
			<div class="row">				
				<div class="col-md-9">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						
						<!-- Post Title
						================================================== -->													
						<h1><?php the_title(); ?></h1>						
						
						<!-- Content
						================================================== -->							
						<?php the_content(); ?>

						<!-- Blog Comments Section
						================================================== -->					
						<?php if(comments_open($post->ID )){?> 
						<div class="comments-area">
							<?php comments_template('', true); ?>
						</div>											
						<?php } ?>
							
					<?php endwhile; endif; ?>
				</div>				
				<div class="col-md-3">
					<aside class="project wow fadeInRight">
						<div class="aside-wrap">
							<?php get_sidebar(); ?>
						</div>
					</aside>
				</div>			
			</div>
		</div>
	 </div>
</div>
<!-- Page Default Body End
================================================== -->
<?php } ?>


<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>