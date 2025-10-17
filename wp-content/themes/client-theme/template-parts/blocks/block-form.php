<?php
  /* SECTION */
  $section_id = get_field('section_id');
  $section_class = get_field('section_class');
  $section_wrapper = get_field('section_wrapper');
  $wrapper_inset = get_field('wrapper_inset');
  $section_background = get_field('section_background_color');
  $section_background_image = get_field('section_background_image');
  $section_background_effect = get_field('section_image_effect');
  $section_background_parallax_ratio = get_field('section_image_parallax_ratio');
	/* FORM */
  $form_style = get_field('form_style');
  $form_id = get_field('form_id');
  $clean_id = sanitize_title_with_dashes($form_id);
  $form_function_name = str_replace('-', '_', $clean_id); 
  $form_class = get_field('form_class');
  $form_background = get_field('form_background_color');
  $label_font = get_field('label_font');
  $label_color = get_field('label_color');
  $field_font = get_field('field_font');
  $field_color = get_field('field_color');
  $title = get_field('title');
  $title_font = get_field('title_font');
  $title_color = get_field('title_color');
  $text = get_field('text');
  $text_font = get_field('text_font');
  $text_color = get_field('text_color');
  $disclaimer_font = get_field('disclaimer_font');
  $disclaimer_color = get_field('disclaimer_color');
  $submit_style = get_field('submit_style');
  $submit_font = get_field('submit_font');
  $submit_color = get_field('submit_color');
  $submit_background = get_field('submit_background_color');
  $form_embed = get_field('form_embed_code');
  // Form Options
  $form_recipients = get_field('form_email') ?? get_field('form_email','options');
  $source = get_field('email_source');
  $subject = get_field('email_subject');
  $sender_email = get_field('sender_email') ?? 'no-reply@p11.com';
  $community_name = get_field('community_name');
  $form_ga = get_field('form_ga') ?? 'Form Submission';
  $form_success_title = get_field('success_title');
  $form_success_text = get_field('success_text');
?>
<section <?php if($section_id) { echo 'id="'.$section_id.'" '; } ?>class="form-section<?php if($section_class) { echo ' '.$section_class; } ?><?php if($section_background) { echo ' bg'.$section_background; } ?>">

<?php if($section_background_image) { ?>
<div class="form-section-image fill<?php if($section_background_effect == 'parallax') { echo ' '; } ?>">
<div class="fill cover responsive-background-image<?php if($section_background_effect == 'fixedbg') { echo ' fixedbg';} ?>"><?php acf_responsive_image($section_background_image); ?></div>
</div>

<?php } ?>

<div class="form-section-content <?php echo $section_wrapper; ?><?php if ($wrapper_inset) { echo ' inset'; } ?>">

  <form <?php if($form_id) { echo 'id="'.$form_id.'-form" '; } ?> name="interest-list" class="<?php if($form_class) { echo $form_class.' '; } ?>form-styles clearfix<?php if($form_background) { echo ' bg'.$form_background; } ?>" method="POST">
  <?php if($form_recipients){ ?><input name="notification" type="hidden" value="<?php echo $form_recipients; ?>" /><?php } ?>
    <input name="source" type="hidden" value="<?php echo $source; ?>" />
    <input name="community" type="hidden" value="<?php echo $community_name; ?>" />
    <input name="sender_email" type="hidden" value="<?php echo $sender_email; ?>" />
    <input name="email_subject" type="hidden" value="<?php echo $subject; ?>" />
    <input name="apptJWpGaA6Bna74KNg" type="hidden" value="<?php echo time(); ?>" />

    <?php if($title || $text) { ?>
    <div class="form-section-intro default-content mb-2 tcenter t<?php echo $text_color; ?>">
      <?php  if($title) { ?><h2 class="section-title t<?php echo $title_color; ?> font-<?php echo $title_font; ?>"><?php echo $title; ?></h2><?php } ?>
      <?php if($text) { ?><div class="font-<?php echo $text_font; ?>"><?php echo $text;?></div><?php } ?>
    </div>
    <?php } ?>

    <div id="<?php if($form_id) { echo $form_id.'-'; } ?>errorchecking" class="alert hidden">
    <p><i class="fas fa-exclamation-circle"></i>&nbsp; Please enter the required fields below.</p>
    </div>

    <div class="full half-gutter1">

    <div class="half left fielditem fieldinput">
    <input autocomplete="given-name" type="text" class="font-<?php echo $field_font; ?> t<?php echo $field_color; ?> required" aria-required="true" required name="firstName" id="firstName" value="" style="border-bottom: 1px solid <?php echo 'var(--'.$field_color.'-color)'; ?>" />
    <label for="firstName" class="font-<?php echo $label_font; ?> t<?php echo $label_color; ?><?php if($form_background) { echo ' bg'.$form_background; } ?>">First Name*</label>
    </div>

    <div class="half right fielditem fieldinput">
    <label for="lastName" class="font-<?php echo $label_font; ?> t<?php echo $label_color; ?>">Last Name*</label>
    <input autocomplete="family-name" type="text" class="font-<?php echo $field_font; ?> t<?php echo $field_color; ?> required" aria-required="true" required name="lastName" id="lastName" value="" style="border-bottom: 1px solid <?php echo 'var(--'.$field_color.'-color)'; ?>" />
    </div>

    <div class="half left fielditem fieldinput">
    <label for="email" class="font-<?php echo $label_font; ?> t<?php echo $label_color; ?>">Email*</label>
    <input autocomplete="email" type="email" class="font-<?php echo $field_font; ?> t<?php echo $field_color; ?> required" aria-required="true" name="email" id="email" value="" required style="border-bottom: 1px solid <?php echo 'var(--'.$field_color.'-color)'; ?>" />
    </div>

    <div class="half right fielditem fieldinput">
    <label for="phone" class="font-<?php echo $label_font; ?> t<?php echo $label_color; ?>">Phone</label>
    <input autocomplete="tel" type="text" class="font-<?php echo $field_font; ?> t<?php echo $field_color; ?>" name="phone" id="phone" value="" style="border-bottom: 1px solid <?php echo 'var(--'.$field_color.'-color)'; ?>"/>
    </div>

    </div>

    <div class="form-submit left full tcenter clearfix">
    <?php if($submit_style == 'button') { ?>
      <a id="<?php if($form_id) { echo $form_id.'-'; } ?>submit" type="submit" class="submit-button boxbtn with-arrow font-<?php echo $submit_font; ?> t<?php echo $submit_color; ?> bg<?php echo $submit_background; ?>"><span>Submit <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></span></a>
    <?php } else { ?>
      <a id="<?php if($form_id) { echo $form_id.'-'; } ?>submit" type="submit" class="submit-button arrowlink font-<?php echo $submit_font; ?> t<?php echo $submit_color; ?>">Submit <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
    <?php } ?>
    <div class="required-text">*Required</div>
    <!-- <button id="submitbutton" class="boxbtn with-arrow" type="submit">Submit <i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button> -->
    </div>

  </form>
    
  </div>
</section>

<script>
window.addEventListener('load', function() {
var <?php echo $form_function_name; ?>_form = new ValidationForm ({
formID: '#<?php if($form_id) { echo $form_id; } ?>-form',
errorMessageDIV: '#<?php if($form_id) { echo $form_id; } ?>-errorchecking',
submitButtonID: '#<?php if($form_id) { echo $form_id; } ?>-submit',
googleAnalyticsCode: {label: '<?php echo $form_ga; ?>'},
processingMessage: {title: '<?php if($form_success_title) { echo $form_process_title; } ?>',copy: '<?php if($form_success_text) { echo $form_process_text; } ?>',},
successMessage: {title: '<?php if($form_success_title) { echo $form_success_title; } ?>',copy: '<?php if($form_success_text) { echo $form_success_text; } ?>',},
});
<?php echo $form_function_name; ?>_form.init();
}, false);
</script>