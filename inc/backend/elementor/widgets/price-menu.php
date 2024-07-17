<?php


namespace Restimo;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Controls_Manager;
use Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Price_Menu extends Restimo_Widget_Base {
    protected $widget_name = 'price-menu';

    public function __construct($data = [], $args = null) {
        parent::__construct( $data, $args );
    }

    public function get_title() {
        return esc_html__( 'Price Menu', 'restimo' );
    }

    public function get_icon() {
        return 'eicon-price-list';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function register_controls() {
        $controls = $this;

        /*-----------------------------------------------------------------------------------*/
        /*  Content Tab
        /*-----------------------------------------------------------------------------------*/

        $controls->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'restimo' )
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'menu_title',
                [
                    'label' => esc_html__( 'Title', 'restimo' ),
                    'type'  => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'label_block' => true,
                    'placeholder' => esc_html__( 'Title', 'restimo' ),
                    'default' => esc_html__( 'Title', 'restimo' )
                ]
            );

            $repeater->add_control(
                'title_html_tag',
                [
                    'label' => esc_html__( 'Title HTML Tag', 'restimo' ),
                    'type'  => Controls_Manager::SELECT,
                    'options' => [
                        'h1'   => esc_html__( 'H1'  , 'restimo' ),
                        'h2'   => esc_html__( 'H2'  , 'restimo' ),
                        'h3'   => esc_html__( 'H3'  , 'restimo' ),
                        'h4'   => esc_html__( 'H4'  , 'restimo' ),
                        'h5'   => esc_html__( 'H5', 'restimo' ),
                        'h6'   => esc_html__( 'H6'  , 'restimo' ),
                        'div'  => esc_html__( 'div' , 'restimo' ),
                        'span' => esc_html__( 'span', 'restimo' ),
                        'p'    => esc_html__( 'p'   , 'restimo' )
                    ],
                    'default' => 'span'
                ]
            );

            $repeater->add_control(
                'menu_description',
                [
                    'label'       => esc_html__( 'Description', 'restimo' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'dynamic'     => [
                        'active'  => true,
                    ],
                    'label_block' => true,
                    'placeholder' => esc_html__( 'Description', 'restimo' ),
                    'default'     => esc_html__( 'Description', 'restimo' )
                ]
            );

            $repeater->add_control(
                'menu_price',
                [
                    'label' => esc_html__( 'Price', 'restimo' ),
                    'type'  => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => '$49'
                ]
            );

            $repeater->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Title Color', 'restimo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .restimo-price-menu__title' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $repeater->add_control(
                'price_color',
                [
                    'label' => esc_html__( 'Price Color', 'restimo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .restimo-price-menu__price' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $repeater->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Description Color', 'restimo' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .restimo-price-menu__description' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $repeater->add_control(
                'show_image',
                [
                    'label' => esc_html__( 'Show Image', 'restimo' ),
                    'type'  => Controls_Manager::SWITCHER,
                    'default' => '',
                    'label_on'  => esc_html__( 'On', 'restimo' ),
                    'label_off' => esc_html__( 'Off', 'restimo' ),
                    'return_value' => 'yes'
                ]
            );

            $repeater->add_control(
                'image_size',
                [
                    'label'   => esc_html__( 'Image Size', 'restimo' ),
                    'type'    => 'select',
                    'default' => 'full',
                    'options' => Restimo::get_instance()->get_scripts_manager()->get_image_sizes(),
                    'condition' => [
                        'show_image' => 'yes'
                    ]
                ]
            );

            $repeater->add_control(
                'image_align',
                [
                    'label' => esc_html__( 'Image Alignment', 'restimo' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'left',
                    'toggle' => false,
                    'options' => [
                        'left'    => [
                            'title' => esc_html__( 'Left', 'restimo' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'restimo' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'condition' => [
                        'show_image' => 'yes'
                    ]
                ]
            );

            $repeater->add_control(
                'image',
                [
                    'label' => esc_html__( 'Image', 'restimo' ),
                    'type'  => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src()
                    ],
                    'dynamic' => [
                        'active' => true
                    ],
                    'condition' => [
                        'show_image' => 'yes'
                    ]
                ]
            );

        $controls->add_control(
            'menu_items',
            [
                'label' => '',
                'type'  => Controls_Manager::REPEATER,
                'title_field' => '{{{ menu_title }}}',
                'default' => [
                    [
                        'menu_title' => sprintf( esc_html__( 'Item #%d', 'restimo' ), 1 ),
                        'menu_price' => '$69'
                    ],
                    [
                        'menu_title' => sprintf( esc_html__( 'Item #%d', 'restimo' ), 2 ),
                        'menu_price' => '$49'
                    ],
                    [
                        'menu_title' => sprintf( esc_html__( 'Item #%d', 'restimo' ), 3 ),
                        'menu_price' => '$19'
                    ]
                ],
                'fields' => $repeater->get_controls()
            ]
        );

        $controls->add_control(
            'title_price_connector',
            [
                'label'        => esc_html__( 'Title-Price Separator', 'restimo' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'restimo' ),
                'label_off'    => esc_html__( 'No', 'restimo'  ),
            ]
        );

        $controls->add_control(
            'items_divider',
            [
                'label'        => esc_html__( 'Items Separator', 'restimo' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'restimo' ),
                'label_off'    => esc_html__( 'No', 'restimo' ),
            ]
        );

        $controls->end_controls_section();

        $controls->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'restimo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $controls->add_control(
                'items_animate',
                [
                    'label' => esc_html__( 'Animate items', 'restimo' ),
                    'type'  => Controls_Manager::SWITCHER,
                    'return_value' => 'animate',
                    'default' => '',
                    'prefix_class' => 'restimo-price-menu-items-',
                ]
            );

            $controls->add_responsive_control(
                'items_gap',
                [
                    'label' => esc_html__( 'Items Gap', 'restimo' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'size_units' => [ 'px', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__item-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $controls->add_responsive_control(
                'items_images_width',
                [
                    'label' => esc_html__( 'Image width', 'restimo' ),
                    'description'   => esc_html__( 'In Percent (%)', 'restimo' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 80,
                        ],
                    ],
                    'size_units' => [ '%' ],
                    'default' => [
                        'size' => '50',
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__image' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}}.restimo-price-menu-items-animate .restimo-price-menu__image.image-align-left' => 'margin-left: -{{SIZE}}{{UNIT}};',
                        '{{WRAPPER}}.restimo-price-menu-items-animate .restimo-price-menu__image.image-align-right' => 'margin-right: -{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $controls->add_control(
                'items_background_color',
                [
                    'label' => esc_html__( 'Background Color', 'restimo' ),
                    'type' => Controls_Manager::COLOR,
                    'render_type' => 'ui',
                    'selectors' => [
                        '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__item-wrapper' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $controls->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'items_border',
                    'label' => esc_html__( 'Border', 'restimo' ),
                    'selector' => '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__item-wrapper',
                ]
            );

            $controls->add_control(
                'items_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'restimo'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'condition' => [
                        'items_border_border!' => ''
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__item-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $controls->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'items_shadow',
                    'selector' => '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__item-wrapper',
                ]
            );

            $controls->add_responsive_control(
                'items_paddings',
                [
                    'label' => esc_html__( 'Content Padding', 'restimo' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'allowed_dimensions' => [ 'top', 'right', 'bottom', 'left' ],
                    'selectors' => [
                        '{{WRAPPER}} .restimo-price-menu .restimo-price-menu__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $controls->end_controls_section();
    }

    protected function render() {
        $this->render_widget( 'php' );
    }

    protected function content_template() {}
    public function render_plain_content( $instance = [] ) {}
}

Plugin::instance()->widgets_manager->register( new Price_Menu() );