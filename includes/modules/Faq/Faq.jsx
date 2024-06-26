// have to remove key form answer and question function

import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import $ from "jquery";
import "./style.css";

class Faq extends Component {
  static slug = "difl_faq";
  _isMounted = false;

  constructor(props) {
    super(props);
    this.state = {
      loading: true,
      isActive: false
    };

    this.wrapper = React.createRef();
    this.render_faq_items = this.render_faq_items.bind(this);
  }

  componentDidMount() {
    this._isMounted = true;
    if (this.state.loading === true) {
        this.setState({ loading: false })
    }
}

  componentDidUpdate() {
    // this.render_faq_items()
    if (this.props.activate_on_first_time === 'on') {
      this.df_active_item();
    }
  }

  componentWillUnmount() {
    this._isMounted = false;
}

  static css(props) {
    var additionalCss = [];

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "faq_wrapper_bg",
      selector: "%%order_class%%",
    });

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "faq_item_wrapper_bg",
      selector: "%%order_class%% .difl_faqitem .df_faq_item",
      important: true,
    });

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "default_que_wrapper_bg",
      selector: "%%order_class%% .faq_question_wrapper",
    });

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "active_que_wrapper_bg",
      selector: "%%order_class%% .df_faq_item.active .faq_question_wrapper",
    });

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "ans_wrapper_bg",
      selector: "%%order_class%% .faq_answer_area",
    });

    utility.process_color({
      props: props,
      key: "faq_icon_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_icon",
      type: "background-color",
    });

    utility.process_color({
      props: props,
      key: "active_faq_icon_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df_faq_item.active .faq_icon",
      type: "background-color",
    });

    utility.process_color({
      props: props,
      key: "que_img_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_image",
      type: "background-color",
    });

    utility.process_color({
      props: props,
      key: "active_que_img_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df_faq_item.active .faq_question_image",
      type: "background-color",
    });

    utility.process_color({
      props: props,
      key: "close_icon_color",
      additionalCss: additionalCss,
      selector: "%%order_class%% .close_icon span.et-pb-icon",
      type: "color",
    });

    utility.process_range_value({
      props: props,
      key: "close_icon_size",
      additionalCss: additionalCss,
      selector: "%%order_class%% .close_icon span.et-pb-icon",
      type: "font-size",
    });

    utility.process_color({
      props: props,
      key: "open_icon_color",
      additionalCss: additionalCss,
      selector: "%%order_class%% .open_icon span.et-pb-icon",
      type: "color",
    });

    utility.df_process_bg({
      props: props,
      additionalCss: additionalCss,
      key: "ans_button_bg",
      selector: "%%order_class%% .faq_button a",
    });

    utility.process_color({
      props: props,
      key: "button_text_color",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button a",
      type: "color",
    });

    utility.process_color({
      props: props,
      key: "button_icon_color",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button_icon",
      type: "color",
    });

    utility.process_range_value({
      props: props,
      key: "button_icon_size",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button_icon",
      type: "font-size",
    });

    utility.process_range_value({
      props: props,
      key: "open_icon_size",
      additionalCss: additionalCss,
      selector: "%%order_class%% .open_icon span.et-pb-icon",
      type: "font-size",
    });

    utility.process_range_value({
      props: props,
      key: "close_que_img_size",
      additionalCss: additionalCss,
      selector: "%%order_class%% .close_image img",
      type: "max-width",
    });

    utility.process_range_value({
      props: props,
      key: "open_que_img_size",
      additionalCss: additionalCss,
      selector: "%%order_class%% .open_image img",
      type: "max-width",
    });

    utility.process_margin_padding({
      props: props,
      key: "faq_wrapper_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%%",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "faq_wrapper_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%%",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "faq_item_wrapper_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .difl_faqitem .df_faq_item",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "faq_item_wrapper_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .difl_faqitem .df_faq_item",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_wrapper_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_wrapper",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_wrapper_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_wrapper",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_text_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_title",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_icon_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_icon",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_icon_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_icon",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_img_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_image",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "que_img_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_image",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_wrapper_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer_area",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_wrapper_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer_area",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_text_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_img_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer_image img",
      type: "padding",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_btn_icon_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button_icon",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_button_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button a",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "ans_button_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_button a",
      type: "padding",
    });

    if ("" !== props.close_faq_icon) {
      utility.process_icon_font_style({
        props: props,
        additionalCss: additionalCss,
        key: "close_faq_icon",
        selector: "%%order_class%% .faq_icon .close_icon span.et-pb-icon",
      });
    }

    if ("" !== props.open_faq_icon) {
      utility.process_icon_font_style({
        props: props,
        additionalCss: additionalCss,
        key: "open_faq_icon",
        selector: "%%order_class%% .faq_icon .open_icon span.et-pb-icon",
      });
    }

    if ("on" === props.disable_faq_icon) {
      additionalCss.push([
        {
          selector: "%%order_class%% .faq_icon",
          declaration: `display: none;`,
        },
      ]);
    }

    if ("inherit" !== props.faq_que_swap) {
      utility.df_process_string_attr({
        props: props,
        key: "faq_que_swap",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_question_wrapper",
        type: "flex-direction",
      });
    }

    // alignment - flex - space-bet
    utility.df_process_string_attr({
      props: props,
      key: "faq_que_alignment",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_question_wrapper",
      type: "justify-content",
    });

    // alignment - vertical
    utility.df_process_string_attr({
      props: props,
      key: "faq_que_vertical_alignment",
      additionalCss: additionalCss,
      selector:
        "%%order_class%% .faq_question_wrapper, %%order_class%% .faq_question_area",
      type: "align-items",
    });

    // faq grid layout
    if ("on" === props.faq_layout_grid) {
      this.df_faq_set_grid_columns({
        props: props,
        key: "faq_item_per_column",
        additionalCss: additionalCss,
        selector: "%%order_class%% .df_faq_wrapper",
        type: "grid-template-columns",
      });
    }

    // faq item gap
    utility.process_range_value({
      props: props,
      key: "faq_item_gap",
      additionalCss: additionalCss,
      selector: "%%order_class%%.difl_faq .df_faq_wrapper",
      type: "gap",
    });

    // faq item width
    if ("on" === props.faq_item_equal_width) {
      additionalCss.push([
        {
          selector: "%%order_class%% .difl_faqitem div.et_pb_module_inner",
          declaration: `width: 100% !important;`,
        },
      ]);
    } else {
      utility.process_range_value({
        props: props,
        key: "faq_item_width",
        additionalCss: additionalCss,
        default: "50%",
        selector: "%%order_class%% .difl_faqitem div.et_pb_module_inner",
        type: "width",
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
    if ("on" !== props.output_html) {
      additionalCss.push([
        {
          selector: "%%order_class%%.difl_faq .df_faq_wrapper",
          declaration: "display: none;",
        },
      ]);
    }

    // FAQ toggle
    // prettier-ignore
    const inactiveElments  = "%%order_class%%  .df_faq_item .faq_answer_wrapper, %%order_class%% .df_faq_item .open_icon, %%order_class%% .df_faq_item .open_image";
    const activeAnswrapper = "%%order_class%%  .df_faq_item.active .faq_answer_wrapper";
    const activeImgIcon = "%%order_class%%  .df_faq_item.active .open_icon, %%order_class%% .df_faq_item.active .open_image";
    const inActiveImgIcon = "%%order_class%%  .df_faq_item.active .close_icon, %%order_class%% .df_faq_item.active .close_image";
    // prettier-ignore

    additionalCss.push([
      {
        selector: inactiveElments,
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

    // button design
    if ("" !== props.button_alignment) {
      utility.df_process_string_attr({
        props: props,
        key: "button_alignment",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_button",
        type: "text-align",
        default_value: "left",
      });
    }

    return additionalCss;
  }

  df_active_item = () => {
    if (this.state.loading === true) {
      this.setState({ loading: false })
      return;
    }

    const parent_class = this.props.moduleInfo.orderClassName;
    const active_item = this.props.activate_on_first_time === 'on' ? this.props.active_item_order_number : 1;
    const allItems = document.querySelectorAll('.' + parent_class + ' .difl_faqitem .df_faq_item')

    if(this.props.active_item_order_number <= allItems.length){
        const activeItem = document.querySelectorAll('.' + parent_class + ' .difl_faqitem .df_faq_item')[active_item - 1]

        if (this.props.activate_on_first_time === 'on') {
            allItems.forEach(ele => {ele.classList.remove('active')});
            activeItem.classList.add('active')
          } else {
            allItems.forEach(ele => {ele.classList.remove('active')});
            return
          }
    }

    return
  }

  render_button(props) {
    const utils = window.ET_Builder.API.Utils;
    const button_text = props.button_text ? <span>{props.button_text }</span> : 'Button';
    const button_url = props.button_url ? props.button_url : '#';
    const button_font_icon  = props.button_font_icon ? utils.processFontIcon(props.button_font_icon) : '5';
    const button_icon_pos   = props.button_icon_placement ? props.button_icon_placement : 'right';

    const button_icon =  'on' === props.use_button_icon ?
        <span className={'et-pb-icon faq_button_icon'}>
        {button_font_icon}</span>
     : '';

      return (
        'on' === props.enable_answer_button ?
          <div className="faq_button">
            <a href={button_url}> {button_icon_pos === 'left' ? button_icon : ''} {button_text} {button_icon_pos === 'right' ? button_icon : ''} </a>
          </div> : ""
      )
    }

  render_que_icon = (props, utils) =>{
    const close_icon_html = props.close_faq_icon ? <div className="close_icon"><span className="et-pb-icon">{utils.processFontIcon(props.close_faq_icon)}</span></div> : ""
    const open_icon_html = props.open_faq_icon ? <div className="open_icon"><span className="et-pb-icon">{utils.processFontIcon(props.open_faq_icon)}</span></div> : ""

    return(
      <div className="faq_icon">
        {close_icon_html}{open_icon_html}
      </div>
    )
  }

  render_que_image = (props) => {
    const close_image = '' !== props.close_question_image ? props.close_question_image : ""
    const close_img_alt_txt = '' !== props.close_que_img_alt_txt ? props.close_que_img_alt_txt : ""
    const open_image = '' !== props.open_question_image ? props.open_question_image : ""
    const open_img_alt_txt= '' !== props.open_que_img_alt_txt ? props.open_que_img_alt_txt : ""

    const que_img_revert =
    <div className="open_image">
        <img src={close_image} alt={close_img_alt_txt} />
    </div>

    const close_image_html = props.close_question_image ? (
      <div className="close_image">
        <img src={close_image} alt={close_img_alt_txt} />
      </div>
    ) : ("");

    const open_image_html = props.open_question_image ? (
      <div className="open_image">
        <img src={open_image} alt={open_img_alt_txt} />
      </div>
    ) :  que_img_revert;

    if('on' === props.enable_question_image){
      return (
        <div className="faq_question_image">
           {close_image_html} {open_image_html}
        </div>
      )
    }

    return null
  }

  df_faq_toggle(e) {
    if('plain' === this.props.faq_layout) return
    const parent = e.currentTarget.parentNode;
    const parent_class = this.props.moduleInfo.orderClassName;

    const parent_wrapper = document.querySelector(`.${parent_class}`)
    const wrapper = parent_wrapper.querySelectorAll('.df_faq_item')

    wrapper.forEach(el => {
      if(el.classList.contains("active")){
        el.classList.remove("active")
      }
    });

    parent.classList.add("active")
}

  df_faq_question = (child_props, i) => {
    const props = this.props
    const utils = window.ET_Builder.API.Utils;
    const TitleTag = child_props.question_title_tag ? child_props.question_title_tag : "h3";
    const QueImgHtml = this.render_que_image(child_props);
    const QueIconHtml = this.render_que_icon(props, utils)
    const QueHtml = child_props.question ? <div className="faq_question">
          <TitleTag className="faq_question_title">{child_props.question}</TitleTag>
        </div>  : "";

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

  df_faq_answer = (child_props, i) => {
    const AnsHtml = '' !== child_props.answer ? <div dangerouslySetInnerHTML={{__html: child_props.answer}} className="faq_answer" />: "";

    const AnsBtnHtml = this.render_button(child_props)
    const AnsImgHtml = child_props.answer_image ? (<div className="faq_answer_image"><img src={child_props.answer_image} alt={child_props.answer_image_alt_text} /></div>) : ("");

    return (
      <div className="faq_answer_wrapper" data-key={i}>
        <div className="faq_answer_area">
          <div className="faq_content">
            {AnsHtml}
            {AnsImgHtml}
          </div>
          {AnsBtnHtml}
        </div>
      </div>
    );
  };

  render_faq_items = () => {
    const content = this.props.content;
    return [].map.call(content, (data, i) => {
      const child_props = data.props.attrs;
      const disable_item_class = this.df_multicheck_value(child_props)
      const child_class = `et_pb_module difl_faqitem difl_faqitem_${i} ${disable_item_class}`;

      return (
        <div key={i} className={child_class}>
          <div className="et_pb_module_inner">
            <div key={child_props.question} className={`df_faq_item`} ref={this.wrapper}>
              {this.df_faq_question(child_props, i)}
              {this.df_faq_answer(child_props, i)}
            </div>
          </div>
        </div>
      );
    });
  };

  df_multicheck_value = (props) => {
    if (!!props.disable_faq_item) {
      const values = props.disable_faq_item.split("|");
      const responsive = ["desktop", "tablet", "mobile"];
      const devices = [];
      let classes = "";

      for (let i = 0; i <= values.length; i++) {
        if ("on" === values[i]) {
          devices[responsive[i]] = values[i];
        }
      }

      classes += "on" === devices.desktop ? "df_hide_desktop " : "";
      classes += "on" === devices.tablet ? "df_hide_tablet " : "";
      classes += "on" === devices.mobile ? "df_hide_mobile " : "";

      return classes;
    } else {
      return "";
    }
  };

  static df_faq_set_grid_columns(options = {}) {
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
        {this.state.loading === false ?
          <React.Fragment>
            {this.render_faq_items()}
            <div className="df_content_props">
              {0 !== this.props.content.length ? this.props.content : ""}
            </div>
        </React.Fragment> : <React.Fragment>Loading</React.Fragment>}
      </div>
    );
  }
}

export default Faq;
