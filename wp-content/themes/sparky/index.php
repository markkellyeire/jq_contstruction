<?php $this->layout( 'templates::default' ) ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="entry-content">
		<h1><?php the_title() ?></h1>
		
		<?php the_content(); ?>
	</section>
<?php endwhile; endif; ?>