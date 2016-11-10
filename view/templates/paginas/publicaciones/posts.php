<section class="news">
	<div class="container">
		<div class="news-list wow-delay">
         <?php 
            get_template_part( 'view/templates/paginas/publicaciones/search' ); 

            if (is_search()) {
               get_template_part( 'view/templates/paginas/publicaciones/search-list' ); 
            }else{
               if (is_category()) {
                  get_template_part( 'view/templates/paginas/publicaciones/category-list' ); 
               }else{
                  get_template_part( 'view/templates/paginas/publicaciones/post' ); 
               }
            }
            ?>
		</div>
	</div>
</section>