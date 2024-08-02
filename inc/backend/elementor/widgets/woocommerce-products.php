<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

class Restimo_WooCommerce_Products extends Widget_Base {

    public function get_name() {
        return 'woocommerce_products';
    }

    public function get_title() {
        return __( 'WooCommerce Products', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-product-gallery';
    }

    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'restimo' ),
            ]
        );

        $this->add_control(
            'products',
            [
                'label' => __( 'Products', 'restimo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'product_id',
                        'label' => __( 'Product ID', 'restimo' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ product_id }}}',
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __( 'Style', 'restimo' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Product Title Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-products .product-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __( 'Product Price Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-products .product-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['products'] ) ) {
            echo '<div class="woocommerce-products">';
            foreach ( $settings['products'] as $item ) {
                $product_id = intval( $item['product_id'] );
                $product_obj = wc_get_product( $product_id );

                if ( $product_obj ) {
                    echo '<div class="product">';
                    echo '<h3 class="product-title">' . esc_html( $product_obj->get_name() ) . '</h3>';
                    echo '<p class="product-price">' . wp_kses_post( $product_obj->get_price_html() ) . '</p>';
                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }

    public function get_keywords() {
        return [ 'woocommerce', 'products', 'gallery' ];
    }
}

Plugin::instance()->widgets_manager->register( new Restimo_WooCommerce_Products() );
