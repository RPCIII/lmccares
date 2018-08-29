<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package abetteryou
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri() ?>/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri() ?>/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if(is_page(47)){ ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&language=en&key=AIzaSyDYhV1LJRnx3PYaGXRnBr8OEmb0iyii358"></script> 
<?php } ?>
<?php wp_head(); ?>
<script type="text/javascript">
    (function(a,e,c,f,g,h,b,d){var
        k={ak:"877187660",cl:"nec_CIXAlHMQzKSjogM",autoreplace:"850-522-4485."};a[c]=a[c]|
        |function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||
    (a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new
    Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'abetteryou' ); ?></a>
	<div id="sticky">
	<div id="top-top" >
    	<div class="container">
        	<div id="mini-navbar" class="text-center">
				<?php 
                $mininav = array(
                    'theme_location'  => 'mini',
                    'menu'            => '',
                    'container'       => 'div',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="nav">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );
                wp_nav_menu( $mininav );
                ?>
			</div>
		</div>
	</div>
	<div id="top">
		<div class="container">
			<header id="masthead" class="site-header" >
            <div class="row">
            	<div id="emergency-contact" class="col-sm-7 col-md-3 text-right pull-right">
                	<p>Mental health emergency: <a class="clicktocall" href="tel:850-522-4485" >850-522-4485</a></p>
                </div>
                <div id="logo" class="col-sm-5 col-md-3" >
                	<a href="/"><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="Life Management Center" class="img-responsive center-block" /></a>
                </div>
                <div id="main-nav" class="col-xs-12 col-md-6">
                    <nav class="navbar navbar-info" >
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-collapse" aria-expanded="false">
                                    <span class="visible-xs visible-sm"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Full Menu</span>
                                </button>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="header-collapse">
                            <?php 
                            $mainnav = array(
                                'theme_location'  => 'primary',
                                'menu'            => '',
                                'container'       => 'div',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'menu',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav">%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => ''
                            );
                            
                            wp_nav_menu( $mainnav );
                            ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
			</header>
		</div>
	</div> 
    </div>
    <div class="clearfix"></div>  