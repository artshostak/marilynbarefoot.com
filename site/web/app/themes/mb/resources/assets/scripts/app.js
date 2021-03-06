/**
 * External Dependencies
 */
import 'jquery';
import barba from '@barba/core';
import gsap from 'gsap';
import _ from 'underscore';
import Lottie from 'lottie-web';
import List from 'list.js';
import Glide from '@glidejs/glide'
import Player from '@vimeo/player';
import 'scrollit';
import lax from 'lax.js'

let $body = $('body');

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

function mobileMenu() {
  // Menu
  $('.js-menu-toggle').on('click', (e) => {
    e.preventDefault();
    $(e.currentTarget).toggleClass('active');
    $('body').toggleClass('menu-open');
  });
}

function scrollingHeader() {
  if(!$body.hasClass('home')) {
    $(window).on('scroll', function() {
      if ($(window).scrollTop() > 0) {
        $header.addClass('white');
      } else {
        $header.removeClass('white');
      }
    });
  }
}

// Loader
const loadingContainer = document.querySelector('.loading-container'),
      loadingScreen = document.querySelector('.loading-screen'),
      $header = $('header.top');

// Function to add and remove the page transition screen
function pageTransitionIn() {
  return gsap
    .timeline({ delay: 0 })
    .set(loadingContainer, {
      css: {
        zIndex: 100,
      },
    })
    .set(loadingScreen, {
      transformOrigin: 'bottom left',
    })
    // .to(loadingScreen, { duration: 0.5, scaleY: 1 })
    .to(loadingScreen, { duration: .5, scaleY: 1, transformOrigin: 'bottom left'})
}

// Function to add and remove the page transition screen
function pageTransitionOut(container) {
  return gsap
    .timeline({ delay: 0.5 }) // More readable to put it here
    .add('start') // Use a label to sync screen and content animation
    .to(loadingScreen, {
      duration: .5,
      scaleY: 0,
      skewX: 0,
      transformOrigin: 'top left',
      ease: 'power1.out',
    }, 'start')
    .set(loadingContainer, {
      css: {
        zIndex: -1,
      },
    })
    .call(contentAnimation, [container], 'start')
}

// Function to animate the content of each page
function contentAnimation(container) {
  return gsap
    .timeline()
  //   .from($header, {
  //     duration: 0.5,
  //     opacity: 0,
  //     translateY: '-250px',
  //   }
  // )
}

// Barba 
barba.init({
  // debug: true,
  prevent: ({ el }) => el.classList && el.classList.contains('prevent'),
  views: [
    {
      namespace: 'Home',
      beforeEnter() {
        //
      },
      afterEnter() {
        // add transparent effect to header
        $header.addClass('transparent');

        // Transparent header effect on scroll
        $(window).on('scroll', function() {
          let scroll = $(window).scrollTop();
          if(scroll >= (window.innerHeight - 41)) {
            $header.addClass('white');
          } else {
            $header.removeClass('white');
          }
        });

        setTimeout(function() {
          $('section.hero').addClass('active');
          playAnimation();
        }, 1500);

        setTimeout(function() {
          $body.addClass('show-header');
        }, 2500);

        // Lax scrolling animations
        window.onload = function() {
          lax.setup()
          const updateLax = () => {
            lax.update(window.scrollY)
            window.requestAnimationFrame(updateLax)
          }
          window.requestAnimationFrame(updateLax)
        }
      },
      afterLeave() {
        $header.removeClass('white');
        $header.removeClass('transparent');
      },
    },
    {
      namespace: 'Services',
      afterEnter() {
        let $service = $('.service-full');
        $service.on('click', function(e) {
          $(e.currentTarget).toggleClass('active');
        });

        if(window.location.hash) {
          $('html, body').animate({
            scrollTop: $(window.location.hash).offset().top - 200 + 'px'
          }, 500, 'swing');
        }
      },
    },
    {
      namespace: 'Content',
      afterEnter() {
        // Scollit
        if($('header.sticky').length > 0) {
          $.scrollIt({
            upKey: 38,
            downKey: 40,
            topOffset: -82,
            easing: 'easeInOutExpo',
            scrollTime: 250,
          });
        }

        // Toggle more
        let $series = $('.series');
        $series.on('click', function(e) {
          $(e.currentTarget).toggleClass('active');
        });

        // Vimeo
        if ($('.video-trigger').length > 0) {
          $('.video-trigger').on('click', 'a', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $trigger = $(this).parents('.video-trigger');
            const vimeo = $trigger.find('.vimeo-video').data('vimeo-id');
            const player = new Player('vimeo-' + vimeo);
            $trigger.find('figure').addClass('hidden');
            $trigger.find('.pin').hide();
            player.setVolume(0.5);
            player.play();
          });
        }
      },
    },
    {
      namespace: 'Clients',
      afterEnter() {
        // Animation for Clients
        let $filter = $('#filter-list');
        function popLoad() {
          if($filter.length > 0) {
            var delay = 0;
            var $listSizeItem = $filter.find('.list').children('li');
            setTimeout(function() {
              $($listSizeItem).each(function() {
                var $item = $(this);
                setTimeout(function() {
                  $item.addClass('visible');
                }, delay+=50);
              });
            }, 50);
          }
        }

        setTimeout(function() {
          popLoad();
        }, 1000);

        // Glide slider
        new Glide('.glide').mount();

        // Filtering
        var options = {
          valueNames: [ 'categories' ],
        };
        const filterList = new List('filter-list', options);
        
        $('a.category').click(function(e) {
          e.preventDefault();
          $('a.category').removeClass('active');
          $('ul.list > li').each(function() {
            $(this).removeClass('visible');
          });

          $(this).addClass('active');
          if($(this).hasClass('show-all')) {
            filterList.filter();
            return false;
          } else {
            var selection = $(this).text();
            filterList.filter(function(item) {
              var cats = item.values().categories.split(', ');
              for (var i=0, j=cats.length; i<j; i++) {
                if (cats[i] == selection) {
                  return true;
                }
              }
            });
          }
        });

        filterList.on('updated', function() {
          popLoad();
        });
      },
    },
  ],
  transitions: [
    {
      // sync: true,
      beforeLeave(data) {
        $('.barba-container').fadeOut(100);
        data.current.container.remove()
      },
      leave() {
        $header.find('.js-menu-toggle.active').removeClass('active');
        pageTransitionIn()
      },
      beforeEnter() {
        $body.attr('class', $('#body-classes').attr('class'));
      },
      enter(data) {
        $(window).scrollTop(0);
        pageTransitionOut(data.next.container)
        $('.barba-container').addClass('visible');
        scrollingHeader();
      },
      once(data) {
        contentAnimation(data.next.container);
        mobileMenu();
        scrollingHeader();
        $('.barba-container').addClass('visible');
      },
    },
  ],
});
