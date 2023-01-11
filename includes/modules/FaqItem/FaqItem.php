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

class DIFL_FaqItem extends ET_Builder_Module
{
    public $slug       = 'difl_faqitem';
    public $vb_support = 'on';
    public $type       = 'child';
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
        $this->name   = esc_html__('FAQ Item', 'divi_flash');
        $this->plural = esc_html__('FAQ Items', 'divi_flash');

        $this->child_title_var          = 'question';
        // $this->child_title_fallback_var = 'answer';

        $this->main_css_element = "%%order_class%%";
        $this->icon_path        =  DIFL_ADMIN_DIR_PATH . 'img/module-icons/rating-box.svg';
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
                'toggles'      => array(
                    'child_faq_content' => [
                        'title'             => esc_html__('Faq Item', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'default'           => 'question',
                        'sub_toggles'       => [
                            'question'   => [
                                'name'   => esc_html__('Question', 'divi_flash'),
                            ],
                            'answer' => [
                                'name' => esc_html__('Answer', 'divi_flash'),
                            ],
                        ],
                    ],
                    'child_faq_image'  => [
                        'title'        => esc_html__('Image', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'  => [
                            'close'    => [
                                'name' => esc_html__('Close', 'divi_flash'),
                            ],
                            'open'     => [
                                'name' => esc_html__('Open', 'divi_flash'),
                            ],
                        ],
                    ],
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'design_question'       => esc_html__('Question', 'divi_flash'),
                    'design_answer'         => esc_html__('Answer', 'divi_flash'),
                    'design_answer_text'    => array(
                        'title'             => esc_html__('Content Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $content_sub_toggles,
                    ),
                    'design_content_heading' => array(
                        'title' => esc_html__('Content Heading Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $heading_sub_toggles,
                    ),
                    // 'custom_spacing'        => esc_html__('Custom Spacing', 'divi_flash'),
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
        $faqItem = [
            'question' => array(
                'label'           => esc_html__('Question', 'divi_flash'),
                'type'            => 'text',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle' => 'question'
            ),
            'answer' => array(
                'label'           => esc_html__('Answer', 'divi_flash'),
                'type'            => 'tiny_mce',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle' => 'answer',
            ),
            'enable_question_image' => array(
                'label'          => esc_html__('Enable Question Image', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'child_faq_content',
                'sub_toggle' => 'question',
            ),
            'close_question_image' => array(
                'label'                 => esc_html__('Image', 'divi_flash'),
                'type'                  => 'upload',
                'upload_button_text'    => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'           => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'           => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'           => 'child_faq_content',
                'sub_toggle' => 'question',
                'show_if'        => array(
                    'enable_question_image'     => 'on',
                )
                // 'dynamic_content'    => 'image'
            ),
            'close_question_image_alt_text' => array(
                'label'                 => esc_html__('Image Alt Text', 'divi_flash'),
                'description'           => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'type'                  => 'text',
                'toggle_slug'           => 'child_faq_content',
                'sub_toggle'     => 'question',
                'show_if'        => array(
                    'enable_question_image'     => 'on',
                )
            ),
            'open_question_image' => array(
                'label'                 => esc_html__('Use different image on closing time.', 'divi_flash'),
                'type'                  => 'upload',
                'upload_button_text'    => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'           => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'           => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'           => 'child_faq_content',
                'sub_toggle' => 'question',
                'show_if'        => array(
                    'enable_question_image'     => 'on',
                )
                // 'dynamic_content'    => 'image'

            ),
            'open_question_image_alt_text' => array(
                'label'                 => esc_html__('Open Image Alt Text', 'divi_flash'),
                'description'           => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'type'                  => 'text',
                'toggle_slug'           => 'child_faq_content',
                'sub_toggle'            => 'question',
                'show_if'               => array(
                    'enable_question_image' => 'on'
                )
            ),
            'enable_answer_image' => array(
                'label'           => esc_html__('Enable Answer Image', 'divi_flash'),
                'type'            => 'yes_no_button',
                'default'         => 'off',
                'options'         => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug' => 'child_faq_content',
                'sub_toggle'  => 'answer',
            ),
            'answer_image' => array(
                'label'              => esc_html__('Answer Image', 'divi_flash'),
                'type'               => 'upload',
                'upload_button_text' => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'        => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'        => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'        => 'child_faq_content',
                'sub_toggle'         => 'answer',
                'show_if' => array(
                    'enable_answer_image' => 'on',
                )
                // 'dynamic_content'    => 'image'
            ),
            'answer_image_alt_text' => array(
                'label'                 => esc_html__('Answer Image Alt Text', 'divi_flash'),
                'description'           => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'type'                  => 'text',
                'toggle_slug'           => 'child_faq_content',
                'sub_toggle'            => 'answer',
                'show_if'               => array(
                    'enable_answer_image' => 'on'
                )
            ),
            'answer_image_placement' => array(
                'label'              => esc_html__('Image Placement', 'divi_flash'),
                'type'               => 'select',
                'default'            => 'top',
                'options'            => array(
                    'top'    => esc_html__('Top', 'divi_flash'),
                    'bottom' => esc_html__('Bottom', 'divi_flash'),
                    'left'   => esc_html__('Left', 'divi_flash'),
                    'right'  => esc_html__('Right', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle'      => 'answer',
                'show_if'         => array(
                    'enable_answer_image' => 'on',
                )
            ),
            'enable_answer_button' => array(
                'label'            => esc_html__('Enable Button', 'divi_flash'),
                'type'             => 'yes_no_button',
                'default'          => 'off',
                'options'          => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'      => 'child_faq_content',
                'sub_toggle'       => 'answer',
            ),
            'button_text' => array(
                'label'           => esc_html__('Button Text', 'divi_flash'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle'      => 'answer',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_url' => array(
                'label'           => esc_html__('Button URL', 'divi_flash'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle'      => 'answer',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_url_new_window' => array(
                'label'             => esc_html__('Button New tab ', 'divi_flash'),
                'description'       => esc_html__('Choose whether your link opens in a new window or not', 'divi_flash'),
                'type'              => 'select',
                'options'           => array(
                    'off' => esc_html__('In The Same Window', 'divi_flash'),
                    'on'  => esc_html__('In The New Tab', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_content',
                'sub_toggle'      => 'answer',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            // 'button_full_width'  => array(
            //     'label'             => esc_html__('Enable Button Fullwidth', 'divi_flash'),
            //     'type'              => 'yes_no_button',
            //     'options'           => array(
            //         'off' => esc_html__('Off', 'divi_flash'),
            //         'on'  => esc_html__('On', 'divi_flash')
            //     ),
            //     'default'           => 'off',
            //     'toggle_slug'       => 'button',
            //     'tab_slug'        => 'advanced'
            // ),
            // 'button_alignment' => array(
            //     'label'           => esc_html__('Button Alignment', 'divi_flash'),
            //     'type'            => 'text_align',
            //     'options'         => et_builder_get_text_orientation_options(array('justified')),
            //     'toggle_slug'     => 'button',
            //     'tab_slug'        => 'advanced',
            //     'mobile_options'  => true,
            //     'show_if'         => array(
            //         'button_full_width'     => 'off'
            //     )
            // ),
        ];

        return $faqItem;
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
     * @param array  $attrs       Rating of unprocessed attributes
     * @param string $content     Content being processed
     * @param string $render_slug Slug of module that is used for rendering output
     *
     * @return string module's rendered output
     * @since 1.0.0
     */

    public function render($attrs, $content, $render_slug)
    {
        // Faq script
        // wp_enqueue_script('df_faq');

        // Get all style
        $this->additional_css_styles($render_slug);

        // Display frontend
        $output = sprintf(
            '<div class="df_faq_item">

            <div class="faq_question_wrapper">

              <div class="faq_question_area">

                <div class="faq_question_image">
                  <div class="image_open"><img src="http://divi2.test/wp-content/uploads/2022/12/icon-256x256-1.png" alt="" /></div>
                </div>

                <div class="faq_question">
                  <h3>%1$s</h3>
                </div>
              </div>

              <div class="faq_icon">
                <div class="icon_open"><span class="">+</span></div>
              </div>

            </div>

            <div class="faq_answer_wrapper">
              <div class="faq_answer_area">
                <div class="faq_answer">
                  <p>%2$s</p>
                </div>
                <div class="faq_answer_image">
                  <img src="http://divi2.test/wp-content/uploads/2022/12/covid-donate.jpg" alt="" />
                </div>
              </div>
              <div class="faq_button">
                <a href="#" class="df_faq_btn">Button</a>
              </div>
            </div>

          </div>
          ',
            $this->props['question'],
            $this->props['answer']
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

    // public function df_render_content()
    // {

    // }
} //Class

new DIFL_FaqItem;
