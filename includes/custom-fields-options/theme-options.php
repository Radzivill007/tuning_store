<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


// Default options page
$basic_options_container = Container::make( 'theme_options', __( 'Настройка контента' ) )
  ->add_tab( __("Контактная информация на сайте"), array(
    Field::make( 'text', 'crb_phone', __( 'Телефон' ) )
      ->set_width( 100 ),
    Field::make( 'text', 'crb_phone2', __( 'Дополнительный телефон' ) )
      ->set_help_text( 'Обображается на странице контактов' )
      ->set_width( 100 ),
    Field::make( 'text', 'crb_phone_whatsapp', __( 'Телефон для whatsapp' ) )
      ->set_help_text( 'Обображается на странице техподдержки' )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_phone_whatsapp2', __( 'Телефон для whatsapp без +, пробелов и скобок' ) )
      ->set_help_text( 'Необходимо для корректной работы ссылки' )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_mail', __( 'Email' ) ),
    Field::make( 'text', 'crb_address', __( 'Адрес' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_address_time', __( 'Время работы магазина' ) )
      ->set_help_text( 'Обображается в футере' )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_support_time_from', __( 'Время работы технической поддержки c' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_support_time_to', __( 'до' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_youtube', __( 'youtube' ) )
      ->set_width( 50 ),
      Field::make( 'text', 'crb_telegram', __( 'telegram' ) )
      ->set_width( 50 ),
      Field::make( 'text', 'crb_whatsapp', __( 'whatsapp' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_vk', __( 'VK' ) )
      ->set_width( 50 ),
    Field::make( 'text', 'crb_ip', __( 'ИП' ) ),
    Field::make( 'text', 'crb_inn', __( 'ИНН' ) ),
    Field::make( 'text', 'crb_ogrnip', __( 'ОГРНИП' ) ),
    Field::make( 'text', 'crb_bank', __( 'Банк' ) ),
    Field::make( 'text', 'crb_rschet', __( 'Расчетный счет' ) ),
    Field::make( 'text', 'crb_kschet', __( 'Корреспондентский счет' ) ),
    Field::make( 'text', 'crb_bik', __( 'БИК' ) ),
    Field::make( 'rich_text', 'crb_map', __( 'Скрипт карты' ) )
      ->set_help_text( 'Формируется на сайте yandex.ru/map-constructor' ),
  ) )
  ->add_tab( __("Подключение скриптов в футер сайта"), array(
    Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Scripts' ) )
      ->set_help_text( 'скрипты необходимо добавлять в открывающем и закрывающем теге script' ),
  ) )
  ->add_tab( __("Логотип и favicon"), array(
    Field::make( 'image', 'crb_logo', __( 'Логотип' ) )
      ->set_value_type( 'url' )
      ->set_help_text( 'Отображается в хедере и футере' )
      ->set_width( 50 ),
    Field::make( 'image', 'crb_favicon', __( 'Favicon' ) )
      ->set_value_type( 'url' )
      ->set_help_text( 'Отображается во вкладке браузера' )
      ->set_width( 50 ),
  ) )
  ->add_tab( __('Преимущества'), array(
    Field::make( 'complex', 'adv', 'Преимущества' )
      ->add_fields( array(
        Field::make( 'image', 'adv_img', 'Картинка' )
          ->set_value_type( 'url' )
          ->set_width( 20 ),
        Field::make( 'text', 'adv_title', 'Заголовок' )
          ->set_width( 39 ),
        Field::make( 'text', 'adv_text', 'Описание' )
          ->set_width( 39 ),
    ) ),
  ) )
  ->add_tab( __('Главная страница'), array(
    Field::make( 'complex', 'main_page_slider', 'Слайдер в главном блоке' )
      ->help_text( 'Добавляйте и редактируйте слайды' )
      ->add_fields( array(
        Field::make( 'image', 'main_page_slider_image', __( 'Картинка' ) )
          ->set_value_type( 'url' )
          ->set_width( 33 ),
        Field::make( 'image', 'main_page_slider_image_mob', __( 'Картинка для телефона' ) )
          ->set_value_type( 'url' )
          ->set_width( 33 ),
        Field::make( 'text', 'main_page_slider_btn_link', 'Ссылка' )
          ->set_width( 33 ),
      ) ),
    Field::make( 'text', 'main_page_banner_text', __( 'Заголовок Баннера внизу страницы' ) )
      ->set_width( 25 ),
    Field::make( 'text', 'main_page_banner_btn_text', __( 'Текст кнопки' ) )
      ->set_width( 25 ),
    Field::make( 'text', 'main_page_banner_btn_link', __( 'Ссылка' ) )
      ->set_width( 25 ),
    Field::make( 'image', 'main_page_banner_img', __( 'Картинка' ) )
      ->set_value_type( 'url' )
      ->set_width( 25 ),
    Field::make( 'image', 'main_page_vk_logo', __( 'Логотип VK' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
    Field::make( 'image', 'main_page_vk_img', __( 'Картинка в блоке VK' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
    Field::make( 'complex', 'main_page_vk_slider', 'Слайдер вконтакте' )
      ->help_text( 'Добавляйте и редактируйте слайды с постами из ВК' )
      ->add_fields( array(
        Field::make( 'image', 'main_page_vk_slider_image', __( 'Картинка' ) )
          ->set_value_type( 'url' )
          ->set_width( 33 ),
        Field::make( 'text', 'main_page_vk_slider_text', 'текст' )
          ->set_width( 33 ),
        Field::make( 'text', 'main_page_vk_slider_link', 'Ссылка' )
          ->set_width( 33 ),
      ) ),
  ) )
  ->add_tab( __('О магазине'), array(
    Field::make( 'image', 'o_magazine_main_image', 'Главная картинка' )
      ->set_value_type( 'url' )
      ->set_help_text( 'Выберите картинку магазина' )
      ->set_width( 20 ),
    Field::make( 'rich_text', 'o_magazine_main_text', 'Главный текст' )
      ->set_width( 79 ),
    Field::make( 'complex', 'o_magazine_rewards', 'Награды' )
      ->add_fields( array(
        Field::make( 'rich_text', 'o_magazine_reward_text', 'Заголовок' )
          ->set_width( 50 ),
        Field::make( 'image', 'o_magazine_reward_img', 'Картинка' )
          ->set_value_type( 'url' )
          ->set_width( 50 ),
      ) ),
  ) )
  ->add_tab( __('Доставка'), array(
    Field::make( 'complex', 'dostavka', 'Способы доставки' )
      ->help_text( 'Добавляйте и редактируйте способы доставки' )
      ->add_fields( array(
        Field::make( 'text', 'dostavka_title', 'Заголовок' )
          ->set_width( 70 ),
        Field::make( 'image', 'dostavka_image', __( 'Картинка' ) )
          ->set_value_type( 'url' )
          ->set_width( 30 ),
        Field::make( 'rich_text', 'dostavka_text', 'Текст' )
          ->set_width( 100 ),
      ) ),
  ) )
  ->add_tab( __('Оплата'), array(
    Field::make( 'complex', 'oplata', 'Страница оплаты' )
      ->help_text( 'Добавляйте и редактируйте способы оплаты' )
      ->add_fields( array(
        Field::make( 'text', 'oplata_title', 'Заголовок' )
          ->set_width( 30 ),
        Field::make( 'rich_text', 'oplata_text', 'Текст' )
          ->set_width( 70 ),
      ) ),
  ) )
  ->add_tab( __('Акции'), array(
    Field::make( 'complex', 'akcii', 'Страница оплаты' )
      ->help_text( 'Добавляйте и редактируйте Акции' )
      ->add_fields( array(
        Field::make( 'text', 'akcii_title', 'Заголовок' )
          ->set_width( 30 ),
        Field::make( 'rich_text', 'akcii_text', 'Текст' )
          ->set_width( 70 ),
        Field::make( 'text', 'akcii_btn_text', 'Текст кнопки' )
          ->set_width( 50 ),
        Field::make( 'text', 'akcii_btn_link', 'Ссылка кнопки' )
          ->set_width( 50 ),
      ) ),
    Field::make( 'image', 'akcii_icon_1', __( '1' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
    Field::make( 'image', 'akcii_icon_2', __( '2' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
  ) )
  ->add_tab( __('Возврат, обмен и гарантия'), array(
    Field::make( 'rich_text', 'return_first_text', __( 'Текст первой карточки' ) )
      ->set_width( 100 ),
    Field::make( 'text', 'return_first_btn_text', 'Текст для кнопки скачивания' )
      ->set_width( 50 ),
    Field::make( 'file', 'return_zayavlenie_remont', __( 'Добавьте файл для скачивания заявления о ремонте' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
    Field::make( 'rich_text', 'return_second_text', __( 'Текст второй карточки' ) )
      ->set_width( 100 ),

    Field::make( 'complex', 'return_block', 'Карточка с заголовком' )
      ->add_fields( array(
        Field::make( 'text', 'return_block_h2', 'Заголовок h2' )
          ->set_width( 100 ),
        Field::make( 'rich_text', 'return_block_text', 'Текст карточки' )
          ->set_width( 100 ),
      ) ),

    Field::make( 'text', 'return_text_withoutcard_title', 'Текст без карточки Заголовок' )
      ->set_width( 50 ),
    Field::make( 'text', 'return_text_withoutcard_text', 'Текст без карточки Описание' )
      ->set_width( 50 ),

    Field::make( 'complex', 'return_block_download', 'Карточка с файлом для скачивания' )
      ->add_fields( array(
        Field::make( 'text', 'return_block_download_title', 'Заголовок' )
          ->set_width( 50 ),
        Field::make( 'file', 'return_block_download_zayavlenie', __( 'Добавьте файл для скачивания заявления' ) )
          ->set_value_type( 'url' )
          ->set_width( 50 ),
      ) ),
  ) )
  ->add_tab( __('Кредит'), array(
    Field::make( 'complex', 'advantages', 'Преимущества кредита' )
      ->add_fields( array(
        Field::make( 'text', 'advantage_title', 'Заголовок' )
          ->set_width( 30 ),
        Field::make( 'rich_text', 'advantage_text', 'Описание' )
          ->set_width( 70 ),
    ) ),
    Field::make( 'complex', 'credit_steps', 'Путь к заявке в системе' )
      ->add_fields( array(
        Field::make( 'text', 'credit_step_title', 'Заголовок' )
          ->set_width( 30 ),
        Field::make( 'rich_text', 'credit_step_text', 'Текст' )
          ->set_width( 40 ),
        Field::make( 'image', 'credit_step_img', 'Картинка в формате SVG' )
          ->set_value_type( 'url' )
          ->set_width( 19 ),
      ) ),
    Field::make( 'text', 'video_title', 'Заголовок для видео' )
      ->set_width( 50 ),
    Field::make( 'file', 'crb_credit_video', __( 'Добавьте видео о кредите в формате mp4' ) )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
  ) )
  ->add_tab( __('Сотрудничество'), array(
    Field::make( 'text', 'cooperation_title', 'Заголовок' )
      ->set_width(100 ),
    Field::make( 'text', 'cooperation_text_1', 'Текст 1' )
      ->set_width(100 ),
    Field::make( 'text', 'cooperation_text_2', 'Текст 2' )
      ->set_width(100 ),
    Field::make( 'text', 'cooperation_form_text', 'Текст формы' )
      ->set_width(100 ),
  ) )
  ->add_tab( __('техПоддержка'), array(
    Field::make( 'text', 'support_first_card_text', 'Текст первой карточки' )
      ->set_width( 50 ),
    Field::make( 'image', 'support_first_card_img', 'Картинка первой карточки' )
      ->set_value_type( 'url' )
      ->set_width( 50 ),
    Field::make( 'text', 'support_instructions_title', 'Заголовок инструкции' )
      ->set_width( 50 ),
    Field::make( 'text', 'support_instructions_text', 'Описание инструкции' )
      ->set_width( 50 ),
    Field::make( 'complex', 'support_instructions', 'Инструкции к моделям' )
      ->add_fields( array(
        Field::make( 'text', 'support_instructions_link', 'ссылка на инструкцию' )
          ->set_width( 70 ),
        Field::make( 'image', 'support_instructions_img', 'Картинка модели' )
          ->set_value_type( 'url' )
          ->set_width( 20 ),
      ) ),
    Field::make( 'text', 'support_rules_title', 'Правила заголовок' )
      ->set_width( 100 ),
    Field::make( 'complex', 'support_rules', 'Правила обращения в поддержку' )
      ->add_fields( array(
        Field::make( 'image', 'support_rules_img', 'Картинка цифры' )
          ->set_value_type( 'url' )
          ->set_width( 20 ),
        Field::make( 'text', 'support_rules_text', 'текст правила' )
          ->set_width( 70 ),
      ) ),
    Field::make( 'complex', 'support_cards', 'Карточки с текстом' )
      ->add_fields( array(
        Field::make( 'rich_text', 'support_cards_text', 'текст карточки' )
          ->set_width( 100 ),
      ) ),
  ) );