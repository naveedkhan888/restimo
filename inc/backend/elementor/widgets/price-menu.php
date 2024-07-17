<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Restimo_Price_Menu_Widget extends Widget_Base {

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
        return [ 'restimo-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_menu_items',
            [
                'label' => __( 'Menu Items', 'restimo' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_item_title',
            [
                'label' => __( 'Title', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Item Title', 'restimo' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_description',
            [
                'label' => __( 'Description', 'restimo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Item Description', 'restimo' ),
                'rows' => 5,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_price',
            [
                'label' => __( 'Price', 'restimo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$10.00',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'Paragraph',
                    'span' => 'Span',
                    'div' => 'Div',
                ],
                'default' => 'h4',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_description_html_tag',
            [
                'label' => __( 'Description HTML Tag', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'Paragraph',
                    'span' => 'Span',
                    'div' => 'Div',
                ],
                'default' => 'p',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_image',
            [
                'label' => __( 'Image', 'restimo' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_link',
            [
                'label' => __( 'Link', 'restimo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __( 'Menu Items', 'restimo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ menu_item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Controls

        $this->start_controls_section(
            'section_style_list',
            [
                'label' => __( 'List Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-title',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Price Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => __( 'Typography', 'restimo' ),
                'selector' => '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-price',
            ]
        );

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
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-separator' => 'border-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => __( 'Separator Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-separator' => 'border-color: {{VALUE}};',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => __( 'Image Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

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
                    '{{WRAPPER}} .restimo-price-menu .menu-item .menu-item-content' => 'margin-left: calc({{SIZE}}{{UNIT}} / 2); margin-right: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_item',
            [
                'label' => __( 'Item Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

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
                    'center' => [
                        'title' => __( 'Center', 'restimo' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'restimo' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
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
                <?php foreach ( $settings['menu_items'] as $item ) : ?>
                    <div class="menu-item">
                        <?php if ( ! empty( $item['menu_item_image']['url'] ) ) : ?>
                            <div class="menu-item-image">
                                <img src="<?php echo esc_url( $item['menu_item_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['menu_item_title'] ); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="menu-item-content">
                            <<?php echo esc_attr( $item['menu_item_title_html_tag'] ); ?> class="menu-item-title"><?php echo esc_html( $item['menu_item_title'] ); ?></<?php echo esc_attr( $item['menu_item_title_html_tag'] ); ?>>
                            <<?php echo esc_attr( $item['menu_item_description_html_tag'] ); ?> class="menu-item-description"><?php echo esc_html( $item['menu_item_description'] ); ?></<?php echo esc_attr( $item['menu_item_description_html_tag'] ); ?>>
                            <div class="menu-item-price"><?php echo esc_html( $item['menu_item_price'] ); ?></div>
                            <?php if ( ! empty( $item['menu_item_link']['url'] ) ) : ?>
                                <div class="menu-item-link">
                                    <a href="<?php echo esc_url( $item['menu_item_link']['url'] ); ?>" <?php echo ( $item['menu_item_link']['is_external'] ? 'target="_blank"' : '' ); ?> <?php echo ( $item['menu_item_link']['nofollow'] ? 'rel="nofollow"' : '' ); ?>><?php _e( 'Read More', 'restimo' ); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
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
            _.each( settings.menu_items, function( item ) {
            #>
            <div class="menu-item">
                <#
                if ( item.menu_item_image && item.menu_item_image.url ) {
                #>
                <div class="menu-item-image">
                    <img src="{{ item.menu_item_image.url }}" alt="{{ item.menu_item_title }}">
                </div>
                <#
                }
                #>
                <div class="menu-item-content">
                    <<?php echo '{{ item.menu_item_title_html_tag }}'; ?> class="menu-item-title">{{{ item.menu_item_title }}}</<?php echo '{{ item.menu_item_title_html_tag }}'; ?>>
                    <<?php echo '{{ item.menu_item_description_html_tag }}'; ?> class="menu-item-description">{{{ item.menu_item_description }}}</<?php echo '{{ item.menu_item_description_html_tag }}'; ?>>
                    <div class="menu-item-price">{{{ item.menu_item_price }}}</div>
                    <#
                    if ( item.menu_item_link && item.menu_item_link.url ) {
                    #>
                    <div class="menu-item-link">
                        <a href="{{ item.menu_item_link.url }}" <?php echo '{{ item.menu_item_link.is_external ? \'target="_blank"\' : \'\' }}'; ?> <?php echo '{{ item.menu_item_link.nofollow ? \'rel="nofollow"\' : \'\' }}'; ?>>{{ settings.read_more_text }}</a>
                    </div>
                    <#
                    }
                    #>
                </div>
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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Restimo_Price_Menu_Widget() );
