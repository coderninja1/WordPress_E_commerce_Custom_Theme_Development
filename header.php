<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html class="js csstransitions" lang="en">
<!--<![endif]-->
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="content-type" content="text/html">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Pro Air Supply</title>
<!-- Favicon
============================================== -->
<!--<link rel="shortcut icon" href="images/favicon.ico">-->

<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Files
================================================== -->

<style type="text/css" media="screen">
	html { margin-top:0px !important; }
	* html body { margin-top: 32px !important; }
	@media screen and ( max-width: 782px ) {
		html { /*margin-top: 46px !important;*/ }
		* html body { margin-top: 46px !important; }
	}
</style>
<?php  wp_head(); ?>
</head>

<body <?php body_class( 'woocommerce' ); ?>>
<header>
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
			<ul>
			<?php
			global $wpdb;
			$query = $wpdb->get_row("SELECT toll_free_no FROM pro_above_header_details WHERE Id='1'");
			if(!empty($query)){
				$toll_free_no = $query->toll_free_no;
			}
			// echo $toll_free_no;
			?>
					<li><i class="fa fa-phone"></i> Call us Toll Free: <a href="tel:<?php echo $toll_free_no; ?>"><?php echo $toll_free_no; ?></a></li>
					<li><a href="'.get_template_directory_uri() . '/track-order"><i class="fa fa-truck"></i> Track Order</a></li>
				  </ul>
        </div>
        <div class="col-md-6">
		 <ul class="top-nav">
		<?php
			$current_user = wp_get_current_user();
			// print_r($current_user);
			?>
			<li><a href="<?php echo get_template_directory_uri() . '/wishlist'; ?>"><i class="fa fa-heart"></i> Wishlist</a></li>
			<?php
			if ( 0 == $current_user->ID ) {?>				
				<li><a href="<?php echo get_template_directory_uri() . '/my-account'; ?>"><i class="fa fa-user"></i> Login/Register</a></li>
			<?php } else {?>
				<?php do_action( 'woocommerce_before_account_navigation' ); ?>
				<li><a href="<?php echo get_template_directory_uri() . '/my-account'; ?>"><i class="fa fa-user"></i> <?php echo $current_user->user_login; ?></a></li>
				<li><a href="<?php echo wp_logout_url( home_url() ); ?>"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
				<?php do_action( 'woocommerce_after_account_navigation' ); ?>
			<?php } ?>           
            <li><a href="<?php echo get_template_directory_uri() . '/checkout'; ?>"><i class="fa fa-sign-out"></i> Checkout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Top Bar -->
			<?php get_template_part( 'navigation', 'top' ); ?>
    <!-- /.container --> 
	<?php
	
	if (wc_get_page_id( 'myaccount' ) == get_the_ID()) {?>
		<?php //echo "MyAccount"; ?>
		<style>
			body{
				font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif !important;
				font-size: 15px !important;
				font-weight: 400 !important;
				background-color: #FFF !important;
				line-height: 24px !important;
			}
		</style>
	<?php }
	// $my_account_page_id = get_option( 'woocommerce_myaccount_page_id' );
	// echo $page_title = $wp_query->post->post_title;
	if (wc_get_page_id( 'cart' ) == get_the_ID() || wc_get_page_id( 'myaccount' ) == get_the_ID() || is_page( 'blog' ) || is_page('checkout') || is_page('about-us') || is_page( 'contact-us' ) || is_page('track-order') || is_page('wishlist')|| is_page('terms-conditions')|| is_page('request-a-quote')) {?>
			<style>
				.entry-title{
					display:none;
				}
				.sec-search .row{margin-left:0px !important;margin-right:0px !important;}
			</style>
	<?php }else{
	?>
	<style>
				.sec-search .row{margin-left:0px !important;margin-right:0px !important;}
			</style>
	<div class="sec-search">
    <div class="container ">
      <div class="row search-bar">
			<?php if ( get_theme_mod( 'search-bar-check', 1 ) == 1 && class_exists( 'WooCommerce' ) ) : ?> 
		<?php get_template_part( 'searchbar', 'searchbar' ); ?>
	<?php endif; ?>
        <div class="col-md-3 cart">
          <ul>
		  <?php global $woocommerce;
				$count = $woocommerce->cart->cart_contents_count; 
				?>
            <li class="text-right"><a href="<?php echo get_template_directory_uri() . '/cart'; ?>">Shopping Cart <br>
              ( <?php echo $count;?> ) Items</a></li>
            <li><a href="cart.html" class="btn-cart"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
	<?php } ?>
</header>
