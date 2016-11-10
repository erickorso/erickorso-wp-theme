<?php 
global $option;

$group1 = $option['comment-group'];
$title_section = $group1[0]['title'];
$img = $group1[0]['img'];
$count = $group1[0]['count'];
$group2 = $option['comment-item-about-group'];
if (count($group2)< $count) {
	$count = count($group2);
}
if (count($group2[0])>1) {
	?>
		<section class="comment" id="comentarios-home">
			<h2><?php echo $title_section;?></h2>
			<?php 
				if (count($group2)>1) {
					?>
						<ul class="controls">
							<?php 
								for ($i=0; $i < $count; $i++) { 
									($i==0)?$class="in":$class="";
									printf('<li class="badged comment-control %s" data-control="data%s"></li>', $class,$i);
								}
							?>
						</ul>
					<?php
				}
			?>
		    <ul class="comment-list container">
		    	<?php
		    		for ($i=0; $i < $count; $i++) { 
		    			$author  = $group2[$i]['author'];
		    			$title   = $group2[$i]['title'];
		    			$content = $group2[$i]['content'];
		    			($i==0)?$class="in":$class="";
		    			?>
				    		<li class="comment-item <?php echo $class.' data'.$i?>">
				    			<div class="comment-img img-left">
				    				<img class="img-responsive" src="<?php echo $img?>" alt="co">
				    			</div>
			    				<div class="comment-caption">
									<?php 
										if ($content!='') {
											printf('<div class="content wow slideInUp">
														%s
													</div>', $content); 
										}
										if ($author!='') {
											printf('<div class="author wow slideInUp">
														<h4>%s</h4>
													</div>', $author );
										}
										if ($title!='') {
											printf('<div class="title wow slideInUp">
														<h3>%s</h3>
													</div>', $title);
										}
									?>
				    			</div>
				    			<div class="comment-img img-right">
				    				<img class="img-responsive" src="<?php echo $img?>" alt="co">
				    			</div>
							</li>
						<?php
		    		}
		    	?>
			</ul>
		</section>
		<script>
			jQuery(function(){

				jQuery('.comment-control').click(function(){

					var btn = jQuery(this);
					var data = btn.data('control');
					var list = jQuery('.comment-list');

					btn.parent().find('.in').removeClass('in');
					btn.addClass('in');

					list.find('.in').fadeOut(300, function(){
						jQuery(this).removeClass('in')
						list.find('.'+data).fadeIn(300, function(){
							jQuery(this).addClass('in');
						})
					});

				});
				
			})
		</script>
	<?php
}



