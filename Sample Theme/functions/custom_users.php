<?php 
    $result = add_role(
        'client',
        __( 'Client' ),
        array(
            'read'              => true,
            'edit_posts'        => true,
            'delete_posts'      => false,
            'switch_themes'     => false,
            'edit_themes'       => false,
            'edit_theme_options' => true,
            'activate_plugins' => false,
            'edit_plugins' => false,
            'install_plugins' => false,
            'edit_users' => false,
            'manage_options' => true,
            'moderate_comments' => true,
            'manage_categories' => true,
            'manage_links' => true,
            'upload_files' => true,
            'edit_others_posts' => true,
            'edit_published_posts' => true,
            'publish_posts' => true,
            'edit_pages' => true,
            'publish_pages' => true,
            'edit_others_pages' => true,
            'edit_published_pages' => true,
            'delete_pages' => false,
            'delete_others_pages' => false,
            'delete_published_pages' => false,
            'delete_posts' => false,
            'delete_others_posts' => false,
            'delete_published_posts' => false,
            'delete_private_posts' => false,
            'edit_private_posts' => true,
            'read_private_posts' => true,
            'delete_private_pages' => false,
            'edit_private_pages' => true,
            'read_private_pages' => true,
            'delete_users' => false,
            'create_users' => false,
            'unfiltered_upload' => true,
            'edit_dashboard' => true,
            'update_plugins' => false,
            'delete_plugins' => false,
            'update_themes' => false,
            'update_core' => false,
            'list_users' => true,
            'remove_users' => false,
            'add_users' => false,
            'promote_users' => true,
            'delete_themes' => false,
            'export' => false,
            'edit_comment' => true,
            'manage_network' => false,
            'manage_sites' => false,
            'manage_network_users' => false,
            'manage_network_themes' => false,
            'manage_network_options' => false
        )
    );

    $client = get_role( 'client' );
    $client->add_cap( 'administrator' ); 
    
    //remove_role('client');
    
?>