import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class RatingBox extends Component {
  static slug = "difl_ratingbox";
  static css(props) {
    var additionalCss = [];

    //  Rating icon wrapper background
    utility.df_process_bg({
      props: props,
      key: "rating_box_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-wrapper",
    });

    //  Rating icon background
    utility.df_process_bg({
      props: props,
      key: "rating_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon",
    });

    //  Title background
    utility.df_process_bg({
      props: props,
      key: "rating_title_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-title",
    });

    //  Content background
    utility.df_process_bg({
      props: props,
      key: "rating_content_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-content",
    });

    // Rating Color
    utility.process_color({
      props: props,
      key: "rating_color",
      additionalCss: additionalCss,
      selector:
        "%%order_class%% .df-rating-icon .et-pb-icon, %%order_class%% span.df-rating-icon-fill::before",
      type: "color",
      important: true,
    });

    // Rating inactive color
    utility.process_color({
      props: props,
      key: "rating_color_inactive",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon .et-pb-icon",
      type: "color",
      important: true,
    });

    // Rating active color
    utility.process_color({
      props: props,
      key: "rating_color_active",
      additionalCss: additionalCss,
      selector: "%%order_class%% span.df-rating-icon-fill::before",
      type: "color",
      important: true,
    });

    // Rating Icon (+ before) Size
    utility.process_range_value({
      props: props,
      key: "rating_icon_size",
      additionalCss: additionalCss,
      selector:
        "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% span.df-rating-icon-fill::before",
      type: "font-size",
      important: true,
    });

    // Rating icon spacing
    utility.process_range_value({
      props: props,
      key: "rating_icon_space",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon .et-pb-icon",
      type: "margin-left",
      unit: "px",
      default_value: "5px",
    });

    utility.process_range_value({
      props: props,
      key: "rating_icon_space",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon .et-pb-icon",
      type: "margin-right",
      unit: "px",
      default_value: "5px",
    });

    // Rating number spacing
    utility.process_margin_padding({
      props: props,
      key: "rating_number_space",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-number",
      type: "padding",
      important: false,
    });

    ////// Custom Spacing //

    // Rating wrapper
    utility.process_margin_padding({
      props: props,
      key: "rating_box_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-wrapper",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "rating_box_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-wrapper",
      type: "padding",
    });

    // Rating Icon
    utility.process_margin_padding({
      props: props,
      key: "rating_box_icon_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "rating_box_icon_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon",
      type: "padding",
    });

    // Title wrapper
    utility.process_margin_padding({
      props: props,
      key: "rating_box_title_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-title",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "rating_box_title_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-title",
      type: "padding",
    });

    // Content wrapper
    utility.process_margin_padding({
      props: props,
      key: "rating_box_content_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-content",
      type: "margin",
    });

    utility.process_margin_padding({
      props: props,
      key: "rating_box_content_padding",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-content",
      type: "padding",
    });

    utility.process_icon_font_style({
      props: props,
      key: "rating_icon",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon .et-pb-icon",
    });

    // Rating Icon
    if (props.enable_custom_icon === "on" && props.rating_icon !== "") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
          declaration: `content: attr(data-icon); color: #333;`,
        },
      ]);
    }

    // Rating Alignment
    utility.df_process_string_attr({
      props: props,
      key: "rating_icon_align",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon",
      type: "text-align",
      default_value: "center",
    });

    let rating_justify_content = "";
    let rating_float_content = "";
    if (props.rating_icon_align === "right") {
      rating_justify_content = "end";
      rating_float_content = "right"
    } else if (props.rating_icon_align === "left") {
      rating_justify_content = "start";
      rating_float_content = "left";
    } else {
      rating_justify_content = "center";
      rating_float_content = "none";
    }

    if (props.enable_single_rating === "on") {
      // Rating Ttile + Icon align (single rating)
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-wrapper`,
          declaration: `display: flex; align-items: center; justify-content: ${rating_justify_content};`,
        },
      ]);
    }

    // Rating alignment
    if (props.title_display_type === "block") {
      if (props.title_placement_top_bottom === "top") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `display: flex; flex-direction: column-reverse; align-items: center; float: ${rating_float_content};`,
          },
        ]);
      } else {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `display: flex; flex-direction: column; align-items: center; float: ${rating_float_content};`,
          },
        ]);
      }
    } else {
      if (props.title_placement_left_right === "left") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `display: flex; flex-direction: row-reverse; align-items: center; justify-content: ${rating_justify_content};`,
          },
        ]);
      } else if(props.title_placement_left_right === "right"){
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `display: flex; flex-direction: row; align-items: center; justify-content: ${rating_justify_content};`,
          },
        ]);
      }else{
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `display: flex; flex-direction: row; align-items: center; justify-content: center;`,
          },
        ]);
      }
    }

    // Rating number disable
    if (props.enable_single_rating === "on") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-number`,
          declaration: `display: none;`,
        },
      ]);
    }

    console.log(props);

    return additionalCss;
  }

  df_render_rating_wrapper() {
    const props = this.props;
    const utils = window.ET_Builder.API.Utils;

    // Rating scale type
    let rating_scale_type =
      props.enable_single_rating === "off"
        ? props.rating_scale_type !== ""
          ? parseInt(props.rating_scale_type)
          : 5
        : 1;

    // Rating value
    let rating_value =
      rating_scale_type === 5
        ? typeof props.rating_value_5 !== "undefined" &&
          props.rating_value_5 !== ""
          ? props.rating_value_5
          : 5
        : typeof props.rating_value_10 !== "undefined" &&
          props.rating_value_10 !== ""
        ? props.rating_value_10
        : 10;

    // Get only Icon
    const icon =
      props.enable_custom_icon === "on" && props.rating_icon !== ""
        ? utils.processFontIcon(props.rating_icon)
        : utils.processFontIcon("&#xe031;");

    // Set Rating Icon
    let rating_icon = [];
    let rating_active_class = "";
    let get_float =
      typeof rating_value === "string" && rating_value.includes(".")
        ? rating_value.split(".")
        : parseInt(rating_value);

    // Display rating Icon
    for (let i = 1; i <= rating_scale_type; i++) {
      if (typeof rating_value === "undefined") {
        rating_active_class = "";
      } else if ([] !== get_float && i <= get_float) {
        rating_active_class = "df-rating-icon-fill";
      } else if (
        i <= parseInt(get_float[0]) ||
        (1 < parseInt(get_float[1]) &&
          parseInt(get_float[0]) + parseInt(1) == i)
      ) {
        if (i <= parseInt(get_float[0])) {
          rating_active_class = "df-rating-icon-fill";
        } else {
          rating_active_class = `df-rating-icon-fill df-fill-${get_float[1]}`;
        }
      } else {
        rating_active_class = "df-rating-icon-empty";
      }

      rating_icon.push(
        <span
          className={"et-pb-icon " + rating_active_class}
          key={i}
          data-icon={icon}
        >
          {icon}
        </span>
      );
    }

    // Show rating number/text
    let ratingNumber =
      props.enable_rating_number === "on" ? (
        props.enable_rating_number_bracket === "on" ? (
          <span className="df-rating-number">{`( ${rating_value} / ${rating_scale_type} )`}</span>
        ) : (
          <span className="df-rating-number">{`${rating_value}/${rating_scale_type}`}</span>
        )
      ) : (
        ""
      );

    let iconWrapper = (
      <div className={"df-rating-icon"}>
        {props.enable_rating_number === "on" &&
        props.rating_number_placement_left_right === "left" ? (
          <>
            {ratingNumber}
            {rating_icon}
          </>
        ) : (
          <>
            {rating_icon}
            {ratingNumber}
          </>
        )}
      </div>
    );

    // Rating Title Wrapper
    let titleWrapper =
      props.enable_title === "on" && props.title !== "" ? (
        <div className={"df-rating-title"}>
          {props.dynamic.title.hasValue !== ""
            ? utility._renderDynamicContent(props, "title")
            : ""}
        </div>
      ) : (
        ""
      );

    // Return Rating Icon wrapper
    return (
      <div className="df-rating-wrapper">
        {iconWrapper}
        {titleWrapper}
      </div>
    );
  }
  // Rating Content
  df_render_content() {
    const content =
      this.props.enable_content === "on" && this.props.content() !== "" ? (
        <div className={"df-rating-content"}>
          {this.props.dynamic.content.hasValue !== ""
            ? utility._renderDynamicContent(this.props, "content")
            : ""}
        </div>
      ) : (
        ""
      );

    return content;
  }

  render() {
    return (
      <>
        <div className="df-rating-box-wrapper">
          {this.df_render_rating_wrapper()}
          {this.df_render_content()}
        </div>
      </>
    );
  }
}

export default RatingBox;

// Structure

// <div class="df-rating-box-wrapper">
//     <div class="df-rating-wrapper">
//         <div class="df-rating-icon">
//              <span class="et-pb-icon"></span>
//              <span class="df-rating-number">(2/5)</span>
//         </div>
//         <div class="df-rating-title">asdfsafsa</div>
//         <>
//     </div>
//     <div class="df-rating-content">
//         test
//     </div>
// </div>
