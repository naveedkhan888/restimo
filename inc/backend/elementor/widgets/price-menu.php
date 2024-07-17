<?php
/**
 * Plugin Name: Custom Price Menu Widget
 * Description: Custom Elementor widget for price menus.
 * Version: 1.0.0
 */

namespace Stratum;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Custom_Price_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'custom_price_menu';
    }

    public function get_title() {
        return __( 'Custom Price Menu', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-price-list'; // Customize as needed
    }

    public function get_categories() {
        return [ 'general' ]; // Adjust category as per your needs
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Price Menu Items', 'text-domain' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_title',
            [
                'label' => __( 'Title', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Menu Item', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_price',
            [
                'label' => __( 'Price', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$0.00',
            ]
        );

        $repeater->add_control(
            'menu_description',
            [
                'label' => __( 'Description', 'text-domain' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Item Description', 'text-domain' ),
            ]
        );

        $repeater->add_control(
            'menu_image',
            [
                'label' => __( 'Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_link',
            [
                'label' => __( 'Link', 'text-domain' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'text-domain' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __( 'Price Menu Items', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu_title' => __( 'Item 1', 'text-domain' ),
                        'menu_price' => '$10.00',
                        'menu_description' => __( 'Description for Item 1', 'text-domain' ),
                    ],
                    [
                        'menu_title' => __( 'Item 2', 'text-domain' ),
                        'menu_price' => '$15.00',
                        'menu_description' => __( 'Description for Item 2', 'text-domain' ),
                    ],
                ],
                'title_field' => '{{{ menu_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-price-menu .price-menu-item .menu-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-price-menu .price-menu-item .menu-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_style',
            [
                'label' => __( 'Separator Style', 'text-domain' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'text-domain' ),
                    'dotted' => __( 'Dotted', 'text-domain' ),
                    'dashed' => __( 'Dashed', 'text-domain' ),
                    'double' => __( 'Double', 'text-domain' ),
                    'none' => __( 'None', 'text-domain' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-price-menu .price-menu-item' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_spacing',
            [
                'label' => __( 'Item Spacing', 'text-domain' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-price-menu .price-menu-item' => 'margin-bottom: {{TOP}}{{UNIT}};',
                ],
            ]
        );

        // Add more styling controls as needed

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['menu_items'] ) {
            ?>
            <div class="custom-price-menu">
                <?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
                    <div class="price-menu-item">
                        <h4 class="menu-title"><?php echo $item['menu_title']; ?></h4>
                        <div class="menu-price"><?php echo $item['menu_price']; ?></div>
                        <div class="menu-description"><?php echo $item['menu_description']; ?></div>
                        <?php if ( ! empty( $item['menu_image']['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $item['menu_image']['url'] ); ?>" alt="<?php echo esc_attr( Utils::get_image_alt( $item['menu_image'] ) ); ?>" class="menu-image" />
                        <?php endif; ?>
                        <?php if ( ! empty( $item['menu_link']['url'] ) ) : ?>
                            <a href="<?php echo esc_url( $item['menu_link']['url'] ); ?>" class="menu-link" target="<?php echo esc_attr( $item['menu_link']['is_external'] ? '_blank' : '_self' ); ?>"><?php echo esc_html( $item['menu_link']['title'] ); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }

}

// Register the widget
add_action( 'elementor/widgets/widgets_registered', function() {
    Plugin::instance()->widgets_manager->register_widget_type( new Custom_Price_Menu_Widget() );
} );
