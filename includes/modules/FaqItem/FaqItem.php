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
                    'content'      => esc_html__('Faq', 'divi_flash'),
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'design_question'                => esc_html__('Question', 'divi_flash'),
                    'design_answer'         => esc_html__('Answer', 'divi_flash'),
                    'design_title'                 => esc_html__('Title Style', 'divi_flash'),
                    'design_content'               => esc_html__('Content Style', 'divi_flash'),
                    'design_content_text'       => array(
                        'title' => esc_html__('Content Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $content_sub_toggles,
                    ),
                    'design_content_heading'       => array(
                        'title' => esc_html__('Content Heading Text', 'divi_flash'),
                        'tabbed_subtoggles' => true,
                        'sub_toggles'       => $heading_sub_toggles,
                    ),
                    'custom_spacing'        => esc_html__('Custom Spacing', 'divi_flash'),
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

        $content = [
            'question' => array(
                'label'           => esc_html__('Question', 'divi_flash'),
                'type'            => 'text',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'content'
            ),
            'answer' => array(
                'label'           => esc_html__('Answer', 'divi_flash'),
                'type'            => 'tiny_mce',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'content'
            ),
        ];

        return $content;

        // return array_merge(
        //     $content
        // );
    }

    /**
     * Declare advanced fields for the module
     *
     * @return array[]
     * @since 1.0.0
     */

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();

        // Disable fields
        $advanced_fields['text'] = false;

        $advanced_fields['fonts'] = [

            'rating'   => array(
                'label'              => esc_html__('Rating', 'divi_flash'),
                'toggle_slug'        => 'design_rating',
                'tab_slug'           => 'advanced',
                'hide_font'          => true,
                'hide_font_size'     => true,
                'hide_line_height'   => true,
                'hide_text_color'    => true,
                'hide_text_align'    => true,
                'hide_letter_spacing' => true,
                'css'      => array(
                    'main' => "$this->main_css_element .df-rating-icon .et-pb-icon, $this->main_css_element span.df-rating-icon-fill::before",
                    'hover' => "$this->main_css_element .df-rating-icon .et-pb-icon:hover, $this->main_css_element span.df-rating-icon-fill:hover::before"
                )
            ),

            'rating_number'   => array(
                'label'         => esc_html__('Rating Number', 'divi_flash'),
                'toggle_slug'   => 'design_rating_number',
                'tab_slug'        => 'advanced',
                'hide_line_height'   => true,
                'hide_text_align'    => true,
                'font_size' => array(
                    'default' => '20px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'      => array(
                    'main' => "$this->main_css_element span.df-rating-number",
                    'hover' => "$this->main_css_element span.df-rating-number:hover",
                )
            ),

            'title'   => array(
                'label'         => esc_html__('Title', 'divi_flash'),
                'toggle_slug'   => 'design_title',
                'tab_slug'        => 'advanced',
                'line_height' => array(
                    'default' => '1.7em',
                ),
                'font_size' => array(
                    'default' => '20px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'      => array(
                    'main' => "$this->main_css_element .df-rating-title",
                    'hover' => "$this->main_css_element .df-rating-title:hover",
                    'important' => 'all',
                )
            ),

            'content'   => array(
                'label'         => esc_html__('Content', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'   => 'design_content_text',
                'line_height' => array(
                    'default' => '1.7em',
                ),
                'font_size' => array(
                    'default' => '14px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'      => array(
                    'main' => "$this->main_css_element .df-rating-content",
                    'hover' => "$this->main_css_element .df-rating-content:hover",
                    'important' => 'all',
                ),
                // Content design
                'block_elements' => array(
                    'tabbed_subtoggles' => true,
                    'bb_icons_support'  => true,
                    'css'               => array(
                        'main'  => "$this->main_css_element .df-rating-content",
                        'hover' => "$this->main_css_element .df-rating-content:hover",
                    ),
                ),
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
                'main'  => "$this->main_css_element .df-rating-content h1",
                'hover' => "$this->main_css_element .df-rating-content h1:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h1',
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
                'main'  => "$this->main_css_element .df-rating-content h2",
                'hover' => "$this->main_css_element .df-rating-content h2:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h2',
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
                'main'  => "$this->main_css_element .df-rating-content h3",
                'hover' => "$this->main_css_element .df-rating-content h3:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h3',
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
                'main'  => "$this->main_css_element .df-rating-content h4",
                'hover' => "$this->main_css_element .df-rating-content h4:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h4',
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
                'main'  => "$this->main_css_element .df-rating-content h5",
                'hover' => "$this->main_css_element .df-rating-content h5:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h5',
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
                'main'  => "$this->main_css_element .df-rating-content h6",
                'hover' => "$this->main_css_element .df-rating-content h6:hover",
            ),
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'design_content_heading',
            'sub_toggle'  => 'h6',
        );

        $advanced_fields['borders'] = array(
            'default'               => array(),
            'rating_icon_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "$this->main_css_element .df-rating-icon",
                        'border_radii_hover' => "$this->main_css_element .df-rating-icon:hover",
                        'border_styles' => "$this->main_css_element .df-rating-icon",
                        'border_styles_hover' => "$this->main_css_element .df-rating-icon:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Rating', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),
            'title_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "$this->main_css_element .df-rating-title",
                        'border_radii_hover' => "$this->main_css_element .df-rating-title:hover",
                        'border_styles' => "$this->main_css_element .df-rating-title",
                        'border_styles_hover' => "$this->main_css_element .df-rating-title:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Title', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_title',
            ),
            'content_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "$this->main_css_element .df-rating-content",
                        'border_radii_hover' => "$this->main_css_element .df-rating-content:hover",
                        'border_styles' => "$this->main_css_element .df-rating-content",
                        'border_styles_hover' => "$this->main_css_element .df-rating-content:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Content', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_content',
            ),
        );

        $advanced_fields['box_shadow'] = array(
            'default'               => true,

            'rating_box_shadow'             => array(
                'label'    => esc_html__('Rating Box Shadow', 'divi_flash'),
                'css' => array(
                    'main' => "$this->main_css_element .df-rating-icon",
                    'hover' => "$this->main_css_element .df-rating-icon:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),

            'title_box_shadow'             => array(
                'label'    => esc_html__('Title Box Shadow', 'divi_flash'),
                'css' => array(
                    'main' => "$this->main_css_element .df-rating-title",
                    'hover' => "$this->main_css_element .df-rating-title:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_title',
            ),

            'content_box_shadow'             => array(
                'label'    => esc_html__('Content Box Shadow', 'divi_flash'),
                'css' => array(
                    'main' => "$this->main_css_element .df-rating-content",
                    'hover' => "$this->main_css_element .df-rating-content:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_content',
            ),

        );

        $advanced_fields['filters'] = array(
            'child_filters_target' => array(
                'label'    => esc_html__('Filter', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'filter',
                'css' => array(
                    'main' => "$this->main_css_element .df-rating-box-container",
                    'hover' => "$this->main_css_element .df-rating-box-container:hover"
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

    /**
     * Declare custom css fields for the module
     *
     *
     * @return array[]
     * @since 1.0.0
     */

    public function get_custom_css_fields_config()
    {
        return array(
            'rating_css' => array(
                'label'    => esc_html__('Rating', 'divi_flash'),
                'selector' => "$this->main_css_element .df-rating-icon .et-pb-icon",
            ),
            'rating_before_css' => array(
                'label'    => esc_html__('Rating Before', 'divi_flash'),
                'selector' => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
            ),
            'rating_number_css' => array(
                'label'    => esc_html__('Rating Number', 'divi_flash'),
                'selector' => "$this->main_css_element .df-rating-number",
            ),
            'rating_title_css' => array(
                'label'    => esc_html__('Rating Title', 'divi_flash'),
                'selector' => "$this->main_css_element .df-rating-title",
            ),
            'rating_content_css' => array(
                'label'    => esc_html__('Rating Content', 'divi_flash'),
                'selector' => "$this->main_css_element .df-rating-content",
            ),
        );
    }

    /**
     * Get CSS fields transition.
     *
     * Add form field options group and background image on the fields list.
     *
     * @since 1.0.0
     */

    public function get_transition_fields_css_props()
    {
        $fields = parent::get_transition_fields_css_props();

        $rating_rating_wrapper = "$this->main_css_element .df-rating-wrapper";
        $rating_icon = "$this->main_css_element .df-rating-icon";
        $rating_title = "$this->main_css_element .df-rating-title";
        $rating_content = "$this->main_css_element .df-rating-content";

        // Background
        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_bg',
            'selector'      => $rating_icon
        ));

        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_title_bg',
            'selector'      => $rating_title
        ));

        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_content_bg',
            'selector'      => $rating_content
        ));

        // Border
        $fields = $this->df_fix_border_transition(
            $fields,
            'rating_wrapper_border',
            $rating_rating_wrapper
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'rating_icon_border',
            $rating_icon
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'title_border',
            $rating_title
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'content_border',
            $rating_content
        );

        // Box Shadow
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'rating_box_wrapper_shadow',
            $rating_rating_wrapper
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'rating_box_shadow',
            $rating_icon
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'title_box_shadow',
            $rating_title
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'content_box_shadow',
            $rating_content
        );

        return $fields;
    }

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
        // Get all style
        $this->additional_css_styles($render_slug);

        // Display frontend
        $output = sprintf(
            '<div class="df_faq_container">
                %1$s
            </div>',
            $this->df_render_content()
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

    public function additional_css_styles($render_slug)
    {
        return;
    }

    public function df_render_content()
    {
        return sprintf(
            '<div class="df_faq_item active">
            <div class="faq_question">
              <div class="faq_question_image">
                <div class="image_open">
                  <img src="http://divi2.test/wp-content/uploads/2023/01/faq-demo-icons3.png" alt="" />
                </div>
                <div class="image_close">
                  <img src="#" alt="" />
                </div>
              </div>
              <h5 class="faq_title">%1$s</h5>
              <div class="faq_icon">
                <div class="icon_open">
                  <span class="">+</span>
                </div>
                <div class="icon_close">
                  <span class="">-</span>
                </div>
              </div>
            </div>

            <div class="faq_answer">
              <div class="faq_content_wrapper">
                <div class="faq_content">
                  <p>%2$s</p>
                </div>
                <div class="faq_answer_image">
                  <img src="#" alt="" />
                </div>
              </div>
              <div class="faq_button">
                <a href="#" class=""></a>
              </div>
            </div>
          </div>',
            $this->props['question'],
            $this->props['answer']
        );
    }
} //Class

new DIFL_FaqItem;
