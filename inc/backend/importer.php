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
			'preview'    => get_template_directory_uri().'/inc/backend/data/main/home1.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/main/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/main/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/main/widgets.wie',
			//'sliders'    => get_template_directory_uri().'/inc/backend/data/main/sliders.zip',
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
			'name'       => 'Home Consulting',
			'preview'    => get_template_directory_uri().'/inc/backend/data/consulting/home2.jpg',
			'content'    => get_template_directory_uri().'/inc/backend/data/consulting/demo-content.xml',
			'customizer' => get_template_directory_uri().'/inc/backend/data/consulting/customizer.dat',
			'widgets'    => get_template_directory_uri().'/inc/backend/data/consulting/widgets.wie',
			//'sliders'    => get_template_directory_uri().'/inc/backend/data/consulting/sliders.zip',
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