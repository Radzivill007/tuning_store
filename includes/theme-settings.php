<?php 
if ( ! defined('ABSPATH')) {
    exit;
}
add_action( 'after_setup_theme', 'tuning_store_setup' );
function tuning_store_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
    
    add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 100,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

// add_action( 'after_setup_theme', 'tuning_store_content_width', 0 );
// function tuning_store_content_width() {
// 	$GLOBALS['content_width'] = apply_filters( 'tuning_store_content_width', 640 );
// }

function element5_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'element5' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'element5' ),
			'before_widget' => '<div class="catalog__filter-item">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="catalog__filter-btn"><span>',
			'after_title'   => '</span><img src="' . get_template_directory_uri() . '/assets/img/icons/caret-down.svg" alt=""></div>',
		)
	);
}

          

add_action( 'widgets_init', 'element5_widgets_init' );