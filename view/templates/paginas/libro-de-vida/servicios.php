<?php 
	global $option;

	$group = $option['product-group'];
	if (count($group[0])>1) {
		?>
			<section class="product-icons">
				<div class="container">
					<div class="row product-list">
						<?php 
							foreach ($group as $item) {
								$icon = $item['icon'];
								$link = $item['link'];
								$btn = $item['btn'];
								if ($icon!='' && $link!='' && $btn!='') {
									printf('<div class="col-md-3 col-sm-6 product-item">
												<img class="responsive-image" src="%s" alt="%s">
												<a class="btn btn-default" href="%s">%s</a>
											</div>', $icon, $btn, $link, $btn);
								}
							}
						?>
					</div>
				</div>
			</section>
		<?php
	}
?>