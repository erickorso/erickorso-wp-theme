<?php 
	$post;
	global $option;
  	$group1      = $option['app-about-page-group'];
  	$group2      = $option['app-about-page-item-group'];
  	$subtitle    = $group1[0]['subtitle'];
  	$content     = $group1[0]['content'];
  	$content_img = $group1[0]['content'];
?>
<section class="about-app">
	<div class="container">
		<div class="row caption wow fadeInLeft">
			<h1><?php echo $post->post_title; ?></h1>
			<div class="content">
				<?php the_content();?>
			</div>
		</div>
		<?php 
			if (count($group2)>1) {
				?>
					<div class="row etapas">
						<h2><?php echo $subtitle;?></h2>
						<div class="group wow-delay">
							<?php 
								foreach ($group2 as $item) {
									$title = $item['title'];
									$subtitle = $item['subtitle'];
									$img = $item['img'];
									printf('<div class="item col-sm-4 wow fadeInUp">
												<h3>%s</h3>
												<img src="%s" alt="step">
												<h4>%s</h4>
											</div>', $title, $img, $subtitle);
								}
							?>
						</div>
					</div>
				<?php
			}
		?>
		<div class="row caracteristicas">
			<?php 
				printf('<div class="content-libro wow fadeInUp">
								<div class="content">%s</div>
							</div>', $content);
			?>
		</div>
	</div>
</section>
