<?php
	/*
	Template Name: About Book / Product
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/libro-de-vida/subpaginas/about/template' );

		?>
		</div>
	<?php

	get_footer();

?>