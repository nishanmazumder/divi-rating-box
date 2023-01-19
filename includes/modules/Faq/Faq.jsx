import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class FAQ extends Component {
  static slug = "difl_faq";

  static css(props) {
    var additionalCss = [];

  //  console.log(props);

    return additionalCss;
  }

  render() {
    return (
      <>
        <div className="df_faq_wrapper">
            {this.props.content}
        </div>
      </>
    );
  }
}

export default FAQ;
