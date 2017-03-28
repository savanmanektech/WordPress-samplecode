<?php 
register_post_type( 'studio',
    array(
    'labels'             => array(
    'name'               => __('Studio'            		),
    'singular_name'      => __('Studio'                    ),
    'add_new'            => __('Add Studio'                ),
    'all_items'          => __('All Studio'                ),
    'add_new_item'       => __('Add New Studio'            ),
    'edit_item'          => __('Edit Studio'               ),
    'new_item'           => __('New Studio'                ),
    'view_item'          => __('View Studio'               ),
    'search_items'       => __('Search Studio'             ),
    'not_found'          => __('No Studio found'           ),
    'not_found_in_trash' => __('No Studio found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'studio'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

	
//include 'slider_columns.php';
?>