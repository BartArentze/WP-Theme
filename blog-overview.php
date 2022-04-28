<?php
    /* Template Name: Blog overview */ 
    
    get_header();
    ?>
<div class="banner">
    <?php the_post_thumbnail('banner') ?>
    <div class="overlay"></div>
    <h1 class="title"><?php the_title(); ?></h1>
</div>
<div class="container">
    <div class="blog-background">
        <div class="row">
            <?php 
                // Define our WP Query Parameters
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                    'posts_per_page' => 8,
                    'paged' => $paged
                );
                $the_query = new WP_Query( $args );
                
                if ( $the_query -> have_posts() ) :
                
                
                // Start our WP Query
                while ($the_query -> have_posts()) : $the_query -> the_post();
                ?> 
            <div class="col-lg-3 col-md-12">
                <div class="blog-wrapper">
                    <div class="blog-picture">
                        <?php the_post_thumbnail('post') ?>
                        <div class="overlay"></div>
                        <div class="blog-information">
                            <span class="small-text"><?php the_time( 'd-m-Y' ); ?></span>
                            <span class="small-text">
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
                            </span>
                        </div>
                    </div>
                    <div class="blog-content">
                        <h2><?php the_title(); ?></h2>
                        <?php the_excerpt(); ?>
                    </div>
                    <a class="blog-link" href="<?php the_permalink() ?>"></a>
                </div>
            </div>
            <?php endwhile; ?>
            <div class="col-xs-12">
                <div class="pagination">
                    <?php 
                        echo paginate_links( array(
                            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                            'total'        => $the_query->max_num_pages,
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'format'       => '?paged=%#%',
                            'show_all'     => false,
                            'type'         => 'plain',
                            'end_size'     => 2,
                            'mid_size'     => 2,
                            'prev_text'    => '<i class="bi bi-arrow-left"></i> Vorige pagina',
                            'next_text'    => 'Volgende pagina <i class="bi bi-arrow-right"></i>',
                            'add_fragment' => '',
                        ) );
                        ?>
                </div>
            </div>
            <?php
                else :
                    echo "<h3 class='no-posts-title'>Er zijn nog geen berichten!</h3>";
                
                endif;
                ?>
        </div>
    </div>
</div>
<?php
    get_footer();
    
    ?>