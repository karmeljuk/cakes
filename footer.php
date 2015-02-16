<?php
/**
 * The template for displaying the footer.
 * @package cakes
 */
?>

<?php
  // get the option
  global $cakes_opt;
  $footer_top_text  = $cakes_opt['footer-text-top'];
  $footer_phone  = $cakes_opt['footer-phone'];
  $footer_bottom_text = $cakes_opt['footer-text-bottom'];
?>

<footer id="footer">
  <div class="container">
    <div class="contact-phone"><?php echo sanitize_text_field($footer_top_text); ?>&nbsp;<a href="tel:<?php echo sanitize_text_field($footer_phone); ?>"><strong><?php echo sanitize_text_field($footer_phone); ?></strong></a></div>

    <?php if($cakes_opt['social-footer'] == 1): ?>
    <nav class="social-links">
      <strong>Follow us</strong>
      <ul>
        <?php if ( !empty(esc_url($cakes_opt['s_facebook']))): ?>
          <li class="large ico facebook"><a href="<?php echo esc_url($cakes_opt['s_facebook']); ?>" class="rounded-ico large" target="_blank"></a></li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_twitter']))): ?>
          <li class="large ico twitter"><a href="<?php echo esc_url($cakes_opt['s_twitter']); ?>/" class="rounded-ico large" target="_blank"></a></li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_gplus']))): ?>
          <li class="large ico google-plus"><a href="<?php echo esc_url($cakes_opt['s_gplus']); ?>" class="rounded-ico large" target="_blank"></a></li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_pinterset']))): ?>
          <li class="large ico pinterest"><a href="<?php echo esc_url($cakes_opt['s_pinterset']); ?>" class="rounded-ico large" target="_blank"></a></li>
        <?php endif; ?>
        <?php if ( !empty(esc_url($cakes_opt['s_linkedin']))): ?>
          <li class="large ico linkedin"><a href="<?php echo esc_url($cakes_opt['s_linkedin']); ?>" class="rounded-ico large" target="_blank"></a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

    <div class="copyright"><?php echo sanitize_text_field($footer_bottom_text); ?></div>
  </div>
</footer>

<?php echo $cakes_opt['general-tracking']; ?>
<?php wp_footer(); ?>
<script type="text/javascript">
var templateUrl = '<?php echo get_template_directory_uri(); ?>';
</script>

</body>
</html>
