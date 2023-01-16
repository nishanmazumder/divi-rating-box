(function($) {
  let difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(ele, index) {

    let parent_class = ele.classList.value.split(" ").filter(function(class_name){
      return class_name.indexOf('difl_faq_') !== -1;
    });

    let container = ele.querySelector('.df_faq_item');
    let settings = JSON.parse(container.dataset.settings);

    callEventFunction(parent_class[0], settings);
    });


  function callEventFunction(parent_class, settings){
    let itemSelector = $('.'+ parent_class).find(".df_faq_item");
    let question = $('.'+ parent_class).find(".faq_question_wrapper");
    // let answer = $('.'+ parent_class).find(".faq_answer_wrapper");
    let faq_layout = '' !== settings.faq_layout ? settings.faq_layout : 'accordion'

    // Active faq item order number
    if ('on' === settings.activate_on_first_time && '' !== settings.active_item_order_number) {
      let active_item_order = ':eq(' + (settings.active_item_order_number - 1) + ')';
      let itemSelected = $('.'+ parent_class).find(".df_faq_item" + active_item_order);
      itemSelected.addClass("active")
  }

  if('on' === settings.enable_faq_animation){
    df_faq_anime('active' + answer, settings)
  }

  // console.log(settings.faq_animation)


    // faq toggle type
    'plain' === faq_layout ? itemSelector.toggleClass('active') : "" // plain
    $(question).on("click", function() {
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
      });
  }

  function df_faq_anime(selector, settings) {
    var object = {
        targets: selector,
        easing: "linear",
        duration: 1000,
        endDelay: 1,
        delay: 200,
        begin: function (anim) {
            if (document.querySelector(selector))
                document.querySelector(selector).style.display = 'block';
        },
    };

    var anime_config = Object.assign(object, animations[settings.faq_animation]);

    if (window.anime) {
        window.anime(anime_config);
    }
}

var animations = {
  slide_down: {
      opacity: ['0', '1'],
      translateY: ['-100px', '0']
  },
  slide_up: {
      opacity: ['0', '1'],
      translateY: ['100px', '0']
  },
  fade_in: {
      opacity: ['0', '1'],
  }
}
})(jQuery);

        // if ($(this).parent(".df_faq_item").hasClass("active")) {

        //   if('individual' === faq_layout){
        //     $(this).parent(".df_faq_item").addClass("active");
        //   }

        //   $(".icon_open span").text("+");
        // } else {

        //   $(".icon_open span").text("+");
        //   $(this).find(".icon_open span").text("-");
        // }


// (function($) {
//   let difl_faq = document.querySelectorAll(".difl_faq");
//   [].forEach.call(difl_faq, function(ele, index) {

//     var ele_class = ele.classList.value.split(" ").filter(function(class_name){
//       return class_name.indexOf('difl_faq_') !== -1;
//     });

//     var itemSelector = '.'+ ele_class[0]+ ' .difl_faqitem';

//     var container = ele.querySelector('.df_faq_item');
//     var settings = JSON.parse(container.dataset.settings);

//     callEventFunction(itemSelector ,ele_class[0], );

//     console.log(settings)

//     });

// From admin

//   function callEventFunction(itemSelector , parent_class ){
//     let question = $(itemSelector).find(".faq_question_wrapper");

//     // faq toggle
//     $(question).on("click", function(e) {
//         $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");
//         if ($(this).parent(".df_faq_item").hasClass("active")) {
//           $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");
//           $(".icon_open span").text("+");
//         } else {
//           $(".icon_open span").text("+");
//           $(this).find(".icon_open span").text("-");
//           $(this).parent(".df_faq_item").addClass("active");
//         }
//       });

//   }

// })(jQuery);

// Slide Up
//   question.on("click", function(e) {
  //     if ($(this).parent().hasClass("active")) {
  //       // Active Class
  //       $(this).parent().removeClass("active");
  //       // Slide
  //       $(this).siblings(".faq_answer_wrapper").slideUp(500);
  //       // Icon
  //       $(".icon_open span").text("+");
  //     } else {
  //       // Icon
  //       $(".icon_open span").text("+");
  //       $(this).find(".icon_open span").text("-");
  //       // Active Class
  //       $(this).parent(".df_faq_item").prevAll(".df_faq_item").removeClass("active");
  //       $(this).parent(".df_faq_item").nextAll(".df_faq_item").removeClass("active");
  //       $(this).parent(".df_faq_item").addClass("active");
  //       // Slide
  //       $(".faq_answer_wrapper").slideUp(500);
  //       $(this).siblings(".faq_answer_wrapper").slideDown(500);
  //     }
  //   });
