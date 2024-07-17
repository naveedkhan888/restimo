<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Restimo Price Menu
 */
class Restimo_Price_Menu extends Widget_Base {

    // The get_name() method returns a widget name that will be used in the code.
    public function get_name() {
        return 'price_menu';
    }

    // The get_title() method returns the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Restimo Price Menu', 'restimo' );
    }

    // The get_icon() method lets you set the widget icon. Return the class name as a string.
    public function get_icon() {
        return 'eicon-menu-card';
    }

    // The get_categories method lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Price Menu', 'restimo' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Menu Item Title', 'restimo' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Menu item description goes here.', 'restimo' ),
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$10', 'restimo' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'restimo' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-menu-item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Title Typography', 'restimo' ),
                'selector' => '{{WRAPPER}} .price-menu-item-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .price-menu-item-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="price-menu-item" style="border: 1px solid <?php echo $settings['border_color']; ?>;">
            <div class="price-menu-item-image">
                <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
            </div>
            <div class="price-menu-item-content">
                <h4 class="price-menu-item-title" style="color: <?php echo $settings['title_color']; ?>;">
                    <?php echo $settings['title']; ?>
                </h4>
                <p class="price-menu-item-description">
                    <?php echo $settings['description']; ?>
                </p>
                <p class="price-menu-item-price">
                    <?php echo $settings['price']; ?>
                </p>
            </div>
        </div>
        <?php
    }

    public function get_keywords() {
        return [ 'menu', 'price', 'restaurant' ];
    }
}

// After the Restimo_Price_Menu class is defined, register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Restimo_Price_Menu() );
