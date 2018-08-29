<?php
/*
Plugin Name: Job System Plugin by KMA
Description: Job System plugin for use with KMA sites. 
*/

// Add scripts to wp_head()
function jobs_to_head() {
	
}
add_action( 'wp_head', 'jobs_to_head' );
 
add_action( 'init', 'create_jobs_cpt' );
 
function create_jobs_cpt(){
	register_post_type( 'jobs', array(
	  'labels'             => array(
		  'name' 		         => _x( 'Jobs', 'post type general name' ),
		  'singular_name'      => _x( 'Job', 'post type singular name' ),
		  'menu_name'          => _x( 'Jobs', 'admin menu', 'palmbay' ),
		  'name_admin_bar'     => _x( 'Jobs', 'add new on admin bar' ),
		  'add_new'            => _x( 'Add New', 'job' ),
		  'add_new_item'       => __( 'Add New Job' ),
		  'new_item'           => __( 'New Job' ),
		  'edit_item'          => __( 'Edit Job' ),
		  'view_item'          => __( 'View Job' ),
		  'all_items'          => __( 'All Jobs' ),
		  'search_items'       => __( 'Search Jobs' ),
		  'parent_item_colon'  => __( 'Parent Job:' ),
		  'not_found'          => __( 'No jobs found.' ),
		  'not_found_in_trash' => __( 'No jobs found in Trash.' )
	  ),
	  'public'             => true,
	  'publicly_queryable' => true,
	  'show_ui'            => true,
	  'show_in_menu'       => true,
	  'query_var'          => true,
	  //'rewrite' => false,
	  'rewrite'            => array( 'slug' => 'employment-opportunities', 'with_front' => FALSE ),
	  'capability_type'    => 'post',
	  'has_archive'        => false,
	  'hierarchical'       => false,
	  'menu_position'      => null,
	  'supports'           => array( 'title' )
	));
		
	register_taxonomy( 'job-type', 'jobs', 
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
		'rewrite'           => array( 'slug' => 'job-type' ),
	  ) 
	);
}
function jobs_meta () {
 
	// - grab data -
	 
	global $post;
	$custom = get_post_custom($post->ID);
	$jobstitle = $custom["jobs_title"][0];
	$jobslocation = $custom["jobs_location"][0];
	$jobsappdeadline = $custom["jobs_appdeadline"][0]; 
	$jobscontact = $custom["jobs_contact"][0]; 
	$jobsdescription = $custom["jobs_description"][0]; 
	$jobsqualifications = $custom["jobs_qualifications"][0]; 
	$jobspay = $custom["jobs_pay"][0]; 
	$jobsextra = $custom["jobs_extra"][0];

	// - security -
	 
	echo '<input type="hidden" name="jobs-nonce" id="jobs-nonce" value="' .
	wp_create_nonce( 'jobs-nonce' ) . '" />';
	 
	// - output -
	 
	//wp_nonce_field(plugin_basename(__FILE__), 'job_file_nonce');
	$pdffile = get_post_meta( get_the_ID(), 'job_file', true );	
	$job_file = $pdffile['url'];

	?>
    
    <div class="jobs-meta">
    <table width="100%" ><tr><td width="160">Upload Job Description</td>
    <td colspan="2"><input type="file" id="job_file" name="job_file" value="" size="25" ></td></tr>
    <?php if($job_file != ""){ ?>
    <tr><td>Current file</td><td><?php echo $job_file; ?></td><td><a href="<?php echo $job_file; ?>" target="_blank" class="button" >View/download current file</a></td></tr>
    <?php } ?>
    </table></div>
	<div class="jobs-meta">
	<table width="100%" >
    <tr>
    <td width="140"><label>Job Title</label></td><td><input name="jobs_title" class="text" value="<?php echo $jobstitle; ?>" style="width:100%" /></td>
    </tr><tr>
	<td><label>Job Location</label></td><td><input name="jobs_location" class="text" value="<?php echo $jobslocation; ?>" style="width:100%" /></td>
    </tr><tr>
	<td><label>Application Deadline</label></td><td><input name="jobs_appdeadline" class="text" value="<?php echo $jobsappdeadline; ?>" style="width:100%" /></td>
	</tr><tr>
	<td><label>Contact Person</label></td><td><?php wp_editor( htmlspecialchars_decode($jobscontact), 'kma_jobs_contact', array('textarea_name'=>'jobs_contact','media_buttons'=>false,'textarea_rows'=>'4','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>true,'media_buttons'=>false) ); ?></td>
	</tr><tr>
	<td><label>Job Description</label></td><td><?php wp_editor( htmlspecialchars_decode($jobsdescription), 'kma_jobs_description', array('textarea_name'=>'jobs_description','media_buttons'=>false,'textarea_rows'=>'10','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>false,'media_buttons'=>false) ); ?></td>
	</tr><tr>
	<td><label>Qualifications</label></td><td><?php wp_editor( htmlspecialchars_decode($jobsqualifications), 'kma_jobs_qualifications', array('textarea_name'=>'jobs_qualifications','media_buttons'=>false,'textarea_rows'=>'10','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>false,'media_buttons'=>false) ); ?></td>
	</tr><tr>
	<td><label>Compensation</label></td><td><?php wp_editor( htmlspecialchars_decode($jobspay), 'kma_jobs_pay', array('textarea_name'=>'jobs_pay','media_buttons'=>false,'textarea_rows'=>'4','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>false,'media_buttons'=>false) ); ?></td>
	</tr><tr>
	<td><label>Additional Info (optional)</label></td><td><?php wp_editor( htmlspecialchars_decode($jobsextra), 'kma_jobs_extra', array('textarea_name'=>'jobs_extra','media_buttons'=>false,'textarea_rows'=>'6','quicktags'=>false,'drag_drop_upload'=>false,'teeny'=>false,'media_buttons'=>false) ); ?></td>
	</tr>
    </table>
	</div>
	<?php
}

function job_file() {  
    wp_nonce_field(plugin_basename(__FILE__), 'job_file_nonce');
	$pdffile = get_post_meta( $post_id, 'job_file', true );
    $html = '<div class="jobs-meta">';
    $html .= '<table width="100%" ><tr><td width="160">Upload Job Description</td>';
    $html .= '<td colspan="2"><input type="file" id="job_file" name="job_file" value="" size="25" ></td></tr>';
	
	$filearray = get_post_meta( get_the_ID(), 'job_file', true );
	$this_file = $filearray['url'];
	if($this_file != ""){
	   $html .= '<td>Current file</td><td>' . $this_file . '</td><td><a href="' . $this_file . '" target="_blank" class="button" >View/download current file</a></td></table></div>';
	}

	$html .= '</div>';
    echo $html;
}

function jobs_create() {
    add_meta_box('jobs_meta', 'Job Information', 'jobs_meta', 'jobs', 'normal', 'high');
	//add_meta_box('job_file', 'Job PDF File', 'job_file', 'jobs', 'normal', 'high'); 
}

function jobs_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Post Name",
		"jobs_title" => "Job Title",
		"jobs_location" => "Location",
		"jobs_appdeadline" => "Application Deadline",
		"jobs_contact" => "Contact Person",
		"jobs_description" => "Description",
		"jobs_qualifications" => "Qualifications",
		"jobs_pay" => "Compensation",
		"jobs_extra" => "Extra Info",
		"jobs_cat" => "Category",
	);
	return $columns;
}
	 
function jobs_custom_columns($column){
	global $post;
	$custom = get_post_custom();
	
	switch ($column){
	case "jobs_cat":
		// - show taxonomy terms -
		$jobscats = get_the_terms($post->ID, "job-type");
		$jobscats_html = array();
		if ($jobscats) {
			foreach ($jobscats as $jobscat)
			array_push($jobscats_html, $jobscat->name);
			echo implode($jobscats_html, ", ");
		} 
	break;
	case "jobs_title":
		// - show dates -
		$jobstitle = $custom["jobs_title"][0];
		echo $jobstitle;
	break;
	case "jobs_location":
		// - show times -
		$jobslocation = $custom["jobs_location"][0];
		echo $jobslocation;
	break;
	case "jobs_appdeadline":
		// - show times -
		$jobsappdeadline = $custom["jobs_appdeadline"][0];
		echo $jobsappdeadline;
	break;
	case "jobs_contact":
		// - show times -
		$jobscontact = $custom["jobs_contact"][0];
		echo $jobscontact;
	break;
	case "jobs_description":
		// - show times -
		$jobsdescription = $custom["jobs_description"][0];
		echo $jobsdescription;
	break;
	case "jobs_qualifications":
		// - show times -
		$jobsqualifications = $custom["jobs_qualifications"][0];
		echo $jobsqualifications;
	break;
	case "jobs_pay":
		// - show times -
		$jobspay = $custom["jobs_pay"][0];
		echo $jobspay;
	break;
	case "jobs_extra":
		// - show times -
		$jobsextra = $custom["jobs_extra"][0];
		echo $jobsextra;
	break;

	 
	}
}
  

function save_jobs(){
 
	global $post;
	 
	// - still require nonce
	 
	if ( !wp_verify_nonce( $_POST['jobs-nonce'], 'jobs-nonce' )) {
		return $post->ID;
	}
	 
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	 
	// - convert back to unix & update post
	 
	if(!isset($_POST["jobs_title"])):
	return $post;
	endif;
	$updatetitle = $_POST["jobs_title"];
	update_post_meta($post->ID, "jobs_title", $updatetitle );	
	 
	if(!isset($_POST["jobs_location"])):
	return $post;
	endif;
	$updatelocation = $_POST["jobs_location"];
	update_post_meta($post->ID, "jobs_location", $updatelocation );
	 
	if(!isset($_POST["jobs_appdeadline"])):
	return $post;
	endif;
	$updateappdeadline = $_POST["jobs_appdeadline"];
	update_post_meta($post->ID, "jobs_appdeadline", $updateappdeadline );
	
	if(!isset($_POST["jobs_contact"])):
	return $post;
	endif;
	$updatecontact = $_POST["jobs_contact"];
	update_post_meta($post->ID, "jobs_contact", $updatecontact );
	
	if(!isset($_POST["jobs_description"])):
	return $post;
	endif;
	$updatedescription = $_POST["jobs_description"];
	update_post_meta($post->ID, "jobs_description", $updatedescription );
	
	if(!isset($_POST["jobs_qualifications"])):
	return $post;
	endif;
	$updatequalifications = $_POST["jobs_qualifications"];
	update_post_meta($post->ID, "jobs_qualifications", $updatequalifications );
	
	if(!isset($_POST["jobs_pay"])):
	return $post;
	endif;
	$updatepay = $_POST["jobs_pay"];
	update_post_meta($post->ID, "jobs_pay", $updatepay );
	
	if(!isset($_POST["jobs_extra"])):
	return $post;
	endif;
	$updateextra = $_POST["jobs_extra"];
	update_post_meta($post->ID, "jobs_extra", $updateextra );
	
	 if(!empty($_FILES['job_file']['name'])) {
        $supported_types = array('application/pdf');
        $arr_file_type = wp_check_filetype(basename($_FILES['job_file']['name']));
        $uploaded_type = $arr_file_type['type'];

        if(in_array($uploaded_type, $supported_types)) {
            $upload = wp_upload_bits($_FILES['job_file']['name'], null, file_get_contents($_FILES['job_file']['tmp_name']));
            if(isset($upload['error']) && $upload['error'] != 0) {
                wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
            } else {
				add_post_meta($post->ID, 'job_file', $upload);
                update_post_meta($post->ID, 'job_file', $upload);
            }
        }
        else {
            wp_die("The file type that you've uploaded is not a PDF.");
        }
    }
	
}

function jobs_updated_messages( $messages ) {
 
  global $post, $post_ID;
 
  $messages['jobs'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Job updated. <a href="%s">View item</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Job updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Job restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Job published. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Job saved.'),
    8 => sprintf( __('Job submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Job scheduled to post on: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview member</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Job draft updated. <a target="_blank" href="%s">Preview member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
 
  return $messages;
}

// [getjobs category="" linkto="self,file" orderby="" show="activeonly"]
function getjobs_func( $atts, $content = null ) {
	$debugjobs = FALSE;
	
    $a = shortcode_atts( array( //define shortcode arguments
        'linkto' => 'self', //default to open self as single-{post typpe here}.php // use "file" to open uploaded job app
        'category' => '', //blank by default
		'orderby' => 'menu_order', //default by menu order (use a plugin to enable drag n' drop)
		'show' => 'activeonly', //use all to show expired jobs
    ), $atts );
	
	if($debugjobs){
		$output = '<p>linkto = '.$a['linkto'].', category = '.$a['category'].', show = '.$a['show'].', orderby = '.$a['orderby'].'</p>';
	}else{
		$output = '';
	}
	
	$request = array( //create basic post request
		  'posts_per_page'   => -1,
		  'offset'           => 0,
		  'order'            => 'ASC',
		  'orderby'   		 => $a['orderby'],
		  'post_type'        => 'jobs',
		  'post_status'      => 'publish',	  
	);
	
	if($a['show'] == 'activeonly'){ //filter to only job apps that have not expired
		$metaarray = array(
			'relation'		=> 'AND',
			array(
				'key'	  	=> 'jobs_appdeadline',
				'value'	  	=> date('Ymd'),
				'compare' 	=> '>=',
			), 
		);
		$request['meta_query'] = $metaarray;
	
	}else{
		//dont need to filter if we're going to show everything :P
	}
	  
	if($a['category']!= ''){ //add to post request IF category is not blank
		$taxarray = array(
			array(
				'taxonomy' => 'job-type',
				'field' => 'slug',
				'terms' => $a['category'],
				'include_children' => false,
			),
		);
		$request['tax_query'] = $taxarray;
	}
		
	if($debugjobs){
		print_r($request);
	}
		
	$joblist = get_posts( $request );
	
	$u = 1;
	
	$output = '<div class="job-list">';
	foreach($joblist as $job){	  
		$jobid = $job->ID;  
		$title = $job->post_title;
	  	$link = get_permalink($jobid);
		$jobs_appdeadline = get_post_meta( $jobid, 'jobs_appdeadline', true );
		$jobs_location = get_post_meta( $jobid, 'jobs_location', true );
		$job_file = get_post_meta( $jobid, 'job_file', true ); 
		
		if($a['linkto'] == 'file'){
			if($job_file['url']!=''){
				$link = $job_file['url'];	
			}else{
				$link = '';
			}
		}
		
		$output .= '<p id="job'.$u.'" class="job" >';
		
		if($link != ''){	
			$output .= '<a href="'.$link.'" '; 
			if($a['linkto'] == 'file'){ $output .= 'target="_blank" '; }
			$output .= 'class="title">';
		}
		$output .= '<strong>'.$title.'</strong>';
		if($link != ''){	
			$output .= '</a>';
		}
		
		if($jobs_location != ''){ $output .= '<br><em>'.$jobs_location.'</em>'; }
		if($jobs_appdeadline != ''){ $output .= '<br>Application Deadline: '.$jobs_appdeadline; }
		$output .= '</p>';
		$u++;
	}
	$output .= '</div>';

	return $output; 
	  
}
add_shortcode( 'getjobs', 'getjobs_func' );

function update_edit_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');

add_action( 'admin_init', 'jobs_create' );
add_filter ('manage_edit-jobs_columns', 'jobs_edit_columns');
add_action ('manage_posts_custom_column', 'jobs_custom_columns');
add_action ('save_post', 'save_jobs');
add_filter('post_updated_messages', 'jobs_updated_messages');

?>