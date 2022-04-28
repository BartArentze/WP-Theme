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
	   	 	<div class="row">
				<div class="col-xs-12 col-md-10 mx-auto">
					<div class="content-wrap">
						<?php the_content() ?>
					</div>
				</div>
			</div>
		</div>
	
	<?php endwhile;
	
endif;

get_footer();

?>