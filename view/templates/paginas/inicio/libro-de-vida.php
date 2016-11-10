<?php 
global $option;
$group = $option['libro-group'];
if (count($group)>0) {
	?>
		<section class="libro-de-vida-home">
		    <ul id="libro-de-vida">
		    	<?php
		    		foreach ($group as $item) {

		    			$color       = $item['color-bg'];
		    			$bg          = $item['image-bg'];
		    			$title       = $item['title'];
		    			$content     = $item['content'];
		    			$font        = $item['color-font'];
		    			$action_text = $item['action-text'];
		    			$action_link = $item['action-link'];
		    			$img         = $item['image-in'];
		    			$align       = $item['align'];
		    			$vertical    = $item['vertical'];
						if ($color!='') {
		    				$bg_color = 'style="';
							$bg_color .= 'background-color:'.$color.';';
		    				$bg_color .= '"';
		    			}else{
		    				$bg_color = '';
		    			}

		    			if ($bg!='') {
		    				$bg_img = 'style="';
			    			$bg_img .= 'background-image:url('.$bg.');';
		    				$bg_img .= '"';
		    			}else{
		    				$bg_img = '';
		    			}

						if ($font!='') {
		    				$color_font = 'style="';
			    			$color_font .= 'color:'.$font.';';
		    				$color_font .= '"';
		    			}else{
		    				$color_font .= 'color:white;';
		    			}

		    			if ($vertical!='') {
		    				$vertical_style  = 'style="';
							$vertical_style .= '-webkit-align-items:'.$vertical.';';
							$vertical_style .= '-moz-align-items:'.$vertical.';';
							$vertical_style .= '-ms-align-items:'.$vertical.';';
							$vertical_style .= '-align-items:'.$vertical.';';
		    				$vertical_style .= '"';
		    			}else{
		    				$vertical_style  = '';
		    			}
		    			?>
				    		<li class="libro-item" <?php echo $bg_color; ?>>
				    		<?php
				    			if ($align=='on') {
				    				?>
				    				<div class="col-lg-6 item-caption wow-delay" <?php echo $bg_img?>>
										<?php 
											if ($title!='' || $content!='' ||  ($link!='' && $btn)) {
												?>
												<?php 
												if ($title!='') {
													printf('<div class="title wow slideInUp" %s>
																<h2>%s</h2>
															</div>',$color_font, $title);
												}
												if ($content!='') {
													printf('<div class="content text wow slideInUp" %s>
																%s
															</div>',$color_font,$content); 
												}
												if ($action_text!='' && $action_link!='') {
													printf('<div class="action wow slideInUp">
																<a href="%s" class="btn btn-default">%s</a>
															</div>', $action_link,$action_text );
												}
											}
										?>
					    			</div>
					    			<div class="col-lg-6 item-img" <?php echo $vertical_style; ?>>
					    				<?php 
											if ($img!='') {
												printf('<div class="libro-image-in wow fadeInUp">
															<img class="img-responsive" src="%s" alt="image-in">
														</div>',$img);
											}
						    			?>
					    			</div>
				    				<?php
				    			}else{
				    				?>
					    			<div class="col-lg-6 item-img" <?php echo $vertical_style; ?>>
					    				<?php 
											if ($img!='') {
												printf('<div class="libro-image-in wow fadeInUp">
															<img class="img-responsive" src="%s" alt="image-in">
														</div>',$img);
											}
						    			?>
					    			</div>
				    				<div class="col-lg-6 item-caption wow-delay" <?php echo $bg_img?>>
										<?php 
											if ($title!='' || $content!='' ||  ($link!='' && $btn)) {
												?>
												<?php 
												if ($title!='') {
													printf('<div class="title wow slideInUp" %s>
																<h2>%s</h2>
															</div>',$color_font, $title);
												}
												if ($content!='') {
													printf('<div class="content text wow slideInUp" %s>
																%s
															</div>',$color_font,$content); 
												}
												if ($action_text!='' && $action_link!='') {
													printf('<div class="action wow slideInUp">
																<a href="%s" class="btn btn-default">%s</a>
															</div>', $action_link,$action_text );
												}
											}
										?>
					    			</div>
				    				<?php
				    			}
							?>
							</li>
						<?php

		    		}
		    		?>
			</ul>
		</section>
	<?php
}
?>




