<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Restimo_Price_Menu extends Widget_Base {

    public function get_name() {
        return 'restimo-price-menu';
    }

    public function get_title() {
        return __( 'Restimo Price Menu', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Price Menu', 'restimo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_item_title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Menu Item', 'restimo' ),
            ]
        );

        $repeater->add_control(
            'menu_item_description',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Menu item description', 'restimo' ),
            ]
        );

        $repeater->add_control(
            'menu_item_price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$20', 'restimo' ),
            ]
        );

        $repeater->add_control(
            'menu_item_discount',
            [
                'label' => __( 'Discount', 'restimo' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'restimo' ),
                'label_off' => __( 'Hide', 'restimo' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'menu_item_image',
            [
                'label' => __( 'Image', 'restimo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'menu_item_link',
            [
                'label' => __( 'Link', 'restimo' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'restimo' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'show_external' => true,
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __( 'Menu Items', 'restimo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'menu_item_title' => __( 'Menu Item #1', 'restimo' ),
                        'menu_item_description' => __( 'Description for menu item #1', 'restimo' ),
                        'menu_item_price' => __( '$20', 'restimo' ),
                    ],
                ],
                'title_field' => '{{{ menu_item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __( 'Normal', 'restimo' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __( 'Hover', 'restimo' ),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Hover Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu-item:hover .restimo-price-menu-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu-title',
            ]
        );

        // Description Style
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu-description',
            ]
        );

        // Price Style
        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu-price',
            ]
        );

        // Image Style
        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu-image img' => 'border-radius: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['menu_items'] ) {
            echo '<div class="restimo-price-menu">';
            foreach ( $settings['menu_items'] as $item ) {
                $target = $item['menu_item_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['menu_item_link']['nofollow'] ? ' rel="nofollow"' : '';
                echo '<div class="restimo-price-menu-item">';
                if ( $item['menu_item_image']['url'] ) {
                    echo '<div class="restimo-price-menu-image"><img src="' . esc_url( $item['menu_item_image']['url'] ) . '" alt="' . esc_attr( $item['menu_item_title'] ) . '"></div>';
                }
                echo '<div class="restimo-price-menu-content">';
                if ( $item['menu_item_title'] ) {
                    echo '<h3 class="restimo-price-menu-title"><a href="' . esc_url( $item['menu_item_link']['url'] ) . '" ' . $target . $nofollow . '>' . $item['menu_item_title'] . '</a></h3>';
                }
                if ( $item['menu_item_description'] ) {
                    echo '<p class="restimo-price-menu-description">' . $item['menu_item_description'] . '</p>';
                }
                if ( $item['menu_item_price'] ) {
                    echo '<div class="restimo-price-menu-price">';
                    if ( $item['menu_item_discount'] === 'yes' ) {
                        echo '<span class="restimo-price-menu-price-discount">' . $item['menu_item_price'] . '</span>';
                    } else {
                        echo $item['menu_item_price'];
                    }
                    echo '</div>';
                }
                echo '</div></div>';
            }
            echo '</div>';
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu() );
