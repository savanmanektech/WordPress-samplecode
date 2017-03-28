<?php get_header(); ?>

<div class="inner_page news_detail_page">
    <div class="container">
        <div class="row">

            <?php if (have_posts()) : ?>            

                <?php while (have_posts()) : the_post(); ?>


                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="left_content">
                            <span class="date"><?php the_date(); ?></span>

        <!-- <p class="byline">Written by: <span><?php the_author_link(); ?></span> on <span><?php the_time(get_option('date_format')); ?></span></p> -->

                            <h2><?php the_title(); ?></h2>
                            <span class="small_line"></span>
                            <?php the_content(); ?>

                            <span class="small_line"></span>
                            <?php echo do_shortcode('[share_btns]'); ?>
                            <div class="back_bt"><a href="<?php echo esc_url(home_url('/')); ?>">BACK</a></div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
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
                            <span class="left"><?php previous_post_link('%link', '<i class="fa fa-angle-left"></i>PREVIOUS ARTICLE'); ?>    </span>
                            <span class="right"><?php next_post_link('%link', 'NEXT ARTICLE <i class="fa fa-angle-right"></i>'); ?></span>
                        </div>
                    </div> 




                    <div class="post-box">

        <?php comments_template(); ?>

                    </div>            		

                <?php endwhile; ?>                 

<?php else: ?>    

                <div class="error"><?php _e('Not found.'); ?></div> 

<?php endif; ?>


        </div>

        <div class="clear"></div>
    </div>
</div><!-- EOF : content ID -->

<?php get_footer(); ?>