<?php
  // Get block ID for field context
  $block_id = isset($block['id']) ? $block['id'] : '';
  
  // If no block ID is set, try to get it from the block attributes
  if (empty($block_id) && isset($block['attrs']['id'])) {
    $block_id = $block['attrs']['id'];
  }
  
  // If still no block ID, generate a unique one based on the block index
  if (empty($block_id)) {
    global $post;
    if ($post) {
      $blocks = parse_blocks($post->post_content);
      $gallery_blocks = array_filter($blocks, function($b) {
        return $b['blockName'] === 'acf/gallery';
      });
      $current_index = 0;
      foreach ($gallery_blocks as $index => $gallery_block) {
        if ($gallery_block === $block) {
          $current_index = $index;
          break;
        }
      }
      $block_id = 'gallery_block_' . $current_index . '_' . uniqid('', true);
    }
  }
  
  // Generate a more unique ID for this gallery instance
  $unique_id = $block_id ? $block_id : 'gallery_' . uniqid('', true);
  
  /* SECTION */
  $section_id = get_field('section_id', $block_id);
  $section_class = get_field('section_class', $block_id);
  $section_wrapper = get_field('section_wrapper', $block_id);
  $wrapper_inset = get_field('wrapper_inset', $block_id);
  $section_background = get_field('section_background_color', $block_id);
  $show_circles = get_field('show_circles', $block_id);
  
  /* GALLERY */
  $grid_columns = get_field('grid_columns', $block_id);
  $grid_gap = get_field('grid_column_gap', $block_id);
  $gallery_class = get_field('gallery_class', $block_id);
  $gallery_background = get_field('gallery_background_color', $block_id);
  $caption_font = get_field('caption_font', $block_id);
  $caption_color = get_field('caption_color', $block_id);
  
  /* GALLERY INTRO */
  $gallery_intro = get_field('gallery_intro', $block_id);
  $gallery_intro_wrapper = get_field('gallery_intro_wrapper', $block_id);
  $gallery_intro_class = get_field('gallery_intro_class', $block_id);
  
  /* GALLERY TITLE */
  $gallery_title = get_field('gallery_title', $block_id);
  $gallery_title_size = ''; 
  $title_size_field = get_field('gallery_title_size', $block_id);
  if($title_size_field != 'default') { $gallery_title_size = '-'.$title_size_field; }
  $gallery_title_font = get_field('gallery_title_font', $block_id);
  $gallery_title_color = get_field('gallery_title_color', $block_id);
  
  /* GALLERY TEXT */
  $gallery_text = get_field('gallery_text', $block_id);
  $gallery_text_font = get_field('gallery_text_font', $block_id);
  $gallery_text_color = get_field('gallery_text_color', $block_id);
  
  /* SLIDES TO SHOW SETTINGS */
  $slides_to_show_large = get_field('slides_to_show_large', $block_id) ?: 1;
  $slides_to_show_medium = get_field('slides_to_show_medium', $block_id) ?: 1;
  $slides_to_show_small = get_field('slides_to_show_small', $block_id) ?: 1;

    /* SLIDES */
  $slides_height = get_field('slides_height', $block_id);
  $slides_max_height = get_field('slides_max_height', $block_id);
  $slides_bg_type = get_field('slides_bg_type', $block_id) ?: 'cover';
  $slides_gap = get_field('slides_gap', $block_id) ?: '0';
  
  /* CAROUSEL SETTINGS */
  $is_offset = get_field('gallery_offset', $block_id) ?: false;
  $show_arrows = get_field('show_arrows', $block_id) ?: false;
  $autoplay = get_field('autoplay', $block_id) ?: false;
  $autoplay_speed = get_field('autoplay_speed', $block_id) ?: 3000;
  
  /* CAPTIONS */
  $gallery_captions = get_field('gallery_show_captions', $block_id);
  
  /* GALLERY IMAGES */
  $imagesArray = get_field('gallery_images', $block_id);
  
  // If no images from ACF, try to get from block attributes
  if (empty($imagesArray) && isset($block['attrs']['data']['gallery_images'])) {
    $imagesArray = $block['attrs']['data']['gallery_images'];
  }
  
  // If still no images, set to empty array to prevent errors
  if (empty($imagesArray)) {
    $imagesArray = array();
  }
  
?>

<section <?php if($section_id) { echo 'id="'.$section_id.'"'; } ?> class="carousel-gallery<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">
    <?php if($gallery_intro) { ?>
      <div class="gallery-intro<?php if($gallery_intro_class) { echo ' '.$gallery_intro_class; } ?>">
        <div class="gallery-intro-content<?php if($gallery_intro_wrapper) { echo ' '.$gallery_intro_wrapper; } ?>">
        <?php if($show_circles) { ?>
          <div id="<?php if($section_id) { echo $section_id . '-'; } ?>circles" class="four-circles animate-zoom-and-spin">
            <img class="stretch" src="/wp-content/themes/client-theme/images/global/animation-graphic.svg" alt="Circles">
          </div>
        <?php } ?>
        <?php if($gallery_title) { ?><h2 class="section-title<?php echo $gallery_title_size; ?> tcenter<?php if($gallery_text) { ?> marb1<?php } ?> t<?php echo $gallery_title_color; ?> font-<?php echo $gallery_title_font; ?>"><?php echo $gallery_title; ?></h2><?php } ?>
        <?php if($gallery_text) { ?><div class="default-content tcenter t<?php echo $gallery_text_color; ?> font-<?php echo $gallery_text_font; ?>"><?php echo $gallery_text;?></div><?php } ?>
        </div>
      </div>
    <?php } ?>  

<div class="carousel-gallery-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?>">
    <div class="carousel-gallery-slideshow<?php if($is_offset) { echo ' offset'; } ?>" 
         data-slides-large="<?php echo $slides_to_show_large; ?>"
         data-slides-medium="<?php echo $slides_to_show_medium; ?>"
         data-slides-small="<?php echo $slides_to_show_small; ?>"
         data-gap="<?php echo $slides_gap; ?>"
         data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
         data-autoplay-speed="<?php echo $autoplay_speed; ?>">
    <?php 
    if($imagesArray && is_array($imagesArray) && count($imagesArray) > 0) {
      foreach( $imagesArray as $image ): ?>
        <div class="n-slide-holder">
          <div class="n-slide responsive-background-image <?php echo $slides_bg_type; ?>" style="height: <?php echo $slides_height; ?><?php if($slides_max_height): ?>;max-height: <?php echo $slides_max_height; ?><?php endif; ?><?php $desc = $image['description']; if($desc): ?>;background-position: <?php echo $desc ?> center;<?php endif; ?>">
            <?php acf_responsive_image($image); ?>
            <?php if($gallery_captions && $image['caption']) { ?>
            <div class="slide-caption-overlay">
              <div class="slide-caption-content"><?php echo $image['caption']; ?></div>
            </div>
            <?php } ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php } else { ?>
      <div class="n-slide-holder">
        <div class="n-slide">
          <p>No images found for this gallery</p>
        </div>
      </div>
    <?php } ?>
    </div>
    <?php if($show_arrows) { ?>
    <a aria-label="Previous News Posts" href="#" class="slickprev">
      <!-- <div class="overlay bgblack"></div> -->
      <i class="fa-light fa-chevron-left" aria-hidden="true"></i>
    </a>
    <a aria-label="More News Posts" href="#" class="slicknext">
    <!-- <div class="overlay bgblack"></div> -->
    <i class="fa-light fa-chevron-right" aria-hidden="true"></i>
    </a>
    <?php } ?>
    <!-- <div class="slick-dots"></div> -->
  </div>
  

</section>


