<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $show_circles = get_field('show_circles');
  // $section_layout = get_field('section_layout');
  // $section_background_color = get_field('section_background_color');
  $section_background = get_field('section_background');
  $section_background_color = get_field('section_background_color');
  $section_background_image = get_field('section_background_image');
  $section_background_image_fixed = get_field('section_background_image_fixed');
  $section_background_overlay = get_field('section_background_overlay');
  $section_background_overlay_color = get_field('section_background_overlay_color');
  $section_background_overlay_opacity = get_field('section_background_overlay_opacity');
  $show_bottom_divider = get_field('show_bottom_divider');

  $grid_class = get_field('grid_class');
  $grid_background = get_field('grid_background');
  $grid_background_color = get_field('grid_background_color');
  $grid_background_image = get_field('grid_background_image');
  $grid_background_image_fixed = get_field('grid_background_image_fixed');
  $grid_background_overlay = get_field('grid_background_overlay');
  $grid_background_overlay_color = get_field('grid_background_overlay_color');
  $grid_background_overlay_opacity = get_field('grid_background_overlay_opacity');
  $grid_columns = get_field('grid_columns');
  $grid_mosaic = get_field('grid_mosaic');
  $grid_gap = get_field('grid_column_gap');

  $grid_intro = get_field('grid_intro');
  $grid_intro_wrapper = get_field('grid_intro_wrapper');
  $grid_intro_class = get_field('grid_intro_class');

  $grid_title = get_field('grid_title');
  $grid_title_class = get_field('grid_title_class');
  $grid_title_size = ''; if(get_field('grid_title_size') != 'default') { $grid_title_size = '-'.get_field('grid_title_size'); }
  $grid_title_font = get_field('grid_title_font');
  $grid_title_color = get_field('grid_title_color');

  $grid_text = get_field('grid_text');
  $grid_text_class = get_field('grid_text_class');
  $grid_text_font = get_field('grid_text_font');
  $grid_text_color = get_field('grid_text_color');

  $item_height = get_field('item_height');
  $item_min_height = get_field('item_min_height');
  $item_max_height = get_field('item_max_height');
?>

<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="content-grid<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background == 'color') { echo ' bg'.$section_background_color; } else if($section_background == 'image' && $section_background_image) {  echo ' cover responsive-background-image'; } ?><?php if($section_background_image_fixed) { echo ' fixedbg'; } ?>">
  <?php if($section_background_image && $section_background_image) { ?>
    <?php acf_responsive_image($section_background_image); ?>
    <?php if($section_background_overlay) { ?>
      <div class="overlay bg<?php echo $section_background_overlay_color; ?>" style="opacity:<?php echo $section_background_overlay_opacity; ?>"></div>
   <?php } ?>
  <?php } ?>

  <?php if($grid_intro) { ?>
      <div class="grid-title<?php if($grid_intro_class) { echo ' '.$grid_intro_class; } ?>">
        <div class="grid-intro-content<?php if($grid_intro_wrapper) { echo ' '.$grid_intro_wrapper; } ?>">
        <?php if($show_circles) { ?>
        <div id="<?php if($section_id) { echo $section_id . '-'; } ?>circles" class="circles animate-zoom-and-spin">
          <img src="/wp-content/themes/client-theme/images/global/animation-graphic.svg" alt="Circles">
        </div>
        <?php } ?>
        <?php if($grid_title) { ?><h2 class="section-title<?php echo $grid_title_size; ?> tcenter<?php if($grid_text) { ?> marb1<?php } ?> t<?php echo $grid_title_color; ?> font-<?php echo $grid_title_font; ?>"><?php echo $grid_title; ?></h2><?php } ?>
        <?php if($grid_text) { ?><div class="default-content tcenter t<?php echo $grid_text_color; ?> font-<?php echo $grid_text_font; ?>"><?php echo $grid_text;?></div><?php } ?>
        </div>
      </div>
    <?php } ?>   

  <div class="content-grid-content<?php if($grid_mosaic) { echo ' mosaic'; } ?> <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?> <?php echo $grid_columns; ?><?php if($grid_class) { echo ' '.$grid_class; } ?><?php if($grid_background == 'color') { echo ' bg'.$grid_background_color; } else if($grid_background == 'image' && $grid_background_image) {  echo ' cover responsive-background-image'; } ?><?php if($grid_background_image_fixed) { echo ' fixedbg'; } ?>"<?php if($grid_gap) { echo ' style="gap:'. $grid_gap. '"'; } ?>>
  <?php if($grid_background_image && $grid_background_image) { ?>
    <?php acf_responsive_image($grid_background_image); ?>
    <?php if($grid_background_overlay) { ?>
      <div class="overlay bg<?php echo $grid_background_overlay_color; ?>" style="opacity:<?php echo $grid_background_overlay_opacity; ?>"></div>
   <?php } ?>
  <?php } ?>

  <?php if( have_rows('grid_items') ): ?>
  <?php while( have_rows('grid_items') ): the_row();
      $grid_item_class = get_sub_field('grid_item_class');
      $grid_item_vert_align = get_sub_field('grid_item_vert_align');
      if($grid_item_vert_align == 'top') { $grid_item_vert_align = 'flex-start'; }
      if($grid_item_vert_align == 'bottom') { $grid_item_vert_align = 'flex-end'; }
      $grid_item_background_color = get_sub_field('grid_item_background_color');
      $grid_item_background_image = get_sub_field('grid_item_background_image');
      $grid_item_background_image_type = get_sub_field('grid_item_background_image_type');
      $grid_item_background_image_fixed = get_sub_field('grid_item_background_image_fixed');
      $grid_item_video_icon = get_sub_field('grid_item_video_icon');
      $grid_item_background_overlay = get_sub_field('grid_item_overlay');
      $grid_item_background_overlay_color = get_sub_field('grid_item_background_overlay_color');
      $grid_item_background_overlay_opacity = get_sub_field('grid_item_background_overlay_opacity');
      $grid_item_title_image = get_sub_field('grid_item_title_image');
      $grid_item_title_image_class = get_sub_field('grid_item_title_image_class');
      $grid_item_title_image_display = get_sub_field('grid_item_title_image_display');
      $grid_item_title_image_height = get_sub_field('grid_item_title_image_height');
      $grid_item_title_image_min_height = get_sub_field('grid_item_title_image_min_height');
      $grid_item_title_image_max_height = get_sub_field('grid_item_title_image_max_height');
      $grid_item_title_image_max_width = get_sub_field('grid_item_title_image_max_width');
      $grid_item_title_image_align = get_sub_field('grid_item_title_image_align');
      $grid_item_title = get_sub_field('grid_item_title');
      $grid_item_title_size = ''; if(get_sub_field('grid_item_title_size') != 'default') { $grid_item_title_size = '-'.get_sub_field('grid_item_title_size'); }
      $grid_item_title_font = get_sub_field('grid_item_title_font');
      $grid_item_title_color = get_sub_field('grid_item_title_color');
      $grid_item_title_align = get_sub_field('grid_item_title_align');
      $grid_item_text = get_sub_field('grid_item_text');
      $grid_item_text_font = get_sub_field('grid_item_text_font');
      $grid_item_text_color = get_sub_field('grid_item_text_color');
      $grid_item_link = get_sub_field('grid_item_link');
  ?>
  <div class="content-grid-item<?php if($grid_item_video_icon) { echo ' launch-video'; } ?> default-content tcenter animate-fadein<?php if($grid_item_class) { echo ' '.$grid_item_class; } ?><?php if($grid_item_background_color) { echo ' bg'.$grid_item_background_color; } ?><?php if($grid_item_background_image_fixed) { echo ' fixedbg'; } ?>" style="<?php if(!$grid_item_video_icon && $item_height) { echo 'height:'.$item_height.';'; } ?><?php if(!$grid_item_video_icon && $item_min_height) { echo 'min-height:'.$item_min_height.';'; } ?><?php if(!$grid_item_video_icon && $item_max_height) { echo 'max-height:'.$item_max_height.';'; } ?><?php echo ' justify-content:'.$grid_item_vert_align.';'; ?>">
      <?php 
      if( $grid_item_link ): $link_url = $grid_item_link['url'];$link_title = $grid_item_link['title'];$link_target = $grid_item_link['target'] ? $grid_item_link['target'] : '_self';?>
      <?php
      $link_style = get_sub_field('link_style');
      $link_font = get_sub_field('link_font');
      $link_color = get_sub_field('link_color');
      $link_background_color = get_sub_field('link_background_color');
      $link_fancybox = get_sub_field('fancybox_toggle');
      $link_fancybox_iframe = get_sub_field('fancybox_iframe');
      $link_fancybox_caption = get_sub_field('fancybox_caption');
      endif; ?>
    <?php if($grid_item_link && $link_style == 'none') { ?>
      <a class="full-item-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?><?php if($link_fancybox && $link_fancybox_iframe) { echo ' data-type="iframe"';} ?>>
    <?php } ?>  

    <?php if($grid_item_background_image) { ?>
      <div id="<?php echo esc_attr(sanitize_title($grid_item_background_image['alt'])); ?>" class="content-grid-item-image <?php echo $grid_item_background_image_type; ?> responsive-background-image" style="<?php if($grid_item_video_icon && $item_height) { echo 'height:'.$item_height.';'; } ?><?php if($grid_item_video_icon && $item_min_height) { echo 'min-height:'.$item_min_height.';'; } ?><?php if($grid_item_video_icon && $item_max_height) { echo 'max-height:'.$item_max_height.';'; } ?><?php $bg_position = get_field('bg_position', $grid_item_background_image['ID']); if($bg_position): echo ' background-position:'.$bg_position.';'; endif; ?>">
      <?php acf_responsive_image($grid_item_background_image); ?>

      <?php if($grid_item_background_overlay) { ?>
      <div class="overlay bg<?php echo $grid_item_background_overlay_color; ?>" style="opacity:<?php echo $grid_item_background_overlay_opacity; ?>"></div>
      <?php } ?>
      <?php if($grid_item_video_icon) { ?>
      <div class="video-play tcenter">
      <img class="stretch play-arrow mb-1" src="/wp-content/uploads/2024/11/play-arrow.svg" alt="">
      <?php if($link_title) { echo '<h2 class="section-title-xsmall twhite tcenter font-main">'.$link_title.'</h2>'; } ?>
      </div>
      <?php } ?>
      </div>
    <?php } ?>
  
    <?php if($grid_item_link && $link_style == 'none' && $grid_item_video_icon) { ?></a><?php } ?>

    <?php if($grid_item_title_image || $grid_item_title || $grid_item_text) { ?>
    <div class="content-grid-item-content">
      <?php if($grid_item_title_image) { ?>
        <?php if($grid_item_title_image_display != 'auto') {  ?>
          <div class="title-image responsive-background-image <?php echo $grid_item_title_image_display; ?><?php if($grid_item_title_image_class) { echo ' '.$grid_item_title_image_class; } ?>" style="<?php if($grid_item_title_image_height) { echo'height:'.$grid_item_title_image_height.';'; } ?><?php if($grid_item_title_image_min_height) { echo' min-height:'.$grid_item_title_image_min_height.';'; } ?><?php if($grid_item_title_image_max_height) { echo' max-height:'.$grid_item_title_image_max_height.';'; } ?><?php if($grid_item_title_image_max_width) { echo' max-width:'.$grid_item_title_image_max_width.';'; } ?><?php $bg_position = get_field('bg_position', $grid_item_title_image['ID']); if($bg_position) { echo ' background-position:'.$bg_position.';'; } ?><?php if($grid_item_title_image_align == "center") { echo ' margin-left: auto; margin-right: auto;'; } ?>">
          <?php acf_responsive_image($grid_item_title_image); ?>
          </div>
        <?php } else { ?>
          <div class="title-image t<?php echo $grid_item_title_image_align; ?>"><img class="stretch<?php if($grid_item_title_image_class) { echo ' '.$grid_item_title_image_class; } ?>" src="<?php echo $grid_item_title_image['url']; ?>" alt="<?php echo $grid_item_title_image['alt']; ?>"<?php if($grid_item_title_image_max_width || $grid_item_title_image_min_height) { echo ' style="'; if($grid_item_title_image_max_width) { echo 'max-width:'.$grid_item_title_image_max_width.';'; } if($grid_item_title_image_min_height) { echo 'min-height:'.$grid_item_title_image_min_height.';'; } echo '"'; } ?>></div><?php } ?>
          <?php  ?>
        <?php } ?>
      <?php if($grid_item_title) { ?><h2 class="section-title<?php echo $grid_item_title_size; ?> t<?php echo $grid_item_title_color; ?> t<?php echo $grid_item_title_align; ?> font-<?php echo $grid_item_title_font; ?>"><?php echo $grid_item_title; ?></h2><?php } ?>
      <?php if($grid_item_text) { ?><div class="default-content t<?php echo esc_html($grid_item_text_color); ?> font-<?php echo $grid_item_text_font; ?>"><?php echo $grid_item_text;?></div><?php } ?>
     
      <?php if($grid_item_link && $link_style == 'button') { ?>
        <a class="boxbtn with-arrow font-<?php echo $link_font; ?> t<?php echo $link_color; ?> bg<?php echo $link_background_color; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?><?php if($link_fancybox && $link_fancybox_iframe) { echo ' data-type="iframe"';} ?>><span><?php echo $link_title; ?></span></a>
      <?php } else if($grid_item_link && $link_style == 'text') { ?>
        <a class="arrowlink font-<?php echo $link_font; ?> t<?php echo $link_color; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?><?php if($link_fancybox && $link_fancybox_iframe) { echo ' data-type="iframe"';} ?>><?php echo $link_title; ?> <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
      <?php } ?>
    </div>
    <?php } ?>

    <?php if($grid_item_link && $link_style == 'none'  && !$grid_item_video_icon) { ?></a><?php } ?> 
    </div>
    <?php endwhile; ?>
    <?php endif; ?>

  </div>

  <?php if($show_bottom_divider) { ?>
  <div class="<?php echo $show_bottom_divider; ?> <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>"></div>
  <?php } ?>
</section>
