<?php
/**
 ** activation theme
 **/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

function custom_post_activity() {

    $labels = array(
        'name'                  => 'activite',
        'singular_name'         => 'activite',
        'menu_name'             => 'Activité',
        'name_admin_bar'        => 'Post Type',
        'archives'              => 'Item Archives',
        'attributes'            => 'Item Attributes',
        'parent_item_colon'     => 'Parent Item:',
        'all_items'             => 'All Items',
        'add_new_item'          => 'Add New Item',
        'add_new'               => 'Add New',
        'new_item'              => 'New Item',
        'edit_item'             => 'Edit Item',
        'update_item'           => 'Update Item',
        'view_item'             => 'View Item',
        'view_items'            => 'View Items',
        'search_items'          => 'Search Item',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list'            => 'Items list',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Filter items list',
    );
    $args = array(
        'label'                 => 'activite',
        'description'           => 'Ce que je fais',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'activity', $args );

}
add_action( 'init', 'custom_post_activity', 0 );

function add_custom_query_var( $vars ){
    $vars[] = "_";
    return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var' );

//ajouter une nouvelle zone de menu à mon thème
function register_my_menu() {
    register_nav_menu('social-menu',__( 'Menu Social Media' ));
}
add_action( 'init', 'register_my_menu' );


/*¨Shortcodes */
function shortcode_comission(){
    return "Les comissions sont <b>ouvertes</b>!";
}
add_shortcode('comissions', 'shortcode_comission');


function shortcode_shop($atts = '' ) {
$value = shortcode_atts( array(
    'item' =>" https://www.etsy.com/fr/shop/ClaireDelepee",
    'title' => "La boutique",
), $atts );

    return '<a href="'. $value["item"].'"><svg class="shoppingcart" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 483.688 483.688" style="enable-background:new 0 0 483.688 483.688;" xml:space="preserve">
<g>
	<path d="M473.6,92.43c-8.7-10.6-21.9-16.5-35.6-16.5H140.7c-8.5,0-16.6,2.4-23.6,6.7l-15.2-53.1c-2.5-8.7-10.4-14.7-19.4-14.7H59.4
		H15.3c-8.4,0-15.3,6.8-15.3,15.3v1.6c0,8.4,6.8,15.3,15.3,15.3h57.8l29.5,104.3l40.6,143.9c-23.1,5.8-40.2,26.7-40.2,51.5
		c0,28.1,21.9,51.2,49.6,53c-2.3,6.6-3.4,13.9-2.8,21.4c2,25.4,22.7,45.9,48.1,47.6c30.3,2.1,55.6-22,55.6-51.8c0-6-1-11.7-2.9-17.1
		h60.8c-2.5,7.1-3.5,15-2.6,23.1c2.8,24.6,23.1,44,47.9,45.8c30.3,2.1,55.7-21.9,55.7-51.8c0-28.9-24-52-52.8-52H156.5
		c-9.9,0-18.3-7.7-18.7-17.5c-0.4-10.4,7.9-18.9,18.2-18.9h30.5h165.3h46.5c20.6,0,38.6-14.1,43.6-34.1l40.4-162.6
		C485.8,117.83,482.6,103.53,473.6,92.43z M360.5,399.73c9.4,0,17.1,7.7,17.1,17.1s-7.7,17.1-17.1,17.1s-17.1-7.7-17.1-17.1
		S351,399.73,360.5,399.73z M201.6,399.73c9.4,0,17.1,7.7,17.1,17.1s-7.7,17.1-17.1,17.1c-9.4,0-17.1-7.7-17.1-17.1
		C184.5,407.43,192.1,399.73,201.6,399.73z M138.8,151.13l-7.8-27.5c-1.2-4.2,0.5-7.3,1.7-8.8c1.1-1.5,3.7-4,8-4h32.6l8.9,40.4
		h-43.4V151.13z M148.6,185.93h41.2l8.2,37.4h-38.9L148.6,185.93z M186.5,293.53c-4.5,0-8.5-3-9.7-7.4l-7.9-28h36.7l7.8,35.3h-26.9
		V293.53z M273.6,293.53H249l-7.8-35.3h32.3v35.3H273.6z M273.6,223.33h-40l-8.2-37.4h48.2V223.33z M273.6,151.13h-55.8l-8.9-40.4
		h64.7V151.13z M336,293.53h-27.5v-35.3h34.9L336,293.53z M350.8,223.33h-42.3v-37.4h50.2L350.8,223.33z M308.5,151.13v-40.4h66
		l-8.5,40.4H308.5z M408.2,285.93c-1.1,4.5-5.1,7.7-9.8,7.7h-26.8l7.5-35.3h36L408.2,285.93z M423.7,223.33h-37.3l7.9-37.4H433
		L423.7,223.33z M448.5,123.23l-6.9,27.8h-40l8.5-40.4h28.6c4.3,0,6.8,2.4,7.9,3.9C447.8,116.03,449.6,119.13,448.5,123.23z"/>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>'.$value["title"].'</a>';
}
add_shortcode('shop', 'shortcode_shop');

function agenda_shop(){
    return "<a >
<svg version=\"1.1\" id=\"Capa_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
	 viewBox=\"0 0 400 400\" style=\"enable-background:new 0 0 400 400;\" class='agenda-icon' xml:space=\"preserve\">
<g>
	<path d=\"M328.139,32.267h-2.941v-2.11C325.197,13.527,311.668,0,295.041,0c-16.627,0-30.156,13.527-30.156,30.157v2.11h-34.73
		v-2.11C230.154,13.527,216.625,0,200,0c-16.627,0-30.156,13.527-30.156,30.157v2.11h-34.73v-2.11
		C135.113,13.527,121.584,0,104.957,0C88.332,0,74.803,13.527,74.803,30.157v2.11h-2.943c-24.789,0-44.887,20.096-44.887,44.886
		v277.962c0,24.79,20.098,44.886,44.887,44.886h256.279c24.789,0,44.889-20.096,44.889-44.886V77.152
		C373.027,52.362,352.93,32.267,328.139,32.267z M286.816,30.157c0-4.536,3.689-8.224,8.225-8.224c4.535,0,8.223,3.688,8.223,8.224
		v40.127c0,4.534-3.688,8.223-8.223,8.223c-4.535,0-8.225-3.689-8.225-8.223V30.157z M191.777,30.157
		c0-4.536,3.688-8.224,8.223-8.224s8.223,3.688,8.223,8.224v40.127c0,4.534-3.688,8.223-8.223,8.223s-8.223-3.689-8.223-8.223
		V30.157z M96.736,30.157c0-4.536,3.686-8.224,8.221-8.224c4.535,0,8.227,3.688,8.227,8.224v40.127c0,4.534-3.691,8.223-8.227,8.223
		c-4.535,0-8.221-3.689-8.221-8.223V30.157z M337.117,353.453c0,5.867-4.029,10.639-8.978,10.639H71.859
		c-4.949,0-8.977-4.771-8.977-10.639V118.955h274.234V353.453z\"/>
	<path d=\"M156.098,312.935H243.9c7.338,0,13.307-5.97,13.307-13.307v-3.852c0-7.337-5.969-13.307-13.307-13.307h-54.115
		l30.73-34.225c16.955-17.682,26.682-36.571,26.682-51.824c0-13.639-5.184-25.133-14.984-33.239
		c-9.063-7.492-21.598-11.453-36.256-11.453c-17.789,0-36.199,8.069-49.242,21.587c-5.006,5.189-4.932,13.555,0.168,18.65
		l2.693,2.697c2.477,2.477,5.916,3.897,9.541,3.897h0.002c3.551-0.036,6.996-1.522,9.453-4.08
		c7.297-7.579,17.787-12.288,27.385-12.288c13.785,0,20.773,4.789,20.773,14.228c0,5.695-5.709,17.772-18.301,30.896l-52.223,58.017
		c-2.203,2.449-3.414,5.61-3.414,8.903v5.392C142.793,306.965,148.76,312.935,156.098,312.935z\"/>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
   
Les prochaines conventions ?</a>";
}
add_shortcode('agenda', 'agenda_shop');


function shortcode_patreon($atts = '' ) {
    $value = shortcode_atts( array(
        'title' => "Explorez les coulisses de mon travail sur Patreon",
        'margin' =>'-25px',
        'link'=>'https://www.patreon.com/ClaireDelepee'
    ), $atts );

    return '<a style="text-align: center; display: block; font-style: italic; margin-top:'.$value['margin'].';border-bottom: none" href="'.$value['link'].'"><span class="patreon" >'.$value["title"].' <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#000000">
  <path d="M 2 3 L 2 21 L 6 21 L 6 3 L 2 3 z M 15 3 C 11.141 3 8 6.141 8 10 C 8 13.859 11.141 17 15 17 C 18.859 17 22 13.859 22 10 C 22 6.141 18.859 3 15 3 z"/>
</svg></span>
</a>';
}
add_shortcode('patreon', 'shortcode_patreon');
