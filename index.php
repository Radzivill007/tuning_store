<?php

get_header();
?>

<section class="main_banner_section">
  <div class="container">
    <div class="slider-block">
      <div id="Slider">
      <?php
        $mainslider = carbon_get_theme_option ( 'main_page_slider' );
        if ( ! empty( $mainslider ) ): ?>
          <?php foreach ( $mainslider as $slide ): ?>
            <div>
              <div class="slider-inner">
              <?php if (strlen($slide['main_page_slider_btn_link']) > 0 ) :?>
                <a class="img-desc" href="<?= $slide['main_page_slider_btn_link'] ?>">
                  <img src="<?= $slide['main_page_slider_image'] ?>" alt="<?= $slide['main_page_slider_title'] ?>" />
                </a>
                <a class="img-mob" href="<?= $slide['main_page_slider_btn_link'] ?>">
                  <img src="<?= $slide['main_page_slider_image_mob'] ?>" alt="<?= $slide['main_page_slider_title'] ?>" />
                </a>
              <?php else :?>
                <div class="img-desc">
                  <img src="<?= $slide['main_page_slider_image'] ?>" alt="<?= $slide['main_page_slider_title'] ?>" />
                </div>
                <div class="img-mob">
                  <img src="<?= $slide['main_page_slider_image_mob'] ?>" alt="<?= $slide['main_page_slider_title'] ?>" />
                </div>
              <?php endif ?>
              </div>
            </div>
			    <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<section class="brands_section" id="brands_section">
  <div class="container">
    <h1>Подбор магнитолы по марке автомобиля</h1>
    <!-- <label for="car-brand-search">
      <svg style="width: 20px; height:21px">
        <use xlink:href="#search"></use>
      </svg>
      <input id="car-brand-search" placeholder="Поиск марки" />
      <button>Найти</button>
    </label> -->
    <div class="brands">
      <?php
        $prod_cat_args = array(
          'taxonomy'    => 'product_cat',
          'orderby'     => 'id', // здесь по какому полю сортировать
          'hide_empty'  => false, // скрывать категории без товаров или нет
          'parent'      => get_term_by('name', 'Марки', 'product_cat')->term_id // id родительской категории
        );

        $woo_categories = get_categories($prod_cat_args);
        foreach ($woo_categories as $woo_cat) {
          $woo_cat_id = $woo_cat->term_id; //category ID
          $woo_cat_name = $woo_cat->name; //category name
          $woo_cat_slug = $woo_cat->slug; //category slug
          $category_thumbnail_id = get_woocommerce_term_meta($woo_cat_id, 'thumbnail_id', true);
          $thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);

          echo '<a class="inner" href="' . get_term_link($woo_cat_id, 'product_cat') . '" >';
          echo '<p>' . $woo_cat_name . '</p>';
          echo '<div><img src="' . $thumbnail_image_url . '" alt="' . $woo_cat_name . '" /></div>';
          echo "</a>";
        }
        ?>
    </div>
  </div>
</section>
<section class="popular_section" id="popular_section">
  <div class="container">
    <h2>Популярные категории</h2>
    <div class="catalog_cards" id="index_catalog">

      <div class="row">
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

        $woo_categories = get_categories($prod_cat_args);
        foreach ($woo_categories as $woo_cat) {
          $woo_cat_id = $woo_cat->term_id; //category ID
          $woo_cat_name = $woo_cat->name; //category name
          $woo_cat_slug = $woo_cat->slug; //category slug
          $category_thumbnail_id = get_woocommerce_term_meta($woo_cat_id, 'thumbnail_id', true);
          $thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);

          echo "<div class='col-12 col-md-4'>";
          echo '<a class="inner" href="' . get_term_link($woo_cat_id, 'product_cat') . '" >';
          echo '<p>' . $woo_cat_name . '</p>';
          echo '<div class="img"><img src="' . $thumbnail_image_url . '" alt="' . $woo_cat_name . '" /></div>';
          echo "</a>";
          echo "</div>";
        }
        ?>
      </div>
      <div class="more">
        <button class="custom-btn large">Все категории</button>
      </div>
    </div>
  </div>
</section>
<section class="slider_alt_section" id="hits">
  <div class="container">
    <h2>Хиты продаж</h2>
    <div class="slider_block">
      <div class="slider-alt">
        <?= do_shortcode('[woo_products_by_tags tags="hit"]'); ?>
      </div>
    </div>
  </div>
</section>
<section class="slider_alt_section" id="news">
  <div class="container">
    <h2>Лучшие новинки</h2>
    <div class="slider_block">
      <div class="slider-alt">
        <?= do_shortcode('[woo_products_by_tags tags="news"]'); ?>
      </div>
    </div>
  </div>
</section>
<section class="banner_section">
  <div class="container">
    <div class="banner">
      <div class="inner">
        <div>
          <h4><?= carbon_get_theme_option ( 'main_page_banner_text' ); ?></h4>
          <div class="img-mob">
            <img src="<?= carbon_get_theme_option ( 'main_page_banner_img' ); ?>" alt="banner_main_page_mob">
          </div>
          <a href="<?= carbon_get_theme_option ( 'main_page_banner_btn_link' ); ?>">
            <button class="custom-btn with-shadow"><?= carbon_get_theme_option ( 'main_page_banner_btn_text' ); ?></button>
          </a>
        </div>
        <div class="img">
          <img src="<?= carbon_get_theme_option ( 'main_page_banner_img' ); ?>" alt="banner_main_page">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="vk_section" id="vk_section">
  <div class="container">
    <h2>Мы в Вконтакте</h2>
    <div class="info">
      <div class="left">
        <img src="<?= carbon_get_theme_option ( 'main_page_vk_logo' ); ?>" alt="vk_logo">
        <a href="<?= carbon_get_theme_option ( 'crb_vk' ); ?>">
          @tuning_store
        </a>
      </div>
      <div class="right">
        <a href="<?= carbon_get_theme_option ( 'crb_vk' ); ?>">
          <button class="custom-btn small">
            Подписаться
          </button>
        </a>
      </div>
    </div>
    <div class="img">
      <img src="<?= carbon_get_theme_option ( 'main_page_vk_img' ); ?>" alt="vk_image" />
    </div>
    <div class="vk-slider">
      <?php
        $slider = carbon_get_theme_option ( 'main_page_vk_slider' );
        if ( ! empty( $slider ) ): ?>
          <?php foreach ( $slider as $item ): ?>
            <div class="card">
              <div class="inner">
                <a href="<?= $item['main_page_vk_slider_link'] ?>">
                  <img src="<?= $item['main_page_vk_slider_image'] ?>">
                  <p class="desc"><?= $item['main_page_vk_slider_text'] ?></p>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; 
      ?>
    </div>
  </div>
</section>


<?php
get_sidebar();
get_footer();
