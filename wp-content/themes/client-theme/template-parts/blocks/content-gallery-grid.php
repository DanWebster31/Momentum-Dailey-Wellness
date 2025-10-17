<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_background = get_field('section_background_color');
	/* GALLERY */
  $grid_columns = get_field('grid_columns');
  $grid_gap = get_field('grid_column_gap');
  $gallery_class = get_field('gallery_class');
  $gallery_background = get_field('gallery_background_color');
  $overlay_color = get_field('overlay_color');
  $caption_font = get_field('caption_font');
  $caption_color = get_field('caption_color');
  $imagesArray = get_field('gallery_images');

?>

<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="grid-gallery<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">
  <div class="grid-gallery-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?>">

  <ul class="gallery-list<?php if($gallery_class) { echo ' '.$gallery_class; } ?> <?php echo $grid_columns; ?>"<?php if($grid_gap) { echo ' style="gap:'. $grid_gap. '"'; } ?>>

  <?php foreach($imagesArray as $image) { ?>
    <?php $vidurl = get_field('video_url', $image['ID'])?>
    <?php if ($vidurl): ?>
      <li class="animate-fadein with-icon">
        <a data-fancybox="gallery" data-type="iframe" class="fancybox" href="<?php echo $vidurl; ?>" rel="group" data-caption="<?php echo $image['caption'];?>">
          <div class="bgimg responsive-background-image" <?php $bg_position = get_field('bg_position', $image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>><?php acf_responsive_image($image) ?></div>
          <?php if(strpos($vidurl, 'youtube') !== false || strpos($vidurl, 'vimeo') !== false): ?>
            <div class="video-icon"><i class="far fa-play-circle"></i></div>
          <?php else: ?>
            <div class="vr-icon"><i class="fak fa-vr-360"></i></div>
          <?php endif; ?>
          <?php if($image['caption']) { ?>
          <div class="overlay bg<?php echo $overlay_color; ?>"></div>
          <div class="caption t<?php echo $caption_color; ?> font-<?php echo $caption_font; ?>"><?php echo $image['caption']; ?></div>
          <?php } ?>
        </a>
      </li>

    <?php else: ?>
    <li class="animate-fadein">
      <a data-fancybox="gallery" class="is-image fancybox" href="<?php echo $image['url']; ?>" rel="group" data-caption="<?php echo $image['caption'];?>">
        <div class="bgimg responsive-background-image" <?php $bg_position = get_field('bg_position', $image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>><?php acf_responsive_image($image) ?></div>
        <?php if($image['caption']) { ?>
        <div class="overlay bg<?php echo $overlay_color; ?>"></div>
        <div class="caption t<?php echo $caption_color; ?> font-<?php echo $caption_font; ?>"><?php echo $image['caption']; ?></div>
        <?php } ?>
      </a>
    </li>
    <?php endif;?>
  <?php } ?>

  </ul>

  </div>
</section>