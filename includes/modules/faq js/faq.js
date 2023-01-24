(function($) {

  // # have to make const

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
    let faq_layout = '' !== settings.faq_layout ? settings.faq_layout : 'accordion'

    // hide answer wrapper by default
    $('.faq_answer_wrapper').css("height","0");

    // hide icon & image default
    $('.'+ parent_class).find(".open_image").hide()
    $('.'+ parent_class).find(".open_icon").hide()

    // Active faq item order number
    if ('on' === settings.activate_on_first_time && '' !== settings.active_item_order_number) {
      let active_item_order = ':eq(' + (settings.active_item_order_number - 1) + ')';
      let itemSelected = $('.'+ parent_class).find(".df_faq_item" + active_item_order);
      itemSelected.addClass("active")
  }

    // faq toggle type
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
      let child_class = $(this).parent().parent().parent().attr('class').split(" ").filter(function(class_name){
        return class_name.indexOf('difl_faqitem_') !== -1;
      });
      let answer_selector =  '.' + child_class[0] + ' .faq_answer_wrapper';

      if('on' === settings.enable_faq_animation){
        df_faq_anime(answer_selector, settings)
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

  function df_faq_anime(selector, settings) {
    var object = {
        targets: selector,
        easing: "linear",
        duration: 500,
        endDelay: 0,
        delay: 0,
        begin: function () {
          if (document.querySelector(selector)){
            if($(selector).parent().hasClass('active')){
                $(selector).css("height","100%");
              }else{
                $(selector).css("height","0");
            }
          }
        },
    };

    var anime_config = Object.assign(object, animations[settings.faq_animation]);
    if (window.anime) {
        window.anime(anime_config);
    }
}

var animations = {
  slide_down: {
      opacity: ['1', '1'],
      translateY: ['-100px', '0']
  },
  slide_up: {
      // opacity: ['0', '1'],
      translateY: ['100px', '0']
  },
  fade_in: {
      opacity: ['0', '1'],
  }
}
})(jQuery);