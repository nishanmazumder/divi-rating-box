const difl_faq = document.querySelectorAll(".difl_faq");
[].forEach.call(difl_faq, function(parent) {
  const parent_class = parent.classList.value.split(" ").filter(function(class_name) {
      return class_name.indexOf("difl_faq_") !== -1;
    });
  const mainWrapper = parent.querySelector(".df_faq_wrapper");
  const settings = JSON.parse(mainWrapper.dataset.settings);
  const itemWrapper = parent.querySelectorAll(".difl_faqitem");

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

  df_set_item_open(itemWrapper, settings)
  const faq_layout = "" !== settings.faq_layout ? settings.faq_layout : "";
  const itemSelector = wrapper.querySelectorAll(".df_faq_item");
  if ("plain" === faq_layout) {
    itemSelector.forEach((ele) => {
      ele.classList.add("active");
      if (ele.classList.contains("active")) {
        answer.forEach((el) => {
          el.style.height = "100%";
          df_loop_prvEl_display(el, ".close_image", ".open_image");
          df_loop_prvEl_display(el, ".close_icon", ".open_icon");
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
          this_answer.style.height = isActive ? "100%" : 0;
        }
      }

      if ("accordion" === faq_layout) {
        if ("none" !== settings.faq_animation) {
          answer.forEach((el) => {df_faq_slideup(el, settings);});
          df_faq_slidedown(this_answer, settings);
        } else {
          answer.forEach((el) => {el.style.height = 0;});
          this_answer.style.height = isActive ? "100%" : 0;
        }
      }

      const imgWrapper = _this.querySelector(".faq_question_image");
      const close_img = _this.querySelector(".close_image");
      const open_img = _this.querySelector(".open_image");
      if ("none" !== settings.que_img_animation) {
        df_animation_image(imgWrapper,close_img,open_img,isActive,
          settings.que_img_animation,
          "accordion" === faq_layout ? "accordion" : "", itemWrapper
        );
      } else {
          df_faq_default_display(close_img,open_img,isActive,faq_layout,itemWrapper);
      }

      const iconWrapper = _this.querySelector(".faq_icon");
      const close_icon = _this.querySelector(".close_icon");
      const open_icon = _this.querySelector(".open_icon");
      if ("none" !== settings.icon_animation) {
        df_animation_icon(iconWrapper,close_icon,open_icon,isActive,
          settings.icon_animation,faq_layout,itemWrapper
        );
      } else {
          df_faq_default_display(close_icon,open_icon,isActive,faq_layout,itemWrapper);
      }

      if ("none" !== settings.enable_reveal_animation) {
        df_faq_anime_content(this_answer, settings);
      }
    }); //click
  });
}

function df_loop_prvEl_display(loopEl,eleClose,eleOpen) {
	const elClose = loopEl.previousElementSibling.querySelector(eleClose)
	const elOpen  = loopEl.previousElementSibling.querySelector(eleOpen)

	if(!elClose) return
	loopEl.previousElementSibling.querySelector(eleClose).style.display = "none";
	if(!elOpen) return
	loopEl.previousElementSibling.querySelector(eleOpen).style.display = "block";
}

function df_animation_image(wrapper,close,open,isActive,type,layout = "",itemWrapper) {
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

function df_animation_icon(wrapper,close,open,isActive,type,layout="",itemWrapper) {
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

function df_faq_default_display(close,open,isActive,layout,itemWrapper) {
  if ("accordion" === layout) {
    itemWrapper.forEach((el) => {
      df_loop_static_display(el,".close_image", ".open_image", false);
      df_loop_static_display(el,".close_icon", ".open_icon", false);
      if (el.classList.contains("active")) {
        df_loop_static_display(el,".close_image", ".open_image", true);
        df_loop_static_display(el,".close_icon", ".open_icon", true);
      }
    });
  } else {
    df_static_display(close, open, isActive)
  }
}

function df_loop_static_display(loopEl,eleClose,eleOpen,active=false) {
	const elClose = loopEl.querySelector(eleClose)
	const elopen= loopEl.querySelector(eleOpen)

	if(!elClose) return
	elClose.style.display = active ? "none" : "block";
  	if(!elopen) return
  	elopen.style.display = active ? "block" : "none";
}

function df_static_display(eleClose,eleOpen,active=false) {
  if(!eleClose) return
  eleClose.style.display = active ? "none" : "block";
  if(!eleOpen) return
  eleOpen.style.display = active ? "block" : "none";
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
}

function df_set_item_open(itemWrapper, settings) {
	const activeWrapper = itemWrapper[parseInt(settings.active_item_order_number) - 1]
	if ("plain" !== settings.faq_layout){
		if (!!settings.active_item_order_number && "on" === settings.activate_on_first_time) {
			activeWrapper.classList.add("active");

			// df_faq_slidedown(activeWrapper.querySelector(".faq_answer_wrapper"), settings);
			activeWrapper.querySelector(".faq_answer_wrapper").style.height = "100%"
	  }
  }
  return null;
}

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
  const content = selector.querySelector(".faq_answer");
  const image = selector.querySelector(".faq_answer_image");
  const button = selector.querySelector(".faq_button a");

  const object = {
    targets: [content, image, button],
    easing: "linear",
    duration: settings.content_anime_duration,
    delay: anime.stagger(settings.content_anime_duration),
    endDelay: 1,
  };

  var anime_config = Object.assign(object,animations[settings.content_animation_type]
  );
  if (window.anime) {
    window.anime(anime_config);
  }
}

const animations = {
  slide: {},
  rotate: {
	rotate: "+=1turn",
  },
  scale: {
	scale: [2, 1],
  },
  fade: {
	opacity: [0, 1],
  },
  fade_in: {
	opacity: [0, 1],
  },
  slide_left: {
    opacity: [0 , 1],
    translateX: ["-100px", 0],
  },
  slide_right: {
    opacity: [0 , 1],
    translateX: ["100px" , 0],
  },
  slide_up: {
    opacity: [0 , 1],
    translateY: ["-100px", 0],
  },
  slide_down: {
    opacity: [0 , 1],
    translateY: ["100px", 0],
  },
  zoom_left: {
    opacity: [0 , 1],
    scale: [".5", "1"],
    transformOrigin: ["0% 50%", "0% 50%"],
  },
  zoom_center: {
    opacity: [0 , 1],
    scale: [".5", "1"],
    transformOrigin: ["50% 50%", "50% 50%"],
  },
  zoom_right: {
    opacity: [0 , 1],
    scale: [".5", "1"],
    transformOrigin: ["100% 50%", "100% 50%"],
  },
};
