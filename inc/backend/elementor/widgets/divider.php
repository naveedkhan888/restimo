<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Widget Name: Custom Divider
 */
class Custom_Divider extends Widget_Base {

    public function get_name() {
        return 'custom_divider';
    }

    public function get_title() {
        return __( 'Custom Divider', 'custom-elementor' );
    }

    public function get_icon() {
        return 'eicon-divider';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_divider',
            [
                'label' => __( 'Divider', 'custom-elementor' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'custom-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid' => __( 'Solid', 'custom-elementor' ),
                    'double' => __( 'Double', 'custom-elementor' ),
                    'dotted' => __( 'Dotted', 'custom-elementor' ),
                    'dashed' => __( 'Dashed', 'custom-elementor' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'border-top-style: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'weight',
            [
                'label' => __( 'Weight', 'custom-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'border-top-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Color', 'custom-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'border-top-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __( 'Width', 'custom-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ '%', 'px', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'custom-elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'custom-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'custom-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'custom-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'margin-left: auto; margin-right: auto;',
                    '{{WRAPPER}}.elementor-align-left .divider' => 'margin-left: 0; margin-right: auto;',
                    '{{WRAPPER}}.elementor-align-right .divider' => 'margin-right: 0; margin-left: auto;',
                ],
            ]
        );

        $this->add_control(
            'divider_icon',
            [
                'label' => __( 'Icon', 'custom-elementor' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', 'custom-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'left' => __( 'Left', 'custom-elementor' ),
                    'center' => __( 'Center', 'custom-elementor' ),
                    'right' => __( 'Right', 'custom-elementor' ),
                ],
                'condition' => [
                    'divider_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'custom-elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .divider-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .divider-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'divider_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'custom-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .divider-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'divider_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'divider', 'class', 'divider' );

        $icon_html = '';
        if ( ! empty( $settings['divider_icon']['value'] ) ) {
            $icon_html = '<span class="divider-icon">';
            $icon_html .= Icons_Manager::render_icon( $settings['divider_icon'], [ 'aria-hidden' => 'true' ] );
            $icon_html .= '</span>';
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'divider' ); ?>>
            <?php if ( $settings['icon_position'] === 'left' ) : ?>
                <?php echo $icon_html; ?>
            <?php endif; ?>
            <span class="divider-line"></span>
            <?php if ( $settings['icon_position'] === 'center' ) : ?>
                <?php echo $icon_html; ?>
            <?php endif; ?>
            <span class="divider-line"></span>
            <?php if ( $settings['icon_position'] === 'right' ) : ?>
                <?php echo $icon_html; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <# var iconHTML = elementor.helpers.renderIcon( view, settings.divider_icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
        <div class="divider">
            <# if ( settings.icon_position === 'left' && settings.divider_icon.value ) { #>
                {{{ iconHTML.value }}}
            <# } #>
            <span class="divider-line"></span>
            <# if ( settings.icon_position === 'center' && settings.divider_icon.value ) { #>
                {{{ iconHTML.value }}}
            <# } #>
            <span class="divider-line"></span>
            <# if ( settings.icon_position === 'right' && settings.divider_icon.value ) { #>
                {{{ iconHTML.value }}}
            <# } #>
        </div>
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register( new Custom_Divider() );
