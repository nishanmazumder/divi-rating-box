<?php
if (!class_exists('ET_Builder_Element')) {
    return;
}

/**
 * RatingBox Class which extend the Divi Builder Module Class.
 *
 * This class provide rating icon element functionalities in frontend.
 *
 */

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

    /**
     * Initiate Module.
     * Set the module name on init.
     *
     * @return void
     * @since 1.0.0
     */

    public function init()
    {
        $this->name = esc_html__('Rating box', 'divi_flash');
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
                    'rating'      => esc_html__('Rating', 'divi_flash'),
                ),
            ),
            'advanced'   => array(
                'toggles'   => array(
                    'design_rating'                => esc_html__('Rating', 'divi_flash'),
                    'design_rating_number'         => esc_html__('Rating Number', 'divi_flash'),
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
        $rating = [
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
                'toggle_slug'     => 'rating'
            ),

            'rating_value_5' => array(
                'label'             => esc_html__('Rating Value', 'divi_flash'),
                'description'     => esc_html__('Set Rating Value', 'divi_flash'),
                'type'              => 'range',
                'default'           => '5',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '5',
                    'step' => '0.1',
                    'min_limit' => '0',
                    'max_limit' => '5'
                ),
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'rating_scale_type'     => '5'
                )
            ),

            'rating_value_10' => array(
                'label'             => esc_html__('Rating Value', 'divi_flash'),
                'description'     => esc_html__('Set Rating Value', 'divi_flash'),
                'type'              => 'range',
                'default'           => '10',
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '10',
                    'step' => '0.1',
                    'min_limit' => '0',
                    'max_limit' => '10'
                ),
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'rating_scale_type'     => '10'
                )
            ),

            // Custom icon
            'enable_custom_icon'  => array(
                'label'             => esc_html__('Use Custom Icon', 'divi_flash'),
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
                'type'              => 'select_icon',
                'option_category'  => 'basic_option',
                'default'           => '&#xe031;||divi||400',
                'class'             => array('et-pb-font-icon'),
                'toggle_slug'       => 'rating',
                'mobile_options'   => true,
                'show_if'         => array(
                    'enable_custom_icon'     => 'on',
                )
            ),

            'rating_color' => array(
                'label'           => esc_html__('Rating Icon Color', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'default'           => '#E02B20',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if_not'         => array(
                    'enable_custom_icon'     => 'on',
                    'enable_single_rating'     => 'on'
                ),
            ),

            'rating_color_single' => array(
                'label'           => esc_html__('Rating Icon Color', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'default'           => '#E02B20',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_single_rating'     => 'on',
                ),
            ),

            'rating_color_active' => array(
                'label'           => esc_html__('Active Rating Icon color', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_custom_icon'     => 'on',
                ),
                'show_if_not'         => array(
                    'enable_single_rating'     => 'on',
                ),
            ),

            'rating_color_inactive' => array(
                'label'           => esc_html__('Inactive Rating Icon color', 'divi_flash'),
                'type'            => 'color-alpha',
                'hover'           => 'tabs',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced',
                'show_if'         => array(
                    'enable_custom_icon'     => 'on',
                ),
                'show_if_not'         => array(
                    'enable_single_rating'     => 'on',
                ),
            ),

            // Rating Number
            'enable_rating_number'  => array(
                'label'             => esc_html__('Show Rating number', 'divi_flash'),
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
                ),
            ),

            'enable_rating_number_bracket'  => array(
                'label'             => esc_html__('Show Rating Number Bracket', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'on',
                'toggle_slug'       => 'rating',
                'show_if'         => array(
                    'enable_rating_number'     => 'on',
                    'enable_single_rating'     => 'off'
                )
            ),

            'rating_number_space_left' => array(
                'label'             => esc_html__('Left Spacing', 'divi_flash'),
                'description'     => esc_html__('Here you can set left spacing for rating number.', 'divi_flash'),
                'type'              => 'range',
                'default'           => '0px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1'
                ),
                'hover'             => 'tabs',
                'responsive'        => true,
                'mobile_options'    => true,
                'toggle_slug'       => 'design_rating_number',
                'tab_slug'          => 'advanced',
                'show_if'         => array(
                    'enable_rating_number'     => 'on'
                )
            ),

            'rating_number_space_right' => array(
                'label'             => esc_html__('Right Spacing', 'divi_flash'),
                'description'     => esc_html__('Here you can set right spacing for rating number.', 'divi_flash'),
                'type'              => 'range',
                'default'           => '0px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1'
                ),
                'hover'             => 'tabs',
                'responsive'        => true,
                'mobile_options'    => true,
                'toggle_slug'       => 'design_rating_number',
                'tab_slug'          => 'advanced',
                'show_if'         => array(
                    'enable_rating_number'     => 'on'
                )
            ),

            // Single
            'enable_single_rating'  => array(
                'label'             => esc_html__('Enable Single Rating', 'divi_flash'),
                'type'              => 'yes_no_button',
                'default'           => 'off',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'toggle_slug'       => 'rating',
            ),

            // Title
            'enable_title'  => array(
                'label'             => esc_html__('Enable Title', 'divi_flash'),
                'description'     => esc_html__('Enable Rating box title.', 'divi_flash'),
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
                'type'            => 'text',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_title'     => 'on'
                )
            ),

            'rating_title_tag'       => array(
                'label'            => esc_html__('Title Tag', 'divi_flash'),
                'description'      => esc_html__('Choose a tag to display your title.', 'divi_flash'),
                'type'             => 'select',
                'option_category'  => 'layout',
                'options'          => array(
                    'h1'   => esc_html__('H1 tag', 'divi_flash'),
                    'h2'   => esc_html__('H2 tag', 'divi_flash'),
                    'h3'   => esc_html__('H3 tag', 'divi_flash'),
                    'h4'   => esc_html__('H4 tag', 'divi_flash'),
                    'h5'   => esc_html__('H5 tag', 'divi_flash'),
                    'h6'   => esc_html__('H6 tag', 'divi_flash'),
                    'p'    => esc_html__('P tag', 'divi_flash'),
                    'span' => esc_html__('Span tag', 'divi_flash'),
                    'div'  => esc_html__('Div tag', 'divi_flash'),
                ),
                'toggle_slug'     => 'rating',
                'default' => 'h4',
                'show_if'         => array(
                    'enable_title'     => 'on'
                )
            ),

            'title_display_type' => array(
                'label'           => esc_html__('Title Display Type', 'divi_flash'),
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
                'type'            => 'select',
                'options'         => array(
                    'top' => esc_html__('Top', 'divi_flash'),
                    'bottom'  => esc_html__('Bottom', 'divi_flash'),
                ),
                'default'           => 'top',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'title_display_type'     => 'block',
                    'enable_title' => 'on'
                )
            ),

            'title_placement_left_right' => array(
                'label'           => esc_html__('Title Placement', 'divi_flash'),
                'type'            => 'select',
                'options'         => array(

                    'right'  => esc_html__('Right', 'divi_flash'),
                    'left' => esc_html__('Left', 'divi_flash'),
                ),
                'default'           => 'left',
                'option_category' => 'basic_option',
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_title'     => 'on',
                    'title_display_type'     => 'inline'
                )
            ),

            'title_display_type_mobile_inline'  => array(
                'label'             => esc_html__('Title display block on mobile', 'divi_flash'),
                'description'     => esc_html__('Set display type block only on mobile', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'rating',
                'show_if'         => array(
                    'title_display_type'     => 'inline',
                    'enable_title'          => 'on'
                )
            ),

            'rating_icon_align'  => array(
                'label'           => esc_html__('Rating Alignment', 'divi_flash'),
                'type'            => 'text_align',
                'option_category' => 'configuration',
                'options'         => et_builder_get_text_orientation_options(
                    array('justified')
                ),
                'tab_slug'        => 'advanced',
                'toggle_slug'     => 'design_rating',
                'default' => 'center',
                'options_icon'     => 'module_align',
                'mobile_options'  => true,
            ),

            'rating_icon_size' => array(
                'label'             => esc_html__('Rating Icon Size', 'divi_flash'),
                'type'              => 'range',
                'default'           => '20px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                    'min_limit' => '1',
                ),
                'toggle_slug'     => 'design_rating',
                'tab_slug'        => 'advanced'
            ),

            'rating_icon_space' => array(
                'label'             => esc_html__('Space between rating icons', 'divi_flash'),
                'type'              => 'range',
                'hover'             => 'tabs',
                'responsive'        => true,
                'default'           => '2px',
                'allowed_units'     => array('px'),
                'range_settings'    => array(
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                    'min_limit' => '1'
                ),
                'toggle_slug'       => 'design_rating',
                'tab_slug'          => 'advanced',
                'show_if_not'       => array(
                    'enable_single_rating' => 'on'
                )
            ),
        ];

        $content = [
            'enable_content'  => array(
                'label'             => esc_html__('Content Enable', 'divi_flash'),
                'description'     => esc_html__('Enable rating box content.', 'divi_flash'),
                'type'              => 'yes_no_button',
                'options'           => array(
                    'off' => esc_html__('Off', 'divi_flash'),
                    'on'  => esc_html__('On', 'divi_flash')
                ),
                'default'           => 'off',
                'toggle_slug'       => 'rating',
            ),
            'content' => array(
                'label'           => esc_html__('Content', 'divi_flash'),
                'type'            => 'tiny_mce',
                'dynamic_content' => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__('Rating box description.', 'divi_flash'),
                'toggle_slug'     => 'rating',
                'show_if'         => array(
                    'enable_content'     => 'on'
                )
            ),
        ];

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
            'tab_slug'              => 'advanced',
            'show_if'         => array(
                'enable_title'     => 'on'
            )
        ));

        $rating_content_bg = $this->df_add_bg_field(array(
            'label'                 => 'Rating Content Background',
            'key'                   => 'rating_content_bg',
            'toggle_slug'           => 'design_content',
            'tab_slug'              => 'advanced',
            'show_if'         => array(
                'enable_content'     => 'on'
            )
        ));

        $rating_rating_icon = $this->add_margin_padding(array(
            'title'             => 'Rating icon',
            'key'               => 'rating_box_icon',
            'toggle_slug'       => 'margin_padding'
        ));

        $rating_rating_title = $this->add_margin_padding(array(
            'title'             => 'Rating title',
            'key'               => 'rating_box_title',
            'toggle_slug'       => 'margin_padding',
            'show_if'         => array(
                'enable_title'     => 'on'
            )
        ));

        $rating_rating_content = $this->add_margin_padding(array(
            'title'             => 'Rating content',
            'key'               => 'rating_box_content',
            'toggle_slug'       => 'margin_padding',
            'show_if'         => array(
                'enable_content'     => 'on'
            )
        ));

        return array_merge(
            $rating_bg,
            $rating,
            $rating_title_bg,
            $rating_content_bg,
            $content,
            $rating_rating_icon,
            $rating_rating_title,
            $rating_rating_content
        );
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
            '<div class="df-rating-box-container">
                %1$s
                %2$s
            </div>',
            $this->df_render_rating_wrapper(),
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
        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_bg',
            'selector'          => "$this->main_css_element .df-rating-icon",
            'hover'             => "$this->main_css_element .df-rating-icon:hover"
        ));

        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_title_bg',
            'selector'          => "$this->main_css_element .df-rating-title",
            'hover'             => "$this->main_css_element .df-rating-title:hover"
        ));

        $this->df_process_bg(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_content_bg',
            'selector'          => "$this->main_css_element .df-rating-content",
            'hover'             => "$this->main_css_element .df-rating-content:hover"
        ));

        // Rating Icon (+ before) Size
        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_size',
            'type'              => 'font-size',
            'selector'          => "$this->main_css_element .df-rating-icon span.et-pb-icon, $this->main_css_element span.df-rating-icon-fill::before",
            'hover'             => "$this->main_css_element df-rating-icon span.et-pb-icon:hover, $this->main_css_element span.df-rating-icon-fill:hover::before",
            'important'         => true
        ));

        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_number_space_left',
            'type'              => 'margin-left',
            'selector'          => "$this->main_css_element .df-rating-number",
            'hover'             => "$this->main_css_element .df-rating-number:hover",
            'important'         => false
        ));

        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_number_space_right',
            'type'              => 'margin-right',
            'selector'          => "$this->main_css_element .df-rating-number",
            'hover'             => "$this->main_css_element .df-rating-number:hover",
            'important'         => false
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_icon_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .df-rating-icon",
            'hover'             => '$this->main_css_element .df-rating-icon:hover',
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_icon_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .df-rating-icon",
            'hover'             => "$this->main_css_element .df-rating-icon:hover",
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_title_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .df-rating-title",
            'hover'             => "$this->main_css_element .df-rating-title:hover",
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_title_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .df-rating-title",
            'hover'             => "$this->main_css_element .df-rating-title:hover",
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_content_margin',
            'type'              => 'margin',
            'selector'          => "$this->main_css_element .df-rating-content",
            'hover'             => "$this->main_css_element .df-rating-content:hover",
            'important'         => true
        ));

        $this->set_margin_padding_styles(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_box_content_padding',
            'type'              => 'padding',
            'selector'          => "$this->main_css_element .df-rating-content",
            'hover'             => "$this->main_css_element .df-rating-content:hover",
            'important'         => true
        ));

        // Get only icon
        $enable_rating_icon = $this->props['enable_custom_icon'] === 'on' ? true : false;
        $get_rating_icon =
            $this->props['enable_custom_icon'] === 'on' ? et_pb_process_font_icon($this->props['rating_icon']) : et_pb_process_font_icon("&#xe033;||divi||400"); // et_pb_process_font_icon('');

        if ($get_rating_icon && !empty($this->props['rating_icon'])) {
            if (method_exists('ET_Builder_Module_Helper_Style_Processor', 'process_extended_icon')) {

                difl_inject_fa_icons($this->props['rating_icon']);

                $this->generate_styles(
                    array(
                        'utility_arg'    => 'icon_font_family',
                        'render_slug'    => $render_slug,
                        'base_attr_name' => 'rating_icon',
                        'important'      => true,
                        'selector'       => "$this->main_css_element .df-rating-icon span.et-pb-icon",
                        'processor'      => array(
                            'ET_Builder_Module_Helper_Style_Processor',
                            'process_extended_icon'
                        ),
                    )
                );
            }
        }

        // Rating Icon Spaces
        $title_display_type = !empty($this->props['title_display_type']) ? $this->props['title_display_type'] : "block";
        $title_placement_left_right = !empty($this->props['title_placement_left_right']) ? $this->props['title_placement_left_right'] : "right";
        $title_placement_top_bottom = !empty($this->props['title_placement_top_bottom']) ? $this->props['title_placement_top_bottom'] : "top";

        $this->df_process_range(array(
            'render_slug'       => $render_slug,
            'slug'              => 'rating_icon_space',
            'type'              => 'margin-left',
            'selector'          => "$this->main_css_element .df-rating-icon .et-pb-icon:not(:first-child)",
            'hover'             => "$this->main_css_element .df-rating-icon .et-pb-icon:hover",
        ));

        //  // base on single rating
        //  if ($this->props['enable_single_rating'] === 'on') {
        //     if ($title_display_type === 'inline' && $title_placement_left_right === "right") {
        //         ET_Builder_Element::set_style($render_slug, array(
        //             'selector' => "$this->main_css_element .df-rating-title",
        //             'declaration' => 'margin-left: 10px;'
        //         ));
        //     }
        // }

        // Title align base on rating number
        // if ($this->props['enable_rating_number'] === "on") {
        //     if ($this->props['rating_number_placement_left_right'] === "right") {
        //         ET_Builder_Element::set_style($render_slug, array(
        //             'selector' => "$this->main_css_element .df-rating-title",
        //             'declaration' => 'margin-left: 0px; margin-right: 0px;'
        //         ));
        //     } else {
        //         ET_Builder_Element::set_style($render_slug, array(
        //             'selector' => "$this->main_css_element .df-rating-title",
        //             'declaration' => 'margin-left: 10px;'
        //         ));
        //     }

        //     if ($this->props['title_placement_left_right'] === "left") {
        //         ET_Builder_Element::set_style($render_slug, array(
        //             'selector' => "$this->main_css_element .df-rating-title",
        //             'declaration' => 'margin-right: 10px; margin-left: 0px;'
        //         ));
        //     }
        // }

        // Title Placement default
        if ($title_display_type === "inline") {
            if ($this->props['title_placement_left_right'] === "right") {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-title",
                    'declaration' => 'margin-left: 10px;'
                ));
            } else {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-title",
                    'declaration' => 'margin-right: 10px;'
                ));
            }
        } else {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "$this->main_css_element .df-rating-title",
                'declaration' => 'display: block; width: 100%;'
            ));
        }

        // Rating Number Default
        if ($this->props['enable_rating_number'] === "on") {
            if ($this->props['rating_number_placement_left_right'] === "right") {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-number",
                    'declaration' => 'margin-left: 5px;'
                ));
            } else {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-number",
                    'declaration' => 'margin-right: 5px'
                ));
            }
        }

        // Rating color
        $rating_color_active =
            !isset($this->props['rating_color_active']) ? "" : $this->props['rating_color_active'];

        $rating_color_inactive =
            !isset($this->props['rating_color_inactive']) ? "" : $this->props['rating_color_inactive'];

        if ($enable_rating_icon) {
            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
                'declaration' => 'content: attr(data-icon) !important;'
            ));

            // Single
            if ($this->props['enable_single_rating'] === "on") {
                $this->df_process_color(array(
                    'render_slug'       => $render_slug,
                    'slug'              => 'rating_color_single',
                    'type'              => 'color',
                    'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                    'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon:hover span.et-pb-icon",
                    'important' => true,
                ));
            } else {
                // Default
                if ($rating_color_active === "" || $rating_color_inactive === "") {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                        'declaration' => "color: #333;"
                    ));

                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before",
                        'important' => true,
                    ));
                }

                if ($rating_color_active !== "" && $rating_color_inactive === "") {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                        'declaration' => "color: #333;"
                    ));

                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color_active',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before",
                        'important' => true,
                    ));
                } else if ($rating_color_active === "" && $rating_color_inactive !== "") {
                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color_inactive',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon:hover span.et-pb-icon",
                        'important' => false,
                    ));

                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color_active',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before",
                        'important' => true,
                    ));
                } else {
                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color_inactive',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon:hover span.et-pb-icon",
                        'important' => false,
                    ));

                    $this->df_process_color(array(
                        'render_slug'       => $render_slug,
                        'slug'              => 'rating_color_active',
                        'type'              => 'color',
                        'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before",
                        'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before",
                        'important' => true,
                    ));
                }
            }
        } else {
            // Global
            if ($this->props['enable_single_rating'] === "on") {
                $this->df_process_color(array(
                    'render_slug'       => $render_slug,
                    'slug'              => 'rating_color_single',
                    'type'              => 'color',
                    'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                    'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon:hover span.et-pb-icon",
                    'important' => true,
                ));
            } else {
                $this->df_process_color(array(
                    'render_slug'       => $render_slug,
                    'slug'              => 'rating_color',
                    'type'              => 'color',
                    'selector'          => "$this->main_css_element .df-rating-icon span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon span.et-pb-icon",
                    'hover'             => "$this->main_css_element .df-rating-icon:hover span.df-rating-icon-fill::before, $this->main_css_element .df-rating-icon:hover span.et-pb-icon",
                    'important' => true,
                ));
            }
        }

        // Rating Alignment
        if ($title_display_type === "block") {
            $this->df_set_flex_position([
                'render_slug' => $render_slug,
                'slug'        => 'rating_icon_align',
                'selector'    => "$this->main_css_element .df-rating-wrapper",
                'type'        => "align-items",
            ]);

            if ($title_placement_top_bottom === "top") {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-wrapper",
                    'declaration' => "flex-direction: column-reverse;"
                ));
            } else {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-wrapper",
                    'declaration' => "flex-direction: column;"
                ));
            }
            // Inline
        } else {
            $this->df_set_flex_position([
                'render_slug' => $render_slug,
                'slug'        => 'rating_icon_align',
                'selector'    => "$this->main_css_element .df-rating-wrapper",
                'type'        => "justify-content",
                'css'         => "align-items: center"
            ]);

            ET_Builder_Element::set_style($render_slug, array(
                'selector' => "$this->main_css_element .df-rating-icon",
                'declaration' => 'display: flex; align-items: center;'
            ));

            if ($title_placement_left_right === "left") {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-wrapper",
                    'declaration' => "flex-direction: row-reverse;"
                ));
            } elseif ($title_placement_left_right === "right") {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-wrapper",
                    'declaration' => "flex-direction: row;"
                ));
            }

            // Force display type block on mobile
            if ($this->props['title_display_type_mobile_inline'] === 'on') {
                ET_Builder_Element::set_style($render_slug, array(
                    'selector' => "$this->main_css_element .df-rating-wrapper",
                    'declaration' => "flex-direction: column-reverse !important;",
                    'media_query' => self::get_media_query('max_width_767')
                ));

                if ($this->props['title_text_align_phone'] !== "") {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => "$this->main_css_element .df-rating-title",
                        'declaration' => "width: 100%; margin-right:0px; text-align: " . $this->props['title_text_align_phone'] . " ",
                        'media_query' => self::get_media_query('max_width_767')
                    ));
                }

                if ($this->props['rating_icon_align_phone'] !== "") {
                    ET_Builder_Element::set_style($render_slug, array(
                        'selector' => "$this->main_css_element .df-rating-icon",
                        'declaration' => "width: 100%; justify-content: " . $this->props['rating_icon_align_phone'] . " ",
                        'media_query' => self::get_media_query('max_width_767')
                    ));
                }
            }
        }
    }

    // Render Rating & Rating Number & Title
    public function df_render_rating_wrapper()
    {
        // Rating Title
        $title_tag = isset($this->props['rating_title_tag']) ? $this->props['rating_title_tag'] : "h4";

        $title = $this->props['enable_title'] === 'on' && !empty($this->props['title']) ? sprintf(
            '<%1$s class="df-rating-title">%2$s</%1$s>',
            $title_tag,
            $this->props['title']
        ) : "";

        // Rating Icon only
        $get_rating_icon =
            $this->props['enable_custom_icon'] === 'on' ? et_pb_process_font_icon($this->props['rating_icon']) : et_pb_process_font_icon("&#xe031;");

        // Rating scale type
        $rating_scale_type =
            $this->props['enable_single_rating'] == 'off' ?
            (!empty($this->props['rating_scale_type']) ? $this->props['rating_scale_type'] : 5) : 1;

        $rating_value =
            $rating_scale_type == 5
            ? ($this->props['rating_value_5'] <= 5 && $this->props['rating_value_5'] >= 0
                ? $this->props['rating_value_5'] : 5) : ($this->props['rating_value_10'] <= 10 && $this->props['rating_value_10'] >= 0
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

        // Get single rating value
        $rating_value_single =
            $this->props['rating_scale_type'] === "5"
            ? $this->props['rating_value_5']
            : $this->props['rating_value_10'];

        // Show rating number
        $rating_number = '';
        $this->props['enable_rating_number'] === 'on' ?
            ($this->props['enable_single_rating'] !== 'on' ?
                ($this->props['enable_rating_number_bracket'] === 'on' ?
                    $rating_number = sprintf(
                        '<span class="df-rating-number">( %1$s / %2$s )</span>',
                        $rating_value,
                        $rating_scale_type
                    )
                    :  $rating_number = sprintf(
                        '<span class="df-rating-number">%1$s / %2$s</span>',
                        $rating_value,
                        $rating_scale_type
                    )) :
                $rating_number = sprintf('<span class="df-rating-number">%1$s</span>', $rating_value_single)
            )
            : "";

        // Rating Number placement
        $rating_icon_and_number_placement = '';
        $this->props['rating_number_placement_left_right'] === 'left' ?
            $rating_icon_and_number_placement = $rating_number . $rating_icon : $rating_icon_and_number_placement = $rating_icon . $rating_number;

        return sprintf(
            '<div class="df-rating-wrapper">
                <div class="df-rating-icon">
                    %1$s
                </div>
                %2$s
            </div>',
            $rating_icon_and_number_placement,
            $title
        );
    }

    // Render rating content section
    public function df_render_content()
    {
        // Rating Content
        $content = $this->props['enable_content'] === 'on' && !empty($this->props['content'])
            ? sprintf(
                '<div class="df-rating-content">%1$s</div>',
                $this->props['content']
            ) : "";

        return $content;
    }

    public function df_set_flex_position($options)
    {
        $defaults = [
            'render_slug' => '',
            'slug'        => '',
            'selector'    => '',
            'type'        => '',
            'css'         => '',
        ];

        $options = wp_parse_args($options, $defaults);
        $get_values = ["center", "left", "right"];
        $set_values = ["center", "start", "end"];
        $values = [];

        foreach ($get_values as $key => $value) {
            $values[$value] = $set_values[$key];
        }

        if (array_key_exists($options['slug'], $this->props) && !empty($this->props[$options['slug']])) {
            $desktop = $this->props[$options['slug']];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('display: flex;%1$s:%2$s;%3$s;', $options['type'], $values[$desktop], $options['css']),
            ));
        }

        if (array_key_exists($options['slug'], $this->props) && !empty($this->props[$options['slug'] . "_tablet"])) {
            $tablet = $this->props[$options['slug'] . "_tablet"];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('display: flex;%1$s:%2$s;%3$s;', $options['type'], $values[$tablet], $options['css']),
                'media_query' => self::get_media_query('max_width_980')
            ));
        }

        if (array_key_exists($options['slug'], $this->props) && !empty($this->props[$options['slug'] . "_phone"])) {
            $phone = $this->props[$options['slug'] . "_phone"];
            self::set_style($options['render_slug'], array(
                'selector'    => $options['selector'],
                'declaration' => sprintf('display: flex;%1$s:%2$s;%3$s;', $options['type'], $values[$phone], $options['css']),
                'media_query' => self::get_media_query('max_width_767')
            ));
        }
    }
} //Class

new DIFL_RatingBox;
