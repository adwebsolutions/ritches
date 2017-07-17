<?php
/*
Template Name: Template - Homepage
*/
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>



<!-- Page Begin
================================================== -->
<div id="contentWrap" class="main-container">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>				
	<div class="main-page-column-data main-page-column-data-full">
		<div class="get-column-container">			
			<div class="page-content">
				<?php the_content(); ?>			
			</div>				
		</div>
	</div>
	<?php endwhile; endif; ?>			
</div>


<!-- Get Page Header
================================================== -->
<?php get_footer(); ?>
