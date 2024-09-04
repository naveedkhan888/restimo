<?php
/**
 * Hooks for importer
 *
 * @package Restimo
 */


/**
 * Importer the demo content
 *
 * @since  1.0
 *
 */
function restimo_importer() {
	return array(
		array(
			'name'       => 'Home Main',
			'preview'    => get_template_directory_uri().'/inc/backend/data/maintheme/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/maintheme/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/maintheme/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/maintheme/widgets.wie',
			//'sliders'    => '/inc/backend/data/main/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Restaurant 1',
			'preview'    => get_template_directory_uri().'/inc/backend/data/restaurant/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/restaurant/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/restaurant/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/restaurant/widgets.wie',
			'sliders'    => 'https://dpsample.com/restaurant-slider/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Coffee 1',
			'preview'    => get_template_directory_uri().'/inc/backend/data/coffee/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/coffee/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/coffee/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/coffee/widgets.wie',
			'sliders'    => 'https://dpsample.com/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Pizza',
			'preview'    => get_template_directory_uri().'/inc/backend/data/pizza/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/pizza/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/pizza/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/pizza/widgets.wie',
			//'sliders'    => '://dpsample.com/sliders-coffee.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Juice',
			'preview'    => get_template_directory_uri().'/inc/backend/data/juice/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/juice/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/juice/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/juice/widgets.wie',
			//'sliders'    => '://dpsample.com/sliders-coffee.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
		array(
			'name'       => 'Ice Cream',
			'preview'    => get_template_directory_uri().'/inc/backend/data/ice/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/ice/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/ice/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/ice/widgets.wie',
			//'sliders'    => '://dpsample.com/sliders-coffee.zip',
			'pages'      => array(
				'front_page' => 'Home',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
			'menus'      => array(
				'primary'   => 'main-menu',
			)
		),
	);
}

add_filter( 'soo_demo_packages', 'restimo_importer', 30 );