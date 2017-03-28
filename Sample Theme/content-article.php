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
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'page-listing');
$url = $src[0];
if ($url == "")
{
    $url = get_bloginfo('template_url') . '/images/placeholder.jpg';
}
$pdf_link = get_field('pdf_link');
?>

<div class="row" id="<?php echo $post->post_name; ?>">
    <div class="col-md-6 col-sm-12">
        <div class="left_imgtag">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $url; ?>" alt="" class="img-responsive"></a>
            <?php echo do_shortcode('[share_btns]'); ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="right_content">
            <span class="date"><?php echo get_the_date(); ?> </span>
            <a href="<?php the_permalink() ?>">   <h2><?php the_title(); ?></h2></a>
            <span class="small_line"></span>
            <?php the_excerpt(); ?>
            <span class="read_more">
                <?php if ($pdf_link != "")
                {
                    ?>
                    <a href="<?php echo $pdf_link; ?>"><?php _e('DOWNLOAD PDF', 'buchan_theme'); ?></a>
                <?php
                }
                else
                {
                    ?>
                    <a href="<?php the_permalink(); ?>"><?php _e('READ MORE', 'buchan_theme'); ?></a>
<?php } ?>
            </span>
<?php echo do_shortcode('[share_btns]'); ?>
        </div>
    </div>
    <div class="col-md-12"><div class="line_tag"></div></div>
</div>


