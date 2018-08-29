<?php
/*
Plugin Name: Story System Plugin by KMA
Description: Story System plugin for use with KMA sites. 
*/

// Add scripts to wp_head()
function stories_to_head() {
	
}
add_action( 'wp_head', 'stories_to_head' );
 
add_action( 'init', 'create_stories_cpt' );
 
function create_stories_cpt(){
	register_post_type( 'stories', array(
	  'labels'             => array(
		  'name' 		         => _x( 'Success Stories', 'post type general name' ),
		  'singular_name'      => _x( 'Story', 'post type singular name' ),
		  'menu_name'          => _x( 'Success Stories', 'admin menu', 'palmbay' ),
		  'name_admin_bar'     => _x( 'Success Stories', 'add new on admin bar' ),
		  'add_new'            => _x( 'Add New', 'stories' ),
		  'add_new_item'       => __( 'Add New Story' ),
		  'new_item'           => __( 'New Story' ),
		  'edit_item'          => __( 'Edit Story' ),
		  'view_item'          => __( 'View Story' ),
		  'all_items'          => __( 'All Stories' ),
		  'search_items'       => __( 'Search Stories' ),
		  'parent_item_colon'  => __( 'Parent Story:' ),
		  'not_found'          => __( 'No stories found.' ),
		  'not_found_in_trash' => __( 'No stories found in Trash.' )
	  ),
	  'public'             => true,
	  'publicly_queryable' => true,
	  'show_ui'            => true,
	  'show_in_menu'       => true,
	  'query_var'          => true,
	  //'rewrite' => false,
	  'rewrite'            => array( 'slug' => 'success-stories', 'with_front' => FALSE ),
	  'capability_type'    => 'post',
	  'has_archive'        => false,
	  'hierarchical'       => false,
	  'menu_position'      => null,
	  'supports'           => array( 'title','excerpt', 'revisions', 'thumbnail' )
	));
		
	register_taxonomy( 'story-type', 'stories', 
	  array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'                       => _x( 'Categories', 'taxonomy general name' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Categories' ),
			'popular_items'              => __( 'Popular Categories' ),
			'all_items'                  => __( 'All Categories' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category' ),
			'update_item'                => __( 'Update Category' ),
			'add_new_item'               => __( 'Add New Category' ),
			'new_item_name'              => __( 'New Category Name' ),
			'separate_items_with_commas' => __( 'Separate categories with commas' ),
			'add_or_remove_items'        => __( 'Add or remove categories' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories' ),
			'not_found'                  => __( 'No categories found.' ),
			'menu_name'                  => __( 'Categories' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'story-type' ),
	  ) 
	);
}
function stories_meta () {
 
	// - grab data -
	 
	global $post;
	$custom = get_post_custom($post->ID);
	$storiestitle = $custom["stories_title"][0];
	$storiesauthor = $custom["stories_author"][0];
	$storiescontent = $custom["stories_content"][0]; 

	// - security -
	 
	echo '<input type="hidden" name="stories-nonce" id="stories-nonce" value="' .
	wp_create_nonce( 'stories-nonce' ) . '" />';
	 
	// - output -

	?>
    
	<div class="stories-meta">
	<table width="100%" >
    <tr>
    <td width="140"><label>Story Author</label></td><td><input name="stories_author" class="text" value="<?php echo $storiesauthor; ?>" style="width:100%" /></td>
    </tr>
    <tr>
    <td width="140"><label>Story Title/Company</label></td><td><input name="stories_title" class="text" value="<?php echo $storiestitle; ?>" style="width:100%" /></td>
    </tr>
    <tr><td colspan="2"><?php wp_editor( htmlspecialchars_decode($storiescontent), 'kma_stories_content', array('textarea_name'=>'stories_content','media_buttons'=>true,'textarea_rows'=>'20','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>false) ); ?></td>
	</tr>
    </table>
	</div>
	<?php
}

function stories_create() {
    add_meta_box('stories_meta', 'Story Information', 'stories_meta', 'stories', 'normal', 'high');
	//add_meta_box('job_file', 'Story PDF File', 'job_file', 'stories', 'normal', 'high'); 
}

function stories_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Story Name",
		"stories_author" => "Story Author",
		"stories_title" => "Story Title/Company",
		"stories_content" => "Story Content",
		"stories_cat" => "Category",
	);
	return $columns;
}

function shortenstory($string,$length=100,$append="&hellip;") {
  $string = trim($string);

  if(strlen($string) > $length) {
    $string = wordwrap($string, $length);
    $string = explode("\n", $string, 2);
    $string = $string[0] . $append;
  }

  return $string;
}
	 
function stories_custom_columns($column){
	global $post;
	$custom = get_post_custom();
	
	switch ($column){
	case "stories_cat":
		// - show taxonomy terms -
		$storiescats = get_the_terms($post->ID, "job-type");
		$storiescats_html = array();
		if ($storiescats) {
			foreach ($storiescats as $storiescat)
			array_push($storiescats_html, $storiescat->name);
			echo implode($storiescats_html, ", ");
		} 
	break;
	case "stories_title":
		// - show dates -
		$storiestitle = $custom["stories_title"][0];
		echo $storiestitle;
	break;
	case "stories_author":
		// - show dates -
		$storiesauthor = $custom["stories_author"][0];
		echo $storiesauthor;
	break;
	case "stories_content":
		// - show times -
		$storiescontent = $custom["stories_content"][0];
		echo shortenstory($storiescontent, 150);
	break;
	 
	}
}
  

function save_stories(){
 
	global $post;
	 
	// - still require nonce
	 
	if ( !wp_verify_nonce( $_POST['stories-nonce'], 'stories-nonce' )) {
		return $post->ID;
	}
	 
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	 
	// - convert back to unix & update post
	 
	if(!isset($_POST["stories_title"])):
	return $post;
	endif;
	$updatetitle = $_POST["stories_title"];
	update_post_meta($post->ID, "stories_title", $updatetitle );
	
	if(!isset($_POST["stories_author"])):
	return $post;
	endif;
	$updateauthor = $_POST["stories_author"];
	update_post_meta($post->ID, "stories_author", $updateauthor );		
	 
	if(!isset($_POST["stories_content"])):
	return $post;
	endif;
	$updatecontent = $_POST["stories_content"];
	update_post_meta($post->ID, "stories_content", $updatecontent );
	
}

function stories_updated_messages( $messages ) {
 
  global $post, $post_ID;
 
  $messages['stories'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Story updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Story updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Story restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Story published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Story saved.'),
    8 => sprintf( __('Story submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Story scheduled to post on: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview member</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Story draft updated. <a target="_blank" href="%s">Preview member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
 
  return $messages;
}

// [getstories category="" orderby="" truncate="" number="" ]
function getstories_func( $atts, $content = null ) {
	$debugstories = FALSE;
	
    $a = shortcode_atts( array( //define shortcode arguments
		'number' => -1,
		'truncate' => '',
		'readmore' => 'false',
		'showtitle' => 'true',
		'category' => '', //blank by default
		'orderby' => 'menu_order', //default by menu order (use a plugin to enable drag n' drop)
    ), $atts );
	
	if($debugstories){
		$output = '<p>category = '.$a['category'].', orderby = '.$a['orderby'].'</p>';
	}else{
		$output = '';
	}
	
	$request = array( //create basic post request
		  'posts_per_page'   => $a['number'],
		  'offset'           => 0,
		  'order'            => 'ASC',
		  'orderby'   		 => $a['orderby'],
		  'post_type'        => 'stories',
		  'post_status'      => 'publish',	  
	);
	  
	if($a['category']!= ''){ //add to post request IF category is not blank
		$taxarray = array(
			array(
				'taxonomy' => 'story-type',
				'field' => 'slug',
				'terms' => $a['category'],
				'include_children' => false,
			),
		);
		$request['tax_query'] = $taxarray;
	}
		
	if($debugstories){
		print_r($request);
	}
		
	$storylist = get_posts( $request );
	
	$u = 1;
	
	$output = '<div class="success-story-list">';
	foreach($storylist as $story){	  
		$storyid = $story->ID;  
		$title = $story->post_title;
		$quote = $story->post_excerpt;
	  	$link = get_permalink($storyid);
		$stories_author = get_post_meta( $storyid, 'stories_author', true );
		$stories_title = get_post_meta( $storyid, 'stories_title', true );
		$stories_content = get_post_meta( $storyid, 'stories_content', true );
		
		if($a['showtitle']=='true'){ $output .= '<p id="story'.$u.'-title" ><a href="'.$link.'" class="title"><strong>'.$stories_title.'</strong></a></p>'; }
		if($a['truncate']>0){
			$output .= '<p id="story'.$u.'" class="story" >'.shortenstory($quote, $a['truncate']);
			if($a['readmore']=='true' && strlen($quote) > $a['truncate']){	
				$output .= ' <a href="'.$link.'" class="title">Read More</a>';
			}else{
				$output .= '&#8221;';
			}
		}else{
			$output .= '<p id="story'.$u.'" class="story" >'.$quote;
		}
        $output .= '</p><p class="author">&mdash; '.$stories_author.'</p>';
		$u++;
	}
	$output .= '</div>';

	return $output; 
	  
}
add_shortcode( 'getstories', 'getstories_func' );

add_action( 'admin_init', 'stories_create' );
add_filter ('manage_edit-stories_columns', 'stories_edit_columns');
add_action ('manage_posts_custom_column', 'stories_custom_columns');
add_action ('save_post', 'save_stories');
add_filter('post_updated_messages', 'stories_updated_messages');

?>