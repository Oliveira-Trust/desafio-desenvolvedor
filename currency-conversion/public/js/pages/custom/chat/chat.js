/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 97);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/chat/chat.js":
/*!*********************************************************!*\
  !*** ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTAppChat = function () {\n  var _chatAsideEl;\n\n  var _chatAsideOffcanvasObj;\n\n  var _chatContentEl; // Private functions\n\n\n  var _initAside = function _initAside() {\n    // Mobile offcanvas for mobile mode\n    _chatAsideOffcanvasObj = new KTOffcanvas(_chatAsideEl, {\n      overlay: true,\n      baseClass: 'offcanvas-mobile',\n      //closeBy: 'kt_chat_aside_close',\n      toggleBy: 'kt_app_chat_toggle'\n    }); // User listing\n\n    var cardScrollEl = KTUtil.find(_chatAsideEl, '.scroll');\n    var cardBodyEl = KTUtil.find(_chatAsideEl, '.card-body');\n    var searchEl = KTUtil.find(_chatAsideEl, '.input-group');\n\n    if (cardScrollEl) {\n      // Initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)\n      KTUtil.scrollInit(cardScrollEl, {\n        mobileNativeScroll: true,\n        // Enable native scroll for mobile\n        desktopNativeScroll: false,\n        // Disable native scroll and use custom scroll for desktop\n        resetHeightOnDestroy: true,\n        // Reset css height on scroll feature destroyed\n        handleWindowResize: true,\n        // Recalculate hight on window resize\n        rememberPosition: true,\n        // Remember scroll position in cookie\n        height: function height() {\n          // Calculate height\n          var height;\n\n          if (KTUtil.isBreakpointUp('lg')) {\n            height = KTLayoutContent.getHeight();\n          } else {\n            height = KTUtil.getViewPort().height;\n          }\n\n          if (_chatAsideEl) {\n            height = height - parseInt(KTUtil.css(_chatAsideEl, 'margin-top')) - parseInt(KTUtil.css(_chatAsideEl, 'margin-bottom'));\n            height = height - parseInt(KTUtil.css(_chatAsideEl, 'padding-top')) - parseInt(KTUtil.css(_chatAsideEl, 'padding-bottom'));\n          }\n\n          if (cardScrollEl) {\n            height = height - parseInt(KTUtil.css(cardScrollEl, 'margin-top')) - parseInt(KTUtil.css(cardScrollEl, 'margin-bottom'));\n          }\n\n          if (cardBodyEl) {\n            height = height - parseInt(KTUtil.css(cardBodyEl, 'padding-top')) - parseInt(KTUtil.css(cardBodyEl, 'padding-bottom'));\n          }\n\n          if (searchEl) {\n            height = height - parseInt(KTUtil.css(searchEl, 'height'));\n            height = height - parseInt(KTUtil.css(searchEl, 'margin-top')) - parseInt(KTUtil.css(searchEl, 'margin-bottom'));\n          } // Remove additional space\n\n\n          height = height - 2;\n          return height;\n        }\n      });\n    }\n  };\n\n  return {\n    // Public functions\n    init: function init() {\n      // Elements\n      _chatAsideEl = KTUtil.getById('kt_chat_aside');\n      _chatContentEl = KTUtil.getById('kt_chat_content'); // Init aside and user list\n\n      _initAside(); // Init inline chat example\n\n\n      KTLayoutChat.setup(KTUtil.getById('kt_chat_content')); // Trigger click to show popup modal chat on page load\n\n      if (KTUtil.getById('kt_app_chat_toggle')) {\n        setTimeout(function () {\n          KTUtil.getById('kt_app_chat_toggle').click();\n        }, 1000);\n      }\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTAppChat.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL2NoYXQvY2hhdC5qcz8xY2IyIl0sIm5hbWVzIjpbIktUQXBwQ2hhdCIsIl9jaGF0QXNpZGVFbCIsIl9jaGF0QXNpZGVPZmZjYW52YXNPYmoiLCJfY2hhdENvbnRlbnRFbCIsIl9pbml0QXNpZGUiLCJLVE9mZmNhbnZhcyIsIm92ZXJsYXkiLCJiYXNlQ2xhc3MiLCJ0b2dnbGVCeSIsImNhcmRTY3JvbGxFbCIsIktUVXRpbCIsImZpbmQiLCJjYXJkQm9keUVsIiwic2VhcmNoRWwiLCJzY3JvbGxJbml0IiwibW9iaWxlTmF0aXZlU2Nyb2xsIiwiZGVza3RvcE5hdGl2ZVNjcm9sbCIsInJlc2V0SGVpZ2h0T25EZXN0cm95IiwiaGFuZGxlV2luZG93UmVzaXplIiwicmVtZW1iZXJQb3NpdGlvbiIsImhlaWdodCIsImlzQnJlYWtwb2ludFVwIiwiS1RMYXlvdXRDb250ZW50IiwiZ2V0SGVpZ2h0IiwiZ2V0Vmlld1BvcnQiLCJwYXJzZUludCIsImNzcyIsImluaXQiLCJnZXRCeUlkIiwiS1RMYXlvdXRDaGF0Iiwic2V0dXAiLCJzZXRUaW1lb3V0IiwiY2xpY2siLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQ0FFQTs7QUFDQSxJQUFJQSxTQUFTLEdBQUcsWUFBWTtBQUMzQixNQUFJQyxZQUFKOztBQUNBLE1BQUlDLHNCQUFKOztBQUNBLE1BQUlDLGNBQUosQ0FIMkIsQ0FLM0I7OztBQUNBLE1BQUlDLFVBQVUsR0FBRyxTQUFiQSxVQUFhLEdBQVk7QUFDNUI7QUFDQUYsMEJBQXNCLEdBQUcsSUFBSUcsV0FBSixDQUFnQkosWUFBaEIsRUFBOEI7QUFDdERLLGFBQU8sRUFBRSxJQUQ2QztBQUU3Q0MsZUFBUyxFQUFFLGtCQUZrQztBQUc3QztBQUNBQyxjQUFRLEVBQUU7QUFKbUMsS0FBOUIsQ0FBekIsQ0FGNEIsQ0FTNUI7O0FBQ0EsUUFBSUMsWUFBWSxH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QVAsQ0FBZSxlQUFmLENBQWY7QUFDQXpCLG9CQUFjLEdBQUdPLE1BQU0sQ0FBQ2tCLE9BQVAsQ0FBZSxpQkFBZixDQUFqQixDQUhnQixDQUtoQjs7QUFDQXhCLGdCQUFVLEdBTk0sQ0FRaEI7OztBQUNBeUIsa0JBQVksQ0FBQ0MsS0FBYixDQUFtQnBCLE1BQU0sQ0FBQ2tCLE9BQVAsQ0FBZSxpQkFBZixDQUFuQixFQVRnQixDQVdoQjs7QUFDQSxVQUFJbEIsTUFBTSxDQUFDa0IsT0FBUCxDQUFlLG9CQUFmLENBQUosRUFBMEM7QUFDekNHLGtCQUFVLENBQUMsWUFBVztBQUNyQnJCLGdCQUFNLENBQUNrQixPQUFQLENBQWUsb0JBQWYsRUFBcUNJLEtBQXJDO0FBQ0EsU0FGUyxFQUVQLElBRk8sQ0FBVjtBQUdBO0FBQ0Q7QUFuQkssR0FBUDtBQXFCQSxDQXJGZSxFQUFoQjs7QUF1RkFDLE1BQU0sQ0FBQ0MsUUFBRCxDQUFOLENBQWlCQyxLQUFqQixDQUF1QixZQUFXO0FBQ2pDbkMsV0FBUyxDQUFDMkIsSUFBVjtBQUNBLENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL2NoYXQvY2hhdC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG5cclxuLy8gQ2xhc3MgZGVmaW5pdGlvblxyXG52YXIgS1RBcHBDaGF0ID0gZnVuY3Rpb24gKCkge1xyXG5cdHZhciBfY2hhdEFzaWRlRWw7XHJcblx0dmFyIF9jaGF0QXNpZGVPZmZjYW52YXNPYmo7XHJcblx0dmFyIF9jaGF0Q29udGVudEVsO1xyXG5cclxuXHQvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG5cdHZhciBfaW5pdEFzaWRlID0gZnVuY3Rpb24gKCkge1xyXG5cdFx0Ly8gTW9iaWxlIG9mZmNhbnZhcyBmb3IgbW9iaWxlIG1vZGVcclxuXHRcdF9jaGF0QXNpZGVPZmZjYW52YXNPYmogPSBuZXcgS1RPZmZjYW52YXMoX2NoYXRBc2lkZUVsLCB7XHJcblx0XHRcdG92ZXJsYXk6IHRydWUsXHJcbiAgICAgICAgICAgIGJhc2VDbGFzczogJ29mZmNhbnZhcy1tb2JpbGUnLFxyXG4gICAgICAgICAgICAvL2Nsb3NlQnk6ICdrdF9jaGF0X2FzaWRlX2Nsb3NlJyxcclxuICAgICAgICAgICAgdG9nZ2xlQnk6ICdrdF9hcHBfY2hhdF90b2dnbGUnXHJcbiAgICAgICAgfSk7XHJcblxyXG5cdFx0Ly8gVXNlciBsaXN0aW5nXHJcblx0XHR2YXIgY2FyZFNjcm9sbEVsID0gS1RVdGlsLmZpbmQoX2NoYXRBc2lkZUVsLCAnLnNjcm9sbCcpO1xyXG5cdFx0dmFyIGNhcmRCb2R5RWwgPSBLVFV0aWwuZmluZChfY2hhdEFzaWRlRWwsICcuY2FyZC1ib2R5Jyk7XHJcblx0XHR2YXIgc2VhcmNoRWwgPSBLVFV0aWwuZmluZChfY2hhdEFzaWRlRWwsICcuaW5wdXQtZ3JvdXAnKTtcclxuXHJcblx0XHRpZiAoY2FyZFNjcm9sbEVsKSB7XHJcblx0XHRcdC8vIEluaXRpYWxpemUgcGVyZmVjdCBzY3JvbGxiYXIoc2VlOiAgaHR0cHM6Ly9naXRodWIuY29tL3V0YXR0aS9wZXJmZWN0LXNjcm9sbGJhcilcclxuXHRcdFx0S1RVdGlsLnNjcm9sbEluaXQoY2FyZFNjcm9sbEVsLCB7XHJcblx0XHRcdFx0bW9iaWxlTmF0aXZlU2Nyb2xsOiB0cnVlLCAgLy8gRW5hYmxlIG5hdGl2ZSBzY3JvbGwgZm9yIG1vYmlsZVxyXG5cdFx0XHRcdGRlc2t0b3BOYXRpdmVTY3JvbGw6IGZhbHNlLCAvLyBEaXNhYmxlIG5hdGl2ZSBzY3JvbGwgYW5kIHVzZSBjdXN0b20gc2Nyb2xsIGZvciBkZXNrdG9wXHJcblx0XHRcdFx0cmVzZXRIZWlnaHRPbkRlc3Ryb3k6IHRydWUsICAvLyBSZXNldCBjc3MgaGVpZ2h0IG9uIHNjcm9sbCBmZWF0dXJlIGRlc3Ryb3llZFxyXG5cdFx0XHRcdGhhbmRsZVdpbmRvd1Jlc2l6ZTogdHJ1ZSwgLy8gUmVjYWxjdWxhdGUgaGlnaHQgb24gd2luZG93IHJlc2l6ZVxyXG5cdFx0XHRcdHJlbWVtYmVyUG9zaXRpb246IHRydWUsIC8vIFJlbWVtYmVyIHNjcm9sbCBwb3NpdGlvbiBpbiBjb29raWVcclxuXHRcdFx0XHRoZWlnaHQ6IGZ1bmN0aW9uKCkgeyAgLy8gQ2FsY3VsYXRlIGhlaWdodFxyXG5cdFx0XHRcdFx0dmFyIGhlaWdodDtcclxuXHJcblx0XHRcdFx0XHRpZiAoS1RVdGlsLmlzQnJlYWtwb2ludFVwKCdsZycpKSB7XHJcblx0XHRcdFx0XHRcdGhlaWdodCA9IEtUTGF5b3V0Q29udGVudC5nZXRIZWlnaHQoKTtcclxuXHRcdFx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0XHRcdGhlaWdodCA9IEtUVXRpbC5nZXRWaWV3UG9ydCgpLmhlaWdodDtcclxuXHRcdFx0XHRcdH1cclxuXHJcblx0XHRcdFx0XHRpZiAoX2NoYXRBc2lkZUVsKSB7XHJcblx0XHRcdFx0XHRcdGhlaWdodCA9IGhlaWdodCAtIHBhcnNlSW50KEtUVXRpbC5jc3MoX2NoYXRBc2lkZUVsLCAnbWFyZ2luLXRvcCcpKSAtIHBhcnNlSW50KEtUVXRpbC5jc3MoX2NoYXRBc2lkZUVsLCAnbWFyZ2luLWJvdHRvbScpKTtcclxuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhfY2hhdEFzaWRlRWwsICdwYWRkaW5nLXRvcCcpKSAtIHBhcnNlSW50KEtUVXRpbC5jc3MoX2NoYXRBc2lkZUVsLCAncGFkZGluZy1ib3R0b20nKSk7XHJcblx0XHRcdFx0XHR9XHJcblxyXG5cdFx0XHRcdFx0aWYgKGNhcmRTY3JvbGxFbCkge1xyXG5cdFx0XHRcdFx0XHRoZWlnaHQgPSBoZWlnaHQgLSBwYXJzZUludChLVFV0aWwuY3NzKGNhcmRTY3JvbGxFbCwgJ21hcmdpbi10b3AnKSkgLSBwYXJzZUludChLVFV0aWwuY3NzKGNhcmRTY3JvbGxFbCwgJ21hcmdpbi1ib3R0b20nKSk7XHJcblx0XHRcdFx0XHR9XHJcblxyXG5cdFx0XHRcdFx0aWYgKGNhcmRCb2R5RWwpIHtcclxuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhjYXJkQm9keUVsLCAncGFkZGluZy10b3AnKSkgLSBwYXJzZUludChLVFV0aWwuY3NzKGNhcmRCb2R5RWwsICdwYWRkaW5nLWJvdHRvbScpKTtcclxuXHRcdFx0XHRcdH1cclxuXHJcblx0XHRcdFx0XHRpZiAoc2VhcmNoRWwpIHtcclxuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhzZWFyY2hFbCwgJ2hlaWdodCcpKTtcclxuXHRcdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gcGFyc2VJbnQoS1RVdGlsLmNzcyhzZWFyY2hFbCwgJ21hcmdpbi10b3AnKSkgLSBwYXJzZUludChLVFV0aWwuY3NzKHNlYXJjaEVsLCAnbWFyZ2luLWJvdHRvbScpKTtcclxuXHRcdFx0XHRcdH1cclxuXHJcblx0XHRcdFx0XHQvLyBSZW1vdmUgYWRkaXRpb25hbCBzcGFjZVxyXG5cdFx0XHRcdFx0aGVpZ2h0ID0gaGVpZ2h0IC0gMjtcclxuXHJcblx0XHRcdFx0XHRyZXR1cm4gaGVpZ2h0O1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0fSk7XHJcblx0XHR9XHJcblx0fVxyXG5cclxuXHRyZXR1cm4ge1xyXG5cdFx0Ly8gUHVibGljIGZ1bmN0aW9uc1xyXG5cdFx0aW5pdDogZnVuY3Rpb24oKSB7XHJcblx0XHRcdC8vIEVsZW1lbnRzXHJcblx0XHRcdF9jaGF0QXNpZGVFbCA9IEtUVXRpbC5nZXRCeUlkKCdrdF9jaGF0X2FzaWRlJyk7XHJcblx0XHRcdF9jaGF0Q29udGVudEVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X2NoYXRfY29udGVudCcpO1xyXG5cclxuXHRcdFx0Ly8gSW5pdCBhc2lkZSBhbmQgdXNlciBsaXN0XHJcblx0XHRcdF9pbml0QXNpZGUoKTtcclxuXHJcblx0XHRcdC8vIEluaXQgaW5saW5lIGNoYXQgZXhhbXBsZVxyXG5cdFx0XHRLVExheW91dENoYXQuc2V0dXAoS1RVdGlsLmdldEJ5SWQoJ2t0X2NoYXRfY29udGVudCcpKTtcclxuXHJcblx0XHRcdC8vIFRyaWdnZXIgY2xpY2sgdG8gc2hvdyBwb3B1cCBtb2RhbCBjaGF0IG9uIHBhZ2UgbG9hZFxyXG5cdFx0XHRpZiAoS1RVdGlsLmdldEJ5SWQoJ2t0X2FwcF9jaGF0X3RvZ2dsZScpKSB7XHJcblx0XHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuXHRcdFx0XHRcdEtUVXRpbC5nZXRCeUlkKCdrdF9hcHBfY2hhdF90b2dnbGUnKS5jbGljaygpO1xyXG5cdFx0XHRcdH0sIDEwMDApO1xyXG5cdFx0XHR9XHJcblx0XHR9XHJcblx0fTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuXHRLVEFwcENoYXQuaW5pdCgpO1xyXG59KTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/custom/chat/chat.js\n");

/***/ }),

/***/ 97:
/*!***************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\custom\chat\chat.js */"./resources/metronic/js/pages/custom/chat/chat.js");


/***/ })

/******/ });