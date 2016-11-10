
<?php 
	global $option;
	$group1 = $option['service-general-page-group'];
		$title_areas = $group1[0]['title'];
		$separador_1 = $group1[0]['bg-separador-1'];
		$separador_2 = $group1[0]['bg-separador-2'];
	$group2 = $option['service-page-group'];
	$group3 = $option['service-areas-page-group'];
	if (count($group2)>1) {
		?>
			<section class="service-asesorias">
				<?php 
					for ($i=0; $i < count($group2); $i++) { 
						$img = $group2[$i]['img'];
						$title = $group2[$i]['title'];
						$content = $group2[$i]['content'];
						$action = $group2[$i]['action'];
						$right = $group2[$i]['right'];
						if ($i==1) {
							if (count($group3)>1) {
								?>
									<div class="container">
										<div class="row">
											<?php 
												foreach ($group3 as $item) {
													$icon = $item['img'];
													$icon_title = $item['title'];
													$icon_content = $item['content'];
													printf('<div class="col-md-4 areas">
																<div class="img">
																	<img src="%s" alt="asesoria">
																</div>
																<div class="caption">
																	<h2>%s</h2>
																	<h3>%s</h3>
																</div>
															</div>', $icon, $icon_title, $icon_content);
												}
											?>
										</div>
									</div>
								<?php
							}
							if ($separador_1!='') {
								printf('<div class="separador">
											<img src="%s" alt="separador1">
										</div>', $separador_1);
							}
						}
						if ($i==3) {
							if ($separador_2!='') {
								printf('<div class="separador">
											<img src="%s" alt="separador1">
										</div>', $separador_2);
							}
						}
						if ($right!='on') {
							?>	
								<div class="container">
									<div class="row">
										<div class="col-md-7 text">
											<?php 
												if ($title!='') {
													printf('<h3>%s</h3>', $title);
												}
												if (strlen($content)>100) {
													$excerpt = substr($content, 0, 100);
													$excerpt .= '...';
												}
												if ($content!='' && $excerpt!="") {
													printf('<div class="content">
															 	<div class="excerpt">%s</div>
															 	<div class="the-content hidden">%s</div>
															</div>', $excerpt, $content);
												}
												if ($action!='') {
													printf('<a href="#" class="action">
																<span class="visible">%s</span>
																<i class="fa fa-remove hidden"></i>
															</a>', $action);
												}
											?>
										</div>
										<div class="col-md-5 img">
											<?php 
												if ($img!='') {
													printf('<img class="img-responsive" src="%s">', $img);
												}
											?>
										</div>
									</div>
								</div>
							<?php
						}else{
							?>
								<div class="container">
									<div class="row">
										<div class="col-md-5 img">
											<?php 
												if ($img!='') {
													printf('<img class="img-responsive" src="%s">', $img);
												}
											?>
										</div>
										<div class="col-md-7 text">
											<?php 
												if ($title!='') {
													printf('<h3>%s</h3>', $title);
												}
												if (strlen($content)>100) {
													$excerpt = substr($content, 0, 100);
													$excerpt .= '...';
												}
												if ($content!='' && $excerpt!="") {
													printf('<div class="content">
															 	<div class="excerpt">%s</div>
															 	<div class="the-content hidden">%s</div>
															</div>', $excerpt, $content);
												}
												if ($action!='') {
													printf('<a href="#" class="action">
																<span class="visible">%s</span>
																<i class="fa fa-remove hidden"></i>
															</a>', $action);
												}
											?>
										</div>
									</div>
								</div>
							<?php
						}
					}
				?>
			</section>
		<?php
	}
?>
<script>
	jQuery(function(){
		jQuery('.action').click(function(e){
			e.preventDefault();
			jQuery(this).parent().fadeOut(200, function(){
				jQuery(this).find('.visible').fadeOut().toggleClass('hidden');
				jQuery(this).find('.fa').fadeOut();
				jQuery(this).find('.excerpt').fadeOut().toggleClass('hidden');
				jQuery(this).find('.the-content').fadeOut();
			})
			jQuery(this).parent().fadeIn(800, function(){
				jQuery(this).find('.fa').fadeIn().toggleClass('hidden');
				jQuery(this).find('.visible').fadeIn();
				jQuery(this).find('.excerpt').fadeIn();
				jQuery(this).find('.the-content').fadeIn().toggleClass('hidden');
			})
			
		})
	})
</script>