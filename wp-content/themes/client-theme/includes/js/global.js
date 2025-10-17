//// RENAME CHINESE IN GTRANSALATE

window.addEventListener('load', function () {
  var tries = 0, timer = setInterval(function () {
    if (window.doGTranslate && document.querySelector('select.gt_selector')) {
      var opt = document.querySelector('select.gt_selector option[value$="zh-CN"]');
      if (opt) opt.text = opt.text.replace(/\s*\(Simplified\)/i, '');
      clearInterval(timer);
    }
    if (++tries > 30) clearInterval(timer);
  }, 200);
});

//// EQUAL HEIGHT DIVS

function setEqualHeight(columns) {
  var tallestcolumn = 0;
  columns.each(
  function() {
      currentHeight = $(this).height();
      if(currentHeight > tallestcolumn) {
          tallestcolumn  = currentHeight;
          }
      }
  );
columns.height(tallestcolumn);
}

var delay = (function(){
      var timer = 0;
      return function(callback, ms){
          clearTimeout (timer);
          timer = setTimeout(callback, ms);
  };
})();

/////////

$(document).ready(function(){
  $('#sub-nav ul.menu li a').each(function(){
      var oldUrl = $(this).attr("href"); // Get current url
      var newUrl = oldUrl + "#sub-nav"; // Create new url
      $(this).attr("href", newUrl); // Set herf value
  });
});

/***************************
PLAY/PAUSE VIDEO
****************************/

var player = document.getElementById("top-video");
if(player !== null) {
  player.onload= function() {
    // $('#pause-video').show();
    $('#video-sound').show();
    $('#video-loader').hide();
    // $('#slider-texture-1').fadeIn();
  };
}

/***************************
HIDE/SHOW HEADER
****************************/

(function(){

  var doc = document.documentElement;
  var w = window;

  var prevScroll = w.scrollY || doc.scrollTop;
  var curScroll;
  var direction = 0;
  var prevDirection = 0;

  var header = document.getElementById('header');
  var slider = document.getElementById('slider');
  var headerHeight = $ (header).height();
  var sliderHeight = $ (slider).height();

  var checkScroll = function() {

    /*
    ** Find the direction of scroll
    ** 0 - initial, 1 - up, 2 - down
    */

    curScroll = w.scrollY || doc.scrollTop;
    if (curScroll > prevScroll) {
      //scrolled up
      direction = 2;
    } else if (curScroll < prevScroll) {
      //scrolled down
      direction = 1;
    }

    if (direction !== prevDirection && !$('.mobile-nav-toggle .hamburger').hasClass("open") && !$('.community-mobile-nav-toggle').hasClass("open")) {
      toggleHeader(direction, curScroll);
    }


    prevScroll = curScroll;


    var newSliderHeight = $ (slider).height();

    if ($ (this).scrollTop() > newSliderHeight) {
      $('header,#community-header').addClass('outside-slider');
      $('#community-header #community-header-content h2.community-nav-title').slideDown();
    } else {
      $('header,#community-header').removeClass('outside-slider');
      if(!$('body').hasClass('community-mobile')) {
        $('#community-header #community-header-content h2.community-nav-title').slideUp();
      }
    }


     if ($ (this).scrollTop () < $('.top-promo-bar').outerHeight()) {
       header.classList.add('top');
     } else {
       header.classList.remove('top');
     }

       /* const myDiv = document.getElementById('contain-all'); // Replace ‘myDiv’ with the ID of your div
       myDiv.addEventListener('scroll', function() {
         if (myDiv.scrollTop === 0) {
           console.log('Scrolled to the top of the div!');
           // Perform actions when the div is at the top
         } else {
           console.log('Not at the top. Current scrollTop:', myDiv.scrollTop);
         }
       }); */

      var fadeStart = 10; // 100px scroll or less will equiv to 1 opacity
      var fadeUntil = newSliderHeight / 2; // 200px scroll or more will equiv to 0 opacity

      var offset = $(document).scrollTop();

      // if( offset <= fadeStart ) {
      //     opacity=1;
      // } else if( offset<=fadeUntil ) {
      //     opacity=1-offset/fadeUntil;
      // } else if(offset > fadeUntil) {
      //   opacity=0;
      // }
      // $('#slider h1, #slider h2').css('opacity',opacity);


     if ($ (this).scrollTop () > 200) {
       $('#header-content').addClass('slim');
       // $('#main-nav-holder').addClass('slim');
      //  $('.top-promo-bar').slideUp();
     } else {
       $('#header-content').removeClass('slim');
       // $('#main-nav-holder').removeClass('slim');
       if(!window.sessionStorage.getItem('top-bar-promo-closed')) {
        //  $('.top-promo-bar').slideDown();
       }
     }

  };

  var toggleHeader = function(direction, curScroll) {

    // if($('body').hasClass('community-page')) {
    //
    //   if (direction === 2 && curScroll > sliderHeight/2) {
    //       $('#community-header').addClass('hide');
    //       prevDirection = direction;
    //   }
    //   else if (direction === 1) {
    //     $('#community-header').removeClass('hide');
    //     prevDirection = direction;
    //   }
    //
    //
    // } else {

      if (direction === 2 && curScroll > sliderHeight / 2.5) {
          header.classList.add('hide');
          $('#top-gradient').addClass('move-up'); 
          prevDirection = direction;

      }
      else if (direction === 1 && curScroll < sliderHeight / 2.5) {
        header.classList.remove('hide');
        $('#top-gradient').removeClass('move-up');
        prevDirection = direction;
      }

    // }

  };

  window.addEventListener('load', checkScroll);
  window.addEventListener('scroll', checkScroll);

})();

// Hide Loader
$('.cycle-slideshow').on( 'cycle-initialized', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
    $('.imgloader').hide();
});

// PROMO BAR //

(function () {
  var topPromoBar = $ ('.top-promo-bar');
  var topPromoBarClose = $ ('#top-promo-close');

  if (topPromoBar.length > 0) {
    $ (window).on ('load', function () {

      if(!window.sessionStorage.getItem('top-bar-promo-closed')) {

        var promoHeight = $('.top-promo-bar').outerHeight();

       topPromoBar.css({
        'position' : 'absolute',
        'top' : '-500px',
        'display' : 'block'
      });

        setTimeout (function () {
         
        $('#community-header').removeClass('fixed');

          var sliderHeight = $('#slider').outerHeight(true)
          var navmenu = $ ('.off-canvas-menu');

          var winHeight = $(window).height(); 
          var promoHeight = $('.top-promo-bar').outerHeight(true)
          var margAdjust =  -promoHeight/3;
          var headerContentHeight = $('#community-header-content').outerHeight();
          var headerPromoheight = promoHeight + headerContentHeight;
          var promoHeight = $('.top-promo-bar').outerHeight(true)
          var newHeight = winHeight - promoHeight;

          topPromoBar.addClass('active');
          $('body').addClass ('promo-active');
          topPromoBar.css({
            'position' : 'relative',
            'top' : 0,
            'display' : 'none'
         });

        if ($('body').hasClass('home')) {
            // Only adjust slider height on home page
            $("#slider").animate({
              'height': newHeight + 'px',
            }, { duration: 800, queue: false });
        
            $("#slider .slide").animate({
              // 'marginTop': margAdjust + 'px',
            }, { duration: 800, queue: false });

            // Adjust main content position to fill the gap on home page
            var originalSliderHeight = $(window).height();
            var heightDifference = originalSliderHeight - newHeight;
            
            $("#main-content").animate({
              'marginTop': -heightDifference + 'px',
            }, { duration: 800, queue: false });
        }


          topPromoBar.slideDown (800,function () {
            topPromoBarClose.css ({
              opacity: 1,
            });
            
            // Recalculate parallax after layout adjustments are complete
            setTimeout(function() {
              parallax();
            }, 100);
          });
          
        }, 350);
      }
    });

    topPromoBarClose.on ('click', function () {
      var navmenu = $ ('.off-canvas-menu');
      window.sessionStorage.setItem('top-bar-promo-closed', true);
      $('body').removeClass ('promo-active');
      topPromoBar.removeClass ('active');
      topPromoBarClose.css ({
        opacity: 0,
      });
      topPromoBar.slideUp (800,function () {
        if ($(window).scrollTop() >= $('#community-header').offset().top) {
          $('#community-header-content').addClass('fixed-nav');
        }
      });

      if ($('body').hasClass('home')) {
        // Restore slider to full height on home page
        $('#slider').animate({height: '100vh'}, 800);
        
        // Reset main content position
        $('#main-content').animate({marginTop: '0px'}, 800);
      }

    });

  }
}) ();

/***************************
DISABLE/ENABLE SCROLL
****************************/

var winX = null;
var winY = null;

window.addEventListener('scroll', function () {
    if (winX !== null && winY !== null) {
        window.scrollTo(winX, winY);
    }
});

function disableWindowScroll() {
    winX = window.scrollX;
    winY = window.scrollY;
}

function enableWindowScroll() {
    winX = null;
    winY = null;
}






/***************************
OFF CANVAS MENU ANIMATIONS
****************************/

(function () {

  var toggleMenu = function (e) {

    if (!$('.mobile-nav-toggle .hamburger').hasClass ('open')) {
      // $('body').addClass('menu-open');
      $('#header-content').addClass('open');
      $('#main-nav.mobile-nav').addClass('open');
      $("#main-nav.mobile-nav li").hide().delay(200).fadeIn(800);
      $("#main-nav.mobile-nav").hide().css("right", "0").fadeIn(400)
      $('.mobile-nav-toggle .hamburger').addClass ('open');
      $('.mobile-nav-toggle .toggle-text').html ('CLOSE');
      disableWindowScroll();
    } else {
      $("#main-nav.mobile-nav li").fadeOut(200);
      $("#main-nav.mobile-nav").delay(200).fadeOut(400)
      setTimeout(function() { 
        $('#main-nav.mobile-nav').removeClass('open');
        // $('body').removeClass('menu-open');
        $('#header-content').removeClass('open');
        // $('#main-nav.mobile-nav').slideUp();
        $('.mobile-nav-toggle .hamburger').removeClass ('open');
        $('.mobile-nav-toggle .toggle-text').html ('MENU');
        enableWindowScroll();
      }, 200);
      
    }
  };


  // var toggleCommunityMenu = function (e) {
  //   if (!$('.community-mobile-nav-toggle').hasClass ('open')) {
  //     $('#community-nav.mobile-nav').addClass('open');
  //     // $('#community-nav.mobile-nav').slideDown();
  //     $("#community-nav.mobile-nav").hide().css("left", "-2.5%").slideDown(400, function() {});
  //     // $('#hamburger').addClass ('open');
  //     $('.community-mobile-nav-toggle').addClass ('open');
  //     console.log('opening');
  //   } else {
  //     $('#community-nav.mobile-nav').removeClass('open');
  //     // $('#community-nav.mobile-nav').slideUp();
  //     $("#community-nav.mobile-nav").slideUp(400, function() {
  //         $(this).show().css("left", "100%");
  //         console.log('closing');
  //     });
  //     // $('#hamburger').removeClass ('open');
  //     $('.community-mobile-nav-toggle').removeClass ('open');
  //   }
  // };

  // Close Menu on click outside
  $ (document.body).click (function () {
    if ($('.mobile-nav-toggle .hamburger').hasClass ('open')) {
      toggleMenu();
    }else if ($('.community-mobile-nav-toggle').hasClass ('open')) {
      // toggleCommunityMenu();
    }

    // if($('#ms-options').hasClass('open')) {
    //   $('#ms-options').css('display','none');
    // }
  });
  // Don't Close Menu When Clicked on
  $ ('.off-canvas-menu, header, #community-header').click (function (e) {
    e.stopPropagation ();
  });

  // Add Class to Body if Mouse is being used
  document.body.addEventListener('mousedown', function() {
    document.body.classList.add('using-mouse');
  });

  // Close Menu on esc click
  $ (document.body).keyup (function (e) {

    if (e.keyCode == 27) {

      if($('.mobile-nav-toggle .hamburger').hasClass ('open')) {
        toggleMenu();
      } else if ($('.community-mobile-nav-toggle').hasClass ('open')) {
        //toggleCommunityMenu();
      }
    }

    if (e.keyCode == 9) {
      // Remove Class from Body if Mouse is NOT being used
      document.body.classList.remove('using-mouse');
      // Open hidden navigation of one of the Items is in focus
      if ($("#main-nav.mobile-nav li a").is(":focus") && !$('.mobile-nav-toggle .hamburger').hasClass ('open')) {
        toggleMenu();
      } else if (!$("#main-nav.mobile-nav li a").is(":focus") && $('.mobile-nav-toggle .hamburger').hasClass ('open')) {
        toggleMenu();
      }
    }

  });

  $('.mobile-nav-toggle').on ('click', toggleMenu);
  // $('.community-mobile-nav-toggle').on ('click', toggleCommunityMenu);
}) ();

/*******************
TOP NAV SCROLL
*******************/

jQuery(function() {
  var menuid = $('.mobile-select ul').attr('id');
  jQuery("<select id='" + menuid + "-select' class='select' />").appendTo(".mobile-select ul");

  jQuery(".mobile-select ul a").each(function() {
   var el = jQuery(this);
   jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
   }).appendTo(".mobile-select ul select");
  });

  $( "<div class='select__arrow'></div>" ).appendTo( ".mobile-select" );

  jQuery(".mobile-select ul select").change(function() {
    window.location = jQuery(this).find("option:selected").val();
  });
  var menuitems = $('.mobile-select ul li');

  menuitems.each(function(index,menuitem) {
    if($(menuitem).hasClass('active')) {
      $('.mobile-select ul select.select option')[index].setAttribute('selected','selected');
    }
  });

});

/*******************
KEN BURNS
*******************/

var new_effect;
var old_effect;

function random_effect() {
	return Math.floor(Math.random() * 4) + 1;
}

$(function() {

  new_effect = random_effect();
  $('#slider.ken-burns .slide.first').addClass('scale');
  $('#slider.ken-burns .slide.first').addClass('fx' + new_effect);

	$('#slider.ken-burns').on('cycle-before', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
		old_effect = new_effect;
		new_effect = random_effect();
		$(incomingSlideEl).addClass('scale');
		$(incomingSlideEl).addClass('fx' + new_effect);
	});

	$('#slider.ken-burns').on('cycle-after', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
		$(outgoingSlideEl).removeClass('scale');
		$(outgoingSlideEl).removeClass('fx' + old_effect);
	});

});



// /*******************
// PARALLAX
// *******************/

// // Throttle function for scroll events
// function throttle(func, wait) {
//   var timeout;
//   return function executedFunction() {
//     var later = function() {
//       timeout = null;
//       func.apply(this, arguments);
//     };
//     clearTimeout(timeout);
//     timeout = setTimeout(later, wait);
//   };
// }

// // Simple, reliable parallax function
// function parallax() {
//   var winWidth = $(window).width();
//   if (winWidth > 768) {
//     var scrolled = $(window).scrollTop();
//     var windowHeight = $(window).height();
    
//     // Handle parallax elements
//     $('.parallax').each(function() {
//       var el = $(this);
//       var elementOffset = el.offset().top;
//       var elementDistance = scrolled - elementOffset + windowHeight;
//       var parallaxValue = -(elementDistance * 0.10);
//       el.css('transform', 'translateY(' + parallaxValue + 'px)');
//     });
    
//     // Handle parallax-rev elements
//     $('.parallax-rev').each(function() {
//       var el = $(this);
//       var elementOffset = el.offset().top;
//       var elementDistance = scrolled - elementOffset + windowHeight;
//       var parallaxOffset = elementDistance * 0.15;
//       el.css('transform', 'translateY(' + parallaxOffset + 'px)');
//     });
    
//     // Handle background parallax elements
//     $('.parallax-bg, .parallaxbg').each(function() {
//       var el = $(this);
//       var elementOffset = el.offset().top;
//       var elementDistance = scrolled - elementOffset + windowHeight;
//       var bgOffset = elementDistance * 0.25;
//       el.css('background-position', 'center -' + bgOffset + 'px');
//     });
    
//     // Handle parallax-left elements
//     $('.parallax-left').each(function() {
//       var el = $(this);
//       var elementOffset = el.offset().top;
//       var elementDistance = scrolled - elementOffset + windowHeight;
//       var leftOffset = elementDistance * 0.25;
//       el.css('transform', 'translateX(-' + leftOffset + 'px)');
//       el.find('h1').css('transform', 'translateX(' + leftOffset + 'px)');
//     });
    
//     // Handle parallax-right elements
//     $('.parallax-right').each(function() {
//       var el = $(this);
//       var elementOffset = el.offset().top;
//       var elementDistance = scrolled - elementOffset + windowHeight;
//       var rightOffset = elementDistance * 0.25;
//       el.css('transform', 'translateX(' + rightOffset + 'px)');
//       el.find('h1').css('transform', 'translateX(-' + rightOffset + 'px)');
//     });
    
//   } else {
//     // Reset for mobile
//     $('.parallax, .parallax-rev, .parallax-left, .parallax-right').css('transform', '');
//     $('.parallax-left h1, .parallax-right h1').css('transform', '');
//     $('.parallax-bg, .parallaxbg').css('background-position', 'center center');
//   }
// }


function isInViewport(node) {
  var rect = node.getBoundingClientRect();
  return (
    (rect.height > 0 || rect.width > 0) &&
    rect.bottom >= 0 &&
    rect.right >= 0 &&
    rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.left <= (window.innerWidth || document.documentElement.clientWidth)
  );
}

/*******************
PARALLAX
*******************/

function parallax() {
  var winWidth = $ (window).width ();
  if (winWidth > 640) {
    var scrolled = $ (window).scrollTop ();

    $('.parallax').each(function(index, element) {
      var initY = $(this).offset().top;
      var height = $(this).height();
      var endY  = initY + $(this).height();

      // Check if the element is in the viewport.
      var visible = isInViewport(this);
      if(visible) {
        $(this).addClass('in-view');
        var diff = scrolled - initY;

        var customratio = $(this).attr("data-parallax-ratio");
        if(customratio) {
          var ratio = Math.round((diff / height) * customratio);
        } else {
          var ratio = Math.round((diff / height) * 100);
        }
        // var ratio = Math.round((diff / height) * 100);
        if($(this).hasClass('parallaxbg')) {
          $(this).css('background-position','center ' + parseInt(-(ratio * 1.5)) + 'px');
        } else {
          // $ (this).css ('margin-top', parseInt(-(ratio * 1.5)) + 'px');
          $(this).css({"transform":"translateY(" + parseInt(-(ratio * 1.5)) + "px)"});

        }
      } else {
        $(this).removeClass('in-view');
      }
    });

    $('.parallax-rev').each(function(index, element) {
      var initY = $(this).offset().top;
      var height = $(this).height();
      var endY  = initY + $(this).height();

      // Check if the element is in the viewport.
      var visible = isInViewport(this);
      if(visible) {
        $(this).addClass('in-view');
        var diff = scrolled - initY;
        var customratio = $(this).attr("data-parallax-ratio");
        if(customratio) {
          var ratio = Math.round((diff / height) * customratio);
        } else {
          var ratio = Math.round((diff / height) * 100);
        }

        if($(this).hasClass('parallaxbg')) {
          $(this).css('background-position','center ' + parseInt((ratio * 1.5)) + 'px');
        } else {
          // $ (this).css ('margin-top', parseInt((ratio * 1.5)) + 'px');
          // $('div').css({"-webkit-transform":"translate(" + parseInt(-(ratio * 1.5) + "px")")"});​
          $(this).css({"transform":"translateY(" + parseInt((ratio * 1.5)) + "px)"});


        }

      } else {
        $(this).removeClass('in-view');
      }
    });

  } else {
    // Reset transforms and background positions for mobile (<= 640px)
    $ ('.parallax, .parallax-rev, .parallax-left, .parallax-right').css ({
      'transform': ''
    }).removeClass('in-view');
    $ ('.parallax-left h1, .parallax-right h1').css ({
      'transform': ''
    });
    $ ('.parallax-bg, .parallaxbg').css ('background-position', 'center center');
    $ ('.parallax-element').css({'transform': ''});
  }
}


// $(window).on("scroll load", function (e) {
// 	var windowht = $(window).height();
// 	var scrolltop = $(window).scrollTop();
// 	var scrollwindow = scrolltop + $(window).height();
// 	$(".parallax-element").each(function () {
//     $('this').hide();
// 		//var veglocation = $(this).scrollTop(); // This is bunk. Only elements with vertical scrollbar will have a value
// 		var sectionoffset = ($(this).offset().top);
// 		var distance = (sectionoffset - scrolltop);
// 		var elementheight = $(this).outerHeight();
// 		if ((scrollwindow > sectionoffset)/* && (distance <= windowht)*/) {
// 			$(this).addClass('revealed').trigger('classChange');
// 			// Enable parallax effect.
// 			var backgroundscroll;
// 			if($(this).hasClass('visible-on-load')) {
// 				backgroundscroll = sectionoffset - distance;
// 			} else {
// 				backgroundscroll = scrollwindow - sectionoffset;
// 			}
// 			var sum = (backgroundscroll / 2); //mess with these values for different parallax rate
// 		}
// 		if (((elementheight + distance) <= 0) || (scrollwindow < sectionoffset)) {
// 			$(this).removeClass('revealed');
// 		}
// 		$(this).on('classChange', function() {
// 			$(this).css({"transform": "translate3d(0px, " + sum + "px, 0px)"});
// 		});
// 	});

// });


/*******************
MOBILE SUB NAV
*******************/

$('.subnav-mobile').click(function () {
  $(this).toggleClass('subnav-open');
  $('.menu-main-menu-container').toggleClass('subnav-open');
});

/*******************
SCROLL
*******************/

function goToByScroll (id) {
  $ ('html,body').animate ({scrollTop: $ ('#' + id).offset ().top}, 1000);
}

$ ('.scrollto').click (function (event) {
  event.preventDefault ();
  id = $ (this).attr('data-href');
  $ ('html,body').animate ({scrollTop: $ (id).offset ().top}, 1000);
});

//// ScrollTo for Main Nav
$ ('#main-nav ul li.scrollto a').click (function (event) {
  event.preventDefault ();
  id = $(this).attr('href');
  console.log('id='+id);
  $ ('html,body').animate ({scrollTop: $ (id).offset ().top}, 1000);
  if($('#main-nav').hasClass('open')) {
    $('.mobile-nav-toggle').click();
  }
});



checkScroll = function () {


  /*******************
  GALLERY LINK
  *******************/

$('.gallery-link').click(function(e) {
   e.preventDefault();
   var currgall = $(this).attr('data-gallery-name');
   console.log('.' + currgall + ':first-child');
    $('.' + currgall + ' a').first().click();
 
});

  /*******************
  UP LINK
  *******************/

  var isOnDiv = false;
  $('#uplink').mouseenter(function(){isOnDiv=true;});
  $('#uplink').mouseleave(function(){isOnDiv=false;});
  clearTimeout($.data(this, 'scrollTimer'));
  $.data(this, 'scrollTimer', setTimeout(function() {
    if(isOnDiv===false) {
      $('#uplink').removeClass('up');
    } else {
      $("#uplink").mouseout(function(){
        setTimeout(function() {
          $("#uplink").removeClass('up');
        }, 800);
      });
    }
  }, 4000));

};

$(window).bind('mousewheel', function(event) {
  var topSection = $ ('#slider').height();
  var scrollPos = $(window).scrollTop();
  if (event.originalEvent.wheelDelta >= 0 && scrollPos >= topSection / 2) {
      $('#uplink').addClass('up');
  } else {
      $('#uplink').removeClass('up');
  }
});

$ ('#uplink').click (function (event) {
  event.preventDefault ();
  goToByScroll('top');
  $(this).removeClass('up');
});


/*******************
SCROLL REVEAL OBJECTS
*******************/
// var fadein = {
//   origin: 'bottom',
//   distance: '0',
//   duration: 700,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var fromright = {
//   origin: 'right',
//   distance: '50px',
//   duration: 800,
//   delay: 100,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var fromleft = {
//   origin: 'left',
//   distance: '50px',
//   duration: 800,
//   delay: 100,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var fromtop = {
//   origin: 'top',
//   distance: '50px',
//   duration: 800,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var frombottom = {
//   origin: 'bottom',
//   distance: '50px',
//   duration: 800,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var frombottomquick = {
//   origin: 'bottom',
//   distance: '30px',
//   duration: 300,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var smalltobig = {
//   origin: null,
//   distance: '',
//   duration: 500,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 0.9,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var bigtosmall = {
//   origin: null,
//   distance: '',
//   duration: 500,
//   delay: 200,
//   rotate: {x: 0, y: 0, z: 0},
//   opacity: 0,
//   scale: 0.9,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   useDelay: 'always',
//   viewFactor: 0.1,
//   viewOffset: {top: 0, right: 0, bottom: 0, left: 0},
//   afterReveal: function (domEl) {},
//   afterReset: function (domEl) {},
// };

// var fadeSequence = {
//   origin: 'center',
//   distance: '0',
//   duration: 800,
//   delay: 0,
//   opacity: 0,
//   scale: 1,
//   easing: 'ease-out',
//   mobile: false,
//   reset: false,
//   viewFactor: 0.2,
// };

/*******************
ANIMATE
*******************/

(function($) {
  $.fn.visible = function(partial) {
	  var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
	  return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
  };
})(jQuery);

initAnimate = function() {
  $("*[class*=animate-]").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("in-view");
      //commenceCounting, 300);
    } else {
      el.removeClass("in-view");
    }
  });
}

$(window).on("load scroll",function(){
  initAnimate();
});



  // Close Menu on click outside
  $ ('#main-nav.mobile-nav li.dropdown').click (function () {
    slideToggle();
    // if ($(this).hasClass ('show')) {
    //   $(this > 'ul').removeClass ('show')
    //   $(this > 'ul').removeClass ('show')
    // }else if ($('.community-mobile-nav-toggle').hasClass ('open')) {
    //   // toggleCommunityMenu();
    // }
  });


$( document ).ready(function() {
  // console.log('ready');
  // Run Parallax if fullscreen if not on Iphone/IPad
  var deviceAgent = navigator.userAgent.toLowerCase ();
  var agentID = deviceAgent.match (/(iphone|ipod|ipad)/);

  checkScroll();
  initAnimate();

  // Initialize parallax on page load with a small delay
  if (!agentID) {
    setTimeout(function() {
      parallax(); // Initial call
    }, 100);
  }
  
  // Re-enable scroll event handler
  $ (window).scroll (function (e) {
    checkScroll ();
    if (!agentID) {
      parallax();
    }
  });

  // if ($ (window).width () >= 768 && !agentID) {
  // if (!agentID) {
  //   //Call Scroll Reveal
  //   window.sr = ScrollReveal ();
  //   sr.reveal ('.fadein', fadein);
  //   sr.reveal ('.from-bottom', frombottom);
  //   sr.reveal ('.from-bottom-quick', frombottomquick);
  //   sr.reveal ('.from-top', fromtop);
  //   sr.reveal ('.from-left', fromleft);
  //   sr.reveal ('.from-right', fromright);
  //   sr.reveal ('.small-to-big', smalltobig);
  //   //Make sure you have the latest scroll reveal to use the sequence feature
  //   sr.reveal ('.fade-sequence-2', fadeSequence, 400);
  //   sr.reveal ('.fade-sequence-fast', fadeSequence, 150);
  //   sr.reveal ('.gallery-box', fadeSequence, 400);
  // } else {

  // }

  if ($ (window).width() < 975) {
    $('body').addClass('mobile');
    $('#main-nav').addClass('mobile-nav');
    $('#main-nav').removeClass('open');
    $('body').removeClass('menu-open');
    $('#header-content').removeClass('open');
    $('.mobile-nav-toggle .hamburger').removeClass ('open');
    $('.mobile-nav-toggle,.more-homes').css('display','block').removeClass ('open');
  }

  if ($ (window).width() < 769) {
    // $('body').addClass('community-mobile');
    // $('#community-nav').addClass('mobile-nav');
    // $('#community-nav').removeClass('open');
    // $('.community-mobile-nav-toggle #hamburger').removeClass ('open');
    // $('.community-mobile-nav-toggle').css('display','block').removeClass ('open');
  }

  setTimeout(function() {
    $('#main-nav').fadeIn();
    $('header').removeClass('no-transition');
  }, 200);

  // Remove Hash on load//
 setTimeout(function() {
     history.pushState(null, null, window.location.href.split('#')[0]);
 }, 1000);

 var doc = document.documentElement;
 var w = window;
 curScroll = w.scrollY || doc.scrollTop;
 var sliderHeight = $ (slider).height();
 if (curScroll > sliderHeight / 2) {
     header.classList.add('hide');
 }

 // Home Popup
 if ($('#home-popup').length){
   $('#home-popup').addClass('pop-visible');
   $('.popup-close').click(function(){
     $('#home-popup').removeClass('pop-visible');
   });
  $('#home-popup').on('click', function(event) {
    if (!$(event.target).closest('.popup-content').length) {
      $(this).removeClass('pop-visible');
    }
  });
 }

  // Prevent 'e' in number inputs
  $('input[type="number"]').on('keydown', function(e) {
    if (e.key === 'e' || e.key === 'E') {
      e.preventDefault();
    }
  });

}); // end doc ready

// $('#main-nav li').hover(
//     function() {
//       var winWidth = $ (window).width ();
//       if (winWidth > 1000) {
//       $('ul.dropdown', this).stop().animate({ opacity: 'toggle' }, 'fast');
//       }
//     }
// );

$(window).on('resize', function(){
  var $promoHeight = $('.top-promo-bar').outerHeight();
  var $headerContentHeight = $('#header-content-holder').outerHeight();
  var $fullHeaderheight = $promoHeight + $headerContentHeight;
  var winWidth = $ (window).width ();

  var isMobile = false; //initiate as false
  // device detection
  if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
      || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
      isMobile = true;
  }

  //if (isMobile != true) {
  if (winWidth > 768 || isMobile != true) {
    $('body').removeClass('menu-open');
    $('#header-content').removeClass('open');
    enableWindowScroll();
  }

  $('.mobile-nav-toggle .toggle-text').html ('MENU');

  if (winWidth > 975) {
    $('body').removeClass('mobile');
    $('#main-nav').removeClass('mobile-nav open');
    $('.mobile-nav-toggle').hide();
    $('.mobile-nav-toggle .hamburger').removeClass ('open');
    // $('.mobile-nav-toggle,.more-homes').css('display','none').removeClass ('open');
    $("#main-nav").show().css("right", "0");
    $("#main-nav li").fadeIn();
  } else {
    // if (isMobile != true) {
    if (winWidth > 768 || isMobile != true) {
      $('body').addClass('mobile');
      $('#main-nav').addClass('mobile-nav');  
      $('#main-nav').removeClass('open');
      $('.mobile-nav-toggle').show();
      $('.mobile-nav-toggle .hamburger').removeClass ('open');
      // $('#main-nav').css('display','none');
      $("#main-nav.mobile-nav").slideUp(0, function() {
          $(this).show().css("right", "100%");
          $("#main-nav li").fadeOut();
      });
  
    }
    // $('.mobile-nav-toggle,.more-homes').css('display','block').removeClass ('open');
  }

  setTimeout(function() {
    initAnimate();
  }, 200);

  // Re-evaluate parallax on resize (ensures reset at <= 640px)
  parallax();

});

/* Responsive SrcSet */

var ResponsiveBackgroundImage = function (element) {
  var element = element;
  var img = element.querySelector ('img');
  var src = '';
  // var revealClasses = [
  //   'from-left',
  //   'from-right',
  //   'from-top',
  //   'small-to-big',
  //   'from-left-fast',
  //   'from-right-fast',
  //   'news-fase',
  //   'fade-sequence-2',
  //   'fade-sequence-fast',
  //   'galley-box',
  // ];

  var body = document.body;
  var html = document.documentElement;
  var height = Math.max (
    body.scrollHeight,
    body.offsetHeight,
    html.clientHeight,
    html.scrollHeight,
    html.offsetHeight
  );

  var update = function () {
    var src = typeof img.currentSrc !== 'undefined' ? img.currentSrc : img.src;
    if (src) {
      element.style.backgroundImage = 'url("' + src + '")';
    }
  };

// var checkIfScrollRevealElement = function (element, classes) {
// for (i = 0; i < classes.length; i++) {
// if (element.classList.contains (classes[i])) {
//   return true;
// }
// }
// };

// if (checkIfScrollRevealElement) {
// var fired = 0;
// window.addEventListener ('scroll', function () {
// if (fired <= height) {
//   update ();
//   fired++;
// }
// });
// }

img.addEventListener ('load', function () {
update ();
});

if (img.complete) {
update ();
}
};

// var elements = document.querySelectorAll ('.responsive-background-image');
// for (var i = 0; i < elements.length; i++) {
// new ResponsiveBackgroundImage (elements[i]);
// }

var callSrcset = function(parent) {
  var elements = document.querySelectorAll (parent + ' .responsive-background-image');
  for (var i = 0; i < elements.length; i++) {
    new ResponsiveBackgroundImage (elements[i]);
  }
};

callSrcset('body');

let show = true;
function showCheckboxes() {
    let checkboxes = document.getElementById("checkBoxes");
    if (show) {
        checkboxes.style.display = "block";
        show = false;
    } else {
        checkboxes.style.display = "none";
        show = true;
    }
}

let output = document.getElementById('ms-output');
  var showCheckBoxes = true;
  function showOptions() {
      var options = document.getElementById("ms-options");
      if (showCheckBoxes) {
        // $('#ms-options').addClass('open');
        options.style.display = "flex";
        showCheckBoxes = !showCheckBoxes;
      } else {
        options.style.display = "none";
        showCheckBoxes = !showCheckBoxes;
        // $('#ms-options').removeClass('open');
      }
  }

document.addEventListener("DOMContentLoaded", function () {
  let showCheckBoxes = true;

  // Function to toggle the dropdown visibility
  function showOptions(event) {
      const options = document.getElementById("ms-options");

      // Ensure the click is on the dropdown title
      if (event.target.closest(".dropdown-title")) {
          if (showCheckBoxes) {
              options.style.display = "flex"; // Show dropdown
          } else {
              options.style.display = "none"; // Hide dropdown
              getOptions(); // Update selected options
          }
          showCheckBoxes = !showCheckBoxes; // Toggle state
      }
  }

  // Attach click event listener to the dropdown title
  const dropdownTitle = document.querySelector(".dropdown-title");
  if (dropdownTitle) {
      dropdownTitle.addEventListener("click", showOptions);
  }
  // Removed the else block that was logging the error since this element
  // is only present on certain pages and that's expected behavior

  // Function to get selected options and populate #ms-output
  function getOptions() {
      const output = document.getElementById("ms-output");
      const selectedOptions = document.querySelectorAll("#ms-options input[type='checkbox']:checked");

      // Collect selected checkbox values
      const selectedValues = Array.from(selectedOptions).map(option => option.value);

      // Update the hidden field
      output.value = selectedValues.join(", ");
      console.log("Selected values:", selectedValues); // Debugging log
  }

  // Close dropdown if clicking outside
  document.addEventListener("click", function (event) {
      const dropdown = document.getElementById("ms-options");
      const dropdownContainer = document.querySelector(".ms-dropdown");

      if (dropdownContainer && !dropdownContainer.contains(event.target) && dropdown && dropdown.style.display === "flex") {
          dropdown.style.display = "none";
          getOptions();
          showCheckBoxes = true; // Reset state
      }
  });
});


/***************************
COMMUNITY DROPDOWN HANDLER
****************************/

$(document).ready(function() {
  $('#comm-select').on('change', function() {
    var url = $(this).val();
    if (url) {
      $('#comm-select-go').removeAttr('disabled');
    } else {
      $('#comm-select-go').attr('disabled', 'disabled');
    }
  });

  $('#comm-select-go').on('click', function() {
    var url = $('#comm-select').val();
    if (url) {
      window.location.href = url;
    }
  });
});

// Reset community select when navigating back/forward
if (performance.getEntriesByType("navigation")[0]?.type === "back_forward") {
  $('#comm-select').val('');
  $('#comm-select-go').attr('disabled', 'disabled');

  setTimeout(function() {
    $('#comm-select').val('');
    $('#comm-select-go').attr('disabled', 'disabled');
  }, 500);
}



function getCurrentLanguage() {
  var path = window.location.pathname;
  var parts = path.split('/');
  if (parts.length > 1 && parts[1].length === 2) {
      return parts[1];
  }
  return 'en';
}

function removeExistingLangClasses($body) {
  var classes = ($body.attr('class') || '').split(/\s+/);
  var kept = [];
  for (var i = 0; i < classes.length; i++) {
    if (!/^lang-[a-z]{2}$/i.test(classes[i])) {
      kept.push(classes[i]);
    }
  }
  $body.attr('class', kept.join(' ').trim());
}

jQuery(function($) {
  // Initial body language class from URL
  var currentLang = getCurrentLanguage();
  $('body').addClass('lang-' + currentLang);

  // Update on GTranslate selector change (value like "en|es")
  $(document).on('change', 'select.gt_selector, select[name="gtranslate"]', function() {
    var val = $(this).val() || '';
    var lang = val.split('|').pop().substr(0,2).toLowerCase();
    var $body = $('body');
    removeExistingLangClasses($body);
    $body.addClass('lang-' + lang);
  });

  // Update on GTranslate flag/link click
  $(document).on('click', 'a.glink, a[data-gt-lang]', function() {
    var lang = ($(this).attr('data-gt-lang') || '').substr(0,2).toLowerCase();
    if (lang) {
      var $body = $('body');
      removeExistingLangClasses($body);
      $body.addClass('lang-' + lang);
    }
  });
});


