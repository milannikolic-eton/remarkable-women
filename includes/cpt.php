<?php
// Create custom post type Stories
function create_post_type_stories(){
    register_post_type('stories', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Stories', 'rwwt'), 
            'singular_name' => __('Story', 'rwwt'),
            'add_new' => __('Add New', 'rwwt'),
            'add_new_item' => __('Add New Story', 'rwwt'),
            'edit' => __('Edit', 'rwwt'),
            'edit_item' => __('Edit Story', 'rwwt'),
            'new_item' => __('New Story', 'rwwt'),
            'view' => __('View Stories', 'rwwt'),
            'view_item' => __('View Story', 'rwwt'),
            'search_items' => __('Search Stories', 'rwwt'),
            'not_found' => __('No Story found', 'rwwt'),
            'not_found_in_trash' => __('No Story found in Trash', 'rwwt')
        ),
        'menu_icon' => 'dashicons-index-card', // Dashicon class
        'public' => true,
        'hierarchical' => false, 
        'show_in_rest' => true,
        'has_archive' => false,
			  'publicly_queryable' => true,
        'supports' => array(
            'title',
            'editor',
            'page-attributes',
            'excerpt',
            'thumbnail'
        ), //
        'can_export' => true, // Allows export in Tools > Export
    ));
}
add_action('init', 'create_post_type_stories'); 



  // Register Custom Taxonomy
function stories_taxonomy() {

    $labels = array(
      'name'                       => _x( 'Stories countries', 'rwwt' ),
      'singular_name'              => _x( 'Story country', 'rwwt' ),
      'menu_name'                  => __( 'Stories countries', 'rwwt' ),
      'all_items'                  => __( 'All Stories countries', 'rwwt' ),
      'parent_item'                => __( 'Parent Story country', 'rwwt' ),
      'parent_item_colon'          => __( 'Parent Story country:', 'rwwt' ),
      'new_item_name'              => __( 'New Story country', 'rwwt' ),
      'add_new_item'               => __( 'Add Story country', 'rwwt' ),
      'edit_item'                  => __( 'Edit Story country', 'rwwt' ),
      'update_item'                => __( 'Update Story country', 'rwwt' ),
      'view_item'                  => __( 'View Story country', 'rwwt' ),
      'separate_items_with_commas' => __( 'Separate Story country with commas', 'rwwt' ),
      'add_or_remove_items'        => __( 'Add or remove Story country', 'rwwt' ),
      'choose_from_most_used'      => __( 'Choose from the most used', 'rwwt' ),
      'popular_items'              => __( 'Popular Stories countries', 'rwwt' ),
      'search_items'               => __( 'Search Stories countries', 'rwwt' ),
      'not_found'                  => __( 'Not Found', 'rwwt' ),
      'no_terms'                   => __( 'No Stories countries', 'rwwt' ),
      'items_list'                 => __( 'Stories countries list', 'rwwt' ),
      'items_list_navigation'      => __( 'Stories countriess list navigation', 'rwwt' ),
    );
    $args = array(
      'labels'                     => $labels,
      'hierarchical'               => false,
      'show_in_rest' => true,
      'public'                     => true,
      'show_ui'                    => true,
      'show_admin_column'          => true,
      'show_in_nav_menus'          => true,
      'show_tagcloud'              => true,
      'exclude_from_search'        => false,
      'has_archive'       =>  false,

    );
    register_taxonomy( 'stories_country', 'stories', $args );
  }
  add_action( 'init', 'stories_taxonomy', 0 );




  // Create custom post type Voices
function create_post_type_voice(){
  register_post_type('voice', // Register Custom Post Type
      array(
      'labels' => array(
          'name' => __('Voices', 'rwwt'), 
          'singular_name' => __('Voice', 'rwwt'),
          'add_new' => __('Add New', 'rwwt'),
          'add_new_item' => __('Add New Voice', 'rwwt'),
          'edit' => __('Edit', 'rwwt'),
          'edit_item' => __('Edit Voice', 'rwwt'),
          'new_item' => __('New Voice', 'rwwt'),
          'view' => __('View Voices', 'rwwt'),
          'view_item' => __('View Voice', 'rwwt'),
          'search_items' => __('Search Voices', 'rwwt'),
          'not_found' => __('No Voice found', 'rwwt'),
          'not_found_in_trash' => __('No Voice found in Trash', 'rwwt')
      ),
      'menu_icon' => 'dashicons-testimonial', // Dashicon class
      'public' => true,
      'hierarchical' => false, 
      'show_in_rest' => true,
      'has_archive' => false,
      'publicly_queryable' => false,
      'supports' => array(
          'title',
          'editor',
      ), //
      'can_export' => true, // Allows export in Tools > Export
  ));
}
add_action('init', 'create_post_type_voice'); 