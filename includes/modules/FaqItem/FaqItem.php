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
    public $parent_faq;
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

        $this->parent_faq = isset(self::get_parent_modules('page')['difl_faq']) ? self::get_parent_modules('page')['difl_faq'] : new stdClass;
        $this->child_title_var          = 'question';
        $this->child_title_fallback_var = 'question_type';

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
                'icon' => 'text-left'
            ),
            'a'     => array(
                'name' => 'A',
                'icon' => 'text-link'
            ),
            'ul'    => array(
                'name' => 'UL',
                'icon' => 'list'
            ),
            'ol'    => array(
                'name' => 'OL',
                'icon' => 'numbered-list'
            ),
            'quote' => array(
                'name' => 'QUOTE',
                'icon' => 'text-quote'
            ),
        );
        $heading_sub_toggles = array(
            'h1' => array(
                'name' => 'H1',
                'icon' => 'text-h1'
            ),
            'h2' => array(
                'name' => 'H2',
                'icon' => 'text-h2'
            ),
            'h3' => array(
                'name' => 'H3',
                'icon' => 'text-h3'
            ),
            'h4' => array(
                'name' => 'H4',
                'icon' => 'text-h4'
            ),
            'h5' => array(
                'name' => 'H5',
                'icon' => 'text-h5'
            ),
            'h6' => array(
                'name' => 'H6',
                'icon' => 'text-h6'
            ),
        );

        return array(
            'general'   => array(
                'toggles'      => array(
                    'child_faq_question'       => esc_html__('Question', 'divi_flash'),
                    'child_faq_answer'               => esc_html__('Answer', 'divi_flash'),
                    // 'child_faq_button'               => esc_html__('Button', 'divi_flash'),
                    // 'child_faq_image'  => [
                    //     'title'        => esc_html__('Image', 'divi_flash'),
                    //     'tabbed_subtoggles' => true,
                    //     'sub_toggles'  => [
                    //         'close'    => [
                    //             'name' => esc_html__('Close', 'divi_flash'),
                    //         ],
                    //         'open'     => [
                    //             'name' => esc_html__('Open', 'divi_flash'),
                    //         ],
                    //     ],
                    // ],
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'design_question'       => esc_html__('Question', 'divi_flash'),
                    'design_answer'         => esc_html__('Answer', 'divi_flash'),
                    'design_answer_text'    => array(
                        'title'             => esc_html__('Answer Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $content_sub_toggles,
                    ),
                    'design_answer_heading' => array(
                        'title' => esc_html__('Answer Heading Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $heading_sub_toggles,
                    ),
                    'design_button'         => esc_html__('Button', 'divi_flash'),
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
        $question = [
            'question' => array(
                'label'           => esc_html__('Question', 'divi_flash'),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_question'
            ),
            'question_title_tag'  => array(
                'label'           => esc_html__('Title Tag', 'divi_flash'),
                'description'     => esc_html__('Choose a tag to display your question.', 'divi_flash'),
                'type'            => 'select',
                'options'         => array(
                    'h1'   => esc_html__('H1 tag', 'divi_flash'),
                    'h2'   => esc_html__('H2 tag', 'divi_flash'),
                    'h3'   => esc_html__('H3 tag', 'divi_flash'),
                    'h4'   => esc_html__('H4 tag', 'divi_flash'),
                    'h5'   => esc_html__('H5 tag', 'divi_flash'),
                    'h6'   => esc_html__('H6 tag', 'divi_flash'),
                    'p'    => esc_html__('P tag', 'divi_flash'),
                    'span' => esc_html__('Span tag', 'divi_flash'),
                    'div'  => esc_html__('Div tag', 'divi_flash')
                ),
                'toggle_slug'      => 'child_faq_question',
                'default'          => 'h3'
            ),
            'enable_question_image' => array(
                'label'          => esc_html__('Enable Question Image', 'divi_flash'),
                'type'           => 'yes_no_button',
                'default'        => 'off',
                'options'        => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'    => 'child_faq_question'
            ),
            'close_question_image' => array(
                'label'                 => esc_html__('Image', 'divi_flash'),
                'type'                  => 'upload',
                'upload_button_text'    => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'           => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'           => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'           => 'child_faq_question',
                'show_if' => array(
                    'enable_question_image' => 'on'
                )
            ),
            'close_que_img_alt_txt' => array(
                'label'                 => esc_html__('Image Alt Text', 'divi_flash'),
                'description'           => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'default'               => 'Close image ALT text',
                'type'                  => 'text',
                'toggle_slug'           => 'child_faq_question',
                'show_if'        => array(
                    'enable_question_image' => 'on'
                )
            ),
            'open_question_image' => array(
                'label'                 => esc_html__('Use different image on opening time.', 'divi_flash'),
                'type'                  => 'upload',
                'upload_button_text'    => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'           => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'           => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'           => 'child_faq_question',
                'show_if'        => array(
                    'enable_question_image' => 'on'
                )
            ),
            'open_que_img_alt_txt' => array(
                'label'        => esc_html__('Open Image Alt Text', 'divi_flash'),
                'description'  => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'default'      => 'Open image ALT text',
                'type'         => 'text',
                'toggle_slug'  => 'child_faq_question',
                'show_if'      => array(
                    'enable_question_image' => 'on'
                )
            ),
            'question_image_placement' => array(
                'label'           => esc_html__('Image Placement', 'divi_flash'),
                'type'            => 'select',
                'default'         => 'inherit',
                'options'         => array(
                    'inherit'     => esc_html__('Left', 'divi_flash'),
                    'row-reverse' => esc_html__('Right', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_question',
                'mobile_options'  => true,
                'show_if' => array(
                    'enable_question_image' => 'on'
                )
            )
        ];

        $answer = [
            'answer' => array(
                'label'           => esc_html__('Answer', 'divi_flash'),
                'type'            => 'tiny_mce',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_answer'
            ),
            'enable_answer_image' => array(
                'label'           => esc_html__('Enable Image', 'divi_flash'),
                'type'            => 'yes_no_button',
                'default'         => 'off',
                'options'         => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug' => 'child_faq_answer'
            ),
            'answer_image' => array(
                'label'              => esc_html__('Answer Image', 'divi_flash'),
                'type'               => 'upload',
                'upload_button_text' => esc_attr__('Upload an image', 'divi_flash'),
                'choose_text'        => esc_attr__('Choose an Image', 'divi_flash'),
                'update_text'        => esc_attr__('Set As Image', 'divi_flash'),
                'toggle_slug'        => 'child_faq_answer',
                'dynamic_content'    => 'image',
                'show_if' => array(
                    'enable_answer_image' => 'on'
                )
            ),
            'answer_image_alt_text' => array(
                'label'             => esc_html__('Image Alt Text', 'divi_flash'),
                'description'       => esc_html__('This defines the HTML ALT text. A short description of your image can be placed here.', 'divi_flash'),
                'type'              => 'text',
                'default'           => 'FAQ answer image',
                'toggle_slug'       => 'child_faq_answer',
                'show_if'           => array(
                    'enable_answer_image' => 'on'
                )
            ),
            'answer_image_width'=> array(
                'label'         => esc_html__('Image Width', 'divi_flash'),
                'type'          => 'range',
                'range_settings'=> array(
                    'step'      => '1',
                    'min'       => '1',
                    'min_limit' => '1',
                    'max'       => '100',
                    'max_limit' => '100'
                ),
                'toggle_slug'   => 'child_faq_answer',
                'validate_unit' => true,
                'allowed_units' => array('%', 'em', 'px'),
                'default_unit'  => '%',
                'default'       => '100%',
                'show_if'       => array(
                    'enable_answer_image' => 'on'
                ),
                'mobile_options'    => true
            ),
            'answer_image_placement' => array(
                'label'              => esc_html__('Image Placement', 'divi_flash'),
                'type'               => 'select',
                'default'            => 'bottom',
                'options'            => array(
                    'column'        => esc_html__('Bottom', 'divi_flash'),
                    'column-reverse' => esc_html__('Top', 'divi_flash'),
                    'row-reverse'   => esc_html__('Left', 'divi_flash'),
                    'row'           => esc_html__('Right', 'divi_flash'),
                ),
                'option_category'    => 'basic_option',
                'toggle_slug'        => 'child_faq_answer',
                'show_if'            => array(
                    'enable_answer_image' => 'on'
                ),
                'mobile_options'     => true
            )
        ];

        $button = [
            'enable_answer_button' => array(
                'label'            => esc_html__('Enable Button', 'divi_flash'),
                'type'             => 'yes_no_button',
                'default'          => 'off',
                'options'          => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'      => 'child_faq_answer'
            ),
            'button_text' => array(
                'label'           => esc_html__('Button Text', 'divi_flash'),
                'type'            => 'text',
                'default'         => esc_html__('Button', 'divi_flash'),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_answer',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_url' => array(
                'label'           => esc_html__('Button URL', 'divi_flash'),
                'type'            => 'text',
                'default'         => '#',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_answer',
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
                    'on'  => esc_html__('In The New Tab', 'divi_flash')
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'child_faq_answer',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_full_width'     => array(
                'label'             => esc_html__('Enable Button Full Width', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'         => 'off',
                'toggle_slug'     => 'design_button',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_alignment'    => array(
                'label'           => esc_html__('Button Alignment', 'divi_flash'),
                'type'            => 'text_align',
                'options'         => et_builder_get_text_orientation_options(array('justified')),
                'toggle_slug'     => 'design_button',
                'tab_slug'        => 'advanced',
                'mobile_options'  => true,
                'show_if'         => array(
                    'enable_answer_button' => 'on',
                    'button_full_width'   => 'off'
                )
            ),
        ];

        $button_icon = array(
            'use_button_icon' => array(
                'label'       => esc_html__('Use Icon', 'divi_flash'),
                'type'        => 'yes_no_button',
                'options'     => array(
                    'off' => esc_html__('No', 'divi_flash'),
                    'on'  => esc_html__('Yes', 'divi_flash')
                ),
                'affects'               => array(
                    'button_font_icon',
                    'button_icon_size',
                    'button_icon_color',
                    'button_icon_placement'
                ),
                'description'           => esc_html__('Here you can choose whether icon set below should be used.', 'divi_flash'),
                'default'               => 'off',
                'toggle_slug'           => 'child_faq_answer',
                'show_if' => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_font_icon' => array(
                'label'               => esc_html__('Icon', 'divi_flash'),
                'type'                => 'select_icon',
                'class'               => array('et-pb-font-icon'),
                'default'             => '5',
                'toggle_slug'         => 'child_faq_answer',
                'description'         => esc_html__('Choose an icon to display with your blurb.', 'divi_flash'),
                'depends_show_if'     => 'on'
            ),
            'button_icon_placement'   => array(
                'label'             => esc_html__('Icon Placement', 'divi_flash'),
                'type'              => 'select',
                'options'           => array(
                    'left'          => esc_html__('Left', 'divi_flash'),
                    'right'         => esc_html__('Right', 'divi_flash')
                ),
                'default'           => 'right',
                'toggle_slug'       => 'child_faq_answer',
                'depends_show_if'   => 'on'
            ),
            'button_icon_size' => array(
                'label'             => esc_html__('Button Icon Size', 'divi_flash'),
                'type'              => 'range',
                'toggle_slug'       => 'design_button',
                'tab_slug'          => 'advanced',
                'default'           => '20px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '0',
                    'max'  => '100',
                    'step' => '1'
                ),
                'responsive'        => true,
                'mobile_options'    => true,
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            ),
            'button_icon_color' => array(
                'label'             => esc_html__('Button Icon Color', 'divi_flash'),
                'type'              => 'color-alpha',
                'description'       => esc_html__('Here you can define a custom color for your icon.', 'divi_flash'),
                'toggle_slug'       => 'design_button',
                'tab_slug'          => 'advanced',
                'hover'             => 'tabs',
                'show_if'         => array(
                    'enable_answer_button' => 'on'
                )
            )
        );

        // $ans_button_bg = $this->df_add_bg_field(array(
        //     'label'                 => 'Background',
        //     'key'                   => 'ans_button_bg',
        //     'toggle_slug'           => 'design_button',
        //     'tab_slug'              => 'advanced'
        // ));

        // $ans_btn_margin = $this->add_margin_padding(array(
        //     'title'         => 'Answer Button',
        //     'key'           => 'ans_button',
        //     'toggle_slug'   => 'design_button'
        // ));

        return array_merge(
            $question,
            $answer,
            $button,
            $button_icon,
            // $ans_button_bg,
            // $ans_btn_margin
        );
    }

    // public function get_advanced_fields_config(){}

    // public function get_custom_css_fields_config(){}

    // public function get_transition_fields_css_props(){}

    public function additional_css_styles($render_slug)
    {
        if ('on' === $this->props['use_button_icon']) {
            $this->generate_styles(
                array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    => $render_slug,
                    'base_attr_name' => 'button_font_icon',
                    'important'      => true,
                    'selector'       => '%%order_class%% .et-pb-icon.df-faq-button-icon',
                    'processor'      => array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon'
                    )
                )
            );
        }

        // Button icon
        if ('on' === $this->props['use_button_icon']) {
            $this->df_process_color(array(
                'render_slug'       => $render_slug,
                'slug'              => 'button_icon_color',
                'type'              => 'color',
                'selector'          => "%%order_class%% .faq_button a .et-pb-icon",
                'hover'             => '%%order_class%% .faq_button a:hover .et-pb-icon'
            ));

            $this->df_process_range(array(
                'render_slug'       => $render_slug,
                'slug'              => 'button_icon_size',
                'type'              => 'font-size',
                'default'           => '21px',
                'selector'          => "%%order_class%% .faq_button .et-pb-icon"
            ));
        }

        // question image placement
        if ('inherit' !== $this->props['question_image_placement']) {
            $this->generate_styles(
                array(
                    'base_attr_name' => 'question_image_placement',
                    'selector'       => "$this->main_css_element .faq_question_area",
                    'css_property'   => 'flex-direction',
                    'render_slug'    => $render_slug,
                    'type'           => 'align',
                    'important'      => true
                )
            );
        }

        // answer image width
        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'answer_image_width',
            'type'              => 'width',
            'selector'          => "$this->main_css_element .faq_answer_image"
        ));

        // answer image placement
        $this->generate_styles(
            array(
                'base_attr_name' => 'answer_image_placement',
                'selector'       => "$this->main_css_element .faq_answer_area",
                'css_property'   => 'flex-flow',
                'render_slug'    => $render_slug,
                'type'           => 'align',
                'important'      => true
            )
        );

        // button design
        if ('on' === $this->props['button_full_width']) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector'    => "$this->main_css_element .faq_button a",
                'declaration' => 'display: block !important;'
            ));
        }

        if ('off' === $this->props['button_full_width'] &&  '' !== $this->props['button_alignment']) {
            $this->df_process_string_attr(array(
                'render_slug'       => $render_slug,
                'slug'              => 'button_alignment',
                'type'              => 'text-align',
                'selector'          => "%%order_class%% .faq_button",
                'default'           => 'left'
            ));
        }
    }

    public function df_render_question()
    {
        $close_q_img = !empty($this->props['close_question_image']) ? $this->props['close_question_image'] : "";
        $close_q_img_alt = !empty($this->props['close_que_img_alt_txt']) ? $this->props['close_que_img_alt_txt'] : "";
        $open_q_img = !empty($this->props['open_question_image']) ? $this->props['open_question_image'] : $close_q_img;
        $open_q_img_alt = !empty($this->props['open_que_img_alt_txt']) ? $this->props['open_que_img_alt_txt'] : $close_q_img_alt;
        $que_img_html = 'on' === $this->props['enable_question_image'] ?
            sprintf(
                '<div class="faq_question_image">
                    <div class="close_image">%1$s</div>
                    <div class="open_image">%2$s</div>
                </div>',
                $this->df_render_faq_image($close_q_img, $close_q_img_alt),
                $this->df_render_faq_image($open_q_img, $open_q_img_alt)
            ) : '';
        $que_title_tag = esc_attr($this->props['question_title_tag']);
        $que_html = "" !== $this->props['question'] ?
            sprintf(
                '<div class="faq_question"><%1$s class="faq_question_title">%2$s</%1$s></div>',
                et_pb_process_header_level($que_title_tag, 'h3'),
                $this->props['question'] ? $this->props['question'] : ""
            ) : '';
        $icon_html =  sprintf(
            '<div class="faq_icon">%1$s</div>',
            $this->df_render_faq_toggle_icon()
        );

        $output = sprintf(
            '<div class="faq_question_wrapper">
                <div class="faq_question_area">
                    %1$s
                    %2$s
                </div>
                %3$s
            </div>
          ',
            $que_img_html,
            $que_html,
            $icon_html
        );

        return $output;
    }

    public function df_render_answer()
    {
        $ans_html = $this->props['answer'] !== '' ? sprintf('<div class="faq_answer">%1$s</div>', $this->props['answer']) : '';
        $ans_img = !empty($this->props['answer_image']) ? $this->props['answer_image'] : '';
        $ans_img_html  = 'on' === $this->props['enable_answer_image'] ?
            sprintf(
                '<div class="faq_answer_image">%1$s</div>',
                $this->df_render_faq_image($ans_img, $this->props['answer_image_alt_text'])
            ) : "";

        $output = sprintf(
            '<div class="faq_answer_wrapper">
                <div class="faq_answer_area">
                    %1$s
                    %2$s
                </div>
                    %3$s
            </div>',
            $ans_html,
            $ans_img_html,
            $this->props['enable_answer_button'] ? $this->df_render_button() : ""
        );

        return $output;
    }

    public function df_render_faq_image($img_prop, $img_alt)
    {
        if (isset($img_prop) && '' !== $img_prop) {
            $image_alt = '' !== $img_alt ? $img_alt  : df_image_alt_by_url($img_prop);
            return sprintf(
                '<img src="%1$s" alt="%2$s" />',
                $img_prop,
                $image_alt
            );
        }
    }

    public function df_render_faq_toggle_icon()
    {
        $close_faq_icon = !empty($this->parent_faq->props['close_faq_icon']) ?  esc_attr(et_pb_process_font_icon($this->parent_faq->props['close_faq_icon'])) : '5';
        $open_faq_icon = !empty($this->parent_faq->props['open_faq_icon']) ?  esc_attr(et_pb_process_font_icon($this->parent_faq->props['open_faq_icon'])) : '5';

        if (!empty($close_faq_icon)) {
            return sprintf(
                '<div class="close_icon"><span class="et-pb-icon">%1$s</span></div>
                <div class="open_icon"><span class="et-pb-icon">%2$s</span></div>',
                $close_faq_icon,
                $open_faq_icon
            );
        }
    }

    public function df_render_button()
    {
        $text = isset($this->props['button_text']) ? $this->props['button_text'] : '';
        $url = isset($this->props['button_url']) ? $this->props['button_url'] : '';
        $target = $this->props['button_url_new_window'] === 'on'  ?
            'target="_blank"' : '';

        $button_font_icon = $this->props['button_font_icon'];
        $button_icon_pos = $this->props['button_icon_placement'];

        // Button icon
        $button_icon = $this->props['use_button_icon'] !== 'off' ? sprintf(
            '<span class="et-pb-icon df-faq-button-icon">%1$s</span>',
            $button_font_icon !== '' ? esc_attr(et_pb_process_font_icon($button_font_icon)) : '5'
        ) : '';
        if ('on' === $this->props['enable_answer_button']) {
            return sprintf(
                '<div class="faq_button">
                    <a href="%1$s" %3$s data-icon="5">%5$s <span>%2$s</span> %4$s</a>
                </div>',
                esc_attr($url),
                esc_html(trim($text)),
                $target,
                $button_icon_pos === 'right' ? $button_icon : '',
                $button_icon_pos === 'left' ? $button_icon : ''
            );
        } else {
            return '';
        }
    }

    public function render($attrs, $content, $render_slug)
    {
        // Scripts
        wp_enqueue_script('animejs');
        wp_enqueue_script('df_faq');

        // Get all styles
        $this->additional_css_styles($render_slug);

        // Schema Data
        global $df_faq_schema_data;
        $df_faq_class = ET_Builder_Element::get_module_order_class($render_slug);
        $df_faq_schema_data[$df_faq_class]['question'] = wp_strip_all_tags($this->props['question']);
        $df_faq_schema_data[$df_faq_class]['answer'] = wp_strip_all_tags($this->props['answer']);

        // JS data
        $active_item = 'on' === $this->parent_faq->props['activate_on_first_time'] ? $this->parent_faq->props['active_item_order_number'] : '1';
        $data_settings = [
            'faq_layout'               => $this->parent_faq->props['faq_layout'],
            'activate_on_first_time'   => $this->parent_faq->props['activate_on_first_time'],
            'active_item_order_number' => $active_item,
            'enable_faq_animation'     => $this->parent_faq->props['enable_faq_animation'],
            'faq_animation'            => $this->parent_faq->props['faq_animation'],
            'enable_icon_animation'           => $this->parent_faq->props['enable_icon_animation'],
            'enable_que_img_animation' => $this->parent_faq->props['enable_que_img_animation'],
        ];

        $output = sprintf(
            '<div class="df_faq_item" data-settings=\'%3$s\'>
                %1$s
                %2$s
            </div>',
            $this->df_render_question(),
            $this->df_render_answer(),
            json_encode($data_settings)
        );

        return $output;
    }
} //Class

new DIFL_FaqItem;
