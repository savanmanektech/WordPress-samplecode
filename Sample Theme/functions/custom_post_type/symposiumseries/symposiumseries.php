<?php 
register_post_type( 'symposiumseries',
    array(
    'labels'             => array(
    'name'               => __('Symposium Series'            		),
    'singular_name'      => __('Symposium Series'                    ),
    'add_new'            => __('Add Symposium Series'                ),
    'all_items'          => __('All Symposium Series'                ),
    'add_new_item'       => __('Add New Symposium Series'            ),
    'edit_item'          => __('Edit Symposium Series'               ),
    'new_item'           => __('New Symposium Series'                ),
    'view_item'          => __('View Symposium Series'               ),
    'search_items'       => __('Search Symposium Series'             ),
    'not_found'          => __('No Symposium Series found'           ),
    'not_found_in_trash' => __('No Symposium Series found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'symposiumseries'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

	
//include 'slider_columns.php';
?>