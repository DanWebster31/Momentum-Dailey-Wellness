<?php
 if(is_home()) {$postspage = true; }
// Force every page to have Top Slides
function pages_guten_template() {
  $post_type_object = get_post_type_object( 'page' );
  $post_type_object->template = array(
      array( 'acf/top-slides' ),
  );
}
add_action( 'init', 'pages_guten_template' );


// Register Custom Block Category
add_filter( 'block_categories_all', 'custom_block_category', 10, 2);
function custom_block_category( $categories, $post ) {
	
	array_unshift( $categories, array(
		'slug'	=> 'p11',
		'title' => 'P11'
	) );

	return $categories;
}

// Show These Blocks Only
add_filter( 'allowed_block_types_all', 'p11_allowed_block_types', 25, 2 );
function p11_allowed_block_types( $allowed_blocks, $block_editor_context ) {
  global $postspage;
  global $post;
  /* POSTS */
  if ( isset( $post ) && 'post' === $post->post_type ) {
    return array(
    // 'acf/text-section',
    // 'acf/content-grid',
    'acf/gallery',
    'acf/link',
    // 'acf/form',
    // 'acf/html-section',
    'acf/accordian-section',
    // DEFAULTS
    'core/group',
    'core/shortcode',
    'core/image',
    // 'core/gallery',
    'core/heading',
    'core/quote',
    // 'core/embed',
    'core/list',
    'core/separator',
    'core/spacer',
    // 'core/more',
    'core/button',
    'core/pullquote',
    'core/table',
    'core/preformatted',
    // 'core/code',
    'core/html',
    'core/freeform',
    // 'core/latest-posts',
    // 'core/categories',
    // 'core/cover',
    'core/text-columns',
    // 'core/verse',
    // 'core/video',
    // 'core/audio',
    'core/block',
    'core/paragraph',
	);
  /* POSTS PAGE */
  } else if (!empty($block_editor_context->post) && $block_editor_context->post->ID === (int) get_option('page_for_posts')) {
    return array(
      'acf/top-slides',
      'acf/text-section',
      'acf/feature-section',
      'acf/content-grid',
      'acf/gallery',
      'acf/link',
      'acf/news-page',
      // 'acf/form',
      'acf/html-section',
      'acf/accordian-section',
      // DEFAULTS
      'core/shortcode',
      'core/paragraph',
      'core/freeform',
      'acf/content-map-grid',
    );
  /* PAGES */
  } else   if ( isset( $post ) && 'page' === $post->post_type ) {
      return array(
        'acf/import-block',
        'acf/top-slides',
        //'acf/sub-navigation',
        'acf/text-section',
        'acf/feature-section',
        'acf/content-grid',
        'acf/gallery',
        'acf/link',
        'acf/image-section',
        // 'acf/news-page',
        // 'acf/form',
        'acf/html-section',
        'acf/accordian-section',
        // 'acf/news-content',
        // DEFAULTS
        'core/shortcode',
        'core/paragraph',
        'core/freeform',
        'acf/content-map-grid',
      );
  }
  
}

// TOP SLIDES
acf_register_block(array(
  'name'				=> 'top-slides',
  'title'				=> __('Top Slides'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-top-slides.php',
  'category'			=> 'p11',
  'icon'				=> '<svg enable-background="new 0 0 352.3 215.3" version="1.1" viewBox="0 0 352.3 215.3" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
  <path d="m176.1 215.3h-125.9c-10.5 0-12.8-2.4-12.8-13v-189.4c-0.1-9.9 2.8-12.9 12.6-12.9h252.4c9.4 0 12.7 3.2 12.7 12.5v190.4c0 9.5-2.9 12.3-12.6 12.3-42.1 0.1-84.3 0.1-126.4 0.1zm120.7-18.3v-178.7h-241.2v178.7h241.2zm55.5-165.5c0-6.1-3.5-10.1-8.6-10.2-5.2-0.1-9.1 4.2-9.3 10.3v2.5 147.4c0 2.3 0.1 4.7 0.7 6.9 1.6 5.1 7.5 7.5 12.2 5.2 4.1-2.1 5-5.7 5-10.1-0.1-25.1 0-50.3 0-75.4v-76.6zm-352.3 152.4c0 6.8 3.1 10.3 8.8 10.3 5.6 0 8.9-3.6 8.9-10.3v-152.4c0-1.9-0.4-4.1-1.3-5.7-2.1-3.6-5.5-5.3-9.8-4.1-4.6 1.3-6.6 4.6-6.6 9.3v76.4 76.5zm82.7-145.4v138.6h189v-138.6h-189zm50.4 25.2c7 0 12.6 5.6 12.6 12.6s-5.6 12.6-12.6 12.6-12.6-5.6-12.6-12.6c0-6.9 5.7-12.6 12.6-12.6zm107.1 76.2v12.5h-125.8v-16.1l2.4-2.7 25.2-28.3 7-8 7 8 6.8 7.6 22.6-32 7.6-10.9 7.7 10.9 37.8 53.6 1.7 2.4v3z"/>
  </svg>
  ',
  'keywords'			=> array( 'top,slides' ),
  'mode'	=> 'edit',
  'supports' => array('mode'=>false,'align'=>false,'multiple'=>false,'customClassName'=>false),
  'template' => array(
    'lock' => array(
              'move'   => true,
              'remove' => true,
        ),
      ),
      'post_types'        => array( 'page' ),
  // 'enqueue_assets'	=> function(){
  // },
));

// IMPORT BLOCK
acf_register_block(array(
  'name'				=> 'import-block',
  'title'				=> __('Import Block'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-import-block.php',
  'category'			=> 'p11',
  'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Pro 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M272 368l0 16-32 0 0-16 0-305.4L139.3 163.3 128 174.6 105.4 152l11.3-11.3 128-128L256 1.4l11.3 11.3 128 128L406.6 152 384 174.6l-11.3-11.3L272 62.6 272 368zm-64-16L32 352l0 128 448 0 0-128-176 0 0-32 176 0 32 0 0 32 0 128 0 32-32 0L32 512 0 512l0-32L0 352l0-32 32 0 176 0 0 32zm176 64a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg>',
  'keywords'			=> array( 'import,block' ),
  'post_types' => array('page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' => false,'customClassName'=>false,'spacing' => true),
  // 'enqueue_assets'	=> function(){
  // },
));

// LINK
acf_register_block(array(
  'name'				=> 'link',
  'title'				=> __('Link(s)'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-link.php',
  'category'			=> 'p11',
  'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Pro 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M580.3 267.2c56.2-56.2 56.2-147.3 0-203.5C526.8 10.2 440.9 7.3 383.9 57.2l-6.1 5.4c-10 8.7-11 23.9-2.3 33.9s23.9 11 33.9 2.3l6.1-5.4c38-33.2 95.2-31.3 130.9 4.4c37.4 37.4 37.4 98.1 0 135.6L433.1 346.6c-37.4 37.4-98.2 37.4-135.6 0c-35.7-35.7-37.6-92.9-4.4-130.9l4.7-5.4c8.7-10 7.7-25.1-2.3-33.9s-25.1-7.7-33.9 2.3l-4.7 5.4c-49.8 57-46.9 142.9 6.6 196.4c56.2 56.2 147.3 56.2 203.5 0L580.3 267.2zM59.7 244.8C3.5 301 3.5 392.1 59.7 448.2c53.6 53.6 139.5 56.4 196.5 6.5l6.1-5.4c10-8.7 11-23.9 2.3-33.9s-23.9-11-33.9-2.3l-6.1 5.4c-38 33.2-95.2 31.3-130.9-4.4c-37.4-37.4-37.4-98.1 0-135.6L207 165.4c37.4-37.4 98.1-37.4 135.6 0c35.7 35.7 37.6 92.9 4.4 130.9l-5.4 6.1c-8.7 10-7.7 25.1 2.3 33.9s25.1 7.7 33.9-2.3l5.4-6.1c49.9-57 47-142.9-6.5-196.5c-56.2-56.2-147.3-56.2-203.5 0L59.7 244.8z"/></svg>',
  'keywords'			=> array( 'link,button' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' => false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// TEXT SECTION
acf_register_block(array(
  'name'				=> 'text-section',
  'title'				=> __('Text Section'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-text-section.php',
  'category'			=> 'p11',
  'icon'				=> 'text',
  'keywords'			=> array( 'text,section' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' => false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// FEATURE SECTION
acf_register_block(array(
  'name'				=> 'feature-section',
  'title'				=> __('Feature Section'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-feature-section.php',
  'category'			=> 'p11',
  'icon'				=> '<svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 15H21M3 19H13M21 7H13M21 11H13M4.6 11H7.4C7.96005 11 8.24008 11 8.45399 10.891C8.64215 10.7951 8.79513 10.6422 8.89101 10.454C9 10.2401 9 9.96005 9 9.4V6.6C9 6.03995 9 5.75992 8.89101 5.54601C8.79513 5.35785 8.64215 5.20487 8.45399 5.10899C8.24008 5 7.96005 5 7.4 5H4.6C4.03995 5 3.75992 5 3.54601 5.10899C3.35785 5.20487 3.20487 5.35785 3.10899 5.54601C3 5.75992 3 6.03995 3 6.6V9.4C3 9.96005 3 10.2401 3.10899 10.454C3.20487 10.6422 3.35785 10.7951 3.54601 10.891C3.75992 11 4.03995 11 4.6 11Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
  'keywords'			=> array( 'feature,section' ),
  'post_types' => array('page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' =>false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// CONTENT GRID
acf_register_block(array(
  'name'				=> 'content-grid',
  'title'				=> __('Content Grid'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-content-grid.php',
  'category'			=> 'p11',
  'icon'				=> 'grid-view',
  'keywords'			=> array( 'content,grid' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' =>false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// LINK
acf_register_block(array(
  'name'				=> 'image-section',
  'title'				=> __('Image'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-image-section.php',
  'category'			=> 'p11',
  'icon'				=> 'format-image',
  'keywords'			=> array( 'image' ),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' => false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// HTML SECTION
acf_register_block(array(
  'name'				=> 'html-section',
  'title'				=> __('HTML'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-html.php',
  'category'			=> 'p11',
  'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M399.1 1.1c-12.7-3.9-26.1 3.1-30 15.8l-144 464c-3.9 12.7 3.1 26.1 15.8 30s26.1-3.1 30-15.8l144-464c3.9-12.7-3.1-26.1-15.8-30zm71.4 118.5c-9.1 9.7-8.6 24.9 1.1 33.9L580.9 256 471.6 358.5c-9.7 9.1-10.2 24.3-1.1 33.9s24.3 10.2 33.9 1.1l128-120c4.8-4.5 7.6-10.9 7.6-17.5s-2.7-13-7.6-17.5l-128-120c-9.7-9.1-24.9-8.6-33.9 1.1zm-301 0c-9.1-9.7-24.3-10.2-33.9-1.1l-128 120C2.7 243 0 249.4 0 256s2.7 13 7.6 17.5l128 120c9.7 9.1 24.9 8.6 33.9-1.1s8.6-24.9-1.1-33.9L59.1 256 168.4 153.5c9.7-9.1 10.2-24.3 1.1-33.9z"/></svg>',
  'keywords'			=> array( 'form,interest,list' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' =>false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// GALLERY
acf_register_block(array(
  'name'				=> 'gallery',
  'title'				=> __('Gallery'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-gallery.php',
  'category'			=> 'p11',
  'icon'				=> 'images-alt',
  'keywords'			=> array( 'gallery,images,carousel' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' =>false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// ACCORDIAN
acf_register_block(array(
  'name'				=> 'accordian-section',
  'title'				=> __('Accordian Section'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-accordian-section.php',
  'category'			=> 'p11',
  'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M480 192L32 192 32 64l448 0V192zm32 32V192 64 32H480 32 0V64 192v32H32l448 0h32zm0 240V304 288H496L16 288H0v16V464v16H16l480 0h16V464zM32 448l0-128 448 0V448L32 448z"/></svg>',
  'keywords'			=> array( 'accordian,section' ),
  'post_types' => array('post', 'page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' =>false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

// NEWS
acf_register_block(array(
  'name'				=> 'news-page',
  'title'				=> __('News'),
  'description'		=> __(''),
  'render_template'	=> 'template-parts/blocks/block-news.php',
  //'render_callback'   => 'acf_block_multisite_posts_render_callback',
  'category'			=> 'p11',
  'icon'				=> '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Pro 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc.--><path d="M160 64c-17.7 0-32 14.3-32 32l0 320c0 11.7-3.1 22.6-8.6 32L432 448c26.5 0 48-21.5 48-48l0-304c0-17.7-14.3-32-32-32L160 64zM64 480c-35.3 0-64-28.7-64-64L0 160c0-35.3 28.7-64 64-64l0 32c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32L96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 304c0 44.2-35.8 80-80 80L64 480zM384 112c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16zM160 304c0-8.8 7.2-16 16-16l256 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-256 0c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16l256 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-256 0c-8.8 0-16-7.2-16-16zm32-144l128 0 0-96-128 0 0 96zM160 120c0-13.3 10.7-24 24-24l144 0c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24l0-112z"/></svg>',
  'keywords'			=> array( 'news,posts' ),
  'post_types' => array('page'),
  'mode'	=> 'edit',
  'supports' => array('mode' => false,'align' => false,'customClassName'=>false),
  // 'enqueue_assets'	=> function(){
  // },
));

?>