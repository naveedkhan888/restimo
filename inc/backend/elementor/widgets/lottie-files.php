<?php
namespace Elementor;

// Ensure this file is only accessed via WordPress
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Lottie_Files_Widget extends Widget_Base {

    public function get_name() {
        return 'lottie_files_widget';
    }

    public function get_title() {
        return __( 'Lottie Files Widget', 'plugin-name' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        // Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'lottie_url',
            [
                'label' => __( 'Lottie JSON URL', 'plugin-name' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __( 'https://example.com/animation.json', 'plugin-name' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'plugin-name' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugin-name' ),
                'label_off' => __( 'No', 'plugin-name' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'plugin-name' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'plugin-name' ),
                'label_off' => __( 'No', 'plugin-name' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __( 'Speed', 'plugin-name' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => __( 'Width', 'plugin-name' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lottie-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __( 'Height', 'plugin-name' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lottie-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['lottie_url'] ) ) {
            $loop = $settings['loop'] === 'yes' ? 'true' : 'false';
            $autoplay = $settings['autoplay'] === 'yes' ? 'true' : 'false';
            $speed = ! empty( $settings['speed']['size'] ) ? $settings['speed']['size'] : 1;
            ?>
            <div class="lottie-container" style="width: 100%; height: 100%;">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
                <script>
                    lottie.loadAnimation({
                        container: document.querySelector('.lottie-container'), // the dom element
                        renderer: 'svg',
                        loop: <?php echo $loop; ?>,
                        autoplay: <?php echo $autoplay; ?>,
                        path: '<?php echo esc_url( $settings['lottie_url'] ); ?>', // the path to the animation json
                        rendererSettings: {
                            progressiveLoad: true,
                        },
                        animationSpeed: <?php echo $speed; ?>,
                    });
                </script>
            </div>
            <?php
        }
    }

    protected function _content_template() {
        ?>
        <# if ( settings.lottie_url ) { #>
            <div class="lottie-container" style="width: 100%; height: 100%;">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
                <script>
                    lottie.loadAnimation({
                        container: document.querySelector('.lottie-container'), // the dom element
                        renderer: 'svg',
                        loop: {{ settings.loop === 'yes' ? 'true' : 'false' }},
                        autoplay: {{ settings.autoplay === 'yes' ? 'true' : 'false' }},
                        path: '{{ settings.lottie_url }}', // the path to the animation json
                        rendererSettings: {
                            progressiveLoad: true,
                        },
                        animationSpeed: {{ settings.speed.size || 1 }},
                    });
                </script>
            </div>
        <# } #>
        <?php
    }
}

// Register the widget with Elementor
Plugin::instance()->widgets_manager->register_widget_type( new Lottie_Files_Widget() );
?>
