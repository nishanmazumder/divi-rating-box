import React, { Component } from "react";
// import ReactDOM from 'react-dom';
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class FaqItem extends Component {
  static slug = "difl_faqitem";

  constructor(props) {
    super(props);

    this.state = {
      active: false,
    };

    // this.showHideAnswer = this.showHideAnswer.bind(this);

    // console.log(props)
  }

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

    console.log(props)

    var additionalCss = [];

    if ("" !== props.button_font_icon) {
      utility.process_icon_font_style({
        props: props,
        additionalCss: additionalCss,
        key: "button_font_icon",
        selector: "%%order_class%% .et-pb-icon.df-faq-button-icon",
      });
    }

    // Button icon
    if ("on" === props.use_button_icon) {
      utility.process_color({
        props: props,
        key: "button_icon_color",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_button a .et-pb-icon",
        type: "color",
        // 'important': true
      });

      utility.process_range_value({
        props: props,
        key: "button_icon_size",
        additionalCss: additionalCss,
        default: "20px",
        selector: "%%order_class%% .faq_button .et-pb-icon",
        type: "font-size",
      });
    }

    // question image placement
    if ("inherit" !== props.question_image_placement) {
      utility.df_process_string_attr({
        props: props,
        key: "question_image_placement",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_question_area",
        type: "flex-direction",
        default_value: "row",
      });
    }

    // answer image width
    utility.process_range_value({
      props: props,
      key: "answer_image_width",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer_image",
      type: "width",
    });

    // answer image placement
    utility.df_process_string_attr({
      props: props,
      key: "answer_image_placement",
      additionalCss: additionalCss,
      selector: "%%order_class%% .faq_answer_area",
      type: "flex-flow",
    });

    // button design
    if ("on" === props.button_full_width) {
      additionalCss.push([
        {
          selector: "%%order_class%% .faq_button a",
          declaration: "display: block !important;",
        },
      ]);
    }

    if ("off" === props.button_full_width && "" !== props.button_alignment) {
      utility.df_process_string_attr({
        props: props,
        key: "button_alignment",
        additionalCss: additionalCss,
        selector: "%%order_class%% .faq_button",
        type: "text-align",
        default_value: "left",
      });
    }

    // console.log(props);

    return additionalCss;
  }

  render() {

    // console.log(this.props)

    return null;
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
