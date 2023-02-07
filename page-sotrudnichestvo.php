<?php

get_header();
?>
<section class="cooperation">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Сотрудничество</span>
    </div>
    <h1>Сотрудничество</h1>
    <h3><?= carbon_get_theme_option( 'cooperation_title' ); ?></h3>
    <div class="cooperation_row">
      <div>
        <p><?= carbon_get_theme_option( 'cooperation_text_1' ); ?></p>
      </div>
      <div>
        <p><?= carbon_get_theme_option( 'cooperation_text_2' ); ?></p>
      </div>
    </div>
    <div class="inner">
      <h2><?= carbon_get_theme_option( 'cooperation_form_text' ); ?></h2>
      <?= do_shortcode('[contact-form-7 id="1808" title="cooperation"]'); ?>
    </div>
    <h2>Преимущества сотрудничества с нами</h2>
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
get_sidebar();
get_footer();
