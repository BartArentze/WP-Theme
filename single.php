<?php

get_header();

if ( have_posts() ) :
?>

<div class="banner">
    <?php the_post_thumbnail('banner') ?>
    <div class="overlay"></div>
    <h1 class="title"><?php the_title(); ?></h1>
</div>

<div class="container single-blog">
    <div class="row">
        <div class="col-md-12 col-lg-3">
            <div class="sidebar column">
            <h2>Blog details</h2>
            <p><strong><i class="bi bi-calendar3"></i> Geschreven op:</strong> <?php the_time( 'd-m-Y' ); ?></p>
            <p><strong><i class="bi bi-tags"></i> Categorie:</strong>  
                <?php
                    $categories = get_the_category();
                    $comma      = ', ';
                    $output     = '';
                    
                    if ( $categories ) {
                        foreach ( $categories as $category ) {
                            $output .= $category->cat_name . $comma;
                        }
                        echo trim( $output, $comma );
                    } 
                ?>
            </p>
            </div>
        </div>
        <div class="col-md-12 col-lg-9"> 
            <div class="column">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>
<?php
    endif;
    get_footer();
?> 
