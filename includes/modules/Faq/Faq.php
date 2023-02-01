<?php
if (!class_exists('ET_Builder_Element')) {
    return;
}

/**
 * Faq Class which extend the Divi Builder Module Class.
 *
 * This class provide rating icon element functionalities in frontend.
 *
 */

class DIFL_FAQ extends ET_Builder_Module
{
    public $slug       = 'difl_faq';
    public $child_slug = 'difl_faqitem';
    public $vb_support = 'on';

    use DF_UTLS;

    protected $module_credits = array(
        'module_uri' => '',
        'author'     => 'DiviFlash',
        'author_uri' => '',
    );

    /**
     * Initiate Module.
     * Set the module name on init.
     *
     * @return void
     * @since 1.0.0
     */

    public function init()
    {
        $this->name = esc_html__('FAQ', 'divi_flash');
        $this->main_css_element = "%%order_class%%";
        $this->icon_path        =  DIFL_ADMIN_DIR_PATH . 'img/module-icons/rating-box.svg';
    }

    /**
     * Return add new item(module) text.
     *
     * @return string
     */
    public function add_new_child_text()
    {
        return esc_html__('Add New Faq Item', 'divi_flash');
    }

    /**
     * Declare settings modal toggles for the module
     *
     * @return array[][]
     * @since 1.0.0
     */

    public function get_settings_modal_toggles()
    {
        // All sub toggles
        $content_sub_toggles = array(
            'p'     => array(
                'name' => 'P',
                'icon' => 'text-left',
            ),
            'a'     => array(
                'name' => 'A',
                'icon' => 'text-link',
            ),
            'ul'    => array(
                'name' => 'UL',
                'icon' => 'list',
            ),
            'ol'    => array(
                'name' => 'OL',
                'icon' => 'numbered-list',
            ),
            'quote' => array(
                'name' => 'QUOTE',
                'icon' => 'text-quote',
            ),
        );
        $heading_sub_toggles = array(
            'h1' => array(
                'name' => 'H1',
                'icon' => 'text-h1',
            ),
            'h2' => array(
                'name' => 'H2',
                'icon' => 'text-h2',
            ),
            'h3' => array(
                'name' => 'H3',
                'icon' => 'text-h3',
            ),
            'h4' => array(
                'name' => 'H4',
                'icon' => 'text-h4',
            ),
            'h5' => array(
                'name' => 'H5',
                'icon' => 'text-h5',
            ),
            'h6' => array(
                'name' => 'H6',
                'icon' => 'text-h6',
            ),
        );

        return array(
            'general'   => array(
                'toggles'       => array(
                    'setting'   => esc_html__('Settings', 'divi_flash'),
                    'faq_icon'  => [
                        'title' => esc_html__('Icon', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'close'    => [
                                'name' => esc_html__('Close', 'divi_flash'),
                            ],
                            'open'     => [
                                'name' => esc_html__('Open', 'divi_flash'),
                            ],
                            'setting'  => [
                                'name' => esc_html__('Settings', 'divi_flash'),
                            ]
                        ],
                    ],
                    'schema'    => esc_html__('Schema', 'divi_flash'),
                    'animation' => esc_html__('Animation', 'divi_flash')
                ),
            ),
            'advanced'      => array(
                'toggles'   => array(
                    'design_question'  => [
                        'title'        => esc_html__('Question Style', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'static'   => [
                                'name' => esc_html__('Static', 'divi_flash'),
                            ],
                            'active'   => [
                                'name' => esc_html__('Active', 'divi_flash'),
                            ]
                        ]
                    ],
                    'design_question_text' => [
                        'title'        => esc_html__('Question Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'static'   => [
                                'name' => esc_html__('Static', 'divi_flash'),
                            ],
                            'active'   => [
                                'name' => esc_html__('Active', 'divi_flash'),
                            ]
                        ]
                    ],
                    'design_faq_icon'  => [
                        'title'        => esc_html__('Question Icon', 'divi_flash'),
                        'tabbed_subtoggles'  => true,
                        'sub_toggles'  => [
                            'wrapper'  => [
                                'name' => esc_html__('Wrapper', 'divi_flash'),
                            ],
                            'close_icon' => [
                                'name' => esc_html__('Close', 'divi_flash'),
                            ],
                            'open_icon' => [
                                'name' => esc_html__('Open', 'divi_flash'),
                            ]
                        ],
                    ],
                    'design_que_img'   => [
                        'title'        => esc_html__('Question Image', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'wrapper'  => [
                                'name' => esc_html__('Wrapper', 'divi_flash'),
                            ],
                            'close'    => [
                                'name' => esc_html__('Close', 'divi_flash'),
                            ],
                            'open'     => [
                                'name' => esc_html__('Open', 'divi_flash'),
                            ]
                        ]
                    ],
                    'design_answer'          => esc_html__('Answer Style', 'divi_flash'),
                    'design_answer_text'     => array(
                        'title'              => esc_html__('Answer Text', 'divi_flash'),
                        'tabbed_subtoggles'  => true,
                        'sub_toggles'        => $content_sub_toggles,
                    ),
                    'design_answer_heading'  => array(
                        'title' => esc_html__('Answer Heading Text', 'divi_flash'),
                        'tabbed_subtoggles'  => true,
                        'sub_toggles'        => $heading_sub_toggles,
                    ),
                    'design_button'          => esc_html__('Button', 'divi_flash'),
                    'margin_padding'   => [
                        'title'        => esc_html__('FAQ Spacing', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'wrapper'  => [
                                'name' => esc_html__('Wrapper', 'divi_flash'),
                            ],
                            'content'  => [
                                'name' => esc_html__('Content', 'divi_flash'),
                            ]
                        ]
                    ]
                )
            ),
        );
    }

    /**
     * Declare general fields for the module
     *
     * @return array[]
     * @since 1.0.0
     */

    public function get_fields()
    {

        $faq = [
            'faq_layout' => array(
                'label'          => esc_html__('FAQ Type', 'divi_flash'),
                'type'           => 'select',
                'default'        => 'accordion',
                'options'        => array(
                    'accordion'  => esc_html__('Accordion', 'divi_flash'),
                    'individual' => esc_html__('Individual', 'divi_flash'),
                    'plain'      => esc_html__('Plain', 'divi_flash')
                ),
                'option_category' => 'basic_option',
                'toggle_slug'    => 'setting'
            ),
            'faq_layout_grid'    => array(
                'label'          => esc_html__('Use Grid Layout', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'setting'
            ),
            'faq_item_per_column'   => array(
                'label'             => esc_html__('Layout Columns', 'divi_flash'),
                'description'       => esc_html__('Here you can choose FAQ item per column.', 'divi_flash'),
                'type'              => 'range',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '6',
                    'step' => '1',
                ),
                'number_validation' => true,
                'fixed_range'       => true,
                'validate_unit'     => true,
                'allowed_units'     => array(''),
                'option_category'   => 'layout',
                'toggle_slug'       => 'setting',
                'default_on_front'  => '2',
                'show_if'           => array(
                    'faq_layout_grid' => 'on'
                ),
                'mobile_options'    => true
            ),
            'faq_item_gap' => array(
                'label'             => esc_html__('Item Gap', 'divi_flash'),
                'description'       => esc_html__('Here you can choose FAQ item gap.', 'divi_flash'),
                'type'              => 'range',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1'
                ),
                'validate_unit'    => true,
                'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'toggle_slug'      => 'setting',
                'default' => '20px',
                'mobile_options'   => true
            ),
            'faq_item_equal_width' => array(
                'label'            => esc_html__('Apply item equal width', 'divi_flash'),
                'description'      => esc_html__('Here you can choose whether or not item is equal width.', 'divi_flash'),
                'type'             => 'yes_no_button',
                'default'          => 'on',
                'options'          => array(
                    'on'  => esc_html__('Yes', 'divi_flash'),
                    'off' => esc_html__('No', 'divi_flash')
                ),
                'toggle_slug'      => 'setting'
            ),
            'faq_item_width'       => array(
                'label'            => esc_html__('Item Width', 'divi_flash'),
                'description'      => esc_html__('Here you can set FAQ item width.', 'divi_flash'),
                'type'             => 'range',
                'range_settings'   => array(
                    'step'      => '1',
                    'min'       => '1',
                    'min_limit' => '1',
                    'max'       => '100',
                    'max_limit' => '100'
                ),
                'toggle_slug'      => 'setting',
                'validate_unit'    => true,
                'allowed_units'    => array('%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw'),
                'default_unit'     => '%',
                'default'          => '50%',
                'show_if'          => array(
                    'faq_item_equal_width' => 'off',
                ),
                'mobile_options'   => true
            ),
            'faq_item_horizontal_alignment' => array(
                'label'       => esc_html__('Item Horizontal Alignment', 'divi_flash'),
                'description' => esc_html__('Here you can choose horizontal alignment for FAQ item.', 'divi_flash'),
                'type'        => 'select',
                'options'     => array(
                    'flex-start' => esc_html__('Left', 'divi_flash'),
                    'center'     => esc_html__('Center', 'divi_flash'),
                    'flex-end'   => esc_html__('Right', 'divi_flash')
                ),
                'toggle_slug' => 'setting',
                'show_if'     => array(
                    'faq_item_equal_width' => 'off',
                ),
                'mobile_options' => true
            ),
            'activate_on_first_time' => array(
                'label'          => esc_html__('Active Item on First Time', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'setting',
                'show_if_not'    => array(
                    'faq_layout' => 'plain'
                )
            ),
            'active_item_order_number' => array(
                'label'             => esc_html__('Activate Item Order Number', 'divi_flash'),
                'type'              => 'range',
                'default'           => '0',
                'range_settings'    => array(
                    'min'  => '1',
                    'step' => '1',
                    'min_limit' => '0',
                    'max_limit' => '10'
                ),
                'toggle_slug'   => 'setting',
                'show_if'       => array(
                    'activate_on_first_time' => 'on'
                )
            ),
            'enable_schema'      => array(
                'label'          => esc_html__('Enable Schema', 'divi_flash'),
                'description'     => esc_html__('Activate this option to output the schema data for SEO purposes.', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'schema'
            ),
            'output_html' => array(
                'label'          => esc_html__('Display FAQ', 'divi_flash'),
                'description'    => esc_html__('Deactivate this option to hide FAQ. But schema data will generate for SEO purpose.', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'on',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'schema',
                'show_if'         => array(
                    'enable_schema'     => 'on'
                )
            ),
            'que_wrapper_bg'    => array(
                'label'           => esc_html__('Wrapper Background', 'divi_flash'),
                'type'            => 'color-alpha',
                'toggle_slug'     => 'design_question',
                'sub_toggle'      => 'static',
                'tab_slug'        => 'advanced',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'default'         => '#f7f7f7'
            ),
            'active_que_wrapper_bg'    => array(
                'label'           => esc_html__('Wrapper Background', 'divi_flash'),
                'type'            => 'color-alpha',
                'toggle_slug'     => 'design_question',
                'sub_toggle'      => 'active',
                'tab_slug'        => 'advanced',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'default'         => '#ffe6ff'
            ),

        ];

        $faq_que_icon = [
            'faq_icon_bg' => array(
                'label'             => esc_html__('Close Wrapper Background', 'divi_flash'),
                'type'              => 'color-alpha',
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'wrapper',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'option_category'   => 'basic_option'
            ),
            'faq_icon_bg_active' => array(
                'label'             => esc_html__('Open Wrapper Background', 'divi_flash'),
                'type'              => 'color-alpha',
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'wrapper',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'option_category'   => 'basic_option'
            ),
            'close_faq_icon'        => array(
                'label'             => esc_html__('Icon', 'divi_flash'),
                'type'              => 'select_icon',
                'option_category'   => 'basic_option',
                'default'           => '&#x4c;||divi||400',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'faq_icon',
                'sub_toggle'        => 'close'
            ),

            'close_icon_color'      => array(
                'label'             => esc_html__('Icon Color', 'divi_flash'),
                'type'              => 'color-alpha',
                'description'       => esc_html__('Here you can define a custom color for your icon.', 'divi_flash'),
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'close_icon',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'default'           => "#b8b9bb"
            ),

            'close_icon_size'             => array(
                'label'             => esc_html__('Icon Size', 'divi_flash'),
                'type'              => 'range',
                'option_category'   => 'font_option',
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'close_icon',
                'tab_slug'          => 'advanced',
                'default'           => '20px',
                'default_unit'      => 'px',
                'range_settings' => array(
                    'min'  => '1',
                    'max'  => '120',
                    'step' => '1',
                ),
                'mobile_options'    => true,
                'responsive'        => true
            ),

            'faq_icon_placement'  => array(
                'label'           => esc_html__('Icon Placement', 'divi_flash'),
                'type'            => 'select',
                'default'         => 'inherit',
                'options'         => array(
                    'inherit'     => esc_html__('Right', 'divi_flash'),
                    'row-reverse' => esc_html__('Left', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'faq_icon',
                'sub_toggle'      => 'setting',
                'mobile_options'  => true
            ),
            'open_faq_icon'         => array(
                'label'             => esc_html__('Icon', 'divi_flash'),
                'type'              => 'select_icon',
                'option_category'   => 'basic_option',
                'default'           => '&#x4b;||divi||400',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'faq_icon',
                'sub_toggle'        => 'open'
            ),
            'open_icon_color'       => array(
                'label'             => esc_html__('Icon Color', 'divi_flash'),
                'type'              => 'color-alpha',
                'description'       => esc_html__('Here you can define a custom color for your icon.', 'divi_flash'),
                'depends_show_if'   => 'on',
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'open_icon',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'default'           => "#ef92db",
            ),
            'open_icon_size'        => array(
                'label'             => esc_html__('Icon Size', 'divi_flash'),
                'type'              => 'range',
                'option_category'   => 'font_option',
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'open_icon',
                'tab_slug'          => 'advanced',
                'default'           => '20px',
                'default_unit'      => 'px',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '120',
                    'step' => '1',
                ),
                'mobile_options'    => true,
                'responsive'        => true
            )
        ];

        $faq_que_img = [
            'que_img_bg'    => array(
                'label'           => esc_html__('Close Wrapper Background', 'divi_flash'),
                'type'            => 'color-alpha',
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'wrapper',
                'tab_slug'        => 'advanced',
                'hover'           => 'tabs',
                'option_category' => 'basic_option'
            ),
            'que_img_bg_active' => array(
                'label'           => esc_html__('Open Wrapper Background', 'divi_flash'),
                'type'            => 'color-alpha',
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'wrapper',
                'tab_slug'        => 'advanced',
                'hover'           => 'tabs',
                'option_category' => 'basic_option'
            ),
            'close_que_img_size'  => array(
                'label'           => esc_html__('Image Size', 'divi_flash'),
                'type'            => 'range',
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'close',
                'tab_slug'        => 'advanced',
                'default'         => '35px',
                'default_unit'    => 'px',
                'range_settings'  => array(
                    'min'  => '1',
                    // 'max'  => '120',
                    'step' => '1'
                ),
                'mobile_options'  => true,
                'responsive'      => true
            ),
            'open_que_img_size'   => array(
                'label'           => esc_html__('Image Size', 'divi_flash'),
                'type'            => 'range',
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'open',
                'tab_slug'        => 'advanced',
                'default'         => '35px',
                'default_unit'    => 'px',
                'range_settings'  => array(
                    'min'  => '1',
                    // 'max'  => '120',
                    'step' => '1'
                ),
                'mobile_options'  => true,
                'responsive'      => true
            )
        ];

        $faq_answer = [
            'ans_wrapper_bg'    => array(
                'label'           => esc_html__('Wrapper Background', 'divi_flash'),
                'type'            => 'color-alpha',
                'toggle_slug'     => 'design_answer',
                'tab_slug'        => 'advanced',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'default'         => '#fbfbfb'
            )
        ];

        $faq_ans_btn = [
            'button_text_color' => array(
                'label'             => esc_html__('Button Color', 'divi_flash'),
                'type'              => 'color-alpha',
                'description'       => esc_html__('Here you can define a custom color for button text.', 'divi_flash'),
                'toggle_slug'       => 'design_button',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs'
                ),
            // 'button_icon_size' => array(
            //     'label'             => esc_html__('Button Icon Size', 'divi_flash'),
            //     'type'              => 'range',
            //     'toggle_slug'       => 'design_button',
            //     'tab_slug'          => 'advanced',
            //     'default'           => '20px',
            //     'allowed_units'     => array('px'),
            //     'range_settings'    => array(
            //         'min'  => '0',
            //         'max'  => '100',
            //         'step' => '1'
            //     ),
            //     'responsive'        => true,
            //     'mobile_options'    => true
            // ),
            // 'button_icon_color' => array(
            //     'label'             => esc_html__('Button Icon Color', 'divi_flash'),
            //     'type'              => 'color-alpha',
            //     'description'       => esc_html__('Here you can define a custom color for your icon.', 'divi_flash'),
            //     'toggle_slug'       => 'design_button',
            //     'tab_slug'          => 'advanced',
            //     'hover'             => 'tabs'
            // )
        ];

        $faq_animation = [
            'enable_faq_animation' => array(
                'label'          => esc_html__('Enable FAQ Toggle Animation', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'on',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'animation'
            ),
            'faq_animation'  => array(
                'label'      => esc_html__('Toggle Animation', 'divi_flash'),
                'type'       => 'select',
                'default'    => 'slide_down',
                'options'    => array(
                    'slide'  => esc_html__('Slide', 'divi_flash'),
                    'fade'   => esc_html__('Fade', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'animation',
                'show_if'         => array(
                    'enable_faq_animation' => 'on'
                )
            ),
            'enable_icon_animation' => array(
                'label'          => esc_html__('Enable Icon Animation', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'animation'
            ),
            'enable_que_img_animation' => array(
                'label'          => esc_html__('Enable Question Image Animation', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'animation'
            )
        ];

        $faq_wrapper_margin = $this->add_margin_padding(array(
            'title'         => 'FAQ Wrapper',
            'key'           => 'faq_wrapper',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'wrapper'
        ));

        $que_wrapper_margin = $this->add_margin_padding(array(
            'title'         => 'Question Wrapper',
            'key'           => 'que_wrapper',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'wrapper'
        ));

        $que_text_margin = $this->add_margin_padding(array(
            'title'         => 'Question Text',
            'key'           => 'que_text',
            'option'        => 'margin',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'content'
        ));

        $que_icon_margin = $this->add_margin_padding(array(
            'title'         => 'Question Icon',
            'key'           => 'que_icon',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'content'
        ));

        $que_img_margin = $this->add_margin_padding(array(
            'title'         => 'Question Image',
            'key'           => 'que_img',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'content'
        ));

        $ans_wrapper_margin = $this->add_margin_padding(array(
            'title'         => 'Answer Wrapper',
            'key'           => 'ans_wrapper',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'wrapper'
        ));

        $ans_text_margin = $this->add_margin_padding(array(
            'title'         => 'Answer Text',
            'key'           => 'ans_text',
            'toggle_slug'   => 'margin_padding',
            'sub_toggle'    => 'content'
        ));

        $ans_button_bg = $this->df_add_bg_field(array(
            'label'                 => 'Background',
            'key'                   => 'ans_button_bg',
            'toggle_slug'           => 'design_button',
            'tab_slug'              => 'advanced'
        ));

        $ans_btn_margin = $this->add_margin_padding(array(
            'title'         => 'Answer Button',
            'key'           => 'ans_button',
            'toggle_slug'   => 'design_button'
        ));



        return array_merge(
            $faq,
            $faq_que_icon,
            $faq_que_img,
            $faq_answer,
            $faq_animation,
            $faq_wrapper_margin,
            $que_wrapper_margin,
            $que_text_margin,
            $que_icon_margin,
            $que_img_margin,
            $ans_wrapper_margin,
            $ans_text_margin,
            $ans_button_bg,
            $faq_ans_btn,
            $ans_btn_margin
        );
    }

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();
        $advanced_fields['text'] = false;

        $advanced_fields['fonts'] = [
            'question_text'         => array(
                // 'label'        => esc_html__('Question', 'divi_flash'),
                'toggle_slug'  => 'design_question_text',
                'sub_toggle'   => 'static',
                'tab_slug'     => 'advanced',
                'hide_text_align' => true,
                'font_size'    => array(
                    'default'  => '22px',
                ),
                'font-weight'  => array(
                    'default'  => 'normal'
                ),
                'css'       => array(
                    'main'  => "$this->main_css_element .faq_question .faq_question_title",
                    'hover' => "$this->main_css_element .faq_question:hover .faq_question_title",
                    'important' => 'all'
                )
            ),

            'active_design_question_text'  => array(
                // 'label'        => esc_html__('Active Question', 'divi_flash'),
                'toggle_slug'  => 'design_question_text',
                'sub_toggle'   => 'active',
                'tab_slug'     => 'advanced',
                'hide_text_align' => true,
                'font_size'    => array(
                    'default'  => '22px',
                ),
                'font-weight'  => array(
                    'default'  => 'normal'
                ),
                'css'       => array(
                    'main'  => "$this->main_css_element .df_faq_item.active .faq_question .faq_question_title",
                    'hover' => "$this->main_css_element .df_faq_item.active .faq_question:hover .faq_question_title",
                    'important' => 'all'
                )
            ),

            'design_answer_text' => array(
                // 'label'       => esc_html__('Answer', 'divi_flash'),
                'toggle_slug' => 'design_answer_text',
                'tab_slug'    => 'advanced',
                'line_height' => array(
                    'default' => '1.7em',
                ),
                'font_size'   => array(
                    'default' => '14px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'       => array(
                    'main'  => "$this->main_css_element .faq_answer_wrapper .faq_answer_area .faq_answer",
                    'hover' => "$this->main_css_element .faq_answer_wrapper .faq_answer_area .faq_answer",
                    'important' => 'all'
                ),
                // answer design
                'block_elements' => array(
                    'tabbed_subtoggles' => true,
                    'bb_icons_support'  => true,
                    'css'               => array(
                        'main'  => "$this->main_css_element .faq_answer_wrapper .faq_answer",
                        'hover' => "$this->main_css_element .faq_answer_wrapper:hover .faq_answer",
                    ),
                ),
            ),
            'ans_button'         => array(
                // 'label'        => esc_html__('Question', 'divi_flash'),
                'toggle_slug'  => 'design_button',
                'tab_slug'     => 'advanced',
                'hide_text_align' => true,
                'font_size'    => array(
                    'default'  => '18px',
                ),
                'font-weight'  => array(
                    'default'  => 'normal'
                ),
                'css'       => array(
                    'main'  => "$this->main_css_element .faq_button a",
                    'hover' => "$this->main_css_element faq_button a:hover",
                    'important' => 'all'
                )
            ),

        ];

        // Heading Tag
        $advanced_fields['fonts']['content_heading_1']  = array(
            'label'       => esc_html__('Heading 1', 'divi_flash'),
            'font_size'   => array(
                'default' => absint(et_get_option('body_header_size', '30')) . 'px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h1",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h1:hover",
            ),
            'toggle_slug' => 'design_answer_heading',
            'tab_slug'    => 'advanced',
            'sub_toggle'  => 'h1'
        );
        $advanced_fields['fonts']['content_heading_2']  = array(
            'label'       => esc_html__('Heading 2', 'divi_flash'),
            'font_size'   => array(
                'default' => '26px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h2",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h2:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_answer_heading',
            'sub_toggle'  => 'h2'
        );
        $advanced_fields['fonts']['content_heading_3']  = array(
            'label'       => esc_html__('Heading 3', 'divi_flash'),
            'font_size'   => array(
                'default' => '22px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h3",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h3:hover",
            ),
            'toggle_slug' => 'design_answer_heading',
            'tab_slug'    => 'advanced',
            'sub_toggle'  => 'h3'
        );
        $advanced_fields['fonts']['content_heading_4']  = array(
            'label'       => esc_html__('Heading 4', 'divi_flash'),
            'font_size'   => array(
                'default' => '18px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h4",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h4:hover",
            ),
            'toggle_slug' => 'design_answer_heading',
            'tab_slug'    => 'advanced',
            'sub_toggle'  => 'h4'
        );
        $advanced_fields['fonts']['content_heading_5']  = array(
            'label'       => esc_html__('Heading 5', 'divi_flash'),
            'font_size'   => array(
                'default' => '16px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h5",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h5:hover",
            ),
            'toggle_slug' => 'design_answer_heading',
            'tab_slug'    => 'advanced',
            'sub_toggle'  => 'h5'
        );
        $advanced_fields['fonts']['content_heading_6']  = array(
            'label'       => esc_html__('Heading 6', 'divi_flash'),
            'font_size'   => array(
                'default' => '14px',
            ),
            'font_weight' => array(
                'default' => '500',
            ),
            'line_height' => array(
                'default' => '1.7',
            ),
            'css'         => array(
                'main'    => "$this->main_css_element .faq_answer_wrapper .faq_answer h6",
                'hover'   => "$this->main_css_element .faq_answer_wrapper .faq_answer h6:hover",
            ),
            'toggle_slug' => 'design_answer_heading',
            'tab_slug'    => 'advanced',
            'sub_toggle'  => 'h6'
        );

        $advanced_fields['borders'] = array(
            'default'            => array(),
            'que_wrapper_border' => array(
                'css'            => array(
                    'main'  => array(
                        'border_radii'       => "$this->main_css_element .faq_question_wrapper",
                        'border_radii_hover' => "$this->main_css_element .faq_question_wrapper:hover",
                        'border_styles'      => "$this->main_css_element .faq_question_wrapper",
                        'border_styles_hover' => "$this->main_css_element .faq_question_wrapper:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_question',
                'sub_toggle'      => 'static',
                'tab_slug'        => 'advanced'
            ),
            'active_que_wrapper_border'      => array(
                'css'       => array(
                    'main'  => array(
                        'border_radii'       => "$this->main_css_element .df_faq_item.active .faq_question_wrapper",
                        'border_radii_hover' => "$this->main_css_element .df_faq_item.active .faq_question_wrapper:hover",
                        'border_styles'      => "$this->main_css_element .df_faq_item.active .faq_question_wrapper",
                        'border_styles_hover' => "$this->main_css_element .df_faq_item.active .faq_question_wrapper:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_question',
                'sub_toggle'      => 'active',
                'tab_slug'        => 'advanced'
            ),
            'que_text_border'     => array(
                'css'      => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .faq_question_title",
                        'border_radii_hover' => "$this->main_css_element .faq_question_title:hover",
                        'border_styles'      => "$this->main_css_element .faq_question_title",
                        'border_styles_hover' => "$this->main_css_element .faq_question_title:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_question_text',
                'sub_toggle'      => 'static',
                'tab_slug'        => 'advanced'
            ),
            'active_que_text_border' => array(
                'css'  => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .df_faq_item.active .faq_question_title",
                        'border_radii_hover' => "$this->main_css_element .df_faq_item.active .faq_question_title:hover",
                        'border_styles'      => "$this->main_css_element .df_faq_item.active .faq_question_title",
                        'border_styles_hover' => "$this->main_css_element .df_faq_item.active .faq_question_title:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_question_text',
                'sub_toggle'      => 'active',
                'tab_slug'        => 'advanced'
            ),
            'que_img_wrapper_border'    => array(
                'css'      => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .faq_question_image",
                        'border_radii_hover' => "$this->main_css_element .faq_question_image:hover",
                        'border_styles'      => "$this->main_css_element .faq_question_image",
                        'border_styles_hover' => "$this->main_css_element .faq_question_image:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'wrapper',
                'tab_slug'        => 'advanced'
            ),
            // 'que_img_wrapper_border_active'    => array(
            //     'css'      => array(
            //         'main' => array(
            //             'border_radii'       => "$this->main_css_element .faq_question_image",
            //             'border_radii_hover' => "$this->main_css_element .faq_question_image:hover",
            //             'border_styles'      => "$this->main_css_element .faq_question_image",
            //             'border_styles_hover' => "$this->main_css_element .faq_question_image:hover",
            //         )
            //     ),
            //     // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
            //     'toggle_slug'     => 'design_que_img',
            //     'sub_toggle'      => 'wrapper',
            //     'tab_slug'        => 'advanced'
            // ),
            'que_img_border' => array(
                'css' => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .faq_question_image img",
                        'border_radii_hover' => "$this->main_css_element .faq_question_image:hover img",
                        'border_styles'      => "$this->main_css_element .faq_question_image img",
                        'border_styles_hover' => "$this->main_css_element .faq_question_image:hover img",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'close',
                'tab_slug'        => 'advanced'
            ),
            'que_img_border_active' => array(
                'css' => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .df_faq_item.active .faq_question_image img",
                        'border_radii_hover' => "$this->main_css_element .df_faq_item.active .faq_question_image:hover img",
                        'border_styles'      => "$this->main_css_element .df_faq_item.active .faq_question_image img",
                        'border_styles_hover' => "$this->main_css_element .df_faq_item.active .faq_question_image:hover img",
                    )
                ),
                'label_prefix'    => esc_html__('Active', 'divi_flash'),
                'toggle_slug'     => 'design_que_img',
                'sub_toggle'      => 'open',
                'tab_slug'        => 'advanced'
            ),
            'que_icon_wrapper_border' => array(
                'css' => array(
                    'main' => array(
                        'border_radii'       => "$this->main_css_element .faq_icon",
                        'border_radii_hover' => "$this->main_css_element .faq_icon:hover",
                        'border_styles'      => "$this->main_css_element .faq_icon",
                        'border_styles_hover' => "$this->main_css_element .faq_icon:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_faq_icon',
                'sub_toggle'      => 'wrapper',
                'tab_slug'        => 'advanced'
            ),
            // 'que_icon_wrapper_border_active' => array(
            //     'css' => array(
            //         'main' => array(
            //             'border_radii'       => "$this->main_css_element .df_faq_item.active .faq_icon",
            //             'border_radii_hover' => "$this->main_css_element .df_faq_item.active .faq_icon:hover",
            //             'border_styles'      => "$this->main_css_element .df_faq_item.active .faq_icon",
            //             'border_styles_hover' => "$this->main_css_element .df_faq_item.active .faq_icon:hover",
            //         )
            //     ),
            //     'label_prefix'    => esc_html__('Active', 'divi_flash'),
            //     'toggle_slug'     => 'design_faq_icon',
            //     'sub_toggle'      => 'wrapper',
            //     'tab_slug'        => 'advanced'
            // ),
            // 'que_icon_border'    => array(
            //     'css'      => array(
            //         'main' => array(
            //             'border_radii'       => "$this->main_css_element .faq_icon span.et-pb-icon",
            //             'border_radii_hover' => "$this->main_css_element .faq_icon span.et-pb-icon:hover",
            //             'border_styles'      => "$this->main_css_element .faq_icon span.et-pb-icon",
            //             'border_styles_hover' => "$this->main_css_element .faq_icon span.et-pb-icon:hover",
            //         )
            //     ),
            //     // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
            //     'toggle_slug'     => 'design_faq_icon',
            //     'sub_toggle'      => '',
            //     'tab_slug'        => 'advanced'
            // ),
            'ans_wrapper_border' => array(
                'css' => array(
                    'main'  => array(
                        'border_radii'       => "$this->main_css_element .faq_answer_wrapper",
                        'border_radii_hover' => "$this->main_css_element .faq_answer_wrapper:hover",
                        'border_styles'      => "$this->main_css_element .faq_answer_wrapper",
                        'border_styles_hover' => "$this->main_css_element .faq_answer_wrapper:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_answer',
                'tab_slug'        => 'advanced'
            ),
            'ans_button_border' => array(
                'css' => array(
                    'main'  => array(
                        'border_radii'       => "$this->main_css_element .faq_button a",
                        'border_radii_hover' => "$this->main_css_element .faq_button a:hover",
                        'border_styles'      => "$this->main_css_element .faq_button",
                        'border_styles_hover' => "$this->main_css_element .faq_button a:hover",
                    )
                ),
                // 'label_prefix'    => esc_html__('Wrapper', 'divi_flash'),
                'toggle_slug'     => 'design_button',
                'tab_slug'        => 'advanced'
            ),
        );

        $advanced_fields['box_shadow'] = array(
            'default'           => true,

            'que_wrapper_box_shadow' => array(
                // 'label'         => esc_html__('Rating Box Shadow', 'divi_flash'),
                'css' => array(
                    'main'  => "$this->main_css_element .faq_question_wrapper",
                    'hover' => "$this->main_css_element .faq_question_wrapper:hover",
                ),
                'toggle_slug'   => 'design_question',
                'sub_toggle'    => 'wrapper',
                'tab_slug'      => 'advanced',
            ),
            'ans_wrapper_box_shadow' => array(
                // 'label'         => esc_html__('Rating Box Shadow', 'divi_flash'),
                'css' => array(
                    'main'  => "$this->main_css_element .faq_answer_wrapper",
                    'hover' => "$this->main_css_element .faq_answer_wrapper:hover",
                ),
                'toggle_slug'  => 'design_answer',
                'tab_slug'     => 'advanced',
            )
        );

        $advanced_fields['filters'] = array(
            'child_filters_target' => array(
                'label' => esc_html__('Filter', 'divi_flash'),
                'toggle_slug'      => 'filter',
                'tab_slug'         => 'advanced',
                'css' => array(
                    'main'  => "$this->main_css_element .df_rating_box_container",
                    'hover' => "$this->main_css_element .df_rating_box_container:hover"
                ),
            ),
        );

        $advanced_fields['margin_padding'] = array(
            'css'   => array(
                'important' => 'all'
            )
        );

        $advanced_fields['max_width'] = array(
            'css' => array(
                'main'             => $this->main_css_element,
                'module_alignment' => "$this->main_css_element.et_pb_module",
                'important' => 'all'
            ),
        );

        return $advanced_fields;
    }

    // public function get_transition_fields_css_props(){}

    public function get_custom_css_fields_config()
    {
        return array(
            'que_text_css'   => array(
                'label'    => esc_html__('Question Text', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_question_title",
            ),
            'close_que_icon_css'   => array(
                'label'    => esc_html__('Close Question Icon', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_icon .close_icon span.et-pb-icon",
            ),
            'open_que_icon_css'   => array(
                'label'    => esc_html__('Open Question Icon', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_icon .open_icon span.et-pb-icon",
            ),
            'close_que_img_css'   => array(
                'label'    => esc_html__('Close Question Image', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_question_image .close_image img",
            ),
            'open_que_img_css'   => array(
                'label'    => esc_html__('Open Question Image', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_question_image .open_image img",
            ),
            'ans_text_css'   => array(
                'label'    => esc_html__('Answer Text', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_answer",
            ),
            'ans_img_css'   => array(
                'label'    => esc_html__('Answer Image', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_answer_image img",
            ),
            'ans_button_css'   => array(
                'label'    => esc_html__('Answer Button', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_button a",
            ),
            'que_wrapper_css'   => array(
                'label'    => esc_html__('Question Wrapper', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_question_wrapper",
            ),
            'ans_wrapper_css'   => array(
                'label'    => esc_html__('Answer Wrapper', 'divi_flash'),
                'selector' => "$this->main_css_element .faq_answer_wrapper",
            ),
        );
    }


    public function additional_css_styles($render_slug)
    {
        if (method_exists('ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon')) {

            if ($this->props['close_faq_icon']) {
                $this->generate_styles(
                    array(
                        'utility_arg'    => 'icon_font_family',
                        'render_slug'    => $render_slug,
                        'base_attr_name' => 'close_faq_icon',
                        'important'      => true,
                        'selector'       => "$this->main_css_element .faq_icon .close_icon span.et-pb-icon",
                        'processor'      => array(
                            'ET_Builder_Module_Helper_Style_Processor',
                            'process_extended_icon'
                        ),
                    )
                );
            }

            if ($this->props['open_faq_icon']) {
                $this->generate_styles(
                    array(
                        'utility_arg'    => 'icon_font_family',
                        'render_slug'    => $render_slug,
                        'base_attr_name' => 'open_faq_icon',
                        'important'      => true,
                        'selector'       => "$this->main_css_element .faq_icon .open_icon span.et-pb-icon",
                        'processor'      => array(
                            'ET_Builder_Module_Helper_Style_Processor',
                            'process_extended_icon'
                        ),
                    )
                );
            }
        }

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'que_wrapper_bg',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .faq_question_wrapper",
                'hover'       => "$this->main_css_element .faq_question_wrapper:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'active_que_wrapper_bg',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .df_faq_item.active .faq_question_wrapper",
                'hover'       => "$this->main_css_element .df_faq_item.active .faq_question_wrapper:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'ans_wrapper_bg',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .faq_answer_wrapper",
                'hover'       => "$this->main_css_element .faq_answer_wrapper:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'faq_icon_bg',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .faq_icon",
                'hover'       => "$this->main_css_element .faq_icon:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'faq_icon_bg_active',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .df_faq_item.active .faq_icon",
                'hover'       => "$this->main_css_element .df_faq_item.active .faq_icon:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'que_img_bg',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .faq_question_image",
                'hover'       => "$this->main_css_element .faq_question_image:hover",
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'que_img_bg_active',
                'type'        => 'background-color',
                'selector'    => "$this->main_css_element .df_faq_item.active .faq_question_image",
                'hover'       => "$this->main_css_element .df_faq_item.active .faq_question_image:hover"
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'close_icon_color',
                'type'        => 'color',
                'selector'    => "$this->main_css_element .close_icon span.et-pb-icon",
                'hover'       => "$this->main_css_element .close_icon span.et-pb-icon:hover"
            )
        );

        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'ans_button_bg',
            'selector'          => "$this->main_css_element .faq_button a",
            'hover'             => "$this->main_css_element .faq_button a:hover"
        ));

        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'close_icon_size',
                'type'        => 'font-size',
                'selector'    => "$this->main_css_element .close_icon span.et-pb-icon",
                'hover'       => "$this->main_css_element .close_icon span.et-pb-icon:hover",
            )
        );

        $this->df_process_color(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'open_icon_color',
                'type'        => 'color',
                'selector'    => "$this->main_css_element .open_icon span.et-pb-icon",
                'hover'       => "$this->main_css_element .open_icon span.et-pb-icon:hover"
            )
        );

        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'open_icon_size',
                'type'        => 'font-size',
                'selector'    => "$this->main_css_element .open_icon span.et-pb-icon",
                'hover'       => "$this->main_css_element .open_icon span.et-pb-icon:hover",
            )
        );

        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'close_que_img_size',
                'type'        => 'max-width',
                'selector'    => "$this->main_css_element .close_image img",
                'hover'       => "$this->main_css_element .close_image img:hover"
            )
        );

        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'open_que_img_size',
                'type'        => 'max-width',
                'selector'    => "$this->main_css_element .open_image img",
                'hover'       => "$this->main_css_element .open_image img:hover",
            )
        );

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'faq_wrapper_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .difl_faq",
            'hover'             => "$this->main_css_element .difl_faq:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'faq_wrapper_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .difl_faq",
            'hover'             => "$this->main_css_element .difl_faq:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_wrapper_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_question_wrapper",
            'hover'             => "$this->main_css_element .faq_question_wrapper:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_wrapper_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .faq_question_wrapper",
            'hover'             => "$this->main_css_element .faq_question_wrapper:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_text_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_question_title",
            'hover'             => "$this->main_css_element .faq_question_title:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_icon_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_icon",
            'hover'             => "$this->main_css_element .faq_icon:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_icon_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .faq_icon",
            'hover'             => "$this->main_css_element .faq_icon",
            'important'         => false
        ));


        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_img_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_question_image ",
            'hover'             => "$this->main_css_element .faq_question_image:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'que_img_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .faq_question_image",
            'hover'             => "$this->main_css_element .faq_question_image:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'ans_wrapper_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_answer_wrapper",
            'hover'             => "$this->main_css_element .faq_answer_wrapper:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'ans_wrapper_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .faq_answer_wrapper",
            'hover'             => "$this->main_css_element .faq_answer_wrapper:hover",
            'important'         => false
        ));

        //  ans_button
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'ans_button_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .faq_button a",
            'hover'             => "$this->main_css_element .faq_button a:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'ans_button_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .faq_button a",
            'hover'             => "$this->main_css_element .faq_button a:hover",
            'important'         => false
        ));

        // icon placement (+ question wrapper)
        if ('inherit' !== $this->props['faq_icon_placement']) {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'faq_icon_placement',
                    'selector'       => "$this->main_css_element .faq_question_wrapper, $this->main_css_element .faq_question_area",
                    'css_property'   => 'flex-direction',
                    'render_slug'    => $render_slug,
                    'type'           => 'align'
                )
            );
        }

        // faq grid layout
        if ('on' === $this->props['faq_layout_grid']) {
            $this->df_faq_set_dynamic_grid_columns(
                array(
                    'render_slug' => $this->slug,
                    'slug'        => 'faq_item_per_column',
                    'selector'    => "$this->main_css_element .df_faq_wrapper",
                    'type'        => "grid-template-columns"
                )
            );
        }

        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'faq_item_gap',
                'unit'        => 'px',
                'default'     => '20',
                'type'        => 'gap',
                'selector'    => "$this->main_css_element .df_faq_wrapper"
            )
        );

        // FAQ item width
        $this->df_process_range(
            array(
                'render_slug' => $render_slug,
                'slug'        => 'faq_item_width',
                'type'        => 'width',
                'selector'    => "$this->main_css_element .difl_faqitem div.et_pb_module_inner",
                // 'important'   => true
            )
        );

        if ('on' === $this->props['faq_item_equal_width']) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector'    => "$this->main_css_element .difl_faqitem div.et_pb_module_inner",
                'declaration' => "width: 100% !important;"
            ));
        }

        $this->generate_styles(
            array(
                'base_attr_name' => 'faq_item_horizontal_alignment',
                'selector'       => "$this->main_css_element .df_faq_wrapper .et_pb_module.difl_faqitem",
                'css_property'   => 'justify-content',
                'render_slug'    => $render_slug,
                'type'           => 'align'
            )
        );

        // output html
        if ('on' !== $this->props['output_html']) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector'    => "$this->main_css_element.difl_faq .df_faq_wrapper",
                'declaration' => "display: none;"
            ));
        }
    }

    // faq schema
    public function df_render_schema()
    {
        global $df_faq_schema_data;

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => [],
        ];

        foreach ($df_faq_schema_data as $data) {
            $schema['mainEntity'][] = [
                "@type" => "Question",
                "name" => $data['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $data['answer']
                ],
            ];
        }

        $script = '';
        if ('on' === $this->props['enable_schema']) {
            $script = sprintf('<script type="application/ld+json">%1$s</script>', json_encode($schema));
        }

        return $script;
    }

    private function df_faq_set_dynamic_grid_columns($options)
    {
        $default = array(
            'render_slug' => '',
            'slug'        => '',
            'selector'    => '',
            'type'        => '',
        );
        $options = wp_parse_args($options, $default);

        if (array_key_exists($options['slug'], $this->props) && !empty($this->props[$options['slug']])) {
            $desktop_column = $this->props[$options['slug']];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('%1$s:%2$s;', $options['type'], "repeat($desktop_column, 1fr)"),
            ));
        }

        if (
            array_key_exists($options['slug'] . '_tablet', $this->props)
            && !empty($this->props[$options['slug'] . '_tablet'])
        ) {
            $tablet_column = $this->props[$options['slug'] . '_tablet'];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('%1$s:%2$s;', $options['type'], "repeat($tablet_column, 1fr)"),
                'media_query' => self::get_media_query('max_width_980')
            ));
        }

        if (
            array_key_exists($options['slug'] . '_phone', $this->props)
            && !empty($this->props[$options['slug'] . '_phone'])
        ) {
            $phone_column = $this->props[$options['slug'] . '_phone'];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('%1$s:%2$s;', $options['type'], "repeat($phone_column, 1fr)"),
                'media_query' => self::get_media_query('max_width_767')
            ));
        }
    }

    public function render($attrs, $content, $render_slug)
    {
        // Scripts
        wp_enqueue_script('animejs');
        wp_enqueue_script('df_faq');

        // Get all style
        $this->additional_css_styles($render_slug);

        // Display frontend
        $output = sprintf(
            '<div class="df_faq_wrapper">%1$s</div>
            %2$s',
            $this->content ?? "",
            $this->df_render_schema() ?? ""
        );

        return $output;
    }
} //Class

new DIFL_FAQ;
