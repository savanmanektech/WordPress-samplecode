<?php 
function new_excerpt_length($length) {
    return 70;
}

add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    return '';
}

add_filter('excerpt_more', 'new_excerpt_more');

if (function_exists('add_theme_support')) 
{
    add_theme_support('post-thumbnails');
}
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );

    function mw_enqueue_color_picker( $hook_suffix ) {
        // first check that $hook_suffix is appropriate for your admin page
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
    
    
function load_admin_things() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

add_action( 'admin_enqueue_scripts', 'load_admin_things' );

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_option('logo_image'); ?>);
            background-size : 100%;
            height: <?php echo get_option('logo_height'); ?>px;
            width: <?php echo get_option('logo_width'); ?>px;
            max-width: 100%; 
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
/*End Of Changing Login logo*/


add_action('init', 'my_out');

function my_out() 
{
        ob_start();
}

add_theme_support( 'menus' );
?>