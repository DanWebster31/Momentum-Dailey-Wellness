<?php 
function social_link($field, $label, $icon) {
    if($url = get_field($field, 'options')) {
        $class = strpos($url, 'cbchomes.com') !== false ? ' class="noselect"' : '';
        echo "<li$class><a aria-label=\"$label\" href=\"$url\" target=\"_blank\"><i class=\"$icon\"></i></a></li>";
    }
}

social_link('facebook', 'Facebook', 'fab fa-facebook-f');
social_link('instagram', 'Instagram', 'fab fa-instagram');
social_link('linkedin', 'LinkedIn', 'fa-brands fa-linkedin-in');
?>