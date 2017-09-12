<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<div class="main-container">
  <div class="container">
    <div class="row">
		<div class="main-content col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">
			<div class="product-details">
				<div class="panel-custom panel-border">		
					<div class="panel-custom-heading">
						<div class="row">
							<div class="col-md-8">Home / <?php woocommerce_page_title(); ?></h2></div>
							<div class="col-md-4">
								<div class="product-view">
								
									<label>View </label>
								
								
										<?php	$grid_view = __( 'Grid view', 'woocommerce-grid-list-toggle' );
				$list_view = __( 'List view', 'woocommerce-grid-list-toggle' );

				$output = sprintf( '<a href="#" id="grid" title="%1$s" class="active"><i class="fa fa-th-large"></i></a><a href="#" id="list" title="%2$s"><i class="fa fa-list"></i></a>', $grid_view, $list_view );

				echo apply_filters( 'gridlist_toggle_button_output', $output, $grid_view, $list_view ); ?>
							
								</div>
							</div>
						</div>  
					</div>
					<div class="panel-custom-body">
						<div class="row product-hd" style="padding-bottom:0px;">
							<div class="col-md-6">
							  <h1><?php woocommerce_page_title(); ?></h1>
							</div>
							<div class="col-md-6" style="padding:0px;">
								<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
						  </div>
						</div>

						<?php if ( have_posts() ) : ?>

							<?php woocommerce_product_loop_start(); ?>

								<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php
										/**
										 * woocommerce_shop_loop hook.
										 *
										 * @hooked WC_Structured_Data::generate_product_data() - 10
										 */
										do_action( 'woocommerce_shop_loop' );
									?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php
								/**
								 * woocommerce_no_products_found hook.
								 *
								 * @hooked wc_no_products_found - 10
								 */
								do_action( 'woocommerce_no_products_found' );
							?>

						<?php endif; ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
					</div>
				</div>
			</div>
		</div>
	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>
		</div>
	</div>
</div>
<?php get_footer( 'shop' ); ?>
