<?php
/**
 * 404 ( Not fount page )
 */
?>
<!-- Get Variables and create header
================================================== -->
<?php	global $prof_default;	
	get_header();
?><!-- 404 Page Started================================================== --><section class="section">	<div class="container">		<div class="error-404">			<?php				$getNumber = __("4 " , "insperia")			?>			<h1 class="strong"><?php echo esc_attr($getNumber); ?><i class="fa fa-frown-o"></i><?php echo esc_attr($getNumber); ?><br><small><?php echo esc_attr(of_get_option('blank_page_title',$prof_default)); ?></small></h1>			<h3><?php echo esc_attr(of_get_option('blank_page_desc',$prof_default)); ?></h3>		</div>	</div></section><!-- Footer Section================================================== -->
<?php get_footer(); ?>