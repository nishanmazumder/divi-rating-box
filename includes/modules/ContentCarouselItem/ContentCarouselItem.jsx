// External Dependencies
import React, { Component } from 'react';
import utility from '../../../scripts/df_scripts/utilities';
// Internal Dependencies
import './style.css';


class ContentCarouselItem extends Component {
    static slug = 'difl_contentcarouselitem';
    _isMounted = false;

    constructor(props) {
        super(props);

        this.wrapper = React.createRef();
        this.add_wrapper_class = this.add_wrapper_class.bind(this);
    }

    componentDidMount() {
        this._isMounted = true;
        this.add_wrapper_class();
    }

    componentWillUnmount() {
        this._isMounted = false;
    }

    componentDidUpdate(prevProps, prevState) {

    }

    add_wrapper_class() {
        this.wrapper.current.parentElement.parentElement.classList.add('swiper-slide');
    }

    static css(props) {
        const additionalCss = [];

        // orders
        utility.process_range_value({
            'props'             : props,
            'key'               : 'image_order',
            'additionalCss'     : additionalCss,
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cci_image_container',
            'type'              : 'order'
        });
        utility.process_range_value({
            'props'             : props,
            'key'               : 'title_order',
            'additionalCss'     : additionalCss,
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_title',
            'type'              : 'order'
        });
        utility.process_range_value({
            'props'             : props,
            'key'               : 'subtitle_order',
            'additionalCss'     : additionalCss,
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_subtitle',
            'type'              : 'order'
        });
        utility.process_range_value({
            'props'             : props,
            'key'               : 'content_order',
            'additionalCss'     : additionalCss,
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_content',
            'type'              : 'order'
        });
        utility.process_range_value({
            'props'             : props,
            'key'               : 'button_order',
            'additionalCss'     : additionalCss,
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cci_button_wrapper',
            'type'              : 'order'
        });
        // icons
        utility.process_icon_styles({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_cci',
            'selector'          : '%%order_class%% .df_cci_container .et-pb-icon',
            'align_container'   : '%%order_class%% .df_cci_image_container',
            'image_selector'    : '%%order_class%% .df_cci_image_container img'
        });

        // button
        utility.df_process_bg({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_button_bg',
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cci_button'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'button_wrapper_margin',
            'additionalCss' : additionalCss,
            'selector' : '.difl_contentcarousel %%order_class%% .df_cci_button_wrapper',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'button_wrapper_padding',
            'additionalCss' : additionalCss,
            'selector' : '.difl_contentcarousel %%order_class%% .df_cci_button_wrapper',
            'type'  : 'padding'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'button_margin',
            'additionalCss' : additionalCss,
            'selector' : '.difl_contentcarousel %%order_class%% .df_cci_button',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'button_padding',
            'additionalCss' : additionalCss,
            'selector' : '.difl_contentcarousel %%order_class%% .df_cci_button',
            'type'  : 'padding'
        });
        // button styles
        utility.df_process_btn_styles({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'cc_button',
            'selector'          : ".difl_contentcarousel %%order_class%% .df_cci_button",
            'align_container'   : ".difl_contentcarousel %%order_class%% .df_cci_button_wrapper"
        });

        // content area background
        utility.df_process_bg({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_title_bg',
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_title'
        });
        utility.df_process_bg({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_subtitle_bg',
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_subtitle'
        });
        utility.df_process_bg({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_content_bg',
            'selector'          : '.difl_contentcarousel %%order_class%% .df_cc_content'
        });
        // spacing
        utility.process_margin_padding({
            'props' : props,
            'key':'item_wrapper_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% > div:first-child',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'item_wrapper_padding',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% > div:first-child',
            'type'  : 'padding'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'image_wrapper_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cci_image_container',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'image_wrapper_padding',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cci_image_container',
            'type'  : 'padding'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'image_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cci_image_container img',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'title_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_title',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'title_padding',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_title',
            'type'  : 'padding'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'subtitle_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_subtitle',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'subtitle_padding',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_subtitle',
            'type'  : 'padding'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'content_margin',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_content',
            'type'  : 'margin'
        });
        utility.process_margin_padding({
            'props' : props,
            'key':'content_padding',
            'additionalCss' : additionalCss,
            'selector' : '%%order_class%% .df_cc_content',
            'type'  : 'padding'
        });

        // icon font family
        utility.process_icon_font_style({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'df_cci_font_icon',
            'selector'          : '%%order_class%% .et-pb-icon'
        })

        return additionalCss;
    }

    render_image(props, key) {
        const utils = window.ET_Builder.API.Utils;
        let icon = '';

        if (props[key + '_use_icon'] && props[key + '_use_icon'] === 'on') {
             if ( !props[key + '_font_icon'] || props[key + '_font_icon'] === '') {
                icon = '5'
             } else {
                 icon = utils.processFontIcon(props[key + '_font_icon'])
             }
        }
        if ( props[key + '_use_icon'] === 'on') {
            return (
                <div className="df_cci_image_container">
                    <span className="et-pb-icon">{icon}</span>
                </div>
            )
        } else if ( props[key + '_image'] && props[key + '_image'] !== '' ){
            return (
                <div className="df_cci_image_container">
                    <img className="df_cci_image" src={props[key + '_image']} />
                </div>
            )
        } else {return null} 
    }

    render_button(props, key) {
        const button_text = props[key + '_button_text'] ? props[key + '_button_text'] : '';
        const button_url = props[key + '_button_url'] ? props[key + '_button_url'] : '';

        if( button_text !== '' || button_url !== '' ) {
            return (
                <div className="df_cci_button_wrapper">
                    <a className="df_cci_button" href={button_url}>{button_text}</a>
                </div>
            )
        } else return '';
    }

    render() {
        const props = this.props;
        const TitleTag = props.title_tag ? props.title_tag : 'h4';
        const SubTitleTag = props.subtitle_tag ? props.subtitle_tag : 'h5';
        const title = props.title && props.title !== '' ? 
            <TitleTag className="df_cc_title">{props.title}</TitleTag> : '';
        const sub_title = props.sub_title && props.sub_title !== '' ? 
            <SubTitleTag className="df_cc_subtitle">{props.sub_title}</SubTitleTag> : '';;
        const content = props.content().props.content !== '' ? 
            <div className="df_cc_content">{props.content()}</div> : '';

        return(<>
                <span className="et_pb_background_pattern"></span>
                <span className="et_pb_background_mask"></span>
                <div className="df_cci_container" ref={this.wrapper}>
                    <span className="et_pb_background_pattern"></span>
                    <span className="et_pb_background_mask"></span>
                    {this.render_image(props, 'df_cci')}
                    {title}
                    {sub_title}
                    {content}
                    {this.render_button(props, 'cc_button')}
                </div>
            </>
        )
    }
}
export default ContentCarouselItem;