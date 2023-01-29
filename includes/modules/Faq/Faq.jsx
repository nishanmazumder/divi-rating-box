// have to remove key form answer and question function

import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import $ from "jquery";
import "./style.css";

class Faq extends Component {
  static slug = "difl_faq";

  constructor(props) {
    super(props);
    this.state = {
      isActive: false,
    };

    // this.wrapper = React.createRef();
    this.render_faq_items = this.render_faq_items.bind(this)
  }

  componentDidUpdate() {
    this.activate_item_order();
    this.render_faq_items()
  }

  // prettier-ignore
  activate_item_order = () => {
    const parent_class = this.props.moduleInfo.orderClassName;
    const get_wrapper_classes = $("." + parent_class).find(".df_faq_item");
    const active_item = "on" === this.props.activate_on_first_time ? this.props.active_item_order_number : 0;

    if ("on" === this.props.activate_on_first_time) {
      const active_item_order = ":eq(" + (active_item - 1) + ")";
      const active_item_selector = "." + get_wrapper_classes[0].classList + active_item_order;

      $(get_wrapper_classes).removeClass("active");
      $(active_item_selector).removeClass("active");
      $(active_item_selector).addClass("active");

    } return;

  }
  // prettier-ignore

  static css(props) {
    var additionalCss = [];

    if ("" !== props.close_faq_icon) {
      utility.process_icon_font_style({
        props   : props,
        additionalCss: additionalCss,
        key     : "close_faq_icon",
        selector: "%%order_class%% .faq_icon .close_icon span.et-pb-icon"
      });
    }

    if ("" !== props.open_faq_icon) {
      utility.process_icon_font_style({
        props   : props,
        additionalCss: additionalCss,
        key     : "open_faq_icon",
        selector: "%%order_class%% .faq_icon .open_icon span.et-pb-icon"
      });
    }

    if ("inherit" !== props.faq_icon_placement) {
      utility.df_process_string_attr({
        props   : props,
        key     : "faq_icon_placement",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_question_wrapper, %%order_class%% .faq_question_area",
        type    : "flex-direction"
      });
    }

    // faq grid layout
    if ("on" === props.faq_layout_grid) {
      this.df_faq_set_dynamic_grid_columns({
        props : props,
        key   : "faq_item_per_column",
        additionalCss: additionalCss,
        selector: "%%order_class%% .df_faq_wrapper",
        type  : "grid-template-columns"
      });
    }

    // faq item gap
    utility.process_range_value({
      props : props,
      key   : "faq_item_gap",
      additionalCss: additionalCss,
      selector: "%%order_class%%.difl_faq .df_faq_wrapper",
      type  : "gap"
    });

    // faq item width
    if ("on" === props.faq_item_equal_width) {
      additionalCss.push([
        {
          selector: "%%order_class%% .difl_faqitem div.et_pb_module_inner",
          declaration: `width: 100% !important;`
        },
      ]);
    }else{
      utility.process_range_value({
        props   : props,
        key     : "faq_item_width",
        additionalCss: additionalCss,
        default : "50%",
        selector: "%%order_class%% .difl_faqitem div.et_pb_module_inner",
        type    : "width"
      });
    }

    utility.df_process_string_attr({
      props: props,
      key: "faq_item_horizontal_alignment",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df_faq_wrapper .et_pb_module.difl_faqitem",
      type: "justify-content",
    });

    //output html

    if('on' !== props.output_html){
      additionalCss.push([
        {
          selector: "%%order_class%%.difl_faq .df_faq_wrapper",
          declaration: "display: none;"
        }]);
    }

    // FAQ toggle
    // prettier-ignore
    const inactiveWrappers = "%%order_class%%  .df_faq_item .faq_answer_wrapper, %%order_class%%  .df_faq_item .open_icon, %%order_class%%  .df_faq_item .open_image";
    const activeAnswrapper = "%%order_class%%  .df_faq_item.active .faq_answer_wrapper";
    const activeImgIcon = "%%order_class%%  .df_faq_item.active .open_icon, %%order_class%% .df_faq_item.active .open_image";
    const inActiveImgIcon = "%%order_class%%  .df_faq_item.active .close_icon, %%order_class%% .df_faq_item.active .close_image";
    // prettier-ignore

    additionalCss.push([
      {
        selector: inactiveWrappers,
        declaration: "display: none;"
      }]);

    additionalCss.push([
      {
        selector: activeAnswrapper,
        declaration: "display: block;",
      },
    ]);

    additionalCss.push([
      {
        selector: activeImgIcon,
        declaration: "display: block;",
      },
    ]);

    additionalCss.push([
      {
        selector: inActiveImgIcon,
        declaration: "display: none;",
      },
    ]);

    return additionalCss;
  }

  // prettier-ignore
  render_button(props) {
    const utils = window.ET_Builder.API.Utils;
    const button_text = props.button_text ? <span>{props.button_text }</span> : 'Button';
    const button_url = props.button_url ? props.button_url : '#';
    const button_font_icon  = props.button_font_icon ? utils.processFontIcon(props.button_font_icon) : '5';
    const button_icon_pos   = props.button_icon_placement ? props.button_icon_placement : 'right';

    const button_icon =  'on' === props.use_button_icon ?
        <span className={'et-pb-icon df-faq-button-icon'}>
        {button_font_icon}</span>
     : '';

      return (
        'on' === props.enable_answer_button ?
          <div className="faq_button">
            <a href={button_url}> {button_icon_pos === 'left' ? button_icon : ''} {button_text} {button_icon_pos === 'right' ? button_icon : ''} </a>
          </div> : ""
      )
    }

  // prettier-ignore

  // prettier-ignore
  render_que_icon = (props, utils) =>{
    const close_icon_html = props.close_faq_icon ? <div className="close_icon"><span className="et-pb-icon">{utils.processFontIcon(props.close_faq_icon)}</span></div> : ""
    const open_icon_html = props.open_faq_icon ? <div className="open_icon"><span className="et-pb-icon">{utils.processFontIcon(props.open_faq_icon)}</span></div> : ""

    return(
      <div className="faq_icon">
        {close_icon_html}{open_icon_html}
      </div>
    )
  }
  // prettier-ignore

  // prettier-ignore
  render_que_image = (props) => {

    console.log(props)

    const close_image_html = props.close_question_image ? (
      <div className="close_image">
        <img src={props.close_question_image} alt={props.close_question_image_alt_text} />
      </div>
    ) : ("");

    const open_image_html = props.open_question_image ? (
      <div className="open_image">
        <img src={props.open_question_image} alt={props.open_question_image_alt_text} />
      </div>
    ) : ("");

    if('on' === props.enable_question_image){
      return (
        <div className="faq_question_image">
          {close_image_html} {'' !== open_image_html ? open_image_html : close_image_html}
        </div>
      )
    }

    return null
  }
  // prettier-ignore

  // FAQ toggle
  df_faq_toggle(e) {
    const parent = e.currentTarget.parentNode;
    if($('.df_faq_item').hasClass('active')){
      $('.df_faq_item').removeClass('active')
    }
    parent.classList.add('active');

    this.setState(prvState => ({
      isActive : !prvState.isActive,
    }))
}

  // prettier-ignore
  df_faq_question = (child_props, i) => {
    const props = this.props
    const utils = window.ET_Builder.API.Utils;
    const TitleTag = child_props.question_title_tag ? child_props.question_title_tag : "h3";
    const QueImgHtml = this.render_que_image(child_props);
    const QueIconHtml = this.render_que_icon(props, utils)
    const QueHtml = <div className="faq_question">
          <TitleTag>{child_props.question ? child_props.question : ""}</TitleTag>
        </div>

    return (
      <div className="faq_question_wrapper" data-key={i} onClick={(e) => this.df_faq_toggle(e)}>
        <div className="faq_question_area">
          {QueImgHtml}
          {QueHtml}
        </div>
        {QueIconHtml}
      </div>
    );
  };
  // prettier-ignore

  // prettier-ignore
  df_faq_answer = (child_props, i) => {
    const Answer = child_props.answer ? (child_props.answer).replace(/<p>(.*?)<\/p>/, "$1") : child_props.answer
    const AnsHtml = '' !== child_props.answer ? <div className="faq_answer"> {Answer} </div> : "";
    const AnsBtnHtml = this.render_button(child_props)
    const AnsImgHtml = child_props.answer_image ? (<div className="faq_answer_image"><img src={child_props.answer_image} alt={child_props.answer_image_alt_text} /></div>) : ("");

    return (
      <div className="faq_answer_wrapper" data-key={i}>
        <div className="faq_answer_area">
          {AnsHtml}
          {AnsImgHtml}
        </div>
        {AnsBtnHtml}
      </div>
    );
  };
  // prettier-ignore

  render_faq_items = () => {
    const content = this.props.content;
    const faqType = 'plain' === this.props.faq_layout;

    return [].map.call(content, (data, i) => {
      const child_props = data.props.attrs;
      const child_class = "et_pb_module difl_faqitem difl_faqitem_" + i;

      return (
        <div key={i} className={child_class}>
          <div className="et_pb_module_inner">
            <div key={child_props.question} className={`df_faq_item ${faqType ? 'active' : ""}`}>
              {this.df_faq_question(child_props, i)}
              {this.df_faq_answer(child_props, i)}
            </div>
          </div>
        </div>
      );
    });
  };

  static df_faq_set_dynamic_grid_columns(options = {}) {
    const defaults = {
      props: {},
      key: "",
      additionalCss: "",
      selector: "",
      type: "grid-template-columns",
    };
    const settings = utility.extend(defaults, options);
    const { props, key, additionalCss, selector, type } = settings;

    const desktop_column = props[key];
    const tablet = utility.df_check_values(
      desktop_column,
      props[key + "_tablet"]
    );
    const phone = utility.df_check_values(
      desktop_column,
      props[key + "_phone"]
    );

    additionalCss.push([
      {
        selector: selector,
        declaration: `${type}:repeat(${desktop_column}, 1fr)};`,
      },
    ]);
    additionalCss.push([
      {
        selector: selector,
        declaration: `${type}:repeat(${tablet}, 1fr)};`,
        device: "tablet",
      },
    ]);
    additionalCss.push([
      {
        selector: selector,
        declaration: `${type}:repeat(${phone}, 1fr)};`,
        device: "phone",
      },
    ]);
  }

  render() {
    return (
      <div className="df_faq_wrapper">
        {this.render_faq_items()}
        {0 !== this.props.content.length ? this.props.content : ""}
      </div>
    );
  }
}

export default Faq;
