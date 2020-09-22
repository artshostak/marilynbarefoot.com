/**
 * External Dependencies
 */
import 'jquery';
import barba from '@barba/core';
import gsap from 'gsap';
import OnScreen from 'onscreen';
import Lottie from 'lottie-web';

// Lottie
function playAnimation() {
  let lottie = document.getElementById('lottie'),
  animation = Lottie.loadAnimation({
    container: lottie,
    name: $(lottie).data('name'),
    path: $(lottie).data('animation-path'),
    // renderer: 'svg',
    autoplay: true,
    loop: false,
  });
}

// OnScreen
let os = new OnScreen({
  tolerance: 400,
});

// Loader
const loadingScreen = document.querySelector('.loading-screen'),
  mainNavigation = document.querySelector('header.top');

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
    .from(mainNavigation, { duration: .5, translateY: -100, opacity: 0})
}

// Barba 
barba.init({
  debug: true,
  views: [
    {
      namespace: 'Home',
      beforeEnter() {
        // Bodymovin
      },
      afterEnter() {
        console.log('fire animation');
        playAnimation();
      },
    },
  ],
  transitions: [
    {
      name: 'basic',
      sync: true,
      beforeLeave() {
        $('.barba-container').fadeOut();
        pageTransitionIn();
      },
      leave(data) {
        // data.current.container.remove();
      },
      enter(data) {
        pageTransitionOut(data.next.container);
        $(window).scrollTop(0);
        $('.barba-container').fadeIn();
        // return gsap.from(data.next.container, {
        //   opacity: 0,
        //   onComplete: () => {
        //     this.async();
        //     $('body').attr('class', $('#body-classes').attr('class'));
        //   },
        // });
      },
      once(data) {
        contentAnimation(data.next.container);
        $('footer.content-info').addClass('fade-in');
      },
    },
  ],
  prevent: ({ el }) => el.classList && el.classList.contains('prevent'),
});
