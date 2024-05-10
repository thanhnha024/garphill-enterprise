<?php
/**
 * Setup Metallex Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function metallex_child_theme_setup() {
	load_child_theme_textdomain( 'metallex-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'metallex_child_theme_setup' );


function metallex_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'metallex_enqueue_styles' );

/*
 * Define Variables
 */
if (!defined('THEME_DIR'))
    define('THEME_DIR', get_template_directory());
if (!defined('THEME_URL'))
    define('THEME_URL', get_template_directory_uri());


/*
 * Include framework files
 */
foreach (glob(THEME_DIR.'-child' . "/includes/*.php") as $file_name) {
    require_once ( $file_name );
}
