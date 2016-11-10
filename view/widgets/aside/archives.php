<?php 
	global $option; 
	$aside = $option['aside-group'];
?>
<div class="row archivo">
	<h3><?php echo $aside[0]['file'] ?></h3>
	<ul class="tag-list wow-delay">
		<?php 
			$args = array(
				'type'            => 'monthly',
				'limit'           => '',
				'format'          => 'html', 
				'before'          => '<i class="fa fa-caret-right"></i> ',
				'after'           => '',
				'show_post_count' => true,
				'echo'            => 1,
				'order'           => 'DESC',
			        'post_type'     => 'post'
			);
			wp_get_archives( $args );
		?>
	</ul>
</div>
<script>
	jQuery(function(){
		jQuery('.archivo').find('li').addClass('wow fadeInRight');
	})
</script>