<?php 
	$option = get_option('screen_options');
	$chatra = $option['chatra-group'][0]['code'];
	if (isset($chatra)) {
		?>
		<script>
			<?php
				echo $chatra;
			?>
		</script>		
		<?php
	}
?>