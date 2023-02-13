const difl_faq = document.querySelectorAll(".difl_faq");
[].forEach.call(difl_faq, function(parent, index) {
  const parent_class = parent.classList.value
    .split(" ")
    .filter(function(class_name) {
      return class_name.indexOf("difl_faq_") !== -1;
    });
  const mainWrapper = parent.querySelector(".df_faq_wrapper");
  const settings = JSON.parse(mainWrapper.dataset.settings); // global settings
  const itemWrapper = parent.querySelectorAll(".difl_faqitem");
  if (
    !!settings.active_item_order_number &&
    "on" === settings.activate_on_first_time
  ) {
    itemWrapper[settings.active_item_order_number - 1].classList.add("active");
  }
  df_faq_function(parent_class[0], settings);
  itemWrapper.forEach((child) => {
    hide_faq_items(child);
  });
});

function df_faq_function(parent_class, settings) {
  const wrapper = document.querySelector("." + parent_class);
  const itemWrapper = wrapper.querySelectorAll(".df_faq_item");

  wrapper.querySelectorAll(".open_image").forEach((el) => {
    el.style.display = "none";
  });
  wrapper.querySelectorAll(".open_icon").forEach((el) => {
    el.style.display = "none";
  });

  const answer = wrapper.querySelectorAll(".faq_answer_wrapper");
  answer.forEach((el) => {
    el.style.height = 0;
  });
  const faq_layout = "" !== settings.faq_layout ? settings.faq_layout : "";
  const itemSelector = wrapper.querySelectorAll(".df_faq_item");
  if ("plain" === faq_layout) {
    itemSelector.forEach((ele) => {
      ele.classList.add("active");
      if (ele.classList.contains("active")) {
        answer.forEach((el) => {
          el.style.height = "100%";
          el.previousElementSibling.querySelector(
            ".close_image"
          ).style.display = "none";
          el.previousElementSibling.querySelector(".open_image").style.display =
            "block";
          el.previousElementSibling.querySelector(".close_icon").style.display =
            "none";
          el.previousElementSibling.querySelector(".open_icon").style.display =
            "block";
        });
      }
    });
  }

  const question = wrapper.querySelectorAll(".faq_question_wrapper");
  question.forEach((ele) => {
    ele.addEventListener("click", function() {
      const _this = this;
      if ("plain" === faq_layout) return;
      const this_answer = _this.nextElementSibling;
      if ("toggle" === faq_layout) {
        _this.parentElement.classList.toggle("active");
      } else if ("accordion" === faq_layout) {
        if (_this.parentElement.classList.contains("active")) return;
        wrapper.querySelectorAll(".df_faq_item").forEach((ele) => {
          ele.classList.remove("active");
        });
        this_answer.parentElement.classList.add("active");
      }

      const isActive = _this.parentElement.classList.contains("active");
      if ("toggle" === faq_layout) {
        if ("none" !== settings.faq_animation) {
          isActive
            ? df_faq_slidedown(this_answer, settings)
            : df_faq_slideup(this_answer, settings);
        } else {
          df_faq_default_toggle(this_answer, isActive);
        }
      }

      if ("accordion" === faq_layout) {
        if ("none" !== settings.faq_animation) {
          answer.forEach((el) => {
            df_faq_slideup(el, settings);
          });
          df_faq_slidedown(this_answer, settings);
        } else {
          answer.forEach((el) => {
            el.style.height = 0;
          });
          df_faq_default_toggle(this_answer, isActive);
        }
      }

      const imgWrapper = _this.querySelector(".faq_question_image");
      const close_img = _this.querySelector(".close_image");
      const open_img = _this.querySelector(".open_image");
      if ("none" !== settings.que_img_animation) {
        df_animation_image(
          imgWrapper,
          close_img,
          open_img,
          isActive,
          settings.que_img_animation,
          "accordion" === faq_layout ? "accordion" : "",
          itemWrapper
        );
      } else {
        if ("accordion" === faq_layout) {
          df_faq_default_acc_display(
            itemWrapper,
            _this,
            ".close_image",
            ".open_image"
          );
        } else {
          df_faq_default_display(close_img, open_img, isActive);
        }
      }

      const iconWrapper = _this.querySelector(".faq_icon");
      const close_icon = _this.querySelector(".close_icon");
      const open_icon = _this.querySelector(".open_icon");
      if ("none" !== settings.icon_animation) {
        df_animation_icon(
          iconWrapper,
          close_icon,
          open_icon,
          isActive,
          settings.icon_animation,
          "accordion" === faq_layout ? "accordion" : "",
          itemWrapper
        );
      } else {
        if ("accordion" === faq_layout) {
          df_faq_default_acc_display(
            itemWrapper,
            _this,
            ".close_icon",
            ".open_icon"
          );
        } else {
          df_faq_default_display(close_icon, open_icon, isActive);
        }
      }
      if ("none" !== settings.enable_reveal_animation) {
        df_faq_anime_content(this_answer, settings);
      }
    });
  });
}

function df_faq_default_acc_display(itemWrapper, current, close, open) {
  itemWrapper.forEach((el) => {
    const close_els = el.querySelector(close);
    const open_els = el.querySelector(open);
    if (el.classList.contains("active")) {
      current.querySelector(close).style.display = "none";
      current.querySelector(open).style.display = "block";
    } else {
      close_els.style.display = "block";
      open_els.style.display = "none";
    }
  });
}

function df_animation_image(wrapper, close, open, isActive, type, layout = "", itemWrapper) {
  const object = {
    targets: wrapper,
    duration: 250,
    delay: 0,
    easing: "linear",
    update: function() {
      df_faq_default_display(close, open, isActive, layout, itemWrapper);
    },
  };

  const anime_config = Object.assign(object, animations[type]);
  if (window.anime) {
    window.anime(anime_config);
  }
}

function df_animation_icon(wrapper, close, open, isActive, type, layout = "", itemWrapper) {
  const object = {
    targets: wrapper,
    duration: 250,
    delay: 0,
    easing: "linear",
    update: function() {
      df_faq_default_display(close, open, isActive, layout, itemWrapper);
    },
  };

  const anime_config = Object.assign(object, animations[type]);
  if (window.anime) {
    window.anime(anime_config);
  }
}

function df_faq_default_display(close, open, isActive, layout = "", itemWrapper="") {
  if ("accordion" === layout) {
    // const itemWrapper = document.querySelectorAll(".df_faq_item");

    // df_faq_default_acc_display(
    //   itemWrapper,
    //   _this,
    //   ".close_icon",
    //   ".open_icon"
    // );

    // df_faq_default_acc_display(itemWrapper, current, close, open)

    itemWrapper.forEach((el) => {
      el.querySelector(".close_image").style.display = "block";
      el.querySelector(".open_image").style.display = "none";
      el.querySelector(".close_icon").style.display = "block";
      el.querySelector(".open_icon").style.display = "none";

      if (el.classList.contains("active")) {
        el.querySelector(".close_image").style.display = "none";
        el.querySelector(".open_image").style.display = "block";
        el.querySelector(".close_icon").style.display = "none";
        el.querySelector(".open_icon").style.display = "block";
      }
    });
  } else {
    if (isActive) {
      close.style.display = "none";
      open.style.display = "block";
    } else {
      open.style.display = "none";
      close.style.display = "block";
    }
  }
}

function df_faq_default_toggle(wrapper, isActive) {
  if (isActive) {
    wrapper.style.height = "100%";
  } else {
    wrapper.style.height = 0;
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
function df_faq_slidedown(answerWrapper, settings) {
  answerWrapper.style.height = "100%";
  const answerHeight = answerWrapper.clientHeight;
  answerWrapper.style.height = 0;

  const object = {
    targets: answerWrapper,
    easing: "linear",
    duration: settings.faq_anime_duration,
    height: answerHeight,
  };

  if (window.anime) {
    window.anime(Object.assign(object, animations[settings.faq_animation]));
  }
}

function df_faq_slideup(answerWrapper, settings) {
  const object = {
    targets: answerWrapper,
    easing: "linear",
    duration: settings.faq_anime_duration,
    height: 0,
  };

  if (window.anime) {
    window.anime(Object.assign(object, animations[settings.faq_animation]));
  }
}

function df_faq_anime_content(selector, settings) {
  let content = selector.firstElementChild.firstElementChild;
  let image = selector.firstElementChild.lastElementChild;
  let button = selector.lastElementChild;

  const object = {
    targets: [button, image, content],
    direction: "alternate",
    easing: "linear",
    duration: settings.content_anime_duration,
    delay: anime.stagger(settings.content_anime_duration),
    endDelay: 1,
  };

  var anime_config = Object.assign(
    object,
    animations[settings.content_animation_type]
  );
  if (window.anime) {
    window.anime(anime_config);
  }
}

const animations = {
  slide_left: {
    opacity: ["1", "0"],
    translateX: ["0", "-100px"],
  },
  slide_right: {
    opacity: ["1", "0"],
    translateX: ["0", "100px"],
  },
  slide_up: {
    opacity: ["1", "0"],
    translateY: ["0", "-100px"],
  },
  slide_down: {
    opacity: ["1", "0"],
    translateY: ["0", "100px"],
  },
  slide: {},
  fade: {
    opacity: [0, 1],
  },
  fade_in: {
    opacity: [1, 0],
  },
  rotate: {
    rotate: "+=1turn",
  },
  scale: {
    scale: [2, 1],
  },
  zoom_left: {
    opacity: ["1", "0"],
    scale: ["1", ".5"],
    transformOrigin: ["0% 50%", "0% 50%"],
  },
  zoom_center: {
    opacity: ["1", "0"],
    scale: ["1", ".5"],
    transformOrigin: ["50% 50%", "50% 50%"],
  },
  zoom_right: {
    opacity: ["1", "0"],
    scale: ["1", ".5"],
    transformOrigin: ["100% 50%", "100% 50%"],
  },
};
