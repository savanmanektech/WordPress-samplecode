<?php get_header(); ?>
<div class="inner_page news_detail_page">
    <div class="container">
        <div class="row">
            <!-- news_listing start -->
            <?php if (have_posts()) : ?>            
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="left_content">
                            <span class="date"><?php the_date(); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <span class="small_line"></span>
                            <?php the_content(); ?>
                            <?php echo do_shortcode('[share_btns]'); ?>
                            <div class="back_bt"><a href="<?php echo get_permalink(get_page_by_path('directions')) ?>">BACK TO DIRECTIONS</a></div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="right_imgtag">						
                            <?php
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