<?php
$id = get_the_ID();
// adding the CSS and JS files

function gt_setup(){
    wp_enqueue_style('bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Oswald|Roboto');
    wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
    wp_enqueue_style('calendly', '//assets.calendly.com/assets/external/widget.css');
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());

    wp_enqueue_script('calendly', '//assets.calendly.com/assets/external/widget.js');
    
    wp_enqueue_script("main", get_theme_file_uri('/js/main.js'), NULL, microtime(), true);
	
	$id = get_the_ID();
    if ($id == 827){
        wp_enqueue_script("crud", get_theme_file_uri('/js/crud.js'), NULL, microtime(), true);
        wp_enqueue_script("web3", get_theme_file_uri('/js/web3.js'), NULL, microtime(), true);
    }
    if ($id == 941){
        wp_enqueue_script("etherwallet", get_theme_file_uri('/js/etherwallet.js'), NULL, microtime(), true);
        wp_enqueue_script("web3", get_theme_file_uri('/js/web3.js'), NULL, microtime(), true);
    }
}

add_action('wp_enqueue_scripts', 'gt_setup');

// Adding Theme Support

function gt_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', 
        array('comment-list', 'comment-form', 'search-form')
);
}

add_action('after_setup_theme', 'gt_init');

// Projects Post Type

function gt_custom_post_type() {
    register_post_type('project', 
        array(
            'rewrite' => array('slug' => 'projects'),
            'labels' => array(
                'name' => 'Projects',
                'singular_name' => 'Project',
                'add_new_item' => 'Add New Project',
                'edit_item' => 'Edit Project'
            ),
            'menu-icon' => 'dashicons-clipboard',
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title', 'thumbnail', 'editor', 'excerpt', 'comments'
            )
        )
    );
}

add_action('init', 'gt_custom_post_type');


// Sidebar

function gt_widgets() {
    register_sidebar(
        array(
            'name' => 'Main Sidebar',
            'id' => 'main_sidebar',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
        );
}

add_action('widgets_init', 'gt_widgets');


// Filters
function search_filter($query) {
    if($query->is_search()) {
        $query->set('post_type', array('post', 'portfolio'));
    }
}

add_filter('pre_get_posts', 'search_filter');







/*------------------------------------------------------------
 * Include prism.css and prism.js for coding display
 *------------------------------------------------------------*/

function add_prism() {
    // Register prism.css file
    wp_register_style(
        'prismCSS', // handle name for the style so we can register, de-register, etc.
        get_stylesheet_directory_uri() . '/css/prism.css' // location of the prism.css file
    );
    // Register prism.js file
    wp_register_script(
        'prismJS', // handle name for the script so we can register, de-register, etc.
        get_stylesheet_directory_uri() . '/js/prism.js' // location of the prism.js file
    );
    // Enqueue the registered style and script files
    wp_enqueue_style('prismCSS');
    wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'add_prism');


/*------------------------------------------------------------
 * Custom functions start here
 *------------------------------------------------------------*/

/* Defer parsing of JavaScript */
if (!(is_admin() )) {
    function defer_parsing_of_js ( $url ) {
        if ( FALSE === strpos( $url, '.js' ) ) return $url;
        if ( strpos( $url, 'jquery.js' ) ) return $url;
        // return "$url' defer ";
        return "$url' defer onload='";
    }
    add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

/* Remove query strings from static resources */
function _remove_script_version( $src ){
    return add_query_arg( 'ver', false, $src );
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
}

add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
} ;



/* Autoriser l'upload de tous types de format dans les médias */

add_filter('upload_mimes', 'wpm_myme_types', 1, 1);

function wpm_myme_types($mime_types){
    $mime_types['ai'] = 'application/postscript'; //On autorise les .ai
    $mime_types['mon autre extension'] = 'mon autre Mime Type'; 
    return $mime_types;
}