(function($) {
  let difl_faq = document.querySelectorAll(".difl_faq");
  [].forEach.call(difl_faq, function(ele, index) {
    var ele_class = ele.classList.value.split(" ").filter(function(class_name){
      return class_name.indexOf('difl_faq_') !== -1;
  });
  var itemSelector = '.'+ ele_class[0]+ ' .difl_faqitem';
   callEventFunction(itemSelector ,ele_class[0] );
  });
  function callEventFunction(itemSelector , parent_class ){
    let question = $(itemSelector).find(".faq_question_wrapper");
    $(question).on("click", function(e) {
        $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");
        if ($(this).parent(".df_faq_item").hasClass("active")) {
          // active Class
          $(this).closest('.'+ parent_class).find(".df_faq_item").removeClass("active");
          // icon
          $(".icon_open span").text("+");
        } else {
          // Icon
          $(".icon_open span").text("+");
          $(this).find(".icon_open span").text("-");
          // active Class
          $(this).parent(".df_faq_item").addClass("active");
        }
      });
  }
})(jQuery);

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
