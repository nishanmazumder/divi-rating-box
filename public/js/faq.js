(function($) {
  const difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(parent, index) {
    // get parent unique class
    const parent_class = parent.classList.value
      .split(" ")
      .filter(function(class_name) {
        return class_name.indexOf("difl_faq_") !== -1;
      });

    // get data settings
    const mainWrapper = parent.querySelector(".df_faq_wrapper");
    const settings = JSON.parse(mainWrapper.dataset.settings); // global settings

    // get child wrapper
    const itemWrapper = parent.querySelectorAll(".difl_faqitem");

    // 2 Active faq item order number
    // prettier-ignore
    if (!!settings.active_item_order_number && "on" === settings.activate_on_first_time) {
      itemWrapper[settings.active_item_order_number - 1].classList.add( "active");
    }
    // prettier-ignore

    // faq trigger
    df_faq_function(parent_class[0], settings);

    // hide item on devices
    itemWrapper.forEach((child) => {
      hide_faq_items(child);
    });
  });

  function df_faq_function(parent_class, settings) {
    const wrapper = document.querySelector("." + parent_class);
    const que_img_open = wrapper.querySelectorAll(".open_image");
    const que_icon_open = wrapper.querySelectorAll(".open_icon");

    que_img_open.forEach((el) => {
      el.style.display = "none";
    });
    que_icon_open.forEach((el) => {
      el.style.display = "none";
    });

    const answer = wrapper.querySelectorAll(".faq_answer_wrapper");
    answer.forEach((el) => {
      el.style.height = 0;
    });

    // Get settings
    // prettier-ignore
    const faq_layout = "" !== settings.faq_layout ? settings.faq_layout : "accordion";

    // faq toggle calss add/remove
    const itemSelector = wrapper.querySelectorAll(".df_faq_item");
    if ("plain" === faq_layout) {
      itemSelector.forEach((ele) => {
        ele.classList.add("active");
        if (ele.classList.contains("active")) {
          answer.forEach((el) => {
            el.style.height = "100%";
          });
        }
      });
    }

    const question = wrapper.querySelectorAll(".faq_question_wrapper");
    question.forEach((ele) => {
      ele.addEventListener("click", function() {
        const this_answer = this.nextElementSibling;
        if ("individual" === faq_layout) {
          this.parentElement.classList.toggle("active");
        } else if ("accordion" === faq_layout) {
          if (this.parentElement.classList.contains("active")) {
            return null;
          }
          wrapper.querySelectorAll(".df_faq_item").forEach((ele) => {
            ele.classList.remove("active");
          });
          this_answer.parentElement.classList.add("active");
        }

        // individual
        if ("individual" === faq_layout) {
          if ("on" === settings.enable_faq_animation) {
            if (this.parentElement.classList.contains("active")) {
              "fade" === settings.faq_animation
                ? this_answer.fadeToggle(500, "linear")
                : df_faq_slidedown(this_answer);
            } else {
              "fade" === settings.faq_animation
                ? this_answer.fadeToggle(500, "linear")
                : df_faq_slideup(this_answer);
            }
          }
        }

        // accordion
        if ("accordion" === faq_layout) {
          if ("on" === settings.enable_faq_animation) {
            answer.forEach((el) => {
              df_faq_slideup(el);
            }); // slideup global

            if ("fade" === settings.faq_animation) {
              this_answer.fadeIn(500, "linear");
            } else {
              df_faq_slidedown(this_answer);
            }
          }
        }

        // img animation
        const isActive = this.parentElement.classList.contains("active");
        const imgWrapper = this.querySelector(".faq_question_image");
        const close_img = this.querySelector(".close_image");
        const open_img = this.querySelector(".open_image");
        if ("on" === settings.enable_que_img_animation) {
          df_anime_rotate_ele(imgWrapper, close_img, open_img, isActive);
        } else {
          df_faq_default_display(close_img, open_img, isActive);
        }

        // icon animation
        const iconWrapper = this.querySelector(".faq_icon");
        const close_icon = this.querySelector(".close_icon");
        const open_icon = this.querySelector(".open_icon");
        if ("on" === settings.enable_icon_animation) {
          df_anime_rotate_ele(iconWrapper, close_icon, open_icon, isActive);
        } else {
          df_faq_default_display(close_icon, open_icon, isActive);
        }
      }); // click
    });

    function df_anime_rotate_ele(wrapper, close, open, isActive) {
      const rotate = window.anime({
        targets: wrapper,
        rotate: {
          value: "+=1turn",
          duration: 250,
          easing: "linear",
        },
        scale: [2, 1],
        opacity: [0, 1],
        duration: 250,
        delay: 0,
        easing: "linear",
      });

      rotate.play();
      rotate.update = function() {
        df_faq_default_display(close, open, isActive);
      };

      // rotate.complete = function () {
      //   rotate.reverse();
      // }
    }
  }

  function df_faq_default_display(close, open, isActive) {
    if (isActive) {
      close.style.display = "none";
      open.style.display = "block";
    } else {
      open.style.display = "none";
      close.style.display = "block";
    }
  }

  // Hide FAQ items
  function hide_faq_items(child_class) {
    const itemInner = child_class.querySelector(".df_faq_item");
    const settings = JSON.parse(itemInner.dataset.settings); // child settings

    if (!!settings) {
      if ("on" === settings.disable_faq_item.desktop) {
        child_class.classList.add("df_hide_desktop");
      }
      if ("on" === settings.disable_faq_item.tablet) {
        child_class.classList.add("df_hide_tablet");
      }
      if ("on" === settings.disable_faq_item.mobile) {
        child_class.classList.add("df_hide_mobile");
      }
    }

    return null;
  } // hide_faq_items

  // FAQ Animation data
  function df_faq_slidedown(answerWrapper) {
    answerWrapper.style.height = "100%";
    const answerHeight = answerWrapper.clientHeight;
    answerWrapper.style.height = 0;

    window.anime({
      targets: answerWrapper,
      easing: "easeInOutQuad",
      duration: 250,
      endDelay: 0,
      delay: 0,
      height: answerHeight,
    });
  }

  function df_faq_slideup(answerWrapper) {
    window.anime({
      targets: answerWrapper,
      easing: "easeInOutQuad",
      duration: 250,
      endDelay: 0,
      delay: 0,
      height: 0,
    });
  }

  function df_faq_anime_data(settings, selector, height, active) {
    const object = {
      targets: selector,
      // easing    : "easeInOutQuad",
      easing: "linear",
      duration: 250,
      elasticity: 100,
      direction: "normal",
      height: height > 0 ? [0, height] : 0,
    };

    Object.assign(
      object,
      active
        ? animations[settings.faq_animation]
        : animations_reverse[settings.faq_animation]
    );

    return object;
  }

  const animations = {
    slide: {
      translateY: ["-20px", "0"],
    },
    fade: {
      opacity: ["0", "1"],
      translateY: ["-20px", "0"],
    },
  };

  const animations_reverse = {
    slide: {
      translateY: -20,
    },
    fade: {
      opacity: ["0", "1"],
      translateY: -20,
    },
  };
})(jQuery);
