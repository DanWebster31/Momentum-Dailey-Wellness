<?php
$page_id = get_field('page_select');
$section_id = get_field('block_id');
render_specific_acf_block_by_field($page_id, 'section_id', $section_id);
?>
