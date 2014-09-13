/*! MetaMorph - v1.0.0 - 09-09-2014
 * http://themesidea.co.uk/
 * Copyright (c) 2014
 */
(function ($) {
  $.fn.mmsticky = function (e) {
    this.each(function () {
      var b = $(this);
      b.addClass('metamorph-sticky');
      b.data('offset-top', b.data('offset-top') || b.offset().top);
      b.data('max-height', b.outerHeight());
      var c = $('<div>').addClass('sticky-wrapper').height(b.outerHeight());
      b.wrap(c);
      var d = b.parents('.sticky-wrapper');
      setInterval(function () {
        //if($(window).width()<992) return;
        d.height(b.outerHeight())
      }, 50);
      $(window).scroll(function () {
        if($(window).width()<992) return;
        var a = $(window).scrollTop();
        if (a > b.data('offset-top')) {
          b.addClass('fixed');
          setTimeout(function () {
            b.addClass('fixed-transition')
          }, 10)
        } else {
          b.removeClass('fixed');
          setTimeout(function () {
            b.removeClass('fixed-transition')
          }, 10)
        }
      }).resize(function () {
        b.removeClass('fixed fixed-transition').data('offset-top', b.offset().top);
        $(window).scroll()
      }).scroll()
    })
  };
  $(document).ready(function () {
    $('.metamorph-sticky').mmsticky()
  })
}(jQuery));
