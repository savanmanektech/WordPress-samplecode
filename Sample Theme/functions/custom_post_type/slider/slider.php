<?php 
register_post_type( 'slider',
    array(
    'labels'             => array(
    'name'               => __('Slider'            		),
    'singular_name'      => __('slide'                    ),
    'add_new'            => __('Add Slide'                ),
    'all_items'          => __('All Slide'                ),
    'add_new_item'       => __('Add New slide'            ),
    'edit_item'          => __('Edit slide'               ),
    'new_item'           => __('New slide'                ),
    'view_item'          => __('View slide'               ),
    'search_items'       => __('Search slide'             ),
    'not_found'          => __('No slide found'           ),
    'not_found_in_trash' => __('No slide found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'slider'),
			'capability_type'    => 'post',
    'supports'     => array( 'title','editor','thumbnail'),
	'taxonomies'          => array( 'category' ),
    )
); 
include 'slider_columns.php';
?>