<?php
  /* SECTION */
  $element_tag = get_field('element_tag');
  $element_id = get_field('element_id');
  $element_class = get_field('element_class');
  $element_background = get_field('element_background_color');
  $element_background_image = get_field('element_background_image');
  $element_image_effect = get_field('element_image_effect');
  $element_parallax_ratio = get_field('element_parallax_ratio');
  $element_wrapper = get_field('element_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $wrapper_class = get_field('wrapper_class');
  $wrapper_background = get_field('wrapper_background_color');
  $wrapper_background_image = get_field('wrapper_background_image');
  $wrapper_image_effect = get_field('wrapper_image_effect');
  $wrapper_parallax_ratio = get_field('wrapper_parallax_ratio');
  $content = get_field('content');
?>
<?php if($element_tag) { ?>
<<?php echo $element_tag; ?> <?php if($element_id) { echo 'id="'.$element_id.'"'; } ?> class="relative<?php if($element_class) { echo ' '.$element_class; } ?><?php if($element_background) { echo ' bg'.$element_background; } ?>">

<?php if($element_background_image) { ?>
    <div class="bg-image <?php //if($element_image_effect == 'parallax') { echo 'parallax-rev '; } ?>fill"<?php //if($element_image_effect == 'parallax' && $element_parallax_ratio) { echo ' data-parallax-ratio="'.$element_parallax_ratio.'"'; } ?>>
      <div class="fill cover responsive-background-image<?php if($element_image_effect == 'fixedbg') { echo ' fixedbg'; } ?>" <?php $bg_position = get_field('bg_position', $element_background_image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
        <?php acf_responsive_image($element_background_image); ?>
      </div>
    </div>
  <?php } ?>

  <?php if($element_wrapper) { ?>
  <div class="<?php echo $element_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?><?php if($wrapper_class) { echo ' '.$wrapper_class; } ?><?php if($wrapper_background) { echo ' bg'.$wrapper_background; } ?>">
  
  <?php if($wrapper_background_image) { ?>
    <div class="bg-image <?php //if($wrapper_image_effect == 'parallax') { echo 'parallax-rev '; } ?>fill" <?php //if($wrapper_image_effect == 'parallax' && $wrapper_parallax_ratio) { echo ' data-parallax-ratio="'.$wrapper_parallax_ratio.'"'; } ?>>
    <div class="fill cover responsive-background-image<?php if($wrapper_image_effect == 'fixedbg') { echo ' fixedbg'; } ?>" <?php $bg_position = get_field('bg_position', $wrapper_background_image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
      <?php acf_responsive_image($wrapper_background_image); ?>
    </div>
    </div>
    <div class="default-content relative"> <?php // keeps image below content ?>
  <?php } ?>

  <?php } ?>

  <?php } ?>

  <?php if($content) { echo $content; } ?>

  <?php if($element_tag) { ?>
    <?php if($wrapper_background_image) { ?></div><?php } // keeps image below content ?>
    <?php if($element_wrapper) { ?>
    </div>
    <?php } ?>
  </<?php echo $element_tag; ?>>
  <?php } ?>