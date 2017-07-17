<?php
/*
Template Name: Template - Blog Masonry
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


<!-- Page Body Start
================================================== -->
<section class="section masonry-blog">
	<div class="container">
		<div class="row" id="masonryBlog">
			<?php
				$temp = $wp_query;
				$wp_query = null;
				$wp_query = new WP_Query();
				$wp_query->query('posts_per_page=8'.'&paged='.$paged);
				
				$readmoretxt = __('Read more' , 'sentient');
				$counter = 1;
				$galleryids = '';
				$getText = '';
				$views = __('Number of Views','sentient');
				$postcomments = __('Post Comments','sentient');
				$postdate = __('Post Date','sentient');
				$insting = __('in' , 'sentient');				
				
				while ($wp_query->have_posts()) : $wp_query->the_post();
			?>		
			<?php
				if(has_post_format('link')){
					$postclass = 'link';
				}elseif(has_post_format('quote')){
					$postclass = 'quote';
				}elseif(has_post_format('video')){
					$postclass = 'video';
				}elseif(has_post_format('audio')){
					$postclass = 'audio';
				}else{
					if(has_post_thumbnail()){
						$postclass = 'featured-with-image';
					} else {
						$postclass = 'featured-without-image';
					}		
				}
				$return_string = '';
			?>
				<div class="col-md-4 col-sm-6 col-xs-12 masonry-item wow fadeInUp">
					<article <?php echo post_class('post ' . esc_attr($postclass)) ?>>
					<?php	
						if ( get_post_format() == false && has_post_thumbnail()) {
							$return_string .='<header class="post-header">
										<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
											' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
											<i class="fa fa-image post-type"></i>
										</a>
									</header>';
									
						} elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true) != ''){
							$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
							$idscount = count($galleryids);
							$getText .= '<header class="post-header"> <a href="post.html" title="Some title here for SEO purpose" class="post-img">
											<div id="postCarousel" class="carousel slide" data-ride="carousel">
												<ol class="carousel-indicators visible-lg">';
							$count = 1;
							for ($x=0; $x < $idscount; $x++)
							{	
								if($count < 2) {$active = 'active';} else {$active = '';}
								$getText .= '<li data-target="#postCarousel" data-slide-to="' . esc_attr($x) . '" class="' . esc_attr($active) . '"></li>';
								$count = $count + 1;
							}
							$count = 1;
							$getText .= '</ol><div class="carousel-inner">';
							for ($x=0; $x < $idscount; $x++)
							{	
								if($count < 2) {$active = 'active';} else {$active = '';}
								$getimageurlarray = wp_get_attachment_image_src( $galleryids[$x] , 'full');
								
								$alt = get_post_meta($galleryids[$x], '_wp_attachment_image_alt', true);
								
								$getText .= '<div class="item ' . esc_attr($active) . '"> <img src="' . esc_url($getimageurlarray[0]) . '" alt="' . esc_attr($alt) . '"> </div>';
								$count = $count + 1;
							} 

							$getText .='</div>
											</div>
											<i class="fa fa-camera-retro post-type"></i> </a>
										</header>';
				
							$return_string .= $getText;
						  
						} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){
							 $return_string .='<header class="post-header">
												<div class="post-video">
													<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'" style="border:0px;" width="100%" height="260px">
													</iframe>
													<i class="fa fa-film post-type"></i>
												</div>
												</header>';
						} elseif (has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != '') {
							 $return_string .='<header class="post-header">
												<div class="post-audio">
													' . do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) .'
													<i class="fa fa-music post-type"></i>
												</div>
												</header>';								
						} elseif (has_post_format( 'quote' )) {
							 $return_string .='<header class="post-header">
												<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-quote">
												<blockquote>
												<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
												<small>' . esc_attr(get_post_meta(get_the_ID(), 'Quote Person Name', true)) . ' ' . esc_attr($insting) . ' <cite title="' . get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) . '">' . esc_attr(get_post_meta(get_the_ID(), 'Quote Person Company', true)) . '</cite></small> </blockquote>
												<i class="fa fa-quote-left post-type"></i> </a>
												</header>';
						} elseif (has_post_format( 'chat' )) {
							 $return_string .='<header class="post-header">
													<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="no-media">
													<i class="fa fa-comment post-type"></i>
													</a>
												</header>';	
						} elseif (has_post_format( 'link' ) && get_post_meta(get_the_ID(), 'Link Post URL', true) != '') {
							 $return_string .='<header class="post-header">
												<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-link">
													<blockquote>
														<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
														<small>' . esc_url(get_post_meta(get_the_ID(), 'Link Post URL', true)) . '</small>
													</blockquote>
													<i class="fa fa-link post-type"></i>
												</a>
												</header>';											
						}  elseif(has_post_thumbnail())  {
							$return_string .='<header class="post-header">
										<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
											' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
											<i class="fa fa-glass post-type"></i>
										</a>
									</header>';    
						}							

						if(has_post_format( 'quote' ) || has_post_format( 'link' )){
							$return_string .= '<footer class="post-footer">
													<span class="post-date">
														<i class="fa fa-calendar"></i>
														<a href="'. esc_url(get_permalink()) .'" title="' . $postdate . '"> ' . get_the_date() . ' </a>
													</span>
													<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
														<i class="fa fa-comments"></i>
														<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
													</a>
													<a href="javascript:void(0);" class="like" title="' . $views . '">
														<i class="fa fa-heart"></i>
														<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
													</a>
												</footer>';			
						} else {				
							$return_string .= '<section class="post-content">
													<h2 class="post-heading">'. get_the_title() .'</h2>
													<div class="post-meta">
														<span class="author">
															<i class="fa fa-user"></i>
															<a href="#" title="' . get_the_author() . '"> ' . get_the_author() . ' </a>
														</span>
														<span class="post-date">
															<i class="fa fa-calendar"></i>
															<a href="'. esc_url(get_permalink()) .'" title="' . $postdate . '"> ' . get_the_date() . ' </a>
														</span>
													</div>
													<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 25 )) . ' <span class="text-muted"></span></p>
												</section>
												<footer class="post-footer">
													<a href="'. esc_url(get_permalink()) .'" title="' . esc_attr($readmoretxt) . '" class="btn btn-default btn-sm"> ' . esc_attr($readmoretxt) . ' </a>
													<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
														<i class="fa fa-comments"></i>
														<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
													</a>
													<a href="javascript:void(0);" class="like" title="' . $views . '">
														<i class="fa fa-heart"></i>
														<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
													</a>
												</footer>';
						}
						
						echo $return_string;
					?>
					</article>
				</div>
			<?php endwhile; ?>			
		</div>
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
	</div>
</section>
<!-- Page Body End
================================================== -->



<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>