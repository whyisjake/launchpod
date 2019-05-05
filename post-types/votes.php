<?php

/**
 * Registers the `votes` post type.
 */
function votes_init() {
	register_post_type( 'votes', array(
		'labels'                => array(
			'name'                  => __( 'Votes', 'launchpod' ),
			'singular_name'         => __( 'Votes', 'launchpod' ),
			'all_items'             => __( 'All Votes', 'launchpod' ),
			'archives'              => __( 'Votes Archives', 'launchpod' ),
			'attributes'            => __( 'Votes Attributes', 'launchpod' ),
			'insert_into_item'      => __( 'Insert into votes', 'launchpod' ),
			'uploaded_to_this_item' => __( 'Uploaded to this votes', 'launchpod' ),
			'featured_image'        => _x( 'Featured Image', 'votes', 'launchpod' ),
			'set_featured_image'    => _x( 'Set featured image', 'votes', 'launchpod' ),
			'remove_featured_image' => _x( 'Remove featured image', 'votes', 'launchpod' ),
			'use_featured_image'    => _x( 'Use as featured image', 'votes', 'launchpod' ),
			'filter_items_list'     => __( 'Filter votes list', 'launchpod' ),
			'items_list_navigation' => __( 'Votes list navigation', 'launchpod' ),
			'items_list'            => __( 'Votes list', 'launchpod' ),
			'new_item'              => __( 'New Votes', 'launchpod' ),
			'add_new'               => __( 'Add New', 'launchpod' ),
			'add_new_item'          => __( 'Add New Votes', 'launchpod' ),
			'edit_item'             => __( 'Edit Votes', 'launchpod' ),
			'view_item'             => __( 'View Votes', 'launchpod' ),
			'view_items'            => __( 'View Votes', 'launchpod' ),
			'search_items'          => __( 'Search votes', 'launchpod' ),
			'not_found'             => __( 'No votes found', 'launchpod' ),
			'not_found_in_trash'    => __( 'No votes found in trash', 'launchpod' ),
			'parent_item_colon'     => __( 'Parent Votes:', 'launchpod' ),
			'menu_name'             => __( 'Votes', 'launchpod' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'votes',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'votes_init' );

/**
 * Sets the post updated messages for the `votes` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `votes` post type.
 */
function votes_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['votes'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Votes updated. <a target="_blank" href="%s">View votes</a>', 'launchpod' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'launchpod' ),
		3  => __( 'Custom field deleted.', 'launchpod' ),
		4  => __( 'Votes updated.', 'launchpod' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Votes restored to revision from %s', 'launchpod' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Votes published. <a href="%s">View votes</a>', 'launchpod' ), esc_url( $permalink ) ),
		7  => __( 'Votes saved.', 'launchpod' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Votes submitted. <a target="_blank" href="%s">Preview votes</a>', 'launchpod' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Votes scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview votes</a>', 'launchpod' ),
		date_i18n( __( 'M j, Y @ G:i', 'launchpod' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Votes draft updated. <a target="_blank" href="%s">Preview votes</a>', 'launchpod' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'votes_updated_messages' );
