<?php  
/* Template Name: Template - Coming Soon*/  
?>


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>



<!-- Page Title Section
================================================== -->
<section class="splash-banner page-header-wrap parallax">
	<section class="section pattern-wrap color1">
		<div class="container">
			<h2 class="page-header h1 wow fadeInDown"><?php echo get_the_title(); ?></h2>
			<?php
				if(get_post_meta(get_the_ID(), 'Title Description', true) != ''){ ?>
					<p class="page-sub-title wow fadeInUp"><?php echo esc_attr(get_post_meta(get_the_ID(), 'Title Description', true)); ?></p>
			<?php } ?>
		</div>
		<section class="section event-counter wow fadeInUp">
			<div class="container">
				<div class="row text-center">
					<div class="clock" id="future" data-day="<?php echo of_get_option('comingsoon_day',$prof_default); ?>" data-month="<?php echo of_get_option('comingsoon_month',$prof_default); ?>" data-year="<?php echo of_get_option('comingsoon_year',$prof_default); ?>" ></div>
				</div>
			</div>
		</section>
	</section>
</section>


<!-- Page Begin
================================================== -->
<section class="section">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>	
		<div class="container">
			<?php the_content(); ?>			
		</div>
	<?php endwhile; endif; ?>	
</section>
<!-- Page Body End
================================================== -->	



<!-- Get Page Body
================================================== -->		
<?php get_footer(); ?>  


