<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package abetteryou
 */

?>
<div id="bot">
    <div class="container">
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="row">
                <div id="upcoming-events" class="col-xs-12 col-md-6 pull-right">
                    <div id="footer-events-container">
                        <h3>Upcoming Events & Seminars</h3>
                        <?php

                        $eventlist = get_posts(array(
                            'posts_per_page' => 4,
                            'offset'         => 0,
                            'order'          => 'ASC',
                            'orderby'        => 'meta_value',
                            'meta_key'       => 'events_start_date',
                            'post_type'      => 'events',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                'relation' => 'OR',
                                array(
                                    'key'     => 'events_start_date',
                                    'value'   => date('Ymd'),
                                    'compare' => '>=',
                                ),
                                array(
                                    'key'     => 'events_end_date',
                                    'value'   => date('Ymd'),
                                    'compare' => '>=',
                                ),
                            ),
                        ));

                        $u = 1;
                        foreach ($eventlist as $event) {
                            $id          = $event->ID;
                            $title       = $event->post_title;
                            $custom_link = get_field('custom_link', $id);
                            if ($custom_link != '') {
                                $link = $custom_link;
                            } else {
                                $link = get_permalink($id);
                            }
                            $start_date = strtotime(get_post_meta($id, 'events_start_date', true));
                            $start_time = strtotime(get_post_meta($id, 'events_start_time', true));
                            $end_date   = strtotime(get_post_meta($id, 'events_end_date', true));
                            $end_time   = strtotime(get_post_meta($id, 'events_end_time', true));
                            $recur      = get_post_meta($id, 'events_recur', true);
                            $location   = get_post_meta($id, 'events_location', true);
                            $category   = wp_get_post_terms($id, 'event-type', array("fields" => "names"));
                            $region     = wp_get_post_terms($id, 'event-region', array("fields" => "names"));
                            $new_date   = '';
                            $maxchar    = 42;

                            if (strlen($title) > $maxchar) {
                                $title = substr($title, 0, strrpos(substr($title, 0, $maxchar), ' ')) . '...';
                            }

                            if (in_array('Foster Home Training', $category)) {
                                $link = '/services/foster-adopt/adoption-services/adoption-foster-care-training-schedule/';
                            }
                            if (in_array('Mental Health First Aid', $category)) {
                                $link = '/events/mental-health-first-aid-seminars/';
                            }

                            if ($start_date != $end_date) {
                                if ($recur == 'none') {
                                    $fulldate = date('M j', $start_date) . ' &ndash; ' . date('M j', $end_date);
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }
                                }
                                if ($recur == 'weekly') {
                                    $fulldate = date('l', $start_date) . 's, ' . date(
                                        'M j',
                                            $start_date
                                    ) . ' &ndash; ' . date('M j', $end_date);
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }
                                    if (date('Ymd', $start_date) < date('Ymd')) {
                                        $new_date = advancedate(date('Ymd', $start_date), "+1 week");
                                    }
                                }

                                if ($recur == 'daily') {
                                    $fulldate = 'Every day, ' . date('M j', $start_date) . ' &ndash; ' . date(
                                        'M j',
                                            $end_date
                                    );
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }
                                    $new_date = date('Ymd');
                                }
                            } else { //no end date or end same as start date

                                if ($recur == 'none') {
                                    $fulldate = date('M j', $start_date);
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }
                                }
                                if ($recur == 'weekly') {
                                    $fulldate = date('l', $start_date) . 's, ' . date('M j', $start_date);
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }

                                    if (date('Ymd', $start_date) < date('Ymd')) {
                                        $new_date = advancedate(date('Ymd', $start_date), "+1 week");
                                    }
                                }

                                if ($recur == 'daily') {
                                    $fulldate = 'Every day, ' . date('M j, Y', $start_date);
                                    if ($start_time != '') {
                                        $fulldate .= ', ' . date('g:i a', $start_time);
                                    }
                                    if ($end_time != '' && $end_time != $start_time) {
                                        $fulldate .= ' &ndash; ' . date('g:i a', $end_time);
                                    }
                                    $new_date = date('Ymd');
                                }
                            }

                            if ($new_date == '') {
                                $new_date = $start_date;
                            }

                            echo '<div id="event' . $u . '" class="event-row row" >';
                            echo '<div class="event-tab">';
                            echo '<div class="date-tab pull-left"><span class="month">' . date(
                                'M',
                                    $new_date
                            ) . '</span><span class="day">' . date('d', $new_date) . '</span></div>';
                            echo '<a style="padding: 4px 0" href="' . $link . '" class="title">' . $title . '<br><span class="fulldate">' . $location . '</span><br><span class="fulldate">' . $fulldate . '</span></a>';
                            echo '</div>';
                            echo '</div>';
                            $u++;
                        }

                        ?>
                        <a class="fulllink" href="/events/">Full Event Calendar</a>
                    </div>
                </div>
                <div id="footer-nav" class="col-xs-12 col-md-6">
                    <div id="footer-nav-container" class="text-center">
                        <?php
                        $footernav = array(
                            'theme_location'  => 'footer',
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
                        wp_nav_menu($footernav);
                        ?>
                    </div>
                </div>
                <div id="location" class="text-center col-xs-12 col-md-6">
                    <?php echo get_field('location_box', 6); ?>
                    <a class="fulllink" href="/about-us/locations/">View All Locations</a>
                </div>
                <div id="socialmedia" class="text-center col-xs-12 col-md-6">
                    <p><a href="https://www.linkedin.com/company/life-management-center-of-nw-florida-inc-"
                          target="_blank"><img src="<?php echo get_template_directory_uri() ?>/img/linkedin.png"
                                               alt="Connect with us on LinkedIn"/></a><a
                                href="https://www.facebook.com/lifemanagementcenter/?fref=ts" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() ?>/img/facebook.png"
                                    alt="Like us on Facebook"/></a><a
                                href="https://twitter.com/LmcCares?ref_src=twsrc%5Etfw" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() ?>/img/twitter.png"
                                    alt="Follow us on Twitter"/></a><a
                                href="https://plus.google.com/105590141144034467922/about" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() ?>/img/googleplus.png"
                                    alt="Find us on Google+"/></a></p>
                </div>
            </div>
            <div id="footer-logo" class="col-xs-12 text-center">
                <img src="<?php echo get_template_directory_uri() ?>/img/logo-white.png"
                     alt="Life Management Center of Northwest Florida" class="img-responsive center-block"/>
            </div>
            <div id="partner-logos" class="col-xs-12 text-center center-block">
                <img src="<?php echo get_template_directory_uri() ?>/img/united-way.png" alt="United Way"/>
                <img src="<?php echo get_template_directory_uri() ?>/img/fldcf-logo.png"
                     alt="Florida Department of Children & Families"/>
                <img src="<?php echo get_template_directory_uri() ?>/img/big-bend-logo.png"
                     alt="Big Bend Community Based Care"/>
                <img src="<?php echo get_template_directory_uri() ?>/img/carf-logo.png" alt="Sapphire Award"
                     class="pull-left remove-pull"/>
                <img src="<?php echo get_template_directory_uri() ?>/img/sapphire-award.png" alt="Carf Accredited"
                     class="pull-right remove-pull"/>
            </div>
        </footer><!-- #colophon -->
    </div>
</div>
<div id="bot-bot">
    <div class="container">
        <div id="emergency-contact-2" class="col-xs-12 col-md-5 pull-right remove-pull">
            <div class="col-sm-6 col-md-6 col-lg-7">
                <p>Mental Health Emergency:</p>
            </div>
            <div class="col-sm-4 col-md-6 col-lg-5 text-center">
                <a id="footer-phone" href="tel:8505224485">850-522-4485</a>
            </div>
        </div>
        <div id="copyright-area" class="col-md-7">
            <p class="copyright">&copy;<?php echo date('Y'); ?> Life Management Center. All rights reserved. | <a href="http://lmccares.org/sitemap_index.xml">Sitemap</a> <span
                        class="siteby"><img src="<?php echo get_template_directory_uri() ?>/img/kma.png"
                                            alt="Site by Kerigan Marketing Associates"/>Site by <a
                            href="http://keriganmarketing.com" target="_blank">KMA.</a></span></p>
        </div>
    </div>
</div>
</div><!-- #page -->
<script async src='https://tag.simpli.fi/sifitag/4df59290-f261-0135-e438-06659b33d47c'></script>
<script async
        src="https://i.simpli.fi/dpx.js?cid=60215&conversion=40&campaign_id=0&m=1&tid=View_Through&sifi_tuid=33473"></script>
<script async
        src="https://i.simpli.fi/dpx.js?cid=60215&action=100&segment=cnhi1lifemanagementsitepixel&m=1&sifi_tuid=33446"></script>
<?php wp_footer(); ?>

</body>
</html>
