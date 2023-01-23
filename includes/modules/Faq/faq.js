(function($) {

  // # have to make const

  const difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(ele, index) {

    const parent_class = ele.classList.value.split(" ").filter(function(class_name){
      return class_name.indexOf('difl_faq_') !== -1;
    });

    const ItemContainer = ele.querySelector('.df_faq_item');
    const settings = JSON.parse(ItemContainer.dataset.settings);
    callEventFunction(parent_class[0], settings, index);
    });

  function callEventFunction(parent_class, settings, index){
    const itemSelector = $('.'+ parent_class).find(".df_faq_item");
    const question = $('.'+ parent_class).find(".faq_question_wrapper");
    const faq_layout = '' !== settings.faq_layout ? settings.faq_layout : 'accordion'

    // hide answer wrapper by default
    // $('.faq_answer_wrapper').css("height","0");

    // hide icon & image default
    $('.'+ parent_class).find(".open_image").hide()
    $('.'+ parent_class).find(".open_icon").hide()

    // Active faq item order number
    if ('on' === settings.activate_on_first_time && '' !== settings.active_item_order_number) {
      const active_item_order = ':eq(' + (settings.active_item_order_number - 1) + ')';
      const itemSelected = $('.'+ parent_class).find(".df_faq_item" + active_item_order);
      itemSelected.addClass("active")
  }

    // faq toggle calss add/remove
    'plain' === faq_layout ? itemSelector.toggleClass('active') : "" // plain
    $(question).on("click", function(e) {

      if(('individual' || 'plain') === faq_layout){
          $(this).parent(".df_faq_item").toggleClass("active");
        }else{
          $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");

          if ($(this).parent(".df_faq_item").hasClass("active")) {
              $(this).parent(".df_faq_item").removeClass("active");
              $(this).parent(".df_faq_item").addClass("active");
          }else{
            $(this).parent(".df_faq_item").addClass("active");
          }
        }

      // get child classes
      const child_class = $(this).parent().parent().parent().attr('class').split(" ").filter(function(class_name){
        return class_name.indexOf('difl_faqitem_') !== -1;
      });
      const answer_selector =  '.' + child_class[0] + ' .faq_answer_wrapper';

      // Animation
      // if('on' === settings.enable_faq_animation){
      //   df_faq_anime(answer_selector, settings)
      // }


      // Anime JS
      const get_ans_height = $(this).next();
      if($(this).parent('.df_faq_item').hasClass('active')){
        window.anime(df_faq_anime(answer_selector, get_ans_height[0].clientHeight , active = true))
      }else{
        window.anime(df_faq_anime(answer_selector, get_ans_height[0].clientHeight , active = false))
      }

      // toggle img & icon
      if($(this).parent('.df_faq_item').hasClass('active')){
        $(this).find('.close_image').hide()
        $(this).find('.open_image').show()

        $(this).find('.close_icon').hide()
        $(this).find('.open_icon').show()

      }else{
        $(this).find('.close_image').show()
        $(this).find('.open_image').hide()

        $(this).find('.close_icon').show()
        $(this).find('.open_icon').hide()
      }

    }); // click

  }// callEventFunction

// Anime JS - REVERSE
function df_faq_anime(selector, height, active){


  console.log(height)

  const object = {
    targets: selector,
    easing: "easeInOutQuad",
    duration: 250,
    elasticity: 100,
    direction: 'normal'
  }

  if(active){
    object['height'] = [0, height]
    // object['complete'] = function(){
    //   $(selector).height('auto')
    // }
  }else{
    object['height'] = 0
    // object['complete'] = function(){
    //   $(selector).height(0)
    // }
  }

  return object
}

//   function df_faq_anime(selector, settings) {
//     let object = {
//         targets: selector,
//         easing: "linear",
//         // easing: "easeInOutSine",
//         duration: 500,
//         direction: 'normal',
//         endDelay: 0,
//         delay: 0,
//         autoplay: false,
//         height: {
//           value: '+=100%'
//         },
//         // begin: function () {

//         //   $(selector).css("height","auto");

//         //   // if (document.querySelector(selector)){
//         //   //   if($(selector).parent().hasClass('active')){
//         //   //       $(selector).css("height","auto");
//         //   //     }else{
//         //   //       $(selector).css("height","0");
//         //   //   }
//         //   // }
//         // },

//     };

//     // const anime_config = Object.assign(object, animations[settings.faq_animation]);

//     if (window.anime) {

//       if($(selector).parent().hasClass('active')){
//         window.anime(object).play() // $(selector).css("height","auto");
//       }else{
//         window.anime(object).reverse()
//     }

//       // const animeKey = window.anime(anime_config)

//         // console.log(animeKey)

//       //   if (animeKey.began) {
//       //     console.log('begin')
//       //   }
//     }
// }



// const animations = {
//   slide_down: {
//       opacity: ['1', '1'],
//       translateY: ['-100px', '0']
//   },
//   slide_up: {
//       // opacity: ['0', '1'],
//       translateY: ['100px', '0']
//   },
//   fade_in: {
//       opacity: ['0', '1'],
//   }
// }
})(jQuery);