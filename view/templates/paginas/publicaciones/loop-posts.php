<?php

	global $post;
	$id = $post->ID;
	$title =  $post->post_title;
	$content =  $post->post_content;
	$excerpt = strip_tags($content);
	if (strlen($excerpt)>300) {
		$excerpt = substr($excerpt, 0, 300);
		$excerpt .= '...';
	}
	// $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt .='<br>
					<div class="button">
						<a class="btn btn-default" href="'.get_permalink($id).'">
							saber mas
						</a>
					</div>';
	$thumbID = get_post_thumbnail_id($id);
	$img_url = wp_get_attachment_url($thumbID);
	$post_cats = (array) get_the_terms( $id, 'category' );
	foreach ($post_cats as $cat) {
		$cats .= ' '.$cat->slug;
	}
	$post_tags = (array) get_the_terms( $id, 'post_tag' );
	foreach ($post_tags as $tag) {
		$tags .= ' '.$tag->slug;
	}
?>
<section class="col-md-4 col-sm-6 wow zoomIn">
	<?php 
		if ($img_url != false) {
			?>
				<div class="thumb">
					<a href="<?php echo get_permalink($id) ?>" class="loop-thumbnail-container">
						<img class="img-responsive" src="<?php echo $img_url; ?>" alt="<?php echo $title; ?>">
					</a>
				</div>
			<?php
		}
	?>
	<div class="head-item">
		<h3>
		<?php 
			$terms = get_terms( array(
					    'hide_empty' => true,
					) );
			$i = 0;
			$terms = get_categories();
			foreach ($terms as $term) {
				$name = $term->name;
				$term_id = $term->term_id;
				$link = get_category_link( $term_id );
				$name = $term->name;
				printf('<a href="%s">%s</a>', $link, $name);
				echo ' / ';
			}
			$format = 'Publicado hace %s';
			printf( $format, human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ));;
		?>
		</h3>
		<h2>
			<a href="<?php echo get_permalink($id) ?>">
				<?php echo $title; ?>
			</a>
		</h2>
	</div>
	<div class="content-item">
		<?php echo $excerpt; ?>
	</div>
	<!--<div class="social">
		<h3 class="share"><?php //_e('Share this post', SMG_TEXTDOMAIN); ?></h3>
		<div class="addthis_inline_share_toolbox"  data-url="<?php //echo get_permalink($id) ?>" data-title="<?php //echo $title; ?>"><span class="line"></span></div>
	</div>-->
</section>
