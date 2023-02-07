</main>
<div class="footer_dop">
  <div class="container">
    <div class="inner row">
      <div class="col-12 col-md-4">
        <ul>
          <li><a href="/o-magazine">О магазине</a></li>
          <li>
            <div class="with_dropdown_alt">
              Покупателю
              <ul class="dropdown">
                <li>
                  <a href="/dostavka">Доставка</a>
                </li>
                <li>
                  <a href="/oplata">Способы оплаты</a>
                </li>
                <li>
                  <a href="/akcii">Акции</a>
                </li>
                <li>
                  <a href="/vozvrat-obmen-i-garantiya">Возврат, обмен и гарантия</a>
                </li>
                <li>
                  <a href="/pokupka-v-kredit">Кредит</a>
                </li>
              </ul>
            </div>
          </li>
          <li><a href="/sotrudnichestvo">Сотрудничество</a></li>
          <li><a href="/tekhpodderzhka">Техподдержка</a></li>
          <li><a href="/contacts">Контакты</a></li>
        </ul>
      </div>
      <div class="col-12 col-md-4">
        <ul>
          <li><a href="/#popular_section">Популярные категории</a></li>
          <li><a href="/#hits">Хиты продаж</a></li>
          <li><a href="/#news">Лучшие новинки</a></li>
          <li><a href="/#vk_section">Мы в Вконтакте</a></li>
          <li><a href="/#brands_section">Подбор магнитолы по марке автомобиля</a></li>
        </ul>
      </div>
      <div class="col-12 col-md-4">
        <ul>
          <?php 
            $prod_cat_args = array(
              'taxonomy'    => 'product_cat',
              'orderby'     => 'include', // здесь по какому полю сортировать
              'order' => 'ASC',
              'include' => array(
                get_term_by('name', 'Штатные магнитолы Android', 'product_cat')->term_id,
                get_term_by('name', 'Магнитолы универсальные', 'product_cat')->term_id,
                get_term_by('name', 'Аксессуары', 'product_cat')->term_id,
                get_term_by('name', 'Подключение', 'product_cat')->term_id,
                get_term_by('name', 'Рамки переходные', 'product_cat')->term_id,
                get_term_by('name', 'Установочные комплекты', 'product_cat')->term_id,
                get_term_by('name', 'Активация', 'product_cat')->term_id,
                get_term_by('name', 'Распродажа', 'product_cat')->term_id,
              ),
              'hide_empty'  => false, // скрывать категории без товаров или нет
              'parent'      => get_term_by('name', 'Каталог', 'product_cat')->term_id // id родительской категории
            );
            $woo_categories = get_categories( $prod_cat_args );
            foreach ( $woo_categories as $woo_cat ) {
              $woo_cat_id = $woo_cat->term_id; //category ID
              $woo_cat_name = $woo_cat->name; //category name
              $woo_cat_slug = $woo_cat->slug; //category slug
              echo '<li>';
              echo '<a href="' . get_term_link( $woo_cat_id, 'product_cat' ) . '" >';
              $category_thumbnail_id = get_woocommerce_term_meta($woo_cat_id, 'thumbnail_id', true);
              $thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);
              echo $woo_cat_name ;
              echo "</a>";
              echo "</li>";
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="container">
    <a class="logo" href="#">
      <img src="<?php echo carbon_get_theme_option( 'crb_logo' ); ?>" alt="logo">
    </a>
    <div class="inner">
      <div class="left">
        <div class="item">
          <a href="tel:<?php echo carbon_get_theme_option( 'crb_phone' ); ?>"><?php echo carbon_get_theme_option( 'crb_phone' ); ?></a>
          <span>
              <?php echo carbon_get_theme_option( 'crb_support_time_from' ); ?>
              - 
              <?php echo carbon_get_theme_option( 'crb_support_time_to' ); ?>
              по МСК
          </span>
        </div>
        <div class="item">
          <p><?php echo carbon_get_theme_option( 'crb_address' ); ?></p>
          <span><?php echo carbon_get_theme_option( 'crb_address_time' ); ?></span>
        </div>
        <div class="item">
          <p>Заказ на сайте: круглосуточно</p>
        </div>
        <div class="item">
          <a href="mailto:<?php echo carbon_get_theme_option( 'crb_mail' ); ?>"><?php echo carbon_get_theme_option( 'crb_mail' ); ?></a>
        </div>
        <div class="item">
          <a href="<?php echo carbon_get_theme_option( 'crb_vk' ); ?>"  target="_blank"  rel="nofollow noopener">
            <svg style="width: 30px; height: 30px;">
              <use xlink:href="#vk"></use>
            </svg>
          </a>
          <a href="<?php echo carbon_get_theme_option( 'crb_youtube' ); ?>" target="_blank"  rel="nofollow noopener">
            <svg style="width: 30px; height: 30px;">
              <use xlink:href="#youtube"></use>
            </svg>
          </a>
			<a href="<?php echo carbon_get_theme_option( 'crb_telegram' ); ?>" target="_blank"  rel="nofollow noopener">
            <svg style="width: 30px; height: 30px;">
              <use xlink:href="#telegram"></use>
            </svg>
          </a>
			<a href="<?php echo carbon_get_theme_option( 'crb_whatsapp' ); ?>" target="_blank"  rel="nofollow noopener">
            <svg style="width: 30px; height: 30px;">
              <use xlink:href="#whatsapp"></use>
            </svg>
          </a>
        </div>
        <div class="policy">
          <a href="/privacy">Политика конфиденциальности</a>
          <a href="#">Договор оферты</a>
        </div>
      </div>
      <div class="right">
        <div class="up">
        <p>Оплачивайте онлайн:</p>
          <div class="cards">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/visa.png" alt="visa">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/mir.png" alt="mir">
          </div>
          <div class="cards">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/tinkoff.png" alt="tinkoff">
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/mastercard.png" alt="mastercard">
          </div>
        </div>
        <div class="agency">
          <p>Сделано в <a target="_blank" rel="nofollow noopener" href="https://invitedigital.ru/">Invite agency</a>.</p>
          <p>2018-2022 Все права защищены</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="fix-msg">
  Товар добавлен в 
  <a href="/cart">корзину</a>
</div>
<div class="hidden">
  <div class="popup" id="thnx">
    <noindex>
      <div class="mini-cart-title">Заявка успешно отправлена!</div>
    </noindex>
  </div>
  <div class="popup" id="thnx-add">
    <noindex>
      <div class="mini-cart-title">Товар добавлен в корзину!</div>
    </noindex>
  </div>
  <div class="popup callback_popup" id="callback">
    <noindex>
      <div class="mini-cart-title">Заказать звонок</div>
      <?= do_shortcode('[contact-form-7 id="1807" title="callback"]'); ?>
    </noindex>
  </div>
  <div class="popup callback_popup" id="callback_with_product">
    <noindex>
      <div class="mini-cart-title">Узнать о наличии</div>
      <?= do_shortcode('[contact-form-7 id="3591" title="callback_with_product"]'); ?>
    </noindex>
  </div>
  <div class="popup" id="offer-buy"> 
    <noindex>
      <div class="mini-cart-title">
        Товар успешно добавлен. Можете оформить заказ или продолжить покупки.
      </div>
      <a href="/cart" class="custom-btn">
        Оформить заказ
      </a>
    </noindex>
  </div>
</div> 
<?php wp_footer(); ?>
</body>
</html>
 