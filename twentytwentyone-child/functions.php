<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// Charger le fichier script.js
function child_theme_enqueue_scripts() {
    wp_enqueue_script( 'scriptjs', get_template_directory_uri() . '/js/script.js',  ["jquery"], false, true );
    wp_enqueue_script( 'child-theme-script', get_stylesheet_directory_uri() . '/script.js', array(), '1.0', true );
  }
  
  add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts' );
  

// END ENQUEUE PARENT ACTION

// add menu header and footer :
function register_my_menus() {
    register_nav_menus(
    array(
    'header-menu' => __( 'Menu Header' ),
    'footer-menu' => __( 'Menu Footer' ),
    )
    );
}
add_action( 'init', 'register_my_menus' );


/* JAVA SCRIPT TEST */
function ti_custom_javascript() {
    ?>
        <script>
         console.log ('test');
        </script>
    <?php
}
add_action('wp_head', 'ti_custom_javascript');