<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package abetteryou
 */

get_header(); ?>
    <div id="mast" class="support"></div>
    <div class="clearfix"></div>
    <div id="mid" class="support">
        <div class="container">
            <div id="primary" class="content-area col-sm-offset-1 col-xs-12 col-sm-10 pull-right">
                <main id="main" class="site-main" role="main">

                    <section class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'abetteryou' ); ?></h1>
                        </header><!-- .page-header -->
        
                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'abetteryou' ); ?></p>
        
                            <?php get_search_form(); ?>
        
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->

				</main><!-- #main -->
            </div><!-- #primary -->
            
        </div>
    </div>
<?php get_footer(); ?>
