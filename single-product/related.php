<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
<div class="sec-featured-products push-top-3" >
            <div class="heading-two">
              <h2>Related Products</h2>
            </div>	
		<?php woocommerce_product_loop_start(); ?>
		
			 <div class="featured-prod-container text-center">
              <div class="featured-prod-carousel owl-carousel owl-theme popup-gallery">
			<?php foreach ( $related_products as $related_product ) : 
				 	$product_id = $related_product->get_id();
					$product = wc_get_product( $product_id );			
					$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'shop-thumb');
					$image_src_path = dirname($image_src[0]);
					$image_src_filename = basename($image_src[0]);
					
				?>
				<div class="item featured-prod">
                  <div class="featured-prod-img"><a href="<?php echo get_permalink($product_id); ?>"><?php echo '<img src="' . $image_src_path . '/' . $image_src_filename . '" alt="'.get_the_title().'" />'; ?></a></div>
					 <div class="box-product-content">
					 <?php $product_title = $product->get_title();
						if (strlen($product_title) > 50)
						$product_title = substr($product_title, 0, 47) . '...';
						?>
                              <h3><a href="<?php echo get_permalink($product_id); ?>"><?php echo $product_title; ?></a></h3>
                              <div class="product-price">
                    <?php if ( $price_html = $product->get_price_html() ) { ?>
					<span class="price"><?php echo $price_html; ?></span>
					<?php } 
				else {
					echo '<span class="price">Out Of Stock</span>';
				}
				?>
					</div>
                          </div>
                </div>
			<?php endforeach; ?>
			</div>
              <!-- /.featured-prod-carousel -->
              
              <div class="customNavigation featured-prod-navigation text-center"> <a class="btn-prev"><i class="fa fa-angle-left fa-2x"></i></a> <a class="btn-next"><i class="fa fa-angle-right fa-2x"></i></a> </div>
              <!-- /.featured-prod-navigation --> 
              
            </div>
			
 	
       <!-- /.featured-prod-navigation --> 
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
