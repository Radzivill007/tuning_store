<?php

get_header();
?>
<section class="dostavka">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Доставка</span>
    </div>
    <h1>Доставка</h1>
    <p class="info_title">Мы организуем доставку <br class="d-md-none" /> приобретенных у нас <br class="d-none" /> товаров одним <br class="d-md-none" /> из удобных для Вас способов:
    </p>
    <?php
      $dostavka = carbon_get_theme_option ( 'dostavka' );
      if ( ! empty( $dostavka ) ): ?>
        <?php foreach ( $dostavka as $step ): ?>
          <div class="step">
            <div class="step_col">
              <div class="inner">
                <h3><?= $step['dostavka_title'] ?></h3>
                <?= $step['dostavka_text'] ?>
              </div>
            </div>
            <div class="step_col">
              <img src="<?= $step['dostavka_image'] ?>" alt="<?= $step['dostavka_title'] ?>" />
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; 
    ?>
  </div>
</section>

<?php
get_sidebar();
get_footer();
