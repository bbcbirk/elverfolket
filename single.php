<?php

get_header();
?>
<div class="site-content">
<?php
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
?>
</div>
<?php
get_footer();

?>