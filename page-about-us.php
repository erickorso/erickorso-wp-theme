<?php
	/*
	Template Name: About Us / Victoria Benarroch
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/victoria/template' );

		?>
		</div>
	<?php

	get_footer();

?>