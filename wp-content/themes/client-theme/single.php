<?php
/**
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */

$scriptsHeader = 'weather/weather.css';
$scriptsFooter = '';


get_header(); ?>

<!-- <section id="news-intro" class="bgwhite texture1 fixedbg">
	<div class="fill bgwhite-trans"></div>
	<div class="wrapper clearfix">
		<?php //get_sidebar(); ?>
	</div>
</section> -->

<section id="news-content" class="clearfix bgwhite pad4-0">
	<div class="wrapper tcenter padt2">
		<a class="arrowlink reverse" href="/news/">All News</a>
	</div>

	<?php
		if (have_posts()) :
		while (have_posts()) : the_post();
	?>

		<div class="wrapper full tcenter clearfix single padb2 from-bottom-quick news-post-single">

				<?php

					if(has_post_thumbnail()) {
						$featured_image = get_the_post_thumbnail_url();
            $image_id = get_post_thumbnail_id(get_the_ID());
            $featured_alt = get_post_meta($image_id , '_wp_attachment_image_alt', true);
            if(!$featured_alt) {
              $featured_alt = 'Azara News - ' . get_the_title();
            }

					} else {
						$featured_image = get_bloginfo('template_url').'/images/news/default.jpg';
            $featured_alt = get_the_title();
					}
				?>

					<img src="<?php echo $featured_image; ?>" alt="<?php echo $featured_alt; ?>" class="stretch mar2-0"  />

					<h2 class="post-title ttertiary"><?php the_title(); ?></h2>
					<!-- <h4 class="date"><?php //the_time('F jS, Y'); ?></h4> -->
					<div class="default-content padt1 marb2"><?php the_content(); ?></div>

					<a class="arrowlink reverse" href="/news/">All News</a>

				</div>

	<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
