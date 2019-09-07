<?php
//
// Portfolio Post Type related functions.
//
add_action( 'init', 'ci_create_cpt_portfolio' );

if( !function_exists('ci_create_cpt_portfolio') ):
function ci_create_cpt_portfolio() {
	$labels = array(
		'name'               => _x('Portfolio', 'post type general name', 'ci_theme'),
		'singular_name'      => _x('Portfolio Item', 'post type singular name', 'ci_theme'),
		'add_new'            => __('Add New', 'ci_theme'),
		'add_new_item'       => __('Add New Portfolio Item', 'ci_theme'),
		'edit_item'          => __('Edit Portfolio Item', 'ci_theme'),
		'new_item'           => __('New Portfolio Item', 'ci_theme'),
		'view_item'          => __('View Portfolio Item', 'ci_theme'),
		'search_items'       => __('Search Portfolio Items', 'ci_theme'),
		'not_found'          => __('No Portfolio Items found', 'ci_theme'),
		'not_found_in_trash' => __('No Portfolio Items found in the trash', 'ci_theme'),
		'parent_item_colon'  => __('Parent Portfolio Item:', 'ci_theme')
	);

	$args = array(
		'labels'          => $labels,
		'singular_label'  => __('Portfolio Item', 'ci_theme'),
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => false,
		'rewrite'         => array( 'slug' => _x( 'portfolio', 'post type slug', 'ci_theme' ) ),
		'menu_position'   => 5,
		'supports'        => array('title', 'editor', 'thumbnail'),
		'menu_icon'       => 'dashicons-portfolio',
        'taxonomies'  => array( 'category' ),
	);
	register_post_type( 'portfolio' , $args );
}
endif;

add_action( 'load-post.php', 'ci_portfolio_meta_boxes_setup' );
add_action( 'load-post-new.php', 'ci_portfolio_meta_boxes_setup' );

if ( !function_exists('ci_portfolio_meta_boxes_setup') ):
function ci_portfolio_meta_boxes_setup() {
	add_action( 'add_meta_boxes', 'ci_portfolio_add_meta_boxes' );
	add_action( 'save_post', 'ci_portfolio_save_meta', 10, 2 );
}
endif;

if ( !function_exists('ci_portfolio_add_meta_boxes') ):
function ci_portfolio_add_meta_boxes() {
	add_meta_box( 'portfolio-box', __( 'Portfolio Settings', 'ci_theme' ), 'ci_portfolio_score_meta_box', 'portfolio', 'normal', 'high' );
}
endif;

if ( !function_exists('ci_portfolio_score_meta_box') ):
function ci_portfolio_score_meta_box( $object, $box ) {

	ci_prepare_metabox('portfolio');

	?><p><?php _e('If this is a video, you can enter the video URL below (YouTube, Vimeo, etc).', 'ci_theme'); ?></p><?php

	ci_metabox_input('ci_cpt_video_url', __('Video URL:', 'ci_theme'), array('esc_func' => 'esc_url'));

	?><h4><?php _e('Gallery Settings', 'ci_theme'); ?></h4>

	<p><?php _e('You can create a gallery for your portfolio item by pressing the "Add Images" button below. You should also set a featured image that will be used as this portfolio item\'s cover.', 'ci_theme'); ?></p><?php

	ci_metabox_gallery();

	?><p><?php _e('You can display your work in three different layouts: 1) Image array, 2) Standard image slideshow, 3) Fullwidth image slideshow', 'ci_theme'); ?></p><?php
	$opts = array(
		'standard' => __('Image Array', 'ci_theme'),
		'standard-flex' => __('Image Slideshow', 'ci_theme'),
		'fullwidth-flex' => __('Fullwidth Slideshow', 'ci_theme')
	);

	ci_metabox_dropdown('ci_cpt_portfolio_template', $opts, __('Portfolio Template:', 'ci_theme'));

}
endif;

if ( !function_exists('ci_portfolio_save_meta') ) :
function ci_portfolio_save_meta( $post_id, $post )
{
	if ( !ci_can_save_meta('portfolio') ) return;

	ci_metabox_gallery_save($_POST);
	update_post_meta($post_id, "ci_cpt_portfolio_url", esc_url_raw($_POST["ci_cpt_portfolio_url"]));
	update_post_meta($post_id, "ci_cpt_video_url", esc_url_raw($_POST["ci_cpt_video_url"]));
	update_post_meta($post_id, "ci_cpt_portfolio_template", sanitize_key($_POST["ci_cpt_portfolio_template"]));

}
endif;
?>