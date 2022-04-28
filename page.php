<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

<div class="banner">
    <?php the_post_thumbnail('banner') ?>
    <div class="overlay"></div>
	<h1 class="title"><?php the_title(); ?></h1>
</div>

    	<div class="container">
	   		<?php the_content() ?>
		</div>
	
	<?php endwhile;

else :
	echo '<p>There are no pages!</p>';
endif;

get_footer();

?>