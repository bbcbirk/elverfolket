<?php

get_header();
?>
<div class="gallerypost-content">
<?php
if(have_posts()) :
    while(have_posts()) : the_post(); ?>
        <article class="post page">
            
            <div class="cat-galleri-row">
                <div class="cat-galleri-collum cat-galleri-thumbnail">
                    <?php if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } else {
                            ?> <img src="http://birkblauner.dk/wordpress/wp-content/uploads/2018/11/Default.png"> <?php
                        } ?>
                </div>
                <div class="cat-galleri-collum cat-galleri-content">
                    <h2 class="cat-galleri-title"><?php the_title(); ?></h2>
                    <?php the_content() ?>

                    <div class="single event-meta">
                        <table>
                            <!--gal_director-->
                            <?php 
                            if (get_field('gal_director')) {
                                ?>
                                <tr>
                                    <th>Instruktør</th>
                                    <td><?php echo get_field('gal_director') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_chor-->
                            <?php 
                            if (get_field('gal_chor')) {
                                ?>
                                <tr>
                                    <th>Koreograf</th>
                                    <td><?php echo get_field('gal_chor') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_capel-->
                            <?php 
                            if (get_field('gal_capel')) {
                                ?>
                                <tr>
                                    <th>Kapelmester</th>
                                    <td><?php echo get_field('gal_capel') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_costume-->
                            <?php 
                            if (get_field('gal_costume')) {
                                ?>
                                <tr>
                                    <th>Kostumer</th>
                                    <td><?php echo get_field('gal_costume') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_scenograf-->
                            <?php 
                            if (get_field('gal_scenograf')) {
                                ?>
                                <tr>
                                    <th>Scenograf</th>
                                    <td><?php echo get_field('gal_scenograf') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_sounddesign-->
                            <?php 
                            if (get_field('gal_sounddesign')) {
                                ?>
                                <tr>
                                    <th>Lyd design/afvikling</th>
                                    <td><?php echo get_field('gal_sounddesign') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_lightdesign-->
                            <?php 
                            if (get_field('gal_lightdesign')) {
                                ?>
                                <tr>
                                    <th>Lys design</th>
                                    <td><?php echo get_field('gal_lightdesign') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_productionleader-->
                            <?php 
                            if (get_field('gal_productionleader')) {
                                ?>
                                <tr>
                                    <th>Produktionsleder</th>
                                    <td><?php echo get_field('gal_productionleader') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_mail-->
                            <?php 
                            if (get_field('gal_mail')) {
                                ?>
                                <tr>
                                    <th>Mail</th>
                                    <td><?php echo get_field('gal_mail') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_actors-->
                            <?php 
                            if (get_field('gal_actors')) {
                                ?>
                                <tr>
                                    <th>Antal Skuespillere</th>
                                    <td><?php echo get_field('gal_actors') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <!--gal_band-->
                            <?php 
                            if (get_field('gal_band')) {
                                ?>
                                <tr>
                                    <th>Antal i orkesteret</th>
                                    <td><?php echo get_field('gal_band') ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>

                </div> 
            </div>
            <?php
                //Get the images ids from the post_metadata
                $images = acf_photo_gallery('acf_gallerypost_gallery', $post->ID);
                //Check if return array has anything in it
                if( count($images) ){ ?>
            <section class="cat-galleri-gallery">
                <?php
                //Cool, we got some data so now let's loop over it
                foreach($images as $image){
                    $id = $image['id']; // The attachment id of the media
                    $title = $image['title']; //The title
                    $caption= $image['caption']; //The caption
                    $full_image_url= $image['full_image_url']; //Full size image url
                    $full_image_resized_url = acf_photo_gallery_resize_image($full_image_url, 330, 220); //Resized size to 330px width by 220px height image url
                    $thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
                    $url= $image['url']; //Goto any link when clicked
                    $target= $image['target']; //Open normal or new tab
                ?>
                <div class="item">
                    <div class="box">
                        <a href="<?php echo $full_image_url ?>" data-title="<?php echo $caption ?>" data-alt="<?php echo $title ?>" data-lightbox="gallery1">
                            <div class="imgbox">
                                <img src="<?php echo $full_image_resized_url ?>" alt="<?php echo $title ?>">
                            </div>
                            <div class="overlay">
                                <div class="details">
                                    <h3>Se i fuld størrelse</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </section> <!-- /Gallery -->
        <?php } ?>
        </article>
    <?php endwhile;
    
else :
    echo '<p>No content found</p>';
endif;
?>
</div>
<?php
get_footer();

?>