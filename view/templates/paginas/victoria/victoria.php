<?php 
	$post;
?>
<section class="author">
	<div class="container">
		<h1><?php echo $post->post_title; ?></h1>
		<div class="content"><?php the_content(); ?></div>
	</div>
</section>
