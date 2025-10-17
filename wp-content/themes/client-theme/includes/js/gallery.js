// $(document).ready(function(){
//     $('#gallery-menu li a').each(function(){
//         var oldUrl = $(this).attr("href"); // Get current url
//         var newUrl = oldUrl + "#gallery-menu"; // Create new url
//         $(this).attr("href", newUrl); // Set herf value
//     });

//     $('ul#main-nav li.gallery').addClass('active');
// });

/////////CAROUSEL/////////

$(document).ready(function() {

$('.carousel-gallery-slideshow').each(function() {
  var $slider = $(this);
  
  // Check if slider is already initialized
  if ($slider.hasClass('slick-initialized')) {
    return;
  }
  
  var slidesLarge = parseInt($slider.data('slides-large')) || 1;
  var slidesMedium = parseInt($slider.data('slides-medium')) || 1;
  var slidesSmall = parseInt($slider.data('slides-small')) || 1;
  var slideGap = $slider.data('gap') || '0'; // Default 0 gap
  var autoplayData = $slider.data('autoplay');
  var autoplay = autoplayData === 'true' || autoplayData === true;
  var autoplaySpeed = $slider.data('autoplay-speed') || 3000;
  
  // Check if this carousel has the 'offset' class
  var isOffset = $slider.hasClass('offset');
  
  // Captions are now handled via CSS - no JavaScript needed
  
  // For offset carousels, ensure we show at least 3 slides
  if (isOffset) {
    slidesLarge = 1; // For centerMode, we only show 1 main slide
    slidesMedium = 1; // For centerMode, we only show 1 main slide
    slidesSmall = 1; // Keep at least 1 for mobile
  }

  try {
    var slickSettings = {

    // Enables tabbing and arrow key navigation
    accessibility: true,
  
    // Adapts slider height to the current slide
    adaptiveHeight: true,
  
    // Change where the navigation arrows are attached (Selector, htmlString, Array, Element, jQuery object)
    //appendArrows: $(element),
  
    // Change where the navigation dots are attached (Selector, htmlString, Array, Element, jQuery object)
    //appendDots: $(element),
  
    // Enable Next/Prev arrows
    arrows: true,
  
    // Sets the slider to be the navigation of other slider (Class or ID Name)
    asNavFor: null,
  
    nextArrow: $slider.closest('.carousel-gallery').find('.slicknext'),
    prevArrow: $slider.closest('.carousel-gallery').find('.slickprev'),
    
    // prev arrow
    // prevArrow: '<a aria-label="Previous News Posts" href="#" class="slickprev"><i class="fal fa-chevron-left"></i></a>',
  
    // next arrow
    // nextArrow: '<a aria-label="More News Posts" href="#" class="slicknext"><i class="fal fa-chevron-right"></i></a>',
  
    // Enables auto play of slides
    autoplay: autoplay,
  
    // Auto play change interval
    autoplaySpeed: autoplaySpeed,
  
    // Enables centered view with partial prev/next slides. 
    // Use with odd numbered slidesToShow counts.
    centerMode: isOffset,
  
    // Side padding when in center mode. (px or %)
    centerPadding: isOffset ? '15%' : '0px', // Use 15% padding for offset to show partial slides
  
    // CSS3 easing
    cssEase: 'ease',
  
    // Custom paging templates. 
    // customPaging: function(slider, i) {
    //   return '<button type="button" data-role="none">' + (i + 1) + '</button>';
    // },
  
    // Current slide indicator dots
    dots: false,

    // appendDots: $('.slick-dots'),

    // Class for slide indicator dots container
    // dotsClass: 'slick-dots',
  
    // Enables desktop draggingson 
    draggable: true,
  
    // animate() fallback easing
    easing: 'linear',
  
    // Resistance when swiping edges of non-infinite carousels
    edgeFriction: 0.35,
  
    // Enables fade
    // fade: true,
  
    // Focus on select and/or change
    focusOnSelect: isOffset,
    focusOnChange: false,
  
    // Infinite looping
    infinite: true,
  
    // Initial slide
    initialSlide: 0,
  
    // Accepts 'ondemand' or 'progressive' for lazy load technique
    lazyLoad: 'ondemand',
  
    // Mobile first
    mobileFirst: false,
  
    // Pauses autoplay on hover
    pauseOnHover: false,
  
    // Pauses autoplay on focus
    pauseOnFocus: false,
  
    // Pauses autoplay when a dot is hovered
    pauseOnDotsHover: false,
  
    // Target containet to respond to
    respondTo: 'window',
  
    // Breakpoint triggered settings
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: slidesMedium,
        slidesToScroll: 1,
        infinite: true,
        centerMode: isOffset,
        focusOnSelect: isOffset,
        autoplay: autoplay,
        autoplaySpeed: autoplaySpeed
      }
    }, {
      breakpoint: 768,
      settings: {
        slidesToShow: slidesSmall,
        slidesToScroll: 1,
        dots: false,
        centerMode: false,
        centerPadding: '0px',
        focusOnSelect: false,
        autoplay: autoplay,
        autoplaySpeed: autoplaySpeed
      }
    }],
  
    // Setting this to more than 1 initializes <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a> mode. 
    // Use slidesPerRow to set how many slides should be in each row.
    rows: 1,
  
    // Change the slider's direction to become right-to-left
    rtl: false,
  
    // Slide element query
    slide: '',
  
    // # of slides to show at a time
    slidesToShow: slidesLarge,
  
    // With grid mode intialized via the rows option, this sets how many slides are in each grid row.
    slidesPerRow: 1,
  
    // # of slides to scroll at a time
    slidesTocroll: 1,
  
    // Transition speed
    speed: 500,
  
    // Enables touch swipe
    swipe: true,
  
    // Swipe to slide irrespective of slidesToScroll
    swipeToSlide: false,
  
    // Enables slide moving with touch
    touchMove: true,
  
    // To advance slides, the user must swipe a length of (1/touchThreshold) * the width of the slider.
    touchThreshold: 5,
  
    // Enable/Disable CSS Transitions
    useCSS: true,
  
    // Enable/Disable CSS Transforms
    useTransform: true,
  
    // Disables automatic slide width calculation
    variableWidth: false,
  
    // Vertical slide direction
    vertical: false,
  
    // hanges swipe direction to vertical
    verticalSwiping: false,
  
    // Ignores requests to advance the slide while animating
    waitForAnimate: true,
  
    // Set the zIndex values for slides, useful for IE9 and lower
    zIndex: 1000

  };
  
  $slider.slick(slickSettings);
  
  // Function to apply gap spacing
  function applyGapSpacing() {
    $slider.find('.slick-slide').css({
      'margin-left': slideGap,
      'margin-right': slideGap
    });
  }
  
  // Apply custom gap spacing initially
  applyGapSpacing();
  
  // Reapply gap spacing when slider resizes or breakpoints change
  $slider.on('breakpoint', function(event, breakpoint, direction) {
    setTimeout(applyGapSpacing, 50);
  });
  
  $slider.on('setPosition', function() {
    setTimeout(applyGapSpacing, 50);
  });
  
  // Handle window resize to maintain gaps
  $(window).on('resize', function() {
    setTimeout(applyGapSpacing, 100);
  });
  
  // Force the first slide to be visible after initialization
  setTimeout(function() {
    $slider.slick('slickGoTo', 0);
  }, 100);
  
  // CSS handles spacing for non-offset carousels
  
  } catch (e) {
    console.error("Error initializing slick carousel:", e);
  }
  
  // Add slick-initialized class to prevent re-initialization
  $slider.addClass('slick-initialized');
});

});
