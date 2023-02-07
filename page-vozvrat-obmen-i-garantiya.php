<?php

get_header();
?>
<section class="returns">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Возврат, обмен и гарантия</span>
    </div>
    <h1>Возврат товара, <br class="d-md-none"/> обмен <br class="d-none" />
      и гарантийные <br class="d-md-none"/> обязательства</h1>
    <div class="card">
      <?= carbon_get_theme_option( 'return_first_text' ); ?>
      <div class="download">
        <p> <?= carbon_get_theme_option( 'return_first_btn_text' ); ?> </p>
        <a href="<?php echo carbon_get_theme_option( 'return_zayavlenie_remont' ); ?>"><button class="custom-btn">Скачать</button></a>
      </div>
    </div>
    <div class="card">
      <?= carbon_get_theme_option( 'return_second_text' ); ?>
    </div>
    <?php
      $block = carbon_get_theme_option ( 'return_block' );
      if ( ! empty( $block ) ): ?>
        <?php foreach ( $block as $item ): ?>
          <h2><?= $item['return_block_h2'] ?></h2>
          <div class="card">
            <?= $item['return_block_text'] ?>
          </div>
        <?php endforeach; ?>
      <?php endif; 
    ?>
    <h2><?= carbon_get_theme_option( 'return_text_withoutcard_title' ); ?></h2>
    <p class="return_text_withoutcard_text">
      <?= carbon_get_theme_option( 'return_text_withoutcard_text' ); ?>
    </p>
    <div class="cards">
      <?php
        $download = carbon_get_theme_option ( 'return_block_download' );
        if ( ! empty( $download ) ): ?>
          <?php foreach ( $download as $item ): ?>
            <div class="card">
              <div class="download">
                <p><?= $item['return_block_download_title'] ?></p>
                <a href="<?= $item['return_block_download_zayavlenie'] ?>"><button class="custom-btn">Скачать</button></a>
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
