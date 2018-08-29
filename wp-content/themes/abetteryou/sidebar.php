<?php
/**
 * The sidebar containing the main widget area.
 * @package abetteryou
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }

dynamic_sidebar( 'sidebar-1' ); ?>
<div class="row">
<ul id="parent-<?php the_ID(); ?>" class="sidebarlinks">
<?php //get child pages
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
);
$parent = new WP_Query( $args ); ?>

<?php if ( $parent->have_posts() ) { ?>
    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>      
    	<li class="sidebar-link"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?> <span class="glyphicon glyphicon-play" aria-hidden="true"></span></a></li>
    <?php endwhile; ?>

<?php } else { ?>
	<?php 
		$postparent = $post->post_parent;
		if(get_option('page_on_front') != $post->post_parent){ 
			$args = array(
				'sort_order' => 'asc',
				'sort_column' => 'post_title',
				'hierarchical' => 1,
				'parent' => $postparent,
				'post_type' => 'page',
				'post_status' => 'publish'
			); 
			$siblings = get_pages($args);  ?>      
		
			<?php if($postparent == 8){
				foreach($siblings as $sibling ){ ?>
				<li class="sidebar-link"><a href="<?php echo get_page_link($sibling->ID); ?>" title="<?php echo $sibling->post_title; ?>"><?php echo $sibling->post_title; ?> <span class="glyphicon glyphicon-play" aria-hidden="true"></span></a></li>
			<?php } 
		} ?>
<?php } ?>
<?php if ( is_page() && ($post->post_parent=='13') ) { ?>
	<?php $permalink = get_permalink($post->post_parent); ?>
	<li class="sidebar-link"><a href="<?php echo $permalink; ?>" >All Services <span class="glyphicon glyphicon-play" aria-hidden="true"></span></a></li>
<?php } ?>
    
     <?php  
	if(is_page(10)){ ?>
    <li class="sidebar-link"><a href="/about-us/locations/" title="Locations">Locations <span class="glyphicon glyphicon-play" aria-hidden="true"></span></a></li>
    <?php } ?>
    
<?php } wp_reset_query(); ?>
</ul>
</div>