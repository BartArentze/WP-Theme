<?php

get_header();
?>

<div class="banner">
    <?php the_post_thumbnail('banner') ?>
    <div class="overlay"></div>
</div>

<div class="container">
	<div class="row">
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <div class="col-lg-3 col-sm-6 col-xs-12">
			<div class="blog-item">
				<?php the_post_thumbnail(); ?>
				<h2><?php the_title() ?></h2>
				<p class="post-meta"><strong><?php the_time( 'd/m/Y' ); ?> | <?php the_author(); ?>
					| <?php
					$categories = get_the_category();
					$comma      = ', ';
					$output     = '';
					
					if ( $categories ) {
						foreach ( $categories as $category ) {
							$output .= $category->cat_name . $comma;
						}
						echo trim( $output, $comma );
					} ?>
				</strong></p>
				<?php the_excerpt() ?>
				<a href="<?php the_permalink() ?>">Read more</a>
			</div>
		</div>
	
	<?php endwhile;

else :
	echo '<h3>There are no posts!</h3>';

endif;
?>
</div>
</div>
<?php

get_footer();

?> 
