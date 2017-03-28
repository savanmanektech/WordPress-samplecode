<?php
/* include theme commun codes */
include("functions/theme_commun_code.php");
/* end of include theme commun codes */

/* include theme widget area */
include("functions/theme_widget_areas.php");
/* end of include theme widget area */

/* include the Menu Registration page */
include("functions/register_menus.php");
/* end of include the Menu Registration page */

/* include the option page */
include("functions/theme_option_page.php");
/* end of include the option page */

/* Include the custom post type */
include("functions/custom_post_type.php");
/* end ov Include the custom post type */

/* Include the theme's custom functions */
include("functions/theme_custom_functions.php");
/* end of theme's custom functions */

/* Include the theme's custom widgets */
include("functions/widgets.php");
/* end of theme's custom widgets */

/* Include the theme's custom users */
include("functions/custom_users.php");
/* end of theme's custom users */


add_action('wp_ajax_nopriv_sidebar_click', 'sidebar_click');
add_action('wp_ajax_sidebar_click', 'sidebar_click');

function my_enqueue_assetsa() {
    wp_enqueue_script('ajax-pagination', get_stylesheet_directory_uri() . '/js/ajax-pagination.js', array('jquery'), '1.0', true);
}

function sidebar_click() {
    $query_vars = array();
    $response['sidebar'] = '';

    if ($_POST['data_type'] == 'news')
    {
        if ($_POST['data_term'] == "region")
        {
            $terms = get_terms('region', array('orderby' => 'count'));
            if (!empty($terms) && !is_wp_error($terms))
            {
                $response['sidebar'] .= '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul>';
                foreach ($terms as $term)
                {
                    $response['sidebar'] .= '<li><a data-term="regianlist" data-type="news" data-load="true" data-val="' . $term->slug . '" href="javascript:void(0)">' . $term->name . '</a></li>';
                }
                $response['sidebar'] .= '</ul></div>';
            }
        }

        if ($_POST['data_term'] == "search")
        {
            $response['sidebar'] .= '<div class="col-xs-4 col-sm-12"><span class=""></span><ul>';
            $response['sidebar'] .= '<li><input type="text" class="searchbox" name="searchbox"><br><a class="search-btn" data-term="searchbtn" data-type="news" data-load="true" data-val="" href="javascript:void(0)"><i class="fa fa-search"></i></a></li>';
            $response['sidebar'] .= '</ul></div>';
        }

        // Get Postlist from Region Slug 
        if ($_POST['data_term'] == "regianlist")
        {
            $query_vars['post_type'] = $_POST['data_type'];
            $query_vars['posts_per_page'] = 5;
            $ar = array('taxonomy' => 'region', 'field' => 'slug', 'terms' => $_POST['data_val']);
            $query_vars['tax_query'][] = $ar;
        }
        if ($_POST['data_term'] == "year")
        {
            global $wpdb;
            $years = $wpdb->get_results("SELECT DISTINCT YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'news' GROUP BY year ORDER BY post_date DESC");

            $response['sidebar'] .= '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul>';
            foreach ($years as $year)
            {
                $response['sidebar'] .= '<li><a data-term="yearlink" data-type="news" data-load="true" data-val="' . $year->year . '" href="javascript:void(0)">' . $year->year . '</a></li>';
            }
            $response['sidebar'] .= '</ul></div>';
        }
        if ($_POST['data_term'] == "yearlink")
        {
            global $wpdb;
            $years = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'news' and YEAR( post_date ) = '" . $_POST['data_val'] . "' GROUP BY month ORDER BY post_date DESC");
            $response['sidebar'] .= '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul>';
            foreach ($years as $year)
            {
                $response['sidebar'] .= '<li><a data-term="monthlink" data-type="news" data-load="true" data-val="' . $_POST['data_val'] . ',' . $year->month . '" href="javascript:void(0)">' . date('F', mktime(0, 0, 0, $year->month, 10)) . '</a></li>';
            }
            $response['sidebar'] .= '</ul></div>';
            $query_vars['post_type'] = $_POST['data_type'];
            $query_vars['year'] = $_POST['data_val'];
        }
        if ($_POST['data_term'] == "monthlink")
        {
            $tmp = explode(',', $_POST['data_val']);
            $query_vars['post_type'] = $_POST['data_type'];
            $query_vars['year'] = $tmp[0];
            $query_vars['monthnum'] = $tmp[1];
        }
        if ($_POST['data_term'] == "recent")
        {
            $query_vars['post_type'] = $_POST['data_type'];
            $query_vars['posts_per_page'] = 5;
        }
        if ($_POST['data_term'] == "searchbtn")
        {
            $query_vars['post_type'] = $_POST['data_type'];
            $query_vars['posts_per_page'] = 5;
            $query_vars['s'] = $_POST['data_val'];
        }
    }


    if ($_POST['data_type'] == "thought")
    {
        global $wpdb;
        $years = $wpdb->get_results("SELECT DISTINCT YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = '" . $_POST['data_type'] . "' GROUP BY year ORDER BY post_date DESC");
        $response['content'] = '<h2>' . $_POST['data_term'] . '</h2><div class="line_tag"></div>';
        if (@$_POST['data_val'] == '')
        {
            $response['sidebar'] = '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul class="ajax_nav">';
            foreach ($years as $year)
            {
                $response['sidebar'] .= '<li><a data-term="thlink" data-type="thought" data-load="true" data-val="' . $year->year . '" href="javascript:void(0)">' . $year->year . '</a></li>';
            }
            $response['sidebar'] .= '</ul></div>';
        }
        $query_vars['post_type'] = $_POST['data_type'];
        $query_vars['posts_per_page'] = 5;
    }
    if ($_POST['data_type'] == "symposiumseries")
    {
        $response['content'] = '<h2>' . $_POST['data_term'] . '</h2><div class="line_tag"></div>';
        $response['sidebar'] = '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul class="smoothscroll">';
        $args = array('post_type' => $_POST['data_type'], 'posts_per_page' => -1);
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->the_post();
            $response['sidebar'] .= '<li><a href="#' . $query->post->post_name . '">' . get_the_title() . '</a></li>';
        }
        $response['sidebar'] .= '</ul></div>';
        $query_vars['post_type'] = $_POST['data_type'];
        $query_vars['posts_per_page'] = -1;
    }
    if ($_POST['data_type'] == "article")
    {
        $response['content'] = '<h2>' . $_POST['data_term'] . '</h2><div class="line_tag"></div>';
        $response['sidebar'] = '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul class="smoothscroll">';
        $args = array('post_type' => $_POST['data_type'], 'posts_per_page' => -1);
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->the_post();
            $response['sidebar'] .= '<li><a href="#' . $query->post->post_name . '">' . get_the_title() . '</a></li>';
        }
        $response['sidebar'] .= '</ul></div>';
        $query_vars['post_type'] = $_POST['data_type'];
        $query_vars['posts_per_page'] = -1;
    }


    if ($_POST['data_term'] == "thlink")
    {
        $response['content'] = '<h2>THOUGHTS</h2><div class="line_tag"></div>';
        $response['sidebar'] .= '<div class="col-xs-4 col-sm-12"><span class="small_line"></span><ul class="smoothscroll">';

        $args = array('post_type' => 'thought', 'posts_per_page' => -1, 'year' => $_POST['data_val']);
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->the_post();
            $response['sidebar'] .= '<li><a href="#' . $query->post->post_name . '">' . get_the_title() . '</a></li>';
        }  //wp_reset_postdata();  	



        $response['sidebar'] .= '</ul></div>';
        $query_vars['post_type'] = $_POST['data_type'];
        $query_vars['year'] = $_POST['data_val'];
        $query_vars['posts_per_page'] = -1;
    }

    if ($_POST['data_load'] != "false")
    {
        $posts = new WP_Query($query_vars);
        $response['query_vars'] = json_encode($posts->query);
        $response['tmp'] = $posts;
        $GLOBALS['wp_query'] = $posts;
        add_filter('editor_max_image_size', 'my_image_size_override');
        if (!$posts->have_posts())
        {
            $response['content'] .= load_template_part('content', 'none');
        }
        else
        {
            while ($posts->have_posts()) {
                $posts->the_post();
                $response['content'] .= load_template_part('content', get_post_type());
            }
        }
        remove_filter('editor_max_image_size', 'my_image_size_override');
        /* $response['content'] .= get_the_posts_pagination( array(
          'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
          'next_text'          => __( 'Next page', 'twentyfifteen' ),
          'type'=>'list'
          ) ); */
        $response['content'] .= custom_nav();
    }
    echo json_encode($response);
    die();
}

add_action('wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination');
add_action('wp_ajax_ajax_pagination', 'my_ajax_pagination');

function my_ajax_pagination() {
    $query_vars = json_decode(stripslashes($_POST['query_vars']), true);

    $query_vars['paged'] = $_POST['page'];




    $posts = new WP_Query($query_vars);
    $GLOBALS['wp_query'] = $posts;

    add_filter('editor_max_image_size', 'my_image_size_override');

    if (!$posts->have_posts())
    {
        //get_template_part( 'content', 'none' );
    }
    else
    {
        while ($posts->have_posts()) {
            $posts->the_post();
            $response['content'] .= load_template_part('content', get_post_type());
        }
    }
    remove_filter('editor_max_image_size', 'my_image_size_override');

    /*  $response['content'] .= get_the_posts_pagination( array(
      'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
      'next_text'          => __( 'Next page', 'twentyfifteen' ),
      'type'=>'list'
      ) ); */
    $response['content'] .= custom_nav();
    echo json_encode($response);
    die();
}

function load_template_part($template_name, $part_name = null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

add_action('wp_enqueue_scripts', 'my_enqueue_assets');

function my_enqueue_assets() {
    wp_enqueue_script('ajax-pagination', get_stylesheet_directory_uri() . '/js/ajax-pagination.js', array('jquery'), '1.0', true);
}

function my_image_size_override() {
    return array(825, 510);
}

function custom_nav() {
    // Don't print empty markup if there's only one page.
    if ($GLOBALS['wp_query']->max_num_pages < 2)
    {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1]))
    {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $GLOBALS['wp_query']->max_num_pages,
        'current' => $paged,
        'mid_size' => 3,
        'add_args' => array_map('urlencode', $query_args),
        'prev_text' => __('&larr; Previous', 'yourtheme'),
        'next_text' => __('Next &rarr;', 'yourtheme'),
        'type' => 'list',
    ));
    $ret = '';
    if ($links) :


        $ret .= $links;


    endif;
    return $ret;
}

add_image_size('project-thumb', 285, 210, true);

function contact_icon_f($atts) {
    ?>
    <div class="social_share">    
        <?php if (@$atts['line'] == 'true')
        { ?>
            <span class="small_line"></span> <?php } ?>					
        <h4><?php echo _e("CONNECT", 'buchan_theme'); ?></h4>
        <ul>
            <?php if (get_option('twitter_val') != '')
            { ?>
                <li><a href="<?php echo get_option('twitter_val'); ?>" target="_blnak" class="cs"><i class="fa fa-twitter"></i></a></li>
            <?php } ?>
            <?php if (get_option('linkedin_val') != '')
            { ?>
                <li><a href="<?php echo get_option('linkedin_val'); ?>" target="_blnak" class="cs"><i class="fa fa-linkedin"></i></a></li>
            <?php } ?>
            <?php if (get_option('instagram_val') != '')
            { ?>
                <li><a href="<?php echo get_option('instagram_val'); ?>" target="_blnak" class="cs"><i class="fa fa-instagram"></i></a></li>
            <?php } ?>
            <?php if (get_option('pinterest_val') != '')
            { ?>
                <li><a href="<?php echo get_option('pinterest_val'); ?>" target="_blnak" class="cs"><i class="fa fa-pinterest"></i></a></li>
            <?php } ?>
            <?php if (get_option('weibo_val') != '')
            { ?>
                <li><a href="<?php echo get_option('weibo_val'); ?>" target="_blnak" class="cs"><i class="fa fa-weibo"></i></a></li>
    <?php } ?>
        </ul>

    </div><?php
}

add_shortcode('contact_icon', 'contact_icon_f');

function bartag_func($atts) {
    ?>
    <div class="social_share">    
    <?php if (@$atts['line'] == 'true')
    { ?>
            <span class="small_line"></span> <?php } ?>					
        <h4><?php echo _e("SHARE", 'buchan_theme'); ?></h4>
        <ul>

        <?php if (get_option('twitter_share_val') == 'enable')
        { ?>
                <li><a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>" target="_blnak"><i class="fa fa-twitter"></i></a></li>
        <?php } ?>
        <?php if (get_option('linkedin_share_val') == 'enable')
        { ?>
                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>" target="_blnak"><i class="fa fa-linkedin"></i></a></li>
        <?php } ?>
        <?php if (get_option('instagram_share_val') == 'enable')
        { ?>
                <li><a href="#" target="_blnak"><i class="fa fa-instagram"></i></a></li>
        <?php } ?>
        <?php if (get_option('pinterest_share_val') == 'enable')
        { ?>
                <li><a href="https://pinterest.com/pin/create/button/?url=<?php echo the_post_thumbnail_url('full'); ?>&media=aaaa&description=<?php echo get_the_title(); ?>" target="_blnak"><i class="fa fa-pinterest"></i></a></li>
    <?php } ?>
    <?php if (get_option('weibo_share_val') == 'enable')
    { ?>
                <li><a href="http://profitquery.com/add-to/weibo/?url=<?php echo get_permalink(); ?>&title=<?php echo get_the_title(); ?>&img=<?php echo the_post_thumbnail_url('full'); ?>" target="_blnak"><i class="fa fa-weibo"></i></a></li>
    <?php } ?>
    <?php if (get_option('envelope_share_val') == 'enable')
    { ?>
                <li><a href="mailto:&subject=<?php echo get_the_title(); ?>&body=<?php echo get_permalink(); ?>" target="_blnak"><i class="fa fa-envelope-o"></i></a></li>
    <?php } ?>

        </ul>

    </div><?php
}

add_shortcode('share_btns', 'bartag_func');

function share_btns_custom_function($atts) {
    ?>

    <h4><?php echo _e("SHARE", 'buchan_theme'); ?></h4>
    <ul>
    <?php if (get_option('twitter_share_val') == 'enable')
    { ?>
            <li><a href="https://twitter.com/intent/tweet?text=<?php echo $atts['title']; ?>&url=<?php echo $atts['link']; ?>" target="_blnak"><i class="fa fa-twitter"></i></a></li>
    <?php } ?>
    <?php if (get_option('linkedin_share_val') == 'enable')
    { ?>
            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $atts['link']; ?>&title=<?php echo get_the_title(); ?>" target="_blnak"><i class="fa fa-linkedin"></i></a></li>
    <?php } ?>
    <?php if (get_option('instagram_share_val') == 'enable')
    { ?>
            <li><a href="#" target="_blnak"><i class="fa fa-instagram"></i></a></li>
    <?php } ?>
    <?php if (get_option('pinterest_share_val') == 'enable')
    { ?>	
            <li><a href="https://pinterest.com/pin/create/button/?url=<?php echo the_post_thumbnail_url('full'); ?>&media=aaaa&description=<?php echo get_the_title(); ?>" target="_blnak"><i class="fa fa-pinterest"></i></a></li>
    <?php } ?>
    <?php if (get_option('weibo_share_val') == 'enable')
    { ?>
            <li><a href="http://profitquery.com/add-to/weibo/?url=<?php echo $atts['link']; ?>&title=<?php echo get_the_title(); ?>&img=<?php echo the_post_thumbnail_url('full'); ?>" target="_blnak"><i class="fa fa-weibo"></i></a></li>
    <?php } ?>
    <?php if (get_option('envelope_share_val') == 'enable')
    { ?>
            <li><a href="#" target="_blnak"><i class="fa fa-envelope-o"></i></a></li>
    <?php } ?>
    </ul>

    <?php
}

add_shortcode('share_btns_custom', 'share_btns_custom_function');


load_theme_textdomain('buchan_theme', get_template_directory() . '/languages');
add_image_size('page-listing', 615, 445);
add_image_size('location-thumb', 700, 438);
add_image_size('slider-image', 1950, 1218);
add_image_size('small-thumb', 600);



add_action('add_meta_boxes', 'add_events_metaboxes');

// Add the Events Meta Boxes

function add_events_metaboxes() {
    add_meta_box('wpt_events_location', 'Projects', 'wpt_events_location', 'person', 'normal', 'default');
}

function wpt_events_location() {
    global $post;


    $args = array(
        'post_type' => 'project',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'project_people',
                'value' => '"' . $post->ID . '"',
                'compare' => 'LIKE'
            )
        )
    );

// query
    $related = new WP_Query($args);


    //$related = new WP_Query( $query_var );		
    if ($related->have_posts())
    {
        while ($related->have_posts()) {
            $related->the_post();
            $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'project-thumb');
            $url = $src[0];
            $meta = get_post_meta($post->ID);
            ?> 								
            <div style="padding: 10px;float:left" class="listing_box element-item  <?php
            $a = wp_get_post_terms($post->ID, 'people-category');
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
            }
            ?>">
                <a target="_blank" href="<?php the_permalink() ?>">
                    <img alt="" src="<?php echo ($url != '') ? $url : 'http://localhost/buchan/wp-content/uploads/2016/11/project_list_img1.jpg'; ?>">
                    <div class="midl_overlay">
                        <div class="inner_text">
                            <div class="in_contain">
                                <h3 class="name"><?php the_title(); ?> <span><?php
            echo @$meta['people_position'][0];
            echo (@$meta['people_position'][0] != '' && @$meta['people_location'][0] != '') ? ', ' : '';
            echo @$meta['people_location'][0];
            ?></span></h3>
                            </div>
                        </div>
                    </div>
                </a>
                <div style="clear:both;"></div>
            </div>
            <?php
        }
    }wp_reset_query();
    ?>
    <div style="clear:both;"></div><?php
}

flush_rewrite_rules();

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit)
    {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    }
    else
    {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}

function content($limit) {
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit)
    {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    }
    else
    {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/[.+]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

add_filter('posts_orderby', $func = function ( $orderby, $query ) {
    global $wp_query;
    if ($wp_query->get('meta_key') == 'completion_date')
    {
        $start_date = date('Ymd');
        global $wpdb;
        $orderby = $wpdb->prepare(
                "
        CASE
            WHEN mt1.meta_value >= %d THEN CONCAT('A', mt1.meta_value)
            WHEN {$wpdb->postmeta}.meta_value AND mt1.meta_value THEN CONCAT('B', mt1.meta_value)
            WHEN {$wpdb->postmeta}.meta_value THEN 'C'
            ELSE 'D'
        END ASC
        "
                , $start_date
        );
    }

    return $orderby;
}, 10, 2);
?>