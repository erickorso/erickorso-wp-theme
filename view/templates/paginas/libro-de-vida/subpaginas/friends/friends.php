<?php 
	$post;
	global $option;

  	$group1 = $option['friends-about-page-group'];
  	$subtitle = $group1[0]['title'];
  	$subtitle2 = $group1[0]['subtitle'];
  	$content = $group1[0]['content'];
  	$img = $group1[0]['img'];

  	$group2 = $option['friends-about-page-item-group'];
?>
<section class="about-friends">
	<div class="container">
		<div class="row caption wow fadeInLeft">
			<h1><?php the_title(); ?></h1>
			<div class="content">
				<?php the_content();?>
			</div>
		</div>
		<?php 
			if ($subtitle!='' || $content!='' || $img!='') {
				?>
					<div class="row caption friends-content">
						<div class="col-md-7 text">
							<?php 
								if ($subtitle!='') {
									printf('<h2>%s</h2>',
										$subtitle);
								}
								if ($content!='') {
									printf('<div class="content">%s</div>',
										$content);
								}
							?>
							
						</div>
						<div class="col-md-5 img">
							<?php 
								if ($img!='') {
									printf('<img src="%s" alt="asesoria">',
										$img);
								}
							?>
						</div>
					</div>
				<?php
			}
			if (count($group2)>1) {
				?>
					<div class="row caption friends">
						<?php 
							if ($subtitle2!='') {
								printf('<h2>%s</h2>',
									$subtitle2);
							}
						?>
						<ul class="friends-list wow-delay">
							<?php 
								foreach ($group2 as $item) {
									$link = $item['link'];
									$img = $item['img'];
									printf('<li class="item wow fadeInUp">
												<a href="%s">
													<img src="%s" alt="step">
												</a>
											</li>', $link, $img);
								}
							?>
						</ul>
					</div>
				<?php
			}
		?>
	</div>
</section>
