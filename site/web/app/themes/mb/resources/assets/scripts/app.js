/**
 * External Dependencies
 */
import 'jquery';
import barba from '@barba/core';
import gsap from 'gsap';
import _ from 'underscore';
import 'most-visible';
import Lottie from 'lottie-web';

// Lottie
function playAnimation() {
  let lottie = document.getElementById('lottie'),
  animation = Lottie.loadAnimation({
    container: lottie,
    name: $(lottie).data('name'),
    path: $(lottie).data('animation-path'),
    autoplay: true,
    loop: false,
  });
}

// Loader
const loadingScreen = document.querySelector('.loading-screen');
const $header = $('header.top');

// Function to add and remove the page transition screen
function pageTransitionIn() {
  return gsap
    .timeline()
    .set(loadingScreen, { transformOrigin: 'bottom left'})
    .to(loadingScreen, { duration: .5, scaleY: 1, transformOrigin: 'bottom left'})
}

// Function to add and remove the page transition screen
function pageTransitionOut(container) {
  return gsap
    .timeline({ delay: 0.5 })
    .add('start') // Use a label to sync screen and content animation
    .to(loadingScreen, {
      duration: 0.5,
      scaleY: 0,
      skewX: 0,
      transformOrigin: 'top left',
      ease: 'power1.out',
    }, 'start')
    .call(contentAnimation, [container], 'start')
}

// Function to animate the content of each page
function contentAnimation(container) {
  return gsap
    .timeline()
    .from($header, { duration: .5, translateY: -100, opacity: 0})
}

// Barba 
barba.init({
  debug: true,
  views: [
    {
      namespace: 'Home',
      beforeEnter() {
        // add transparent effect to header
        $header.addClass('transparent');
      },
      afterEnter() {
        // Transparent header effect on scroll
        $(window).on('scroll', function() {
          let scroll = $(window).scrollTop();
          if(scroll >= (window.innerHeight - 41)) {
            $header.removeClass('transparent');
          }
        });
        playAnimation();
      },
      afterLeave() {
        // Remove transparent header effect for other pages
        $header.removeClass('transparent');
      },
    },
    {
      namespace: 'Services',
      afterEnter() {
        $(window).on('scroll' , _.debounce(() => {
          $('.service-full.visible').removeClass('visible');
          $('.service-full').mostVisible({
            percentage: true,
            offset: 160,
          }).addClass('visible');
        }, 50));
      },
    },
  ],
  transitions: [
    {
      name: 'basic',
      sync: true,
      beforeLeave() {
        pageTransitionIn();
      },
      leave(data) {
        // data.current.container.remove();
      },
      beforeEnter() {

      },
      enter(data) {
        pageTransitionOut(data.next.container);
        $(window).scrollTop(0);
        $('.barba-container').fadeIn();
      },
      after() {
        $('body').attr('class', $('#body-classes').attr('class'));
      },
      once(data) {
        contentAnimation(data.next.container);
        $('footer.content-info').addClass('fade-in');
      },
    },
  ],
  prevent: ({ el }) => el.classList && el.classList.contains('prevent'),
});
