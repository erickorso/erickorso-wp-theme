
<?php 
	wp_nav_menu(
		array(
		'container'=>false, 
		'theme_location'=>'main_nav', 
		'menu'=>'main_nav', 
		'menu_class'=>'main-nav',
		'menu_id'=>'menu-modal',
		)
	);
?>
<script>
	jQuery(function(){
		jQuery('.flex-grid .bars').click(function(){
			if (jQuery(this).hasClass('open-bars')) {
				console.log('cerrado');
				jQuery(this).toggleClass('open-bars');
				jQuery(this).find('.fa').fadeOut(300, function(){
					jQuery(this).removeClass('fa-bars').addClass('fa-remove').fadeIn();
					jQuery('#menu-modal').parent().addClass('open-menu');
				});
			}else{
				console.log('abierto');
				jQuery(this).toggleClass('open-bars');
				jQuery(this).find('.fa').fadeOut(300, function(){
					jQuery(this).removeClass('fa-remove').addClass('fa-bars').fadeIn();
					jQuery('#menu-modal').parent().removeClass('open-menu');
				});
			}
			// var estate = jQuery(this).data('in');
			// if (estate == 'out') {
			// 	jQuery('.flex-grid .bars').attr('data-in', 'in');
			// 	console.log('in-'+ jQuery(this).data('in') + '-' + estate);
			// }else{
			// 	jQuery('.flex-grid .bars').attr('data-in', 'out');
			// 	console.log('out-'+ jQuery(this).data('in') + '-' + estate);
			// }
			// jQuery(this).toogleClass('open-bars');
			// jQuery(this)
			// 	.find('.fa')
			// 	.removeClass('fa-bars')
			// 	.addClass('fa-remove');
			// jQuery('.top-header .menu').toogleClass('open-menu');
		});
	});
</script>
