<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Box
 */
class Restimo_Image_Box_Food extends Widget_Base {

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'Restimo_Image_Box_Food';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'XP Image Box Food', 'restimo' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'eicon-image-box';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {
        // Content Image box
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Image Box', 'restimo' ),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'restimo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'restimo' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'restimo' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'restimo' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_box',
            [
                'label' => esc_html__( 'Image Box', 'restimo' ),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_box_size',
                'exclude' => ['1536x1536', '2048x2048'],
                'include' => [],
                'default' => 'full',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Marketing Research', 'restimo' ),
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h5',
            ]
        );

        $this->add_control(
            'des',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Analysis of the market as a whole and its particular components (competitors, consumers, product, etc.)', 'restimo' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'restimo' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'restimo' ),
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'label_link',
            [
                'label' => 'Label Button',
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Explore More', 'restimo' ),
                'label_block' => true,
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        // Add Price Control
        $this->add_control(
            'price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '99.99', 'restimo' ),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /*** Style ***/

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __( 'Content', 'restimo' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // General
        $this->add_control(
            'heading_general',
            [
                'label' => __( 'General', 'restimo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'label' => __( 'Background', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __( 'Padding Box', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'radius_box',
            [
                'label' => __( 'Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .xp-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_box_shadow',
                'selector' => '{{WRAPPER}} .xp-image-box',
            ]
        );

        // Title
        $this->add_control(
            'heading_title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_space',
            [
                'label' => __( 'Spacing', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title-box a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'title_hcolor',
            [
                'label' => __( 'Hover Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title-box a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'link[url]!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title-box',
            ]
        );

        // Description
        $this->add_control(
            'heading_des',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'des_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .description-box' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}} .description-box',
            ]
        );

        // Price
        $this->add_control(
            'heading_price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .price-box' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .price-box',
            ]
        );

        $this->end_controls_section();

        /*** Advanced ***/

        $this->start_controls_section(
            'advanced_section',
            [
                'label' => __( 'Advanced', 'restimo' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $this->add_control(
            'custom_class',
            [
                'label' => __( 'CSS Classes', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your custom CSS class', 'restimo' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="xp-image-box <?php echo esc_attr($settings['custom_class']); ?>">
            <div class="image-box">
                <?php if ( ! empty( $settings['image_box']['url'] ) ) : ?>
                    <img src="<?php echo esc_url( $settings['image_box']['url'] ); ?>" alt="<?php esc_attr_e( 'Image', 'restimo' ); ?>" />
                <?php endif; ?>
            </div>
            <div class="content-box">
                <<?php echo tag_escape($settings['header_size']); ?> class="title-box">
                    <?php if ( ! empty( $settings['link']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $settings['link']['url'] ); ?>" target="<?php echo esc_attr( $settings['link']['is_external'] ? '_blank' : '' ); ?>" rel="<?php echo esc_attr( $settings['link']['nofollow'] ? 'nofollow' : '' ); ?>">
                            <?php echo esc_html( $settings['title'] ); ?>
                        </a>
                    <?php else : ?>
                        <?php echo esc_html( $settings['title'] ); ?>
                    <?php endif; ?>
                </<?php echo tag_escape($settings['header_size']); ?>>
                <div class="description-box">
                    <?php echo esc_html( $settings['des'] ); ?>
                </div>
                <?php if ( ! empty( $settings['price'] ) ) : ?>
                    <div class="price-box">
                        <?php echo esc_html( $settings['price'] ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $settings['label_link'] ) && ! empty( $settings['link']['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $settings['link']['url'] ); ?>" class="button" target="<?php echo esc_attr( $settings['link']['is_external'] ? '_blank' : '' ); ?>" rel="<?php echo esc_attr( $settings['link']['nofollow'] ? 'nofollow' : '' ); ?>">
                        <?php echo esc_html( $settings['label_link'] ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <# if ( settings.image_box.url ) { #>
            <div class="xp-image-box {{ settings.custom_class }}">
                <div class="image-box">
                    <img src="{{ settings.image_box.url }}" alt="<?php esc_attr_e( 'Image', 'restimo' ); ?>" />
                </div>
                <div class="content-box">
                    <{{ settings.header_size }} class="title-box">
                        <# if ( settings.link.url ) { #>
                            <a href="{{ settings.link.url }}" target="{{ settings.link.is_external ? '_blank' : '' }}" rel="{{ settings.link.nofollow ? 'nofollow' : '' }}">
                                {{ settings.title }}
                            </a>
                        <# } else { #>
                            {{ settings.title }}
                        </#>
                    </{{ settings.header_size }}>
                    <div class="description-box">
                        {{ settings.des }}
                    </div>
                    <# if ( settings.price ) { #>
                        <div class="price-box">
                            {{ settings.price }}
                        </div>
                    <# } #>
                    <# if ( settings.label_link && settings.link.url ) { #>
                        <a href="{{ settings.link.url }}" class="button" target="{{ settings.link.is_external ? '_blank' : '' }}" rel="{{ settings.link.nofollow ? 'nofollow' : '' }}">
                            {{ settings.label_link }}
                        </a>
                    <# } #>
                </div>
            </div>
        <# } #>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Image_Box_Food() );
