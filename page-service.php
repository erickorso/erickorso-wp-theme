<?php
	/*
	Template Name: Service / Asesorias
	*/
	get_header(); 

	the_post();
	?>
		<div class="content-wrapper">
		<?php
		
		get_template_part( 'view/templates/paginas/asesoria/template' );

		?>
		</div>
	<?php

	get_footer();

?>