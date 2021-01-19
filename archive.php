<?php
get_header();
	
?>
<div class="site-content">
	
	<?php if (have_posts()) : ?>

	<h2>
		<?php 
		if( is_category()) {
			single_cat_title();
		} elseif ( is_tag()){
			single_tag_title();
		} elseif ( is_author()){
			the_post();
			echo 'Forfatter Arkiv: ' . get_the_author();
			rewind_posts();
		} elseif ( is_day()){
			echo 'Daglig Arkiv: ' . get_the_date();
		} elseif ( is_month()){
			echo 'Månedelig Arkiv: ' . get_the_date('F Y');
		} elseif ( is_year()){
			echo 'Årlig Arkiv: ' . get_the_date('Y');
		}else{
			echo 'Archives';
		}
		?>
	</h2>
	
	<?php while (have_posts()) : the_post(); ?>
	
	<article class="post">
		
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<p class="post-info"><i class="fa fa-clock-o"></i> <?php the_time('j. F, Y H:i '); ?></p>
		
		<p>
			<?php echo get_the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>">Læs mere &raquo;</a>
		</p>
	</article>
	
	<?php endwhile;
	
	else :
		echo '<p>No content found</p>';
	endif;
	?>
</div>

<?php get_footer(); ?>