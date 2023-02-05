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
    $('.faq_answer_wrapper').css("display","none");
    $('.faq_answer_wrapper').css("height","0");

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
    'plain' === faq_layout ? itemSelector.addClass('active') : "" // plain
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
      if('on' === settings.enable_faq_animation){
        $(answer_selector).css("display","block");
        $(answer_selector).height('100%')
        const get_ans_wrapper = $(this).next();
        const get_ans_height = get_ans_wrapper[0].clientHeight;

        if($(this).parent('.df_faq_item').hasClass('active')){
          window.anime(df_faq_anime_data(settings, answer_selector, get_ans_height, active=true))
        }else{
          window.anime(df_faq_anime_data(settings ,answer_selector, 0, active=false))
        }
      }

      // toggle img & icon
      if($(this).parent('.df_faq_item').hasClass('active')){
        // image
        $(this).find('.close_image').hide()
        $(this).find('.open_image').show()
        if('on' === settings.enable_que_img_animation){
          $(this).find('.close_image').css({rotate : '-30deg', opacity: '.5'})
          $(this).find('.open_image').css({rotate : '0deg', opacity: '1'})
        }

        // icon
        $(this).find('.close_icon').hide()
        $(this).find('.open_icon').show()
        if('on' === settings.icon_animation){
          $(this).find('.close_icon').css({rotate : '-30deg', opacity: '.5'})
          $(this).find('.open_icon').css({rotate : '0deg', opacity: '1'})
        }
      }else{
        // image
        $(this).find('.close_image').show()
        $(this).find('.open_image').hide()
        if('on' === settings.enable_que_img_animation){
          $(this).find('.close_image').css({rotate : '0deg', opacity: '1'})
          $(this).find('.open_image').css({rotate : '-60deg', opacity: '.5'})
        }

        // icon
        $(this).find('.close_icon').show()
        $(this).find('.open_icon').hide()
        if('on' === settings.icon_animation){
          $(this).find('.close_icon').css({rotate : '0deg', opacity: '1'})
          $(this).find('.open_icon').css({rotate : '-60deg', opacity: '.5'})
        }
      }

    }); // click

  }// callEventFunction

// FAQ Animation data
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