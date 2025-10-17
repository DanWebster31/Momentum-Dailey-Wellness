<?php

/**
 * @package client-theme
 */
global $scriptsHeader;
global $posttype;
global $post;
global $postparent;
global $post_slug;
$post_slug = $post->post_name;
$posttype = str_replace("-", "_", $post_slug);
$postparent = $post->post_parent;

// Scroll to ID on a page
if (isset($_GET["goto"])) {
  $goto = $_GET["goto"];
} else {
  $goto = '';
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" class="no-js">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#bbbbbb" />

  <!-- INCLUDE THE HEADER -->
  <?php wp_head(); ?>

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <script src="https://kit.fontawesome.com/c30e018d26.js" crossorigin="anonymous"></script>

  <?php
  if (wp_is_mobile()) { ?>
    <link href="<?php bloginfo('template_directory'); ?>/includes/css/mobile.css" rel="stylesheet" type="text/css" />
  <?php } ?>

  <?php if (get_field('header_scripts', 'options')) {
    echo get_field('header_scripts', 'options');
  } ?>

  <?php if ($goto) { ?>
    <script>
      $(document).ready(function() {
        goToByScroll('<?php echo $goto; ?>');
      });
    </script>
  <?php } ?>

  <!-- INCLUDED SCRIPTS -->
  <?php
  if (!empty($scriptsHeader)) {
    scriptPrint($scriptsHeader);
  }
  ?>

</head>

<body id="top" class="preload <?php echo the_slug();
                              if (202 == $postparent) {
                                echo ' community-home';
                              } ?>">

  <a class="ada-skip-to-content" href="#main-content">Skip to content</a>

  <?php if (get_field('body_scripts', 'options')) {
    echo get_field('body_scripts', 'options');
  } ?>

  <?php /* if(have_rows('top_promo_bar','options')): ?>
      <div class="top-promo-bar">
        <div class="wrapper">
          <div class="full cycle-slideshow" data-cycle-center-vert=true data-cycle-speed="1000" data-cycle-timeout="5000" data-cycle-slides="> .frame">

                <?php while( have_rows('top_promo_bar','option') ): the_row();
                  $promotext = get_sub_field('promo_text');
                  $promolink = get_sub_field('promo_link');
                ?>
                <div class="frame tcenter">
                  <?php if( $promotext ): ?>
                    <div class="promo-text upper">
                      <?php if( $promolink && substr( $promolink, 0, 1 ) === "#" ): ?>
                        <span class="spanlink scrollto" data-href="<?php echo $promolink; ?>">
                      <?php elseif($promolink): ?>
                        <a href="<?php echo $promolink; ?>">
                      <?php endif; ?>
                        <?php echo $promotext; ?>
                        <?php if( $promolink && substr( $promolink, 0, 1 ) === "#" ): ?>
                        </span>
                      <?php elseif($promolink): ?>
                        </a>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <?php endwhile; ?>

          </div>
        </div>
      </div>
  <?php endif; */ ?>

  <div id="contain-all">

    <header id="header" class="top no-transition">
      <div id="header-content" class="full">
        <div id="header-content-holder">

          <nav id="main-nav" class="clearfix">
            <ul>
              <?php $menu = wp_get_nav_menu_object('Main Menu');
              wp_nav_menu(array('menu' => 'Main Menu', 'container' => false, 'items_wrap' => '%3$s')); ?>
            </ul>
          </nav>

          <?php $logo = get_field('logo', 'options'); ?>
          <?php if ($logo) { ?>
            <a id="logo" href="<?php echo site_url(); ?>">
              <img class="stretch noselect" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo('name'); ?> Logo">
            </a>
          <?php } ?>

          <div id="logo-background">
            <img src="/wp-content/themes/client-theme/images/global/logo-curve.png" alt=" <?php bloginfo('name'); ?> Logo Background">
          </div>

          <div class="mobile-nav-toggle">
            <div class="hamburger">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
            <h4 class="toggle-text">MENU</h4>
          </div>

          <div id="top-gradient"></div>

        </div>
      </div>
    </header>