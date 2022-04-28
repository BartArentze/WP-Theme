<?php

function custom_theme_assets() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js');
}

add_action( 'wp_enqueue_scripts', 'custom_theme_assets' );

/* Menu register */
register_nav_menus( [ 'primary' => __( 'Primary Menu' ) ] );

/* Add Featured Image Support To Your WordPress Theme */
function add_featured_image_support_to_your_wordpress_theme() {
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'banner', 2048, 500, true );
	add_image_size( 'post', 400, 144, true );
}

add_action( 'after_setup_theme', 'add_featured_image_support_to_your_wordpress_theme' );

/* Add custom logo support */
add_theme_support( 'custom-logo' );

function social_brothers_excerpt_length( $length ) {
    return 26;
}
add_filter( 'excerpt_length', 'social_brothers_excerpt_length', 999 );

function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 998, 3);

