/**
 * External Dependencies
 */
import 'jquery';
import barba from '@barba/core';
import gsap from 'gsap';

// Barba 
barba.init({
  debug: true,
  prevent: ({ el }) => el.classList && el.classList.contains('prevent'),
  views: [{
    namespace: 'basic',
    beforeEnter() {
      // update the menu based on user navigation
      console.log('Basic: Before enter');
    },
    afterEnter() {
      // refresh the parallax based on new page content
      console.log('Basic: After enter');
    },
  }],
  transitions: [
    {
      name: 'basic',
      leave(data) {
        return gsap.to(data.current.container, {
          opacity: 0
        });
      },
      enter(data) {
        $(window).scrollTop(0);
        return gsap.from(data.next.container, {
          opacity: 0,
          onComplete: () => {
            this.async();
            $('body').attr('class', $('#body-classes').attr('class'));
          },
        });
      },
    },
  ],
});
