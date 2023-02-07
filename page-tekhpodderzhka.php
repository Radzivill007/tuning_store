<?php

get_header();
?>
<section class="support">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Техподдержка</span>
    </div>
    <h1>Техническая поддержка TuningStore96</h1>
    <p class="info_title">Поможем настроить и подключить <br class="d-md-none" /> головные устройства <br class="d-none" /> и аксессуары <br class="d-md-none" /> приобретенные в нашем
      магазине.
    </p>
    <div class="support_card">
      <img src="<?= carbon_get_theme_option('support_first_card_img') ?>" alt="support" />
      <p>
        <?= carbon_get_theme_option('support_first_card_text') ?>
      </p>
    </div>
    <div class="instructions">
      <h2><?= carbon_get_theme_option('support_instructions_title') ?></h2>
      <p><?= carbon_get_theme_option('support_instructions_text') ?></p>
      <h3>Выберите модель головного устройства</h3>
      <div class="models">
        <?php
          $instructions = carbon_get_theme_option ( 'support_instructions' );
          if ( ! empty( $instructions ) ): ?>
            <?php foreach ( $instructions as $key => $item ): ?>
              <div class="model">
                <a href="<?= $item['support_instructions_link'] ?>" class="inner equivalent_model" target="_blank" rel="nofollow noopener" >
                  <img src="<?= $item['support_instructions_img'] ?>" alt="instrucrion-<?= $key ?>">
                </a>
              </div>
            <?php endforeach; ?>
          <?php endif; 
        ?>
      </div>
    </div>
    <div class="rules">
      <h3><?= carbon_get_theme_option('support_rules_title') ?></h3>
      <div class="card">
        <?php
          $rules = carbon_get_theme_option ( 'support_rules' );
          if ( ! empty( $rules ) ): ?>
            <?php foreach ( $rules as $key => $item ): ?>
              <div>
                <div>
                  <img src="<?= $item['support_rules_img'] ?>" alt="rule-<?= $key ?>" />
                </div>
                <p class="support_rules_text"><?= $item['support_rules_text'] ?></p>
              </div>
            <?php endforeach; ?>
          <?php endif; 
        ?>
      </div>
      <div class="whatsapp">
        <img src="<?= get_template_directory_uri() ?>/assets/img/whatsapp.png" alt="whatsapp" />
        <p>Чат со специалистом
          <a target="_blank" rel="nofollow noopener" href="https://wa.me/<?= carbon_get_theme_option( 'crb_phone_whatsapp2' ); ?>"><?= carbon_get_theme_option( 'crb_phone_whatsapp' ); ?></a>
        </p>
      </div>
      <?php
        $cards = carbon_get_theme_option ( 'support_cards' );
        if ( ! empty( $cards ) ): ?>
          <?php foreach ( $cards as $key => $item ): ?>
            <div class="card">
              <p>
                <?= $item['support_cards_text'] ?>
              </p>
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
