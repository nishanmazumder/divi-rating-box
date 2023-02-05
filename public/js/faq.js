(function($) {

  const difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(parent, index) {

    const parent_class = parent.classList.value.split(" ").filter(function(class_name) {
      return class_name.indexOf("difl_faq_") !== -1;
    });

    // get data settings
    const mainWrapper = parent.querySelector(".df_faq_wrapper");
    const settings = JSON.parse(mainWrapper.dataset.settings); // global settings

    // get child wrapper
    const itemWrapper = parent.querySelectorAll(".difl_faqitem");

    // Active faq item order number
    if ("on" === settings.activate_on_first_time && !!settings.active_item_order_number) {
      itemWrapper[settings.active_item_order_number - 1].classList.add('active')
    }

    // hide item on devices
    itemWrapper.forEach(child => hide_faq_items(child));

    callEventFunction(parent_class[0], settings);

  });

  function callEventFunction(parent_class, settings) {

    // hide icon & image default
    $("." + parent_class).find(".open_image").hide();
    $("." + parent_class).find(".open_icon").hide();

    const itemSelector = $("." + parent_class).find(".df_faq_item");
    const question = $("." + parent_class).find(".faq_question_wrapper");
    const answer = $("." + parent_class).find(".faq_answer_wrapper");
    answer.hide(); // hide answer wrapper by default

    // Get settings
    const faq_layout = "" !== settings.faq_layout ? settings.faq_layout : "accordion";
    const img_duration = 'on' === settings.enable_que_img_animation ? 500 : 0
    const icon_duration = 'on' === settings.enable_icon_animation ? 500 : 0



    // faq toggle calss add/remove
    "plain" === faq_layout ? itemSelector.addClass("active") : ""; // plain

    if (itemSelector.hasClass("active")) {
      itemSelector.find(answer).show();
    }

    $(question).on("click", function(e) {
      const _this_answer = $(this).next()
      if(('individual') === faq_layout){
        $(this).parent(".df_faq_item").toggleClass("active");
        'fade' === settings.faq_animation ?
        _this_answer.fadeToggle(500,'linear') : _this_answer.slideToggle(300)
      }else if(('accordion') === faq_layout){
        if($(this).parent(".df_faq_item").hasClass('active')){return null}

        $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");
        $(this).parent(".df_faq_item:not(.active)").addClass("active");
        $(this).closest('.'+ parent_class).find(".faq_answer_wrapper").slideUp(300);
        'fade' === settings.faq_animation ? _this_answer.fadeIn(500,'linear') : _this_answer.slideDown(300)
      }

      // toggle img & icon animation settings
      const hasActiveClass = $(this).parent('.df_faq_item').hasClass('active')
      const icon_img_wrapper = [$(this), '.close_icon', '.open_icon', icon_duration]
      const close_img_wrapper = [$(this), '.close_image', '.open_image', img_duration]

      if('on' === settings.enable_que_img_animation){
        hasActiveClass ? df_faq_img_icon_anime_reverse(...close_img_wrapper) : df_faq_img_icon_anime(...close_img_wrapper)
      }

      if('on' === settings.enable_icon_animation){
        hasActiveClass ? df_faq_img_icon_anime_reverse(...icon_img_wrapper) : df_faq_img_icon_anime(...icon_img_wrapper)
      }

    }); // click


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
})(jQuery);
