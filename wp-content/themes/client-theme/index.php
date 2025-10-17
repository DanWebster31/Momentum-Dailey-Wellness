<?php
/**
 * @package client-theme
 */
get_header(); ?>

<?php 
$posts_page_ID = get_option('page_for_posts');
?>

<?php if(has_block('acf/top-slides',$posts_page_ID)) { ?><div id="main-content"><?php } ?> <?php // #main-content ?>

<?php
$post   = get_post($posts_page_ID);
$output =  apply_filters( 'the_content', $post->post_content );
echo $output;
?>

</div> <?php // /#main-content ?>

<?php get_footer(); ?>

