<?php
/**
 * The template for displaying all pages.
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
        
                    <?php while ( have_posts() ) : the_post(); ?>
        				
                        <?php get_template_part( 'template-parts/content', 'page' ); ?>
        
                    <?php endwhile; // End of the loop. 
					
					 
					$args = array( 
						'post_type'        => 'location',
						'posts_per_page'	=> -1,
						'offset'			=> 0,
						'post_status'		=> 'publish'
					);
					
					$locations = get_posts( $args );
					
					?>
                    
                    <div id="map" style="height:540px; max-height:90%;"></div>
    		
					<script type="text/javascript">		
                      function initialize() {
                          var myLatlng = new google.maps.LatLng(30.363516, -85.554483);
                          var bounds = new google.maps.LatLngBounds();
                          var mapOptions = {
                              zoom: 9,
                              center: myLatlng
                          }
                          var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                          
                          //var addresses = [<?php //echo $addressArray; ?>];
                                          
                          /*function bindInfoWindow(marker, map, infowindow, html, id, lat, lng, title) {
                              google.maps.event.addListener(marker, 'click', function() {
                                  infowindow.setContent(html);
                                  infowindow.open(map, marker);
                              });
                              //console.log("marker "+ id + ": "+ title + " " +lat+ ", " +lng);
                          } */
                          
            
                              
                         /*var image = {
                            url: '<?php echo get_template_directory_uri() ?>/img/office-pin.png',
                            size: new google.maps.Size(23, 27),
                            origin: new google.maps.Point(0,0),
                            anchor: new google.maps.Point(0,20)
                          };*/
                                        
                        <?php
                        
                        foreach ( $locations as $location ){
                            $id = $location->ID; 
                            $photo = get_field('location_photo', $id);
                            $address = get_field('address', $id);
                            $address2 = get_field('address_2', $id);
                            $latlng = get_field('latlng', $id);
                            $phone = get_field('phone_number', $id);
                    		$hours = get_field('hours', $id);
                            
                            echo 'var contentString'.$id.' = \'<div id="infowindow">\'+     							'."\r\n";
                            echo '	\'<img src="'.$photo['url'].'" class="office-photo" style="max-width:100%;" />\'+ 	'."\r\n";
                            echo '	\'<h2>'.$location->post_title.'</h2>\'+ 	 			'."\r\n";
                            echo '	\'<div id="address" class="col res-1">\'+											'."\r\n";
                            echo '	\'<p>'.$address.'<br>\'+																'."\r\n";
                            echo '	\''.$address2.'</p>\'+																'."\r\n";
                            echo '	\'</div>\'+																			'."\r\n";
                            if($phone != ''){ echo '	\'<strong>Phone:</strong> '.$phone.'</div>\'+     				'."\r\n"; }
							if($hours != ''){ echo '	\'<strong>Hours:</strong> '.$hours.'</div>\'+     				'."\r\n"; }
                            echo '	\'</div></div>\';     																'."\r\n";
                            
                            
                            echo 'var infowindow'.$id.' = new google.maps.InfoWindow({     								'."\r\n";
                            echo '	  maxWidth: 300,     																'."\r\n";
                            echo '	  content: contentString'.$id.'  													'."\r\n";
                            echo '});     																				'."\r\n";
                              
                            
                            echo 'var marker'.$id.' = new google.maps.Marker({     										'."\r\n";
                            echo '	position: new google.maps.LatLng('.$latlng.'),    			 						'."\r\n";
                            echo '	map: map,     																		'."\r\n";
                            echo '	title: \''.$location->post_title.'\'	   		  									'."\r\n";
                            //echo '	icon: image     																'."\r\n";
                            echo '});     																				'."\r\n";
                            
                            echo 'google.maps.event.addListener(marker'.$id.', \'click\', function() {     				'."\r\n";
                            echo '	infowindow'.$id.'.open(map, marker'.$id.');     									'."\r\n";
                            echo '});      																				'."\r\n";
                            
                        }
                        
                        ?>
                            }
                            /*function initialize() {	
                                console.log("map initialized");
                                startGeocodes();
                            }*/
                        
                            google.maps.event.addDomListener(window, 'load', initialize);
                        </script> 
        			<div id="content-bottom" class="locations" >
					<?php 
                    
                        foreach ( $locations as $location ){
                            $id = $location->ID; 
                            $photo = get_field('location_photo', $id);
                            $address = get_field('address', $id);
                            $address2 = get_field('address_2', $id);
                            $latlng = get_field('latlng', $id);
                            $phone = get_field('phone_number', $id);
							$hours = get_field('hours', $id);
							
                            echo '<div class="location col-sm-6">';		
                            echo '<h3>'.$location->post_title.'</h3>';
                            echo '<p style="margin-bottom:15px;">'.$address.'<br>';
                            echo $address2.'</p>';
							
							if($phone != '' || $hours != ''){ echo '<p>'; }
							if($phone != ''){ echo 'Phone: '.$phone.'<br>'; }
							if($hours != ''){ echo 'Hours: '.$hours.'<br>'; }
							if($phone != '' || $hours != ''){ echo '</p>';}
                            echo '<form action="http://maps.google.com/maps" method="get" target="_blank"><input name="saddr" type="hidden" value="" /><input name="daddr" type="hidden" value="'.strip_tags($address).'" /><input type="submit" value=" Get Directions " class="btn btn-primary" />&nbsp;</form>&nbsp;';
                            //echo '<form action="/patient-center/request-an-appointment/" method="get" ><input name="office" type="hidden" value="'.$location->post_title.'" /><input type="submit" value=" Request Appointment " />&nbsp;</form>';
                            echo '</div>';
                        }
                                
                    ?>
                    </div>
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