<?php 
	global $option;

	$group1 = $option['contact-group'];
	$title = $group1[0]['title'];
	$form = $group1[0]['form'];
	$contact = $group1[0]['contact'];
	$phone = $group1[0]['phone'];
	$group2 = $option['contact-help-group'];
 ?>
<section class="contacto">
	<div class="container">
		<div class="col-sm-7 form">
			<?php 
				if ($title!='') {
					printf('<div class="row title">
								<h2>%s</h2>
							</div>', $title);
				}
				if ($form!='') {
					?>
						<div class="row form shortcode">
							<?php echo do_shortcode($form);?>
						</div>
					<?php
				}
				if ($phone!='') {
					$phone_clean = limpiar($phone);
					printf('<div class="row phone">
								%s <a href="tel:+%s">%s</a>
							</div>', $contact, $phone_clean,$phone);
				}
			?>
		</div>
		<?php 
			if (count($group2)>1) {
				?>
					<div class="col-sm-5 help">
						<?php
							foreach ($group2 as $item) {
									$title = $item['title'];
									$content = $item['content'];
									$link = $item['link'];
									if ($link!='') {
										printf('<div class="row item wow fadeInUp">
													<h2>%s</h2>
													<p>%s <a href="%s">Aquí</a></p>
												</div>', $title, $content, $link);
									}else{
										printf('<div class="row item wow fadeInUp">
													<h2>%s</h2>
													<p>%s</p>
												</div>', $title, $content);
									}
								}
						?>
					</div>
				<?php
			}
		?>
	</div>
</section>