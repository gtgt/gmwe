import 'popper.js';
import 'bootstrap';

(function ($, Drupal, window) {

  'use strict';

  Drupal.behaviors.themeInit = {
    attach: function (context) {
      if (context.nodeName !== '#document') {
        return;
      }
      let $nav = $('nav.navbar.fixed-top', context);
      if ($nav.length) {
        let height = 100; //$nav.outerHeight();
        // Toggle .header-scrolled class to #header when page is scrolled
        $(context).on('scroll', () => {
          if ($(context).scrollTop() > height) {
            $nav.removeClass('nav-transparent');
          } else {
            $nav.addClass('nav-transparent');
          }
        }).triggerHandler('scroll');
      }
    }
  };

})(jQuery, Drupal, window);
