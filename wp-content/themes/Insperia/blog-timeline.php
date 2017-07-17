<?php
/*
Template Name: Template - Blog Time-line
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
<section class="section time-line blog-timeline">
	<div class="timeline animated">
		<?php
			
			$loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 8));
			
			$counter = 1;
			$galleryids = '';
			$getText = '';		
			$count = 0;			
			$return_string = '';
			$postcomments = __('Post Comments','sentient');
			$views = __('Number of Views','sentient');
			$instring = __('in' , 'sentient');
			
			if ( $loop ) :   
			while ($loop->have_posts()) : $loop->the_post();
				$return_string = '';
				if($counter % 2 == 0){
					$positionClass = 'wow fadeInRight';
				} else {
					$positionClass = 'wow fadeInLeft';
				}
				
					$return_string .='<div class="timeline-row  wow fadeInUp">
							<div class="timeline-time"> <small><i class="fa fa-calendar"></i> '. get_the_date() .'</small><i class="fa fa-user"></i> '. get_the_author() .' </div>';
							
							if ( get_post_format() == false && has_post_thumbnail()) {
								$return_string .='<div class="timeline-icon">
													<div class="bg-info"> <i class="fa fa-image"></i> </div>
												</div>
												<div class="panel timeline-content ' . esc_attr($positionClass) . '">
													<div class="panel-body">
														<article class="post">
														<header class="post-header">
															<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
																' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
															</a>
														</header>
														<section class="post-content">
															<h2 class="post-heading">'. get_the_title() .'</h2>
															<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . ' <span class="text-muted">[...]</span></p>
														</section>
														<footer class="post-footer">
															<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
															<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																<i class="fa fa-comments"></i>
																<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
															</a>
															<a href="javascript:void(0);" class="like" title="' . $views . '">
																<i class="fa fa-heart"></i>
																<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
															</a>
														</footer>
														</article>
													</div>
												</div>';
										
							} elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true) != ''){
								$return_string .='<div class="timeline-icon">
													<div class="bg-danger"> <i class="fa fa-camera-retro"></i> </div>
												</div>';
												
								$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
								$idscount = count($galleryids);
								
								
								
								$getText .= '<div class="panel timeline-content ' . esc_attr($positionClass) . '">
												<div class="panel-body">
													<article class="post">
													<header class="post-header">
														<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
															<div id="postCarousel" class="carousel slide" data-ride="carousel">
																<ol class="carousel-indicators">';
								
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

								$getText .='		</div>
												</div>
											</a>
										</header>
										<section class="post-content">
										<h2 class="post-heading">Mauris at dolor ac leo adipiscing varius bibendum non nulla.</h2>
										<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . ' <span class="text-muted">[...]</span></p>
										</section>
										<footer class="post-footer">
											<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
											<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
												<i class="fa fa-comments"></i>
												<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
											</a>
											<a href="javascript:void(0);" class="like" title="' . $views . '">
												<i class="fa fa-heart"></i>
												<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
											</a>
										</footer>											
										</article>
									</div>
								</div>';
					
								$return_string .= $getText;												

							} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){
								$return_string .='<div class="timeline-icon">
														<div class="bg-success"> <i class="fa fa-video-camera"></i> </div>
													</div>
													<div class="panel timeline-content  ' . esc_attr($positionClass) . '">
														<div class="panel-body">
															<article class="post video">
																<header class="post-header">
																	<div class="video-container">
																		<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'"></iframe>
																	</div>
																</header>
																<section class="post-content">
																<h2 class="post-heading">'. get_the_title() .'</h2>
																<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . ' <span class="text-muted">[...]</span></p>
																</section>
																<footer class="post-footer">
																	<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
																	<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																		<i class="fa fa-comments"></i>
																		<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																	</a>
																	<a href="javascript:void(0);" class="like" title="' . $views . '">
																		<i class="fa fa-heart"></i>
																		<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																	</a>
																</footer>
															</article>
														</div>
													</div>';
													 
							} elseif (has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != '') {
								$return_string .='<div class="timeline-icon">
														<div class="bg-info"> <i class="fa fa-music"></i> </div>
													</div>
													<div class="panel timeline-content  ' . esc_attr($positionClass) . '">
														<div class="panel-body">
															<article class="post audio">
																<header class="post-header">
																	<div class="post-audio">
																		' . do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true)) .'
																	</div>
																</header>
																<section class="post-content">
																	<h2 class="post-heading">'. get_the_title() .'</h2>
																	<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '<span class="text-muted">[...]</span></p>
																</section>
																<footer class="post-footer">
																	<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
																	<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																		<i class="fa fa-comments"></i>
																		<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																	</a>
																	<a href="javascript:void(0);" class="like" title="' . esc_attr($views) . '">
																		<i class="fa fa-heart"></i>
																		<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																	</a>
																</footer>																
															</article>
														</div>
													</div>
													';						
							} elseif (has_post_format( 'quote' )) {
								 $return_string .='<div class="timeline-icon">
														<div class="bg-warning"> <i class="fa fa-quote-right"></i> </div>
													</div>
													<div class="panel timeline-content  wow fadeInRight">
														<div class="panel-body">
															<article class="post quote">
															<header class="post-header"> <a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-quote">
																<blockquote>
																	<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
																	<small>' . get_post_meta(get_the_ID(), 'Quote Person Name', true) . ' ' . $instring . ' <cite title="' . get_post_meta(get_the_ID(), 'Quote Person Company', true) . '">' . get_post_meta(get_the_ID(), 'Quote Person Company', true) . '</cite></small>
																</blockquote>
															</a> </header>
															<footer class="post-footer">
																<span class="post-date">
																	<i class="fa fa-calendar"></i>
																	<a href="#" title="'. get_the_date() .'"> '. get_the_date() .' </a>
																</span>
																<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																	<i class="fa fa-comments"></i>
																	<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																</a>
																<a href="javascript:void(0);" class="like" title="' . esc_attr($views) . '">
																	<i class="fa fa-heart"></i>
																	<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																</a>
															</footer>
															</article>
														</div>
													</div>';
													
							} elseif (has_post_format( 'chat' )) {
								 $return_string .='<div class="timeline-icon">
														<div class="bg-warning"> <i class="fa fa-quote-right"></i> </div>
													</div>
													<div class="panel timeline-content  wow fadeInRight">
														<div class="panel-body">
															<article class="post quote">
															<header class="post-header"> <a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-quote">
																<blockquote>
																	<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
																</blockquote>
															</a> </header>
															<footer class="post-footer">
																<span class="post-date">
																	<i class="fa fa-calendar"></i>
																	<a href="#" title="'. get_the_date() .'"> '. get_the_date() .' </a>
																</span>
																<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																	<i class="fa fa-comments"></i>
																	<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																</a>
																<a href="javascript:void(0);" class="like" title="' . esc_attr($views) . '">
																	<i class="fa fa-heart"></i>
																	<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																</a>
															</footer>
															</article>
														</div>
													</div>';
													 
							} elseif (has_post_format( 'link' ) && get_post_meta(get_the_ID(), 'Link Post URL', true) != '') {
								 $return_string .='<div class="timeline-icon">
														<div class="bg-warning"> <i class="fa fa-link"></i> </div>
													</div>
													<div class="panel timeline-content ' . esc_attr($positionClass) . '">
														<div class="panel-body">
															<article class="post link">
															<header class="post-header">
																<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-link">
																	<blockquote>
																		<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . '</p>
																		<small>' . get_post_meta(get_the_ID(), 'Link Post URL', true) . '</small>
																	</blockquote>
																</a>
															</header>
															<footer class="post-footer">
																<span class="post-date">
																	<i class="fa fa-calendar"></i>
																	<a href="#" title="'. get_the_date() .'"> '. get_the_date() .' </a>
																</span>
																<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																	<i class="fa fa-comments"></i>
																	<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																</a>
																<a href="javascript:void(0);" class="like" title="' . $views . '">
																	<i class="fa fa-heart"></i>
																	<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																</a>
															</footer>
															</article>
														</div>
													</div>';
													
							}  elseif(has_post_thumbnail())  {
								$return_string .='<div class="timeline-icon">
													<div class="bg-info"> <i class="fa fa-camera"></i> </div>
												</div>
												<div class="panel timeline-content ' . esc_attr($positionClass) . '">
													<div class="panel-body">
														<article class="post">
														<header class="post-header">
															<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="post-img">
																' . get_the_post_thumbnail( get_the_ID() , 'full' ) . '
															</a>
														</header>
														<section class="post-content">
															<h2 class="post-heading">'. get_the_title() .'</h2>
															<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . ' <span class="text-muted">[...]</span></p>
														</section>
														<footer class="post-footer">
															<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
															<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																<i class="fa fa-comments"></i>
																<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
															</a>
															<a href="javascript:void(0);" class="like" title="' . esc_attr($views) . '">
																<i class="fa fa-heart"></i>
																<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
															</a>
														</footer>
														</article>
													</div>
												</div>';    
							}  elseif(!has_post_thumbnail())  {
								$return_string .='<div class="timeline-icon">
													<div class="bg-primary"> <i class="fa fa-pencil"></i> </div>
												</div>
												<div class="panel timeline-content  ' . esc_attr($positionClass) . '">
													<div class="panel-body">
														<article class="post">
															<section class="post-content">
																<h2 class="post-heading">'. get_the_title() .'</h2>
																<p>' . strip_shortcodes(wp_trim_words( get_the_content(), 50 )) . ' <span class="text-muted">[...]</span></p>
															</section>
															<footer class="post-footer">
																<a href="'. esc_url(get_permalink()) .'" title="'. get_the_title() .'" class="btn btn-default btn-sm"> ' . __("Read More" , "insperia") . ' </a>
																<a href="' . esc_url(get_comments_link(get_the_ID())) . '" title="' . esc_attr($postcomments) . '" class="comments">
																	<i class="fa fa-comments"></i>
																	<span class="total-likes">' . get_comments_number( '0', '1', '%' ) . '</span>
																</a>
																<a href="javascript:void(0);" class="like" title="' . esc_attr($views) . '">
																	<i class="fa fa-heart"></i>
																	<span class="total-likes">' . getPostViews(get_the_ID()) . '</span>
																</a>
															</footer>
														</article>
													</div>
												</div>';    
							}			

				$return_string .= '</div>';				
				
				$counter = $counter + 1;	
				echo $return_string;
			endwhile;
		endif;
		wp_reset_query();		
		?>	
	</div>
</section>
<?php
	if ($post->post_content == ""){
	
	} else {
?>
	<div>
		<?php the_content(); ?>
	</div>
<?php } ?>	

<!-- Page Body End
================================================== -->



<!-- Get Page Footer
================================================== -->
<?php get_footer(); ?>