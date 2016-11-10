<?php
	/*
	Template Name: Product / Libro de Vida
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/libro-de-vida/template' );

		?>
		</div>
	<?php

	get_footer();

?>