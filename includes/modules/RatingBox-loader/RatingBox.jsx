import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class RatingBox extends Component {
  static slug = "difl_ratingbox";

  constructor(props) {
    super(props);
    this.state = {
      loading: false,
    };
    this.computed = ['rating_value_5'];
  }
  componentDidUpdate(prevProps, prevState) {
    const _this = this;


    for (const index of _this.computed) {
        if (prevProps[index] !== _this.props[index]) {
            if(_this.computed.includes(index)){


              this.setState({loading: true});
              setTimeout(() =>{
                this.setState({loading: false});
                }, 500)

            }
        }
    }


}
  static css(props) {
    var additionalCss = [];

    utility.df_process_bg({
      props: props,
      key: "rating_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-icon",
    });

    utility.df_process_bg({
      props: props,
      key: "rating_title_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-title",
    });

    utility.df_process_bg({
      props: props,
      key: "rating_content_bg",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-content",
    });

    // Rating color
    const rating_color_active =
      typeof props.rating_color_active === "undefined"
        ? "#333"
        : props.rating_color_active;

    // console.log(rating_color_active)

    if (props.enable_custom_icon === "on") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
          declaration: `content: attr(data-icon); color: ${props.rating_color};`,
        },
        {
          selector: `%%order_class%% .df-rating-icon span.et-pb-icon`,
          declaration: `content: attr(data-icon); color: ${rating_color_active} !important;`,
        },
      ]);
    }

    // for single color
    // if (
    //   props.enable_custom_icon !== "on" ||
    //   props.enable_single_rating === "on"
    // ) {
    //   utility.process_color({
    //     props: props,
    //     key: "rating_color",
    //     additionalCss: additionalCss,
    //     selector:
    //       "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
    //     type: "color",
    //     important: false,
    //   });
    // } else {
    //   utility.process_color({
    //     props: props,
    //     key: "rating_color",
    //     additionalCss: additionalCss,
    //     selector: "%%order_class%% .df-rating-icon span.et-pb-icon",
    //     type: "color",
    //     important: false,
    //   });

    //   // Rating active color
    //   utility.process_color({
    //     props: props,
    //     key: "rating_color_active",
    //     additionalCss: additionalCss,
    //     selector: "%%order_class%% span.df-rating-icon-fill::before",
    //     type: "color",
    //     important: true,
    //   });
    // }

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
      selector:
        "%%order_class%% .df-rating-icon span.et-pb-icon:not(:first-child)",
      type: "margin-left",
      unit: "px",
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

     if (props.enable_custom_icon == "on") {
    utility.process_icon_font_style({
      props: props,
      additionalCss: additionalCss,
      key: "rating_icon",
      selector: `%%order_class%% .df-rating-icon span.et-pb-icon`,
      important: true,
    });
     }

    // Title
    if (props.title_display_type === "inline") {
      if (props.title_placement_left_right === "right") {
        additionalCss.push([
          {
            selector: `%%order_class%%  .df-rating-title`,
            declaration: `margin-left: 10px;`,
          },
        ]);
      } else {
        additionalCss.push([
          {
            selector: `%%order_class%%  .df-rating-title`,
            declaration: `margin-right: 10px;`,
          },
        ]);
      }
    } else {
      additionalCss.push([
        {
          selector: `%%order_class%%  .df-rating-title`,
          declaration: `display: block; width: 100%;`,
        },
      ]);
    }

    if (props.enable_rating_number === "on") {
      if (props.rating_number_placement_left_right === "right") {
        additionalCss.push([
          {
            selector: `%%order_class%%  .df-rating-title`,
            declaration: `margin-left: 0px; margin-right: 0px;`,
          },
        ]);

        if (props.title_placement_left_right === "left") {
          additionalCss.push([
            {
              selector: `%%order_class%%  .df-rating-title`,
              declaration: `margin-right: 10px;`,
            },
          ]);
        }
      }
    }

    // Global Alignment
    // const rating_box_justify =
    //   props.rating_box_align === "right"
    //     ? "end"
    //     : props.rating_box_align === "left"
    //     ? "start"
    //     : props.rating_box_align === "center"
    //     ? "center"
    //     : "";

    const rating_box_float =
      props.rating_box_align === "center" ? "none" : props.rating_box_align;

    // rating box alignment
    if (props.rating_box_align === "center") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-box-container`,
          declaration: `display: table; width:100%; margin: 0px auto;`,
        },
      ]);
    } else {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-box-container`,
          declaration: `display: table; float: ${rating_box_float};`,
        },
      ]);
    }

    this.df_process_flex_mobile({
      props: props,
      key: "rating_box_align",
      additionalCss: additionalCss,
      selector: `%%order_class%% .df-rating-box-container`,
      type: "float",
    });

    // additionalCss.push([
    //   {
    //     selector: `%%order_class%% .df-rating-wrapper`,
    //     declaration: `display: flex; align-items: center; justify-content: ${rating_justify_content};`,
    //   },
    // ]);

    // rating alignment
    additionalCss.push([
      {
        selector: `%%order_class%% .df-rating-icon`,
        declaration: `display: block; text-align: ${props.rating_icon_align};`,
      },
    ]);

    // this.df_process_flex_mobile({
    //   props: props,
    //   key: "rating_icon_align",
    //   additionalCss: additionalCss,
    //   selector: `%%order_class%% .df-rating-icon`,
    //   type: "text-align",
    // });

    // Title Placement
    const rating_icon_justify =
      props.rating_icon_align === "right"
        ? "end"
        : props.rating_icon_align === "left"
        ? "start"
        : props.rating_icon_align === "center"
        ? "center"
        : "";

    // const rating_icon__float =
    //   props.rating_icon_align === "center" ? "none" : props.rating_box_align;

    if (props.title_display_type === "block") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-wrapper`,
          declaration: `display: flex; align-items: ${rating_icon_justify};`,
        },
      ]);

      if (props.title_placement_top_bottom === "top") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: column-reverse;`,
          },
          {
            selector: `%%order_class%% .df-rating-content`,
            declaration: `clear: both;`,
          },
        ]);
      } else {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: column;`,
          },
          {
            selector: `%%order_class%% .df-rating-content`,
            declaration: `clear: both;`,
          },
        ]);
      }

      // inline
    } else {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-wrapper`,
          declaration: `display: flex; align-items: center; justify-content: ${rating_icon_justify};`,
        },
      ]);

      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-title`,
          declaration: `margin-left: 10px;`,
        },
      ]);

      if (props.title_placement_left_right === "left") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: row-reverse;`,
          },
        ]);

        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-title`,
            declaration: `margin-left: 10px;`,
          },
        ]);
      } else if (props.title_placement_left_right === "right") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: row;`,
          },
          {
            selector: `%%order_class%% .df-rating-title`,
            declaration: `margin-left: 10px;`,
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
    const rating_scale_type =
      props.enable_single_rating === "off"
        ? props.rating_scale_type !== ""
          ? parseInt(props.rating_scale_type)
          : 5
        : 1;

    // Rating value
    // const rating_value =
    //   rating_scale_type === 5 ? props.rating_value_5 : props.rating_value_10;

    const rating_value =
      rating_scale_type === 5
        ? props.rating_value_5 <= 5 && props.rating_value_5 >= 0
          ? props.rating_value_5
          : 5
        : props.rating_value_10 <= 10 && props.rating_value_10 >= 0
        ? props.rating_value_10
        : 10;

    // Get only Icon
    const dynamicIcon = utility.df_collect_dynamic_content(
      "rating_icon",
      this.props
    );

    // const icon =
    //   props.enable_custom_icon === "on"
    //     ? utils.processFontIcon(dynamicIcon)
    //     : utils.processFontIcon(
    //         dynamicIcon !== "" ? dynamicIcon : "&#xe031;||divi||400"
    //       );

    const icon =
      props.enable_custom_icon === "on"
        ? utils.processFontIcon(dynamicIcon)
        : utils.processFontIcon("&#xe031;||divi||400");

    console.log(icon);

    // Set Rating Icon
    const rating_icon = [];
    let rating_active_class = "";
    const get_float =
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
    console.log(rating_icon);

    // Show rating number/text
    const ratingNumber =
      props.enable_rating_number === "on" ? (
        props.enable_rating_number_bracket === "on" ? (
          <span className="df-rating-number">{`( ${rating_value} / ${rating_scale_type} )`}</span>
        ) : (
          <span className="df-rating-number">{`${rating_value}/${rating_scale_type}`}</span>
        )
      ) : (
        ""
      );

    const iconWrapper = (
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
    const HeadingTag =
      props.rating_title_tag !== "" ? props.rating_title_tag : "h4";
    const titleWrapper =
      props.enable_title === "on" && props.title !== "" ? (
        <HeadingTag className="df-rating-title">
          {props.dynamic.title.hasValue !== ""
            ? utility._renderDynamicContent(props, "title")
            : ""}
        </HeadingTag>
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

  /* Custom functions for icon list module */
  static df_process_flex_mobile(options = {}) {
    const defaults = {
      props: {},
      key: "",
      additionalCss: "",
      selector: "",
      type: "",
    };
    const settings = utility.extend(defaults, options);
    const { props, key, additionalCss, selector, type } = settings;

    if (props[type] === "justify-content") {
      if (props[key] === "left") {
        props[key] = "start";
      } else if (props[key] === "right") {
        props[key] = "end";
      } else {
        props[key] = "center";
      }
    } else if (props[type] === "float") {
      if (props[key] === "center") {
        props[key] = "none";
      } else {
        props[key] = props[key];
      }
    }

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
        declaration: `${type}:${tablet};`,
        device: "tablet",
      },
    ]);
    additionalCss.push([
      {
        selector: selector,
        declaration: `${type}:${phone};`,
        device: "phone",
      },
    ]);
  }

  render() {
    return (
      <>
        {this.state.loading === false ? (
          <div className="df-rating-box-container">
            {this.df_render_rating_wrapper()}
            {this.df_render_content()}
          </div>
        ) : (
          <div className="et-fb-preloader et-fb-preloader__loading">
            <div className="et-fb-loader" />
          </div>
        )}
      </>
    );
  }
}

export default RatingBox;

// Structure

// <div class="df-rating-box-container">
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