<div class="row popular">
	<h3><?php echo $aside[0]['recientes'] ?></h3>
	<ul class="wow-delay">
		<?php 
			$args = array(
						'posts_per_page' =>5,
						'post_type' => 'post',
					);
			$post = new wp_query($args);
			if ($post->have_posts()) {
				$item = $post->posts;
				for ($i=0; $i < count($item); $i++) { 
					$id = $item[$i]->ID;
					$title = $item[$i]->post_title;
					$name = $item[$i]->post_name;
					$thumbID = get_post_thumbnail_id($id);
					$img_url = wp_get_attachment_url($thumbID);
					?>
						<li class="wow fadeInUp">
							<div class="img">
								<img src="<?php echo $img_url; ?>" alt="<?php echo $name; ?>">
							</div>
							<div class="caption">
								<?php
									$format = 'Publicado hace %s';
								printf( $format, human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ));;
								?>
								<a href="<?php echo get_permalink($item[$i]->ID)?>">
									<span class="title"><?php echo $title;?></span>
								</a>
							</div>
						</li>
					<?php
				}
			}
		?>
	</ul>
</div>