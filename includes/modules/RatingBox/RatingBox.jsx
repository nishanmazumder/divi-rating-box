import React, { Component } from "react";
import utility from "../../../scripts/df_scripts/utilities";
// Internal Dependencies
import "./style.css";

class RatingBox extends Component {
  static slug = "difl_ratingbox";

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

    // Color
    const active_color =
      typeof props.rating_color_active === "undefined"
        ? ""
        : props.rating_color_inactive;

    const inactive_color =
      typeof props.rating_color_inactive === "undefined"
        ? ""
        : props.rating_color_inactive;

    if (props.enable_custom_icon === "on") {
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
          declaration: `content: attr(data-icon) !important;`,
        },
      ]);

      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon span.df-rating-icon-empty::after`,
          declaration: `display:none !important;`,
        },
      ]);

      if (inactive_color === "" || active_color === "") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
            declaration: `color: #333;`,
          },
        ]);

        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
            declaration: `color: #E02B20 !important;`,
          },
        ]);
      }

      if (inactive_color !== "" || active_color !== "") {
        utility.process_color({
          props: props,
          key: "rating_color_active",
          additionalCss: additionalCss,
          selector:
            "%%order_class%% .df-rating-icon span.df-rating-icon-fill::before, %%order_class%% .df-rating-icon span.et-pb-icon",
          type: "color",
          important: false,
        });

        utility.process_color({
          props: props,
          key: "rating_color_inactive",
          additionalCss: additionalCss,
          selector:
            "%%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
          type: "color",
          important: true,
        });
      }
    } else {
      // Global

      if (inactive_color === "" || active_color === "") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
            declaration: `color: #E02B20;`,
          },
        ]);

        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-icon span.df-rating-icon-fill::before`,
            declaration: `color: #E02B20 !important;`,
          },
        ]);
      }

      utility.process_color({
        props: props,
        key: "rating_color_inactive",
        additionalCss: additionalCss,
        selector:
          "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
        type: "color",
        important: false,
      });

      utility.process_color({
        props: props,
        key: "rating_color_active",
        additionalCss: additionalCss,
        selector:
          "%%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
        type: "color",
        important: true,
      });
    }

    if (
      (props.enable_custom_icon === "on" || "off") &&
      props.enable_single_rating === "on"
    ) {
      utility.process_color({
        props: props,
        key: "rating_color_single",
        additionalCss: additionalCss,
        selector:
          "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before",
        type: "color",
        important: true,
      });
    }

    // Rating Icon (+ before) Size
    utility.process_range_value({
      props: props,
      key: "rating_icon_size",
      additionalCss: additionalCss,
      selector:
        "%%order_class%% .df-rating-icon span.et-pb-icon, %%order_class%% .df-rating-icon span.df-rating-icon-fill::before, %%order_class%% .df-rating-icon span.df-rating-icon-empty::after",
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

    utility.process_margin_padding({
      props: props,
      key: "rating_box_number_margin",
      additionalCss: additionalCss,
      selector: "%%order_class%% .df-rating-number",
      type: "margin",
      important: true,
    });

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

    if (props.enable_custom_icon === "on") {
      utility.process_icon_font_style({
        props: props,
        additionalCss: additionalCss,
        key: "rating_icon",
        selector: `%%order_class%% .df-rating-icon span.et-pb-icon`,
        important: true,
      });
    }

    // Title Placement
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

    // Rating number default
    if (props.enable_rating_number === "on") {
      if (props.rating_number_placement_left_right === "right") {
        additionalCss.push([
          {
            selector: `%%order_class%%  .df-rating-number`,
            declaration: `margin-left: 5px;`,
          },
        ]);
      } else {
        additionalCss.push([
          {
            selector: `%%order_class%%  .df-rating-number`,
            declaration: `margin-right: 5px;`,
          },
        ]);
      }
    }

    if (props.title_display_type === "block") {
      this.df_set_flex_position({
        props: props,
        key: "rating_icon_align",
        additionalCss: additionalCss,
        selector: "%%order_class%% .df-rating-wrapper",
        type: "align-items",
      });

      if (props.title_placement_top_bottom === "top") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: column-reverse;`,
          },
        ]);
      } else {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: column;`,
          },
        ]);
      }

      // inline
    } else {
      this.df_set_flex_position({
        props: props,
        key: "rating_icon_align",
        additionalCss: additionalCss,
        selector: "%%order_class%% .df-rating-wrapper",
        type: "justify-content",
        css: "align-items: center",
      });

      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon`,
          declaration: `display: flex; align-items: center;`,
        },
      ]);

      if (props.title_placement_left_right === "left") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: row-reverse;`,
          },
        ]);
      } else if (props.title_placement_left_right === "right") {
        additionalCss.push([
          {
            selector: `%%order_class%% .df-rating-wrapper`,
            declaration: `flex-direction: row;`,
          },
        ]);
      }
    }

    // (Mobile) Set display type block on mobile
    additionalCss.push([
      {
        selector: `%%order_class%% .df-rating-wrapper`,
        declaration: `flex-direction: column-reverse !important;`,
        device: "phone",
      },
    ]);

    if (props.title_text_align_phone !== "") {
      const title_align_mob = props.title_text_align_phone
        ? props.title_text_align_phone
        : "center";
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-title`,
          declaration: `width: 100%; margin-right:0px; margin-left:0px; text-align: ${title_align_mob};`,
          device: "phone",
        },
      ]);
    }

    if (props.rating_icon_align_phone !== "") {
      const rating_align_mob = props.rating_icon_align_phone
        ? props.rating_icon_align_phone
        : "center";
      additionalCss.push([
        {
          selector: `%%order_class%% .df-rating-icon`,
          declaration: `width: 100%; justify-content: ${rating_align_mob};`,
          device: "phone",
        },
      ]);
    }

    return additionalCss;
  }

  static df_set_flex_position(options = {}) {
    const defaults = {
      props: {},
      key: "",
      additionalCss: "",
      selector: "",
      type: "",
      css: "",
      responsive_d: true,
    };
    const settings = utility.extend(defaults, options);
    const {
      props,
      key,
      additionalCss,
      selector,
      type,
      css,
      responsive_d,
    } = settings;

    const desktop = props[key];
    const tablet =
      props[key + "_tablet"] !== "" ? props[key + "_tablet"] : undefined;
    const phone =
      props[key + "_phone"] !== "" ? props[key + "_phone"] : undefined;

    const get_values = ["center", "left", "right"];
    const set_values = ["center", "start", "end"];
    const values = {};

    for (let i in get_values) {
      values[get_values[i]] = set_values[i];
    }

    if (responsive_d === true) {
      additionalCss.push([
        {
          selector: selector,
          declaration: `display: flex; ${type}:${values[desktop]}; ${css};`,
        },
      ]);
    }

    if (typeof tablet !== "undefined") {
      additionalCss.push([
        {
          selector: selector,
          declaration: `display: flex; ${type}:${values[tablet]};${css};`,
          device: "tablet",
        },
      ]);
    }

    if (typeof phone !== "undefined") {
      additionalCss.push([
        {
          selector: selector,
          declaration: `display: flex; ${type}:${values[phone]};${css};`,
          device: "phone",
        },
      ]);
    }
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

    const icon =
      props.enable_custom_icon === "on"
        ? utils.processFontIcon(dynamicIcon)
        : utils.processFontIcon("&#xe031;||divi||400");

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
          rating_active_class = `df-rating-icon-fill df-rating-icon-empty df-fraction-reverse df-fill-${get_float[1]}`;
        }
      } else {
        rating_active_class = "df-rating-icon-empty";
      }

      // Render rating loop
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

    // Get single rating value
    const rating_value_single =
      parseInt(props.rating_scale_type) === 5
        ? props.rating_value_5
        : props.rating_value_10;

    // Show rating number/text
    const ratingNumber =
      props.enable_rating_number === "on" ? (
        props.enable_single_rating !== "on" ? (
          props.enable_rating_number_bracket === "on" ? (
            <span className="df-rating-number">
              <span className="df-rating-bracket">{"("}</span>
              {`${rating_value} / ${rating_scale_type}`}
              <span className="df-rating-bracket">{")"}</span>
            </span>
          ) : (
            <span className="df-rating-number">{`${rating_value} / ${rating_scale_type}`}</span>
          )
        ) : (
          <span className="df-rating-number">{rating_value_single}</span>
        )
      ) : (
        ""
      );

    // Render icon wrapper
    const iconWrapper = (
      <div className={"df-rating-icon"}>
        {props.rating_number_placement_left_right === "left" ? (
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

  render() {
    return (
      <>
        <div className="df-rating-box-container">
          {this.df_render_rating_wrapper()}
          {this.df_render_content()}
        </div>
      </>
    );
  }
}

export default RatingBox;
