<?php
	/*
	Template Name:Publicaciones
	*/
	get_header(); 

	?>
		<div class="content-wrapper">
		<?php

		get_template_part( 'view/templates/paginas/publicaciones/slider-top' );
		get_template_part( 'view/templates/paginas/publicaciones/posts' );

		?>
		</div>
	<?php

	get_footer();

?>