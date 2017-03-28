<?php 
register_post_type( 'project',
    array(
    'labels'             => array(
    'name'               => __('Project'            		),
    'singular_name'      => __('Project'                    ),
    'add_new'            => __('Add Project'                ),
    'all_items'          => __('All Projects'                ),
    'add_new_item'       => __('Add New Project'            ),
    'edit_item'          => __('Edit Project'               ),
    'new_item'           => __('New Project'                ),
    'view_item'          => __('View Projects'               ),
    'search_items'       => __('Search Projects'             ),
    'not_found'          => __('No Projects found'           ),
    'not_found_in_trash' => __('No Projects found in Trash'  )
    ),
    'public'       => true,
    'has_archive'  => true,
    'menu_icon'    => 'dashicons-images-alt',
    'rewrite'      => array('slug'=>'project'),
    'supports'     => array( 'title','editor','thumbnail'),
    )
); 

 register_taxonomy(
        'project-category',
        'project',
        array(
			'label' => __( 'Category' ),
			'rewrite' => array( 'slug' => 'project-category' ),
			'hierarchical' => true,
		)
    );
	register_taxonomy(
        'project-sector',
        'project',
        array(
			'label' => __( 'Sector' ),
			'rewrite' => array( 'slug' => 'project-sector' ),
			'hierarchical' => true,
		)
    );
	register_taxonomy(
        'project-region',
        'project',
        array(
			'label' => __( 'Region' ),
			'rewrite' => array( 'slug' => 'project-region' ),
			'hierarchical' => true,
		)
    );
	
	
//include 'slider_columns.php';
?>