// External Dependencies
import React, { Component } from 'react';
import utility from '../../../scripts/df_scripts/utilities';
// Internal Dependencies
import './style.css';


class BusinessHourslItem extends Component {
    static slug = 'difl_businesshoursitem';
    _isMounted = false;

    constructor(props) {
        super(props);
    }



    static css(props) {
        const additionalCss = [];
        additionalCss.push([{
            selector: '.difl_businesshours %%order_class%%.difl_businesshoursitem',
            declaration: `margin-bottom: 0;`,
        }]);

        //BG

        utility.df_process_bg({
            'props': props,
            'key': 'day_background_color',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_day',
        });

        utility.df_process_bg({
            'props': props,
            'key': 'time_background_color',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time',
        });
        // Background Color
        utility.process_color({
            'props': props,
            'key': 'start_time_background_color',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_start_time',
            'type': 'background-color',
        });
        utility.process_color({
            'props': props,
            'key': 'end_time_background_color',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_end_time',
            'type': 'background-color',
        });
        utility.process_color({
            'props': props,
            'key': 'time_separetor_background_color',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time_separetor',
            'type': 'background-color',
        });



        // spacing
        utility.process_margin_padding({
            'props': props,
            'key': 'item_wrapper_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%%.difl_businesshoursitem',
            'type': 'margin',
            'important': true
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'item_wrapper_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%%.difl_businesshoursitem',
            'type': 'padding',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'item_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%%.difl_businesshoursitem > div:first-child',
            'type': 'padding',
            'important': false
        });
        utility.process_margin_padding({
            'props': props,
            'key': 'day_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_day',
            'type': 'margin',
            'important': false
        });
        utility.process_margin_padding({
            'props': props,
            'key': 'day_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_day',
            'type': 'padding',
            'important': false
        });



        utility.process_margin_padding({
            'props': props,
            'key': 'time_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time',
            'type': 'margin',
            'important': false
        });
        utility.process_margin_padding({
            'props': props,
            'key': 'time_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time',
            'type': 'padding',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'start_time_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_start_time',
            'type': 'margin',
            'important': false
        });
        utility.process_margin_padding({
            'props': props,
            'key': 'start_time_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_start_time',
            'type': 'padding',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'end_time_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_end_time',
            'type': 'margin',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'end_time_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_end_time',
            'type': 'padding',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'time_separetor_margin',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time_separetor',
            'type': 'margin',
            'important': false
        });

        utility.process_margin_padding({
            'props': props,
            'key': 'time_separetor_padding',
            'additionalCss': additionalCss,
            'selector': '.difl_businesshours %%order_class%% .df_bh_time_separetor',
            'type': 'padding',
            'important': false
        });





        return additionalCss;
    }


    render() {
        const props = this.props;
        const dayName = props.day_name && props.day_name !== '' ?
            <div className="df_bh_day">{props.day_name}</div> : '';

        const timeText = (props.time !== '') ?
            <span className="df_bh_time_text">{props.time}</span> : '';

        const startTime = props.start_time && props.start_time !== '' ?
            <span className="df_bh_start_time">{props.start_time}</span> : '';

        const endTime = props.end_time && props.end_time !== '' ?
            <span className="df_bh_end_time">{props.end_time}</span> : '';

        const timeSeparetor = props.time_separetor && props.time_separetor !== '' ?
            <span className="df_bh_time_separetor"> {props.time_separetor} </span> : '';

        const offDayText = (props.off_day_enable === 'on' && props.off_day_text !== '') ?
            <span className="df_bh_off_day">{props.off_day_text}</span> : '';
        const timeHtml = ('advanced' === props.time_structure_type) ?
            <div className="df_bh_time">
                {startTime}
                {timeSeparetor}{endTime}
            </div>
            :
            <div className="df_bh_time">
                {timeText}
            </div>

        const timeContainnerHtml = ('on' !== props.off_day_enable) ?
            timeHtml
            :
            <div className="df_bh_time">
                {offDayText}
            </div>



        const offDayClass = (props.off_day_enable === 'on' && props.off_day_text !== '') ? ' off_day_true' : '';



        return (
            <div className={"df_bh_item" + offDayClass}>
                {dayName}
                {timeContainnerHtml}
            </div>
        )
    }

}
export default BusinessHourslItem;