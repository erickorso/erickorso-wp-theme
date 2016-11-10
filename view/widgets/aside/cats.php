<?php 
	global $option; 
	$aside = $option['aside-product-group'];
?>
<div class="row categories">
	<h3><?php echo $aside[0]['cats'] ?></h3>
	<ul class="cat-list wow-delay">
		<?php 
			// $args = array(
			// 			'show_count'=>true,
			// 			'title_li'=>'CATEGORÍAS',  
			// 				);
			// wp_list_categories($args);
			$terms = get_terms( 'product-cat', array(
			    'hide_empty' => true,
			) ); 
			foreach ($terms as $term) {
				$id = $term->term_id;
				$name = $term->name;
				$slug = $term->slug;
				$link = get_category_link($id);
				$meta = get_term_meta($id);
				$color = $meta['cat-color'][0];
				($color=='')?$color='#2a3f6a':'';
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