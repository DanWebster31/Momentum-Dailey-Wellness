<?php
  /* SECTION */
	$section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_layout = get_field('section_layout');
  $section_background = get_field('section_background_color');
  $show_circles = get_field('show_circles');


  /* FEATURE INTRO */
  $feature_intro = get_field('feature_intro');
  $feature_intro_wrapper = get_field('feature_intro_wrapper');
  $feature_intro_class = get_field('feature_intro_class');
  $feature_title = get_field('feature_title');
  $feature_title_size = get_field('feature_title_size');
  $feature_title_font = get_field('feature_title_font');
  $feature_title_color = get_field('feature_title_color');
  $feature_text = get_field('feature_text');
  $feature_text_font = get_field('feature_text_font');
  $feature_text_color = get_field('feature_text_color');

	/* TEXT */
  $text_class = get_field('text_class');
  $text_background = get_field('text_background_color');
  $title = get_field('title');
  $title_font = get_field('title_font');
  $title_color = get_field('title_color');
  $text = get_field('text');
  $text_font = get_field('text_font');
  $text_color = get_field('text_color');
  $section_links = get_field('section_links');
  /* IMAGE */
  $image_background = get_field('images_background_color');
  $image_position = get_field('section_images_position');
  $animation_speed = get_field('animation_speed');
  $animation_timeout = get_field('animation_timeout');
  $images = get_field('images');
  $parallax = get_field('image_parallax');
  $image_effect = get_field('image_effect');
  $circle_image = get_field('circle_image');

?>
<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="feature-section<?php if($section_layout == 'full-width') { echo ' full-width'; } ?><?php if($section_class) { echo ' '.$section_class; } ?><?php if ($section_layout != 'full-width' && $image_position == 'right') { echo ' reverse'; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">
<?php if($feature_intro) { ?>
      <div class="feature-intro<?php if($feature_intro_class) { echo ' '.$feature_intro_class; } ?>">
        <div class="feature-intro-content<?php if($feature_intro_wrapper) { echo ' '.$feature_intro_wrapper; } ?>">
        <?php if($show_circles) { ?>
          <div id="<?php if($section_id) { echo $section_id . '-'; } ?>circles" class="four-circles animate-zoom-and-spin">
            <img class="stretch" src="/wp-content/themes/client-theme/images/global/animation-graphic.svg" alt="Circles">
          </div>
        <?php } ?>
        <?php if($feature_title) { ?><h2 class="section-title<?php echo $feature_title_size; ?> tcenter<?php if($feature_text) { ?> marb1<?php } ?> t<?php echo $feature_title_color; ?> font-<?php echo $feature_title_font; ?>"><?php echo $feature_title; ?></h2><?php } ?>
        <?php if($feature_text) { ?><div class="default-content tcenter t<?php echo $feature_text_color; ?> font-<?php echo $feature_text_font; ?>"><?php echo $feature_text;?></div><?php } ?>
        </div>
      </div>
    <?php } ?>    
  <div class="feature-section-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>">
    <?php if($images) { $imgcount = count($images); ?>
      <div class="feature-section-image with-radius animate-<?php if($section_layout == 'full-width') { echo 'fadein'; } else if ($image_position == 'left') { echo 'right'; } else { echo 'left'; } ?> nofade<?php if($image_effect == 'parallax') { echo ' with-parallax'; } ?>">

      <div class="<?php if($image_effect == 'parallax') { echo 'parallax-rev parallax-bg  '; } ?>fill<?php if($imgcount > 1) { ?> cycle-slideshow<?php } ?>"<?php if($imgcount > 1) { ?> data-cycle-slides=".slide" data-cycle-speed="<?php echo $animation_speed; ?>" data-cycle-timeout="<?php echo $animation_timeout; ?>"<?php } ?>>

      <?php foreach( $images as $image ): ?>
      <div class="slide fill cover responsive-background-image<?php if($image_effect == 'fixedbg') { echo ' fixedbg'; } ?>" <?php $bg_position = get_field('bg_position', $image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
      <?php if($image) { acf_responsive_image($image); } ?>
      </div>
      <?php $imgcount++; endforeach; ?>
      </div>
      </div>
    <?php } ?>
    <div class="feature-section-text<?php if($circle_image) { ?> has-circle<?php } ?> default-content tcenter animate-<?php if($section_layout == 'full-width') { echo 'fadein'; } else if ($image_position == 'left') { echo 'left'; } else { echo 'right'; } ?> t<?php echo $text_color; ?> font-<?php echo $text_font; ?><?php if($text_class) { echo ' '.$text_class; } ?>">
      <?php if($text_background) { ?><div class="overlay bg<?php echo $text_background; ?> fill"></div><?php } ?>
      <?php if($title) { ?><h2 class="section-title t<?php echo $title_color; ?> font-<?php echo $title_font; ?>"><?php echo $title; ?></h2><?php } ?>
      <?php if($text) { ?><?php echo $text; ?><?php } ?>
        <?php if( have_rows('links') ): ?>
          <div class="feature-section-text-links">
          <?php while( have_rows('links') ): the_row();?>
          <?php $link = get_sub_field('link');
          if( $link ):$link_url = $link['url'];$link_title = $link['title'];$link_target = $link['target'] ? $link['target'] : '_self';?>
              <?php
              $link_style = get_sub_field('link_style');
              $link_font = get_sub_field('link_font');
              $link_color = get_sub_field('link_color');
              $link_background_color = get_sub_field('link_background_color');
              $link_arrow = get_sub_field('link_arrow');
              $link_fancybox = get_sub_field('fancybox_toggle');
              $link_fancybox_content = get_sub_field('fancybox_content');
              $link_fancybox_caption = get_sub_field('fancybox_caption');
              $link_fancybox_gallery = get_sub_field('fancybox_gallery');
                ?>
              <?php 
              // Generate random number for gallery
              $gallery_random_num = rand(1000, 9999);
              ?>
              <?php if($link_style == 'button') { ?>
                <a class="boxbtn with-radius<?php if($link_arrow) echo ' with-arrow'; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?> bg<?php echo $link_background_color; ?><?php if ($link_fancybox_gallery) { echo ' gallery-link'; } ?>"<?php if (!$link_fancybox_gallery) { echo ' href="'.esc_url( $link_url ).'" target="'.esc_attr( $link_target ).'"'; } else { echo ' data-gallery-name="gallery-'.$gallery_random_num.'" href="javascript:void(0)"'; } ?><?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox_gallery) { echo ' data-fancybox="gallery-'.$gallery_random_num.'"'; } if (($link_fancybox || $link_fancybox_gallery) && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?>><span><?php echo esc_html( $link_title ); ?></span></a>
                <?php } else { ?>
                 <a class="font-<?php echo $link_font; ?> t<?php echo $link_color; ?><?php if ($link_fancybox_gallery) { echo ' gallery-link'; } ?><?php if($link_arrow) echo ' arrowlink'; ?> "<?php if (!$link_fancybox_gallery) { echo ' href="'.esc_url( $link_url ).'" target="'.esc_attr( $link_target ).'"'; } else { echo ' data-gallery-name="gallery-'.$gallery_random_num.'" href="javascript:void(0)"'; } ?><?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox_gallery) { echo ' data-fancybox="gallery-'.$gallery_random_num.'"'; } if (($link_fancybox || $link_fancybox_gallery) && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?>><?php echo esc_html( $link_title ); ?></a>
                <?php } ?>

                <?php if($link_fancybox_gallery && is_array($link_fancybox_gallery)) { ?>
                <!-- Hidden Gallery -->
                <ul class="gallery-<?php echo $gallery_random_num; ?>" style="display: none;">
                  <?php foreach($link_fancybox_gallery as $gallery_image): ?>
                    <li><a data-fancybox="gallery-<?php echo $gallery_random_num; ?>" class="fancybox" href="<?php echo esc_url($gallery_image['url']); ?>" data-caption="<?php echo esc_attr($gallery_image['caption'] ? $gallery_image['caption'] : $link_fancybox_caption); ?>" aria-label="<?php echo esc_attr($gallery_image['alt'] ? $gallery_image['alt'] : $link_title); ?>"></a></li>
                  <?php endforeach; ?>
                </ul>
                <?php } ?>
                  
            <?php endif; ?>
          <?php endwhile; ?>
          </div>
        <?php endif; ?>
        
    </div>

  </div>

  <?php if($circle_image) { ?>
      <div class="feature-section-circle <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>">
        <div class="feature-section-circle-image responsive-background-image cover animate-zoomin short-delay" <?php $bg_position = get_field('bg_position', $circle_image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
            <?php acf_responsive_image($circle_image); ?>
        </div>
     </div>
    <?php } ?>
</section>
