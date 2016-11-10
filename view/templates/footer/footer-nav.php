<?php 
	global $option;
	$sponsor = $option['sponsor-group'];
	$social = $option['social-group'];
	$tender = $option['footer-group'][0]['footer-tender'];
	if ($tender!='') {
		$bg_img = 'style="';
		$bg_img .= 'background-image:url('.$tender.');';
		$bg_img .= '"';
		printf('<section class="tender wow fadeInUp" %s></section>', $bg_img);
	}
?>
<section class="footer-nav wow fadeInUp">
	<div class="container">
		<div class="col-sm-12 col-md-3 menu hidden-xs ">
			<?php 
				wp_nav_menu(
					array(
						'container'=>false, 
						'theme_location'=>'footer_nav', 
						'menu'=>'footer_nav', 
						'menu_class'=>'footer_nav', 
						)
				);
			?>
		</div>
		<div class="col-sm-6 col-md-3 social ">
			<?php 
				if (count($social)>0) {
					?>
					<ul class="wow-delay">
						<?php
							for ($i=0; $i < count($social); $i++) { 

								$link = $social[$i]['social-link'];
								$label = $social[$i]['social-label'];
								$icon = $social[$i]['social-icon'];

								if ($label!='') {
									printf('<li class="wow fadeInUp">
												<a href="%s">
													<i class="fa %s"></i> 
													<span class="hidden-xs">%s</span>
												</a>
											</li>', 
											$link, 
											$icon,
											$label
										);
								}else{
									printf('<li class="wow fadeInUp">
												<a href="%s">
													<i class="fa %s"></i> 
												</a>
											</li>', 
											$link, 
											$icon 
										);
								}
							}
						?>
					</ul>
					<?php
				}
			?>
		</div>
		<div class="col-sm-6 col-md-6 sponsor ">
			<?php 
				if (count($sponsor[0])>1) {
					?>
					<ul class="wow-delay">
						<?php
							foreach ($sponsor as $item) {
								$img = $item['sponsor'];
								$link = $item['sponsor-link'];
								if ($link!='' && $img!='') {
									printf('<li class="wow fadeInUp">
												<a href="%s">
													<img src="%s" alt="sponsor">
												</a>
											</li>',
												$link, 
												$img
											);
								}else{
									if ($img!='') {
										printf('<li class="wow fadeInUp">
													<img src="%s" alt="sponsor">
												</li>',
													$img
												);
									}
								}
							}
						?>
					</ul>
					<?php
				}
			?>
		</div>
	</div>
</section>