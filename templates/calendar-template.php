<?php
/*
Template Name: Event Kalender
*/

get_header();
?>
<div class="site-content calendar-content">
<?php
if(have_posts()) :
    while(have_posts()) : the_post(); ?>
        <article class="post page">
            <h2><?php the_title(); ?></h2>
        </article>
    <?php endwhile;
    
else :
    echo '<p>No content found</p>';
endif;

//Event Loop Begin
$today = date('YmdHis');
$EventPosts = new WP_Query(array(
	'post_type'			=>	'elverfolk_event',
	'orderby' 			=> 	'meta_value',  
    'meta_key' 			=> 	'event_slut_dato',
    'order'				=> 	'ASC',
	'posts_per_page'    => -1,
	'meta_query'		=>	array(
		array(
			'key' 		=>	'event_slut_dato',
			'compare'	=>	'>=',
			'value'		=> 	$today,
			'type'		=>	'DATETIME',
		)
	)
));

if($EventPosts->have_posts()) :
    while($EventPosts->have_posts()) : $EventPosts->the_post(); ?>
			<article class="post calendarpost">
            <a class="calendar-event-link" href="<?php the_permalink(); ?>">
                <table class="calendar-event">
                    <tr>
                        <!--Date-->
                        <td class="calendar-date">
                            <h2><?php echo date_i18n("j.", strtotime(get_field('event_start_dato'))); ?></h2>
                            <h2><?php echo date_i18n("M", strtotime(get_field('event_start_dato'))); ?></h2>
                        </td>

                        <!--Meta Details-->
                        <td class="calendar-details">
                            <table>
                                <!--Title-->
                                <tr class="calendar-title">
                                    <h2><?php the_title(); ?></h2>
                                </tr>
                                <!--Location-->
                                <?php 
                                if (get_field('event_lokation')) {
                                    ?>
                                    <tr class="calendar-loc">
                                        <td>Sted</td>
                                        <td><?php echo get_field('event_lokation') ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <!--Date-->
                                    <tr class="calendar-detaildate">
                                        <td>Dato</td>
                                        <td><?php 
                                        if (date("j. M - Y", strtotime(get_field('event_start_dato'))) == date("j. M - Y", strtotime(get_field('event_slut_dato')))) {
                                            echo date_i18n("j. F, Y", strtotime(get_field('event_start_dato'))); 
                                        }
                                        else {
                                            echo date_i18n("j. F, Y", strtotime(get_field('event_start_dato')));?> - <?php echo date_i18n("j. F, Y", strtotime(get_field('event_slut_dato'))); 
                                        }
                                        ?></td>
                                    </tr>
                                <!--Time-->
                                <?php 
                                if ((date("H:i:s", strtotime(get_field('event_start_dato'))) == date("H:i:s", mktime(0,0,0,0,0,0)) && date("H:i:s", strtotime(get_field('event_slut_dato'))) == date("H:i:s", mktime(0,0,0,0,0,0))) == false) {
                                ?>
                                <tr class="calendar-time">
                                    <td>Tid</td>
                                    <td><?php 
                                        if (date("H:i", strtotime(get_field('event_start_dato'))) == date("H:i", strtotime(get_field('event_slut_dato')))) {
                                            echo date_i18n("H:i", strtotime(get_field('event_start_dato'))); 
                                        }
                                        else {
                                            echo date_i18n("H:i", strtotime(get_field('event_start_dato')));?> - <?php echo date_i18n("H:i", strtotime(get_field('event_slut_dato'))); 
                                        }
                                        ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </a>
		
		
	</article>
	
	<?php endwhile;
endif;
?>
</div>
<?php
get_footer();

?>