<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
get_header('shop');
global $product;
if (!is_object($product)) $product = wc_get_product(get_the_ID());
?>
<div class="product__card">
  <? do_action('woocommerce_before_main_content'); ?>
  <div class="wrap">
    <div class="d-md-none">
      <? if ($product->stock_status == 'instock') : ?>
        <div class="product__card-instock">
          <span>В наличии</span>
        </div>
      <? else : ?>
        <div class="product__card-instock product__card-outstock">Нет в наличии</div>
      <? endif; ?>
    </div>
    <? $gallery_products = $product->get_gallery_image_ids(); ?>
    <div class="product__card-slider-wrap">
      <div class="product__card-slider-big">
        <a data-fancybox="slide" href="<?= wp_get_attachment_url($product->get_image_id()); ?>" class="product__card-slider-big-img">
          <?= $product->get_image('full'); ?>
        </a>
        <? foreach ($gallery_products as $img) : ?>
          <a data-fancybox="slide" href="<?= wp_get_attachment_url($img, 'full'); ?>" class="product__card-slider-big-img">
            <?= wp_get_attachment_image($img, 'large'); ?>
          </a>
        <? endforeach ?>
      </div>
      <?php

      if (sizeof($gallery_products) > 1) {
      ?>
        <div class="product__card-slider-nav">
          <a data-fancybox="slide" href="<?= wp_get_attachment_url($product->get_image_id()); ?>" class="product__card-slider-nav-img">
            <?= $product->get_image('thimbnail'); ?>
          </a>
          <? foreach ($gallery_products as $img) : ?>
            <a data-fancybox="slide" href="<?= wp_get_attachment_url($img, 'full'); ?>" class="product__card-slider-nav-img">
              <?= wp_get_attachment_image($img, 'thumbnail') ?>
            </a>
          <? endforeach ?>
        </div>
      <?php
      }

      ?>
    </div>

    <div class="product__card-text">
      <div class="d-none">
        <? if ($product->stock_status == 'instock') : ?>
          <div class="product__card-instock">
            <span></span>
          </div>
        <? else : ?>
          <div class="product__card-instock product__card-outstock">Нет в наличии</div>
        <? endif; ?>
      </div>

      <h1><?= $product->name ?></h1>
      <p><?= $product->short_description ?></p>
      <? if ($product->is_type('variable')) : ?>
        <div class="product__card-text-wrap">
          <? do_action('woocommerce_single_product_summary'); ?>
        </div>
      <? else : ?>
        <div class="product__card-price">
          <div class="product__card-price-current">
            <?= $product->get_price_html() ?>
          </div>
        </div>
        <div class="product__card-bottom">
          <div class="product__card-btn-wrap">
            <div>
              <button type="submit" class="custom-btn btn-cart add_to_cart_button ajax_add_to_cart">
                В корзину
              </button>
            </div>
            <div class="btn-wrap">
              <a type="button" class="button-alt" onclick="
              const h1 = jQuery('h1')[0].innerHTML;
              
              const summ = parseInt(jQuery('.product__card-price').find('bdi')[0].innerText.replace('₽', '').replace(' ', ''),10);
              tinkoff.create(
                {
                  sum: summ,
                  items: [{name: h1, price: summ, quantity: 1}],
                  promoCode: 'default',
                  shopId: '921e872a-3829-452a-bbbc-58acdc2d9b3d',
                  showcaseId: '30ac1be4-fbb6-433c-bf0a-f0ef94c4dd07',
                },
                {view: 'modal'}
              )">
                Купить в кредит
              </a>
              <span class="notice">
                Кредит от 3 до 24 месяцев
              </span>
            </div>
            <div class="btn-wrap">
              <a type="button" class="button-alt" onclick="
        const h1 = jQuery('h1')[0].innerHTML;
        const summ = parseInt(jQuery('.product__card-price').find('bdi')[0].innerText.replace('₽', '').replace(' ', ''),10);
        tinkoff.create(
          {
            sum: summ,
            items: [{name: h1, price: summ, quantity: 1}],
            promoCode: 'installment_0_0_4_7,8',
            shopId: '921e872a-3829-452a-bbbc-58acdc2d9b3d',
            showcaseId: '30ac1be4-fbb6-433c-bf0a-f0ef94c4dd07',
          },
          {view: 'modal'}
        )">
                Купить в рассрочку
              </a>
              <span class="notice">
                0% рассрочка на 4 месяца
              </span>
            </div>
          </div>
        </div>
      <? endif; ?>
    </div>
  </div>
  <div class="product__card-tabs-mob-wrapper">
    <div class="product__card-tabs-mob-wrapper-inner">
      <div class="product__card-tabs">
        <div class="product__card-tab active">Характеристики</div>

        <? if (has_term(get_term_by('name', 'Штатные магнитолы Android', 'product_cat')->term_id, 'product_cat') or has_term(get_term_by('name', 'Магнитолы универсальные', 'product_cat')->term_id, 'product_cat')) : ?>
          <div class="product__card-tab">Что в комплекте?</div>
        <? endif; ?>
        <div class="product__card-tab">Как выбрать?</div>
        <div class="product__card-tab">О рассрочке</div>
        <div class="product__card-tab">Инструкции</div>
      </div>
    </div>
  </div>
  <div class="product__card-tab-content-wrap">
    <div class="product__card-tab-content" style="display: block;">
      <div class="product__card-options-text"><?= do_shortcode($product->description) ?></div>
      <div class="product__card-info big">
        <p>
          Производитель оставляет за собой право вносить изменения в комплектацию, характеристики и конструкцию изделий без предварительного уведомления. Представленная на сайте информация о товаре является ознакомительной. Подробнее уточняйте у продавцов-консультантов.
        </p>
      </div>
    </div>
    <? if (has_term(get_term_by('name', 'Штатные магнитолы Android', 'product_cat')->term_id, 'product_cat') or has_term(get_term_by('name', 'Магнитолы универсальные', 'product_cat')->term_id, 'product_cat')) : ?>
      <div class="product__card-tab-content">
        <p class="title">Комплект поставки:</p>
        <ul>
          <li>Головное устройство</li>
          <li>Переходная рамка</li>
          <li>Колодка с проводами для подключения</li>
          <li>USB-кабели</li>
          <li>Провод CAM IN; AUX IN L; AUX IN R; AMP-CON; CVBS-IN1</li>
          <li>Антенна GPS</li>
          <li>Антенна 4G</li>
          <li>Гарантийный талон</li>
        </ul>
        <div class="product__card-info big">
          <p>
            Производитель оставляет за собой право вносить изменения в комплектацию, характеристики и конструкцию изделий без предварительного уведомления. Представленная на сайте информация о товаре является ознакомительной. Подробнее уточняйте у продавцов-консультантов.
          </p>
        </div>
      </div>
    <? endif; ?>
    <div class="product__card-tab-content">
      <p class="title">Как выбрать?
      <p>
      <p class="desc" style="max-width:472px">При выборе магнитолы Android, нужно определиться с классом системы и типом головного устройства.</p>
      <div class="product__card-info-wrap">
        <div class="product__card-info" style="margin-top:0">
          <p class="title">
            Класс системы
          </p>
          <p class="desc" style="margin-bottom:15px">Головные устройства Teyes представлены в трех разных классах.</p>
          <ul class="alt">
            <li>Базовые – модель Teyes CC2L Lite Plus. Подойдет для простого пользования мультимедиа и навигации. Для быстрой загрузки рекомендуем рассмотреть минимум с 2ГБ ОЗУ. К таким устройствам нельзя подключить доп. аксессуары Teyes.</li>
            <li>Высокий – модели Teyes X1, TPRO и CC2 Plus. Прекрасные технические характеристики, отличное качество звука. Возможность управлять картами, видеорегистратором или камерой прямо на главном экране.</li>
            <li>Флагман – модель Teyes CC3. Устройство идеально подходит для любителей автозвука. 2 микросхемы DSP обладают наилучшим алгоритмом передачи звука, аудиоканалы 5.1, оптоволоконный и коаксиальный цифровые выходы. Все это безусловно удовлетворит высокие запросы ценителей автозвука. Наилучшие технические характеристики и программное обеспечение.</li>
          </ul>
        </div>
        <div class="product__card-info" style="margin-top:0">
          <p class="title">
            Тип устройства
          </p>
          <ul class="alt">
            <li> Штатные магнитолы ШГУ – в комплекте с головным устройством все необходимое для установки, в том числе переходная рамка и проводка для подключения в штатные коннекторы питания автомобиля. Устройства такого вида, как правило с размером экрана 9-10 дюймов. В каталоге более 300 марок авто, легко подобрать.</li>
            <li>Универсальные магнитолы 2DIN – размер экрана 7 дюймов. Устанавливается в переходную рамку или панель автомобиля с размером 178х102мм. Важно обратить внимание, 2 Дин магнитолы поставляются без переходной рамки и с универсальным проводом питания. На некоторые современные авто с кан-шиной, потребуется доп. переходники и канн-адаптеры. </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="product__card-tab-content">
      <p class="title">
        О рассрочке
      </p>
      <p class="desc" style="max-width:694px">В нашем магазине «TuningStore96» вы можете приобрести товар в рассрочку на 4 месяца без процентов и переплат. Сумма разбивается равными частями на 4 месяца. Вы платите только сумму за магнитолу. </p>
      <p class="title">
        Преимущества онлайн-кредитования
      </p>
      <ul class="alt">
        <li>Нет первого взноса</li>
        <li>Нет переплаты</li>
        <li>Оформление онлайн в любой точке РФ! Не нужно ходить в банк!</li>
        <li>Ответ за 2 минуты! По статистике мы получаем 8 из 10 одобрений</li>
        <li>Надежный банк Тинькофф и его партнеры</li>
        <li>Бесплатное досрочное погашение</li>
      </ul>
      <div class="product__card-info small">
        <p>
          Чтобы приобрести в Рассрочку нажмите «Купить в рассрочку», заполните ваши данные, далее с вами свяжется менеджер и поможет вам с оформлением!
        </p>
      </div>
    </div>
    <div class="product__card-tab-content">
      <p class="title">
        Инструкции к головным устройствам Teyes
      </p>
      <p class="desc" style="max-width:737px">Настройка CANBUS, схема подключения проводов, распиновка разъемов, видео по установке, скачать последнее обновление и другие часто задаваемые вопросы.</p>
      <p class="title alt">
        Выберите модель головного устройства
      </p>
      <div class="models">
        <?php
        $instructions = carbon_get_theme_option('support_instructions');
        if (!empty($instructions)) : ?>
          <?php foreach ($instructions as $key => $item) : ?>
            <div class="model">
              <a href="<?= $item['support_instructions_link'] ?>" class="inner" target="_blank" rel="nofollow noopener">
                <img src="<?= $item['support_instructions_img'] ?>" alt="instrucrion-<?= $key ?>">
              </a>
            </div>
          <?php endforeach; ?>
        <?php endif;
        ?>
      </div>
    </div>
  </div>

</div>
<div class="slider_alt_section">
  <div class="container">
    <h2 class="small">Дополните вашу магнитолу аксессуарами</h2>
    <div class="slider_block">
      <div class="slider-alt">
        <?= do_shortcode('[woo_products_by_tags tags="Accessories"]'); ?>
      </div>
    </div>
  </div>
</div>
<?php
get_footer('shop');
