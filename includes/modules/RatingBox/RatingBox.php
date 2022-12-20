<?php
if (!class_exists('ET_Builder_Element')) {
    return;
}

class DIFL_RatingBox extends ET_Builder_Module
{
    public $slug       = 'difl_ratingbox';
    public $vb_support = 'on';
    use DF_UTLS;

    protected $module_credits = array(
        'module_uri' => '',
        'author'     => 'DiviFlash',
        'author_uri' => '',
    );

    public function init()
    {
        $this->name = esc_html__('Rating box', 'divi_flash');
        $this->main_css_element = "%%order_class%%";
        $this->icon_path        =  DIFL_ADMIN_DIR_PATH . 'img/module-icons/advanced-heading.svg';
    }

    public function get_settings_modal_toggles()
    {
        return array(
            'general'   => array(
                'toggles'      => array(
                    'rating'      => esc_html__('Rating', 'divi_flash'),
                    'content'      => esc_html__('Content', 'divi_flash'),
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    // 'design_rating_box'            => esc_html__('Rating Box Wrapper', 'divi_flash'),
                    'design_rating'                => esc_html__('Rating', 'divi_flash'),
                    'design_rating_number'                => esc_html__('Rating Number', 'divi_flash'),
                    'design_title'                 => esc_html__('Title', 'divi_flash'),
                    'design_content'               => esc_html__('Content', 'divi_flash'),
                    'custom_spacing'        => esc_html__('Custom Spacing', 'divi_flash')
                )
            ),
        );
    }

    /**
     *
     * All fields
     *
     * @return array
     *
     */

    public function get_fields()
    {
        $rating = [
            'enable_rating_icon'  => array(
                'label'             => esc_html__('Enable Rating Icon', 'divi_flash'),
                'description'     => esc_html__('Enable Rating Icon.', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'rating',
            ),

            'rating_icon'          => array(
                'label'             => esc_html__('Rating Icon', 'divi_flash'),
                'description'     => esc_html__('Rating Icon.', 'divi_flash'),
                'type'              => 'select_icon',
                'default'           => '&#xe033;',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'rating',
                'show_if'         => array(
                    'enable_rating_icon'     => 'on'
                )
            ),

            'rating_color' => array(
                'label'           => esc_html__('Rating color', 'divi_flash'),
                'description'     => esc_html__('Add rating color.', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_rating_icon'     => 'off'
                )
            ),

            'rating_color_active' => array(
                'label'           => esc_html__('Active color', 'divi_flash'),
                'description'     => esc_html__('Add active rating color.', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_rating_icon'     => 'on'
                )
            ),

            'rating_color_inactive' => array(
                'label'           => esc_html__('Inactive color', 'divi_flash'),
                'description'     => esc_html__('Add inactive rating color.', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_rating_icon'     => 'on'
                )
            ),

            'rating_scale_type' => array(
                'label'           => esc_html__('Rating Scale Type', 'divi_flash'),
                'description'     => esc_html__('Choose Rating Scale Type', 'divi_flash'),
                'type'            => 'select',
                'default'           => '5',
                'options'         => array(
                    '5' => esc_html__('0-5', 'divi_flash'),
                    '10'  => esc_html__('0-10', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
            ),

            'rating_value_5' => array(
                'label'             => esc_html__('Rating Value', 'divi_flash'),
                'description'     => esc_html__('Rating value.', 'divi_flash'),
                'type'              => 'range',
                // 'default'           => '5',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '5',
                    'step' => '0.1'
                ),
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'rating_scale_type'     => '5'
                )
            ),

            'rating_value_10' => array(
                'label'             => esc_html__('Rating Value', 'divi_flash'),
                'description'     => esc_html__('Rating value.', 'divi_flash'),
                'type'              => 'range',
                // 'default'           => '10',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '10',
                    'step' => '0.1'
                ),
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'rating_scale_type'     => '10'
                )
            ),

            // Title
            'enable_title'  => array(
                'label'             => esc_html__('Enable Title', 'divi_flash'),
                'description'     => esc_html__('Rating box title enable or disable.', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'rating',
            ),

            'title' => array(
                'label'           => esc_html__('Title', 'divi_flash'),
                'description'     => esc_html__('Rating box title.', 'divi_flash'),
                'type'            => 'text',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_title'     => 'on'
                )
            ),

            'title_display_type' => array(
                'label'           => esc_html__('Title Display Type', 'divi_flash'),
                'description'     => esc_html__('Title Display Type', 'divi_flash'),
                'type'            => 'select',
                'default'           => 'block',
                'options'         => array(
                    'block' => esc_html__('Block', 'divi_flash'),
                    'inline'  => esc_html__('Inline', 'divi_flash'),
                ),
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_title'     => 'on'
                )
            ),

            'title_placement_top_bottom' => array(
                'label'           => esc_html__('Title Placement', 'divi_flash'),
                'description'     => esc_html__('Title Placement', 'divi_flash'),
                'type'            => 'select',
                'options'         => array(
                    'top' => esc_html__('Top', 'divi_flash'),
                    'bottom'  => esc_html__('Bottom', 'divi_flash'),
                ),
                'default'           => 'bottom',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'title_display_type'     => 'block',
                    'enable_title' => 'on'
                )
            ),

            'title_placement_left_right' => array(
                'label'           => esc_html__('Title Placement', 'divi_flash'),
                'description'     => esc_html__('Title Placement', 'divi_flash'),
                'type'            => 'select',
                'options'         => array(
                    'right'  => esc_html__('Right', 'divi_flash'),
                    'left' => esc_html__('Left', 'divi_flash'),
                ),
                'default'           => 'right',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'title_display_type'     => 'inline'
                )
            ),

            'rating_icon_align'  => array(
                'label'           => esc_html__('Rating Alignment', 'divi_flash'),
                'description'     => esc_html__('Rating Alignment.', 'divi_flash'),
                'type'            => 'text_align',
                'option_category' => 'basic_option',
                'options'         => et_builder_get_text_orientation_options(
                    array('justified')
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
                'default_on_front' => 'center',
                'options_icon'     => 'module_align',
                // 'advanced_fields' => true,
                'mobile_options'  => true,
                'show_if'         => array(
                    'title_display_type'     => 'block'
                )
            ),

            'enable_rating_number'  => array(
                'label'             => esc_html__('Show Rating number', 'divi_flash'),
                'description'     => esc_html__('Show Rating number or text.', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'rating',
            ),

            'rating_number_placement_left_right' => array(
                'label'           => esc_html__('Rating Number Placement', 'divi_flash'),
                'description'     => esc_html__('Rating Number Placement', 'divi_flash'),
                'type'            => 'select',
                'options'         => array(
                    'right'  => esc_html__('Right', 'divi_flash'),
                    'left' => esc_html__('Left', 'divi_flash'),
                ),
                'default'           => 'right',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_rating_number'     => 'on'
                )
            ),

            'rating_number_space' => array(
                'label'             => esc_html__('Rating number spacing', 'divi_flash'),
                'description'     => esc_html__('Set number spacing.', 'divi_flash'),
                'type'              => 'custom_margin',
                'hover'             => 'tabs',
                'responsive'        => true,
                'mobile_options'    => true,
                'toggle_slug'       => 'design_rating_number',
                'tab_slug'          => 'advanced',
            ),

            'rating_icon_size' => array(
                'label'             => esc_html__('Rating Size', 'divi_flash'),
                'description'     => esc_html__('Set rating size.', 'divi_flash'),
                'type'              => 'range',
                'default'           => '20px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1'
                ),
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced'
            ),

            'rating_icon_space' => array(
                'label'             => esc_html__('Space between icons', 'divi_flash'),
                'description'     => esc_html__('Add space between rating icons.', 'divi_flash'),
                'type'              => 'range',
                'hover'             => 'tabs',
                'responsive'        => true,
                'default'           => '2px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1'
                ),
                'toggle_slug'       => 'design_rating',
                'tab_slug'          => 'advanced',
            ),
        ];

        $content = [
            'enable_content'  => array(
                'label'             => esc_html__('Content Enable', 'divi_flash'),
                'description'     => esc_html__('Rating box content enable or disable.', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'content',
            ),
            'content' => array(
                'label'           => esc_html__('Content', 'divi_flash'),
                'type'            => 'tiny_mce',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Rating box description.', 'divi_flash'),
                'toggle_slug'     => 'content',
                'show_if'         => array(
                    'enable_content'     => 'on'
                )
            ),
        ];

        ///// Background //

        $rating_box_bg = $this->df_add_bg_field(array(
            'label'                 => 'Rating Box Background',
            'key'                   => 'rating_box_bg',
            'toggle_slug'           => 'design_rating',
            'tab_slug'              => 'advanced'
        ));

        $rating_bg = $this->df_add_bg_field(array(
            'label'                 => 'Rating Background',
            'key'                   => 'rating_bg',
            'toggle_slug'           => 'design_rating',
            'tab_slug'              => 'advanced'
        ));

        $rating_title_bg = $this->df_add_bg_field(array(
            'label'                 => 'Rating Title Background',
            'key'                   => 'rating_title_bg',
            'toggle_slug'           => 'design_title',
            'tab_slug'              => 'advanced'
        ));

        $rating_content_bg = $this->df_add_bg_field(array(
            'label'                 => 'Rating Content Background',
            'key'                   => 'rating_content_bg',
            'toggle_slug'           => 'design_content',
            'tab_slug'              => 'advanced'
        ));

        ///// Spacing //

        $rating_rating_wrapper = $this->add_margin_padding(array(
            'title'             => 'Rating wrapper',
            'key'               => 'rating_box',
            'toggle_slug'       => 'margin_padding'
        ));

        $rating_rating_icon = $this->add_margin_padding(array(
            'title'             => 'Rating icon',
            'key'               => 'rating_box_icon',
            'toggle_slug'       => 'margin_padding'
        ));

        $rating_rating_title = $this->add_margin_padding(array(
            'title'             => 'Rating title',
            'key'               => 'rating_box_title',
            'toggle_slug'       => 'margin_padding'
        ));

        $rating_rating_content = $this->add_margin_padding(array(
            'title'             => 'Rating content',
            'key'               => 'rating_box_content',
            'toggle_slug'       => 'margin_padding'
        ));

        // Return all values
        return array_merge(
            $rating_box_bg,
            $rating_bg,
            $rating,
            $rating_title_bg,
            $rating_content_bg,
            $content,
            $rating_rating_wrapper,
            $rating_rating_icon,
            $rating_rating_title,
            $rating_rating_content
        );
    }

    /**
     *
     * Advanced fields configuration
     *
     * @return array
     *
     */

    public function get_advanced_fields_config()
    {
        $advanced_fields = array();

        // Disable fields
        $advanced_fields['text'] = false;

        $advanced_fields['fonts'] = [

            // Rating Icon
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
                    'main' => "%%order_class%% .df-rating-icon .et-pb-icon, %%order_class%% span.df-rating-icon-fill::before",
                    'hover' => "%%order_class%% .df-rating-icon .et-pb-icon:hover, %%order_class%% span.df-rating-icon-fill:hover::before",
                    // 'important' => 'all',
                )
            ),

            // Rating Icon Number
            'rating_number'   => array(
                'label'         => esc_html__('Rating icon number', 'divi_flash'),
                'toggle_slug'   => 'design_rating_number',
                'tab_slug'        => 'advanced',
                'line_height' => array(
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '20px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'      => array(
                    'main' => "%%order_class%% .df-rating-number",
                    'hover' => "%%order_class%% .df-rating-number:hover",
                )
            ),

            // Title
            'title'   => array(
                'label'         => esc_html__('Title', 'divi_flash'),
                'toggle_slug'   => 'design_title',
                'tab_slug'        => 'advanced',
                'line_height' => array(
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '22px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'header_level' => array(
                    'default' => 'h3',
                ),
                'css'      => array(
                    'main' => "%%order_class%% .df-rating-title",
                    'hover' => "%%order_class%% .df-rating-title:hover",
                )
            ),

            // Content
            'content'   => array(
                'label'         => esc_html__('Content', 'divi_flash'),
                'toggle_slug'   => 'design_content',
                'tab_slug'        => 'advanced',
                'line_height' => array(
                    'default' => '1em',
                ),
                'font_size' => array(
                    'default' => '18px',
                ),
                'font-weight' => array(
                    'default' => 'normal'
                ),
                'css'      => array(
                    'main' => "%%order_class%% .df-rating-content",
                    'hover' => "%%order_class%% .df-rating-content:hover",
                    'important' => 'all',
                ),
            ),
        ];

        $advanced_fields['borders'] = array(
            'default'               => array(),
            'rating_wrapper_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "%%order_class%% .df-rating-wrapper",
                        'border_radii_hover' => "%%order_class%% .df-rating-wrapper:hover",
                        'border_styles' => "%%order_class%% .df-rating-wrapper",
                        'border_styles_hover' => "%%order_class%% .df-rating-wrapper:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Rating Wrapper', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),
            'rating_icon_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "%%order_class%% .df-rating-icon",
                        'border_radii_hover' => "%%order_class%% .df-rating-icon:hover",
                        'border_styles' => "%%order_class%% .df-rating-icon",
                        'border_styles_hover' => "%%order_class%% .df-rating-icon:hover",
                    )
                ),
                'label_prefix'    => esc_html__('Rating', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),
            'title_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "%%order_class%% .df-rating-title",
                        'border_radii_hover' => "%%order_class%% .df-rating-title:hover",
                        'border_styles' => "%%order_class%% .df-rating-title",
                        'border_styles_hover' => "%%order_class%% .df-rating-title:hover",
                    )
                ),
                'label'    => esc_html__('Title', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_title',
            ),
            'content_border'         => array(
                'css'               => array(
                    'main'  => array(
                        'border_radii' => "%%order_class%% .df-rating-content",
                        'border_radii_hover' => "%%order_class%% .df-rating-content:hover",
                        'border_styles' => "%%order_class%% .df-rating-content",
                        'border_styles_hover' => "%%order_class%% .df-rating-content:hover",
                    )
                ),
                'label'    => esc_html__('Content', 'divi_flash'),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_content',
            ),
        );

        $advanced_fields['box_shadow'] = array(
            'default'               => true,

            'rating_box_wrapper_shadow'             => array(
                'label'    => esc_html__('Rating box wrapper shadow', 'divi_flash'),
                'css' => array(
                    'main' => "%%order_class%% .df-rating-box-wrapper",
                    'hover' => "%%order_class%% .df-rating-box-wrapper:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),

            'rating_box_shadow'             => array(
                'label'    => esc_html__('Rating box shadow', 'divi_flash'),
                'css' => array(
                    'main' => "%%order_class%% .df-rating-icon",
                    'hover' => "%%order_class%% .df-rating-icon:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
            ),

            'title_box_shadow'             => array(
                'label'    => esc_html__('Title box shadow', 'divi_flash'),
                'css' => array(
                    'main' => "%%order_class%% .df-rating-title",
                    'hover' => "%%order_class%% .df-rating-title:hover",
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_title',
            ),

            'content_box_shadow'             => array(
                'label'    => esc_html__('Content box shadow', 'divi_flash'),
                'css' => array(
                    'main' => "%%order_class%% .df-rating-content",
                    'hover' => "%%order_class%% .df-rating-content:hover",
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
                    'main' => '%%order_class%% .df-rating-box-wrapper',
                    'hover' => '%%order_class%% .df-rating-box-wrapper:hover'
                ),
            ),
        );

        $advanced_fields['margin_padding'] = array(
            'css'   => array(
                'important' => 'all'
            )
        );

        return $advanced_fields;
    }

    /**
     *
     * Custom css fields
     *
     * @return array
     *
     */

    public function get_custom_css_fields_config()
    {
        return array(
            'rating_css' => array(
                'label'    => esc_html__('Rating', 'divi_flash'),
                'selector' => '%%order_class%% .df-rating-icon .et-pb-icon',
            ),
            'rating_number_css' => array(
                'label'    => esc_html__('Rating Number', 'divi_flash'),
                'selector' => '%%order_class%% .df-rating-number',
            ),
            'rating_title_css' => array(
                'label'    => esc_html__('Rating Title', 'divi_flash'),
                'selector' => '%%order_class%% .df-rating-title',
            ),
            'rating_content_css' => array(
                'label'    => esc_html__('Rating Content', 'divi_flash'),
                'selector' => '%%order_class%% .df-rating-content',
            ),
        );
    }

    public function get_transition_fields_css_props()
    {
        $fields = parent::get_transition_fields_css_props();

        // Background
        $rating_rating_wrapper_bg = '%%order_class%% .df-rating-wrapper';
        $rating_rating_bg = '%%order_class%% .df-rating-icon';
        $rating_title_bg = '%%order_class%% .df-rating-title';
        $rating_content_bg = '%%order_class%% .df-rating-content';

        // Border
        $rating_wrapper_border = "%%order_class%% .df-rating-wrapper";
        $rating_icon_border = "%%order_class%% .df-rating-icon";
        $title_border = "%%order_class%% .df-rating-title";
        $content_border = "%%order_class%% .df-rating-content";

        // Box Shadow
        $rating_box_wrapper_shadow = "%%order_class%% .df-rating-box-wrapper";
        $rating_box_shadow = "%%order_class%% .df-rating-icon";
        $title_box_shadow = "%%order_class%% .df-rating-title";
        $content_box_shadow = "%%order_class%% .df-rating-content";

        // Background
        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_box_bg',
            'selector'      => $rating_rating_wrapper_bg
        ));

        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_bg',
            'selector'      => $rating_rating_bg
        ));

        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_title_bg',
            'selector'      => $rating_title_bg
        ));

        $fields = $this->df_background_transition(array(
            'fields'        => $fields,
            'key'           => 'rating_content_bg',
            'selector'      => $rating_content_bg
        ));

        // Border
        $fields = $this->df_fix_border_transition(
            $fields,
            'rating_wrapper_border',
            $rating_wrapper_border
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'rating_icon_border',
            $rating_icon_border
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'title_border',
            $title_border
        );

        $fields = $this->df_fix_border_transition(
            $fields,
            'content_border',
            $content_border
        );

        // Box Shadow
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'rating_box_wrapper_shadow',
            $rating_box_wrapper_shadow
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'rating_box_shadow',
            $rating_box_shadow
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'title_box_shadow',
            $title_box_shadow
        );
        $fields = $this->df_fix_box_shadow_transition(
            $fields,
            'content_box_shadow',
            $content_box_shadow
        );

        return $fields;
    }

    /**
     *
     * Render
     *
     * @return array
     *
     */

    public function render($attrs, $content, $render_slug)
    {
        // Get all style
        $this->render_css($render_slug);

        // Display frontend
        $output = sprintf(
            '<div class="df-rating-box-wrapper">
                %1$s
                %2$s
            </div>',
            $this->render_rating_wrapper(),
            $this->render_content()
        );

        return $output;
    }

    /**
     *
     * Render Css
     *
     * @return array
     *
     */

    public function render_css($render_slug)
    {

        /////// Background //

        //  Rating icon wrapper background
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_bg',
            'selector'          => "%%order_class%% .df-rating-wrapper",
            'hover'             => '%%order_class%% .df-rating-wrapper:hover'
        ));

        //  Rating icon background
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_bg',
            'selector'          => "%%order_class%% .df-rating-icon",
            'hover'             => '%%order_class%% .df-rating-icon:hover'
        ));

        //  Title background
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_title_bg',
            'selector'          => "%%order_class%% .df-rating-title",
            'hover'             => '%%order_class%% .df-rating-title:hover'
        ));

        //  Content background
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_content_bg',
            'selector'          => "%%order_class%% .df-rating-content",
            'hover'             => '%%order_class%% .df-rating-content:hover'
        ));

        // Rating color
        $this->df_process_color(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_color',
            'type'              => 'color',
            'selector'          => "%%order_class%% .df-rating-icon .et-pb-icon, %%order_class%% span.df-rating-icon-fill::before",
            'hover'             => "%%order_class%% .df-rating-icon .et-pb-icon:hover, %%order_class%% span.df-rating-icon-fill:hover::before",
            'important' => false,
        ));

        // Rating inactive color
        $this->df_process_color(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_color_inactive',
            'type'              => 'color',
            'selector'          => "%%order_class%% .df-rating-icon .et-pb-icon",
            'hover'             => "%%order_class%% .df-rating-icon .et-pb-icon:hover",
            'important' => true,
        ));

        // Rating active color
        $this->df_process_color(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_color_active',
            'type'              => 'color',
            'selector'          => "%%order_class%% span.df-rating-icon-fill::before",
            'hover'             => "%%order_class%% span.df-rating-icon-fill:hover::before",
            'important' => true,
        ));

        // Rating Icon (+ before) Size
        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_size',
            'type'              => 'font-size',
            'selector'          => "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% span.df-rating-icon-fill::before",
            'hover'             => "%%order_class%% df-rating-icon span.et-pb-icon:hover, %%order_class%% span.df-rating-icon-fill:hover::before",
            'important'         => true
        ));

        /////// Rating Icon Settings //

        // Get only icon
        $get_rating_icon =
            $this->props['enable_rating_icon'] === 'on' && !empty($this->props['rating_icon']) ? et_pb_process_font_icon($this->props['rating_icon']) : "";

        if ($get_rating_icon) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
                'declaration' => 'content: attr(data-icon); color: #333;'
            ));
        } else {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
                'declaration' => 'content: "\E033";'
            ));
        }

        // Rating Icon align
        $this->df_process_string_attr(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_align',
            'type'              => 'text-align',
            'selector'          => '%%order_class%% .df-rating-icon',
            'important'         => false,
            'default'           => 'center'
        ));

        // Rating setting
        $title_display_type = !empty($this->props['title_display_type']) ? $this->props['title_display_type'] : "block";
        $title_placement_left_right = !empty($this->props['title_placement_left_right']) ? $this->props['title_placement_left_right'] : "right";
        $title_placement_top_bottom = !empty($this->props['title_placement_top_bottom']) ? $this->props['title_placement_top_bottom'] : "bottom";

        // Rating Display type
        if ($title_display_type === 'inline') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-wrapper",
                'declaration' => 'display: flex; align-items: center;'
            ));
        }

        // Rating Placement Left/Right
        if ($title_display_type === 'inline' && $title_placement_left_right === 'left') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-wrapper",
                'declaration' => 'flex-direction: row-reverse; justify-content: center;'
            ));
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-icon",
                'declaration' => 'display: flex; align-items: center;'
            ));
        } else {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-wrapper",
                'declaration' => 'justify-content: center;'
            ));
        }

        // Rating Placement Up/down
        if ($title_display_type === 'block' && $title_placement_top_bottom === 'top') {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "%%order_class%% .df-rating-wrapper",
                'declaration' => 'display: flex; flex-direction: column-reverse;'
            ));
        }

        // Rating space
        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_space',
            'type'              => 'margin-left',
            'selector'          => '%%order_class%% .df-rating-icon .et-pb-icon',
            'hover'             => '%%order_class%% .df-rating-icon .et-pb-icon:hover',
        ));

        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_space',
            'type'              => 'margin-right',
            'selector'          => '%%order_class%% .df-rating-icon .et-pb-icon',
            'hover'             => '%%order_class%% .df-rating-icon .et-pb-icon:hover',
        ));

        // Rating Number space
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_number_space',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df-rating-number',
            'hover'             => '%%order_class%% .df-rating-number:hover',
            'important'         => false
        ));

        ///////// Custom Spacing //

        // Rating wrapper
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_margin',
            'type'              => 'margin',
            'selector'          => '%%order_class%% .df-rating-wrapper',
            'hover'             => '%%order_class%% .df-rating-wrapper:hover',
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df-rating-wrapper',
            'hover'             => '%%order_class%% .df-rating-wrapper:hover',
            'important'         => true
        ));

        // Rating Icon
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_icon_margin',
            'type'              => 'margin',
            'selector'          => '%%order_class%% .df-rating-icon',
            'hover'             => '%%order_class%% .df-rating-icon:hover',
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_icon_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df-rating-icon',
            'hover'             => '%%order_class%% .df-rating-icon:hover',
            'important'         => true
        ));

        // Title wrapper
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_title_margin',
            'type'              => 'margin',
            'selector'          => '%%order_class%% .df-rating-title',
            'hover'             => '%%order_class%% .df-rating-title:hover',
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_title_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df-rating-title',
            'hover'             => '%%order_class%% .df-rating-title:hover',
            'important'         => true
        ));

        // Content wrapper
        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_content_margin',
            'type'              => 'margin',
            'selector'          => '%%order_class%% .df-rating-content',
            'hover'             => '%%order_class%% .df-rating-content:hover',
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_content_padding',
            'type'              => 'padding',
            'selector'          => '%%order_class%% .df-rating-content',
            'hover'             => '%%order_class%% .df-rating-content:hover',
            'important'         => true
        ));

        // icon font family
        if (method_exists('ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon')) {
            $this->generate_styles(
                array(
                    'utility_arg'    => 'icon_font_family',
                    'render_slug'    => $render_slug,
                    'base_attr_name' => 'rating_icon',
                    'important'      => true,
                    'selector'       => '%%order_class%% .et-pb-icon.df-rating-icon',
                    'processor'      => array(
                        'ET_Builder_Module_Helper_Style_Processor',
                        'process_extended_icon'
                    ),
                )
            );
        }
    }

    // Render Rating & Rating Number & Title
    public function render_rating_wrapper()
    {
        // Rating Title
        $title = $this->props['enable_title'] === 'on' && !empty($this->props['title']) ? sprintf(
            '<div class="df-rating-title">%1$s</div>',
            $this->props['title']
        ) : "";

        // Rating Icon only
        $get_rating_icon =
            $this->props['enable_rating_icon'] === 'on' && !empty($this->props['rating_icon']) ? et_pb_process_font_icon($this->props['rating_icon']) : "&#xe031;";

        // Rating scale type
        $rating_scale_type = !empty($this->props['rating_scale_type']) ? $this->props['rating_scale_type'] : 5;

        // Rating value
        $rating_value =
            $rating_scale_type == 5 ?
            (isset($this->props['rating_value_5']) && !empty($this->props['rating_value_5'])
                ? $this->props['rating_value_5'] : 5) : (isset($this->props['rating_value_10']) && !empty($this->props['rating_value_10'])
                ? $this->props['rating_value_10'] : 10);

        // Get float value
        $get_float = explode('.', $rating_value);

        $rating_icon = '';
        $rating_active_class = '';

        // Display Rating Icon
        for ($i = 1; $i <= $rating_scale_type; $i++) {
            if (!isset($rating_value)) {
                $rating_active_class = '';
            } else if ($i <= $rating_value) {
                $rating_active_class = 'df-rating-icon-fill';
            } else if ($i == $get_float[0] + 1 && isset($get_float[1]) && $get_float[1] != '' && $get_float[1] != 0) {
                $rating_active_class = 'df-rating-icon-fill df-fill-' . $get_float[1];
            } else {
                $rating_active_class = 'df-rating-icon-empty';
            }
            $rating_icon .= '<span class="et-pb-icon ' . $rating_active_class . '" data-icon="' . $get_rating_icon . '">' . $get_rating_icon . '</span>';
        }

        // Show rating number
        $rating_number = '';
        $this->props['enable_rating_number'] === 'on' ?
            $rating_number = sprintf(
                '<span class="df-rating-number">( %1$s / %2$s )</span>',
                $rating_value,
                $rating_scale_type
            )
            : "";

        return sprintf(
            '<div class="df-rating-wrapper">
                <div class="df-rating-icon">
                    %1$s
                    %2$s
                </div>
                %3$s
            </div>',
            $rating_icon,
            $rating_number,
            $title
        );
    }

    // Render rating content section
    public function render_content()
    {
        // Rating Content
        $content = $this->props['enable_content'] === 'on' && !empty($this->props['content'])
            ? sprintf(
                '<div class="df-rating-content">%1$s</div>',
                $this->props['content']
            ) : "";

        return $content;
    }

    ///////////////////////
} //Class

new DIFL_RatingBox;
