<?php  
/* Template Name: Template - Portfolio 3 Columns*/  
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



<!-- Portfolio Filter Section - Started
================================================== -->
<div class="filter-options">
	<div class="container">
		<div class="cat-wrap">
		<button type="button" class="cat-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		<ul class="options-list">
			<?php
				$terms = get_terms("portfoliocategories");
				$count = count($terms); 
				$AllString = __("All" , "insperia");
				$cat_string = '<li class="active"> <a href="javascript:void(0)" class="all" title="All"> ' . $AllString . ' </a> </li>';
				if ( $count > 0 ){  
				  
					foreach ( $terms as $term ) {  
						if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
							$termname = strtolower($term->name);  
							$termname = str_replace(' ', '-', $termname);  
							$cat_string .= '<li> <a href="javascript:void(0)" class="'.$termname.'" title="'.$term->name.'"> '.$term->name.' </a> </li>';  
						}
					}  
				}
				echo $cat_string;
			?>
		</ul>
		</div>
		<h4 class="cat-title strong"><?php _e("Currently Viewing:" , "insperia"); ?> <span class="colored"><?php _e("All" , "insperia"); ?></span></h4>
	</div>
</div>

<!-- Portfolio Filter Section - End
================================================== -->

<?php
	$portID = 0;
?>


<!-- Portfolio Main Section - Started
================================================== -->
<section class="section projects">
	<div class="container">
	
		<!-- Loop Started
		================================================== -->		
		<ul class="portfolio three-col style1">
			<?php 
					$wp_query= null;
					$wp_query = new WP_Query();					
					$wp_query->query('post_type=portfolio&posts_per_page=12'.'&paged='.$paged);
					
					$cat_count = 1;
					
					while ($wp_query->have_posts()) : $wp_query->the_post();
			?>					
					<?php
					$terms = get_the_terms( get_the_ID() , 'portfoliocategories' );  
					$separator = ' ';
					$output = '';
					$count=1;
					if ( $terms && ! is_wp_error( $terms ) ) {   
						foreach ( $terms as $term )   
						{  
							if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
								$termname = strtolower($term->name);  
								$termname = str_replace(' ', '-', $termname); 			
								$output .= $termname . ' ';
							}
							
							$count = $count + 1;
						} 
						
					} else {   
					   $output = '';
					}
					?>					
					
					<?php $portID = $portID + 1; ?>
					
					
					<li class="portfolio-item" data-id="id-<?php echo esc_attr($portID); ?>" data-type="<?php echo esc_attr($output); ?>">
						<?php the_post_thumbnail( get_the_ID() ,  'full' ); ?>
					  <a href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) )); ?>" class="zoom"  data-lightbox-gallery="gallery1" title="<?php the_title(); ?>"><i class="fa fa-plus"></i></a>
					  <a href="<?php echo esc_url(get_permalink()); ?>" class="link" title="<?php the_title(); ?>">
						<i class="fa fa-link"></i>
					  </a>
					  <a class="like" href="javascript:void(0);" title="<?php the_title(); ?>"><i class="fa fa-heart"></i> <span><?php echo getPostViews(get_the_ID()); ?></span></a>
					  <h3><?php the_title(); ?><small><?php echo strip_shortcodes(wp_trim_words( get_the_excerpt(), 10 )); ?></small></h3>
					</li>
			<?php endwhile; ?>		
		</ul>
		<!-- Loop End
		================================================== -->			
		
		
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
		
	</div>
</section>

<!-- Portfolio Main Section - End
================================================== -->	



<!-- Get Page Body
================================================== -->		
<?php get_footer(); ?>  