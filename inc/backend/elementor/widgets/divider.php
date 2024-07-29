<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Widget Name: XP Divider
 */
class Restimo_Divider extends Widget_Base {

    public function get_name() {
        return 'restimo_divider';
    }

    public function get_title() {
        return __( 'XP Divider', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-divider';
    }

    public function get_categories() {
        return [ 'category_restimo' ];
    }

    protected function register_controls() {
        // Divider Section
        $this->start_controls_section(
            'divider_section',
            [
                'label' => __( 'Divider', 'restimo' ),
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => __( 'Style', 'restimo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'solid' => __( 'Solid', 'restimo' ),
                    'dashed' => __( 'Dashed', 'restimo' ),
                    'dotted' => __( 'Dotted', 'restimo' ),
                ],
            ]
        );

        $this->add_control(
            'divider_weight',
            [
                'label' => __( 'Weight', 'restimo' ),
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
                    '{{WRAPPER}} .divider' => 'border-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_width',
            [
                'label' => __( 'Width', 'restimo' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_alignment',
            [
                'label' => __( 'Alignment', 'restimo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
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
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Section
        $this->start_controls_section(
            'icon_section',
            [
                'label' => __( 'Icon', 'restimo' ),
            ]
        );

        $this->add_control(
            'divider_icon',
            [
                'label' => __( 'Icon', 'restimo' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'restimo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .divider-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .divider-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'restimo' ),
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
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="divider" style="border-style: <?php echo esc_attr($settings['divider_style']); ?>; border-width: <?php echo esc_attr($settings['divider_weight']['size']); ?>px; border-color: <?php echo esc_attr($settings['divider_color']); ?>; width: <?php echo esc_attr($settings['divider_width']['size']); ?>%; text-align: <?php echo esc_attr($settings['divider_alignment']); ?>;">
            <?php if ( ! empty( $settings['divider_icon']['value'] ) ) : ?>
                <span class="divider-icon">
                    <?php Icons_Manager::render_icon( $settings['divider_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="divider" style="border-style: {{{ settings.divider_style }}}; border-width: {{{ settings.divider_weight.size }}}px; border-color: {{{ settings.divider_color }}}; width: {{{ settings.divider_width.size }}}%; text-align: {{{ settings.divider_alignment }}};">
            <# if ( settings.divider_icon.value ) { #>
                <span class="divider-icon">
                    <i class="{{{ settings.divider_icon.value }}}"></i>
                </span>
            <# } #>
        </div>
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register( new Restimo_Divider() );

