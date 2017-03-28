<?php 
register_post_type( 'person',
    array(
    'labels'             => array(
    'name'               => __('People'            		),
    'singular_name'      => __('People'                    ),
    'add_new'            => __('Add People'                ),
    'all_items'          => __('All People'                ),
    'add_new_item'       => __('Add New People'            ),
    'edit_item'          => __('Edit People'               ),
    'new_item'           => __('New People'                ),
    'view_item'          => __('View People'               ),
    'search_items'       => __('Search People'             ),
    'not_found'          => __('No People found'           ),
    'not_found_in_trash' => __('No People found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-admin-users',
    'rewrite'      => array('slug'=>'person'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 



 register_taxonomy(
        'people-category',
        'person',
        array(
			'label' => __( 'Category' ),
			'rewrite' => array( 'slug' => 'people-category' ),
			'hierarchical' => true,
		)
    );
	register_taxonomy(
        'people-sector',
        'person',
        array(
			'label' => __( 'Sector' ),
			'rewrite' => array( 'slug' => 'people-sector' ),
			'hierarchical' => true,
		)
    );
	register_taxonomy(
        'people-region',
        'person',
        array(
			'label' => __( 'Region' ),
			'rewrite' => array( 'slug' => 'people-region' ),
			'hierarchical' => true,
		)
    );
	
	
//include 'slider_columns.php';
?>