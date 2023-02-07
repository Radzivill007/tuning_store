<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
 
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<div class="product__card-btn-wrap">
    <div>
      <button type="submit" class="custom-btn btn-cart add_to_cart_button ajax_add_to_cart">
        В корзину
      </button>
    </div>
    <div class="btn-wrap">
      <a
        type="button"
        class="button-alt"
        onclick="
        const h1 = jQuery('h1')[0].innerHTML;
        const variant = jQuery('.pa_varianty').find('li.active')[0].innerHTML;
        const summ = parseInt(jQuery('.wc_price').find('div.active')[0].innerText.replace('₽', '').replace(' ', ''),10)
        tinkoff.create(
          {
            sum: summ,
            items: [{name: h1+variant, price: summ, quantity: 1}],
            promoCode: 'default',
            shopId: '921e872a-3829-452a-bbbc-58acdc2d9b3d',
            showcaseId: '30ac1be4-fbb6-433c-bf0a-f0ef94c4dd07',
          },
          {view: 'modal'}
        )"
      >
        Купить в кредит
      </a>
      <span class="notice">
        Кредит от 3 до 24 месяцев
      </span>
    </div>
    <div class="btn-wrap">
      <a
        type="button"
        class="button-alt"
        onclick="
        const h1 = jQuery('h1')[0].innerHTML;
        const variant = jQuery('.pa_varianty').find('li.active')[0].innerHTML;
        const summ = parseInt(jQuery('.wc_price').find('div.active')[0].innerText.replace('₽', '').replace(' ', ''),10)
        tinkoff.create(
          {
            sum: summ,
            items: [{name: h1+variant, price: summ, quantity: 1}],
            promoCode: 'installment_0_0_4_7,8',
            shopId: '921e872a-3829-452a-bbbc-58acdc2d9b3d',
            showcaseId: '30ac1be4-fbb6-433c-bf0a-f0ef94c4dd07',
          },
          {view: 'modal'}
        )"
      >
        Купить в рассрочку
      </a>
      <span class="notice">
        0% рассрочка на 4 месяца
      </span>
    </div>
	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
