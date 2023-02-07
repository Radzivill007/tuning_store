<?php

get_header();
?>

    <section class="o-magazine">
      <div class="container">
        <div class="brcr">
          <span><a href="/">Главная</a></span>
          <svg>
            <use xlink:href="#arrow"></use>
          </svg>
          <span>О магазине</span>
        </div>
        <h1>О магазине</h1>
        <div class="row">
          <div class="col-12 col-md-7">
            <div class="about">
              <div>
                <svg style="width: 56px; height:55px">
                  <use xlink:href="#2019"></use>
                </svg>
                <svg style="width: 56px; height:55px">
                  <use xlink:href="#2020"></use>
                </svg>
                <p>Лучший дилер России 2019, 2020</p>
              </div>
              <div>
                <svg style="width: 56px; height:55px">
                  <use xlink:href="#2021"></use>
                </svg>
                <p>Лидер продаж Россия 2021</p>
              </div>
            </div>
            <div class="text">
                <?= wpautop( carbon_get_theme_option( 'o_magazine_main_text') ); ?>
            </div>
          </div>
          <div class="col-12 col-md-5 main-img">
            <img src="<?= carbon_get_theme_option( 'o_magazine_main_image' ); ?>" alt="tuning-store">
          </div>
        </div>
        <div class="card_bank">
          <p class="title"><?= carbon_get_theme_option( 'crb_ip' ); ?></p>
          <p><span>ИНН: </span><?= carbon_get_theme_option( 'crb_inn' ); ?></p>
          <p><span>ОГРНИП: </span><?= carbon_get_theme_option( 'crb_ogrnip' ); ?></p>
          <p><span>Банк: </span><?= carbon_get_theme_option( 'crb_bank' ); ?></p>
          <p><span>Расчетный счет: </span><?= carbon_get_theme_option( 'crb_rschet' ); ?></p>
          <p><span>Корреспондентский счет: </span><?= carbon_get_theme_option( 'crb_kschet' ); ?></p>
          <p><span>БИК: </span><?= carbon_get_theme_option( 'crb_bik' ); ?></p>
        </div>
        <h2>Наши награды</h2>
        <div class="row presents">
          <?php
            $rewards = carbon_get_theme_option ( 'o_magazine_rewards' );
            if ( ! empty( $rewards ) ): ?>
              <?php foreach ( $rewards as $item ): ?>
                <div class="col-6 col-md-3">
                  <img src="<?= $item['o_magazine_reward_img'] ?>" alt="<?= $item['o_magazine_reward_text'] ?>">
                  <p><?= $item['o_magazine_reward_text'] ?></p>
                </div>
              <?php endforeach; ?>
            <?php endif; 
          ?>
        </div>
        <h2 class="short">Преимущества нашего магазина</h2>
        <div class="advantages">
          <div class="row">
            <?php
              $advs = carbon_get_theme_option ( 'adv' );
              if ( ! empty( $advs ) ): ?>
                <?php foreach ( $advs as $item ): ?>
                  
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="card equivalent_advantages">
                        <img src="<?= $item['adv_img'] ?>" alt="<?= $item['adv_title'] ?>" />
                      <p class="title"><?= $item['adv_title'] ?></p>
                      <p class="desc"><?= $item['adv_text'] ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; 
            ?>
          </div>
        </div>
        <h3>На страницах нашего интернет-магазина представлен широкий спектр автомобильных товаров:</h3>
        <div class="catalog_cards">
          <div class="row">
            <?php 
                $prod_cat_args = array(
                    'taxonomy'    => 'product_cat',
                    'orderby'     => 'id', // здесь по какому полю сортировать
                    'hide_empty'  => false, // скрывать категории без товаров или нет
                    'parent'      => get_term_by('name', 'Каталог', 'product_cat')->term_id // id родительской категории
                );

                $woo_categories = get_categories( $prod_cat_args );
                foreach ( $woo_categories as $woo_cat ) {
                    $woo_cat_id = $woo_cat->term_id; //category ID
                    $woo_cat_name = $woo_cat->name; //category name
                    $woo_cat_slug = $woo_cat->slug; //category slug
                    echo '<div class="col-12 col-md-4">';
                    echo '<a class="inner" href="' . get_term_link( $woo_cat_id, 'product_cat' ) . '" >';
                    $category_thumbnail_id = get_woocommerce_term_meta($woo_cat_id, 'thumbnail_id', true);
                    $thumbnail_image_url = wp_get_attachment_url($category_thumbnail_id);
                    echo '<p>' . $woo_cat_name . '</p>';
                    echo '<img src="' . $thumbnail_image_url . '" alt="' . $woo_cat_name . '" />';
                    echo '</a>';
                    echo '</div>';
                }
            ?>
          </div>
        </div>
      </div>
    </section>
<?php
get_sidebar();
get_footer();
