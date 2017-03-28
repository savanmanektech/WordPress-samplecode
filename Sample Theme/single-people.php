<?php get_header(); ?>

<!-- news_listing start -->
<?php if (have_posts()) : ?>            

    <?php
    while (have_posts()) : the_post();
        $meta = get_post_meta(get_the_id());
        $src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $url = $src[0];
        ?>
        <!-- inner page start -->
        <div class="inner_page people_page" id="second_section">
            <div class="container">
                <div class="row">
                    <div class="people_detail">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="people_detal_left">
                                <h2><?php the_title(); ?><span><?php echo ($meta['people_position'][0] != '') ? $meta['people_position'][0] . ',' : ''; ?> <?php echo $meta['people_location'][0]; ?></span></h2>
                                <span class="small_line"></span>
                                <?php the_content(); ?>
                                <span class="small_line"></span>
                                <p><?php echo $meta['people_phone'][0]; ?><br>
                                    <a href="mailto:<?php echo $meta['people_email'][0]; ?>"><?php echo $meta['people_email'][0]; ?></a>
                                </p>
                                <?php echo do_shortcode('[share_btns]'); ?>
                                <div class="back_bt"><a href="<?php echo get_permalink(get_page_by_path('peoples')); ?>">BACK TO people</a></div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="imgtag">
                                <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>" class="img-responsive people-image">
                            </div>
                            <div class="selected_project">
                                <div class="line_tag"></div>
                                <h3>SELECTED PROJECTS</h3>
                                <div class="sub_listing">
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img1.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img2.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>CHADSTONE S.C <span>MELBOURNE, VIC</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img3.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img4.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img1.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img2.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>CHADSTONE S.C <span>MELBOURNE, VIC</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img3.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img4.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img1.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img2.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>CHADSTONE S.C <span>MELBOURNE, VIC</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img3.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="listing_box">
                                        <a href="#">
                                            <img alt="" src="images/project_list_img4.jpg">
                                            <div class="midl_overlay">
                                                <div class="inner_text">
                                                    <div class="in_contain">
                                                        <h3>RUNDLE PLACE <span>ADELAIDE, SA</span></h3>
                                                        <p>Service<span>MP, Arch, I.D, Gr.D</span></p>
                                                        <p>Sector<span>Residential</span></p>
                                                        <p>Region<span>Australia</span></p>
                                                        <p>Scope<span>CD, DD, ConstructionSS</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <script type="text/javascript">
            if (jQuery(window).width() > 767) {
                jQuery(document).on('scroll', function () {
                    var t = jQuery("#second_section").position().top;
                    if (jQuery(window).scrollTop() > t) {
                        jQuery(".side_bar_left").addClass("dofix");
                    } else {
                        jQuery(".side_bar_left").removeClass("dofix");
                    }
                    //
                });
            }
        </script>
    <?php endwhile; ?>                 

<?php else: ?>    
    <div class="inner_page news_detail_page">
        <div class="container">
            <div class="row">

                <div class="error"><?php _e('Not found.'); ?></div> 
            </div>
        </div>
    </div>      
<?php endif; ?>





<?php get_footer(); ?>