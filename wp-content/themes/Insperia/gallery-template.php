<?php  
/* Template Name: Template - Gallery*/  
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



<!-- Page Begin
================================================== -->
<div class="filter-options">
	<div class="container">
		<div class="cat-wrap">
		<button type="button" class="cat-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		<ul class="options-list">
			<?php
				$terms = get_terms("gallerycategories");
				$count = count($terms); 
				$AllString = __("All" , "insperia");
				$cat_string = '<li class="active"> <a href="javascript:void(0)" class="all" title="All"> ' . esc_attr($AllString) . ' </a> </li>';
				if ( $count > 0 ){  
				  
					foreach ( $terms as $term ) {  
						if($term->name != 'Uncategorized' && $term->name != 'uncategorized'){
							$termname = strtolower($term->name);  
							$termname = str_replace(' ', '-', $termname);  
							$cat_string .= '<li> <a href="javascript:void(0)" class="'. esc_attr($termname) .'" title="' . esc_attr($term->name) . '"> '. esc_attr($term->name) .' </a> </li>';  
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

<?php
	$portID = 0;
?>

<section class="section projects">
	<div class="container">
		<ul class="portfolio three-col gallery">
		
			<!-- Loop Started
			================================================== -->	
			<?php 
					$wp_query= null;
					$wp_query = new WP_Query();					
					$wp_query->query('post_type=gallery&posts_per_page=-1');
					
					$cat_count = 1;
					
					while ($wp_query->have_posts()) : $wp_query->the_post();
			?>					
					<?php
					$terms = get_the_terms( get_the_ID() , 'gallerycategories' );  
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
						<?php echo get_the_post_thumbnail( get_the_ID() ,  'insperia-portfolio-thumb' ); ?>
						<a href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID) )); ?>" class="zoom"  data-lightbox-gallery="gallery1"><i class="fa fa-search"></i></a>
					</li>
			<?php endwhile; ?>
			
			<!-- Loop End
			================================================== -->				
		<ul>
	</div>
</section>

<!-- Page Body End
================================================== -->	



<!-- Get Page Body
================================================== -->		
<?php get_footer(); ?>  