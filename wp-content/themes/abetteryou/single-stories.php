<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					$medium_array = image_downsize( $photo_id, 'medium' );
					$medium_url = $medium_array[0];
					//$mast_url = wp_get_attachment_url( $mast_id ); 
					
					if($medium_url){ ?>
						<img src="<?php echo $medium_url; ?>" class="img-responsive" alt="<?php echo $post->name; ?>" />
					<?php } ?>
            	</div>
            </div>
            <div id="primary" class="content-area col-xs-12 col-sm-8 pull-right">
                <main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
        
			<?php
                $stories_author = get_post_meta( $post->ID, 'stories_author', true );
                $stories_title = get_post_meta( $post->ID, 'stories_title', true );
                $stories_content = get_post_meta( $post->ID, 'stories_content', true);
				//print_r($stories_content);
            ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->
            
                <div class="entry-content">
                    <?php echo wpautop($stories_content); ?>
                </div><!-- .entry-content -->

            </article><!-- #post-## -->

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
            </div><!-- #primary -->
            <div id="sidebar" class="col-sm-4">
				<?php //get_sidebar(); ?>
				<aside id="text-2" class="widget widget_text">			
                	<div class="textwidget"></div>
				</aside>
                <div class="row">
                <ul id="more-success-stories" class="sidebarlinks">
    				<li class="sidebar-link"><a href="/services/success-stories/" title="Success Stories">More Success Stories</a></li>
                </ul>
                </div>
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