<section class="loop">
   <?php
   $args = array( 
      'posts_per_page' => -1, 
      'post_type'=>'post', 
      'hide_empty' => false,
      's'=>$_GET['s'], 
   );
   $loop = new WP_Query( $args );
   $posts = $loop->posts;
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