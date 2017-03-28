<?php 
register_post_type( 'article',
    array(
    'labels'             => array(
    'name'               => __('Newsletter'            		),
    'singular_name'      => __('Newsletter'                    ),
    'add_new'            => __('Add Newsletter'                ),
    'all_items'          => __('All Newsletter'                ),
    'add_new_item'       => __('Add New Newsletter'            ),
    'edit_item'          => __('Edit Newsletter'               ),
    'new_item'           => __('New Newsletter'                ),
    'view_item'          => __('View Newsletter'               ),
    'search_items'       => __('Search Newsletter'             ),
    'not_found'          => __('No Newsletter found'           ),
    'not_found_in_trash' => __('No Newsletter found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-admin-users',
    'rewrite'      => array('slug'=>'article'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

