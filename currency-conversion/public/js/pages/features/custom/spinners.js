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
/******/ 	return __webpack_require__(__webpack_require__.s = 141);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/custom/spinners.js":
/*!*****************************************************************!*\
  !*** ./resources/metronic/js/pages/features/custom/spinners.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTSpinnersDemo = function () {\n  // Private functions\n  // Demos\n  var demo1 = function demo1() {\n    // Demo 1\n    var btn = KTUtil.getById(\"kt_btn_1\");\n    KTUtil.addEvent(btn, \"click\", function () {\n      KTUtil.btnWait(btn, \"spinner spinner-right spinner-white pr-15\", \"Please wait\");\n      setTimeout(function () {\n        KTUtil.btnRelease(btn);\n      }, 1000);\n    });\n  };\n\n  var demo2 = function demo2() {\n    // Demo 2\n    var btn = KTUtil.getById(\"kt_btn_2\");\n    KTUtil.addEvent(btn, \"click\", function () {\n      KTUtil.btnWait(btn, \"spinner spinner-dark spinner-right pr-15\", \"Loading\");\n      setTimeout(function () {\n        KTUtil.btnRelease(btn);\n      }, 1000);\n    });\n  };\n\n  var demo3 = function demo3() {\n    // Demo 3\n    var btn = KTUtil.getById(\"kt_btn_3\");\n    KTUtil.addEvent(btn, \"click\", function () {\n      KTUtil.btnWait(btn, \"spinner spinner-left spinner-darker-success pl-15\", \"Disabled...\");\n      setTimeout(function () {\n        KTUtil.btnRelease(btn);\n      }, 1000);\n    });\n  };\n\n  var demo4 = function demo4() {\n    // Demo 4\n    var btn = KTUtil.getById(\"kt_btn_4\");\n    KTUtil.addEvent(btn, \"click\", function () {\n      KTUtil.btnWait(btn, \"spinner spinner-left spinner-darker-danger pl-15\", \"Please wait\");\n      setTimeout(function () {\n        KTUtil.btnRelease(btn);\n      }, 1000);\n    });\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demo1();\n      demo2();\n      demo3();\n      demo4();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTSpinnersDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvY3VzdG9tL3NwaW5uZXJzLmpzPzlmYjciXSwibmFtZXMiOlsiS1RTcGlubmVyc0RlbW8iLCJkZW1vMSIsImJ0biIsIktUVXRpbCIsImdldEJ5SWQiLCJhZGRFdmVudCIsImJ0bldhaXQiLCJzZXRUaW1lb3V0IiwiYnRuUmVsZWFzZSIsImRlbW8yIiwiZGVtbzMiLCJkZW1vNCIsImluaXQiLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQ0FFQTs7QUFFQSxJQUFJQSxjQUFjLEdBQUcsWUFBWTtBQUM3QjtBQUVBO0FBQ0EsTUFBSUMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBWTtBQUNwQjtBQUNBLFFBQUlDLEdBQUcsR0FBR0MsTUFBTSxDQUFDQyxPQUFQLENBQWUsVUFBZixDQUFWO0FBRUFELFVBQU0sQ0FBQ0UsUUFBUCxDQUFnQkgsR0FBaEIsRUFBcUIsT0FBckIsRUFBOEIsWUFBVztBQUNyQ0MsWUFBTSxDQUFDRyxPQUFQLENBQWVKLEdBQWYsRUFBb0IsMkNBQXBCLEVBQWlFLGFBQWpFO0FBRUFLLGdCQUFVLENBQUMsWUFBVztBQUNsQkosY0FBTSxDQUFDSyxVQUFQLENBQWtCTixHQUFsQjtBQUNILE9BRlMsRUFFUCxJQUZPLENBQVY7QUFHSCxLQU5EO0FBT0gsR0FYRDs7QUFhQSxNQUFJTyxLQUFLLEdBQUcsU0FBUkEsS0FBUSxHQUFZO0FBQ3BCO0FBQ0EsUUFBSVAsR0FBRyxHQUFHQyxNQUFNLENBQUNDLE9BQVAsQ0FBZSxVQUFmLENBQVY7QUFFQUQsVUFBTSxDQUFDRSxRQUFQLENBQWdCSCxHQUFoQixFQUFxQixPQUFyQixFQUE4QixZQUFXO0FBQ3JDQyxZQUFNLENBQUNHLE9BQVAsQ0FBZUosR0FBZixFQUFvQiwwQ0FBcEIsRUFBZ0UsU0FBaEU7QUFFQUssZ0JBQVUsQ0FBQyxZQUFXO0FBQ2xCSixjQUFNLENBQUNLLFVBQVAsQ0FBa0JOLEdBQWxCO0FBQ0gsT0FGUyxFQUVQLElBRk8sQ0FBVjtBQUdILEtBTkQ7QUFPSCxHQVhEOztBQWFBLE1BQUlRLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVk7QUFDcEI7QUFDQSxRQUFJUixHQUFHLEdBQUdDLE1BQU0sQ0FBQ0MsT0FBUCxDQUFlLFVBQWYsQ0FBVjtBQUVBRCxVQUFNLENBQUNFLFFBQVAsQ0FBZ0JILEdBQWhCLEVBQXFCLE9BQXJCLEVBQThCLFlBQVc7QUFDckNDLFlBQU0sQ0FBQ0csT0FBUCxDQUFlSixHQUFmLEVBQW9CLG1EQUFwQixFQUF5RSxhQUF6RTtBQUVBSyxnQkFBVSxDQUFDLFlBQVc7QUFDbEJKLGNBQU0sQ0FBQ0ssVUFBUCxDQUFrQk4sR0FBbEI7QUFDSCxPQUZTLEVBRVAsSUFGTyxDQUFWO0FBR0gsS0FORDtBQU9ILEdBWEQ7O0FBYUEsTUFBSVMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBWTtBQUNwQjtBQUNBLFFBQUlULEdBQUcsR0FBR0MsTUFBTSxDQUFDQyxPQUFQLENBQWUsVUFBZixDQUFWO0FBRUFELFVBQU0sQ0FBQ0UsUUFBUCxDQUFnQkgsR0FBaEIsRUFBcUIsT0FBckIsRUFBOEIsWUFBVztBQUNyQ0MsWUFBTSxDQUFDRyxPQUFQLENBQWVKLEdBQWYsRUFBb0Isa0RBQXBCLEVBQXdFLGFBQXhFO0FBRUFLLGdCQUFVLENBQUMsWUFBVztBQUNsQkosY0FBTSxDQUFDSyxVQUFQLENBQWtCTixHQUFsQjtBQUNILE9BRlMsRUFFUCxJQUZPLENBQVY7QUFHSCxLQU5EO0FBT0gsR0FYRDs7QUFhQSxTQUFPO0FBQ0g7QUFDQVUsUUFBSSxFQUFFLGdCQUFXO0FBQ2JYLFdBQUs7QUFDTFEsV0FBSztBQUNMQyxXQUFLO0FBQ0xDLFdBQUs7QUFDUjtBQVBFLEdBQVA7QUFTSCxDQWpFb0IsRUFBckI7O0FBbUVBRSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QmYsZ0JBQWMsQ0FBQ1ksSUFBZjtBQUNILENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvY3VzdG9tL3NwaW5uZXJzLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcblxyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcblxyXG52YXIgS1RTcGlubmVyc0RlbW8gPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAvLyBQcml2YXRlIGZ1bmN0aW9uc1xyXG5cclxuICAgIC8vIERlbW9zXHJcbiAgICB2YXIgZGVtbzEgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgLy8gRGVtbyAxXHJcbiAgICAgICAgdmFyIGJ0biA9IEtUVXRpbC5nZXRCeUlkKFwia3RfYnRuXzFcIik7XHJcblxyXG4gICAgICAgIEtUVXRpbC5hZGRFdmVudChidG4sIFwiY2xpY2tcIiwgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIEtUVXRpbC5idG5XYWl0KGJ0biwgXCJzcGlubmVyIHNwaW5uZXItcmlnaHQgc3Bpbm5lci13aGl0ZSBwci0xNVwiLCBcIlBsZWFzZSB3YWl0XCIpO1xyXG5cclxuICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgIEtUVXRpbC5idG5SZWxlYXNlKGJ0bik7XHJcbiAgICAgICAgICAgIH0sIDEwMDApO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHZhciBkZW1vMiA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAvLyBEZW1vIDJcclxuICAgICAgICB2YXIgYnRuID0gS1RVdGlsLmdldEJ5SWQoXCJrdF9idG5fMlwiKTtcclxuXHJcbiAgICAgICAgS1RVdGlsLmFkZEV2ZW50KGJ0biwgXCJjbGlja1wiLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgS1RVdGlsLmJ0bldhaXQoYnRuLCBcInNwaW5uZXIgc3Bpbm5lci1kYXJrIHNwaW5uZXItcmlnaHQgcHItMTVcIiwgXCJMb2FkaW5nXCIpO1xyXG5cclxuICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgIEtUVXRpbC5idG5SZWxlYXNlKGJ0bik7XHJcbiAgICAgICAgICAgIH0sIDEwMDApO1xyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHZhciBkZW1vMyA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAvLyBEZW1vIDNcclxuICAgICAgICB2YXIgYnRuID0gS1RVdGlsLmdldEJ5SWQoXCJrdF9idG5fM1wiKTtcclxuXHJcbiAgICAgICAgS1RVdGlsLmFkZEV2ZW50KGJ0biwgXCJjbGlja1wiLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgS1RVdGlsLmJ0bldhaXQoYnRuLCBcInNwaW5uZXIgc3Bpbm5lci1sZWZ0IHNwaW5uZXItZGFya2VyLXN1Y2Nlc3MgcGwtMTVcIiwgXCJEaXNhYmxlZC4uLlwiKTtcclxuXHJcbiAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICBLVFV0aWwuYnRuUmVsZWFzZShidG4pO1xyXG4gICAgICAgICAgICB9LCAxMDAwKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgZGVtbzQgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgLy8gRGVtbyA0XHJcbiAgICAgICAgdmFyIGJ0biA9IEtUVXRpbC5nZXRCeUlkKFwia3RfYnRuXzRcIik7XHJcblxyXG4gICAgICAgIEtUVXRpbC5hZGRFdmVudChidG4sIFwiY2xpY2tcIiwgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIEtUVXRpbC5idG5XYWl0KGJ0biwgXCJzcGlubmVyIHNwaW5uZXItbGVmdCBzcGlubmVyLWRhcmtlci1kYW5nZXIgcGwtMTVcIiwgXCJQbGVhc2Ugd2FpdFwiKTtcclxuXHJcbiAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICBLVFV0aWwuYnRuUmVsZWFzZShidG4pO1xyXG4gICAgICAgICAgICB9LCAxMDAwKTtcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIHB1YmxpYyBmdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZGVtbzEoKTtcclxuICAgICAgICAgICAgZGVtbzIoKTtcclxuICAgICAgICAgICAgZGVtbzMoKTtcclxuICAgICAgICAgICAgZGVtbzQoKTtcclxuICAgICAgICB9XHJcbiAgICB9O1xyXG59KCk7XHJcblxyXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gICAgS1RTcGlubmVyc0RlbW8uaW5pdCgpO1xyXG59KTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/custom/spinners.js\n");

/***/ }),

/***/ 141:
/*!***********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/custom/spinners.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\features\custom\spinners.js */"./resources/metronic/js/pages/features/custom/spinners.js");


/***/ })

/******/ });