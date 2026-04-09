/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

$(document).ready(function () {
  // --- Opening Sequence Logic ---
  function handleOpeningSequence() {
    var sequence = $('#opening-sequence');
    if (!sequence.length) return;
    var hasSeenIntro = sessionStorage.getItem('hasSeenIntro');
    if (hasSeenIntro) {
      sequence.hide();
      $('#main-content').show();
      return;
    }
    var isSkipped = false;
    var timeouts = [];
    function completeIntro() {
      if (isSkipped) return;
      sessionStorage.setItem('hasSeenIntro', 'true');
      sequence.fadeOut(500, function () {
        $('#main-content').fadeIn(500);
      });
    }
    $('#skip-intro').on('click', function () {
      isSkipped = true;
      timeouts.forEach(clearTimeout);
      sessionStorage.setItem('hasSeenIntro', 'true');
      sequence.fadeOut(300, function () {
        $('#main-content').fadeIn(300);
      });
    });

    // Phase 1: Logo
    timeouts.push(setTimeout(function () {
      if (isSkipped) return;
      $('#phase-logo').fadeIn(400);
    }, 200));

    // Phase 2: Production
    timeouts.push(setTimeout(function () {
      if (isSkipped) return;
      $('#phase-logo').fadeOut(400, function () {
        return $('#phase-production').fadeIn(400);
      });
    }, 2000));

    // Phase 3: Presenting
    timeouts.push(setTimeout(function () {
      if (isSkipped) return;
      $('#phase-production').fadeOut(400, function () {
        return $('#phase-presenting').fadeIn(400);
      });
    }, 3800));

    // Phase 4: Complete
    timeouts.push(setTimeout(function () {
      if (isSkipped) return;
      completeIntro();
    }, 5000));
  }
  $('#menu-toggle').on('click', function () {
    // Tampilkan MegaMenu
    $('#mega-menu').toggleClass('invisible opacity-0 pointer-events-none');
    $('#mega-menu').toggleClass('visible opacity-100 pointer-events-auto');
    // Disable scroll jika menu dibuka
    if ($('#mega-menu').hasClass('visible')) {
      $('body').css('overflow', 'hidden');
    } else {
      $('body').css('overflow', 'unset');
    }
  });
  $('#mega-menu-close').on('click', function () {
    $('#mega-menu').removeClass('visible opacity-100 pointer-events-auto').addClass('invisible opacity-0 pointer-events-none');
    $('body').css('overflow', 'unset');
  });

  // --- Navbar Logic ---
  function handleNavbar() {
    var navbar = $('#main-navbar');
    var menuButton = $('#menu-toggle');
    var searchButton = $('#search-button');
    var megaMenu = $('#mega-menu');
    var searchModal = $('#search-modal');
    var isHomepage = $('body').find('#hero-section').length > 0;
    var lastScrollY = window.scrollY;
    function toggleMenu() {
      var forceClose = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var isOpen = megaMenu.hasClass('visible');
      if (forceClose || isOpen) {
        // Close menu
        $('body').css('overflow', 'unset');
        megaMenu.removeClass('visible opacity-100').addClass('invisible opacity-0');
        megaMenu.find('> div:first-child').removeClass('opacity-100').addClass('opacity-0');
        megaMenu.find('> div:last-child').removeClass('opacity-100 translate-y-0').addClass('opacity-0 translate-y-8');
        $('#menu-icon-open').removeClass('opacity-0 rotate-180').addClass('opacity-100 rotate-0');
        $('#menu-icon-close').removeClass('opacity-100 rotate-0').addClass('opacity-0 -rotate-180');
      } else {
        // Open menu
        toggleSearch(true); // Close search if open
        $('body').css('overflow', 'hidden');
        megaMenu.removeClass('invisible opacity-0').addClass('visible opacity-100');
        megaMenu.find('> div:first-child').removeClass('opacity-0').addClass('opacity-100');
        megaMenu.find('> div:last-child').removeClass('opacity-0 translate-y-8').addClass('opacity-100 translate-y-0');
        $('#menu-icon-open').removeClass('opacity-100 rotate-0').addClass('opacity-0 rotate-180');
        $('#menu-icon-close').removeClass('opacity-0 -rotate-180').addClass('opacity-100 rotate-0');

        // Stagger animation for menu items
        $('#mega-menu .xl\\:col-span-8 > div > div').each(function (index) {
          var delay = 300 + index * 100;
          $(this).css('transition-delay', "".concat(delay, "ms")).removeClass('opacity-0 -translate-x-8').addClass('opacity-100 translate-x-0');
        });
      }
      updateNavbarStyle();
    }
    function toggleSearch() {
      var forceClose = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var isOpen = searchModal.hasClass('visible');
      if (forceClose || isOpen) {
        $('body').css('overflow', 'unset');
        searchModal.removeClass('visible opacity-100').addClass('invisible opacity-0');
        searchModal.find('> div:first-child').removeClass('opacity-100').addClass('opacity-0');
        searchModal.find('> div:last-child').removeClass('opacity-100 translate-y-0').addClass('opacity-0 translate-y-4');
        $('#search-icon-open').removeClass('opacity-0 rotate-180').addClass('opacity-100 rotate-0');
        $('#search-icon-close').removeClass('opacity-100 rotate-0').addClass('opacity-0 -rotate-180');
      } else {
        toggleMenu(true); // Close menu if open
        $('body').css('overflow', 'hidden');
        searchModal.removeClass('invisible opacity-0').addClass('visible opacity-100');
        searchModal.find('> div:first-child').removeClass('opacity-0').addClass('opacity-100');
        searchModal.find('> div:last-child').removeClass('opacity-0 translate-y-4').addClass('opacity-100 translate-y-0');
        $('#search-icon-open').removeClass('opacity-100 rotate-0').addClass('opacity-0 rotate-180');
        $('#search-icon-close').removeClass('opacity-0 -rotate-180').addClass('opacity-100 rotate-0');
        $('#search-input').focus();
      }
      updateNavbarStyle();
    }
    function updateNavbarStyle() {
      var isMenuOpen = megaMenu.hasClass('visible');
      var isSearchOpen = searchModal.hasClass('visible');
      var scrolled = window.scrollY > 50;
      var logo = $('#navbar-logo');
      var icons = $('#menu-toggle, #search-button');
      if (isMenuOpen || isSearchOpen) {
        navbar.attr('class', 'fixed top-0 w-full z-50 transition-all duration-500 ease-out translate-y-0 bg-black/95 backdrop-blur-xl border-b border-white/10');
        logo.attr('class', 'text-xl font-bold tracking-tight transition-all duration-500 text-white');
        icons.attr('class', 'transition-all duration-500 z-60 relative text-white hover:text-gray-300');
        return;
      }
      if (isHomepage) {
        if (scrolled) {
          navbar.attr('class', 'fixed top-0 w-full z-50 transition-all duration-500 ease-out translate-y-0 bg-black/30 backdrop-blur-xl border-b border-white/20');
          logo.attr('class', 'text-xl font-bold tracking-tight transition-all duration-500 text-white/95');
          icons.attr('class', 'transition-all duration-500 z-60 relative text-white/95 hover:text-white');
        } else {
          navbar.attr('class', 'fixed top-0 w-full z-50 transition-all duration-500 ease-out translate-y-0 bg-transparent');
          logo.attr('class', 'text-xl font-bold tracking-tight transition-all duration-500 text-white');
          icons.attr('class', 'transition-all duration-500 z-60 relative text-white hover:text-gray-300');
        }
      } else {
        if (scrolled) {
          navbar.attr('class', 'fixed top-0 w-full z-50 transition-all duration-500 ease-out translate-y-0 bg-white/80 backdrop-blur-xl border-b border-gray-200/50 shadow-lg');
        } else {
          navbar.attr('class', 'fixed top-0 w-full z-50 transition-all duration-500 ease-out translate-y-0 bg-white border-b border-gray-200');
        }
        logo.attr('class', 'text-xl font-bold tracking-tight transition-all duration-500 text-black');
        icons.attr('class', 'transition-all duration-500 z-60 relative text-black hover:text-gray-700');
      }
    }
    menuButton.on('click', function () {
      return toggleMenu();
    });
    searchButton.on('click', function () {
      return toggleSearch();
    });
    $(window).on('scroll', function () {
      var currentScrollY = window.scrollY;
      if (currentScrollY < 10) {
        navbar.removeClass('-translate-y-full');
      } else if (currentScrollY < lastScrollY) {
        navbar.removeClass('-translate-y-full');
      } else if (currentScrollY > lastScrollY && currentScrollY > 100) {
        navbar.addClass('-translate-y-full');
      }
      lastScrollY = currentScrollY;
      updateNavbarStyle();
    });

    // Mock search logic
    // In a real Laravel app, you'd use an AJAX call to a search route.
    // For this conversion, we'll mimic the JS logic with a hardcoded object.
    var searchData = {/* ... copy searchData object from Navbar.tsx ... */};
    $('#search-input').on('keyup', function () {
      var query = $(this).val().toLowerCase();
      var resultsContainer = $('#search-results-container');
      // Implement search and render logic here...
      if (query.length > 2) {
        resultsContainer.html("<p class=\"text-white\">Searching for \"".concat(query, "\"...</p>"));
      } else {
        resultsContainer.html('<p class="text-gray-400 text-center">Start typing to search...</p>');
      }
    });
    $('#search-form').on('submit', function (e) {
      return e.preventDefault();
    });
  }

  // --- Homepage Logic ---
  function handleHomepage() {
    if (!$('#hero-section').length) return;
    var currentSlide = 0;
    var slides = $('.hero-slide-content');
    var slideBgs = $('.hero-slide-bg');
    var indicators = $('.slide-indicator');
    var slideCount = slides.length;
    var counter = $('#slide-counter');
    function showSlide(index) {
      // Content
      slides.filter("[data-index=".concat(currentSlide, "]")).fadeOut(800, function () {
        $(this).addClass('hidden');
      });
      slides.filter("[data-index=".concat(index, "]")).fadeIn(800).removeClass('hidden');

      // Background
      slideBgs.filter("[data-index=".concat(currentSlide, "]")).removeClass('opacity-60').addClass('opacity-0');
      slideBgs.filter("[data-index=".concat(index, "]")).removeClass('opacity-0').addClass('opacity-60');

      // Indicators
      indicators.filter("[data-index=".concat(currentSlide, "]")).removeClass('bg-white scale-110').addClass('bg-white/30');
      indicators.filter("[data-index=".concat(index, "]")).removeClass('bg-white/30').addClass('bg-white scale-110');
      currentSlide = index;

      // Counter
      var counterText = String(currentSlide + 1).padStart(2, '0') + ' — ' + String(slideCount).padStart(2, '0');
      counter.text(counterText);
    }
    var slideInterval = setInterval(function () {
      var nextSlide = (currentSlide + 1) % slideCount;
      showSlide(nextSlide);
    }, 4000);
    indicators.on('click', function () {
      var index = $(this).data('index');
      clearInterval(slideInterval); // Optional: stop auto-slide on manual interaction
      showSlide(index);
    });

    // Video load
    $('#hero-video').on('loadeddata', function () {
      $(this).removeClass('opacity-0').addClass('opacity-100');
    });

    // Smooth scroll
    $('#scroll-to-next').on('click', function () {
      $('html, body').animate({
        scrollTop: $('#shop-section').offset().top
      }, 1000);
    });
  }

  // Initialize all handlers
  handleNavbar();
  handleHomepage();
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;