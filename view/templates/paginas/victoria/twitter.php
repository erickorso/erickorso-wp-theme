<?php 
	global $option;

	$group1 = $option['twitter-about-group'];
	$group2 = $option['twitter-about-item-group'];
	$twitter_img = $group1[0]['twitter-img'];
	$twitter_btn = $group1[0]['twitter-btn'];
	if (count($group2)>1) {
		?>
			<section class="twitter-clip">
				<div class="container">
					<div class="wrapper col-md-6 col-md-offset-3">
						<?php 
							if ($twitter_img!='') {
								printf('<div class="ribete top">
											<img src="%s" alt="ribete">
										</div>', $twitter_img);
							}
						?>
						<ul id="twitter-list">
							<?php 
								foreach ($group2 as $item) {
									$content = $item['twitter'];
									if (strlen($content)>137) {
										$content = substr($content, 0, 137);
										$content .= '...';
									}
									if ($twitter_btn == '') {
										$twitter_btn = 'Twittear';
									}
									printf('<li>
												<span class="tweet">%s</span>
												&nbsp;
												<a class="twitter-click" href="https://twitter.com/intent/tweet?text=%s" target="_blank">%s</a>
											</li>', $content, $content, $twitter_btn );
								}
							?>
						</ul>
						<?php
							if ($twitter_img!='') {
								printf('<div class="ribete bottom">
											<img src="%s" alt="ribete">
										</div>', $twitter_img);
							}
						?>
					</div>
				</div>
			</section>
			<script>
			// bxslider
			jQuery(function(){
				jQuery('#twitter-list').bxSlider({
			        adaptiveHeight: true,
			        adaptiveHeightSpeed:1000, 
			    });
			})
		</script>
		<?php
	}
?>