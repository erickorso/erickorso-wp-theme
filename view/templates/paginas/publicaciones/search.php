<section class="search">
   <div class="col-sm-4 col-md-3 category wow fadeInLeft">
      <div class="select">
         <select class="form-control" id="category-list">
            <option value="Categorias">Categorias</option>
            <?php 
               $terms = get_categories();
               foreach ($terms as $term) {
                  printf('<option value="%s">%s</option>',get_category_link( $term->term_id ), $term->name );
               }
            ?>
         </select>
      </div>
   </div>
   <div class="col-sm-4 col-sm-offset-4 col-md-offset-6 col-md-3 search-form wow fadeInLeft">
      <form action="<?php echo home_url(); ?>" method="get" role="search" id="search_form">
         <div class="input-group">
            <input class="form-control" placeholder="Buscar..." value="" name="s" title="Buscar:" type="text">
            <span class="input-group-btn">
               <button class="btn btn-primary" type="submit" id="search_submit">
                  <i class="fa fa-search"></i>
               </button>
            </span>
         </div>
      </form>
   </div>
</section>
<script type="text/javascript">
   jQuery(function(){
      jQuery('#category-list').on('change', function(){
         window.location.href = jQuery(this).val();
      })
   })
</script>