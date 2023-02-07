<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package tuning_store
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function tuning_store_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'tuning_store_woocommerce_setup' );

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function tuning_store_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'tuning_store_woocommerce_active_body_class' );

if ( ! function_exists( 'tuning_store_woocommerce_cart_link_fragment' ) ) {
  function tuning_store_woocommerce_cart_link_fragment( $fragments ) {
    ob_start();
    tuning_store_woocommerce_cart_link();
    $fragments['a.main__header-cart'] = ob_get_clean();
    return $fragments;
  }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'tuning_store_woocommerce_cart_link_fragment' );

function update_checkout_cart() {
  ?>
  <div class="mini-cart-wrap">
    <?= do_shortcode("[woocommerce_cart]"); ?>
  </div>
  <?
}
function tuning_store_woocommerce_cart_fragment( $fragments ) {
  ob_start();
  update_checkout_cart();
  $fragments['.mini-cart-wrap'] = ob_get_clean();
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'tuning_store_woocommerce_cart_fragment' );

if ( ! function_exists( 'tuning_store_woocommerce_cart_link' ) ) {
  function tuning_store_woocommerce_cart_link() {
    $item_count_text = num_decline( WC()->cart->get_cart_contents_count(), 'товар, товара, товаров' );
    ?>
      <a href="/cart" class="cart main__header-cart">
        <div class="icon">
          <svg>
            <use xlink:href="#cart_icon"></use>
          </svg>
        </div>
          <p>
            <?= esc_html( $item_count_text ); ?> <br/>
            <?= wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
          </p>
      </a>
    <?php
  }
}

function warp_ajax_product_remove() {
  ob_start();
  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] ) {
      WC()->cart->remove_cart_item($cart_item_key);
    }
  }
  WC()->cart->calculate_totals();
  WC()->cart->maybe_set_cart_cookies();
  $mini_cart = ob_get_clean();
  $data = array(
    'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
      'form.woocommerce-cart-form' => '<div class="mini-cart-goods">' . $mini_cart . '</div>'
    )
  ),
    'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
  );
  wp_send_json( $data );
  wp_die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );

function warp_ajax_cart_update() {
  ob_start();
  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] ) {
      WC()->cart->set_quantity($cart_item_key, $_POST['quantity']);
    }
  }
  WC()->cart->calculate_totals();
  WC()->cart->maybe_set_cart_cookies();
  $mini_cart = ob_get_clean();
  $data = array(
    'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
      'form.woocommerce-cart-form' => '<div class="mini-cart-goods">' . $mini_cart . '</div>'
    )
  ),
    'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
  );
  wp_send_json( $data );
  wp_die();
}

add_action( 'wp_ajax_update_my_cart', 'warp_ajax_cart_update' );
add_action( 'wp_ajax_nopriv_update_my_cart', 'warp_ajax_cart_update' );

function apply_coupon() { 
  ob_start();
  global $woocommerce; WC()->cart->remove_coupons();
  $ret = WC()->cart->add_discount( $_POST['coupon_code'] ); 
  $array = array('return' => $ret); print_r($array); 
  WC()->cart->calculate_totals();
  WC()->cart->maybe_set_cart_cookies();
  $mini_cart = ob_get_clean();
  $data = array(
    'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
      'form.woocommerce-cart-form' => '<div class="mini-cart-goods">' . $mini_cart . '</div>'
    )
  ),
    'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
  );
  wp_send_json( $data );
  wp_die();
}
add_action( 'wp_ajax_apply_coupon', 'apply_coupon' );
add_action( 'wp_ajax_nopriv_apply_coupon', 'apply_coupon' );

function remove_coupon() {
  ob_start();

  global $woocommerce; 
  $ret = WC()->cart->remove_coupon($_POST['coupon_code']);
  $array = array('return' => $ret); print_r($array); 

  WC()->cart->calculate_totals();
  WC()->cart->maybe_set_cart_cookies();

  $mini_cart = ob_get_clean();

  $data = array(
    'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
      'form.woocommerce-cart-form' => '<div class="mini-cart-goods">' . $mini_cart . '</div>'
    )
  ),
    'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
  );

  wp_send_json( $data );

  wp_die();
}

add_action( 'wp_ajax_remove_coupon', 'remove_coupon' );
add_action( 'wp_ajax_nopriv_remove_coupon', 'remove_coupon' );

function variable_prod_ajax() {
  $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
  $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
  $variation_id = absint($_POST['variation_id']);
  $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
  $product_status = get_post_status($product_id);

  if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
    do_action('woocommerce_ajax_added_to_cart', $product_id);
    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
      wc_add_to_cart_message(array($product_id => $quantity), true);
    }
    WC_AJAX :: get_refreshed_fragments();
  } else {
    $data = array(
      'error' => true,
      'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
    echo wp_send_json($data);
  }
  wp_die();
}

add_action( 'wp_ajax_variable_prod', 'variable_prod_ajax' );
add_action( 'wp_ajax_nopriv_variable_prod', 'variable_prod_ajax' );