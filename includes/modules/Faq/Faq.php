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
                    'setting'       => esc_html__('Settings', 'divi_flash'),
                    'animation'      => esc_html__('Animation', 'divi_flash'),
                    'schema'         => esc_html__('Schema', 'divi_flash'),
                ),
            ),
            'advanced'      => array(
                'toggles'   => array(
                    'design_faq_icon'  => [
                        'title'        => esc_html__('Icon', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'close'    => [
                                'name' => esc_html__('Close', 'divi_flash'),
                            ],
                            'open'     => [
                                'name' => esc_html__('Open', 'divi_flash'),
                            ]
                        ],
                    ],
                    'design_question'               => esc_html__('Question', 'divi_flash'),
                    'design_answer'                 => esc_html__('Answer Style', 'divi_flash'),
                    // 'design_content_text'           => array(
                    //     'title' => esc_html__('Answer Text', 'divi_flash'),
                    //     'tabbed_subtoggles'         => true,
                    //     'sub_toggles'               => $content_sub_toggles,
                    // ),
                    // 'design_content_heading'        => array(
                    //     'title' => esc_html__('Answer Heading Text', 'divi_flash'),
                    //     'tabbed_subtoggles'         => true,
                    //     'sub_toggles'               => $heading_sub_toggles,
                    // ),
                    // 'custom_spacing'                => esc_html__('Custom Spacing', 'divi_flash'),
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
                'label'          => esc_html__('Layout Type', 'divi_flash'),
                'type'           => 'select',
                'default'        => 'accordion',
                'options'        => array(
                    'accordion'  => esc_html__('Accordion', 'divi_flash'),
                    'individual' => esc_html__('Individual', 'divi_flash'),
                    'plain'      => esc_html__('Plain', 'divi_flash'),
                    'grid'       => esc_html__('Grid', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'    => 'setting'
            ),
            'activate_faq_item' => array(
                'label'          => esc_html__('Active Item on First Time', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'setting'
            ),
            'activate_faq_item_order' => array(
                'label'             => esc_html__('Activate Item Order Number', 'divi_flash'),
                'type'              => 'range',
                'default'           => '1',
                'range_settings'    => array(
                    'min'  => '1',
                    // 'max'  => '10',
                    'step' => '1',
                    'min_limit' => '0',
                    'max_limit' => '10'
                ),
                'toggle_slug'     => 'setting',
                'show_if'         => array(
                    'activate_faq_item'     => 'on'
                )
            ),
            'close_faq_icon'        => array(
                'label'             => esc_html__('Icon', 'divi_flash'),
                'type'              => 'select_icon',
                'option_category'   => 'basic_option',
                'default'           => '&#x4b;||divi||400',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle' => 'close',
                'tab_slug'        => 'advanced'
            ),
            'open_faq_icon'         => array(
                'label'             => esc_html__('Icon', 'divi_flash'),
                'type'              => 'select_icon',
                'option_category'   => 'basic_option',
                'default'           => '&#x4c;||divi||400',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'design_faq_icon',
                'sub_toggle'        => 'open',
                'tab_slug'          => 'advanced'
            ),
            'enable_faq_animation' => array(
                'label'          => esc_html__('Enable FAQ Toggle Animation', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'animation'
            ),
            'faq_animation'  => array(
                'label'          => esc_html__('Toggle Animation', 'divi_flash'),
                'type'           => 'select',
                'default'        => 'slide',
                'options'        => array(
                    'slide'  => esc_html__('Slide', 'divi_flash'),
                    'bounce' => esc_html__('Bounce', 'divi_flash'),
                    'fade'   => esc_html__('Fade', 'divi_flash'),
                ),
                'option_category'=> 'basic_option',
                'toggle_slug'    => 'animation',
                'show_if'        => array(
                    'enable_faq_animation'     => 'on',
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
            'enable_schema'      => array(
                'label'          => esc_html__('Enable Schema', 'divi_flash'),
                'description'     => esc_html__('Activate this option to output the schema data for SEO purposes.', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'schema',
            ),
            'output_html' => array(
                'label'          => esc_html__('Output Structure', 'divi_flash'),
                'description'     => esc_html__('Deactivate this option to hide FAQ. But schema data will generate for SEO purpose.', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'on',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'       => 'schema',
            )
        ];

        return array_merge(
            $faq
        );
    }

    /**
     * Declare advanced fields for the module
     *
     * @return array[]
     * @since 1.0.0
     */

    // public function get_advanced_fields_config(){}

    /**
     * Declare custom css fields for the module
     *
     *
     * @return array[]
     * @since 1.0.0
     */

    // public function get_custom_css_fields_config(){}

    /**
     * Get CSS fields transition.
     *
     * Add form field options group and background image on the fields list.
     *
     * @since 1.0.0
     */

    // public function get_transition_fields_css_props(){}

    /**
     * Render module output
     *
     * @param array  $attrs       FAQ of unprocessed attributes
     * @param string $content     Content being processed
     * @param string $render_slug Slug of module that is used for rendering output
     *
     * @return string module's rendered output
     * @since 1.0.0
     */

    public function render($attrs, $content, $render_slug)
    {
        // Scripts
        // wp_enqueue_script('animejs');
        wp_enqueue_script('df_faq');

        // Get all style
        // $this->additional_css_styles($render_slug);

        // Display frontend
        $output = sprintf(
            '<div class="df_faq_wrapper">
                 %1$s
            </div>',
            $this->content
        );

        return $output;
    }

    /**
     *
     * Add additional css
     *
     * @return array
     *
     */

    // public function additional_css_styles($render_slug){}

    // public function df_render_content(){}
} //Class

new DIFL_FAQ;
