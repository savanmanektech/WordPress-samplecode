<?php get_header(); ?>

<div id="content">
    <div class="wrapper">
        <div class="content-left">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <h2 class="title"><?php the_title(); ?></h2>  

                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="left_content">
                            <span class="date"><?php the_date(); ?></span>
                            <h2><?php the_title(); ?></h2>
                            <span class="small_line"></span>
                            <?php the_content(); ?>

                            <span class="small_line"></span>
                            <?php echo do_shortcode('[share_btns]'); ?>
                            <div class="back_bt"><a href="<?php echo esc_url(home_url('/')); ?>">BACK TO NEWS</a></div>
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





                    <?php the_content(); ?>  

    <?php endwhile;
else: ?>    

                <div class="error"><?php _e('Not found.'); ?></div> 

<?php endif; ?>

        </div>
        <div class="content-right">        	
<?php get_sidebar(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div><!-- EOF : content ID -->

<?php get_footer(); ?>