<?php
/**
 * @package client-theme
 */

  /*********** ACF BLOCKS ***********/

function register_acf_block_types() {
  require_once WP_CONTENT_DIR . '/themes/client-theme/includes/acf/blocks.php';
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
  add_action('acf/init', 'register_acf_block_types');
}


// Removed Advanced tab for Blocks
// add_filter( 'block_type_metadata', 'remove_the_class_anchor' );
// function remove_the_class_anchor($metadata ) {
//     $metadata['supports']['customClassName'] = false;
//     $metadata['supports']['anchor'] = false;
//     return $metadata;
// }

function extract_block_type_from_page( $post_id, $block_name ) {

  //get post_content for page
  $post = get_post( $post_id );
  
  // Check if post exists and has content
  if ( !$post || empty( $post->post_content ) ) {
    return '';
  }
  
  $post_content = $post->post_content;

  //get all blocks of requested type
  $blocks = array_filter( parse_blocks( $post_content ), function( $block ) use( $block_name ) {
      return $block_name === $block['blockName'];
  });

  $block_content = '';
  foreach( $blocks as $block ) {
      $block_content .= render_block( $block );
  }

  return $block_content;
}


/*********** LOAD STYLES AND SCRIPTS ***********/

function load_styles_scripts() {

  $cdnURL = 'https://i-marketingtools.com/cdn';

  //GLOBAL STYLES
  $rannum = time();
  wp_enqueue_style('screen', get_template_directory_uri() . '/includes/css/screen.css', array(), $rannum, false);
  wp_enqueue_style('fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox.css', array(), null, false);

  //GLOBAL SCRIPTS
  if (is_page('contact-us')) {
    wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', array(), '2.2.2', false);
    wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . get_field('google_api_key', 'options'), array(), null, false);
    wp_enqueue_script('form-functions', get_template_directory_uri() . '/includes/js/form-functions.js', array('jQuery'), null, true);
    wp_enqueue_script('interest-list', get_template_directory_uri() . '/includes/js/interest-list.js', array('jQuery'), null, true);
    wp_enqueue_script('recaptcha', '//www.google.com/recaptcha/api.js?onload=onRecaptchaApiLoaded&render=explicit', array('jQuery'), null, true);
  } else {
    wp_enqueue_script('jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', array(), '2.2.2', true);
  }
  wp_enqueue_script('green-sock', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', array('jQuery'), null, true);
  wp_enqueue_script('cycle', get_template_directory_uri() . '/includes/js/contrib/cycle2.js', array('jQuery'), '2.1.3', true);
  wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/c30e018d26.js', array(), null, true);
  wp_enqueue_script('global', get_template_directory_uri() . '/includes/js/global.js', array('jQuery', 'cycle'), null, true);
  wp_enqueue_script('fancybox', get_template_directory_uri() . '/includes/fancybox/jquery.fancybox.js', array(), null, true);
  // wp_enqueue_script('acf', get_template_directory_uri() . '/includes/acf/acf-hidden/js/input.js', array(), null, true);
  wp_enqueue_script('privacy', get_template_directory_uri() . '/includes/js/privacy-alert.js', array('jQuery'), null, true);
  // wp_enqueue_script('recaptcha', '//www.google.com/recaptcha/api.js', array('jQuery'), null, true);
  // wp_enqueue_script('interest', get_template_directory_uri() . '/includes/js/interest-list.js', array('jQuery'), null, true);
  

  // BLOCK STYLES & SCRIPTS
  $id = get_the_ID();

  // Block asset configuration
  $block_assets = array(
    'acf/link' => array(
      'styles' => array('text-section' => 'content-text-section.css'),
    ),
    'acf/text-section' => array(
      'styles' => array(
        'text-section' => 'content-text-section.css'
      ),
    ),
    'acf/feature-section' => array(
      'styles' => array('feature-section' => 'content-feature-section.css'),
    ),
    'acf/content-grid' => array(
      'styles' => array(
        'content-grid' => 'content-grid.css'
      ),
    ),
    'acf/icon-list' => array(
      'styles' => array('icon-list' => 'content-icon-list.css'),
    ),
    'acf/form' => array(
      'styles' => array('form' => 'content-form.css'),
      'scripts' => array('form' => 'form.js'),
    ),
    'acf/gallery' => array(
      'styles' => array(
        'gallery' => 'content-gallery.css',
        'gallery-carousel' => 'slick/slick.css',
        'gallery-carousel-theme' => 'slick/slick-theme.css'
      ),
      'scripts' => array(
        'slick' => 'slick/slick.min.js',
        'gallery' => 'gallery.js'
      ),
    ),
    'acf/accordian-section' => array(
      'styles' => array('content-accordian' => 'content-accordian.css'),
      'scripts' => array('accordian' => 'accordian.js'),
    ),
    'acf/news-page' => array(
      'styles' => array('content-news' => 'content-news.css'),
      'scripts' => array('news' => 'news.js'),
    ),
    'acf/content-map-grid' => array(
      'styles' => array(
        'content-map-grid' => 'content-map-grid.css'
      ),
      /* 'external-scripts' => array(
        'gmap-api' => 'https://maps.googleapis.com/maps/api/js?key=' . get_field('google_api_key', 'options')
      ), */
    ),
    
  );

  // Enqueue block assets
  foreach ($block_assets as $block_name => $assets) {
    if (has_block($block_name, $id)) {
      // Enqueue styles
      if (isset($assets['styles'])) {
        foreach ($assets['styles'] as $handle => $file) {
          // Special handling for Slick files which are in /includes/slick/
          if (strpos($file, 'slick/') === 0) {
            wp_enqueue_style($handle, get_template_directory_uri() . '/includes/' . $file, array(), null, false);
          } else {
            wp_enqueue_style($handle, get_template_directory_uri() . '/includes/css/' . $file, array(), null, false);
          }
        }
      }
      
      // Enqueue scripts
      if (isset($assets['scripts'])) {
        foreach ($assets['scripts'] as $handle => $file) {
          // Special handling for Slick files which are in /includes/slick/
          if (strpos($file, 'slick/') === 0) {
            wp_enqueue_script($handle, get_template_directory_uri() . '/includes/' . $file, array('jQuery'), null, true);
          } else {
            wp_enqueue_script($handle, get_template_directory_uri() . '/includes/js/' . $file, array('jQuery'), null, true);
          }
        }
      }

      if (isset($assets['external-scripts'])) {
        foreach ($assets['external-scripts'] as $handle => $file) {
          wp_enqueue_script($handle, $file, array('jQuery'), null, true);
        }
      }
    }
  }

  // Special handling for news page (home/single posts)
  if (has_block('acf/news-page', $id) || is_home() || (is_single() && is_singular('post'))) {
    wp_enqueue_style('content-news', get_template_directory_uri() . '/includes/css/content-news.css', array(), null, false);  
    wp_enqueue_script('news', get_template_directory_uri() . '/includes/js/news.js', array('jQuery'), null, true);
  }
}
add_action('wp_enqueue_scripts', 'load_styles_scripts');


///IMPORT BLOCK
function render_specific_acf_block_by_field($target_page_id, $field_name, $field_value) {
  // Get the post content for the specified page ID
  $post_content = get_post_field('post_content', $target_page_id);
  
  // Check if post content exists
  if (empty($post_content)) {
    return;
  }
  
  // Parse the blocks in the post content
  $blocks = parse_blocks($post_content);

  // Loop through each block and check for the matching ACF field content
  foreach ($blocks as $block) {
      // Check if the block has attributes and data
      if (isset($block['attrs']['data']) && is_array($block['attrs']['data'])) {
          // Check if the specific ACF field matches the provided field value
          if (isset($block['attrs']['data'][$field_name]) && $block['attrs']['data'][$field_name] === $field_value) {
              // Render and echo the matching block
              echo render_block($block);
              return; // Stop after finding the first match
          }
      }
  }
}


add_action('wp_enqueue_scripts', 'load_styles_scripts');

// Async load JS
function p11creative_async_scripts($url)
{
  if (strpos($url, '#asyncload') === false)
    return $url;
  else if (is_admin())
    return str_replace('#asyncload', '', $url);
  else
    return str_replace('#asyncload', '', $url) . "' async='async";
}
add_filter('clean_url', 'p11creative_async_scripts', 11, 1);


// ACF Responsive SRC SET
function acf_responsive_image($image, $alt='', $class = '', $size='full') {

	if (!empty($image)) {
		if (!$alt) {
			$alt = $image['alt'];
		}

		$url = $image['url'];

		if ($size) {
			if (isset($image['sizes'][$size])) {
				$url = $image['sizes'][$size];
			}
		}

		if (function_exists('wp_get_attachment_image_srcset')) {
			$img = '<img class="responsive-image-placement" src="'. $url . '" srcset="' . wp_get_attachment_image_srcset( $image['id'], $size ) . '" alt="' . $alt . '"';
		} else {
			$img = '<img class="responsive-image-placement" src="'. $url . '" alt="' . $alt . '"';
		}

		if ($class) {
			$img .= ' class="' . $class . '"';
		}
		$img .= ' />';

		echo $img;
	}
}

/*********** CUSTOM LOGIN/ADMIN COLORS & LOGO ***********/

function custom_login_scripts()
{
  wp_enqueue_style('custom-login', get_template_directory_uri() . '/includes/css/admin.css');
  
  $thelogo = get_field('logo', 'options');
  
  // Get the logo URL - handle both array and string formats
  $logo_url = '';
  if (is_array($thelogo) && isset($thelogo['url'])) {
    $logo_url = $thelogo['url'];
  } elseif (is_string($thelogo)) {
    $logo_url = $thelogo;
  }
  
  if ($logo_url) {
    echo '<style type="text/css">
    h1 a { background-image:url(' . $logo_url . ') !important;
      background-size:100% !important;
      width: 250px !important;
      height: 50px !important;
      pointer-events: none;
      cursor: default;
    }
    </style>';
  }
}
add_action('login_enqueue_scripts', 'custom_login_scripts');

/*********** ENQUEUE ADMIN CSS ***********/

function custom_admin_scripts()
{
  wp_enqueue_style('custom-admin', get_template_directory_uri() . '/includes/css/admin.css');
}
add_action('admin_enqueue_scripts', 'custom_admin_scripts');

/*********** Custom Logo on Dashboard ***********/

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets()
{
  global $wp_meta_boxes;

  wp_add_dashboard_widget('custom_p11_widget', 'p11creative', 'custom_dashboard_p11');
}

function custom_dashboard_p11()
{
  $thelogo = get_field('logo', 'options');
  
  // Get the logo URL - handle both array and string formats
  $logo_url = '';
  if (is_array($thelogo) && isset($thelogo['url'])) {
    $logo_url = $thelogo['url'];
  } elseif (is_string($thelogo)) {
    $logo_url = $thelogo;
  }
  
  if ($logo_url) {
    echo '<div style="text-align:center; padding: 2em;"><img style="width: 60%; height: auto; margin: 0 auto;" src="' . $logo_url . '" /></div>';
  }
 // echo '<p style="text-align:center;">Custom Theme by <a href="http://www.p11.com" target="_blank">p11</a></p>';
}

// Add Favicon to the Admin Area
function add_favicon() {
  	$favicon_url = get_field('favicon', 'options');
	echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
  echo '<link rel="icon" type="image/x-icon" href="' . $favicon_url . '" />';
}

// Now, just make sure that function runs when you're on the login page and admin pages
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');

// Get Featured Image Alt Value
function get_the_post_thumbnail_alt($post_id)
{
  return get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
}

/*********** REMOVE WORDPRESS LOGO ***********/

function annointed_admin_bar_remove()
{
  global $wp_admin_bar;

  /* Remove their stuff */
  $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

/*********** ADD CUSTOM ADMIN COLORS ***********/
function additional_admin_color_schemes()
{
  //Get the theme directory
  $theme_dir = get_template_directory_uri();

  //Custom Colors
  wp_admin_css_color(
    'custom',
    __('Custom'),
    $theme_dir . '/includes/css/admin.css',
    array('#000000', '#444444', '#666666', '#FFFFFF')
  );
}
add_action('admin_init', 'additional_admin_color_schemes');

/*********** SET DEFAULT ADMIN COLORS ***********/

function set_default_admin_color($user_id)
{
  $args = array(
    'ID' => $user_id,
    'admin_color' => 'custom'
  );
  wp_update_user($args);
}
add_action('user_register', 'set_default_admin_color');

/*********** DISABLE THEME EDITOR ***********/

define('DISALLOW_FILE_EDIT', true);

/*********** THEME OPTIONS ***********/

if (function_exists('add_theme_support')) {

  add_theme_support( 'post-thumbnails' );

  add_theme_support('menus');

  add_theme_support( 'title-tag' );

  register_nav_menus(array(
    'primary' => esc_html__('Primary Menu', 'client-theme')
  ));
}

/*********** DISPLAY SUB MENU FROM WP MENU ***********/

add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
  if ( isset( $args->sub_menu ) ) {
    if ( isset( $args->root_id ) ) {
      // force a specific sub-menu to display
      $root_id = $args->root_id;
    }
    else {
      $root_id = 0;
      
      // find the current menu item
      foreach ( $sorted_menu_items as $menu_item ) {
        if ( $menu_item->current ) {
          // set the root id based on whether the current menu item has a parent or not
          $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
          break;
        }
      }
      
      // find the top level parent
      if ( ! isset( $args->direct_parent ) ) {
        $prev_root_id = $root_id;
        while ( $prev_root_id != 0 ) {
          foreach ( $sorted_menu_items as $menu_item ) {
            if ( $menu_item->ID == $prev_root_id ) {
              $prev_root_id = $menu_item->menu_item_parent;
              // don't set the root_id to 0 if we've reached the top of the menu
              if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
              break;
            } 
          }
        }
      }
    }

    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }
    
    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

/*********** Deletes all CSS classes and id's, except for those listed in the array below ***********/
function custom_wp_nav_menu($var)
{
  return is_array($var) ? array_intersect(
    $var,
    array(
      //List of allowed menu classes
      'current_page_item',
      'current_page_parent',
      'current_page_ancestor',
      'current-page-ancestor',
      'first',
      'last',
      'vertical',
      'horizontal',
      'news'
    )
  ) : '';
}
add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
add_filter('page_css_class', 'custom_wp_nav_menu');
//Replaces "current-menu-item" with "active"
function current_to_active($text)
{
  $replace = array(
    //List of menu item classes that should be changed to "active"
    'current_page_item' => 'active',
    'current_page_parent' => 'activeparent',
    'current_page_ancestor' => 'activeparent',
    'current-page-ancestor' => 'activeparent',
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
add_filter('wp_nav_menu', 'current_to_active');
//Deletes empty classes and removes the sub menu class
function strip_empty_classes($menu)
{
  $menu = preg_replace('/ class=""| class="sub-menu"/', '', $menu);
  return $menu;
}
add_filter('wp_nav_menu', 'strip_empty_classes');

/*********** CUSTOM FIELDS OPTIONS ***********/

add_action('acf/init', function() {
  acf_add_options_page(array(
    'page_title' 	=> 'Website Settings',
    'menu_title'	=> 'Website Settings',
    'menu_slug' 	=> 'website-settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false
  ));
});

// Disable Gootz for specific post types
// add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
// function prefix_disable_gutenberg($current_status, $post_type){
//     if ($post_type === 'community') return false;
//     return $current_status;
// }

// Include Post Types
//require_once WP_CONTENT_DIR . '/themes/client-theme/includes/php/neighborhoods-post-type.php';

/* Load More */
//require_once WP_CONTENT_DIR . '/themes/client-theme/includes/php/loadmore.php';

/* Display post thumbnail meta box including description */
add_filter( 'admin_post_thumbnail_html', 'plc_post_thumbnail_add_description', 10, 2 );

function plc_post_thumbnail_add_description( $content, $post_id ){
  $post = get_post( $post_id );
  $post_type = $post->post_type;
  if ( $post_type = "post") {
      $content .= "<p><label for=\"html\">2000px wide</label></p>";
      return $content;
      return $post_id;
  }
}

/*********** TRIM EXCERPT ***********/

function custom_trim_excerpt($text, $length)
{ // Fakes an excerpt if needed
  global $post;

  if ($text == '') {
    $text = get_the_content('');

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    //$text = strip_tags($text);
    $excerpt_length = $length;

    // If $text is longer than $length, add ...
    if (str_word_count($text) > $excerpt_length) {
      $words = explode(' ', $text, $excerpt_length + 1);
      array_pop($words);
      array_push($words, '... <a href="' . get_permalink() . '" class="more">MORE ></a>');
      //array_push($words, '...');
      $text = implode(' ', $words);

      $text = str_replace(' ...', '...', $text);
      $text = str_replace(',...', '...', $text);
    }
  }

  return $text;
}

// Adds in superscript and subscript buttons to the Visual Editor
function my_mce_buttons_2($buttons)
{
  /**
   * Add in a core button that's disabled by default
   */
  $buttons[] = 'superscript';
  $buttons[] = 'subscript';

  return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

/*********** TRIM HTML (with tags) ***********/

/**
 * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 *
 * @return string Trimmed string.
 */
function truncateHtml($text, $length = 325, $ending = '...', $exact = false, $considerHtml = true)
{
  if ($considerHtml) {
    // if the plain text is shorter than the maximum length, return the whole text
    if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
      return $text;
    }
    // splits all html-tags to scanable lines
    preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
    $total_length = strlen($ending);
    $open_tags = array();
    $truncate = '';
    foreach ($lines as $line_matchings) {
      // if there is any html-tag in this line, handle it and add it (uncounted) to the output
      if (!empty($line_matchings[1])) {
        // if it's an "empty element" with or without xhtml-conform closing slash
        if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
          // do nothing
          // if tag is a closing tag
        } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
          // delete tag from $open_tags list
          $pos = array_search($tag_matchings[1], $open_tags);
          if ($pos !== false) {
            unset($open_tags[$pos]);
          }
          // if tag is an opening tag
        } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
          // add tag to the beginning of $open_tags list
          array_unshift($open_tags, strtolower($tag_matchings[1]));
        }
        // add html-tag to $truncate'd text
        $truncate .= $line_matchings[1];
      }
      // calculate the length of the plain text part of the line; handle entities as one character
      $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
      if ($total_length + $content_length > $length) {
        // the number of characters which are left
        $left = $length - $total_length;
        $entities_length = 0;
        // search for html entities
        if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
          // calculate the real length of all entities in the legal range
          foreach ($entities[0] as $entity) {
            if ($entity[1] + 1 - $entities_length <= $left) {
              $left--;
              $entities_length += strlen($entity[0]);
            } else {
              // no more characters left
              break;
            }
          }
        }
        $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
        // maximum lenght is reached, so get off the loop
        break;
      } else {
        $truncate .= $line_matchings[2];
        $total_length += $content_length;
      }
      // if the maximum length is reached, get off the loop
      if ($total_length >= $length) {
        break;
      }
    }
  } else {
    if (strlen($text) <= $length) {
      return $text;
    } else {
      $truncate = substr($text, 0, $length - strlen($ending));
    }
  }
  // if the words shouldn't be cut in the middle...
  if (!$exact) {
    // ...search the last occurance of a space...
    $spacepos = strrpos($truncate, ' ');
    if (isset($spacepos)) {
      // ...and cut the text in this position
      $truncate = substr($truncate, 0, $spacepos);
    }
  }
  // add the defined ending to the text
  $truncate .= $ending;
  if ($considerHtml) {
    // close all unclosed html-tags
    foreach ($open_tags as $tag) {
      $truncate .= '</' . $tag . '>';
    }
  }
  return $truncate;
}

/*********** GET THE SLUG ***********/

function the_slug()
{
  global $post;
  $slug = get_post($post->post_parent)->post_name;
  echo  $slug;
}

/*********** IS CHILD PAGE OF ***********/

function is_child($pageID)
{
  global $post;
  if (is_page() && ($post->post_parent == $pageID)) {
    return true;
  } else {
    return false;
  }
}

/*********** CUSTOM SCRIPT INCLUDE ***********/

function scriptPrint($scripts)
{
  $scriptPath = get_template_directory_uri();
  $scripts = str_replace(' ', '', $scripts);
  $scripts = preg_replace("/\r|\n/", "", $scripts);
  $scriptArray = explode(',', $scripts);
  foreach ($scriptArray as $value) {
    if (strpos($value, "//") !== false) {

      if (strpos($value, ".css") !== false) {
        echo '<link href="' . $value . '" rel="stylesheet" type="text/css" media="all" />' . "\n";
      } else {
        echo '<script src="' . $value . '"></script>' . "\n";
      }
    } else {

      if (strpos($value, ".css") !== false) {
        echo '<link href="' . $scriptPath . '/includes/' . $value . '" rel="stylesheet" type="text/css" media="all" />' . "\n";
      } else {
        echo '<script src="' . $scriptPath . '/includes/' . $value . '"></script>' . "\n";
      }
    }
  }
}

/*********** DISABLE EMOJIS!!! ***********/

function disable_wp_emojicons()
{

  // all actions related to emojis
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');

  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}
add_action('init', 'disable_wp_emojicons');

function disable_emojicons_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

/***********  REMOVE CUSTOMIZE FUNTIONALITY   ***********/

// add_action('admin_head', 'hide_customize');
//
// function hide_customize()
// {
//   echo '<style>
//     .theme-overlay .theme-actions, .hide-if-no-customize {
//       display: none !important;
//     }
//     .single-theme .theme-overlay .theme-about {
//       padding-bottom: 30px !important;
//     }
//     .single-theme .theme-overlay .theme-name span {
//       display: none !important;
//     }
//     </style>';
// }

/***********  REMOVE ADMIN MENU ITEMS   ***********/

function edit_admin_menus()
{
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'edit_admin_menus');

/***********  DISABLE EMBEDS  ***********/

function disable_embeds_init()
{
  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');
  // Turn off oEmbed auto discovery.
  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'disable_embeds_init', 9999);

/*********** ALLOW SVG UPLOADS ***********/

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
  global $wp_version;
  if ($wp_version == '4.7' || ((float)$wp_version < 4.7)) {
    return $data;
  }
  $filetype = wp_check_filetype($filename, $mimes);
  return array('ext' => $filetype['ext'], 'type' => $filetype['type'], 'proper_filename' => $data['proper_filename']);
}, 10, 4);

function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
  echo '<style>.attachment-266×266, .thumbnail img { width: 100% !important; height: auto !important; }</style>';
}
add_action('admin_head', 'fix_svg');


/***********  MAKE LIST ITEMS FROM TEXT AREA  ***********/

function convert_to_list_elements($textarea)
{
  $lines = explode("\n", $textarea);
  if (!empty($lines)) {
    foreach ($lines as $line) {
      echo '<li>' . trim($line) . '</li>';
    }
  }
}

/*********** EXTEND WORDPRESS SEARCH TO INCLUDE CUSTOM FIELDS/ADVANCED CUSTOM FIELD VALUES
 * https://adambalee.com
 * Join posts and postmeta tables http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join */
function cf_search_join($join)
{
  global $wpdb;
  if (is_search()) {
    $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
  }
  return $join;
}
add_filter('posts_join', 'cf_search_join');
/* Modify the search query with posts_where http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where */
function cf_search_where($where)
{
  global $pagenow, $wpdb;
  if (is_search()) {
    $where = preg_replace(
      "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
      "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
      $where
    );
  }
  return $where;
}
add_filter('posts_where', 'cf_search_where');

/* Prevent duplicates http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct */
function cf_search_distinct($where)
{
  global $wpdb;
  if (is_search()) {
    return "DISTINCT";
  }
  return $where;
}
add_filter('posts_distinct', 'cf_search_distinct');

/** Remove the h1 tag from the WordPress editor. */
// function remove_h1_from_editor($settings)
// {
//   $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
//   return $settings;
// }
// add_filter('tiny_mce_before_init', 'remove_h1_from_editor');


function post_remove ()      //creating functions post_remove for removing menu item
{
   remove_menu_page('edit.php');
}

function remove_comments(){
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'remove_comments' );

/***********  REMOVE h1 FROM HEADING BLOCK   ***********/
function p11_remove_wp_block_heading_class_from_headings($content) {
  // Use regular expression to find and remove the class="wp-block-heading" from h1 to h6 tags
  $pattern = '/<(h[1-6])\s+class="wp-block-heading"(.*?)>/i';
  $replacement = '<$1$2>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
add_filter('the_content', 'p11_remove_wp_block_heading_class_from_headings');

/***********  CUSTOM THEME COLORS FOR BLOCKS   ***********/
function my_mce4_options($init) {
$base_color = str_replace('#', '', get_field('base_color', 'options'));
$primary_color = str_replace('#', '', get_field('primary_color', 'options'));
$secondary_color = str_replace('#', '', get_field('secondary_color', 'options'));
$accent_color = str_replace('#', '', get_field('accent_color', 'options'));
  $custom_colours = '
    "'.$base_color.'", "Base Color",
    "'.$primary_color.'", "Primary Color",
    "'.$secondary_color.'", "Secondary Color",
    "'.$accent_color.'", "Accent Color"
  ';
  // build colour grid default+custom colors
  $init['textcolor_map'] = '['.$custom_colours.']';

  $init['textcolor_rows'] = 1;

  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

/***********  ADJUST BORDER COLOR FOR ACF REPEATER FIELD   ***********/

function acf_mod_styles() {
   ?>
     <style type="text/css">
       .acf-repeater.-row>table>tbody>tr+tr>td,
       .acf-repeater.-block>table>tbody>tr+tr>td {
         border-top-color: #a8a8a8;
       }
     </style>
   <?php
 }
 add_action('acf/input/admin_head', 'acf_mod_styles');


 function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath

     global $post;         // load details about this page

     $cpid = get_the_ID();

     $parents = get_post_ancestors( $post->ID ); // get the ancestors

     $ancestorid = ($parents) ? $parents[count($parents)-1]: $post->ID;

     if(($post->post_parent==$pid||$cpid==$pid||$ancestorid==$pid))
         return true;   // we're at the page or at a sub page
     else
         return false;  // we're elsewhere
 };

/*** Show Current Category on Single Page ***/

 function sgr_show_current_cat_on_single($output) {

 global $post;

 if( is_single() ) {

 	$categories = wp_get_post_categories($post->ID);

 	foreach( $categories as $catid ) {
 		$cat = get_category($catid);
 		// Find cat-item-ID in the string
 		if(preg_match('#cat-item-' . $cat->cat_ID . '#', $output)) {
 			$output = str_replace('cat-item-'.$cat->cat_ID, 'cat-item-'.$cat->cat_ID . ' current-cat', $output);
 		}
 	}

 }
 return $output;
 }

 add_filter('wp_list_categories', 'sgr_show_current_cat_on_single');

 function address_phone_link_shortcode() {
  $address = get_field('address','options');
  $suite = get_field('suite','options');
  $city = get_field('city','options');
  $state = get_field('state','options');
  $zip = get_field('zip','options');
  $phone = get_field('phone','options');
  $link = 'https://www.google.com/maps/place/'.$address.', '.$city.', '.$state.' '.$zip;
  $fullatag = '<p class="contact-address"><a href="'.$link.'" target="_blank">'.$address.', '.$suite.'<br>'.$city.', '.$state.' '.$zip.'</a><br><a href="tel:'.$phone.'">'.$phone.'</a></p>';
  return $fullatag;
}
add_shortcode('address_phone_link', 'address_phone_link_shortcode');

function phone_link_shortcode() {
  $phone = get_field('phone','options');
  $fullatag = '<a href="tel:'.$phone.'">'.$phone.'</a>';
  return $fullatag;
}
add_shortcode('phone_link', 'phone_link_shortcode');


function options_shortcode($atts) {
  $atts = shortcode_atts(
      array(
          'field' => '', // Default value for 'field' attribute
      ),
      $atts
  );

  $field = $atts['field'];
  $returnfield = get_field($field, 'options');

  // Debugging output
  if (empty($returnfield)) {
      return "Field '$field' is empty or does not exist.";
  }

  return $returnfield;
}
add_shortcode('options', 'options_shortcode');


function map_widget_shortcode() {
  // Path to the template file
  $template_file = get_template_directory() . '/template-parts/content-map.php';

  // Check if the template file exists
  if (file_exists($template_file)) {
      ob_start(); // Start output buffering

      // Enqueue Google Maps API script in the footer
      $google_api_key = get_field('google_api_key', 'options');
      if ($google_api_key) {
          wp_enqueue_script(
              'google-maps-api',
              'https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=' . esc_js($google_api_key),
              array(), // No dependencies
              null, // No version
              true // Load in the footer
          );
      }

      // Enqueue custom gmap-directions.js script in the footer
      wp_enqueue_script(
          'gmap-directions', 
          get_template_directory_uri() . '/includes/js/gmap-directions.js', 
          array('google-maps-api'), // Make sure Google Maps API loads first
          null, // No version
          true // Load in the footer
      );

      // Include the template file
      include $template_file;

      return ob_get_clean(); // Return the buffered content
  }

  // Return an error message if the file is not found
  return "Template file 'template-parts/content-map.php' not found.";
}
add_shortcode('map_widget', 'map_widget_shortcode');

 ?>
