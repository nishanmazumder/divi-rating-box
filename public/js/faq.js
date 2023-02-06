(function($) {

  const difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(parent, index) {

    // get parent unique class
    const parent_class = parent.classList.value.split(" ").filter(function(class_name) {
      return class_name.indexOf("difl_faq_") !== -1;
    });

    // const parent_wrapper =

    // get data settings
    const mainWrapper = parent.querySelector(".df_faq_wrapper");
    const settings = JSON.parse(mainWrapper.dataset.settings); // global settings

    // get child wrapper
    const itemWrapper = parent.querySelectorAll(".difl_faqitem");

    // 2 Active faq item order number
    if ("on" === settings.activate_on_first_time && !!settings.active_item_order_number) {
      itemWrapper[settings.active_item_order_number - 1].classList.add('active')
    }

    // call function
    callEventFunction(parent_class[0], settings);

    // 1 hide item on devices
    itemWrapper.forEach((child) => {
      hide_faq_items(child)
    });

  });

  function callEventFunction(parent_class, settings) {

    const wrapper = document.querySelector('.'+ parent_class)

    const que_img_open = wrapper.querySelectorAll(".open_image")
    const que_icon_open = wrapper.querySelectorAll(".open_icon")

    que_img_open.forEach(el=>{ el.style.display = "none";})
    que_icon_open.forEach(el=>{ el.style.display = "none"; })

    const itemSelector = wrapper.querySelectorAll(".df_faq_item");
    const question = wrapper.querySelectorAll(".faq_question_wrapper")

    const answer = wrapper.querySelectorAll(".faq_answer_wrapper");
    answer.forEach(el=>{ el.style.height = 0; })

    // Get settings
    const faq_layout = "" !== settings.faq_layout ? settings.faq_layout : "accordion";
    const img_duration = 'on' === settings.enable_que_img_animation ? 500 : 0
    const icon_duration = 'on' === settings.enable_icon_animation ? 500 : 0



    // faq toggle calss add/remove
    if("plain" === faq_layout){
      itemSelector.forEach(ele => {
        ele.classList.add("active")
        if(ele.classList.contains("active")){
          answer.forEach(el=>{ el.style.height = "100%"; })
        }
      })
    }

    question.forEach(ele => {
      ele.addEventListener("click", function(){
        const this_answer = this.nextElementSibling
        if(('individual') === faq_layout){
          this.parentElement.classList.toggle("active")
        }else if(('accordion') === faq_layout){
          if(this.parentElement.classList.contains('active')){return null}
          wrapper.querySelectorAll(".df_faq_item").forEach(ele => {
            ele.classList.remove("active")
          })
          this_answer.parentElement.classList.add("active")
        }

        // individual
        if(('individual') === faq_layout){
          if('on' === settings.enable_faq_animation){
            if(this.parentElement.classList.contains('active')){
              'fade' === settings.faq_animation ?
              this_answer.fadeToggle(500,'linear') : df_faq_slidedown(this_answer)
            }else{
              'fade' === settings.faq_animation ?
              this_answer.fadeToggle(500,'linear') : df_faq_slideup(this_answer)
            }
          }
        }

        // accordion
        if(('accordion') === faq_layout){
          if('on' === settings.enable_faq_animation){
            answer.forEach(el => { df_faq_slideup(el) }); // slideup global

            if('fade' === settings.faq_animation){
              this_answer.fadeIn(500,'linear')
            }else{
              df_faq_slidedown(this_answer)
            }
          }
        }

        // console.log(this.nextElementSibling.clientHeight)

        itemSelector.forEach(ele => {
          const que_img_close  = ele.querySelector('.close_image')
          const que_img_open   = ele.querySelector('.open_image')
          const que_icon_close = ele.querySelector('.close_icon')
          const que_icon_open  = ele.querySelector('.open_icon')


          if('on' === settings.enable_que_img_animation){

          }
            if(ele.classList.contains("active")){

              // que_img_close.style.transition = "all 0.5s linear"
              // que_img_close.style.transform= "rotate(180deg)"
              // que_img_close.style.display = "none"

              // que_img_open.style.transition = "all 0.5s linear"
              // que_img_open.style.transform= "rotate(0deg)"
              // que_img_open.style.display = "block"
            }else{
              // que_img_close.style.cssText = "rotate : 0deg"
              // que_img_close.style.display = "block"


              // que_img_open.style.cssText = "rotate : 180deg"
              // que_img_open.style.display = "none"
            }

        })


        // toggle img & icon animation settings
        // const hasActiveClass = $(this).parent('.df_faq_item').hasClass('active')
        // const icon_img_wrapper = [$(this), '.close_icon', '.open_icon', icon_duration]
        // const close_img_wrapper = [$(this), '.close_image', '.open_image', img_duration]

        // if('on' === settings.enable_que_img_animation){
        //   hasActiveClass ? df_faq_img_icon_anime_reverse(...close_img_wrapper) : df_faq_img_icon_anime(...close_img_wrapper)
        // }

        // if('on' === settings.enable_icon_animation){
        //   hasActiveClass ? df_faq_img_icon_anime_reverse(...icon_img_wrapper) : df_faq_img_icon_anime(...icon_img_wrapper)
        // }

      }) // click


    });



    function df_faq_img_icon_anime (question, close, open, duration){

      const static_position = [{rotate : '0deg', opacity: '1'}, duration, function(){$(this).show()}]
      const anime_position = [{rotate : '180deg', opacity: '0'}, duration, function(){$(this).hide()}]

      question.find(close).animate(...static_position)
      question.find(open).animate(...anime_position)
    }

    function df_faq_img_icon_anime_reverse (question, close, open, duration){

      const static_position = [{rotate : '0deg', opacity: '1'}, duration, function(){$(this).show()}]
      const anime_position = [{rotate : '-180deg', opacity: '0'}, duration, function(){$(this).hide()}]

      question.find(close).animate(...anime_position)
      question.find(open).animate(...static_position)
    }



  } // callEventFunction


  // Hide FAQ items
  function hide_faq_items(child_class){
    const itemInner = child_class.querySelector('.df_faq_item')
    const settings = JSON.parse(itemInner.dataset.settings); // child settings

    if(!!settings){
      if('on' === settings.disable_faq_item.desktop){
        child_class.classList.add("df_hide_desktop")
      }

      if('on' === settings.disable_faq_item.tablet){
        child_class.classList.add("df_hide_tablet")
      }

      if('on' === settings.disable_faq_item.mobile){
        child_class.classList.add("df_hide_mobile")
      }
    }

    return null
  } // hide_faq_items

  // FAQ Animation data

  function df_faq_slidedown(answerWrapper){

    answerWrapper.style.height = "100%";
    const answerHeight = answerWrapper.clientHeight
    answerWrapper.style.height = 0;

   window.anime({
      targets: answerWrapper,
      easing: "easeInOutQuad",
      duration: 250,
      endDelay: 0,
      delay: 0,
      height: answerHeight,
      // begin : function(){
      //   console.log(this)
      // }
    });
  }

  function df_faq_slideup(answerWrapper){
   window.anime({
      targets: answerWrapper,
      easing: "easeInOutQuad",
      duration: 250,
      endDelay: 0,
      delay: 0,
      height: 0
    });
  }

function df_faq_default_toggle(answerWrapper, reverse=false){
  if(!reverse){
    answerWrapper.style.display = 'block';
    answerWrapper.style.height = '100%';
  }else{
    answerWrapper.style.display = 'none';
    answerWrapper.style.height = 0;
  }
}

// function check_active_class(this_wrapper){

//   if(this_wrapper.parentElement.classList.contains('active')){
//     console.log("true")
//   }else{
//     console.log("false")
//   }
// }

function df_faq_anime_data(settings, selector, height, active){

  const object = {
    targets   : selector,
    // easing    : "easeInOutQuad",
    easing    : "linear",
    duration  : 250,
    elasticity: 100,
    direction : 'normal',
    height    : height > 0 ? [0, height] : 0
  }

  Object.assign(object, active ? animations[settings.faq_animation] : animations_reverse[settings.faq_animation]);

  return object
}

const animations = {
  slide: {
      translateY: ['-20px', '0']
  },
  fade: {
      opacity: ['0', '1'],
      translateY: ['-20px', '0']
  }
}

const animations_reverse = {
  slide: {
      translateY: -20,
  },
  fade: {
      opacity: ['0', '1'],
      translateY: -20
  }
}


})(jQuery);
