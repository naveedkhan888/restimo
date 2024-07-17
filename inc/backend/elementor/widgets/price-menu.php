<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Restimo_Price_Menu extends Widget_Base {

    public function get_name() {
        return 'price-menu';
    }

    public function get_title() {
        return __( 'Restimo Price Menu', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Menu Items', 'restimo' ),
            ]
        );

        // Repeater Control for Menu Items
        $this->add_control(
            'menu_items',
            [
                'label' => __( 'Menu Items', 'restimo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'restimo' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Menu Item', 'restimo' ),
                    ],
                    [
                        'name' => 'description',
                        'label' => __( 'Description', 'restimo' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => '',
                    ],
                    [
                        'name' => 'price',
                        'label' => __( 'Price', 'restimo' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '$10.00',
                    ],
                    [
                        'name' => 'image',
                        'label' => __( 'Image', 'restimo' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => '',
                        ],
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Description Style
        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-item-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Price Style
        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-item-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="restimo-price-menu">
            <?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
                <div class="menu-item">
                    <?php if ( ! empty( $item['image']['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                    <?php endif; ?>
                    <h4 class="menu-item-title"><?php echo esc_html( $item['title'] ); ?></h4>
                    <p class="menu-item-description"><?php echo esc_html( $item['description'] ); ?></p>
                    <span class="menu-item-price"><?php echo esc_html( $item['price'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        _.each( settings.menu_items, function( item ) {
        #>
            <div class="menu-item">
                <# if ( item.image.url ) { #>
                    <img src="{{ item.image.url }}" alt="{{ item.title }}">
                <# } #>
                <h4 class="menu-item-title">{{ item.title }}</h4>
                <p class="menu-item-description">{{{ item.description }}}</p>
                <span class="menu-item-price">{{ item.price }}</span>
            </div>
        <#
        } );
        #>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu() );
