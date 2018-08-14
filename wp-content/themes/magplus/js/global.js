/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: Site Title*/
/* Version: 1.0 Initial Release*/
/* Build Date: 22-04-2015*/
/* Author: Unbranded*/
/* Website: http://moonart.net.ua/site/ 
/* Copyright: (C) 2015 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/*-------------------------------------------------------------------------------------------------------------------------------*/

jQuery(function($) {

  "use strict";

  /*================*/
  /* 01 - VARIABLES */
  /*================*/
  var swipers = [],
    winW, winH, winScr, _isresponsive, smPoint = 768,
    mdPoint = 992,
    lgPoint = 1200,
    addPoint = 1600,
    $container,
    _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);
  /*========================*/
  /* 02 - page calculations */
  /*========================*/
  function pageCalculations() {
    winW = $(window).width();
    winH = $(window).height();
    if ($('.menu-button').is(':visible')) _isresponsive = true;
    else _isresponsive = false;
  }

  /*=================================*/
  /* 03 - function on document ready */
  /*=================================*/
  pageCalculations();

  /*============================*/
  /* 04 - function on page load */
  /*============================*/
  $(window).load(function() {
    $('#loader-wrapper').fadeOut();
    initSwiper();
    youtubePlaylist();
    matchHeight();
    if ($('.isotope').length) {
      $container.isotope({ itemSelector: '.isotope-item', masonry: { gutter: 0, columnWidth: '.grid-sizer' } });
    }
  });

  $(document).ready(function() {
    matchHeight();
    stickyVideo();
    progressBar();
    headerHeight();
    qtyStepper();
    parallax();
  });

  /*==============================*/
  /* 05 - function on page scroll */
  /*==============================*/
  $(window).on("scroll", function() {
    winScr = $(window).scrollTop();
    stickHeader();
  });

  /*==============================*/
  /* 05 - function on page resize */
  /*==============================*/
  function resizeCall() {
    pageCalculations();

    $('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function() {
      var thisSwiper = swipers['swiper-' + $(this).attr('id')],
        $t = $(this),
        slidesPerViewVar = updateSlidesPerView($t);
      thisSwiper.params.slidesPerView = slidesPerViewVar;
      thisSwiper.reInit();
      var paginationSpan = $t.find('.pagination span');
      var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
      if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
      else $t.removeClass('pagination-hidden');
      paginationSlice.show();
    });
  }
  if (!_ismobile) {
    $(window).resize(function() {
      resizeCall();
    });
  } else {
    window.addEventListener("orientationchange", function() {
      resizeCall();
    }, false);
  }

  function stickyVideo() {
    var video = '.tt-fluid-inner .tt-iframe';
    var button = '#lp-pom-button-16';
    var frame = '.tt-video-post-wrapper';
    var offset = ($('.tt-content').length) ? $('.tt-content').offset().top : 0;
    var showHeight = offset - 220;

    var targetClass = 'smallVid';
    var adjustClass = 'vidAdjust';
    var classSelect = '.smallVid';
    var noClose = true;
    var initWidth = $(video).width();
    var initHeight = $(video).height();
    $(window).scroll(function() {
      //console.log($(this).scrollTop());
      if ($(this).scrollTop() > showHeight && noClose) {
        $(video).addClass(targetClass + ' ' + adjustClass);
        $(frame).addClass('tt-on-scroll');
        $(video).removeClass('tt-fluid-inner-iframe');
        $(button).addClass(targetClass);
      } else {
        $(video).removeClass(targetClass, adjustClass);
        $(video).addClass('tt-fluid-inner-iframe');
        $(frame).removeClass('tt-on-scroll');
        $(button).removeClass(targetClass);
      }
    });
    $(button).click(function() {
      $(video).removeClass('smallVid vidAdjust');
      $(button).removeClass('smallVid');
      targetClass - null;
      adjustClass - null;
      noClose = false;
    });
  }

  function matchHeight() {
    var blogPostGrid = $('.post-grid-view'),
      blogTwoCol = $('.tt-post-two-col');

    blogPostGrid.imagesLoaded(function() {
      blogPostGrid.find('.post-handy-picked').not('.slick-slide').matchHeight();
    });

    blogTwoCol.imagesLoaded(function() {
      blogTwoCol.find('.tt-post-two-col-item').not('.slick-slide').matchHeight();
    });
  }

  /*=====================*/
  /* 07 - swiper sliders */
  /*=====================*/
  function initSwiper() {
    var initIterator = 0;
    $('.swiper-container').each(function() {
      var $t = $(this);
      var index = 'swiper-unique-id-' + initIterator;

      $t.addClass('swiper-' + index + ' initialized').attr('id', index);
      $t.find('.pagination').addClass('pagination-' + index);

      var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
      var centerVar = parseInt($t.attr('data-center'), 10);
      var simVar = ($t.closest('.circle-description-slide-box').length) ? false : true;

      var slidesPerViewVar = $t.attr('data-slides-per-view');
      if (slidesPerViewVar == 'responsive') {
        slidesPerViewVar = updateSlidesPerView($t);
      } else if (slidesPerViewVar != 'auto') slidesPerViewVar = parseInt(slidesPerViewVar, 10);

      var loopVar = parseInt($t.attr('data-loop'), 10);
      var speedVar = parseInt($t.attr('data-speed'), 10);

      var autoPlayVar = ($('.tt-gallery-post').length) ? 0 : autoPlayVar;

      swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
        speed: speedVar,
        pagination: '.pagination-' + index,
        loop: loopVar,
        paginationClickable: true,
        autoplay: autoPlayVar,
        slidesPerView: slidesPerViewVar,
        keyboardControl: true,
        allowSwipeToPrev: false,
        allowSwipeToNext: false,
        calculateHeight: true,
        simulateTouch: simVar,
        centeredSlides: centerVar,
        roundLengths: true,
        onSlideChangeEnd: function(swiper) {
          var activeIndex = (loopVar === true) ? swiper.activeIndex : swiper.activeLoopIndex;
          $('.img-block .bg.active').removeClass('active');
          $('.img-block .bg').eq(activeIndex).addClass('active');
          var qVal = $t.find('.swiper-slide-active').attr('data-val');
          $t.find('.swiper-slide[data-val="' + qVal + '"]').addClass('active');
        },
        onSlideChangeStart: function(swiper) {
          $t.find('.swiper-slide.active').removeClass('active');
        },
        onSlideClick: function(swiper) {

        }
      });
      if ($t.attr('data-slides-per-view') == 'responsive') {
        var paginationSpan = $t.find('.pagination span');
        var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
        if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
        else $t.removeClass('pagination-hidden');
        paginationSlice.show();
      }
      initIterator++;
    });

  }

  function updateSlidesPerView(swiperContainer) {
    if (winW >= addPoint) return parseInt(swiperContainer.attr('data-add-slides'), 10);
    else if (winW >= lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'), 10);
    else if (winW >= mdPoint) return parseInt(swiperContainer.attr('data-md-slides'), 10);
    else if (winW >= smPoint) return parseInt(swiperContainer.attr('data-sm-slides'), 10);
    else return parseInt(swiperContainer.attr('data-xs-slides'), 10);
  }

  //swiper arrows
  $('.swiper-arrow-left, .swiper-arrow-left-content').on('click', function() {
    swipers['swiper-' + $(this).parent().attr('id')].swipePrev();
  });

  $('.swiper-arrow-right, .swiper-arrow-right-content').on('click', function() {
    swipers['swiper-' + $(this).parent().attr('id')].swipeNext();
  });

  //swiper arrows
  $('.custom-arrow-left').on('click', function() {
    swipers['swiper-' + $(this).closest('.tt-custom-arrows').find('.swiper-container').attr('id')].swipePrev();
  });
  $('.custom-arrow-right').on('click', function() {
    swipers['swiper-' + $(this).closest('.tt-custom-arrows').find('.swiper-container').attr('id')].swipeNext();
  });

  /*==============================*/
  /* 08 - buttons, clicks, hovers */
  /*==============================*/

  function stickHeader() {
    var isSticky = $('body').hasClass('tt-header-sticky');
    if (winScr > 0 && isSticky) {
      $(".tt-header").addClass("stick");
    } else {
      $(".tt-header").removeClass("stick");
    }
    if ($(".tt-header-banner").length) {
      var bannerH = $(".tt-header-banner").height();
      if (winScr > bannerH && isSticky) {
        $(".tt-header").addClass("move");
      } else {
        $(".tt-header").removeClass("move");
      }
    }
  }

  function headerHeight() {
    var outerHeight = $('.tt-header').outerHeight();
    $('.tt-header-height').css('height', outerHeight);
  }

  function youtubePlaylist() {
    if ($('.yt-playlist').length) {
      var wrapper = $('#frame');
      var channelId = wrapper.data('channel-id');
      var ytp = new YTV('frame', {
        channelId: channelId,
        playerTheme: 'dark',
        responsive: true
      });
    }
  }

  function parallax() {
    $('.tt-parallax-on').codeStarParallax();
  }

  function qtyStepper() {

    if (typeof $.fn.number != 'function') {
      return;
    }

    if ($('input[type=number]').length) {
      console.log('sfsdf');
      $('input[type=number]').number();
    };
  }

  /*mobile menu*/
  $('.cmn-mobile-switch,.tt-mobile-close,.tt-mobile-overlay').on('click', function(e) {
    $('.tt-mobile-overlay').toggleClass('active');
    $('#content-wrapper').toggleClass('active');
    $('.tt-mobile-block').toggleClass('active');
    e.preventDefault();
  });
  $('.tt-mobile-nav .menu-toggle').on('click', function(e) {
    $(this).closest('li').addClass('select').siblings('.select').removeClass('select');
    $(this).closest('li').siblings('.parent').find('ul').slideUp();
    $(this).parent().siblings('ul').slideToggle();
    e.preventDefault();
  });

  $(document).on('mouseover', '.tt-mobile-nav>ul>li>a, .tt-mobile-nav>ul>li>ul>li>a', function(e) {
    e.preventDefault();
    $(this).siblings('ul').slideToggle();
  });

  /*search popup*/
  $('.tt-s-popup-btn').on('click', function(e) {
    $('.tt-s-popup').addClass('open');
    e.preventDefault();
  });
  $('.tt-s-popup-close, .tt-s-popup-layer').on('click', function(e) {
    $('.tt-s-popup').removeClass('open');
    e.preventDefault();
  });

  /*tt-thumb*/
  $('.tt-thumb').on('click', function(e) {
    var img = $(this).attr('href');
    $('.tt-thumb-popup-img').attr('src', img);
    $('.tt-thumb-popup').addClass('active');
    e.preventDefault();
  });
  $('.tt-thumb-popup-close, .tt-thumb-popup-layer').on('click', function(e) {
    $('.tt-thumb-popup').removeClass('active');
    e.preventDefault();
  });

  /*tt-video*/
  $(document).on('click', '.tt-video-open', function(e) {
    e.preventDefault();
    var video = $(this).attr('href');
    $('.tt-video-popup-container iframe').attr('src', video);
    $('.tt-video-popup').addClass('active');

  });
  $('.tt-video-popup-close, .tt-video-popup-layer').on('click', function(e) {
    $('.tt-video-popup').removeClass('active');
    $('.tt-video-popup-container iframe').attr('src', 'about:blank')
    e.preventDefault();
  });

  $('.open-video').on('click', function() {
    $('.tt-video-wrapper .tt-item-video[data-rel="' + $(this).data('rel') + '"]').find('.embed-responsive').html('<iframe class="embed-responsive-item" src="' + $(this).data('src') + '?autoplay=1&amp;controls=1&amp;loop=1&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;autohide=0&amp;color=white&amp;iv_load_policy=3&amp;wmode=transparent"></iframe>');
    return false;
  });


  /*==================================================*/
  /* 09 - form elements - checkboxes and radiobuttons */
  /*==================================================*/
  $container = $('.isotope-content');
  //Tabs
  var tabFinish = 0;
  $('.tt-nav-tab-item').on('click', function(e) {
    var $t = $(this);
    if (tabFinish || $t.hasClass('active')) e.preventDefault();
    tabFinish = 1;
    $t.closest('.tt-nav-tab').find('.tt-nav-tab-item').removeClass('active');
    $t.addClass('active');
    var index = $t.parent().parent().find('.tt-nav-tab-item').index(this);
    $t.closest('.tt-tab-wrapper').find('.tt-tab-info:visible').fadeOut(500, function() {
      $t.closest('.tt-tab-wrapper').find('.tt-tab-info').eq(index).fadeIn(500, function() {
        tabFinish = 0;
      });
    });
  });

  //Tabs
  var megaFinish = 0;
  $(".tt-mega-list li").on({
    mouseenter: function() {
      fixMegaMenuHeight();
      var $t = $(this);
      if (megaFinish || $t.hasClass('active')) e.preventDefault();
      megaFinish = 1;
      $t.siblings('.active').removeClass('active');
      $t.addClass('active');
      var index = $t.parent().parent().find('.tt-mega-list li').index(this);
      $t.closest('.tt-mega-wrapper').find('.tt-mega-entry.active').fadeOut(200, function() {
        $(this).removeClass('active');
        $t.closest('.tt-mega-wrapper').find('.tt-mega-entry').eq(index).fadeIn(200, function() {
          megaFinish = 0;
          $(this).addClass('active');
        });
      });
    },
    mouseleave: function() {
      //console.log('leave');

      //$('.tt-mega-list li').siblings('.active').removeClass('active');
    }
  });

  function fixMegaMenuHeight() {
    var _this = $('.tt-mega-list'),
        _height = _this.outerHeight();

    _this.siblings('.tt-mega-content').css({'height':_height+53});
  }


  function progressBar() {
    var progressBar = $('.progress-bar');
    progressBar.each(function(indx) {
      $(this).appear(function() {
        $(this).css('width', $(this).attr('aria-valuenow') + '%');
      });
    });

  }

  function isScrolledIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();

    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }


  $(window).on("scroll", function() {
    winScr = $(window).scrollTop();
    if (winScr > 500) {
      $(".tt-shortcode-1").addClass("open");
    } else {
      $(".tt-shortcode-1").removeClass("open");
    }
  });

  $(document).on('click', '.tt-shortcode-1 .tt-title-block', function(e) {
    e.preventDefault();
    $('.tt-shortcode-1').toggleClass('active');
    return false;
  });

  $(window).on("scroll", function() {
    winScr = $(window).scrollTop();
    if (winScr > 500) {
      $(".tt-shortcode-2.visible").addClass("open");
    } else {
      $(".tt-shortcode-2.visible").removeClass("open");
    }
  });
  $(document).on('click', '.tt-shortcode-2-close', function(e) {
    e.preventDefault();
    $('.tt-shortcode-2').removeClass('open').removeClass('visible');
    return false;
  });

  $('.ajax-load-more.load-more').each(function() {

    var $this = $(this),
      $container = $this.parent().parent().find('.isotope-content'),
      token      = $this.data('token'),
      settings   = window['magplus_load_more_' + token],
      is_isotope = parseInt(settings.isotope),
      paging     = 1,
      flood      = false,
      ajax_data;

    $this.bind('click', function() {

      if (flood === false) {
        paging++;
        flood = true;

        // set ajax data
        ajax_data = $.extend({}, { action: 'ajax-pagination', paged: paging }, settings);

        $.ajax({
          type: 'POST',
          url: magplus_ajax.ajaxurl,
          data: ajax_data,
          dataType: 'html',
          beforeSend: function() {
            $this.addClass('more-loading');
            $this.html('Loading...');
          },
          success: function(html) {

            var content = $(html).css('opacity', 0);


            if (is_isotope) {
              content.imagesLoaded(function() {
                $container.append(content).isotope('appended', content);
                $container.isotope('layout');
              });
            } else {
              $(content).insertBefore($this.parent());
            }
            content.animate({ 'opacity': 1 }, 250);

          
            // load button affecting after images loaded
            $this.removeClass('more-loading');
            $this.html('Load More');
            if (parseInt(settings.max_pages) == paging) { $this.hide(); }

            flood = false;
          }

        });

      }

      return false;
    });

  });

  $('.ajax-load-more.infinite-scroll').each(function() {

    var $this = $(this),
      $container = $this.parent().parent().find('.isotope-content'),
      token      = $this.data('token'),
      settings   = window['magplus_load_more_' + token],
      is_isotope = parseInt(settings.isotope),
      paging     = 2,
      flood      = false,
      ajax_data;


    $(window).scroll(function() {

      if (flood === false) {
        paging++;
        flood = true;

        // set ajax data
        ajax_data = $.extend({}, { action: 'ajax-pagination', paged: paging }, settings);

        $('.ajax-load-more.infinite-scroll').appear(function(){
          $.ajax({
            type: 'POST',
            url: magplus_ajax.ajaxurl,
            data: ajax_data,
            dataType: 'html',
            beforeSend: function() {
              $this.addClass('more-loading');
              $this.html('Loading...');
            },
            success: function(html) {

              var content = $(html).css('opacity', 0);

              if (is_isotope) {
                content.imagesLoaded(function() {
                  $container.append(content).isotope('appended', content);
                  $container.isotope('layout');
                });
              } else {
                $(content).insertBefore($this.parent());
              }
              content.animate({ 'opacity': 1 }, 250);

              // load button affecting after images loaded
              $this.removeClass('more-loading');
              $this.html('Load More');
              if (parseInt(settings.max_pages) == paging) { $this.hide(); }

              flood = false;
            }

          });
        });

        //}


      }

      return false;
    });

  });

});
