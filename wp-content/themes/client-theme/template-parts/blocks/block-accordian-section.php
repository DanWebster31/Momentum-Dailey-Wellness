<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_layout = get_field('section_layout');
  $column_gap = get_field('column_gap');
  $mobile_column_gap = get_field('mobile_column_gap');
  $section_background = get_field('section_background_color');

?>

<?php 
/* ACCORDIAN */
$accordian_class = get_field('accordion_class');
$accordion_background = get_field('accordion_background_color');
$intro_title = get_field('intro_title');
$intro_title_font = get_field('intro_title_font');
$intro_title_color = get_field('intro_title_color');
$intro_text = get_field('intro_text');
$intro_text_font = get_field('intro_text_font');
$intro_text_color = get_field('intro_text_color');
$item_title_font = get_field('item_title_font');
$item_title_color = get_field('item_title_color');
$item_text_font = get_field('item_text_font');
$item_text_color = get_field('item_text_color');
$item_close_color = get_field('item_close_color');
$item_bg_color = get_field('item_bg_color');
$item_bg_opacity = get_field('item_bg_opacity');
$sub_item_bg_color = get_field('sub_item_bg_color');
$sub_item_bg_opacity = get_field('sub_item_bg_opacity');
?>


<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="accordian-section<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">
<div class="accordion-container clearfix<?php if($accordian_class) { echo ' '.$accordian_class; } ?> <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?>">

<?php if($intro_title || $intro_text) { ?>
  <div class="accordian-intro">
    <?php if($intro_title) { ?><h2 class="section-title tcenter<?php if($intro_text) { ?> mb-1<?php } ?> t<?php echo $intro_title_color; ?> font-<?php echo $intro_title_font; ?>"><?php echo $intro_title; ?></h2><?php } ?>
    <?php if($intro_text) { ?><div class="default-content tcenter t<?php echo $intro_text_color; ?> font-<?php echo $intro_text_font; ?>"><?php echo $intro_text;?></div><?php } ?>
  </div>
  <?php } ?>
    <?php // check for rows (parent repeater)
    if( have_rows('accordian_items') ): 
    // loop through rows (parent repeater)
    while( have_rows('accordian_items') ): the_row(); ?>

      <?php 
      $accordiantext = get_sub_field('item_text');
      $subaccordian = get_sub_field('sub_accordian_items'); 
      ?>

      <a href="javascript:void(0);" class="accordion-toggle t<?php echo $item_title_color; ?> font-<?php echo $item_title_font; ?>"><?php the_sub_field('item_title'); ?><span class="toggle-icon t<?php echo $item_close_color; ?>"><i class="fa-light fa-chevron-down"></i></span><div class="bgcolor fill bg<?php echo $item_bg_color; ?>" style="opacity:<?php echo $item_bg_opacity; ?>"></div></a>
      <div class="accordion-content default-content<?php if($accordiantext) { echo ' has-text'; } ?><?php if($subaccordian && count($subaccordian) > 1 ) { echo ' has-sub'; } ?> clearfix t<?php echo $item_text_color; ?> font-<?php echo $item_text_font; ?>">
      <?php if($accordiantext) { echo $accordiantext; } ?>



      <?php // check for rows (parent repeater)
    if( have_rows('sub_accordian_items') ): ?>
    <div class="accordionsub-container<?php if($accordiantext) { echo ' text-above'; } ?>">

    <?php while( have_rows('sub_accordian_items') ): the_row(); ?>

      <a href="javascript:void(0);" class="accordionsub-toggle t<?php echo $item_title_color; ?> font-<?php echo $item_title_font; ?>"><?php the_sub_field('sub_item_title'); ?><span class="toggle-icon t<?php echo $item_close_color; ?>"><i class="fa-light fa-chevron-down"></i></span><div class="bgcolor fill bg<?php echo $sub_item_bg_color; ?>" style="opacity:<?php echo $sub_item_bg_opacity; ?>"></div></a>
      <div class="accordionsub-content default-content clearfix t<?php echo $item_text_color; ?> font-<?php echo $item_text_font; ?>">
      <?php the_sub_field('sub_item_text'); ?>

      </div>

    <?php endwhile;  ?>
    </div>
    <?php endif; ?>

      </div>

    <?php endwhile;  ?>
    <?php endif; ?>

  </div>   <!--/.accordion-container-->
</section>
