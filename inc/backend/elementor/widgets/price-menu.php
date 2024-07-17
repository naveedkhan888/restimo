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
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_description',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Menu item description', 'restimo' ),
                'rows' => 5,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '$20', 'restimo' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => __( 'H1', 'restimo' ),
                    'h2' => __( 'H2', 'restimo' ),
                    'h3' => __( 'H3', 'restimo' ),
                    'h4' => __( 'H4', 'restimo' ),
                    'h5' => __( 'H5', 'restimo' ),
                    'h6' => __( 'H6', 'restimo' ),
                    'p' => __( 'Paragraph', 'restimo' ),
                    'span' => __( 'Span', 'restimo' ),
                    'div' => __( 'Div', 'restimo' ),
                ],
            ]
        );

        $repeater->add_control(
            'menu_item_description_html_tag',
            [
                'label' => __( 'Description HTML Tag', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => __( 'H1', 'restimo' ),
                    'h2' => __( 'H2', 'restimo' ),
                    'h3' => __( 'H3', 'restimo' ),
                    'h4' => __( 'H4', 'restimo' ),
                    'h5' => __( 'H5', 'restimo' ),
                    'h6' => __( 'H6', 'restimo' ),
                    'p' => __( 'Paragraph', 'restimo' ),
                    'span' => __( 'Span', 'restimo' ),
                    'div' => __( 'Div', 'restimo' ),
                ],
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
                'label_block' => true,
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
                'label_block' => true,
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

        // List Style
        $this->add_control(
            'list_background_color',
            [
                'label' => __( 'Background Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'label' => __( 'Border', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_box_shadow',
                'label' => __( 'Box Shadow', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu',
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label' => __( 'Padding', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu' => 'padding: {{TOP}} {{RIGHT}} {{BOTTOM}} {{LEFT}};',
                ],
            ]
        );

        // Title Style
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'restimo' ),
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
                'label' => __( 'Title Typography', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-title',
            ]
        );

        // Price Style
        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'restimo' ),
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
                'label' => __( 'Price Typography', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item-price',
            ]
        );

        // Separator Style
        $this->add_control(
            'separator_style',
            [
                'label' => __( 'Separator Style', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'restimo' ),
                    'dotted' => __( 'Dotted', 'restimo' ),
                    'dashed' => __( 'Dashed', 'restimo' ),
                    'double' => __( 'Double', 'restimo' ),
                    'none' => __( 'None', 'restimo' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-separator' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_weight',
            [
                'label' => __( 'Separator Weight', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-separator' => 'border-width: {{SIZE}}px;',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => __( 'Separator Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-separator' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'separator_style!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing',
            [
                'label' => __( 'Separator Spacing', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Image Style
        $this->add_control(
            'image_resolution',
            [
                'label' => __( 'Image Resolution', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'thumbnail' => __( 'Thumbnail', 'restimo' ),
                    'medium' => __( 'Medium', 'restimo' ),
                    'large' => __( 'Large', 'restimo' ),
                    'full' => __( 'Full', 'restimo' ),
                    'custom' => __( 'Custom', 'restimo' ),
                ],
                'default' => 'thumbnail',
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_custom_size',
            [
                'label' => __( 'Custom Image Size', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image img' => 'width: {{WIDTH}}{{UNIT}}; height: {{HEIGHT}}{{UNIT}};',
                ],
                'condition' => [
                    'image_resolution' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Image Border Radius', 'restimo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_spacing',
            [
                'label' => __( 'Image Spacing', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item-image' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Item Style
        $this->add_responsive_control(
            'rows_gap',
            [
                'label' => __( 'Rows Gap', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'vertical_align',
            [
                'label' => __( 'Vertical Align', 'restimo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __( 'Top', 'restimo' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'restimo' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'middle' => [
                        'title' => __( 'Middle', 'restimo' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item' => 'vertical-align: {{VALUE}};',
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
                <?php foreach ( $settings['menu_items'] as $index => $item ) :
                    $item_title_tag = ! empty( $item['menu_item_title_html_tag'] ) ? $item['menu_item_title_html_tag'] : 'h4';
                    $item_desc_tag = ! empty( $item['menu_item_description_html_tag'] ) ? $item['menu_item_description_html_tag'] : 'p';
                    ?>
                    <div class="menu-item">
                        <<?php echo esc_html( $item_title_tag ); ?> class="menu-item-title"><?php echo esc_html( $item['menu_item_title'] ); ?></<?php echo esc_html( $item_title_tag ); ?>>
                        <<?php echo esc_html( $item_desc_tag ); ?> class="menu-item-description"><?php echo esc_html( $item['menu_item_description'] ); ?></<?php echo esc_html( $item_desc_tag ); ?>>
                        <div class="menu-item-price"><?php echo esc_html( $item['menu_item_price'] ); ?></div>
                        <?php if ( ! empty( $item['menu_item_image']['url'] ) ) : ?>
                            <div class="menu-item-image">
                                <img src="<?php echo esc_url( $item['menu_item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['menu_item_title'] ); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $item['menu_item_link']['url'] ) ) : ?>
                            <div class="menu-item-link">
                                <a href="<?php echo esc_url( $item['menu_item_link']['url'] ); ?>" <?php echo $item['menu_item_link']['is_external'] ? 'target="_blank"' : ''; ?> <?php echo $item['menu_item_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>><?php _e( 'Read More', 'restimo' ); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="menu-item-separator"></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }

    protected function _content_template() {
    ?>
    <#
    if ( settings.menu_items ) {
    #>
        <div class="restimo-price-menu">
            <#
            _.each( settings.menu_items, function( item, index ) {
                var itemTitleTag = item.menu_item_title_html_tag || 'h4';
                var itemDescTag = item.menu_item_description_html_tag || 'p';
            #>
                <div class="menu-item">
                    <<?= itemTitleTag ?> class="menu-item-title">{{{ item.menu_item_title }}}</<?= itemTitleTag ?>>
                    <<?= itemDescTag ?> class="menu-item-description">{{{ item.menu_item_description }}}</<?= itemDescTag ?>>
                    <div class="menu-item-price">{{{ item.menu_item_price }}}</div>
                    <# if ( item.menu_item_image.url ) { #>
                        <div class="menu-item-image">
                            <img src="{{ item.menu_item_image.url }}" alt="{{{ item.menu_item_title }}}">
                        </div>
                    <# } #>
                    <# if ( item.menu_item_link.url ) { #>
                        <div class="menu-item-link">
                            <a href="{{ item.menu_item_link.url }}" {{{ item.menu_item_link.is_external ? 'target="_blank"' : '' }}} {{{ item.menu_item_link.nofollow ? 'rel="nofollow"' : '' }}}><?php _e( 'Read More', 'restimo' ); ?></a>
                        </div>
                    <# } #>
                    <div class="menu-item-separator"></div>
                </div>
            <#
            });
            #>
        </div>
    <#
    }
    #>
    <?php
    }
}
