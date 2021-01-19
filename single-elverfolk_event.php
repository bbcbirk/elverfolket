<?php

get_header();
?>
<div>
<?php
if(have_posts()) :
    while(have_posts()) : the_post(); ?>
        <div class="banner-container col-12 bg-grey" style="<? if( get_field('banner_baggrund') == 'Farve') { ?>background-color: <?php the_field('banner_baggrundsfarve'); ?> !important;<?php } else if(get_field('banner_baggrund') == 'Billede') { ?>background: url('<?php the_field('banner_baggrundsbillede'); ?>');<?php } ?>">
            <div class="banner-content col-6">
                <div class="title">
                    <? if( get_field('banner_titel') == 'Billede') { ?>
                        <img id="banner-title" src="<?php the_field('banner_titelbillede'); ?>">
                    <?php } else if(get_field('banner_titel') == 'Tekst') { ?>
                        <h1 class="banner_title-text"><?php the_title(); ?></h1>
                    <?php } ?>
                </div>
            </div>
            <div class="banner-img col-6">
                <?php if(!empty(get_field('banner_hero_billede'))) { ?>
                    <img src="<?php the_field('banner_hero_billede'); ?>" >
                <?php } ?>
            </div>
        </div>

        <!--<div class="event-post single <?php 
            //if (has_post_thumbnail()) {
                ?>with-banner" style='background: #000 url("<?php// echo the_post_thumbnail_url();?>");'<?php
            //}
            ?>
            ">
            <div class="event-header"><h1><?php// the_title(); ?></h1></div>
            
        </div>-->
        <article class="post page event-content">
            
        <h2 id="eventTimer" style="margin-top: 0;"></h2>
		<script>
		// Set the date we're counting down to
		var countDownDate = new Date("<?php echo date_i18n("m/j/Y H:i:s", strtotime(get_field('event_start_dato'))); ?>").getTime();
		// Update the count down every 1 second
		var x = setInterval(function() {

			// Get todays date and time
			var now = new Date().getTime();
			
			// Find the distance between now and the count down date
			var distance = countDownDate - now;
			
			// Time calculations for days, hours, minutes and seconds
			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			// Output the result in an element with id="demo"
			document.getElementById("eventTimer").innerHTML = days + " dage, " + hours + " timer, "
			+ minutes + " minutter og " + seconds + " sekunder tilbage";
			
			// If the count down is over, write some text 
			if (distance < 0) {
				clearInterval(x);
				document.getElementById("eventTimer").innerHTML = "Lige Nu!";
			}
		}, 1000);
		</script>
            
            <?php the_content() ?>
            <hr>
            <div class="single event-meta">
            <table>
                    <!--Location-->
                    <?php 
                    if (get_field('event_lokation')) {
                        ?>
                        <tr class="calendar-loc">
                            <th>Sted</th>
                            <td><?php echo get_field('event_lokation') ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <!--Date-->
                    <tr class="calendar-detaildate">
                            <th>Dato</th>
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
                        <th>Tid</th>
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
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <!--Billet-->
                    <?php 
                    if (get_field('billet_link')) {
                    ?>
                    <tr class="calendar-ticket">
                        <th>Billetter</th>
                        <td><a href="<?php echo get_field('billet_link'); ?>" target="_blank"><?php echo get_field('billetknap_label'); ?></a>
                            <?php
                        }
                        ?></td>
                    </tr>
                    <!--Pris-->
                    <?php 
                    if (get_field('billet_pris')) {
                    ?>
                    <tr class="calendar-price">
                        <th>Pris</th>
                        <td><?php echo get_field('billet_pris'); ?> kr.</td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </article>
    <?php 
    endwhile;
else :
    echo '<p>No content found</p>';
endif;
?>
</div>
<?php
get_footer();

?>