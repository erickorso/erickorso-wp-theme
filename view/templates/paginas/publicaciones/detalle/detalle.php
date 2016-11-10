<?php 
	the_post();
	global $option;
  	$aside = $option['aside-group'];
  	$related = $aside[0]['related'];
?>
<section class="container singular">
	<div class="col-md-8 single-page">
		<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
						<div class="post-published">
							<?php
								$format = 'Publicado hace %s';
								printf( $format, human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ));;
							?>
							<time class="posted-on published" datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished"></time> 
							<span class="wiews text-right">
								<i class="fa fa-eye"></i>
								 <span class="text-view">
								 	Visto <?php echo wpb_get_post_views($post->ID) ?> veces
								 </span>
							</span>
						</div>
						<h1 class="entry-title wow fadeInLeft" itemprop="headline"><?php the_title() ?></h1>
						<div class="tags">
							<ul>
								<?php 
									// $tags = the_tags('');
									$tags = wp_get_post_tags($post->ID);
									foreach ($tags as $tag) {
										$name = $tag->name;
										$link = get_term_link( $tag );
										printf('
											<li>
												<a href="%s">
													<span class="triangle wow fadeInLeft"></span>
													<span class="text wow fadeInRight">%s</span>
												</a>
											</li>', $link, $name);
									}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-12 entry-content">
					<?php 
					if ( has_post_thumbnail() ) {
						?>
							<div>
								<div class="row">
									<div class="col-sm-12">
										<?php
										$attr = array(
												'class' => 'img-responsive wow zoomIn'
										);
										the_post_thumbnail( false, $attr );
										?>
									</div>
								</div>
							</div>
						<?php
					}
					?>
					<div class="content-post wow fadeInUp">
						<?php the_content(); ?>
						<div id="fb-root"></div>
						<div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=669684736512540";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
					</div>
					<?php 
						if (!is_page()) {
							?>
								<div class="content-related wow-delay">
									<h3><?php echo $related; ?></h3>
									<?php
										$cat = get_the_category($post->ID);
										shuffle($cat);
										$first_cat = $cat[0]->slug;
										$current = array( $post->ID);
										$args = array( 
											'posts_per_page' => 3, 
											'category_name'=>$first_cat,
											'hide_empty' => false,
											'post__not_in' => $current, 
										);
										$loop = new WP_Query( $args );
										if ($loop->have_posts()) {
											$item = $loop->posts;
											for ($i=0; $i < count($item); $i++) { 
												?>
												<div class="col-md-4 wow zoomIn">
													<a href="<?php echo get_permalink($item[$i]->ID)?>">
														<?php 
															$id = $item[$i]->ID;
															$title = $item[$i]->post_title;
															$thumbID = get_post_thumbnail_id($id);
															$imgFeatured = wp_get_attachment_url($thumbID);
															if ($imgFeatured != false) {
																?>
																	<img src="<?php echo $imgFeatured ?>" alt="post" class="img-responsive">
																<?php
															}
														?>
														<h3><?php echo $title;?></h3>
													</a>
												</div>
												<?php
											}
										}
									?>
								</div>
							<?php
						}
					?>
				</div>
			</div>
		</article>
	</div>
	<aside class="col-sm-4 hidden-xs aside">
		<?php get_template_part('view/widgets/aside/aside'); ?>
	</aside>
</section>
