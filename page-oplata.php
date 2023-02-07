<?php

get_header();
?>
<section class="oplata">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Оплата</span>
    </div>
    <h1>Оплата</h1>
    <p class="info_title">Выберите удобный для Вас способ оплаты:</p>
    <div class="card_row">
      <?php
        $oplata = carbon_get_theme_option ( 'oplata' );
        if ( ! empty( $oplata ) ): ?>
          <?php foreach ( $oplata as $item ): ?>
            <div class="card">
              <div class="inner">
                <p class="title"><?= $item['oplata_title'] ?></p>
                <p class="desc"><?= $item['oplata_text'] ?></p>
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
