<?php 
	global $option;
	$header = $option['header-identity'];
	$bg_left = $header[0]['logo-bg-left'];
	$bg_right = $header[0]['logo-bg-right'];
	$style_left='';
	if ($bg_left!='') {
		$style_left = 'style="background-image:url('.$bg_left.')"';
	}
	$style_right='';
	if ($bg_right!='') {
		$style_right = 'style="background-image:url('.$bg_right.')"';
	}
?>
<div class="top-header">
	<div class="row logo wow zoomIn">
		<div class="col-md-12 logo-col">
			<div class="flex-grid flex-img hidden-xs hidden-sm" <?php echo $style_left; ?>>
				
			</div>
			<div class="flex-grid">
				<?php 
					get_template_part('view/templates/header/logo');
				?>
				<span class="bars open-bars visible-xs visible-sm">
					<i class="fa fa-bars fa-2x"></i>
				</span>
			</div>
			<div class="flex-grid flex-img hidden-xs hidden-sm" <?php echo $style_right; ?>>
				
			</div>
		</div>
	</div>
	<div class="row menu wow zoomIn">
		<?php 
			get_template_part('view/templates/header/nav');
		?>
	</div>
</div>
<script>
jQuery(function(){
	jQuery(window).scroll(function(event) {

	    var header = jQuery(".main-header");
	    var height = jQuery(event.target).scrollTop();
	    var ancho  = jQuery(window).width();
	    var logo_large = jQuery('.logo-large');
	    var logo_small = jQuery('.logo-small');

	    if (height < 150) {
	        header.removeClass("small");
	        logo_small.fadeOut(300, function(){
				jQuery(this).addClass('hidden');
	        	logo_large.fadeIn().removeClass('hidden');
	        });
	    }else{
	        header.addClass("small");
	        logo_large.fadeOut(600, function(){
	        	jQuery(this).addClass('hidden')
	        	logo_small.fadeIn().removeClass('hidden');
	        });
	    }
	});
});
</script>
