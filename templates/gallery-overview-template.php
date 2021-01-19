<?php
/*
Template Name: Galleri Oversigt
*/

get_header();
?>
<!--<div class="site-content">
<?php/*
if(have_posts()) :
    while(have_posts()) : the_post(); ?>
        <article class="post page">
            <h2><?php the_title(); ?></h2>
            <?php the_content() ?>
        </article>
    <?php endwhile;
    
else :
    echo '<p>No content found</p>';
endif;
*/
?>
</div> -->
<?php

//Gallery Timeline Loop Begin
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$galleryPosts = new WP_Query(array(
	'post_type'			=>	'elverfolk_gallery',
	'meta_key'			=>	'acf_gallerypost_date',
	'orderby' 			=> 'meta_value_num',
    'order'   			=> 'DESC',
    'posts_per_page'    => -1,
    'paged'             => $paged
));

if($galleryPosts->have_posts()) :
	?>
    <div class="gal-howto">
        <h3>Velkommen til vores galleri tidslinje!</h3>
        <h4>Klik ind på vores galleri ved at klikke på plakaten.</h4>
    </div>
	<div class="timeline">
		<ul>
    <?php
    while($galleryPosts->have_posts()) : $galleryPosts->the_post(); ?>
			<li>
				<div class="content">
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a><!-- Title of post -->
                    
					<div class="thumbnail">
						<a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                ?> <img src="http://birkblauner.dk/wordpress/wp-content/uploads/2018/11/Default.png"> <?php
                            } ?>
                        </a><!-- Thumbnail of post -->
						<div class="time">
							<a href="<?php the_permalink(); ?>"><h4><?php echo date_i18n("j. F - Y", strtotime(get_field('acf_gallerypost_date'))); ?></h4></a><!-- Custom field of post -->
						</div>
					</div>
				</div>
			</li>
    <?php endwhile;
    ?>
    
			<div style="clear: both;"></div>
		</ul>
	</div>

    <div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $galleryPosts->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>


    <?php
else :
    echo '<p>No content found</p>';
endif;

get_footer();

?>