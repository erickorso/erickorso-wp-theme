<?php
	/*
	Template Name: Front Page
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/inicio/template' );

		?>
		</div>
	<?php

	get_footer();

?>
