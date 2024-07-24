<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Lottie_Animation_Widget extends Widget_Base {

    public function get_name() {
        return 'lottie_animation';
    }

    public function get_title() {
        return __( 'Lottie Animation', 'plugin-name' );
    }

    public function get_icon() {
        return 'eicon-animation';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $lottie_url = $settings['lottie_url'];
        $loop = $settings['loop'] === 'yes' ? 'true' : 'false';
        $autoplay = $settings['autoplay'] === 'yes' ? 'true' : 'false';

        if ( ! empty( $lottie_url ) ) {
            ?>
            <div class="lottie-animation">
                <lottie-player src="<?php echo esc_url( $lottie_url ); ?>" 
                               background="transparent" 
                               speed="1" 
                               loop="<?php echo esc_attr( $loop ); ?>" 
                               autoplay="<?php echo esc_attr( $autoplay ); ?>" 
                               style="width: 100%; height: auto;">
                </lottie-player>
            </div>
            <?php
        } else {
            echo '<p style="color: red;">' . __( 'Lottie URL is required.', 'plugin-name' ) . '</p>';
        }
    }

    protected function _content_template() {
        ?>
        <# if ( settings.lottie_url ) { #>
            <div class="lottie-animation">
                <lottie-player src="{{{ settings.lottie_url }}}" 
                               background="transparent" 
                               speed="1" 
                               loop="{{ settings.loop ? 'true' : 'false' }}" 
                               autoplay="{{ settings.autoplay ? 'true' : 'false' }}" 
                               style="width: 100%; height: auto;">
                </lottie-player>
            </div>
        <# } else { #>
            <p style="color: red;"><?php _e( 'Lottie URL is required.', 'plugin-name' ); ?></p>
        <# } #>
        <?php
    }
}

// Register the widget
Plugin::instance()->widgets_manager->register_widget_type( new Lottie_Animation_Widget() );

// Ensure the Lottie player library is loaded
function enqueue_lottie_player() {
    wp_enqueue_script( 'lottie-player', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js', [], null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_lottie_player' );
