<?php
/**
 * Plugin Name: Chopping Block Projects Custom Post Type
 * Plugin URI: https://github.com/choppingblock/adv-wp-plugin-cb-projects
 * Description: A brief description of the Plugin.
 * Version: 0.1
 * Author: Matthew Richmond
 * Author URI: http://choppingblock.com
 * License: MIT
 */

function create_cb_projects_type() {

	$labels = array( 
        'name' => _x( 'Projects', 'project' ),
        'singular_name' => _x( 'Project', 'project' ),
        'add_new' => _x( 'Add New', 'project' ),
        'add_new_item' => _x( 'Add New Project', 'project' ),
        'edit_item' => _x( 'Edit project', 'project' ),
        'new_item' => _x( 'New project', 'project' ),
        'view_item' => _x( 'View project', 'project' ),
        'search_items' => _x( 'Search Projects', 'project' ),
        'not_found' => _x( 'No projects found', 'project' ),
        'not_found_in_trash' => _x( 'No projects found in Trash', 'project' ),
        'parent_item_colon' => _x( 'Parent project:', 'project' ),
        'menu_name' => _x( 'Projects', 'project' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'A project in our collection',
        'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'revisions', 'excerpt', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
		'rewrite' => array('slug' => 'projects'),
        'capability_type' => 'post'
    );

    register_post_type( 'cb_project', $args );

	// create a tag based taxonomy for your projects
	register_taxonomy(
			'cb_project_tag',
			'cb_project',
			array(
				'label' => __( 'Project Tags' ),
				'rewrite' => array( 'slug' => 'cb-project-tag' )			
			)
		);	
	
	// create a category based taxonomy for your projects
	register_taxonomy(
			'cb_project_category',
			'cb_project',
			array(
				'label' => __( 'Project Categories' ),
				'hierarchical' => true,
				'rewrite' => array( 'slug' => 'cb-project-category' )			
			)
		);

}

add_action( 'init', 'create_cb_projects_type' );

// Add this custom post type to the widgets
function widget_posts_args_add_custom_type($params) {
    $params['post_type'] = array('post', 'cb_project');
    return $params;
}

add_filter('widget_posts_args', 'widget_posts_args_add_custom_type');


?>