// External Dependencies
import React, { Component } from 'react';
import utility from '../../../scripts/df_scripts/utilities';
// Internal Dependencies
import './style.css';


class TestimonialCarouselItem extends Component {
    static slug = 'difl_testimonialcarouselitem';
    _isMounted = false;

    constructor(props) {
        super(props);

        this.wrapper = React.createRef();
        this.add_wrapper_class = this.add_wrapper_class.bind(this);
        this.content_output = this.content_output.bind(this);
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

        // icon font family
        utility.process_icon_font_style({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'quote_icon_font_icon',
            'selector'          : '%%order_class%% .et-pb-icon.df_tc_quote_icon'
        })

        return additionalCss;
    }

    render_image(props, key) {
        const utils = window.ET_Builder.API.Utils;
        let icon = '';

        if (props[key + '_use_icon'] && props[key + '_use_icon'] === 'on') {
            if ( !props[key + '_font_icon'] || props[key + '_font_icon'] === '') {
               icon = '{'
            } else {
                icon = utils.processFontIcon(props[key + '_font_icon'])
            }
       }
       if ( props[key + '_use_icon'] === 'on') {
        return (
            <div className="df_tc_quote_image">
                <span className="et-pb-icon df_tc_quote_icon">{icon}</span>
            </div>
        )
       } else if ( props[key + '_image'] && props[key + '_image'] !== '' ){
           return (
               <div className="df_tc_quote_image">
                   <img className="tc_quote_image" src={props[key + '_image']} />
               </div>
           )
       } else {return null} 
    }

    content_output() {
        const props = this.props;
        const author_image = props.image && props.image !== '' ?
            <div className="df_tc_author_image">
                <img className="tc_author_image" src={props.image} />
            </div> : '';
        
        const content = props.content().props.content !== '' ?
                <div className="df_tc_content">
                    {props.content()}
                </div> : '';
        
        const brand_logo = props.company_logo && props.company_logo !== '' ?
            <div className="df_tc_company_logo">
                <img className="tc_company_logo" src={props.company_logo} />
            </div> : '';
        
        const author_name = props.author && props.author !== '' ?
            <h4>{props.author}</h4> : '';

        const job_title = props.job_title && props.job_title !== '' ?
            <span className="tc_job_title">{props.job_title}</span> : '';

        let company = '';
        if(props.company !== '') {
            if(props.company_url !== '') {
                company = <a href={props.company_url} className="tc_company"> {props.company}</a>;
            } else {
                company = <span className="tc_company"> {props.company}</span>;
            }
        }

        const seperator = job_title !== '' && company !== '' ? ', ' : '';

        const info = author_name !== '' || job_title !== '' || company !== '' ?
                    <div className="df_tc_author_info">
                        {author_name}
                        {job_title} {company}
                    </div> : '';
        const info_box = author_image !== '' || info !== '' ?
                <div className="df_tc_author_box">
                    {author_image}
                    {info}
                </div> : '';
        const ratings = props.rating === 'on' ?
            <div className="df_tc_ratings">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div> : '';

        const quote_icon = props.quote_icon === 'on' ?
            <span className="df_tc_quote_icon"></span> : '';
        
        return (
            <div className="df_tci_inner">
                {this.render_image(props, 'quote_icon')}
                {brand_logo}
                {content}
                {info_box}
                {ratings}
            </div>
        );
    }

    render() {
        const props = this.props;

        return(<>
            <span className="et_pb_background_pattern"></span>
            <span className="et_pb_background_mask"></span>
            <div className="df_tci_container" ref={this.wrapper}>
                <span className="et_pb_background_pattern"></span>
                <span className="et_pb_background_mask"></span>
                {this.content_output()}
            </div>
        </>)
    }
}
export default TestimonialCarouselItem;