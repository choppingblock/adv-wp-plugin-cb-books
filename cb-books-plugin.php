<?php
/**
 * Plugin Name: Chopping Block Books Custom Post Type
 * Plugin URI: https://github.com/choppingblock/adv-wp-plugin-cb-books
 * Description: A brief description of the Plugin.
 * Version: 0.1
 * Author: Matthew Richmond
 * Author URI: http://choppingblock.com
 * License: MIT
 */

function create_cb_books_type() {

	$labels = array( 
        'name' => _x( 'Books', 'book' ),
        'singular_name' => _x( 'Book', 'book' ),
        'add_new' => _x( 'Add New', 'book' ),
        'add_new_item' => _x( 'Add New Book', 'book' ),
        'edit_item' => _x( 'Edit book', 'book' ),
        'new_item' => _x( 'New book', 'book' ),
        'view_item' => _x( 'View book', 'book' ),
        'search_items' => _x( 'Search Books', 'book' ),
        'not_found' => _x( 'No books found', 'book' ),
        'not_found_in_trash' => _x( 'No books found in Trash', 'book' ),
        'parent_item_colon' => _x( 'Parent book:', 'book' ),
        'menu_name' => _x( 'Books', 'book' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'A book in our collection',
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
		'rewrite' => array('slug' => 'books'),
        'capability_type' => 'post'
    );

    register_post_type( 'cb_book', $args );

	// create a tag based taxonomy for your books
	register_taxonomy(
			'cb_book_tag',
			'cb_book',
			array(
				'label' => __( 'Tags' ),
				'rewrite' => array( 'slug' => 'cb-book-tag' )			
			)
		);	
	
	// create a category based taxonomy for your books
	register_taxonomy(
			'cb_book_category',
			'cb_book',
			array(
				'label' => __( 'Category' ),
				'hierarchical' => true,
				'rewrite' => array( 'slug' => 'cb-book-category' )			
			)
		);

}

add_action( 'init', 'create_cb_books_type' );


?>