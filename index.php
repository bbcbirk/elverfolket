<?php

get_header();

?>
<div class="frontpage">
<div class="frontpage-banner">
<?php
//Event Loop Begin
$today = date('YmdHis');
$EventPosts = new WP_Query(array(
	'post_type'			=>	'elverfolk_event',
	'orderby' 			=> 	'meta_value',  
    'meta_key' 			=> 	'event_slut_dato',
    'order'				=> 	'ASC',
	'meta_query'		=>	array(
		array(
			'key' 		=>	'event_slut_dato',
			'compare'	=>	'>=',
			'value'		=> 	$today,
			'type'		=>	'DATETIME',
		)
	),
	'posts_per_page'		=>	'1',
));

if($EventPosts->have_posts()) :
    while($EventPosts->have_posts()) : $EventPosts->the_post(); ?>
        <article class="banner-container col-12 bg-grey" style="<? if( get_field('banner_baggrund') == 'Farve') { ?>background-color: <?php the_field('banner_baggrundsfarve'); ?> !important;<?php } else if(get_field('banner_baggrund') == 'Billede') { ?>background: url('<?php the_field('banner_baggrundsbillede'); ?>');<?php } ?>">
            <div class="banner-content col-6">
                <div class="title">
                    <? if( get_field('banner_titel') == 'Billede') { ?>
                        <a href="<?php the_permalink(); ?>"><img id="banner-title" src="<?php the_field('banner_titelbillede'); ?>">
                    <?php } else if(get_field('banner_titel') == 'Tekst') { ?>
                        <a href="<?php the_permalink(); ?>"><h1 class="banner_title-text_front"><?php the_title(); ?></h1></a>
                    <?php } ?>
                </div>

                <div class="banner-buttons">
                <?php 
                if (get_field('billet_link')) {
                ?>
                    <a class="banner-btn" href="<?php echo get_field('billet_link'); ?>" target="_blank"><?php echo get_field('billetknap_label'); ?></a>
                <?php
                }
                ?>
                    <a class="banner-btn" href="<?php the_permalink(); ?>">Læs mere »</span></a>
                </div>
            </div>
            <div class="banner-img col-6">
                <?php if(!empty(get_field('banner_hero_billede'))) { ?>
                    <img src="<?php the_field('banner_hero_billede'); ?>" >
                <?php } ?>
            </div>
        </article>


            <!--<article class="event-post frontevent post <?php 
            //if (has_post_thumbnail()) {
                ?>with-banner" style='background: #000 url("<?php// echo the_post_thumbnail_url();?>");'<?php
            //}
            ?>
            ">
		<div class="event-post-content">
            <h2 class="event-post-title"><a href="<?php// the_permalink(); ?>"><?php //the_title(); ?></a></h2>
            <a href="<?php //the_permalink(); ?>"><h2 id="eventTimer"></h2></a>
        </div>
		
        <div class="event-readmore">
            <?php 
            //if (get_field('billet_link')) {
                ?>
                <a class="billetlink" href="<?php //echo get_field('billet_link'); ?>" target="_blank"><h2><?php //echo get_field('billetknap_label'); ?></h2></a>
                <?php
            //}
            ?>
            <?php 
            //if (get_field('billet_pris')) {
                ?>
                <h3>Billetpris: <?php //echo get_field('billet_pris'); ?> kr.</h3>
                <?php
            //}
            ?>
            <a href="<?php //the_permalink(); ?>">Læs mere &raquo;</a>
        </div>
		<script>
		// Set the date we're counting down to
		//var countDownDate = new Date("<?php //echo date_i18n("m/j/Y H:i:s", strtotime(get_field('event_start_dato'))); ?>").getTime();
		// Update the count down every 1 second
		//var x = setInterval(function() {

			// Get todays date and time
			//var now = new Date().getTime();
			
			// Find the distance between now and the count down date
			//var distance = countDownDate - now;
			
			// Time calculations for days, hours, minutes and seconds
			//var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			//var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			//var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			//var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			// Output the result in an element with id="demo"
			//document.getElementById("eventTimer").innerHTML ="Kun " + days + " dage, " + hours + " timer, "
			//+ minutes + " minutter og " + seconds + " sekunder tilbage";
			
			// If the count down is over, write some text 
			//if (distance < 0) {
			//	clearInterval(x);
			//	document.getElementById("eventTimer").innerHTML = "Lige Nu!";
			//}
		//}, 1000);
		</script>
	</article>-->
	
	<?php endwhile;
endif;
?>
</div>
<div class="site-content frontpage-content">
<?php if ( is_active_sidebar( 'frontpagearea' ) ) : ?>
	<!-- Under news widget -->
	<?php dynamic_sidebar('frontpagearea'); ?>
<?php endif; ?>										   
<?php
//News Loop Begin
$NewsPosts = new WP_Query(array(
	'post_type'			=>	'elverfolk_news',
	'orderby' 			=> 	'meta_value',  
    'meta_key' 			=> 	'acf_news_priority',
    'order'				=> 	'ASC',
	'posts_per_page'    => -1,
	'meta_query'		=>	array(
		array(
			'key' 		=>	'acf_news_enddate',
			'compare'	=>	'>=',
			'value'		=> 	$today,
			'type'		=>	'DATETIME',
		)
	),
));

if($NewsPosts->have_posts()) :
	?><hr/></article><?php
    while($NewsPosts->have_posts()) : $NewsPosts->the_post(); ?>
			<article class="news-post post">
		
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		
		
		<?php if ($post->post_excerpt) { ?>
			<p>
			<?php echo get_the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>">Læs mere &raquo;</a>
		</p>
<?php } else {
	the_content('Læs mere &raquo;');
}
		
		 ?>
	</article>
	
	<?php endwhile;
else :
    echo '<p style="display: none;" >No content found</p>';
endif;
?>
</div>

</div>
<?php
get_footer();

?>