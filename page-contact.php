<?php
	/*
	Template Name: Contact
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/contacto/template' );

		?>
		</div>
	<?php

	get_footer();

?>