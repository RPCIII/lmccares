<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package abetteryou
 */

get_header(); ?>
    <div id="mast" class="support"></div>
    <div class="clearfix"></div>
    <div id="mid" class="support">
        <div class="container">
        	<div id="secondary" class="col-sm-4">
            	<div id="featured-photo">
                	<?php 
					$photo_id = get_post_thumbnail_id($post->ID);
					$mast_url = wp_get_attachment_url( $photo_id );
					if($mast_url!=''){
						$photosize = getimagesize($mast_url);
						if($photosize[0] > 767){
							$medium_array = image_downsize( $photo_id, 'medium' );
							$mast_url = $medium_array[0];
						}
					}
					
					if($mast_url){ ?>
						<img src="<?php echo $mast_url; ?>" class="img-responsive" alt="<?php echo $post->name; ?>" />
					<?php } ?>
            	</div>
            </div>
            <div id="primary" class="content-area col-xs-12 col-sm-8 pull-right">
                <main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>
            
                        <header class="page-header">
                            <?php
                                the_archive_title( '<h1 class="page-title">', '</h1>' );
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                            ?>
                        </header><!-- .page-header -->
            
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
            
                            <?php
            
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', get_post_format() );
                            ?>
            
                        <?php endwhile; ?>
            
                        <?php the_posts_navigation(); ?>
            
                    <?php else : ?>
            
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
            
                    <?php endif; ?>

				</main><!-- #main -->
            </div><!-- #primary -->
            <div id="sidebar" class="col-sm-4">
				<?php get_sidebar(); ?>
                <div id="sidebar-buttons">
                <?php 
					$featurebuttons = get_field('select_buttons'); 
					if($featurebuttons){
					$sortedbuttons = array_sort($featurebuttons, 'menu_order', SORT_ASC);
						if($featurebuttons){
							$b = 1;
							//print_r($featurebuttons);
							foreach($sortedbuttons as $button){
								$id = $button->ID;
								$link = get_field('page_link',$id);
								$photo = get_field('photo',$id);
								$button_label = get_field('button_label',$id);
								$button_color = get_field('button_color',$id);
								//print_r($photo);
								
								echo '<div id="feature-button'.$b.'" class="feature-button col-md-11 col-lg-9 color-'.$button_color.'" >';
								echo '<a href="'.$link.'" style="background-image:url(\''.$photo['url'].'\');" >';
								echo '<span class="button-title" >'.$button_label.'</span><span class="arrow">&#8594;</span>';
								echo '</a>';
								echo '</div>';
								$b++;
							}
						} 
					} ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>

