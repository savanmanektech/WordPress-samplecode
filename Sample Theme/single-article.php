<?php get_header(); ?>
<div class="inner_page news_detail_page">
    <div class="container">
        <div class="row">
            <!-- news_listing start -->
            <?php
            if (have_posts()) :

                $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                $url = $src[0];
                ?>            
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="left_content">
                            <span class="date"><?php the_date(); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <span class="small_line"></span>
                            <?php the_content(); ?>
                            <div class="btns-art">
                                <div class="back_bt dw">
                                    <a href="<?php echo esc_url(get_permalink(64) . '#list'); ?>">BACK TO DIRECTIONS</a>
                                </div>
                                <div class="back_bt dw">
                                    <a href="<?php echo get_field('pdf_link'); ?>">DOWNLOAD PDF</a>
                                </div>

                            </div>
                            <?php echo do_shortcode('[share_btns]'); ?>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="right_imgtag">						
                            <?php
                            if ($url != '')
                            {
                                echo '<img class="img-responsive" src="' . $url . '" />';
                            }
                            $images = get_field('image_gallery');
                            if ($images):
                                ?>						   
                                <?php foreach ($images as $image): ?>								   
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> 				   
                                <?php endforeach; ?>							
                            <?php endif; ?>                          
                        </div>
                    </div>                         
                <?php endwhile; ?>                 
            <?php else: ?>    
                <div class="error"><?php _e('Not found.'); ?></div> 
            <?php endif; ?>
        </div>
    </div>

    <?php get_footer(); ?>