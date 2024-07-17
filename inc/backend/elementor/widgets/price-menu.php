<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Restimo_Price_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'restimo_price_menu';
    }

    public function get_title() {
        return __( 'Restimo Price Menu', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-price-list'; // You can choose a different icon if needed
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
            'title',
            [
                'label' => __( 'Title', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Item Title', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => __( 'Price', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$0.00',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'text-domain' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Item Description', 'text-domain' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'text-domain' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
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
            'price_menu_items',
            [
                'label' => __( 'Price Menu Items', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __( 'Item 1', 'text-domain' ),
                        'price' => '$10.00',
                        'description' => __( 'Description for Item 1', 'text-domain' ),
                    ],
                    [
                        'title' => __( 'Item 2', 'text-domain' ),
                        'price' => '$15.00',
                        'description' => __( 'Description for Item 2', 'text-domain' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
                    '{{WRAPPER}} .restimo-price-menu .price-menu-item .price-menu-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .price-menu-item .price-menu-price' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .restimo-price-menu .price-menu-item .price-menu-title-separator' => 'border-style: {{VALUE}};',
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
                    '{{WRAPPER}} .restimo-price-menu .price-menu-item' => 'margin-bottom: {{TOP}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['price_menu_items'] ) {
            ?>
            <div class="restimo-price-menu">
                <?php foreach ( $settings['price_menu_items'] as $index => $item ) : ?>
                    <div class="price-menu-item">
                        <div class="price-menu-content">
                            <div class="price-menu-header">
                                <h4 class="price-menu-title"><?php echo $item['title']; ?></h4>
                                <span class="price-menu-title-separator"></span>
                                <div class="price-menu-price-wrap">
                                    <span class="price-menu-price"><?php echo $item['price']; ?></span>
                                </div>
                            </div>
                            <div class="price-menu-desc">
                                <p><?php echo $item['description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }

    protected function _content_template() {
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu_Widget() );
