<?php
/*
	Archives Page
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
			<?php
				$archiveTitle = wp_title('|', false, 'right');
				$archiveTitleArray = explode(" ", $archiveTitle);
				
			?>
			<h1 class="page-header h1 wow fadeInUp"><?php echo $archiveTitleArray[0]; ?></h1>
			<ol class="breadcrumb">
				<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
				<li class="active"><?php echo $archiveTitleArray[0]; ?></li>
			</ol>
		</div>
	</div>
</section>	


<!-- Page Content Started
================================================== -->
<div class="page-main-container single-page page-right-sidebar">	 
	<div class="middle-container">
		<div class="container">
			<div class="row" id="content" role="main">
				<!-- Archive Content
				================================================== -->				
				<div class="col-md-9 insperia-search">
						<?php 
							if (have_posts() ) { ?>			 
							<?php while ( have_posts() ) : the_post();?>
								<div <?php post_class("search-item"); ?>>
									<div class="blog-entry">
										<div class="entry-header">
											<h4><a class="d-text-c-h" href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>
											<div class="separation-line d-border-c"></div>
										</div>
										<div class="entry-content">
											<?php echo strip_shortcodes(wp_trim_words( get_the_content(), 35 )); ?>
										</div>
										<div class="entry-footer">
											<p><?php _e("Posted by ","insperia"); ?><a class="d-text-c" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php esc_attr(the_author_meta( 'display_name' )); ?></a><?php _e(" on ","insperia"); ?><span><?php echo get_the_time('M'); ?> <?php echo get_the_time('j'); ?></span>
										</div>							
									</div>
								</div>					
							<?php endwhile; ?>
							
							<!-- Pagination Started
							================================================== -->
							<div class="pagination">
								<div class="pages">
									<?php
										global $wp_query;

										$big = 999999999;
										$modified = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
										$modified = str_replace( '#038;', '', $modified  );
										echo paginate_links( array(
											'base' => $modified,
											'format' => '?paged=%#%',
											'current' => max( 1, get_query_var('paged') ),
											'total' => $wp_query->max_num_pages,														
											'prev_text'    => __('<i class="fa fa-chevron-left"></i> Previous'),
											'next_text'    => __('Next <i class="fa fa-chevron-right"></i>')						
										) );
									?>
								</div>
							</div>							
							<!-- Pagination End
							================================================== -->								
							<?php } else { ?>
							<div id="post-0" class="post no-results not-found">
								<h2 class="entry-title"><?php _e( 'Nothing Found', 'sentient' ) ?></h2>
								<div class="entry-content">
									<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with something different.', 'sentient' ); ?></p>                    
								</div>
							</div>
							<?php } ?> 				
				</div>
				
				<!-- Sidebar
				================================================== -->				
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


<!-- Footer
================================================== -->	
<?php get_footer(); ?>