<?php
/**
 * Template Name: Home
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */
$scriptsHeader = '';
$scriptsFooter = 'js/home.js,js/form-functions.js,js/interest-list.js,//www.google.com/recaptcha/api.js?onload=onRecaptchaApiLoaded&render=explicit';

get_header();
?>


<?php 
// Display ACF blocks content (including top-slides)
the_content();
?>

<?php if(get_field('intro_title') || get_field('intro_text')) { ?>
<section id="intro" class="community-landing bgwhite">
  <div class="intro-content wrapper-wide clearfix">
  <?php if(get_field('intro_title')) { ?>
    <div class="intro-title tcenter animate-zoomin">
      <?php if(get_field('intro_title_h1')) { ?><h1 class="section-title tsecondary font-main-bold"><?php } else { ?><h2 class="section-title tsecondary font-main-bold"><?php } ?>
      <?php echo get_field('intro_title'); ?>
      <?php if(get_field('intro_title_h1')) { ?></h1><?php } else { ?></h2><?php } ?>
    </div>
    <?php } ?>
    <?php if(get_field('intro_text')) { ?>
    <div class="intro-text tcenter animate-up">
      <?php echo get_field('intro_text'); ?>
    </div>
    <?php } ?>

  </div>
</section>
<?php } ?>

<?php if( have_rows('features') ): ?>
  <?php $fcount = 0; while( have_rows('features') ) : the_row(); $fcount++; ?>
    <section id="feature-<?php echo $fcount; ?>" class="image-text-box<?php echo $fcount % 2 == 0 ? ' reverse' : ''; ?> mart0">
      <div class="image-text-box-content">
        <div class="image-text-box-text animate-fadein">
          <div class="image-text-box-text-content">
            <?php if(get_sub_field('feature_title')) { ?><h2 class="section-title tsurrogate font-main-bold tcenter animate-up"><?php echo get_sub_field('feature_title'); ?></h2><?php } ?>
            <?php if(get_sub_field('feature_text')) { ?><div class="default-content animate-up"><?php echo get_sub_field('feature_text'); ?></div><?php } ?>
          </div>
        </div>
        <?php $image = get_sub_field('feature_image'); if($image) { ?>
        <div class="image-text-box-image <?php echo $fcount % 2 == 0 ? 'animate-right' : 'animate-left'; ?> cover nofade responsive-background-image" <?php $bg_position = get_sub_field('bg_position', $image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
          <?php acf_responsive_image($image); ?>
        </div>
        <?php } ?>
      </div>
    </section>
  <?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<section id="home-neighborhoods" class="bgtertiary">
  <div class="home-neighborhoods-content wrapper-full with-gap">
    <h2 class="section-title upper marb3 font-main-bold tcenter animate-zoomin">NEIGHBORHOODS</h2>
    <div class="neighborhood-grid">
      <?php 
      $neighborhoods = get_posts(array(
        'post_type' => 'neighborhoods',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
      ));
      
      $featured_count = 0;
      foreach($neighborhoods as $neighborhood) { 
        setup_postdata($neighborhood);
        $featured_img_url = get_the_post_thumbnail_url($neighborhood->ID, 'full');
        $is_featured = get_field('featured_neighborhood', $neighborhood->ID);
        if($is_featured) {
          $featured_count++;
        }
        ?>
        <div class="neighborhood-card <?php echo $is_featured ? ' featured animate-up' : 'animate-fade-sequence'; ?>">
          <?php if($is_featured) { ?>
            <div class="featured-content<?php echo $featured_count % 2 === 0 ? ' reverse' : ''; ?>">
              <?php $is_reverse = $featured_count % 2 === 0; ?>
              <div class="featured-info animate-up">
                <?php if(get_field('neighborhood_logo', $neighborhood->ID)) { ?>
                  <div class="neighborhood-logo">
                    <?php acf_responsive_image(get_field('neighborhood_logo', $neighborhood->ID)); ?>
                  </div>
                <?php } else { ?>
                  <h2 class="neighborhood-title section-title tsecondary font-main-bold"><?php echo get_the_title($neighborhood); ?></h2>
                <?php } ?>

                <div class="neighborhood-tagline tcenter upper">
                  <?php echo get_field('neighborhood_tagline', $neighborhood->ID); ?>
                  <?php if(get_field('neighborhood_status', $neighborhood->ID) == 'Coming Soon') { ?>
                    <div class="neighborhood-status"><?php echo get_field('neighborhood_status', $neighborhood->ID); ?></div>
                  <?php } ?>
                </div>

                <?php 
                $link = get_field('neighborhood_link', $neighborhood->ID);
                if($link) { 
                  $blank_window = get_field('neighborhood_link_blank_window', $neighborhood->ID); ?>
                  <a href="<?php echo esc_url($link); ?>" class="boxbtn learn-more"<?php echo $blank_window ? ' target="_blank"' : ''; ?>>LEARN MORE</a>
                <?php } ?>
              </div>
              
              <div class="featured-image cover responsive-background-image<?php echo $is_reverse ? ' animate-right' : ' animate-left'; ?>">
                <?php 
                $thumbnail_id = get_post_thumbnail_id($neighborhood->ID);
                if($thumbnail_id) {
                  $image = array(
                    'id' => $thumbnail_id,
                    'url' => get_the_post_thumbnail_url($neighborhood->ID, 'full'),
                    'sizes' => array(),
                    'alt' => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)
                  );
                } else {
                  $image = array(
                    'url' => get_template_directory_uri() . '/images/global/default-image.jpg',
                    'alt' => 'Default neighborhood image'
                  );
                }
                acf_responsive_image($image); 
                ?>
              </div>
            </div>
          <?php } else { ?>
            <div class="neighborhood-image">
              <?php 
              $thumbnail_id = get_post_thumbnail_id($neighborhood->ID);
              if($thumbnail_id) {
                $image = array(
                  'id' => $thumbnail_id,
                  'url' => get_the_post_thumbnail_url($neighborhood->ID, 'full'),
                  'sizes' => array(),
                  'alt' => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)
                );
              } else {
                $image = array(
                  'url' => get_template_directory_uri() . '/images/global/default-image.jpg',
                  'alt' => 'Default neighborhood image'
                );
              }
              acf_responsive_image($image); 
              ?>
            </div>
            
            <div class="neighborhood-info">

              <h2 class="neighborhood-title section-title-small tsecondary font-main-bold">
                <?php echo get_the_title($neighborhood); ?>
                <?php if(get_field('masterplan_name', $neighborhood->ID)) { ?>
                <span class="masterplan-name">
                 <?php echo get_field('masterplan_name', $neighborhood->ID); ?>
                </span>
              <?php } ?>
              </h2>
              
              <?php if(get_field('neighborhood_city', $neighborhood->ID) || get_field('neighborhood_state', $neighborhood->ID)) { ?>
                <div class="neighborhood-location">
                  <?php echo get_field('neighborhood_city', $neighborhood->ID); ?>, <?php echo get_field('neighborhood_state', $neighborhood->ID); ?>
                </div>
              <?php } ?>
              
              <?php if(get_field('neighborhood_home_types', $neighborhood->ID)) { ?>
                <div class="property-type"><?php echo get_field('neighborhood_home_types', $neighborhood->ID); ?></div>
              <?php } ?>
              
              <?php if(get_field('neighborhood_status', $neighborhood->ID)) { ?>
                <div class="neighborhood-status"><?php echo get_field('neighborhood_status', $neighborhood->ID); ?></div>
              <?php } ?>
              
              <?php 
              $link = get_field('neighborhood_link', $neighborhood->ID);
              if($link) { 
                $blank_window = get_field('neighborhood_link_blank_window', $neighborhood->ID); ?>
                <a href="<?php echo esc_url($link); ?>" class="boxbtn learn-more"<?php echo $blank_window ? ' target="_blank"' : ''; ?>>LEARN MORE</a>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      <?php } 
      wp_reset_postdata();
      ?>
    </div>
  </div>
</section>

<section id="form-contact" class="bgwhite">

  <h2 class="section-title upper full font-main-bold tcenter marb3 animate-zoomin">Contact Us</h2>

  <div class="form-contact-content wrapper-wide with-gap">

  <div id="footer-info" class="animate-right">
      <div class="footer-form-intro">
        <p>Thank you for your interest in CBC Home. For more information, please call or reach us online.</p>
      </div>
      <div id="footer-address" class="address-block">
        <?php if($communityaddress) {?>
          <p><a href="https://maps.app.goo.gl/DMk6nzqEYZpA84oM7" target="_blank"><?php echo $communityaddress; ?> <br><?php echo $communitycity; ?>, <?php echo $communitystate; ?> <?php echo $communityzip; ?></a></p>
        <?php } ?>
        <?php if($communityphone) { ?>
        <p><a class="address-phone" href="tel:<?php echo $communityphone; ?>"><?php echo $communityphone; ?></a></p>
        <?php } ?>
      </div>
      <ul id="footer-social" class="social-list">
          <?php get_template_part("template-parts/content-social"); ?>
      </ul>
    </div>

    <div id="footer-form" class="animate-left">
      <?php get_template_part("template-parts/content-interest"); ?>
    </div>

  </div>
</section>

<?php get_footer(); ?>
