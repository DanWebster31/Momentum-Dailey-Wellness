<?php
/**
 * @package client-theme
 */
?>

<div id="categories" class="left tcenter fade-slow">
	<h2 class="ttertiary font-main-medium">Categories</h2>
	<ul>
		<li <?php if (is_home()) { print 'class="current-cat"'; } ?>><a href="/news/">All News</a></li>
		<?php wp_list_categories('title_li=&exclude=1'); ?>
	</ul>
</div>

<div id="facebook" class="left tcenter fade-slow">
	<?php $facebook = get_field('facebook','option'); if($facebook) { ?>
	<h2 class="ttertiary font-main-medium">Get Social</h2>
  <!-- <ul id="news-social">
    <?php //get_template_part( 'template-parts/content-social' ); ?>
  </ul> -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=246041785417109";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="fb-page" data-href="<?php echo get_field('facebook','option'); ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?php echo get_field('facebook','option'); ?>"><a href="<?php echo get_field('facebook','option'); ?>"><?php bloginfo('name'); ?></a></blockquote></div></div>
	<?php } ?>
</div>

<div id="weather" class="right tcenter fade-slow">
	<h2 class="ttertiary font-main-medium">Current Weather</h2>
	<?php get_template_part( 'includes/weather/weather' ); ?>
</div>
