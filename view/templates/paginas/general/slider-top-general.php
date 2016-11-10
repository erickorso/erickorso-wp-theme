<?php 
global $option;
global $option_section;
$group = $option[$option_section.'-group'];
if (count($group[0])>2) {
   ?>
      <section class="slider-top">
          <ul id="slider-top">
            <?php
               foreach ($group as $slider_item) {

                  $bg         = $slider_item['image-bg'];
                  $color      = $slider_item['shadow'];
                  $opacity    = $slider_item['shadow-opacity'];
                  $title      = $slider_item['slider-title'];
                  $subtitle   = $slider_item['slider-subtitle'];
                  $author       = $slider_item['slider-author'];
                  $btn        = $slider_item['slider-action-text'];
                  $link       = $slider_item['slider-action-link'];
                  $img        = $slider_item['image-in'];

                  /*
                     background slider item
                  */
                     // img bg
                  if ($bg!='') {
                     $bg_style = 'style="background-image:url('.$bg.')"';
                  }else{
                     $bg_style = '';
                  }

                  /*
                     opacity slider item
                  */
                  if ($opacity!='' || $color!='') {
                     $opacity = $opacity/100;
                     $shadow  = 'style="';
                     $shadow .= 'opacity:'.$opacity.';';
                     $shadow .= 'background-color:'.$color.';';
                     $shadow .= '"';
                  }else{
                     $shadow  = '';
                  }

                  ?>
                     <li class="slider-item" <?php echo $bg_style; ?>>
                        <?php 
                           /*
                              background slider item shadow 
                           */
                        ?>
                        <div class="slider-shadow" <?php echo $shadow; ?>></div>
                        <div class="container item-container">
                           
                           <?php 
                              /*
                                 background slider item image in 
                              */
                              if ($img!='') {
                                 printf('<div class="slider-image-in wow fadeInLeft col-lg-6 col-md-5 col-sm-6">
                                          <img src="%s" alt="image-in">
                                       </div>', $img);
                              }
                           ?>
                           
                           <?php 

                              /*
                                 background slider item captions 
                              */
                              if ($title!='' || $subtitle!='' || $author!='' || ($link!='' && $btn)) {
                                 ?>
                                 <div class="caption col-lg-6 col-md-7 col-sm-6">
                                    <div class="slider-titles">
                                       <ul class="slider-titles-list wow-delay">
                                          <?php 
                                          if ($title!='') {
                                             printf('<li class="title wow fadeInRight">
                                                      <h2>%s</h2>
                                                   </li>', $title);
                                          }
                                          if ($subtitle!='') {
                                             printf('<li class="sub-title text wow zoomInUp">
                                                      <h3>%s</h3>
                                                   </li>', $subtitle);
                                          }
                                          if ($author!='') {
                                             printf('<li class="author text wow zoomInUp">
                                                      <h3>%s</h3>
                                                   </li>',$author);
                                          }
                                          if ($btn!='' && $link!='') {
                                             if ($link!='') {
                                                printf('<li class="action wow zoomInUp">
                                                         <a href="%s" class="btn btn-default">%s</a>
                                                      </li>',$link,$btn);
                                             }
                                          }
                                          ?>
                                       </ul>
                                    </div>
                                 </div>
                                 <?php
                              }
                           ?>
                        </div>
                     </li>
                  <?php

               }
               ?>
         </ul>
      </section>
      <script>
         // bxslider
         jQuery(function(){
            jQuery('#slider-top').bxSlider({
                 adaptiveHeight: true,
                 adaptiveHeightSpeed:1000, 
                 mode: 'fade', 
                 controls: true, 
                 randomStart:false, 
                 easing: 'ease-in-out',
                 preloadImages:'visible',
                 auto: false, 
                 captions:true,
                 randomStart:false, 
                 preloadImages:'all',
                 swipeThreshold:20, 
                 speed:4000,
             });
         })
      </script>
   <?php
}
?>




