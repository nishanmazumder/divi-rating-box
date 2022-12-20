// External Dependencies
import React, { Component } from 'react';
import utility from '../../../scripts/df_scripts/utilities';
// Internal Dependencies
import './style.css';

class ImageHotspotItem extends Component {
    static slug = 'difl_imagehotspotitem';
    _isMounted = false;

    constructor(props) {
        super(props);
        this.state = {
            animated_style :'',
            pulse_class : ''
          }
        this.wrapper = React.createRef();
        this.add_class_child_div = this.add_class_child_div.bind(this);
    }

    componentDidMount() {
        this._isMounted = true;   
        this.add_class_child_div(); 
    }

    componentWillUnmount() {
        this._isMounted = false;
    }

    componentDidUpdate(prevProps, prevState) {
    
        this.add_class_child_div()
        if (prevProps !== this.props) {
            
            this.add_class_child_div()
        
        } 
    }
    add_class_child_div() {
        const props = this.props;
        if(props.spot_animation_style){
        
            let animation_class='';
            if (props.spot_animation === 'on' && props.spot_animation_style === 'style_1'){
                animation_class = 'pulsating';
            }
            if (props.spot_animation === 'on' && props.spot_animation_style === 'style_2'){
                animation_class = 'pulsating_2';
            }
            if (props.spot_animation === 'on' && props.spot_animation_style === 'style_3'){
                animation_class = 'pulse';
            }
            if (props.spot_animation === 'on' && props.spot_animation_style === 'style_4'){
                animation_class = 'pulse_2';
            }
            if (props.spot_animation === 'on' && props.spot_animation_style === 'style_5'){
                animation_class ='web_pulse-1';
            }        
            if(animation_class){
                this.wrapper.current.parentElement.parentElement.classList.add(animation_class); 
            }   
        }
    }

    static css(props) {
        const additionalCss = [];

        utility.df_process_bg({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'spot_background',
            'selector'          : '.difl_imagehotspot %%order_class%%',
            'important': true
        });  

        if ('text' === props['spot_type']) {
            additionalCss.push([{
                selector: ".difl_imagehotspot %%order_class%%",
                declaration: `width: auto; height:auto`
            }]);
        }

        if(props['spot_animation'] === 'on'){
            const spot_animation_style = props.spot_animation_style ? props.spot_animation_style : 'style_1';
            if( 'style_1' === spot_animation_style ||'style_2' ===  spot_animation_style  ){
                utility.process_color({
                    'props': props,
                    'key': 'animation_color',
                    'additionalCss': additionalCss,
                    'selector': '.difl_imagehotspot %%order_class%% , .difl_imagehotspot %%order_class%%.pulsating:before , .difl_imagehotspot %%order_class%%.pulsating_2:before',
                    'type': 'background-color',
                    'important': true
                })

            }

            if( 'style_3' === spot_animation_style ){
                utility.process_color({
                    'props': props,
                    'key': 'animation_color',
                    'additionalCss': additionalCss,
                    'selector': '.difl_imagehotspot %%order_class%%.pulse:before , .difl_imagehotspot %%order_class%%.pulse:after',
                    'type': 'border-color',
                    'important': true
                })
            }

            if( 'style_4' === spot_animation_style  || 'style_5' === spot_animation_style ){
                utility.process_color({
                    'props': props,
                    'key': 'animation_color',
                    'additionalCss': additionalCss,
                    'selector': '.difl_imagehotspot %%order_class%%.pulse_2 , .difl_imagehotspot %%order_class%%.web_pulse-1',
                    'type': 'color'
                })
            }
      
        }

        utility.process_range_value({
            'props': props,
            'key': 'left_position',
            'additionalCss': additionalCss,
            'selector': '.difl_imagehotspot %%order_class%%',
            'type': 'left',
            'important' : 'true'
        });
        utility.process_range_value({
            'props': props,
            'key': 'top_position',
            'additionalCss': additionalCss,
            'selector': '.difl_imagehotspot %%order_class%%',
            'type': 'top',
            'important' : 'true'
        });
      
        if(props['left_position'] || props['top_position']){
            
            utility.process_transform_props({
                'props'             : props,
                'additionalCss'     : additionalCss,
                'oposite'           : true,
                'selector'          : '.difl_imagehotspot %%order_class%%',
                'important'         :true,
                'transforms'        : [
                    {
                        'type' : 'translateX',
                        'key'  : 'left_position',
                        'unit' : '%',
                        'default_value': '-50%'
                    },
                    {
                        'type' : 'translateY',
                        'key'  : 'top_position',
                        'unit' : '%',
                        'default_value': '-30%'
                    }
                ]
            });
        }
        const variable_width = props.variable_width ? props.variable_width : 'on';

        if(variable_width === 'on'){
            utility.process_range_value({
                'props': props,
                'key': 'spot_width',
                'additionalCss': additionalCss,
                'selector': '.difl_imagehotspot %%order_class%%',
                'type': 'width',
                'default_value': '50px',
                'important' : 'true'
            });
            utility.process_range_value({
                'props': props,
                'key': 'spot_width',
                'additionalCss': additionalCss,
                'selector': '.difl_imagehotspot %%order_class%%',
                'type': 'height',
                'default_value': '50px',
                'important' : 'true'
            });
        }
         // Icon Design
         const spotType = props.spot_type ? props.spot_type : 'icon';
         if(  spotType === 'icon'){
            utility.process_range_value({
                'props': props,
                'key': 'icon_size',
                'additionalCss': additionalCss,
                'selector': '.difl_imagehotspot %%order_class%% .et-pb-icon.df-image-hotspot-icon',
                'type': 'font-size',
                'important': true
            });
            utility.process_color({
                'props': props,
                'key': 'icon_color',
                'additionalCss': additionalCss,
                'selector': '.difl_imagehotspot %%order_class%% .et-pb-icon.df-image-hotspot-icon',
                'type': 'color',
                'important': true
            })
           
        }
        utility.process_range_value({
            'props'             : props,
            'key'               : 'image_as_icon_width',
            'additionalCss'     : additionalCss,
            'selector'          : '%%order_class%% img.df-image-hotspot-icon',
            'type'              : 'width',
            'important'         : true
        });

        utility.process_range_value({
            'props'             : props,
            'key'               : 'image_as_icon_width',
            'additionalCss'     : additionalCss,
            'selector'          : '%%order_class%% img.df-image-hotspot-icon',
            'type'              : 'height',
            'important'         : true
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'spot_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_imagehotspot %%order_class%%',
            'type': 'padding'
        });

        utility.process_icon_font_style({
            'props'             : props,
            'additionalCss'     : additionalCss,
            'key'               : 'font_icon',
            'selector'          : '%%order_class%% .et-pb-icon.df-image-hotspot-icon'
        })

        return additionalCss;
    }
    render_icon_or_image(props) {
        const utils = window.ET_Builder.API.Utils;
        let icon = '';
        const spotType = props['spot_type'] ? props['spot_type'] : 'icon'
        if (spotType === 'icon') {
          if (!props['font_icon'] || props['font_icon'] === '') {
            icon = 'P'
          } else {
            icon = utils.processFontIcon(props['font_icon'])
          }
        }
        if (spotType === 'icon' && props.use_image_as_icon === 'on') {
    
            return ( <img className="df-image-hotspot-icon" src={this.props.image_as_icon} atl={this.props.image_alt_text} /> )
        } 
        else{
            return ( <span className="et-pb-icon df-image-hotspot-icon">{icon}</span> )
        }
    }

    render() {
        const props = this.props;
        const spotText = props['spot_text'] && props['spot_text'] !== '' && 'empty' !== props['spot_type'] ?  props['spot_text'] : '';
        const IconHtml = this.render_icon_or_image(props);
        const tooltip_content = props.content().props.content && props.content().props.content !== '' ? props.content().props.content.replace(/<p[^>]*>(?:\s|&nbsp;)*<\/p>/g, '') : null;
        const spot_type_class =  props['spot_type'] ? 'spot_type_' + props['spot_type'] : '';
        return (
            <div className={"difl_marker " + spot_type_class} data-options={tooltip_content} ref={this.wrapper}>
                { 
                    ('text' === props['spot_type'] ) ?
                    <div className={"difl_marker_wrapper difl_image_marker"} dangerouslySetInnerHTML={{ __html: spotText.replace(/(\r\n|\n\r|\r|\n)/g, '<br>') }}/>
                    : 
                    <div className={"difl_marker_wrapper difl_image_marker"}> {IconHtml} </div> 
                }
                 
            </div>      
        )
    }

}
export default ImageHotspotItem;