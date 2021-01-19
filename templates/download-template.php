<?php
/*
Template Name: Download Enabled
*/

get_header();
?>
<div class="site-content">
<?php
if(have_posts()) :
    while(have_posts()) : the_post(); ?>
        <article class="post page">
            <h2><?php the_title(); ?></h2>
            <?php the_content() ?>
            <hr>
            <div class="downloadable">
                <ul>
                    <?php
                        $fields = CFS()->get( 'uploads' );
                        if (!empty($fields)) {
                            foreach ( $fields as $field ) {
                                if ($field['upload_fil'])
                                {
                                    ?><a href="<?php echo $field['upload_fil']; ?>" target="_blank"><?php
                                    ?><li><?php
                                    if ($field['fil_titel']){
                                        echo $field['fil_titel'];
                                    } else {
                                        ?>Fil<?php
                                    }
                                    ?></li><?php
                                    ?></a><?php
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
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