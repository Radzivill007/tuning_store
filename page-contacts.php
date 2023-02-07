<?php

get_header();
?>
<section class="contacts">
  <div class="container">
    <div class="brcr">
      <span><a href="/">Главная</a></span>
      <svg>
        <use xlink:href="#arrow"></use>
      </svg>
      <span>Контакты</span>
    </div>
    <h1>Контакты</h1>
    <p class="info_title">По всем интересующим вопросам, Вы можете:</p>
    <div class="card_row">
      <div class="card">
        <div class="inner">
          <p class="title">Позвонить по телефону</p>
          <p class="desc">
            <a href="tel:<?php echo carbon_get_theme_option( 'crb_phone' ); ?>"><?php echo carbon_get_theme_option( 'crb_phone' ); ?></a>
            <a href="tel:<?php echo carbon_get_theme_option( 'crb_phone2' ); ?>"><?php echo carbon_get_theme_option( 'crb_phone2' ); ?></a>
          </p>
        </div>
      </div>
      <div class="card">
        <div class="inner">
          <p class="title">Написать через <br/> Онлайн-консультант</p>
          <p class="desc">В правом нижнем углу экрана, находится диалоговое окно</p>
        </div>
      </div>
      <div class="card">
        <div class="inner">
          <p class="title">Отправить письмо на E-mail</p>
          <p class="desc"><a href="mailto:<?php echo carbon_get_theme_option( 'crb_mail' ); ?>"><?php echo carbon_get_theme_option( 'crb_mail' ); ?></a></p>
        </div>
      </div>
      <div class="card">
        <div class="inner">
          <p class="title">Посетить оффлайн-магазин</p>
          <p class="desc"><?php echo carbon_get_theme_option( 'crb_address' ); ?></p>
          <p class="desc">
              <b>Режим работы:</b> <?php echo carbon_get_theme_option( 'crb_address_time' ); ?>
          </p>
        </div>
      </div>
    </div>
    <?php echo carbon_get_theme_option( 'crb_map' ); ?>
  </div>
</section>

<?php
get_sidebar();
get_footer();
