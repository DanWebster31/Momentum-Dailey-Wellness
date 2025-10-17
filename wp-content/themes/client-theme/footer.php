<?php
/**
 * @package client-theme
 */

global $scriptsFooter;
?>


</div> <!-- /#main-content -->

<footer id="footer" class="tcenter twhite bgbase">
    <div class="footer-top sm-body-text wrapper-wide">
    <img class="footer-logo noselect" src="<?php echo get_field('logo_white','options'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
    <?php if(get_field('address','options')) { ?><p class="footer-address"><?php echo get_field('address','options'); ?>, <?php echo get_field('city','options'); ?>, <?php echo get_field('state','options'); ?> <?php echo get_field('zip','options'); ?></p><?php } ?>
    <?php if(get_field('phone','options')) { ?><p class="footer-phone"><a href="tel:<?php echo get_field('phone','options'); ?>"><?php echo get_field('phone','options'); ?></a></p><?php } ?>
    <?php if(!is_page('contact-us')) { ?><a class="footer-btn boxbtn bgaccent with-radius" href="/contact-us/">Contact&nbsp;Us</a> <?php } ?>
  </div>
    <div class="footer-split"></div>
    <div class="copyright wrapper-wide">
    <p>&copy; <?php echo date('Y'); ?> Momentum Dailey Wellness All Rights Reserved.
    <!-- <a href="/privacy-policy/" title="Privacy Policy">Privacy&nbsp;Policy</a>
    <a target="_blank" href="http://www.p11.com/" title="Site by p11">Site&nbsp;by&nbsp;P11</a></p> -->
    </div>
  </div>
</footer>

</div> <!-- /#contain-all -->

<a tabindex="-1" aria-label="Top of Page" id="uplink" class="pad1" href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

<div id="privacy-alert">
	<h2>Your privacy is important to us. By using this site, you agree to our updated <a href="/privacy-policy/">Privacy&nbsp;Policy</a>.</h2><span class="spanlink with-radius" id="privacy-policy-agree">I&nbsp;AGREE</span>
</div>

<?php wp_footer(); ?>

<?php if(get_field('footer_scripts','options')) {
  echo get_field('footer_scripts','options');
} ?>

<?php
	if (!empty($scriptsFooter)) {
		scriptPrint($scriptsFooter);
	}
?>

</body>
</html>
