<?php 
register_post_type( 'thought',
    array(
    'labels'             => array(
    'name'               => __('Thoughts'            		),
    'singular_name'      => __('Thoughts'                    ),
    'add_new'            => __('Add Thought'                ),
    'all_items'          => __('All Thoughts'                ),
    'add_new_item'       => __('Add New Thought'            ),
    'edit_item'          => __('Edit Thought'               ),
    'new_item'           => __('New Thought'                ),
    'view_item'          => __('View Thought'               ),
    'search_items'       => __('Search Thoughts'             ),
    'not_found'          => __('No Thought found'           ),
    'not_found_in_trash' => __('No Thought found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'thought'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

	
//include 'slider_columns.php';
?>