<?php
/*
  Template Name: Home Page
 */
get_header();
$meta = get_post_meta($post->ID);
$color = ($meta['banner_text_color'][0] != '') ? $meta['banner_text_color'][0] : '#FFF';
$feature = @$meta['featured_image_or_featured_video'][0];
if ($feature == 'video')
{
    $vid = $meta['featured_video'] [0];
    $video_url = wp_get_attachment_url($vid);
    ?>
    <div class="home-slider" style="position:fixed;">
        <video autoplay  loop>
            <source src="<?php echo $video_url; ?>" type="video/mp4" />
        </video> 
    </div>
        <?php }
        else
        { ?> ?>
    <!------- Home-slider Start ------->
    <div class="home-slider" style="position:fixed;">
        <div id="slider" class="owl-carousel owl-theme">
            <?php
            global $post;
            $args = array('post_type' => 'slider', 'category_name' => 'home');
            $myposts = get_posts($args);
            foreach ($myposts as $post) : setup_postdata($post);
                $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'slider-image');
                $url = $src[0];
                $link = get_post_meta(get_the_ID(), 'slider_link', true);
                ?>
                <div class="item"><a href="<?php echo ($link != '') ? $link : 'javascript:void(0)'; ?>">
                        <div class="home_slidercontent" style="background: url(<?php echo $url; ?>) no-repeat center">
                            <div class="homeslideroverlay">
                                <div class="homeslidertable">
                                    <div class="homesliderdisplay">
                                        <div class="container">
                                            <div class="homeslider_innercontent">
                                                <h1 style="color:<?php echo get_post_meta(get_the_ID(), 'slider_text_color', true); ?>"><?php echo get_post_meta(get_the_ID(), 'slider_title', true); ?> <span><?php echo get_post_meta(get_the_ID(), 'slider_sub_title', true); ?></span></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </div>			
        <?php //the_permalink();  ?>
    <?php endforeach;
    wp_reset_postdata();
    ?>
        </div>
        <div class="smoothscroll">
            <a class="godown_btn " href="#second_section">
                <img src="<?php echo get_template_directory_uri(); ?>/images/down-aroow.png">
            </a>
        </div>
    </div>
<?php } ?>
<!-------- Home-slider End -------->

<!-- news_listing start -->
<div class="news_listing_page" id="second_section" style="position:relative;top:100vh;background:#FFF;z-index:1">
    <div class="smoothscroll homearrow">
        <a class="godown_btn " href="#second_section">
            <img src="<?php echo get_template_directory_uri(); ?>/images/down-aroow.png">
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="news_list_midl">

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="side_bar_left ajax_nav">
                        <h2><?php echo _e('LATEST NEWS', 'buchan_theme'); ?></h2>

                        <div class="side_menu">
                            <div class="col-xs-4 col-sm-12">
                                <span class="small_line"></span>
                                <ul>
                                    <li><a class="active" href="javascript:void(0)" data-term="recent" data-type="news" data-load="true"><?php echo _e('MOST RECENT', 'buchan_theme'); ?> </a></li>
                                    <li><a href="javascript:void(0)" data-term="region" data-type="news" data-load="false"><?php echo _e('REGION', 'buchan_theme'); ?></a></li>
                                    <li><a href="javascript:void(0)" data-term="year" data-type="news" data-load="false"><?php echo _e('ARCHIVES', 'buchan_theme'); ?></a></li>
                                    <li><a href="javascript:void(0)" data-term="search" data-type="news" data-load="false"><?php echo _e('SEARCH', 'buchan_theme'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">		
                    <div id="main">						
                        <?php
                        global $post;
                        $args = array('post_type' => 'news', 'posts_per_page' => 5);
                        $query = new WP_Query($args);
                        $GLOBALS['wp_query'] = $query;
                        wp_localize_script('ajax-pagination', 'ajaxpagination', array(
                            'ajaxurl' => admin_url('admin-ajax.php') . '?lang=' . @$_GET['lang'],
                            'query_vars' => json_encode($query->query)
                        ));
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('content', get_post_type());
                        }  //wp_reset_postdata(); 
                        echo custom_nav();
                        /* the_posts_pagination( array(
                          'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
                          'next_text'          => __( 'Next page', 'twentyfifteen' ),
                          'type'=>'list'
                          ) ); */
                        ?>
                    </div>                         
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
    //var ajaxpagination = {"ajaxurl":"http:\/\/http://buchangroup.walkerdigitalweb.com.au\/wp-admin\/admin-ajax.php"};
        /* ]]> */
    </script>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            var owl = jQuery("#slider");
            owl.owlCarousel({
                items: 1, //10 items above 1000px browser width
                loop: true,
                dots: true,
                nav: false,
                navigation: true,
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                autoplay: true,
                touchDrag: true,
                paginationSpeed: 100,
                singleItem: true,
                mouseDrag: false,
                animateOut: 'fadeOut'
            });

        });
    </script>
    <!--Search Button Script Start-->
    <script type="text/javascript">

        /*	jQuery(window).scroll(function(){
         var h = jQuery(window).height();
         var top = jQuery(this).scrollTop();
         if((h-top) > 0){ 
         jQuery('#slider').css('margin-top', top);
         jQuery('#slider').css('height', h-top);
         }
     
         }); */

        /*   if (jQuery(window).width() > 767) { */
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
        jQuery(document).ready(function ($) {
            jQuery('.godown_btn').click(function () {
                var targetDiv = $(this).attr('href');
                jQuery('html, body').animate({
                    scrollTop: $(targetDiv).offset().top - 60
                }, 800);
                return false;
            });

            //jQuery(function() {
        });

        var mobileHover = function () {
            jQuery('*').on('touchstart', function () {
                jQuery(this).trigger('hover');
            }).on('touchend', function () {
                jQuery(this).trigger('hover');
            });
        };
        mobileHover();
        jQuery(document).ready(function () {
            var h = jQuery(window).height();
            jQuery(".home_slidercontent").css({'height': h});
        });
        jQuery(window).resize(function () {
            var h = jQuery(window).height();
            jQuery(".home_slidercontent").css({'height': h});
        });

        var minhl = jQuery(window).height() - 62;
        console.log(minhl);
        jQuery('.home .news_list_midl .col-md-9.col-sm-9.col-xs-12').css({'min-height': minhl});
    </script>


<?php get_footer(); ?>