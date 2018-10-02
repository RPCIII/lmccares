<?php
/**
 * The template for displaying all pages.
 * @package abetteryou
 */

 $mastimg = get_field('banner_image');
 $tagline = get_field('tagline');

$circle_1_label = get_field('circle_1_label');
$circle_1_number = number_format(get_field('circle_1_number'));
$circle_2_label = get_field('circle_2_label');
$circle_2_number = number_format(get_field('circle_2_number'));
$circle_3_label = get_field('circle_3_label');
$circle_3_number = number_format(get_field('circle_3_number'));
$circle_4_label = get_field('circle_4_label');
$circle_4_number = number_format(get_field('circle_4_number'));
$circle_5_label = get_field('circle_5_label');
$circle_5_number = number_format(get_field('circle_5_number'));
$circle_6_label = get_field('circle_6_label');
$circle_6_number = number_format(get_field('circle_6_number'));

$featurebuttons = get_field('select_buttons');
$sortedbuttons = array_sort($featurebuttons, 'menu_order', SORT_ASC);

$page_link = get_field('page_link');
$image = get_field('image');
$bar_color = get_field('bar_color');
$text = get_field('text');
$link_text = get_field('link_text');
$show_event = get_field('show_event');

 if ($show_event) {
     $featuredevent = '<div class="container">
	<div id="featured-event" ><img src="'.$image['url'].'" alt="'.$image['alt'].'"  class="img-responsive" />
		<div id="fe-colorbar" style="background-color:'.$bar_color.';"><div class="col-sm-4"></div><div class="col-sm-8"><p>'.$text.' <a href="'.$page_link.'" >'.str_replace(' ', '&nbsp;', $link_text).' <span class="glyphicon glyphicon-play" style="font-size: .7em;" aria-hidden="true"></span></a></p></div><div class="clearfix"></div></div>
	</div></div>';
 } else {
     $featuredevent = '';
 }

get_header(); ?>
    <div id="mast" class="home">
        <div class="container">
        	<h1 id="tagline"><?php echo $tagline; ?></h1>
        </div>
        <div id="iceburg" ></div>
        <div id="mast-image" >
        	<!--<img src="<?php echo $mastimg['url']; ?>" alt="<?php echo $mastimg['alt']; ?>" class="center-block"  />-->
        </div>
    </div>
    <?php if ($featuredevent!='') {
    echo '<div id="featured-event-section">'.$featuredevent.'</div>';
} ?>
    <div id="mid" class="home">
        <div class="container">
        	<div id="success-story" class="col-md-6 text-center">
            	<div id="success-story-container">
				<?php echo do_shortcode('[getstories category="" orderby="rand" truncate="50" number="1" truncate="103" showtitle="false" ]'); ?>
                <p><a href="/services/success-stories/" >More Success Stories</a></p>
                </div>
            </div>
            <div id="feature-buttons" class="col-md-6">
				<?php
                  if ($featurebuttons) {
                      $b = 1;
                      //print_r($featurebuttons);
                      foreach ($sortedbuttons as $button) {
                          $id = $button->ID;
                          $link = get_field('page_link', $id);
                          $photo = get_field('photo', $id);
                          $button_label = get_field('button_label', $id);
                          $button_color = get_field('button_color', $id);
                          //print_r($photo);

                          echo '<div id="feature-button'.$b.'" class="feature-button col-sm-6 color-'.$button_color.'" >';
                          echo '<a href="'.$link.'" style="background-image:url(\''.$photo['url'].'\');" >';
                          echo '<span class="button-title" >'.$button_label.'</span><span class="arrow">&#8594;</span>';
                          echo '</a>';
                          echo '</div>';
                          $b++;
                      }
                  } ?>
            </div>
            <div id="primary" class="content-area col-xs-12">
                <main id="main" class="site-main" role="main">

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="home-title col-md-3 text-center">
                        	<p>Who <span class="lighter">We</span> Are</p>
                        </div>
                        <div class="home-content col-md-9">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-## -->

                </main><!-- #main -->
            </div><!-- #primary -->
            <div id="who-circles" class="col-xs-12 text-center">
				<div id="info1" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_1_number; ?></span><span class="circlelabel"><?php echo $circle_1_label; ?></span></div>
				<div id="info2" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_2_number; ?></span><span class="circlelabel"><?php echo $circle_2_label; ?></span></div>
                <div id="info3" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_3_number; ?></span><span class="circlelabel"><?php echo $circle_3_label; ?></span></div>
                <div id="info4" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_4_number; ?></span><span class="circlelabel"><?php echo $circle_4_label; ?></span></div>
                <div id="info5" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_5_number; ?></span><span class="circlelabel"><?php echo $circle_5_label; ?></span></div>
                <div id="info6" class="who-circle col-xs-6 col-sm-4 col-md-2 text-center" ><span class="circlenum"><?php echo $circle_6_number; ?></span><span class="circlelabel"><?php echo $circle_6_label; ?></span></div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>