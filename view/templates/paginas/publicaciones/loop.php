<section class="loop">
	<?php
	$args = array( 
		'posts_per_page' => -1, 
		'post_type'=>'post', 
		'hide_empty' => false,
	);
	$loop = new WP_Query( $args );
	if ($loop->have_posts()) {
		for ($i=0; $i < count($loop->posts); $i++) {
			global $post; 
			$post = $loop->posts[$i];
	  		get_template_part( 'view/pages/news/loop-masonry' );
		}
	}

	$next_page = str_replace( array( '<a href="', '" ></a>', '?ajax=1' ), '', get_next_posts_link( '' ) );
	$next_page = empty( $next_page ) ? false : $next_page;
	?>
	<script>
	  next_page = '<?php echo $next_page ?>';
	</script>
</section>