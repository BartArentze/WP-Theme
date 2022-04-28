<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>


<nav class="navigation-wrapper container">
            <?php 
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );

                if ( has_custom_logo() ) {
                    echo '<a href="' . home_url() . '"><img class="logo logo-img" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
                } else {
                    echo '<a href="' . home_url() . '"><h1 class="logo logo-text">' . get_bloginfo('name') . '</h1></a>';
                }
                $args = [ 
                    'theme_location' => 'primary',
                    'add_a_class'     => 'menu-item-link',
                ];
                wp_nav_menu( $args ) 
            ?>
</nav>