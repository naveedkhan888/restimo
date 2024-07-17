<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Custom_Price_Menu_Widget extends Widget_Base {

    public function get_name() {
        return 'custom-price-menu';
    }

    public function get_title() {
        return __( 'Custom Price Menu', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'general' ]; // Adjust category as needed
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_menu_items',
            [
                'label' => __( 'Menu Items', 'text-domain' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'menu_item_title',
            [
                'label' => __( 'Title', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Item Title', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_description',
            [
                'label' => __( 'Description', 'text-domain' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Item Description', 'text-domain' ),
                'rows' => 5,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'menu_item_price',
            [
                'label' => __( 'Price', 'text-domain' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$10.00',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => __( 'Menu Items', 'text-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ menu_item_title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Controls

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __( 'Title', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-title-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_typography',
            [
                'label' => __( 'Typography', 'text-domain' ),
                'type' => Controls_Manager::TYPOGRAPHY,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-title-text' => '{{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_price',
            [
                'label' => __( 'Price', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_typography',
            [
                'label' => __( 'Typography', 'text-domain' ),
                'type' => Controls_Manager::TYPOGRAPHY,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-price' => '{{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_description',
            [
                'label' => __( 'Description', 'text-domain' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'text-domain' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-desc p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_typography',
            [
                'label' => __( 'Typography', 'text-domain' ),
                'type' => Controls_Manager::TYPOGRAPHY,
                'selectors' => [
                    '{{WRAPPER}} .ha-price-menu .ha-price-menu-item .ha-price-menu-desc p' => '{{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['menu_items'] ) {
            ?>
            <div class="ha-price-menu">
                <?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
                    <div class="ha-price-menu-item">
                        <div class="ha-price-menu-content">
                            <div class="ha-price-menu-header">
                                <h4 class="ha-price-menu-title">
                                    <span class="ha-price-menu-title-text"><?php echo esc_html( $item['menu_item_title'] ); ?></span>
                                </h4>
                                <span class="ha-price-title-separator"></span>
                                <div class="ha-price-menu-price-wrap">
                                    <span class="ha-price-menu-price"><?php echo esc_html( $item['menu_item_price'] ); ?></span>
                                </div>
                            </div>
                            <div class="ha-price-menu-desc">
                                <p><?php echo esc_html( $item['menu_item_description'] ); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }

    protected function _content_template() {
        ?>
        <div class="ha-price-menu">
            <#
            _.each( settings.menu_items, function( item ) {
            #>
            <div class="ha-price-menu-item">
                <div class="ha-price-menu-content">
                    <div class="ha-price-menu-header">
                        <h4 class="ha-price-menu-title">
                            <span class="ha-price-menu-title-text">{{{ item.menu_item_title }}}</span>
                        </h4>
                        <span class="ha-price-title-separator"></span>
                        <div class="ha-price-menu-price-wrap">
                            <span class="ha-price-menu-price">{{{ item.menu_item_price }}}</span>
                        </div>
                    </div>
                    <div class="ha-price-menu-desc">
                        <p>{{{ item.menu_item_description }}}</p>
                    </div>
                </div>
            </div>
            <#
            });
            #>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Custom_Price_Menu_Widget() );
