<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_background = get_field('section_background_color');
	/* LINK */
  $text_class = get_field('link_class');
  $link_valign = get_field('link_vert_align');
  $link_halign = get_field('link_horz_align');
  $link_background = get_field('link_background_color');
  $link_gap = get_field('link_gap');
  $mobile_link_gap = get_field('mobile_link_gap');
  $link_display = get_field('link_display');
  $links_font_size = get_field('links_font_size');
?>

<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="text-section link-section<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">
  <div class="text-section-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?>">
    <div class="text-section-text bg<?php echo $link_background; ?> default-content<?php if($text_class) { echo ' '.$text_class; } ?><?php echo ' v'.$link_valign.' t'.$link_halign; ?>">
    <div class="text-section-text-content">
    <?php if( have_rows('links') ): ?>
        <div class="text-section-text-links wrapper-full with-gap">
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
            $link_fancybox_iframe = get_sub_field('fancybox_iframe');
            $link_fancybox_caption = get_sub_field('fancybox_caption');
              ?>
              <div class="link-item <?php echo 'display-'.$link_display; ?>">
            <?php if($link_style == 'button') { ?>
                <a class="boxbtn with-radius<?php if($link_arrow) echo ' arrowlink'; ?> font-<?php echo $link_font; ?> t<?php echo $link_color; ?> bg<?php echo $link_background_color; ?><?php if($link_gap) echo ' gap'. $link_gap; ?><?php if($mobile_link_gap) { echo ' mgap'. $mobile_link_gap; } ?> link-size-<?php echo $links_font_size; ?>" href="<?php if($link_url == '#') { echo 'javascript:'; } else { echo esc_url( $link_url ); } ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?><?php if($link_fancybox && $link_fancybox_iframe) { echo ' data-type="iframe"';} ?>><span><?php echo esc_html( $link_title ); ?></span></a>
              <?php } else { ?>
                <a class="arrowlink font-<?php echo $link_font; ?> t<?php echo $link_color; ?><?php if($link_gap) echo ' gap'. $link_gap; ?><?php if($mobile_link_gap) { echo ' mgap'. $mobile_link_gap; } ?> link-size-<?php echo $links_font_size; ?>" href="<?php if($link_url == '#') { echo 'javascript:'; } else { echo esc_url( $link_url ); } ?>" target="<?php echo esc_attr( $link_target ); ?>"<?php if ($link_fancybox) { echo ' data-fancybox'; } if ($link_fancybox && $link_fancybox_caption) { echo ' data-caption="'.$link_fancybox_caption.'"'; } ?><?php if($link_fancybox && $link_fancybox_iframe) { echo ' data-type="iframe"'; } ?>><?php echo esc_html( $link_title ); ?></a>
              <?php } ?>
              </div>
          <?php endif; ?>
        <?php endwhile; ?>
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>