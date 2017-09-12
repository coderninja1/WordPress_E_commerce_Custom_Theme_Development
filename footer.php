<!-- Footer -->
<footer>
<?php
	if (   is_active_sidebar( 'first-footer-widget-area'  )
    && is_active_sidebar( 'second-footer-widget-area' )
    && is_active_sidebar( 'third-footer-widget-area'  )
    && is_active_sidebar( 'fourth-footer-widget-area' )
) : ?>
 
<aside class="fatfooter" role="complementary">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
        <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
        <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
        <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
        </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 copyright">Copyright &copy; 2017 PROAIRSUPPLY - All Rights Reserved.</div>
		<?php
		global $wpdb;
		$query = $wpdb->get_row("SELECT * FROM pro_above_header_details WHERE Id='1'");
		if(!empty($query)){
			$facebook_link = $query->facebook_link;
			$twitter_link = $query->twitter_link;
			$google_plus_link = $query->google_plus_link;
		}
		?>
        <div class="col-md-6 social-links"> <a href="<?php echo $facebook_link; ?>" target="_blank"><i class="fa fa-facebook-square"></i></a> <a href="<?php echo $twitter_link; ?>" target="_blank"><i class="fa fa-twitter-square"></i></a> <a href="<?php echo $google_plus_link; ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a> </div>
      </div>
    </div>
  </div>
  </aside><!-- #fatfooter -->
<?php endif;?>
 
</footer>
<?php wp_footer(); ?>
</body>
</html>
