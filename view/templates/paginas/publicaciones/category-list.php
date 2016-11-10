<section class="loop">
   <?php
   global $posts;
   if ( $posts!='' && count($posts)>0 ) {
      foreach ($posts as $post) {
         global $post;
         get_template_part( 'view/templates/paginas/publicaciones/loop-posts' );
      }
   }else{
      echo '<h2>'.__( 'No Results ', SMG_TEXTDOMAIN ).'</h2>';
   }
   ?>
</section>