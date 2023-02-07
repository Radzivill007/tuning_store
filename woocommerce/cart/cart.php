<?php

defined( 'ABSPATH' ) || exit;
?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<div class="mini-cart-goods shop_table shop_table_responsive cart">
    <div class="mini-cart-items-head">
      <div>Товар</div>
      <div>Цена</div>
      <div>Количество</div>
      <div>Итого</div>
    </div>
		<?php
      do_action( 'woocommerce_before_cart_contents' );
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
          $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
          $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
          ?>
          <div class="mini-cart-item">
            <div class="mini-cart-mob-tovar">Товар</div>
            <div class="mini-cart-item-info">
              <div class="mini-cart-item-img">
                <?= $thumbnail ?>
              </div>
              <div class="mini-cart-item-title">
                <?php
                  if ( ! $product_permalink ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                  } else {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="mini-cart-item-title">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                  }
                  do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                  echo wc_get_formatted_cart_item_data( $cart_item );

                  if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                  }
                ?>
              </div>
            </div>
            <div class="mini-cart-item-price">
              <div class="mini-cart-mob-price">Цена</div>
              <div class="product-cart-price">
                <?=  $_product->get_price_html() ?>
              </div>
              <div></div>
            </div>
            <div class="mini-cart-item-qty">
              <div class="mini-cart-mob-count">Количество</div>
              <div class="input__count">
                <div class="input__count-min">−</div>
                <? 
                $product_quantity = woocommerce_quantity_input(
                  array(
                    'input_name'   => $cart_item_key,
                    'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input__count', 'input-text', 'qty', 'text' ), $_product ),
                    'input_value'  => $cart_item['quantity'],
                    'max_value'    => $_product->get_max_purchase_quantity(),
                    'min_value'    => '0',
                    'input_id' => $_product->id,
                    'product_name' => $_product->get_name(),
                  ),
                  $_product,
                  false
                );
                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                ?>
                <div class="input__count-add">+</div>
              </div>
            </div>
            <div class="mini-cart-item-total">
              <div class="mini-cart-mob-total">Итого</div>
              <?= apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
            </div>
            <div class="mini-cart-item-rmv">
              <?php
                echo apply_filters(
                  'woocommerce_cart_item_remove_link',
                  sprintf(
                    '<a href="%s" class="mini-cart-item-remove remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s"><svg><use xlink:href="#close"></use></svg></a>',
                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                    esc_html__( 'Remove this item', 'woocommerce' ),
                    esc_attr( $product_id ),
                    esc_attr( $_product->get_sku() ),
                    esc_attr( $cart_item_key )
                  ),
                  $cart_item_key
                );
              ?>
            </div>
          </div>
      <? endif; endforeach; ?>
  </div>
  <div class="mini-cart-total-price">
    <div class="mini-cart-left">Сумма заказа</div>
    <div>
      <?= number_format(WC()->cart->get_cart_contents_total(), 0, '', ' ' ); ?> ₽
    </div>
  </div>
  <div class="mini-cart-dostavka">
    <div class="mini-cart-left">Доставка</div>
    <div class="radio-group">
      <div>
        <input 
          id="sdek_method" 
          type="radio" 
          name="method" 
          checked
        />
        <label for="method">
          Доставка по России Сдек или Почтой
        </label>
      </div>
      <div>
        <input 
          id="self_method" 
          type="radio" 
          name="method" 
        />
        <label for="method">
          Самовывоз из магазина
        </label>
      </div>
    </div>
  </div>

  <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
    <div class="mini-cart-coupon coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
      <div class="mini-cart-coupon-text"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
      <div class="mini-cart-coupon-price" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>">
        <?php wc_cart_totals_coupon_html( $coupon ); ?>
      </div>
    </div>
  <?php endforeach; ?>

  <div class="actions">
    <?php if (wc_coupons_enabled()):?>
      <div class="coupon">
        <label for="coupon_code" class="form-label">
          <div class="mini-cart-left">Промокод</div>
          <input type="text" name="coupon_code" class="input-text" id="couponcode" value="" placeholder="Введите промокод" /> 
        </label>
        <button type="submit" class="custom-btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
          Применить
        </button>
        <?php do_action( 'woocommerce_cart_coupon' ); ?>
      </div>
    <?php endif;
    wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
    <button type="submit" class="button hidden" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
      <?php esc_html_e( 'Update cart', 'woocommerce' ); ?>
    </button>
  </div>
  <div class="mini-cart-total">
    <div class="mini-cart-left">Итого: </div>
    <?= number_format(WC()->cart->get_cart_contents_total(), 0, '', ' ' ); ?> ₽
  </div>
  <div class="mini-cart-btn-group">
      <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward with-shadow custom-btn">
        <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
      </a>
    <button>Купить в кредит</button>
    <button>Купить в рассрочку</button>
  </div>
</form>
<div class="mini-cart-access">
	<? woocommerce_cross_sell_display() ?>
</div>
