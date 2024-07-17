<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

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

        $repeater->add_control(
            'menu_item_discount',
            [
                'label' => __( 'Discount', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
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

        $this->add_control(
            'title_price_connector',
            [
                'label' => __( 'Title-Price Connector', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => ' - ',
            ]
        );

        $this->add_control(
            'title_separator',
            [
                'label' => __( 'Title Separator', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
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

        // Menu Item Container
        $this->start_controls_section(
            'menu_item_style',
            [
                'label' => __( 'Menu Item', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_item_background',
            [
                'label' => __( 'Background Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_item_border',
                'label' => __( 'Border', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item',
            ]
        );

        $this->add_control(
            'menu_item_border_radius',
            [
                'label' => __( 'Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'menu_item_padding',
            [
                'label' => __( 'Padding', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-title',
            ]
        );

        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'description_style',
            [
                'label' => __( 'Description', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-description',
            ]
        );

        $this->end_controls_section();

        // Price Style
        $this->start_controls_section(
            'price_style',
            [
                'label' => __( 'Price', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-price',
            ]
        );

        $this->end_controls_section();

        // Discount Style
        $this->start_controls_section(
            'discount_style',
            [
                'label' => __( 'Discount', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'discount_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-discount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'discount_typography',
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-discount',
            ]
        );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __( 'Size', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        <?php if ( $item['menu_item_image']['url'] ) : ?>
                            <div class="menu-item-image">
                                <img src="<?php echo esc_url( $item['menu_item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['menu_item_title'] ); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="menu-item-content">
                            <div class="menu-item-title"><?php echo esc_html( $item['menu_item_title'] ); ?></div>
                            <?php if ( ! empty( $settings['title_price_connector'] ) ) : ?>
                                <span class="title-price-connector"><?php echo esc_html( $settings['title_price_connector'] ); ?></span>
                            <?php endif; ?>
                            <div class="menu-item-price"><?php echo esc_html( $item['menu_item_price'] ); ?></div>
                            <?php if ( ! empty( $item['menu_item_discount'] ) ) : ?>
                                <div class="menu-item-discount"><?php echo esc_html( $item['menu_item_discount'] ); ?></div>
                            <?php endif; ?>
                            <div class="menu-item-description"><?php echo esc_html( $item['menu_item_description'] ); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu() );
