<?php 
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        'name' => 'Search',
        'id' => 'search'
    ));
    
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="title">',
        'after_title' => '</h2><div class="sidebar">',
        'name' => 'Sidebar',
        'id' => 'sidebar'
    ));
}
?>