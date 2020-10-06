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
        let $service = $('.service-full');

        $service.on('click', function(e) {
          $(e.currentTarget).toggleClass('active');
        });

        $(window).on('scroll' , _.debounce(() => {
          if($service.hasClass('visible')) {
            $service.removeClass('visible');
          }

          $service.mostVisible({
            percentage: true,
            offset: 160,
          }).addClass('visible');
        }, 50));
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
                }, delay+=150);
              });
            }, 150);
          }
        }

        $(window).on('scroll' , _.debounce(() => {
          $filter.mostVisible({
            percentage: true,
            offset: 160,
          }).addClass('visible');
        }, 50));

        var instance = new mostVisible('#filter-list');
        instance.getMostVisible(popLoad());

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
