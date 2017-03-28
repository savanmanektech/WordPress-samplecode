<?php 
register_post_type( 'profiles',
    array(
    'labels'             => array(
    'name'               => __('Profile'            		),
    'singular_name'      => __('profile'                    ),
    'add_new'            => __('Add profile'                ),
    'all_items'          => __('All profile'                ),
    'add_new_item'       => __('Add New profile'            ),
    'edit_item'          => __('Edit profile'               ),
    'new_item'           => __('New profile'                ),
    'view_item'          => __('View profile'               ),
    'search_items'       => __('Search profile'             ),
    'not_found'          => __('No profile found'           ),
    'not_found_in_trash' => __('No profile found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'profiles'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

	
//include 'slider_columns.php';
?>