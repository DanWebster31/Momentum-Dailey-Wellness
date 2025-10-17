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
  
  // Get gallery_layout field
  $gallery_layout = get_field('gallery_layout', $block_id);
  
  // If no layout is set, try to get it from block attributes
  if (empty($gallery_layout) && isset($block['attrs']['data']['gallery_layout'])) {
    $gallery_layout = $block['attrs']['data']['gallery_layout'];
  }
  
  // If still no layout, default to carousel
  if (empty($gallery_layout)) {
    $gallery_layout = 'carousel';
  }
  
  if($gallery_layout == 'grid') {
    include('content-gallery-grid.php');
  } else {
    include('content-gallery-carousel.php');
  }
?>