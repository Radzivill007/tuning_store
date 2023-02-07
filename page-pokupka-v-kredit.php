<?php

get_header();
?>
<section class="credit">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Покупка в кредит</span>
    </div>
    <h1>Покупка в кредит</h1>
    <p class="info_title">Покупка в кредит — простой, удобный <br class="d-md-none" /> и современный способ <br class="d-none" /> покупки товаров <br class="d-md-none" /> в интернет-магазине</p>
    <div class="advantage">
      <div class="advantage_row">
        <?php
          $advantages = carbon_get_theme_option ( 'advantages' );
          if ( ! empty( $advantages ) ): ?>
            <?php foreach ( $advantages as $item ): ?>
              <div class="advantage_col">
                <div class="inner">
                  <h3><?= $item['advantage_title'] ?></h3>
                  <?= $item['advantage_text'] ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; 
        ?>
      </div>
    </div>
    <div class="path">
      <h2>Путь заявки в системе:</h2>
      <div class="path_row">
        <?php
          $steps = carbon_get_theme_option ( 'credit_steps' );
          if ( ! empty( $steps ) ): ?>
            <?php foreach ( $steps as $item ): ?>
              <div class="path_card">
                <div class="inner">
                  <div class="img">
                    <img src="<?= $item['credit_step_img'] ?>" alt="<?= $item['credit_step_title'] ?>" />
                  </div>
                  <p class="title"><?= $item['credit_step_title'] ?></p>
                  <p class="desc"><?= $item['credit_step_text'] ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; 
        ?>
      </div>
    </div>
    <div class="video">
      <h3><?= carbon_get_theme_option( 'video_title' ); ?></h3>
      <video controls>
        <source src="<?= carbon_get_theme_option( 'crb_credit_video' ); ?>" type='video/mp4'>
      </video>
    </div>
  </div>
</section>

<?php
get_sidebar();
get_footer();
