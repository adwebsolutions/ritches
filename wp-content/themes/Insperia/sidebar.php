<?php

	/* Check if Search Page */
	if(is_search()){
		$sidebar_choice = "Search Page Sidebar";
		
	  /* Check if Archive Page */		
	} elseif(is_archive()) {	
		$sidebar_choice = "Archive Page Sidebar";
		
	  /* Check if Any Page Else */	  
	} else {
		if(null !== get_post_custom(get_the_ID())){
			$options = get_post_custom(get_the_ID());
			
			if(isset($options['custom_sidebar']))  
			{  
				$sidebar_choice = $options['custom_sidebar'][0];  
			}  
			else  
			{  
				$sidebar_choice = "default";  
			} 		
		} else {
			$sidebar_choice = "default";
		}

	}

?>

<!-- Checking Sidebar Started
================================================== -->
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar_choice) ) :   
	dynamic_sidebar($sidebar_choice);  
	else :  
	/* No widget */  
	endif; ?>  
<!-- Checking Sidebar End
================================================== -->