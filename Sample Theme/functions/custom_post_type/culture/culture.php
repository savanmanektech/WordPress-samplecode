<?php 
register_post_type( 'cultures',
    array(
    'labels'             => array(
    'name'               => __('Culture'            		),
    'singular_name'      => __('culture'                    ),
    'add_new'            => __('Add culture'                ),
    'all_items'          => __('All culture'                ),
    'add_new_item'       => __('Add New culture'            ),
    'edit_item'          => __('Edit culture'               ),
    'new_item'           => __('New culture'                ),
    'view_item'          => __('View culture'               ),
    'search_items'       => __('Search culture'             ),
    'not_found'          => __('No culture found'           ),
    'not_found_in_trash' => __('No culture found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'cultures'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

	
//include 'slider_columns.php';
?>