<?php

get_header();?>


<section>
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Оформление заказа</span>
    </div>
    <h1>Оформление заказа</h1>
   
    <?= do_shortcode("[woocommerce_checkout]"); ?>


    <h2>Преимущества нашего магазина</h2>
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
  </div>
</section>
<?php
get_footer();
