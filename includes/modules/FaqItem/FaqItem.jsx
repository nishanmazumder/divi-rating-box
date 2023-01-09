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
      toggle: false,
    };
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

  showHideAnswer = () => {
    // const el = ReactDOM.findDOMNode(this);
    // const height = el.querySelector('.faq_answer_wrapper').scrollHeight;
    this.setState({ toggle: true });

    console.log("test");
  };

  static css(props) {
    var additionalCss = [];

    console.log(props);

    return additionalCss;
  }

  render() {
    const props = this.props;
    const question = props.question;
    const answer = utility._renderDynamicContent(this.props, "answer");
    return (
      <>
        {/* {console.log(this.state.toggle)} */}
        <div className="df_faq_item active">
          <div
            className="faq_question_wrapper"
            onClick={() => {
              this.setState({ toggle: true });
            }}
          >
            <div className="faq_question_area">
              <div className="faq_question_image">
                <div className="image_open">
                  <img
                    src="http://divi2.test/wp-content/uploads/2022/12/icon-256x256-1.png"
                    alt=""
                  />
                </div>
                {/* <div className="image_close"><img src="#" alt="" /></div> */}
              </div>

              <div className="faq_question">
                <h3>{question}</h3>
              </div>
            </div>

            <div className="faq_icon">
              <div className="icon_open">
                <span className="">+</span>
              </div>
              {/* <div className="icon_close"><span className="et-pb-icon">-</span></div> */}
            </div>
          </div>

          {this.state.toggle ? (
            <div className="faq_answer_wrapper">
              <div className="faq_answer_area">
                <div className="faq_answer">
                  <p>{answer}</p>
                </div>
                <div className="faq_answer_image">
                  <img
                    src="http://divi2.test/wp-content/uploads/2022/12/covid-donate.jpg"
                    alt=""
                  />
                </div>
              </div>
              <div className="faq_button">
                <a href="#" className="">
                  Button
                </a>
              </div>
            </div>
          ) : (
            ""
          )}
        </div>
      </>
    );
  }
}

export default FaqItem;

{
  // Structure
  //   <div className="df_faq_wrapper">
  //     <div className="df_faq_item active">
  //       {/* Question */}
  //       <div className="faq_question_wrapper">
  //         {/* Question area */}
  //         <div className="faq_question_area">
  //           <div className="faq_question_image">
  //             <div className="image_open"><img src="#" alt="" /></div>
  //             <div className="image_close"><img src="#" alt="" /></div>
  //           </div>
  //           <div className="faq_question">
  //             <h5>Question?</h5>
  //           </div>
  //         </div>
  //         {/* Icon area */}
  //         <div className="faq_icon">
  //           <div className="icon_open"><span className="et-pb-icon">+</span></div>
  //           <div className="icon_close"><span className="et-pb-icon">-</span></div>
  //         </div>
  //       </div>
  //       {/* Answer */}
  //       <div className="faq_answer_wrapper">
  //         <div className="faq_content_area">
  //           <div className="faq_content">
  //             <p>Answer...</p>
  //           </div>
  //           <div className="faq_answer_image">
  //             <img src="#" alt="" />
  //           </div>
  //         </div>
  //         <div className="faq_button">
  //           <a href="#" className=""></a>
  //         </div>
  //       </div>
  //     </div> {/* loop */}
  // </div>
}
