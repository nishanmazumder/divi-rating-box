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


    // console.log(props);

    return additionalCss;
  }

  render() {
    return false;
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
