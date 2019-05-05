<?php

/**
 * Registers the `submissions` post type.
 */
function submissions_init() {
	register_post_type( 'submissions', array(
		'labels'                => array(
			'name'                  => __( 'Submissions', 'launchpod' ),
			'singular_name'         => __( 'Submissions', 'launchpod' ),
			'all_items'             => __( 'All Submissions', 'launchpod' ),
			'archives'              => __( 'Submissions Archives', 'launchpod' ),
			'attributes'            => __( 'Submissions Attributes', 'launchpod' ),
			'insert_into_item'      => __( 'Insert into submissions', 'launchpod' ),
			'uploaded_to_this_item' => __( 'Uploaded to this submissions', 'launchpod' ),
			'featured_image'        => _x( 'Featured Image', 'submissions', 'launchpod' ),
			'set_featured_image'    => _x( 'Set featured image', 'submissions', 'launchpod' ),
			'remove_featured_image' => _x( 'Remove featured image', 'submissions', 'launchpod' ),
			'use_featured_image'    => _x( 'Use as featured image', 'submissions', 'launchpod' ),
			'filter_items_list'     => __( 'Filter submissions list', 'launchpod' ),
			'items_list_navigation' => __( 'Submissions list navigation', 'launchpod' ),
			'items_list'            => __( 'Submissions list', 'launchpod' ),
			'new_item'              => __( 'New Submissions', 'launchpod' ),
			'add_new'               => __( 'Add New', 'launchpod' ),
			'add_new_item'          => __( 'Add New Submissions', 'launchpod' ),
			'edit_item'             => __( 'Edit Submissions', 'launchpod' ),
			'view_item'             => __( 'View Submissions', 'launchpod' ),
			'view_items'            => __( 'View Submissions', 'launchpod' ),
			'search_items'          => __( 'Search submissions', 'launchpod' ),
			'not_found'             => __( 'No submissions found', 'launchpod' ),
			'not_found_in_trash'    => __( 'No submissions found in trash', 'launchpod' ),
			'parent_item_colon'     => __( 'Parent Submissions:', 'launchpod' ),
			'menu_name'             => __( 'Submissions', 'launchpod' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'comments', 'author'),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'submissions',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'submissions_init' );

/**
 * Sets the post updated messages for the `submissions` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `submissions` post type.
 */
function submissions_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['submissions'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Submissions updated. <a target="_blank" href="%s">View submissions</a>', 'launchpod' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'launchpod' ),
		3  => __( 'Custom field deleted.', 'launchpod' ),
		4  => __( 'Submissions updated.', 'launchpod' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Submissions restored to revision from %s', 'launchpod' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Submissions published. <a href="%s">View submissions</a>', 'launchpod' ), esc_url( $permalink ) ),
		7  => __( 'Submissions saved.', 'launchpod' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Submissions submitted. <a target="_blank" href="%s">Preview submissions</a>', 'launchpod' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Submissions scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview submissions</a>', 'launchpod' ),
		date_i18n( __( 'M j, Y @ G:i', 'launchpod' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Submissions draft updated. <a target="_blank" href="%s">Preview submissions</a>', 'launchpod' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'submissions_updated_messages' );
