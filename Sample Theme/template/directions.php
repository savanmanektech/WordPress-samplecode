<?php
/*
  Template Name: Directions
 */

get_header();
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
$url = $src[0];
$meta = get_post_meta($post->ID);
$color = ($meta['banner_text_color'][0] != '') ? $meta['banner_text_color'][0] : '#FFF';
$feature =  @$meta['featured_image_or_featured_video'][0]; 
if($feature == 'video'){

$vid = $meta['featured_video'] [0];
     $video_url = wp_get_attachment_url( $vid );    ?>
    <div class="home-slider" style="position:fixed;">
    <video  autoplay  loop>
        <source src="<?php echo $video_url; ?>" type="video/mp4" />
    </video>  
    
    <div class="fix-title"> <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php the_title(); ?></h1>
            </div>
    </div>
    </div>
<?php }else{ ?>

 <div class="home-slider" style="position:fixed;">
<div class="inner_top_banner" style="background: url('<?php echo $url; ?>') no-repeat center">
    <div class="overlay_up">
        <div class="middel_sect">
            <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
    <a class="godown_btn" href="#second_section">
        <img src="<?php echo get_template_directory_uri(); ?>/images/down-aroow.png">
    </a>
</div>
</div>

<?php } ?>
<!-- inner page start -->
<div class="inner_page direction_page" id="second_section" style="position: relative; top: 100vh; background: rgb(255, 255, 255) none repeat scroll 0% 0%; z-index: 1;">
    <div class="container">
        <div class="row">
            <div class="direction_listing">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="side_bar_left">
                        <h2><?php echo _e("DIRECTIONS", 'buchan_theme'); ?></h2>

                        <div class="side_menu">

                            <?php
                            /*  wp_nav_menu( array(
                              'menu' => 'Directions menu'
                              ) ); */
                            ?>			
                            <div class="col-xs-4 col-sm-12">				
                                <span class="small_line"></span>

                                <ul class="ajax_nav">
                                    <?php
                                    $menu_name = 'directionsmenu';

                                    if (( $locations = get_nav_menu_locations() ) && isset($locations[$menu_name])) {
                                        $menu = wp_get_nav_menu_object($locations[$menu_name]);

                                        $menu_items = wp_get_nav_menu_items($menu->term_id);


                                        $name = array('thought', 'symposiumseries', 'article', 'subscribe');
                                        $count = 0;
                                        foreach ((array) $menu_items as $key => $menu_item) {
                                            $title = $menu_item->title;

                                            $url = $menu_item->url;
                                            ?>
                                            <li class="showbtn">						
                                                <a href="javascript:void(0)" class="<?php echo $menu_item->classes[0]; ?>" data-term="<?php echo $title; ?>" data-type="<?php echo $name[$count]; ?>" data-load="true"><?php echo $title; ?></a>
                                            </li>
                                            <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                    <li class="showbtn"><a class="subscribe_content" href="<?php echo get_permalink(197);
                                    ; ?>" data-show=".studio-<?php echo $name[3]; ?>" data-section=".<?php echo $name[3]; ?>_detail"><?php echo get_the_title(197); ?></a></li>
                                </ul>
                            </div>

                            <div class="col-xs-4 col-sm-12">

                                <span class="small_line"></span>
                                <ul class="ajax_nav">										
                                    <?php
                                    global $wpdb;
                                    $years = $wpdb->get_results("SELECT DISTINCT YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'thought' GROUP BY year ORDER BY post_date DESC");

                                    foreach ($years as $year) {
                                        echo '<li><a data-term="thlink" data-type="thought" data-load="true" data-val="' . $year->year . '" href="javascript:void(0)">' . $year->year . '</a></li>';
                                    }
                                    ?>									
                                </ul>  
                            </div>
                    <!-- <span class="small_line"></span>
                    <ul>
                            <?php
                            $args = array('post_type' => 'thought', 'posts_per_page' => -1);
                            $query = new WP_Query($args);
                            while ($query->have_posts()) {
                                $query->the_post();
                                echo '<li><a href="#' . $post->post_name . '">';
                                the_title();
                                echo '</a></li>';
                            }  //wp_reset_postdata();  
                            ?>									
                            </ul> --> 								
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="studio_right_cont">	
                        <div id="main">		
                            <h2><?php echo _e("THOUGHTS", 'buchan_theme'); ?></h2>
                            <div class="line_tag"></div>									
                            <?php
                            global $post;
                            $args = array('post_type' => 'thought', 'posts_per_page' => -1);
                            $query = new WP_Query($args);
                            $GLOBALS['wp_query'] = $query;
                            wp_localize_script('ajax-pagination', 'ajaxpagination', array(
                                'ajaxurl' => admin_url('admin-ajax.php').'?lang='.@$_GET['lang'],
                                'query_vars' => json_encode($query->query)
                            ));
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('content', get_post_type());
                            }  //wp_reset_postdata();  
                            ?>						
                        </div>	

                        <div class="studio_middel">
                            <div class="studio-single-section subscribe_detail subscribe-detail" style="display:none;">
                                <h2><?php echo _e("SUBSCRIBE", 'buchan_theme'); ?></h2>
                                <div class="line_tag"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><?php echo _e("For regular updates on the progress of our projects, studio updates and announcements, enter your details below.", 'buchan_theme'); ?></p>                                          

<?php echo do_shortcode('[contact-form-7 id="251" title="Subscriber"]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Search Button Script Start-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>

<script type="text/javascript">

    $(".subscribe_content").on('click', function () {
        $("#main").html('');
    });

    $('.showbtn a').on('click', function () {

        $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
        $($(this).attr('data-show')).show();

        $('.studio-single-section').hide();
        $('.studio-single-section' + $(this).attr('data-section')).show();

    });


// change is-checked class on buttons
    $('.button-group').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });


// debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }
            function delayed() {
                fn();
                timeout = null;
            }
            setTimeout(delayed, threshold || 100);
        };
    }

    jQuery(document).on('scroll', function () {
        if (jQuery(window).width() > 767) {
            var t = jQuery("#second_section").position().top;
            if (jQuery(window).scrollTop() > t - 62) {
                jQuery(".side_bar_left").addClass("dofix");
            } else {
                jQuery(".side_bar_left").removeClass("dofix");
            }
            //
        } else {
            jQuery(".side_bar_left").removeClass("dofix");
        }
    });
    //Click event to godown_btn
    $(document).ready(function () {
        $('.godown_btn').click(function () {
            var targetDiv = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(targetDiv).offset().top - 60
            }, 800);

            return false;
        });
        if (window.location.hash == '#list') {
            var targetDiv = $('.godown_btn').attr('href');

            $('html, body').animate({
                scrollTop: $(targetDiv).offset().top - 60

            }, 800);
            jQuery('.side_menu ul li a.shw').trigger('click');
            return false;
        }

        //jQuery(function() {
    });

    var mobileHover = function () {
        $('*').on('touchstart', function () {
            $(this).trigger('hover');
        }).on('touchend', function () {
            $(this).trigger('hover');
        });
    };
    mobileHover();
    $(document).ready(function () {
        var h = $(window).height();
        $(".inner_top_banner").css({'height': h});
    });
    $(window).resize(function () {
        var h = $(window).height();
        $(".inner_top_banner").css({'height': h});
    });
</script>

<?php get_footer(); ?>