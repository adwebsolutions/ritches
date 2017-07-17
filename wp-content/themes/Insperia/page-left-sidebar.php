<?php
/*
Template Name: Template - Page + Left Sidebar
*/
?>


<!-- Get Page Header
================================================== -->
<?php get_header(); ?>


<!-- Page Title Section
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


<!-- Page Left Sidebar Started
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	 <div class="middle-container">
		<div class="container">
			<div class="row">	
				<div class="col-md-3">
					<aside class="insperia-left-sidebar project wow fadeInRight">
						<div class="aside-wrap">
							<?php get_sidebar(); ?>
						</div>
					</aside>
				</div>			
				<div class="col-md-9">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						
						<!-- Post Title
						================================================== -->													
						<h1><?php the_title(); ?></h1>						
						
						<!-- Content
						================================================== -->							
						<?php the_content(); ?>

						<!-- Comments Section
						================================================== -->					
						<?php if(comments_open($post->ID )){?> 
						<div class="comments-area">
							<?php comments_template('', true); ?>
						</div>											
						<?php } ?>
							
					<?php endwhile; endif; ?>
				</div>							
			</div>
		</div>
	 </div>
</div>
<!-- Page Left Sidebar End
================================================== -->



<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>

