<?php 
register_post_type( 'news',
    array(
    'labels'             => array(
    'name'               => __('News'            		),
    'singular_name'      => __('news'                    ),
    'add_new'            => __('Add News'                ),
    'all_items'          => __('All News'                ),
    'add_new_item'       => __('Add New News'            ),
    'edit_item'          => __('Edit News'               ),
    'new_item'           => __('New News'                ),
    'view_item'          => __('View News'               ),
    'search_items'       => __('Search News'             ),
    'not_found'          => __('No News found'           ),
    'not_found_in_trash' => __('No News found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'news'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

 register_taxonomy(
        'region',
        'news',
        array(
			'label' => __( 'Region' ),
			'rewrite' => array( 'slug' => 'genre' ),
			'hierarchical' => true,
		)
    );
	
	
//include 'slider_columns.php';
?>