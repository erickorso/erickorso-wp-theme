<?php 
	global $option;
	// copy & smg
	$logo = $option['footer-group'][0]['logo'];
	$copy = $option['footer-group'][0]['copy'];
	$bench = $option['footer-group'][0]['footer-img'];

	if ($bench!='') {
		$bg_img = 'style="';
		$bg_img .= 'background-image:url('.$bench.');';
		$bg_img .= '"';
		printf('<section class="fadeInLeft bench" %s></section>', $bg_img);
	}
?>
<footer class="screen wow fadeInDown">
	<div class="container">
		<div class="copyright">
			<?php 
				if (isset($logo)) {
					?>
						<div class="logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo $logo; ?>" alt="">
							</a>
						</div>
					<?php
				}
				if (isset($copy)) {
					?>
						<div class="copy">
							<h2><?php echo $copy ?></h2>
						</div>
					<?php
				}
			 ?>
		</div>
		<div class="smg">
			<a href="http://www.screenmediagroup.com" target="_blank">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/iconos/by_smg.svg" alt="" width="" height="">
			</a>
		</div>
	</div>
</footer>