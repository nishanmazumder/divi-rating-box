import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class FaqItem extends Component {
  static slug = "difl_faqitem";

  static css(props) {
    var additionalCss = [];

    console.log(props);

    return additionalCss;
  }

  render() {
    const props = this.props;
    const question = props.question;
    const answer = props.answer;
    return (
      <>
        <div className="df_faq_item active">
          <div className="faq_question">
            <div className="faq_question_image">
              <div className="image_open">
                <img src="http://divi2.test/wp-content/uploads/2023/01/faq-demo-icons3.png" alt="" />
              </div>
              {/* <div className="image_close">
                <img src="#" alt="" />
              </div> */}
            </div>
            <h5 className="faq_title">{question}</h5>
            <div className="faq_icon">
              <div className="icon_open">
                <span className="">+</span>
              </div>
              {/* <div className="icon_close">
                <span className="">-</span>
              </div> */}
            </div>
          </div>

          <div className="faq_answer">
            <div className="faq_content_wrapper">
              <div className="faq_content">
                <p>{answer}</p>
              </div>
              <div className="faq_answer_image">
                <img src="#" alt="" />
              </div>
            </div>
            <div className="faq_button">
              <a href="#" className=""></a>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default FaqItem;

{
  // Structure
    <div className="df_faq_wrapper">
      <div className="df_faq_item active">

        {/* Question */}
        <div className="faq_question_wrapper">

          {/* Question area */}
          <div className="faq_question_area">

            <div className="faq_question_image">
              <div className="image_open"><img src="#" alt="" /></div>
              <div className="image_close"><img src="#" alt="" /></div>
            </div>

            <div className="faq_question">
              <h5>Question?</h5>
            </div>
          </div>

          {/* Icon area */}
          <div className="faq_icon">
            <div className="icon_open"><span className="et-pb-icon">+</span></div>
            <div className="icon_close"><span className="et-pb-icon">-</span></div>
          </div>

        </div>

        {/* Answer */}
        <div className="faq_answer_wrapper">
          <div className="faq_content_area">
            <div className="faq_content">
              <p>Answer...</p>
            </div>
            <div className="faq_answer_image">
              <img src="#" alt="" />
            </div>
          </div>
          <div className="faq_button">
            <a href="#" className=""></a>
          </div>
        </div>

      </div> {/* loop */}
  </div>
}
