<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_background_color = get_field('section_background_color');
  $show_bottom_divider = get_field('show_bottom_divider');
	/* IMAGE */
  $image = get_field('image');
  $image_class = get_field('image_class');
  $image_display = get_field('image_display');
  $image_fixed = get_field('image_fixed');
  $image_width = get_field('image_width');
  $image_min_width = get_field('image_min_width');
  $image_max_width = get_field('image_max_width');
  $image_height = get_field('image_height');
  $image_min_height = get_field('image_min_height');
  $image_max_height = get_field('image_max_height');
?>

<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="image-section<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background_color) { echo ' bg'.$section_background_color; } ?>">
  <div class="image-section-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>">

  <div class="image-section-image<?php if($image_class) { echo ' '.$image_class; } ?><?php if($image_display == 'cover') { echo ' cover responsive-background-image'; } ?><?php if($image_display == 'contain') { echo ' cover responsive-background-image'; } ?><?php if($image_display != 'inline' && $image_fixed) { echo ' fixedbg'; } ?>" style="margin-left:auto; margin-right:auto;<?php if($image_width) { echo ' width:'.$image_width.';'; } ?><?php if($image_min_width) { echo ' min-width:'.$image_min_width.';'; } ?><?php if($image_max_width) { echo ' max-width:'.$image_max_width.';'; } ?><?php if($image_height) { echo ' height:'.$image_height.';'; } ?><?php if($image_min_height) { echo ' min-height:'.$image_min_height.';'; } ?><?php if($image_max_height) { echo ' max-height:'.$image_max_height.';'; } ?><?php $bg_position = get_field('bg_position', $image['ID']); if($bg_position): echo ' background-position:'.$bg_position.' center'; endif; ?>">
      <?php acf_responsive_image($image,'','stretch'); ?>
  </div>
  
  </div>
  <?php if($show_bottom_divider) { ?>
<div class="<?php echo $show_bottom_divider; ?> <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' with-gap'; } ?>"></div>
<?php } ?>
</section>