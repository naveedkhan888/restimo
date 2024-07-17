<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Restimo_Price_Menu extends Widget_Base {

    public function get_name() {
        return 'restimo-price-menu';
    }

    public function get_title() {
        return __( 'Restimo Price Menu', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-price-table';
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
            ]
        );

        // Repeater Control for Menu Items
        $repeater = new Repeater();

        $repeater->add_control(
            'menu_item_title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Menu Item', 'restimo' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_description',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'menu_item_price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
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
                        'menu_item_title' => __( 'Menu Item 1', 'restimo' ),
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

        // Menu Title
        $this->add_control(
            'menu_title_color',
            [
                'label' => __( 'Title Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Menu Description
        $this->add_control(
            'menu_description_color',
            [
                'label' => __( 'Description Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Menu Price
        $this->add_control(
            'menu_price_color',
            [
                'label' => __( 'Price Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Border Options
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_border',
                'label' => __( 'Border', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item',
            ]
        );

        $this->add_control(
            'menu_border_radius',
            [
                'label' => __( 'Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['menu_items'] ) {
            ?>
            <div class="restimo-price-menu">
                <?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
                    <div class="menu-item">
                        <div class="menu-item-title"><?php echo esc_html( $item['menu_item_title'] ); ?></div>
                        <div class="menu-item-description"><?php echo esc_html( $item['menu_item_description'] ); ?></div>
                        <div class="menu-item-price"><?php echo esc_html( $item['menu_item_price'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu() );
