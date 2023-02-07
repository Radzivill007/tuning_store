<?php

defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' ); ?>
  <h1> <?php single_cat_title();?> </h1>
  <div class="catalog__wrap">
    <div class="catalog__items full">
      <? 
        if ( ! is_product_category( 'katalog' ) && ! is_product_category( 'marki' ) ) {
          $i = 1;
          if ( wc_get_loop_prop( 'total' )) {
            while ( have_posts() ) {
              the_post();
              global $product; 
              ?>
                <div class="catalog__item">
                  <a href="<?= get_permalink() ?>" class="catalog__item-img">
                    <img src="<?= get_the_post_thumbnail_url('', array(229, 167)) ?>" alt="<?= $product->name ?>">
                  </a>
                  <p class="catalog__item-title"><?= $product->name ?></p>
                  <div class="catalog__item-price"><?= $product->get_price_html() ?></div>
                  <div class="catalog__item-btn-wrap">
                    <a href="<?= get_permalink() ?>" class="more-link">
                      <button class="custom-btn">Подробнее</button>
                    </a>
                    <a href="?add-to-cart=<?= esc_attr( $product->get_id() ); ?>" class="btn-cart add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?= esc_attr( $product->get_id() ) ?>" rel="nofollow">
                    <svg>
                      <use xlink:href="#cart_icon"></use>
                    </svg>
                    </a>
                  </div>
                </div>
              <? 
              $i++;
            }
          }
        }
        else {
          woocommerce_product_loop_start();
          while ( have_posts() ) {
            the_post();
            do_action( 'woocommerce_shop_loop' );
            wc_get_template_part( 'content', 'product' );
          }
          woocommerce_product_loop_end();
        }
      ?>
    </div>
  </div>
  <div class="catalog__pagination">
    <? do_action( 'woocommerce_after_shop_loop' ); ?>
  </div>

<?
get_footer( 'shop' );
