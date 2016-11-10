<?php 
	global $option; 
	$sponsor_aside = $option['sponsor-aside-group'];
	$sponsor_text = $option['sponsor-config-group'];
	$aside = $option['aside-group'];
	if ($sponsor_aside>0) {
		shuffle($sponsor_aside);
	}
?>
<aside class="col-md-4 hidden-xs aside">
	<div class="sponsor-aside">
		<?php 
			if (count($sponsor_aside)>0) {
				?>
					<div class="sponsor-container visible-lg visible-md">
						<div class="sponsor-item wow zoomIn">
							<?php echo do_shortcode($sponsor_aside[0]['sponsor-aside-shortcode']); ?>
							<div class="publicidad"><?php echo $sponsor_text[0]['sponsor-config-text'] ?></div>
						</div>
						<?php 
							if (isset($sponsor_aside[1])) {
								?>
								<div class="sponsor-item wow zoomIn">
									<?php echo do_shortcode($sponsor_aside[1]['sponsor-aside-shortcode']); ?>
									<div class="publicidad"><?php echo $sponsor_text[0]['sponsor-config-text'] ?></div>
								</div>
								<?php
							}
						?>
					</div>
				<?php
			}
		?>
	</div>
	<div class="row categories">
		<h3><?php echo $aside[0]['cat-title'] ?></h3>
		<ul class="cat-list wow-delay">
			<?php 
				// $args = array(
				// 			'show_count'=>true,
				// 			'title_li'=>'CATEGORÍAS',  
				// 				);
				// wp_list_categories($args);
				$terms = get_terms( 'category', array(
				    'hide_empty' => true,
				) ); 
				foreach ($terms as $term) {
					$id = $term->term_id;
					$name = $term->name;
					$slug = $term->slug;
					$link = get_category_link($id);
					$meta = get_term_meta($id);
					$color = $meta['cat-color'][0];
					$img = $meta['cat-img'][0];
					if ($img!='') {
						printf('
							<li class="wow fadeInRight">
								<a href="%s">
									<span class="img">
										<img src="%s" alt="%s">
									</span> 
									<span class="text">%s</span>
								</a>
							</li>
								', $link, $img, $slug, $name);
					}else{
						printf('
							<li class="wow fadeInRight">
								<a href="%s">
									<span class="color" style="background-color:%s"></span> 
									<span class="text">%s</span>
								</a>
							</li>
								', $link, $color, $name);
					}
				}
			?>
		</ul>
	</div>
	<div class="row popular">
		<h3><?php echo $aside[0]['post-title'] ?></h3>
		<ul class="wow-delay">
			<?php 
				$args = array(
							'posts_per_page' =>5,
							'meta_key' => 'wpb_post_views_count',
							'orderby' => 'meta_value_num',
							'order' => 'DESC'
						);
				$most_viewed = new wp_query($args);
				if ($most_viewed->have_posts()) {
					$item_most = $most_viewed->posts;
					for ($i=0; $i < count($item_most); $i++) { 
						$j = $i+1;
						$title = $item_most[$i]->post_title;
						?>
							<li class="wow fadeInUp">
								<a href="<?php echo get_permalink($item_most[$i]->ID)?>">
									<span class="count">#<?php echo $j;?> </span>
									<span class="title"><?php echo $title;?></span>
								</a>
							</li>
						<?php
					}
				}
			?>
		</ul>
	</div>
</aside>