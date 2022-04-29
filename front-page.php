<?php 

get_header(); 
?>


<div class="banner">
    <?php the_post_thumbnail('banner') ?>
    <div class="overlay"></div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="homepage-column">
                <div class="col-xs-12">
                    <h2 class="form-title">Plaats een blog bericht</h2>
                    <form class="form-horizontal" name="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="ispost" value="1" />
                        <input type="hidden" name="userid" value="" />
                        <div class="col-xs-12">
                            <label class="control-label">Berichtnaam</label>
                            <input type="text" class="form-control" name="title" placeholder="Geen titel" />
                        </div>
                        <div class="col-xs-12">
                            <label class="control-label">Categorie</label>
                            <select name="category" class="form-control select-placeholder">
                                <option value="">Geen categorie</option>
                            <?php
                                $catList = get_categories();
                                foreach($catList as $listval)
                                {
                                    echo '<option value="'.$listval->id.'">'.$listval->name.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-12">
                            <label class="control-label">Header afbeelding</label>
                                
                            <div class="file-input">
                                <i class="bi bi-camera icon"></i>
                                <input type="file" id="actual-btn" name="sample_image" hidden/>
                                <label class="test" for="actual-btn">Kies bestand</label>
                                <span id="file-chosen">Geen bestand gekozen</span>
                            </div>                                  
                        </div>
                        <div class="col-xs-12">
                            <label class="control-label">Bericht</label>
                            <textarea class="form-control" rows="11" name="sample_content"></textarea>
                        </div>
                        <div class="col-xs-12 centered-btn">
                            <input type="submit" class="btn btn-primary" value="Bericht aanmaken" name="submitpost" />
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="blog-background">
                <div class="row">
                    <?php 
                    // Define our WP Query Parameters
                    $the_query = new WP_Query( 'posts_per_page=4' );

                    if ( $the_query -> have_posts() ) :

                    // Start our WP Query
                    while ($the_query -> have_posts()) : $the_query -> the_post();
                    ?> 
                    <div class="col-lg-6 col-xs-12">
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
                        
                    <?php endwhile;

else :
	echo "<h3 class='no-posts-title'>Er zijn nog geen berichten!</h3>";

endif;
    ?>          
                </div>
            </div>
        </div>
    </div>
</div>



<?php 

if(is_user_logged_in())
{
	if(isset($_POST['ispost']))
	{
		global $current_user;
		wp_get_current_user();

		$user_login = $current_user->user_login;
		$user_email = $current_user->user_email;
		$user_firstname = $current_user->user_firstname;
		$user_lastname = $current_user->user_lastname;
		$user_id = $current_user->ID;

		$post_title = $_POST['title'];
		$sample_image = $_FILES['sample_image']['name'];
		$post_content = $_POST['sample_content'];
		$category = $_POST['category'];


		$new_post = array(
			'post_title' => $post_title,
			'post_content' => $post_content,
			'post_status' => 'publish',
			'post_name' => 'pending',
			'post_type' => $post_type,
			'post_category' => $category
		);

		$pid = wp_insert_post($new_post);
		add_post_meta($pid, 'meta_key', true);

		if (!function_exists('wp_generate_attachment_metadata'))
		{
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}
		if ($_FILES)
		{
			foreach ($_FILES as $file => $array)
			{
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK)
				{
					return "upload error : " . $_FILES[$file]['error'];
				}
				$attach_id = media_handle_upload( $file, $pid );
			}
		}
		if ($attach_id > 0)
		{
			//and if you want to set that image as Post then use:
			update_post_meta($pid, '_thumbnail_id', $attach_id);
		}

		$my_post1 = get_post($attach_id);
		$my_post2 = get_post($pid);
		$my_post = array_merge(array($my_post1), array($my_post2));


        
	}
} else {
    echo    '<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="error-content">
                <h2>Oeps! Je moet inloggen om een blog te kunnen plaatsen</h2>
            </div>
        </div>
    </div>
</div>';
}
get_footer(); 

?>