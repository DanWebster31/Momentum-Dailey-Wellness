
<?php 
global $post;
global $postparent;
global $post_slug;
global $slidetitle;
global $slidetitletag;
if($post) {
$post_slug = $post->post_name;
$posttype = str_replace("-","_",$post_slug);
$postparent = $post->post_parent;
}

// Get the current post ID from the block context
$current_post_id = get_the_ID();
$post = get_post($current_post_id);
$blocks = parse_blocks($post->post_content);



if(get_field('use_slides_from') == 'parentpage') {
$altpage = $post->post_parent;
} else if(get_field('use_slides_from') == 'anotherpage') {
$altpage = get_field('slides_page');
} else {
$altpage = '';
}

if(get_field('slide_title')) {
  $slidetitle = get_field('slide_title');
  $slidetitletag = get_field('slide_title_tag');
}

$slide_subtitle = get_field('slide_subtitle');
?>

<?php 
if($altpage) {
$content = get_the_content(false, false, $altpage);
$myblocks = parse_blocks($content);
foreach($myblocks as $block){
	if($block['blockName'] == 'acf/top-slides'){
		echo render_block($block);
	}
}

} else { ?>

<?php if (get_field('images_or_video') == 'video') { ?>

<div id="slider" class="with-video">

<!-- <div class="top-gradient"></div> -->
<div class="bottom-gradient"></div>

<?php if (get_field('video_id')) { ?>
<div class="videoloader"><i class="fad fa-spinner-third fa-spin"></i></div>
<div class="top-video <?php $video_thumbnail = get_field('video_thumbnail'); if($video_thumbnail) { echo 'cover responsive-background-image'; } ?>">
<?php if($video_thumbnail) { acf_responsive_image($video_thumbnail); } ?>
  <iframe tabindex="-1" id="top-video" title="<?php bloginfo('name'); ?> Video" src="https://player.vimeo.com/video/<?php echo get_field('video_id'); ?>?background=1" width="500" height="281" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" data-ready="true" allow="autoplay"></iframe>
</div>
<?php } ?>

<?php } else { ?>

<?php
$images = get_field('top_slides');

if($images) {
$imgcount = count($images);
?>

<div id="slider" class="cycle-slideshow<?php if($imgcount > 1) { echo ' ken-burns'; } ?> full" data-cycle-speed="1500" data-cycle-timeout="4000" data-cycle-slides=".slide">
<div class="imgloader"><i class="fad fa-spinner-third fa-spin"></i></div>
  <!-- <div class="top-gradient"></div> -->
  <div class="bottom-gradient"></div>

  <?php $imgnum = 1; if($images): foreach( $images as $image ): ?>

    <div class="slide<?php if($imgnum == 1) { echo ' first'; } ?> parallax-rev">
  <div class="cover responsive-background-image" <?php $bg_position = get_field('bg_position', $image['ID']); if($bg_position): ?> style="background-position: <?php echo $bg_position; ?> center"<?php endif; ?>>
    <?php acf_responsive_image($image); ?>
  </div>
</div>

  <?php $imgnum++; endforeach; endif; ?>

  <?php } // /video or images ?>

<?php } // if images ?>

<?php if(is_front_page()) { ?>
<div class="page-title page-title test">
    <?php if(get_field('slide_title_tag') == 'h1') { ?><h1><?php } else { ?><h2><?php } ?>
    <?php if(get_field('slide_title')) { echo get_field('slide_title'); } ?>
    <?php if(get_field('slide_title_tag') == 'h1') { ?></h1><?php } else { ?></h2><?php } ?> 
  </div>
  <a id="down-arrow" aria-label="Down to Content" class="spanlink cover icon-scroll" href="#intro"><i class="fa-light fa-chevron-down"></i></a>
<?php } else if($slidetitle) { ?>
  <div class="page-title animate-fadein test">
  <?php if($slidetitletag == 'h1') { ?><h1><?php } else { ?><h2><?php } ?>
  <?php echo $slidetitle; ?>
  <?php if($slidetitletag == 'h1') { ?></h1><?php } else { ?></h2><?php } 
  if($slide_subtitle) { ?><h2 class="hero-subtitle"><?php echo $slide_subtitle; ?></h2><?php } ?>
  </div>
<?php } else if(is_single() && is_singular('post')) { ?>
<div class="page-title animate-fadein"><h2>News</h2></div>
<?php } else { ?>
  <div class="page-title animate-fadein">
  <?php if(get_field('slide_title_tag') == 'h1') { ?><h1><?php } else { ?><h2><?php } ?>
  <?php if(get_field('slide_title')) { echo get_field('slide_title'); } else { echo get_the_title(); } ?>
  <?php if(get_field('slide_title_tag') == 'h1') { ?></h1><?php } else { ?></h2><?php } ?>
  </div>
<?php } ?>

</div>

<?php } // check for $altpage ?>