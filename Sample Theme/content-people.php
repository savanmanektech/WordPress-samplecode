<?php
$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'project-thumb');
$url = $src[0];
$meta = get_post_meta($post->ID);
?> 								
<div class="listing_box element-item  <?php $a = wp_get_post_terms($post->ID, 'people-category');
foreach ($a as $cat)
{
    echo $cat->slug . ' ';
} $a = wp_get_post_terms($post->ID, 'people-region');
foreach ($a as $cat)
{
    echo $cat->slug . ' ';
} $a = wp_get_post_terms($post->ID, 'people-sector');
foreach ($a as $cat)
{
    echo $cat->slug . ' ';
} ?>">
    <a href="<?php the_permalink() ?>">
        <img alt="" src="<?php echo ($url != '') ? $url : 'http://localhost/buchan/wp-content/uploads/2016/11/project_list_img1.jpg'; ?>">
        <div class="midl_overlay">
            <div class="inner_text">
                <div class="in_contain">
                    <h3><?php the_title(); ?> <span><?php echo (@$meta['people_position'][0] != '') ? $meta['people_position'][0] . ',' : ''; ?> <?php echo @$meta['people_location'][0]; ?></span></h3>
                </div>
            </div>
        </div>
    </a>
</div>