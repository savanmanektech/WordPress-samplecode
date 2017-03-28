<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'small-thumb');
$url = $src[0];
?>
<div class="row">
    <div class="col-md-6">
        <div class="left_imgtag">
            <a href="<?php the_permalink() ?>">  <img src="<?php echo $url; ?>" alt=""></a>
            <?php echo do_shortcode('[share_btns]'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="right_content">
            <span class="date"><?php echo get_the_date(); ?> </span>
            <a href="<?php the_permalink() ?>"> <h2><?php the_title(); ?></h2></a>
            <span class="small_line"></span>                                     
            <p><?php echo excerpt(30); //the_excerpt();   ?></p>
            <span class="read_more"><a href="<?php the_permalink() ?>"><?php _e('READ MORE', 'buchan_theme'); ?></a></span>
            <?php echo do_shortcode('[share_btns]'); ?>
        </div>
    </div>
    <div class="col-md-12"><div class="line_tag"></div></div>
</div>
