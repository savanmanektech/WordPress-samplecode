<?php
/*
  Template Name: People
 */
get_header();

$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
$url = $src[0];
$meta = get_post_meta($post->ID);
$color = ($meta['banner_text_color'][0] != '') ? $meta['banner_text_color'][0] : '#FFF';
$feature = @$meta['featured_image_or_featured_video'][0];
if ($feature == 'video')
{
    $vid = $meta['featured_video'] [0];
    $video_url = wp_get_attachment_url($vid);
    ?>
    <div class="home-slider" style="position:fixed;">
        <video  autoplay  loop>
            <source src="<?php echo $video_url; ?>" type="video/mp4" />
        </video>  

        <div class="fix-title"> <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
<?php }
else
{ ?>

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
<div class="inner_page projects_page" id="second_section" style="position: relative; top: 100vh; background: rgb(255, 255, 255) none repeat scroll 0% 0%; z-index: 1;">
    <div class="container">
        <div class="row">
            <div class="projects_listing">

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="side_bar_left">
                        <h2>PEOPLE</h2>
                        <span class="small_line"></span>
                        <div class="side_menu">
                            <div class="search_box sidebar-single-bx">
                                <ul class="">
                                    <li class="project-page-sidebar-cat"><a class="active" data-filter=''>ALL</a></li>

                                    <li class="showbtn"><a data-show=".project-std"><?php echo _e("STUDIO", 'buchan_theme'); ?></a></li>		
                                    <li class="showbtn"><a data-show=".project-service"><?php echo _e("SERVICES", 'buchan_theme'); ?></a></li>
                                    <li class="showbtn"><a data-show=".project-sector"><?php echo _e("SECTOR", 'buchan_theme'); ?></a></li>

                                    <li class="prj-search-btn"><a data-sort="prtitle">SEARCH</a></li>
                                </ul>
                            </div>


                            <div class="project-service sidebar-single-bx"  style="display:none;">
                                <span class="small_line"></span>
                                <ul>
                                    <?php
                                    $terms = get_terms('people-category', array('hide_empty' => false));
                                    if (!empty($terms) && !is_wp_error($terms))
                                    {
                                        foreach ($terms as $term)
                                        {
                                            echo '<li class="project-page-sidebar-cat"><a class="' . $term->slug . '" data-filter=".' . $term->slug . '" href="javascript:void(0)">' . $term->name . '</a></li>';
                                        }
                                    }
                                    ?>   
                                </ul>
                            </div>



                            <div class="search_box sidebar-single-bx" style="display:none;">
                                <span class=""></span>							
                                <input type="text" id="quicksearch" placeholder="" /><br>
                                <button class="page_search_btn" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                            <!--  <div class="filter-div sidebar-single-bx"  style="display:none;">
                                      <span class="small_line"></span>
                                      <ul>
                                        <li class="showbtn"><a data-show=".project-sector"><?php echo _e("SECTOR", 'buchan_theme'); ?></a></li>
                                        <li class="showbtn"><a data-show=".project-std"><?php echo _e("STUDIO", 'buchan_theme'); ?></a></li>
                                      </ul>
                                  </div>-->
                            <div class="project-sector sidebar-single-bx"  style="display:none;">
                                <span class="small_line"></span>
                                <ul>
                                    <?php
                                    $terms = get_terms('people-sector', array('hide_empty' => false));
                                    if (!empty($terms) && !is_wp_error($terms))
                                    {
                                        foreach ($terms as $term)
                                        {
                                            echo '<li class="project-page-sidebar-reg"><a data-filter=".' . $term->slug . '" href="javascript:void(0)">' . $term->name . '</a></li>';
                                        }
                                    }
                                    ?>	
                                </ul>   
                            </div>
                            <div class="project-studio sidebar-single-bx"  style="display:none;">
                                <span class="small_line"></span>
                                <ul>
<?php
$terms = get_terms('people-sector', array('hide_empty' => false));
if (!empty($terms) && !is_wp_error($terms))
{
    foreach ($terms as $term)
    {
        echo '<li class="project-page-sidebar-sec"><a data-filter=".' . $term->slug . '" href="javascript:void(0)">' . $term->name . '</a></li>';
    }
}
?>
                                </ul>
                            </div>
                            <div class="project-std sidebar-single-bx col-xs-4 col-sm-12"  style="display:none;">
                                <span class="small_line"></span>
                                <ul>
<?php
$args = array('posts_per_page' => -1, 'post_type' => 'studio', 'suppress_filters' => false);
$stdposts = get_posts($args);

foreach ($stdposts as $std)
{

    echo '<li class="project-page-sidebar-sec"><a data-filter=".std-' . $std->post_name . '" href="javascript:void(0)">' . $std->post_title . '</a></li>';
}
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="row">
                        <div class="sub_listing">
                            <div class="grid">
                                <?php
                                global $post;
                                $args = array('post_type' => 'person', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'title');
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
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php
    if (@$_GET['filter'] != '1')
    {
        ?> <script type="text/javascript">

            document.cookie = "filteroption=''; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
            document.cookie = "filteroption2=''; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
            document.cookie = "filteroption3=''; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
        </script>
        <?php
    }
    ?>

<?php if ($_GET['filter'] == 1)
{ ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                jQuery('html, body').animate({
                    scrollTop: jQuery('#second_section').offset().top - 60
                }, 800);
            });
        </script>
<?php } ?>

    <!--Search Button Script Start-->
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/isotope.pkgd.js"></script>
    <script type="text/javascript">



    // quick search regex
            var qsRegex;
            var buttonFilter;
            var regFilter;
            var buttonFilters;
    // init Isotope
            var $grid = jQuery('.grid').isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
                getSortData: function () {
                    var $this = jQuery(this);
                    var gtResult = buttonFilters ? {name: $this.is(buttonFilters)} : true;
                    return gtResult;
                }, getSortData:  {name: '.name'},
                filter: function () {
                    var $this = jQuery(this);
                    var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                    var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                    var regResult = regFilter ? $this.is(regFilter) : true;
                    return searchResult && buttonResult && regResult;
                }
            });
            jQuery('.project-page-sidebar-cat').on('click', 'a', function () {
                regFilter = '';
                qsRegex = '';
                buttonFilter = jQuery(this).attr('data-filter');
                if (buttonFilter == '') {
                    document.cookie = "filteroption=" + regFilter + "; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
                    document.cookie = "filteroption3=" + regFilter + "; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
                    document.cookie = "filteroption2=" + regFilter + "; expires=Thu, 18 Dec 1993 12:00:00 UTC; path=/";
                }
                document.cookie = "filteroption=" + buttonFilter + "; expires=Thu, 18 Dec 2019 12:00:00 UTC; path=/";

                $grid.isotope();
                jQuery(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
                //  jQuery('.filter-div').show();
            });
            jQuery('.project-page-sidebar-reg').on('click', 'a', function () {
                regFilter = jQuery(this).attr('data-filter');
                document.cookie = "filteroption3=" + regFilter + "; expires=Thu, 18 Dec 2019 12:00:00 UTC; path=/";
                $grid.isotope();
            });
            jQuery('.project-page-sidebar-sec').on('click', 'a', function () {
                regFilter = jQuery(this).attr('data-filter');
                document.cookie = "filteroption3=" + regFilter + "; expires=Thu, 18 Dec 2019 12:00:00 UTC; path=/";
                $grid.isotope();
            });
            jQuery('.prj-search-btn').on('click', 'a', function () {
                buttonFilter = '';
                regResult = '';
    //buttonFilters = jQuery( this ).attr('data-sort'); 
                jQuery(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
                jQuery('.search_box').show();
                $grid.isotope();
            });
            jQuery('.filteraz').on('click', 'a', function () {
    //	buttonFilter ='';
    //regResult = '';
                buttonFilters = jQuery(this).attr('data-sort');
                var options = {};
                options["sortBy"] = "name";
                $grid.isotope(options);
            });
            jQuery('.showbtn').on('click', 'a', function () {
                jQuery(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
                jQuery(jQuery(this).attr('data-show')).show();

                document.cookie = "filteroption2=" + jQuery(this).attr('data-show') + "; expires=Thu, 18 Dec 2017 12:00:00 UTC; path=/";

            });
    // use value of search field to filter
            var $quicksearch = jQuery('#quicksearch').keyup(debounce(function () {
                buttonFilter = '';
                regResult = '';
                qsRegex = new RegExp($quicksearch.val(), 'gi');
                $grid.isotope();
            }));
    // change is-checked class on buttons
            jQuery('.button-group').each(function (i, buttonGroup) {
                var $buttonGroup = jQuery(buttonGroup);
                $buttonGroup.on('click', 'button', function () {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    jQuery(this).addClass('is-checked');
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
            jQuery(document).ready(function () {
                jQuery('.godown_btn').click(function () {
                    var targetDiv = jQuery(this).attr('href');
                    jQuery('html, body').animate({
                        scrollTop: jQuery(targetDiv).offset().top - 60
                    }, 800);
                    return false;
                });
                jQuery('.projects_listing .side_bar_left .side_menu .sidebar-single-bx').click(function () {
                    jQuery('html, body').animate({
                        scrollTop: jQuery("#second_section").offset().top - 60
                    }, 800);
                    return false;
                });
                //jQuery(function() {
            });

    //    if (window.location.hash != '') {
    //        var cls = window.location.hash.replace('#','');
    //
    //alert(cls);
    //
    //            jQuery('.side_menu ul li a.'+cls).trigger('click');
    //            
    //        }

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
                jQuery(".inner_top_banner").css({'height': h});
            });
            jQuery(window).resize(function () {
                var h = jQuery(window).height();
                jQuery(".inner_top_banner").css({'height': h});
            });
            var minhl = jQuery(window).height() - 62;
            console.log(minhl);
            jQuery('#second_section .projects_listing .col-md-9.col-sm-9.col-xs-12').css({'min-height': minhl});



            jQuery(document).ready(function () {
                if (document.cookie.indexOf("filteroption") >= 0) {
                    jQuery('a[data-filter="' + getCookie("filteroption") + '"]').click();


                }
                if (document.cookie.indexOf("filteroption2") >= 0) {
                    jQuery('a[data-show="' + getCookie("filteroption2") + '"]').click();
                }
                if (document.cookie.indexOf("filteroption3") >= 0) {
                    jQuery('a[data-filter="' + getCookie("filteroption3") + '"]').click();
                }

            });

            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length == 2)
                    return parts.pop().split(";").shift();
            }
    </script>







<?php get_footer(); ?>