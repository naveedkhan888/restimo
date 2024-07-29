<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Custom Divider
 */
class Custom_Divider extends Widget_Base {

    public function get_name() {
        return 'custom_divider';
    }

    public function get_title() {
        return __( 'Custom Divider', 'custom' );
    }

    public function get_icon() {
        return 'eicon-divider';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'custom' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'custom' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => __( 'Solid', 'custom' ),
                    'dotted' => __( 'Dotted', 'custom' ),
                    'dashed' => __( 'Dashed', 'custom' ),
                    'double' => __( 'Double', 'custom' ),
                ],
                'default' => 'solid',
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => __( 'Width', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'custom' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'add_element',
            [
                'label' => __( 'Add Element', 'custom' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'custom' ),
                    'text' => __( 'Text', 'custom' ),
                    'icon' => __( 'Icon', 'custom' ),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'text_content',
            [
                'label' => __( 'Text Content', 'custom' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'add_element' => 'text',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon', 'custom' ),
                'type' => Controls_Manager::ICONS,
                'condition' => [
                    'add_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', 'custom' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                ],
                'default' => 'center',
                'condition' => [
                    'add_element' => 'icon',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'custom' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Color', 'custom' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-line' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label' => __( 'Size', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-line' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'gap',
            [
                'label' => __( 'Gap', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Text Styles
        $this->start_controls_section(
            'text_style',
            [
                'label' => __( 'Text Style', 'custom' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'add_element' => 'text',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'custom' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_typography',
            [
                'label' => __( 'Typography', 'custom' ),
                'type' => Controls_Manager::TYPOGRAPHY,
                'selectors' => [
                    '{{WRAPPER}} .divider-text' => 'typography: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_spacing',
            [
                'label' => __( 'Text Spacing', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-text' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Styles
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon Style', 'custom' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'add_element' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'custom' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .divider-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-icon' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_rotation',
            [
                'label' => __( 'Icon Rotation', 'custom' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-icon i' => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $icon_html = '';
        if ( ! empty( $settings['icon']['value'] ) ) {
            $icon_html = '<div class="divider-icon" style="text-align: ' . esc_attr( $settings['icon_position'] ) . ';">' . Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ) . '</div>';
        }

        $text_html = '';
        if ( ! empty( $settings['text_content'] ) ) {
            $text_html = '<div class="divider-text" style="text-align: ' . esc_attr( $settings['icon_position'] ) . ';">' . esc_html( $settings['text_content'] ) . '</div>';
        }

        ?>
        <div class="custom-divider">
            <div class="divider-line" style="border-style: <?php echo esc_attr( $settings['style'] ); ?>; width: <?php echo esc_attr( $settings['width']['size'] . $settings['width']['unit'] ); ?>;"></div>
            <?php echo $text_html; ?>
            <?php echo $icon_html; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var iconHtml = '';
        if ( settings.icon.value ) {
            iconHtml = '<div class="divider-icon" style="text-align: ' + settings.icon_position + ';">' + elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': 'true' }, 'i' ) + '</div>';
        }

        var textHtml = '';
        if ( settings.text_content ) {
            textHtml = '<div class="divider-text" style="text-align: ' + settings.icon_position + ';">' + settings.text_content + '</div>';
        }
        #>
        <div class="custom-divider">
            <div class="divider-line" style="border-style: {{ settings.style }}; width: {{ settings.width.size + settings.width.unit }};"></div>
            {{{ textHtml }}}
            {{{ iconHtml }}}
        </div>
        <?php
    }
}

// Register the Custom Divider widget
Plugin::instance()->widgets_manager->register_widget_type( new Custom_Divider() );
