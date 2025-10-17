<div id="sub-nav" class="sub-nav-wrapper">
  <?php // See - "Display Submenu to Current Parent Menu Item" in functions & https://christianvarga.com/how-to-get-submenu-items-from-a-wordpress-menu-based-on-parent-or-sibling/ also here https://gist.github.com/levymetal/37e7a0853bbe410b9f57
  /* if (is_page('design-studio')) { $root_id = '475'; }
  else if ((wp_get_post_parent_id(get_the_ID())) == '426') { $root_id = '473'; }
  else { */ $root_id = null;/*  } */
  global $post;
  $post_slug = $post->post_name;
  $menu = wp_nav_menu(
    array(
      'echo' => FALSE,
      'menu'    => 'Main Menu',
      'sub_menu' => true,
      'root_id' => $root_id,
    )
  );
  if (! empty ( $menu )) {
    echo '<nav id="subhero-nav-'.$post_slug.'" class="bgsecondary subhero-nav tcenter"><div class="wrapper"><div class="subnav-mobile">Page Menu</div>';
    echo $menu;
    echo '</div></nav>';
  }
  ?>
</div>