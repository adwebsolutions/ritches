<?php
/**
 * Template Name: Template - Full Width
 */
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Get Page Title Section
================================================== -->
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


<!-- Page Begin
================================================== -->
<div class="main-container">
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
