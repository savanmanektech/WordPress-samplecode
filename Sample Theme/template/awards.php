<?php
/*
  Template Name: Awards
 */
get_header();
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
$url = $src[0];
$meta = get_post_meta($post->ID);
$location = file_get_contents('http://freegeoip.net/json/' . $_SERVER['REMOTE_ADDR']);
$locations = json_decode($location);
$city = strtoupper($locations->city);
$args = array('post_type' => 'studio', 'posts_per_page' => -1);
$query = new WP_Query($args);
$location = array();
while ($query->have_posts()) {
    $query->the_post();
    $ti = strtoupper(get_the_title());
    $location[$ti] = get_the_id();
}wp_reset_query();
if (@$location[$city] != '')
{
    $studio_name = $city;
}
elseif ($locations->country_code == 'NZ')
{
    $studio_name = 'AUCKLAND';
}
elseif ($locations->country_code == 'AU')
{
    if ($locations->region_code == 'QLD')
    {
        $studio_name = 'BRISBANE';
    }
    elseif ($locations->region_code == 'NSW')
    {
        $studio_name = 'SYDNEY';
    }
    elseif ($locations->region_code == 'WA')
    {
        $studio_name = 'PERTH';
    }
    else
    {
        $studio_name = 'MELBOURNE';
    }
}
elseif ($locations->country_code == 'CN')
{
    $studio_name = 'SHANGHAI';
}
elseif ($locations->country_code == 'GB')
{
    $studio_name = 'LONDON';
}
elseif ($locations->country_code == 'AE')
{
    $studio_name = 'DUBAI';
}
else
{
    $studio_name = 'MELBOURNE';
}

if (@$location[$studio_name] != '')
{
    $studio_id = $location[$studio_name];
}
else
{
    $studio_name = 'MELBOURNE';
    $studio_id = $location['MELBOURNE'];
}

$src = wp_get_attachment_image_src(get_post_thumbnail_id($studio_id), 'full');
$url = $src[0];
?>

<div class="inner_top_banner" style="background: url('<?php echo $url; ?>') no-repeat center">
    <div class="overlay_up">
        <div class="middel_sect">
            <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php echo _e("STUDIO", 'buchan_theme'); ?>
                    <span>
                        <?php echo $studio_name; ?>
                    </span></h1>
            </div>
        </div>
    </div>
    <a class="godown_btn" href="#second_section">
        <img src="<?php echo get_template_directory_uri(); ?>/images/down-aroow.png">
    </a>
</div>
<?php
$meta_s = get_post_meta($studio_id);
$feature = @$meta_s['featured_image_or_featured_video'][0];
$color = ($meta_s['banner_text_color'][0] != '') ? $meta['banner_text_color'][0] : '#FFF';
if ($feature == 'video')
{
    $vid = $meta_s['featured_video'] [0];
    $video_url = wp_get_attachment_url($vid);
    ?>
    <div class="home-slider" style="position:fixed;">
        <video  autoplay  loop>
            <source src="<?php echo $video_url; ?>" type="video/mp4" />
        </video>                  
        <div class="fix-title"> <div class="container">
                <h1 style="color:<?php echo $color; ?>"><?php echo _e("STUDIO", 'buchan_theme'); ?></h1>
            </div>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="home-slider" style="position:fixed;">
        <div class="inner_top_banner" style="background: url('<?php echo $url; ?>') no-repeat center">
            <div class="overlay_up">
                <div class="middel_sect">
                    <div class="container">
                        <h1 style="color:<?php echo $color; ?>"><?php echo _e("STUDIO", 'buchan_theme'); ?></h1>
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
            <div class="studio_middel">

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="side_bar_left">
                        <h2><?php echo _e("STUDIO", 'buchan_theme'); ?></h2>
                        <span class="small_line"></span>
                        <div class="side_menu">
                            <div class="sidebar-single-bx">
                                <?php
                                wp_nav_menu(array(
                                    'menu' => 'Studio menu'
                                ));
                                ?>									
                            </div>
                            <div class="cluture-submenu sidebar-single-bx">
                                <span class="small_line"></span>	
                                <ul class="smoothscroll">
                                    <?php
                                    global $wpdb;
                                    $year = array();
                                    $query = "SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key like 'project_award_%_project_award_year' ORDER BY meta_value;";
                                    $authors = $wpdb->get_results($query);

                                    foreach ($authors as $author) :
                                        $year[] = $author->meta_value;
                                        echo'<li><a href="#year-' . $author->meta_value . '">';
                                        echo $author->meta_value;
                                        echo '</li>';
                                    endforeach;
                                    ?>
                                </ul> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="studio_right_cont">
                        <div class="culture_detail profile_detail studio-single-section st-culture">
                            <h2><?php echo _e("AWARDS", 'buchan_theme'); ?></h2>

                            <?php

                            function acf_posts_where($where) {

                                $where = str_replace("meta_key = 'project_award_%_project_award_year", "meta_key LIKE 'project_award_%_project_award_year", $where);

                                return $where;
                            }

                            add_filter('posts_where', 'acf_posts_where');
                            foreach ($year as $y)
                            {
                                ?>

                                <div id="year-<?php echo $y; ?>" class="row">
                                    <div class="col-md-12">
                                        <div class="line_tag"></div>
                                        <h3><?php echo $y; ?> </h3>
                                    </div>
                                    <div class="sub_listing">


                                        <?php
                                        $args = array(
                                            'post_type' => 'project',
                                            'posts_per_page' => -1,
                                            'meta_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                    'key' => 'project_award_%_project_award_year',
                                                    'value' => $y,
                                                ),
                                            )
                                        );
                                        $query = new WP_Query($args);
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                            while (have_rows('project_award')) : the_row();
                                                if (get_sub_field('project_award_year') == $y)
                                                {
                                                    $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'project-thumb');
                                                    $url = $src[0];
                                                    ?>
                                                    <div class="listing_box">
                                                        <a href="#">
                                                            <img alt="" src="<?php echo $url; ?>">
                                                            <div class="midl_overlay">
                                                                <div class="inner_text">
                                                                    <div class="in_contain">
                                                                        <h3><?php the_title(); ?> <span> <?php
                                                                                echo get_sub_field('project_award_name');
                                                                                ;
                                                                                ?></span></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                            endwhile;

                                            //get_template_part( 'content', get_post_type() );					
                                        }  //wp_reset_postdata();  
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">
                <div id='map' style="width:100%;height:500px;"></div>
                <script>


                    function initMap() {
                        var uluru = {lat: 23, lng: 72};
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 4,
                            center: uluru
                        });
                        var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                        });
                    }
                </script>


            </div>

        </div>

    </div>



    <script>
        jQuery('.map-load').on('click', function (e) {


            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': jQuery(this).attr('data-address')
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var myOptions = {
                        zoom: 18,
                        center: results[0].geometry.location,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    map = new google.maps.Map(document.getElementById("map"), myOptions);

                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                }
            });


            // do something...
        })
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpS9qpaKubOLA1R4VbXMVSCybjftF1_g0&callback=initMap">
    </script>
    <!--Search Button Script Start-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://isotope.metafizzy.co/beta/isotope.pkgd.js"></script>
    <script type="text/javascript">

// quick search regex
        var qsRegex;
        var buttonFilter;
        var regFilter;
        var buttonFilters;

// init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows',
            getSortData: function () {
                var $this = $(this);

                var gtResult = buttonFilters ? {name: $this.is(buttonFilters)} : true;

                return gtResult;
            },
            filter: function () {
                var $this = $(this);
                var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                var regResult = regFilter ? $this.is(regFilter) : true;
                return searchResult && buttonResult && regResult;
            },
            sortBy: 'name'
        });

        $('.project-page-sidebar-cat').on('click', 'a', function () {
            regFilter = '';
            buttonFilter = $(this).attr('data-filter');
            $grid.isotope();
            $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
            $('.filter-div').show();
        });
        $('.project-page-sidebar-reg').on('click', 'a', function () {
            regFilter = $(this).attr('data-filter');
            $grid.isotope();
        });
        $('.project-page-sidebar-sec').on('click', 'a', function () {
            regFilter = $(this).attr('data-filter');
            $grid.isotope();

        });
        $('.prj-search-btn').on('click', 'a', function () {
            buttonFilter = '';
            regResult = '';
            //buttonFilters = $( this ).attr('data-sort'); 
            $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
            $('.search_box').show();
            $grid.isotope();
        });
        $('.filteraz').on('click', 'a', function () {

            buttonFilter = '';
            regResult = '';
            buttonFilters = $(this).attr('data-sort');
            alert(buttonFilters);
            $grid.isotope();
        });

        $('.showbtn a').on('click', function () {

            $(this).parent().parent().parent().nextAll('.sidebar-single-bx').hide();
            $($(this).attr('data-show')).show();

            $('.studio-single-section').hide();
            $('.studio-single-section' + $(this).attr('data-section')).show();

        });
// use value of search field to filter
        var $quicksearch = $('#quicksearch').keyup(debounce(function () {
            buttonFilter = '';
            regResult = '';
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $grid.isotope();
        }));

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

        if (jQuery(window).width() > 767) {
            $(document).on('scroll', function () {
                var t = $("#second_section").position().top;
                if ($(window).scrollTop() > t - 20) {
                    $(".side_bar_left").addClass("dofix");
                } else {
                    $(".side_bar_left").removeClass("dofix");
                }
                //
            });
        }

//Click event to godown_btn
        $(document).ready(function () {
            $('.godown_btn').click(function () {
                var targetDiv = $(this).attr('href');
                $('html, body').animate({
                    scrollTop: $(targetDiv).offset().top
                }, 800);

                return false;
            });

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