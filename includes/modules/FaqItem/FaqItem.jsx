import React, { Component } from "react";
// import ReactDOM from 'react-dom';
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class FaqItem extends Component {
  static slug = "difl_faqitem";

  // constructor(props) {
  //   super(props);

  //   // this.state = {
  //   //   toggle: false,
  //   // };

  //   // this.showHideAnswer = this.showHideAnswer.bind(this);

  //   // console.log(props)
  // }

  // componentDidMount() {
  // 	window.setTimeout(() => {
  // 		const el = ReactDOM.findDOMNode(this);
  // 		const height = el.querySelector('.faq_answer_wrapper').scrollHeight;

  //     console.log(height)

  // 		this.setState({
  // 			height
  // 		});
  // 	}, 333);
  // }

  // showHideAnswer = () => {
  //   // const el = ReactDOM.findDOMNode(this);
  //   // const height = el.querySelector('.faq_answer_wrapper').scrollHeight;
  //   this.setState({ toggle: true });

  //   // console.log(this.state.toggle);
  // };

  static css(props) {
    var additionalCss = [];



    utility.process_icon_font_style({
      'props'             : props,
      'additionalCss'     : additionalCss,
      'key'               : 'button_font_icon',
      'selector'          : '%%order_class%% .et-pb-icon'
    })

    console.log(props);

    return additionalCss;
  }

  // prettier-ignore
  render_button(props) {
    const utils = window.ET_Builder.API.Utils;
    const button_text = props['button_text'] ? <span>{props['button_text'] }</span> : '';
    const button_url = props['button_url'] ? props['button_url'] : '';
    const button_font_icon  = props['button_font_icon'] ? props['button_font_icon'] : '5';
    const button_icon_pos   = props['button_icon_placement'];

    const button_icon =  'off' !== props['use_button_icon'] ?
        <span className={'et-pb-icon'}>
        {utils.processFontIcon(button_font_icon)}</span>
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
    const close_icon_html = props.close_faq_icon ? <div className="close_icon"><span className="">{utils.processFontIcon(props.close_faq_icon)}</span></div> : ""
    const open_icon_html = props.open_faq_icon ? <div className="close_icon"><span className="">{utils.processFontIcon(props.open_faq_icon)}</span></div> : ""

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
        <img src={utility._renderDynamicContent(props , 'close_question_image' , false)} alt={props.close_question_image_alt_text} />
      </div>
    ) : ("");

    const open_image_html = props.open_question_image ? (
      <div className="open_image">
        <img src={utility._renderDynamicContent(props , 'close_question_image' , false)} alt={props.open_question_image_alt_text} />
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
  df_faq_question = () => {
    const props = this.props;
    const utils = window.ET_Builder.API.Utils;
    const TitleTag = props.question_title_tag ? props.question_title_tag : "h3";
    const QueImgHtml = this.render_que_image(props);
    const QueHtml = props.dynamic.question.hasValue ? (
      <div className="faq_question">
        <TitleTag>{utility._renderDynamicContent(props, "question")}</TitleTag>
      </div>
    ) : ("");
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

  df_faq_answer = () => {
    const props = this.props;
    const AnsHtml = props.dynamic.answer.hasValue  !== '' ? <div className="faq_answer"> {utility._renderDynamicContent(this.props, "answer")} </div> : '';
    const AnsImgHtml = props.answer_image ? (
      <div className="faq_answer_image">
        <img src={utility._renderDynamicContent(props , 'answer_image' , false)} alt={props.answer_image_alt_text} />
      </div>
    ) : ("");

   const AnsBtnHtml = this.render_button(this.props)

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

  render() {
    // const props = this.props;

    const FaqItemHtml = (
      <div className="df_faq_item active">
        {this.df_faq_question()}
        {this.df_faq_answer()}
      </div>
    );

    {
      /* {console.log(this.state.toggle)} */
    }
    return <>{FaqItemHtml}</>;
  }
}

export default FaqItem;

{
  // Structure
  // <div className="df_faq_item active">
  //   <div className="faq_question_wrapper" onClick={this.showHideAnswer}>
  //     <div className="faq_question_area">
  //       <div className="faq_question_image">
  //         <div className="close_image"><img src="http://divi2.test/wp-content/uploads/2022/12/icon-256x256-1.png" alt=""/></div>
  //         {/* <div className="open_image"><img src="#" alt="" /></div> */}
  //       </div>
  //       <div className="faq_question">
  //         <h3>{question}</h3>
  //       </div>
  //     </div>
  //     <div className="faq_icon">
  //       <div className="close_icon"> <span className="">+</span> </div>
  //       {/* <div className="open_icon"><span className="et-pb-icon">-</span></div> */}
  //     </div>
  //   </div>
  //   <div className="faq_answer_wrapper">
  //     <div className="faq_answer_area">
  //       <div className="faq_answer">
  //         <p>{answer}</p>
  //       </div>
  //       <div className="faq_answer_image">
  //         {/* prettier-ignore */}
  //         <img src="http://divi2.test/wp-content/uploads/2022/12/covid-donate.jpg" alt="" />
  //       </div>
  //     </div>
  //     <div className="faq_button">
  //       <a href="#" className="">
  //         <span>button</span>
  //         <span>icon</span>
  //       </a>
  //     </div>
  //   </div>
  // </div>
}
