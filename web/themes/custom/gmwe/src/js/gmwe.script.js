import 'popper.js';
import 'bootstrap';

(function ($, Drupal, window) {

  'use strict';

  Drupal.behaviors.themeInit = {
    attach: function (context) {
      if (context.nodeName !== '#document') {
        return;
      }
      let $nav = $('nav.navbar', context);
      if ($nav.length) {
        let height = 140; //$nav.outerHeight();
        // Toggle .header-scrolled class to #header when page is scrolled
        $(context).on('scroll', () => {
          if ($(context).scrollTop() > height) {
            $nav.removeClass('bg-transparent');
          } else {
            $nav.addClass('bg-transparent');
          }
        }).triggerHandler('scroll');
      }
    }
  };

})(jQuery, Drupal, window);
