<?php
/*
Template Name: Samarbejdspartnere
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
            
                    <?php
                        $fields = CFS()->get( 'samarbejdspartnere');
                        if (!empty($fields)) {
                            ?>
                            <hr>
                            <div class="partners">
                            <?php
                            foreach ( $fields as $field ) {
                                
                                if ($field['logo'])
                                {
                                    ?><div><?php //each
                                    ?><div class="partnerslogo" style="background:url('<?php echo $field['logo']; ?>') center center no-repeat;"><?php
                                    ?></div><?php
                                    ?><h2><?php echo $field['partnername']; ?></h2><?php
                                    if ($field['noter'])
                                    {
                                        ?><p><?php
                                        echo $field['noter'];
                                        ?></p><?php
                                    }
                                    if ($field['weblink'])
                                    {
                                        ?><a href="<?php echo $field['weblink']; ?>" target="_blank"><span class="dashicons dashicons-admin-site"></span></a><?php
                                    }
                                    if ($field['maillink'])
                                    {
                                        ?><a href="<?php echo $field['maillink']; ?>" target="_blank"><span class="dashicons dashicons-email"></span></a><?php
                                    }
                                    ?></div><?php // /each
                                }
                                
                            }
                            ?></div><?php // /partners
                            ?><div class="partners"><?php
                            foreach ( $fields as $field ) {
                                
                                if (!($field['logo']))
                                {
                                    ?><div><?php
                                    ?><h2><?php echo $field['partnername']; ?></h2><?php
                                    if ($field['noter'])
                                    {
                                        ?><p><?php
                                        echo $field['noter'];
                                        ?></p><?php
                                    }
                                    if ($field['weblink'])
                                    {
                                        ?><a href="<?php echo $field['weblink']; ?>" target="_blank"><span class="dashicons dashicons-admin-site"></span></a><?php
                                    }
                                    if ($field['maillink'])
                                    {
                                        ?><a href="mailto:<?php echo $field['maillink']; ?>" target="_blank"><span class="dashicons dashicons-email"></span></a><?php
                                    }
                                    ?></div><?php
                                }
                                
                            }
                            ?></div><?php //partner
                        }
                    ?>
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