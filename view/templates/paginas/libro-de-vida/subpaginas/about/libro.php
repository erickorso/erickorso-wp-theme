<?php 
	$post;
	global $option;
  	$group = $option['libro-about-page-group'];

	  	$btn         = $group[0]['btn'];
	  	$btn_link    = $group[0]['btn-link'];
	  	$bg          = $group[0]['image-bg'];
	  	$file_btn    = $group[0]['pdf-btn'];
	  	$file_img    = $group[0]['pdf-img'];
	  	$file        = $group[0]['pdf'];
	  	$modal_title = $group[0]['modal-title'];

	if ($bg!='') {
		$bg_style = 'style="';
		$bg_style .= 'background-image:url('.$bg.');';
		$bg_style .= '"';
	}else{
		$bg_style = '';
	}
?>
<section class="about-book" <?php echo $bg_style ?>>
	<div class="container">
		<div class="col-md-6 caption wow fadeInLeft">
			<h1><?php echo $post->post_title; ?></h1>
			<div class="content">
				<?php 
					the_content();
					if ($btn!='' && $btn_link!='') {
						printf('<div class=" row action wow zoomInUp">
									<a href="%s" class="btn btn-default" data-toggle="modal" data-target="#libroModal">%s</a>
								</div>',$link,$btn_link);
					}

					if ($file!='') {
						if ($file_btn=='') {
							$file_btn = 'Descargar pdf';
						}
						printf('<div class="row">
									<a class="pdf" href="%s" class="" target="_blank">%s</a>
									<img src="%s" alt="pdf">
								</div>', $file, $file_btn, $file_img);
					}
				?>
			</div>
		</div>
		<div class="col-md-6 img">
			<?php 
				if (has_post_thumbnail()) {
					the_post_thumbnail('full', array( 'class' => 'wow zoomIn img-responsive' )); 
				}
			?>
		</div>
	</div>
</section>


<!-- Modal -->
<div class="modal fade" id="libroModal" tabindex="-1" role="dialog" aria-labelledby="libroModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $modal_title; ?></h4>
      </div>
      <div class="modal-body">
			<?php 
				$group2 = $option['libro-about-modal-group'];
				if ($group2[0]['title1']!='' || $group2[0]['title2']!='' || $group2[0]['content']!='' || ($group2[0]['action_text']!='' && $group2[0]['action_link']!='')) {
					foreach ($group2 as $modal_item) {
						$title1      = $modal_item['title1'];
						$title2      = $modal_item['title2'];
						$content     = $modal_item['content'];
						$action_text = $modal_item['action-text'];
						$action_link = $modal_item['action-link'];
						$img         = $modal_item['img'];

						echo '<div class="col-md-6 opcion">';
							if ($title1!='' && $title2!='') {
								printf('<h2>%s <span class="rojo">%s</span></h2>', $title1, $title2);
							}
							if ($content!='') {
								printf('<div class="hidden-xs caption">%s</div>', $content);
							}
							if ($action_link!='' && $action_text!='') {
								printf('<a href="%s" class="btn btn-default">%s</a>', $action_link, $action_text);
							}
							if ($action_link!='' && $img!='') {
								printf('<a href="%s" class="btn-venta">
											<img src="%s" atl="venta">
										</a>', $action_link, $img);
							}
						echo '</div>';
					}
				}
			?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary hidden" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary hidden">Save changes</button>
      </div>
    </div>
  </div>
</div>


