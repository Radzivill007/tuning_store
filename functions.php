<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

// carbon-fields
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( get_template_directory() . '/includes/carbon-fields/vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'carbon_fields_register_fields', 'tuning_store_register_fields' );
function tuning_store_register_fields() {
    require get_template_directory() . '/includes/custom-fields-options/theme-options.php';
}

// вырубаем отображение админ панели
add_filter('show_admin_bar', '__return_false');

if( is_admin() ){
	// отключим проверку обновлений при любом заходе в админку...
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );
	add_filter( 'pre_site_transient_browser_'. md5( $_SERVER['HTTP_USER_AGENT'] ), '__return_true' );
}

if ( ! function_exists( 'tuning_store_setup' ) ) :

	function tuning_store_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'tuning_store' ),
			)
		);
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'tuning_store_setup' );

function tuning_store_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tuning_store' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tuning_store' ),
			'before_widget' => '<div class="catalog__filter-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="catalog__filter-btn"><span>',
			'after_title'   => '</span><img src="' . get_template_directory_uri() . '/assets/img/icons/caret-down.svg" alt=""></div>',
    )
	);
}
add_action( 'widgets_init', 'tuning_store_widgets_init' );



function lw_search_filter_pages($query) {
  if ($query->is_search) {
  $query->set('post_type', 'product');
  $query->set( 'wc_query', 'product_query' );
  }
  return $query;
  }
   
  add_filter('pre_get_posts','lw_search_filter_pages');
  

function tuning_store_styles() {
  //wp_enqueue_style( 'tuning_store-elem-css', get_template_directory_uri() . '/assets/css/elem.css', _S_VERSION, true );
  wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/assets/libs/jquery.fancybox/jquery.fancybox.min.css', _S_VERSION, true );
  wp_enqueue_style( 'tuning_store-style-css', get_template_directory_uri() . '/assets/css/style.css', _S_VERSION, true );
	wp_enqueue_style( 'tuning_store-style', get_stylesheet_uri(), array() ,  '1.0.0');
}
function tuning_store_scripts() {
	wp_enqueue_script( 'tuning_store-slick', get_template_directory_uri() . '/assets/libs/slick/slick.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'tuning_store-fancybox', get_template_directory_uri() . '/assets/libs/jquery.fancybox/jquery.fancybox.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'tuning_store-inputmask', get_template_directory_uri() . '/assets/libs/jquery.inputmask/jquery.inputmask.min.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'tuning_store-app', get_template_directory_uri() . '/assets/js/app.js', array( 'jquery' ), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'tuning_store_styles' );
add_action( 'wp_enqueue_scripts', 'tuning_store_scripts' );

require get_template_directory() . '/woocommerce/filters.php';
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/woocommerce/woocommerce.php';
}

function num_decline( $number, $titles, $param2 = '', $param3 = '' ){
	if( $param2 )
		$titles = [ $titles, $param2, $param3 ];
	if( is_string($titles) )
		$titles = preg_split( '/, */', $titles );
	if( empty($titles[2]) )
		$titles[2] = $titles[1];
	$cases = [ 2, 0, 1, 1, 1, 2 ];
	$intnum = abs( intval( strip_tags( $number ) ) );
	return "$number ". $titles[ ($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)] ];
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action ( 'woocommerce_before_main_content', 
function  () {
  ?>
    <section>
      <div class='container'>
  <?php
}, 5 );
add_action ( 'woocommerce_after_main_content', 
function  () {
  ?>
      </div>
    </section>
  <?php
}, 5 );

//настройка хлебных крошек
function jk_woocommerce_breadcrumbs() {
  return array(
  'delimiter' => ' <svg width="26" height="8" viewBox="0 0 26 8">
  <path opacity="0.4"
  d="M25.3536 4.35355C25.5488 4.15829 25.5488 3.84171 25.3536 3.64645L22.1716 0.464466C21.9763 0.269204 21.6597 0.269204 21.4645 0.464466C21.2692 0.659728 21.2692 0.976311 21.4645 1.17157L24.2929 4L21.4645 6.82843C21.2692 7.02369 21.2692 7.34027 21.4645 7.53553C21.6597 7.7308 21.9763 7.7308 22.1716 7.53553L25.3536 4.35355ZM0 4.5H25V3.5H0V4.5Z"
  fill="black" />
  </svg> ',
  'wrap_before' => '<div class="brcr">',
  'wrap_after' => '</div>',
  'before' => '<span>',
  'after' => '</span>',
  'home' => _x( 'Главная', 'breadcrumb', 'woocommerce' ),
  );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );

// шорткод получить список товаров по метке
function woo_products_by_tags_shortcode( $atts, $content = null ) {
  extract(shortcode_atts(array("tags" => ''), $atts));
  ob_start();
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => 5,
    'product_tag' => $tags
  );
  $loop = new WP_Query( $args );
  $product_count = $loop->post_count;
  if( $product_count > 0 ) :
    while ( $loop->have_posts() ) : $loop->the_post(); 
        global $product;
        global $post;
        ?>
          <div>
            <div class="inner">
              <div class="img">
                <img src="<?= wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID, 'shop_catalog' ), 'full', false )[0]; ?>" />
              </div>
              <div>
                <p class="text"> <?= $post->post_title ?> </p>
                <p class="price"> <?= $product->get_price_html() ?> </p>
                <div class="more">
                  <button class='custom-btn small'>
                    <a href="<?= get_permalink($product->post->id) ?>">Подробнее</a>
                  </button>
                  
                  <a href="?add-to-cart=<?= esc_attr( $product->get_id() ); ?>" class="cart_icon btn-cart add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?= esc_attr( $product->get_id() ) ?>" rel="nofollow">
                    <svg>
                        <use xlink:href='#cart_icon'></use>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?
    endwhile;
  else :
    _e('Товаров, удовлетворяющих заданные условия поиска, не найдено.');
  endif;
    return ob_get_clean();
  }
   
  add_shortcode("woo_products_by_tags", "woo_products_by_tags_shortcode");
  
// убираем завершающие нули в ценах.
add_filter( 'woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1 );
function wc_hide_trailing_zeros( $trim ) {
return true;
}



add_filter( 'woocommerce_checkout_fields' , 'new_woocommerce_checkout_fields', 10, 1 );
function new_woocommerce_checkout_fields($fields){
	// делаем поля необязательными
	$fields['billing']['billing_state']['required'] = false;
	$fields['billing']['billing_address_2']['required'] = false;
	$fields['billing']['billing_country']['required'] = false;
	$fields['billing']['billing_postcode']['required'] = false;
	$fields['billing']['billing_company']['required'] = false;
	$fields['billing']['billing_last_name']['required'] = false;

  $fields['billing']['billing_email']['required'] = true;
  $fields['billing']['billing_city']['required'] = true;
  $fields['billing']['billing_address_1']['required'] = true;

  $fields['billing']['billing_first_name']['label'] = 'ФИО';
  $fields['billing']['billing_city']['label'] = 'Город';

  $fields['billing']['billing_city']['priority'] = 50;
  $fields['billing']['billing_address_1']['priority'] = 60;
  $fields['billing']['billing_address_1']['placeholder'] = __( '', 'woocommerce' );
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_last_name']);

  
  $fields['shipping']['shipping_first_name']['required'] = false;
  $fields['shipping']['shipping_last_name']['required'] = false;
  $fields['shipping']['shipping_address_1']['required'] = false;
	$fields['shipping']['shipping_city']['required'] = false;
	$fields['shipping']['shipping_email']['required'] = false;
	$fields['shipping']['shipping_state']['required'] = false;
	$fields['shipping']['shipping_address_2']['required'] = false;
	$fields['shipping']['shipping_country']['required'] = false;
	$fields['shipping']['shipping_postcode']['required'] = false;
	$fields['shipping']['shipping_company']['required'] = false;

  unset($fields['shipping']['shipping_first_name']);
  unset($fields['shipping']['shipping_last_name']);
  unset($fields['shipping']['shipping_address_1']);
	unset($fields['shipping']['shipping_city']);
	unset($fields['shipping']['shipping_email']);
	unset($fields['shipping']['shipping_state']);
	unset($fields['shipping']['shipping_address_2']);
	unset($fields['shipping']['shipping_country']);
	unset($fields['shipping']['shipping_postcode']);
	unset($fields['shipping']['shipping_company']);


  $fields['billing']['billing_details'] = array(
    'type' => 'textarea',
    'label' => 'Детали',
    'placeholder' => 'Примечания к Вашему заказу, например, особые пожелания отделу доставки.',
  );
  
	return $fields;
}


//корректное отображение пробела
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
  $pricemin = wc_price(  $product->get_variation_price( 'min', true ) );
  $pricemax = wc_price(  $product->get_variation_price( 'max', true ) );
    return $pricemin . '&nbsp;' . '–' . '&nbsp;' . $pricemax;
}
