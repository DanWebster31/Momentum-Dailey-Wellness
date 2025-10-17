<?php
if(is_home() || (is_single() && is_singular('post')) || is_category()) {
  $page_ID = get_option('page_for_posts');
} else {
  $page_ID = get_the_ID();
}
  
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $section_height = get_field('section_height');
  $wrapper_inset = get_field('wrapper_inset');
  $section_layout = get_field('section_layout');
  $column_gap = get_field('column_gap');
  $mobile_column_gap = get_field('mobile_column_gap');
  $section_background = get_field('section_background');
  $section_background_color = get_field('section_background_color');
  $section_background_image = get_field('section_background_image');
  $section_background_image_fixed = get_field('section_background_image_fixed');
  $section_background_overlay = get_field('section_background_overlay');
  $section_background_overlay_color = get_field('section_background_overlay_color');
  $section_background_overlay_opacity = get_field('section_background_overlay_opacity');
  $show_bottom_divider = get_field('section_bottom_divider');
  $show_circles = get_field('show_circles');

  /* TEXT */
  $text_class = get_field('text_class');
  $text_wrapper = get_field('text_wrapper');
  $text_background = get_field('text_background');
  $text_background_color = get_field('text_background_color');
  $text_background_image = get_field('text_background_image');
  $text_background_image_fixed = get_field('text_background_image_fixed');
  $text_background_overlay = get_field('text_background_overlay');
  $text_background_overlay_color = get_field('text_background_overlay_color');
  $text_background_overlay_opacity = get_field('text_background_overlay_opacity');
  $text_valign = get_field('text_vert_align');
  $text_halign = get_field('text_horz_align');
  $text_title_image = get_field('text_title_image');
  $text_title_image_class = get_field('text_title_image_class');
  $text_title_image_max_width = get_field('text_title_image_max_width');
  $text_title_image_align = get_field('text_title_image_align');
  $text_title = get_field('title');
  $text_title_size = ''; if(get_field('title_size') != 'default') { $text_title_size = '-'.get_field('title_size'); }
  $text_title_font = get_field('title_font');
  $text_title_color = get_field('title_color');
  $text_title_tag = 'h2'; if(get_field('title_tag')) { $text_title_tag = get_field('title_tag'); }
  $text_text = get_field('text');
  $text_font = get_field('text_font');
  $text_color = get_field('text_color');
  $text_links = get_field('text_links');
  $text_links_size = ''; if(get_field('text_links_size') != 'default') { $text_links_size = '-'.get_field('text_links_size'); }
  $text_link_class = get_field('text_link_class');
  $text_link_display = get_field('text_link_display');
  $text_link_gap = get_field('text_link_gap');
  $text_link_mobile_gap = get_field('text_link_mobile_gap');

  /* TEXT 2 */
  $text_2_class = get_field('text_2_class');
  $text_2_wrapper = get_field('text_2_wrapper');
  $text_2_background = get_field('text_2_background');
  $text_2_background_color = get_field('text_2_background_color');
  $text_2_background_image = get_field('text_2_background_image');
  $text_2_background_image_fixed = get_field('text_2_background_image_fixed');
  $text_2_background_overlay = get_field('text_2_background_overlay');
  $text_2_background_overlay_color = get_field('text_2_background_overlay_color');
  $text_2_background_overlay_opacity = get_field('text_2_background_overlay_opacity');
  $text_2_valign = get_field('text_2_vert_align');
  $text_2_halign = get_field('text_2_horz_align');
  $text_2_title_image = get_field('text_2_title_image');
  $text_2_title_image_class = get_field('text_2_title_image_class');
  $text_2_title_image_max_width = get_field('text_2_title_image_max_width');
  $text_2_title_image_align = get_field('text_2_title_image_align');
  $text_2_title = get_field('title_2');
  $text_2_title_size = ''; if(get_field('title_2_size') != 'default') { $text_2_title_size = '-'.get_field('title_2_size'); }
  $text_2_title_font = get_field('title_2_font');
  $text_2_title_color = get_field('title_2_color');
  $text_2_title_tag = 'h2'; if(get_field('title_2_tag')) { $text_2_title_tag = get_field('title_2_tag'); }
  $text_2_text = get_field('text_2');
  $text_2_text_font = get_field('text_2_font');
  $text_2_text_color = get_field('text_2_color');
  $text_2_links = get_field('text_2_links');
  $text_2_links_size = ''; if(get_field('text_2_links_size') != 'default') { $text_2_links_size = '-'.get_field('text_2_links_size'); }
  $text_2_link_class = get_field('text_2_link_class');
  $text_2_link_display = get_field('text_2_link_display');
  $text_2_link_gap = get_field('text_2_link_gap');
  $text_2_link_mobile_gap = get_field('text_2_link_mobile_gap');
  ?>
<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="text-section<?php if($section_layout == 'two-column') { echo ' two-column'; } else if($section_layout == 'full-width') { echo ' full-width'; } ?>">

  <div class="text-section-content<?php echo ' '.$section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?><?php if($section_layout == 'two-column') { echo ' gap'. $column_gap.' gapm'. $mobile_column_gap; } ?><?php if($section_background == 'color') { echo ' bg'.$section_background_color; } else if($section_background == 'image') {  echo ' cover responsive-background-image'; } ?><?php if($section_background_image_fixed) { echo ' fixedbg'; } ?><?php if($section_class) { echo ' '.$section_class; } ?>"<?php if($section_height) { echo ' style="height:'.$section_height.';"'; }?>>
  <?php if($section_background_image) { ?>
    <?php acf_responsive_image($section_background_image); ?>
    <?php if($section_background_overlay) { ?>
      <div class="overlay bg<?php echo $section_background_overlay_color; ?>" style="opacity:<?php echo $section_background_overlay_opacity; ?>"></div>
   <?php } ?>
  <?php } ?>
    <div class="text-section-text<?php if($text_class) { echo ' '.$text_class; } ?><?php if($text_wrapper) { echo ' '.$text_wrapper; } ?> default-content animate-<?php if($section_layout == 'full-width') { echo 'fadein'; } else { echo 'right'; } ?><?php echo ' v'.$text_valign.' t'.$text_halign; ?> t<?php echo $text_color; ?><?php if($text_class) { echo ' '.$text_class; } ?><?php if($text_background == 'color') { echo ' bg'.$text_background_color; } else if($text_background == 'image') {  echo ' cover responsive-background-image'; } ?><?php if($text_background_image_fixed) { echo ' fixedbg'; } ?>">
        <?php if($text_background_image) { ?>
        <?php acf_responsive_image($text_background_image); ?>
        <?php if($text_background_overlay) { ?>
          <div class="overlay bg<?php echo $text_background_overlay_color; ?>" style="opacity:<?php echo $text_background_overlay_opacity; ?>"></div>
      <?php } ?>
      <?php } ?>
      <div class="text-section-text-content">
      <?php if($show_circles) { ?>
        <div id="<?php if($section_id) { echo $section_id . '-'; } ?>circles" class="four-circles animate-zoom-and-spin">
          <img src="/wp-content/themes/client-theme/images/global/animation-graphic.svg" alt="Circles">
        </div>
      <?php } ?>
      <?php if($text_title_image) { ?>
        <div class="title-image t<?php echo $text_title_image_align; ?>"><img class="stretch<?php if($text_title_image_class) { echo ' '.$text_title_image_class; } ?>" src="<?php echo $text_title_image['url']; ?>" alt="<?php echo $text_title_image['alt']; ?>"<?php if($text_title_image_max_width) { echo ' style="max-width:'.$text_title_image_max_width.'"'; } ?>></div>
      <?php } ?>
      <?php  if($text_title) { ?><?php echo '<'.$text_title_tag.' class="section-title'.$text_title_size.' t'.$text_title_color.' font-'.$text_title_font.'">'; ?><?php echo $text_title; ?><?php echo '</'.$text_title_tag.'>'; ?><?php } ?>
      <?php if($text_text) { ?><div class="default-font font-<?php echo $text_font; ?>"><?php echo $text_text;?></div><?php } ?>
      <?php if( have_rows('text_links') ): ?>
        <div class="text-section-text-links<?php echo ' '.$text_link_class; ?>">
        <?php while( have_rows('text_links') ): the_row();?>
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
            ?>
            
            <div class="link-item <?php echo 'display-'.$text_link_display; ?>">
            <?php if($link_style == 'button') { ?>
              <a class="boxbtn with-radius<?php if($link_arrow) echo ' with-arrow'; ?> link-size<?php echo $text_links_size; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?> bg<?php echo $link_background_color; ?><?php if($text_link_gap) echo ' gap'. $text_link_gap; ?><?php if($text_link_mobile_gap) { echo ' mgap'. $text_link_mobile_gap; } ?>"
              <?php if ($link_fancybox) { ?> data-fancybox<?php if ($link_fancybox_caption) { ?> data-caption="<?php echo $link_fancybox_caption; ?>"<?php } ?>
              <?php if($link_fancybox_content == 'inline') { ?> data-src="<?php echo esc_url( $link_url ); ?>" href="javscript:"<?php } ?><?php } else { ?> href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php } ?>>
              <span><?php echo esc_html( $link_title ); ?></span></a>
              <?php } else { ?>
                <a class="<?php if($link_arrow) echo 'arrowlink'; ?> link-size<?php echo $text_links_size; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?><?php if($text_link_gap) echo ' gap'. $text_link_gap; ?><?php if($text_link_mobile_gap) { echo ' mgap'. $text_link_mobile_gap; } ?>"
              <?php if ($link_fancybox) { ?> data-fancybox<?php if ($link_fancybox_caption) { ?> data-caption="<?php echo $link_fancybox_caption; ?>"<?php } ?>
              <?php if($link_fancybox_content == 'inline') { ?> data-src="<?php echo esc_url( $link_url ); ?>" href="javscript:"<?php } ?><?php } else { ?> href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php } ?>>
              <span><?php echo esc_html( $link_title ); ?></span></a>
              <?php } ?>
              </div>

          <?php endif; ?>
        <?php endwhile; ?>
        </div>
      <?php endif; ?>
      </div>
  </div>

    <?php if($section_layout == 'two-column') { ?>


    <div class="text-section-text<?php if($text_2_class) { echo ' '.$text_2_class; } ?><?php if($text_2_wrapper) { echo ' '.$text_2_wrapper; } ?> default-content animate-left <?php echo 'v'.$text_2_valign.' t'.$text_2_halign; ?><?php if($section_layout == 'two-column' && $text_2_valign) { echo ' v'.$text_2_valign; } ?><?php echo ' t'.$text_2_halign; ?> t<?php echo $text_2_text_color; ?><?php if($text_2_class) { echo ' '.$text_2_class; } ?><?php if($text_2_background == 'color') { echo ' bg'.$text_2_background_color; } else if($text_2_background == 'image') {  echo ' cover responsive-background-image'; } ?><?php if($text_2_background_image_fixed) { echo ' fixedbg'; } ?>">
        <?php if($text_2_background_image) { ?>
        <?php acf_responsive_image($text_2_background_image); ?>
        <?php if($text_2_background_overlay) { ?>
          <div class="overlay bg<?php echo $text_2_background_overlay_color; ?>" style="opacity:<?php echo $text_2_background_overlay_opacity; ?>"></div>
      <?php } ?>
      <?php } ?>
      <div class="text-section-text-content">
      <?php if($text_2_title_image) { ?>
        <div class="title-image t<?php echo $text_2_title_image_align; ?>"><img class="stretch<?php if($text_2_title_image_class) { echo ' '.$text_2_title_image_class; } ?>" src="<?php echo $text_2_title_image['url']; ?>" alt="<?php echo $text_2_title_image['alt']; ?>"<?php if($text_2_title_image_max_width) { echo ' style="max-width:'.$text_2_title_image_max_width.'"'; } ?>></div>
      <?php } ?>
      <?php  if($text_2_title) { ?><?php echo '<'.$text_2_title_tag.' class="section-title'.$text_2_title_size.' t'.$text_2_title_color.' font-'.$text_2_title_font.'">'; ?><?php echo $text_2_title; ?><?php echo '</'.$text_2_title_tag.'>'; ?><?php } ?>
      <?php if($text_2_text) { ?><div class="default-font font-<?php echo $text_2_text_font; ?>"><?php echo $text_2_text;?></div><?php } ?>
      <?php if( have_rows('text_2_links') ): ?>
        <div class="text-section-text-links<?php echo ' '.$text_2_link_class; ?>">
        <?php while( have_rows('text_2_links') ): the_row();?>
        <?php $link = get_sub_field('text_2_link');
        if( $link ):$link_url = $link['url'];$link_title = $link['title'];$link_target = $link['target'] ? $link['target'] : '_self';?>
            <?php
            $link_style = get_sub_field('text_2_link_style');
            $link_font = get_sub_field('text_2_link_color');
            $link_color = get_sub_field('text_2_link_font');
            $link_background_color = get_sub_field('text_2_link_background_color');
            $link_arrow = get_sub_field('text_2_link_arrow');
            $link_fancybox = get_sub_field('text_2_fancybox_toggle');
            $link_fancybox_content = get_sub_field('text_2_fancybox_content');
            $link_fancybox_caption = get_sub_field('text_2_fancybox_caption');
              ?>
            <?php if($link_style == 'button') { ?>
              <a class="boxbtn with-radius<?php if($link_arrow) echo ' with-arrow'; ?> link-size<?php echo $text_2_links_size; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?> bg<?php echo $link_background_color; ?>"
              <?php if ($link_fancybox) { ?> data-fancybox<?php if ($link_fancybox_caption) { ?> data-caption="<?php echo $link_fancybox_caption; ?>"<?php } ?>
              <?php if($link_fancybox_content == 'inline') { ?> data-src="<?php echo esc_url( $link_url ); ?>" href="javscript:"<?php } ?><?php } else { ?> href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php } ?>>
              <span><?php echo esc_html( $link_title ); ?></span></a>
              <?php } else { ?>
                <a class="arrowlink link-size<?php echo $text_2_link_size; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?>"
              <?php if ($link_fancybox) { ?> data-fancybox<?php if ($link_fancybox_caption) { ?> data-caption="<?php echo $link_fancybox_caption; ?>"<?php } ?>
              <?php if($link_fancybox_content == 'inline') { ?> data-src="<?php echo esc_url( $link_url ); ?>" href="javscript:"<?php } ?><?php } else { ?> href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php } ?>>
              <span><?php echo esc_html( $link_title ); ?></span></a>
              <?php } ?>
          <?php endif; ?>
        <?php endwhile; ?>
        </div>
      <?php endif; ?>
      </div>
  </div>

  <?php } ?>

  </div>
</section>

<?php if($show_bottom_divider) { ?>
<div class="<?php echo $show_bottom_divider; ?> mb-4<?php echo ' '.$section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>"></div>
<?php } ?>
