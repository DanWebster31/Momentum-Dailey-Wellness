<?php
/**
 * @package client-theme
 */

get_header(); ?>

<?php if(has_block('acf/top-slides')) { ?><div id="main-content"><?php } ?> <?php // #main-content ?>
<?php
  // The loop.
  while ( have_posts() ) :
    the_post();
    the_content();
    // The loop end.
  endwhile;
  if (is_page('contact-us')) {
    echo '<div id="interest-holder" class="bgsubdued"><div class="interest-content wrapper"><h2 class="section-title tbase marb2 font-headline tcenter">Reach Us Online</h2>';
    include 'template-parts/content-interest.php';
    echo '</div></div>';
  }
?>
</div> <?php // /#main-content ?>

<?php get_footer(); ?>
