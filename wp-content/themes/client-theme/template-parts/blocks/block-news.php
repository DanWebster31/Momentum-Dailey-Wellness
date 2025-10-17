<?php
if(is_home()) {
  /* SECTION */
  $section_class = get_field('section_class');
?>

<section id="news-content" class="all full<?php if($section_class) { echo ' '.$section_class; } ?>">
<?php 
	the_posts_pagination( array(
		'mid_size' => 3,
    'end_size' => 2,
		'prev_text' => __( '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>' ),
		'next_text' => __( '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>' ),
		) );
?>
  <ul class="clearfix news-post-holder wrapper-xwide bgwhite">
    <?php if (have_posts()) :
    $postcount = 1;
    $postnum = 1;
    global $postnum;
    while (have_posts()) : the_post(); ?>
      <?php include( locate_template( 'template-parts/content-post.php', false, false ) ); ?>
    <?php endwhile; endif; ?>
  <?php
  global $wp_query; // you can remove this line if everything works for you
  // don't display the button if there are not enough posts
  if ( $wp_query->max_num_pages > 1 )
  // echo '<li id="btn_loadmore"><div class="boxbtn"><i class="far fa-repeat-alt" aria-hidden="true"></i>&nbsp; Load More</div></li>'
  ?>
  </ul>
  <?php 
	the_posts_pagination( array(
		'mid_size' => 3,
    'end_size' => 2,
		'prev_text' => __( '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>' ),
		'next_text' => __( '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>' ),
		) );
?>
</section>

<?php } ?>