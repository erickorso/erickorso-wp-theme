<span><i id="menu-action" class="fa fa-bars hidden-xs"></i></span>
<?php 
	wp_nav_menu(
		array(
			'container'=>false, 
			'theme_location'=>'main_nav', 
			'menu'=>'main_nav', 
			'menu_class'=>'main-nav', 
			)
	);
?>

<script>
	$(function(){
		$('#menu-action').click(function(){
			$('.side-menu').toggleClass('open');
			$('.content').toggleClass('open');
			$(this).fadeOut(function(){
				$(this).toggleClass('fa-remove').toggleClass('fa-bars').fadeIn();
			});
		})	
	});
</script>