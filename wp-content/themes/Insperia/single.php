
<!-- Single Page Started
================================================== -->	


<!-- Get Page Header
================================================== -->	
<?php get_header(); ?>


<!-- Single Portfolio Template Started
================================================== -->	

<?php global $prof_default; ?>


<?php if ('portfolio' == get_post_type()){ ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	
	<?php setPostViews(get_the_ID()); ?>
	
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
					<li class="active"><?php echo get_the_title(); ?></li>
				</ol>
			</div>
		</div>
	</section>	
		
	
	<!-- Portfolio Page Filter Started
	================================================== -->		
	<div class="filter-options">
		<div class="container">
			<?php if(of_get_option('portfolio_url',$prof_default) != ''){ ?>
				<a href="<?php echo esc_url(of_get_option('portfolio_url',$prof_default)); ?>" class="grid-btn tip" data-toggle="tooltip" data-placement="left" title="See complete portfolio">
					<i class="fa fa-th-large"></i>
				</a>
			<?php
			}
			?>
			<h4 class="cat-title strong wow fadeInRight"><?php _e("Currently Viewing: " , "insperia"); ?><span class="colored"><?php the_title(); ?></span></h4>		
		</div>
	</div>
	<!-- Portfolio Page Filter End
	================================================== -->		
	
	
	<!-- Portfolio Section Started
	================================================== -->		
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<?php the_post_thumbnail( 'full' ); ?>					
					<hr class="blank">
					<?php the_content(); ?>
				</div>
				<div class="col-sm-4">
					<aside class="project">
						<div class="aside-wrap">
							<div class="widget  wow fadeInUp">							
								<h5 class="strong"><?php _e("Client" , "insperia"); ?></h5>
								<p><?php echo esc_attr(get_post_meta(get_the_ID(), 'Project Client', true)); ?></p>
								<h5 class="strong"><?php _e("Project Summary" , "insperia"); ?></h5>
								<p><?php echo strip_shortcodes(wp_trim_words( get_the_excerpt(), 15 )); ?></p>
								<h5 class="strong"><?php _e("Date" , "insperia"); ?></h5>
								<p><?php echo ' ' . get_the_time('j') . ' ' . get_the_time('M') . ', ' . get_the_time('Y'); ?></p>
								<h5 class="strong"><?php echo esc_attr(get_post_meta(get_the_ID(), 'Portfolio Extra Paragraph Title', true)); ?></h5>
								<p><?php echo esc_attr(get_post_meta(get_the_ID(), 'Portfolio Extra Paragraph Text', true)); ?></p>
								<a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Project Client URL', true)); ?>" class="btn btn-primary btn-lg btn-block"><?php _e("Launch Website" , "insperia"); ?></a>
							</div>
							
						</div>
					</aside>
				</div>
			</div>
		</div>
	</section>
	<!-- Portfolio Section End
	================================================== -->		
	
	<?php endwhile; ?>
	<?php endif; ?>			
<!-- Single Portfolio Template End
================================================== -->	



<!-- Single Post Template Started
================================================== -->	
<?php } else { ?>

	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<!-- Page Title Section Started
	================================================== -->		
	<section class="splash-banner page-header-wrap parallax">
		<div class="section pattern-wrap color1">
			<div class="container">
				<h1 class="page-header h1 wow fadeInUp"><?php echo get_the_title(); ?></h1>
				<p class="page-sub-title post-meta wow fadeInUp">
					<span class="author">
						<i class="fa fa-user"></i>
						<a href="#"><?php echo get_the_author(); ?></a>
					</span>
					<span class="comments">
						<i class="fa fa-comments"></i>
						<a href="#"><?php echo get_comments_number( '0', '1', '%' ); ?></a>
					</span>
					<span class="likes">
						<a class="like">
							<i class="fa fa-heart"></i>
						</a>
						<a href="#"><?php echo getPostViews(get_the_ID()); ?></a>
					</span>
					<?php
						$sentientTag = '';				
					?>
					<?php if(has_tag()){ 
							$sentientTagsWord = __("Tags: " , "insperia");
							$sentientTag = '';
							$brantags = get_the_tags();
							if ($brantags) {
							  foreach($brantags as $tag) {	  
								$sentientTag .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a> / ';
							  }
							}
						}
					?>				
					<?php if($sentientTag != ''){ ?>
						<span class="tags">
							<i class="fa fa-tags"></i>
							<?php echo trim($sentientTag, ' / '); ?>
						</span>										
					<?php } ?>				
				</p>
				<ol class="breadcrumb">
					<li> <a href="<?php echo esc_url(home_url()); ?>"> <i class="fa fa-home"></i> </a> </li>
					<li class="active"><?php echo get_the_title(); ?></li>
				</ol>
			</div>
		</div>
	</section>
	<!-- Page Title Section End
	================================================== -->		
	
	
	<!-- Page Content Section Started
	================================================== -->		
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-sm-8">
				
					<!-- Blog Article Started
					================================================== -->					
					<article class="post single-post">
						<div class="insperia-post-image-container">
							<?php
								if ( get_post_format() == false && has_post_thumbnail()) {
									echo get_the_post_thumbnail( get_the_ID() , 'full' );
								} elseif ( has_post_format('gallery') && get_post_meta(get_the_ID(), 'Gallery images ID', true) != ''){
									$galleryids = explode(",", get_post_meta(get_the_ID(), 'Gallery images ID', true));
									$idscount = count($galleryids);
									$getText .= '<div id="postCarousel" class="carousel slide" data-ride="carousel">
														<ol class="carousel-indicators visible-lg">';
									
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
													</div>';
						
									echo $getText;
								  
								} elseif ( has_post_format( 'video' ) && get_post_meta(get_the_ID(), 'Post Video URL', true) != ''){							
									echo '<iframe src="'. esc_url(get_post_meta(get_the_ID(), 'Post Video URL', true)) .'" style="border:0px;" width="100%" height="260px">
									</iframe>';
								} elseif (has_post_format( 'audio' ) && get_post_meta(get_the_ID(), 'Post Audio Shortcode', true) != '') {
									 echo do_shortcode(get_post_meta(get_the_ID(), 'Post Audio Shortcode', true));							
								} elseif (has_post_format( 'link' ) && get_post_meta(get_the_ID(), 'Link Post URL', true) != '') {
									echo '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Link Post URL', true)) . '">' . esc_url(get_post_meta(get_the_ID(), 'Link Post URL', true)) . '</a>';					
								}				
							
							?>					
						</div>
						
						<?php the_content(); ?>
					
					</article>
					<!-- Blog Article End
					================================================== -->						
					
					
					<!-- Blog Author Section Started
					================================================== -->					
					<?php if(of_get_option('blog_author_option',$prof_default) == 'On'){ ?>
						<div class="post-author-bio wow fadeInUp">
							<h4 class="page-header"><?php _e("About Author" , "insperia"); ?></h4>
							<div class="media">
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="pull-left">
									<?php $getIDs = get_the_author_meta( 'ID' ); ?>
									<?php echo get_avatar( $getIDs , 80 ); ?>																		
								</a>
								<div class="media-body">
									<h5 class="about-media-heading media-heading stronger"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php the_author(); ?></a></h5>
									<?php esc_attr(the_author_meta('description')); ?><br>
								</div>
								<div class="view-contributions strong small">
									<?php _e("View all contributions by:" , "insperia"); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php the_author(); ?></a>
								</div>
							</div>
						</div>											
					<?php } ?>					
					<!-- Blog Author Section End
					================================================== -->	
					
					
					<!-- Comments Section Started
					================================================== -->					
					<?php if(comments_open($post->ID )){?> 
						<div class="comment-area">
							<h4 class="page-header"><?php _e("Comments" , "insperia"); ?></h4>
							<?php comments_template('', true); ?>
						</div>															
					<?php } ?>
					<!-- Comments Section End
					================================================== -->	
					<div class="pagination">
						<div class="pages">
							<?php wp_link_pages(array('before' => '<p>' . __('Pages: ','my-text-domain'),'after'=> '</p>')); ?>
						</div>							
					</div>
					
				</div>
				
				<!-- Get Page Sidebar Started
				================================================== -->					
				<div class="col-lg-3 col-sm-4">
					<aside class="project wow fadeInRight">	
						<?php get_sidebar(); ?>					
					</aside>
				</div>
				<!-- Get Page Sidebar End
				================================================== -->	
				
			</div>
		</div>
	</section>
	<!-- Page Content Section End
	================================================== -->	
	
	<?php endwhile; ?>
	<?php endif; ?>		

<?php } ?>
<!-- Single Post Template End
================================================== -->	



<!-- Get Page Footer
================================================== -->	
<?php get_footer(); ?>
