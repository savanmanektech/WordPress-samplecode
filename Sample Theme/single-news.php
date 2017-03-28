<?php get_header(); ?>
<div class="inner_page news_detail_page">
    <div class="container">
        <div class="row">
            <!-- news_listing start -->
            <?php if (have_posts()) : ?>            
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="left_content">
                            <span class="date"><?php the_date(); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <span class="small_line"></span>
                            <?php the_content(); ?>


                            <?php echo do_shortcode('[share_btns line="true"]'); ?>
                            <div class="back_bt"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo _e("BACK TO NEWS", 'buchan_theme'); ?></a></div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-7 col-xs-12">
                        <div class="right_imgtag">						
                            <?php
                            $images = get_field('news_image');
                            if ($images):
                                ?>						   
                                <?php foreach ($images as $image): ?>								   
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> 				   
                                <?php endforeach; ?>							
                            <?php endif; ?>                          
                        </div>
                        <div class="pages_link">
                            <?php /*   <span class="left"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>'._e("PREVIOUS ARTICLE",'buchan_theme')); ?>    </span>
                              <span class="right"><?php next_post_link('%link', _e("NEXT ARTICLE",'buchan_theme'). '<i class="fa fa-angle-right"></i>'); ?></span> */ ?>
                            <span class="left"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i> PREVIOUS ARTICLE'); ?>    </span>
                            <span class="right"><?php next_post_link('%link', 'NEXT ARTICLE <i class="fa fa-angle-right"></i>'); ?></span>
                        </div>
                    </div>                         
                <?php endwhile; ?>                 

            <?php else: ?>    

                <div class="error"><?php _e('Not found.'); ?></div> 

            <?php endif; ?>

        </div>
    </div>

    <?php get_footer(); ?>