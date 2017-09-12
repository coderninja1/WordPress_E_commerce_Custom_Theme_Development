<?php
/**
 * Single variation cart button
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<ul>
	<li style="
    width: 100% !important;
">
    <div class="col-md-3 label">Quantity:</div>
	<div class="col-md-9 form-inline" style="color:black;">
	<?php
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
		) );

		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
</div>
		</li>
		
		
		
		
		
		<li class="row" style="margin-bottom:0px !important;padding-bottom:0px;">
		<div class="col-md-6" style="padding:0px;">
		<button type="submit" class="btn btn-custom"><i class="fa fa-cart-plus"></i> <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		</div>
		<div class="col-md-6" style="padding:0px;">
		<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?></div></li>
		<li class="row tags" style="color:gray;">
	Tags: <?php echo wc_get_product_tag_list( $product->get_id(), ', ',  _n( '', '', count( $product->get_tag_ids() )) ); ?>
	</li>
		</ul>
		

	
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />

