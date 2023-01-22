import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class FAQ extends Component {
  static slug = "difl_faq";

  constructor(props) {
    super(props);

    this.render_faq_items = this.render_faq_items.bind(this);
  }

  componentDidUpdate() {
    this.render_faq_items();
  }

  static css(props) {
    var additionalCss = [];

    utility.process_icon_font_style({
      props: props,
      additionalCss: additionalCss,
      key: "close_faq_icon",
      selector: "%%order_class%% .et-pb-icon",
    });

    utility.process_icon_font_style({
      props: props,
      additionalCss: additionalCss,
      key: "open_faq_icon",
      selector: "%%order_class%% .et-pb-icon",
    });

    utility.process_icon_font_style({
      props: props,
      additionalCss: additionalCss,
      key: "button_font_icon",
      selector: "%%order_class%% .et-pb-icon",
    });

    //  console.log(props);

    return additionalCss;
  }

  render_faq_items = () => {
    const content = this.props.content;

    return content.map((data, i) => {
      const child_props = data.props.attrs;
      const child_class = "et_pb_module difl_faqitem difl_faqitem_" + i;

      return (
        <div key={i} className={child_class}>
          <div className="et_pb_module_inner">
            <div key={child_props.question} className="df_faq_item active">
              {this.df_faq_question(child_props)}
              {this.df_faq_answer(child_props)}
            </div>
          </div>
        </div>
      );
    });
  };

  // prettier-ignore
  render_button(props) {
    const utils = window.ET_Builder.API.Utils;
    const button_text = props['button_text'] ? <span>{props['button_text'] }</span> : '';
    const button_url = props['button_url'] ? props['button_url'] : '';
    const button_font_icon  = props['button_font_icon'] ? utils.processFontIcon(props['button_font_icon']) : '5';
    const button_icon_pos   = props['button_icon_placement'];

    const button_icon =  'off' !== props['use_button_icon'] ?
        <span className={'et-pb-icon'}>
        {button_font_icon}</span>
     : '';

    if (button_text !== '' || button_url !== '') {
      return (
        <div className="faq_button">
          <a href={button_url}> {button_icon_pos === 'left' ? button_icon : ''} {button_text} {button_icon_pos === 'right' ? button_icon : ''} </a>
        </div>
      )
    } else return '';
  }
  // prettier-ignore

  // prettier-ignore
  render_que_icon = (props, utils) =>{
    const close_icon_html = props.close_faq_icon ? <div className="close_icon"><span className="et-pb-icon">{utils.processFontIcon(props.close_faq_icon)}</span></div> : ""
    const open_icon_html = props.open_faq_icon ? <div className="close_icon"><span className="et-pb-icon">{utils.processFontIcon(props.open_faq_icon)}</span></div> : ""

    return(
      <div className="faq_icon">
        {close_icon_html}{open_icon_html}
      </div>
    )
  }
  // prettier-ignore

  // prettier-ignore
  render_que_image = (props) => {
    const close_image_html = props.close_question_image ? (
      <div className="close_image">
        {/* <img src={utility._renderDynamicContent(props , 'close_question_image' , false)} alt={props.close_question_image_alt_text} /> */}
        <img src={props.close_question_image} alt={props.close_question_image_alt_text} />
      </div>
    ) : ("");

    const open_image_html = props.open_question_image ? (
      <div className="open_image">
        {/* <img src={utility._renderDynamicContent(props , 'close_question_image' , false)} alt={props.open_question_image_alt_text} /> */}
        <img src={props.open_question_image} alt={props.open_question_image_alt_text} />
      </div>
    ) : ("");

    if(props.enable_question_image){
      return (
        <div className="faq_question_image">
          {close_image_html} {open_image_html}
        </div>
      )
    }

    return null
  }
  // prettier-ignore

  // prettier-ignore
  df_faq_question = (child_props) => {
    const props = this.props
    const utils = window.ET_Builder.API.Utils;
    const TitleTag = child_props.question_title_tag ? child_props.question_title_tag : "h3";
    const QueImgHtml = this.render_que_image(child_props);
    const QueHtml = <div className="faq_question">
        {/* <TitleTag>{utility._renderDynamicContent(child_props, "question")}</TitleTag> */}
          <TitleTag>{child_props.question ? child_props.question : ""}</TitleTag>
        </div>

    const QueIconHtml = this.render_que_icon(props, utils)

    return (
      <div className="faq_question_wrapper">
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
  df_faq_answer = (child_props) => {
    // const AnsHtml = props.dynamic.answer.hasValue  !== '' ? <div className="faq_answer"> {utility._renderDynamicContent(this.props, "answer")} </div> : '';
    const AnsHtml = child_props.answer  !== '' ? <div className="faq_answer"> {child_props.answer} </div> : '';
    const AnsImgHtml = child_props.answer_image ? (
      <div className="faq_answer_image">
        {/* <img src={utility._renderDynamicContent(props , 'answer_image' , false)} alt={props.answer_image_alt_text} /> */}
        <img src={child_props.answer_image} alt={child_props.answer_image_alt_text} />
      </div>
    ) : ("");

   const AnsBtnHtml = this.render_button(child_props)

    return (
      <div className="faq_answer_wrapper">
        <div className="faq_answer_area">
          {AnsHtml}
          {AnsImgHtml}
        </div>
        {AnsBtnHtml}
      </div>
    );
  };
   // prettier-ignore

  render() {
    return (
      <div className="df_faq_wrapper">
        {this.render_faq_items()}
      </div>
    )
  }
}

export default FAQ;
