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
/******/ 	return __webpack_require__(__webpack_require__.s = 153);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/session-timeout.js":
/*!*******************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/session-timeout.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar KTSessionTimeoutDemo = function () {\n  var initDemo = function initDemo() {\n    $.sessionTimeout({\n      title: 'Session Timeout Notification',\n      message: 'Your session is about to expire.',\n      keepAliveUrl: HOST_URL + '/api//session-timeout/keepalive.php',\n      redirUrl: '?p=page_user_lock_1',\n      logoutUrl: '?p=page_user_login_1',\n      warnAfter: 5000,\n      //warn after 5 seconds\n      redirAfter: 15000,\n      //redirect after 15 secons,\n      ignoreUserActivity: true,\n      countdownMessage: 'Redirecting in {timer} seconds.',\n      countdownBar: true\n    });\n  };\n\n  return {\n    //main function to initiate the module\n    init: function init() {\n      initDemo();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTSessionTimeoutDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanM/NjU5YiJdLCJuYW1lcyI6WyJLVFNlc3Npb25UaW1lb3V0RGVtbyIsImluaXREZW1vIiwiJCIsInNlc3Npb25UaW1lb3V0IiwidGl0bGUiLCJtZXNzYWdlIiwia2VlcEFsaXZlVXJsIiwiSE9TVF9VUkwiLCJyZWRpclVybCIsImxvZ291dFVybCIsIndhcm5BZnRlciIsInJlZGlyQWZ0ZXIiLCJpZ25vcmVVc2VyQWN0aXZpdHkiLCJjb3VudGRvd25NZXNzYWdlIiwiY291bnRkb3duQmFyIiwiaW5pdCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwibWFwcGluZ3MiOiJBQUFhOztBQUViLElBQUlBLG9CQUFvQixHQUFHLFlBQVk7QUFDbkMsTUFBSUMsUUFBUSxHQUFHLFNBQVhBLFFBQVcsR0FBWTtBQUN2QkMsS0FBQyxDQUFDQyxjQUFGLENBQWlCO0FBQ2JDLFdBQUssRUFBRSw4QkFETTtBQUViQyxhQUFPLEVBQUUsa0NBRkk7QUFHYkMsa0JBQVksRUFBRUMsUUFBUSxHQUFHLHFDQUhaO0FBSWJDLGNBQVEsRUFBRSxxQkFKRztBQUtiQyxlQUFTLEVBQUUsc0JBTEU7QUFNYkMsZUFBUyxFQUFFLElBTkU7QUFNSTtBQUNqQkMsZ0JBQVUsRUFBRSxLQVBDO0FBT007QUFDbkJDLHdCQUFrQixFQUFFLElBUlA7QUFTYkMsc0JBQWdCLEVBQUUsaUNBVEw7QUFVYkMsa0JBQVksRUFBRTtBQVZELEtBQWpCO0FBWUgsR0FiRDs7QUFlQSxTQUFPO0FBQ0g7QUFDQUMsUUFBSSxFQUFFLGdCQUFZO0FBQ2RkLGNBQVE7QUFDWDtBQUpFLEdBQVA7QUFNSCxDQXRCMEIsRUFBM0I7O0FBd0JBZSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QmxCLHNCQUFvQixDQUFDZSxJQUFyQjtBQUNILENBRkQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9zZXNzaW9uLXRpbWVvdXQuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbnZhciBLVFNlc3Npb25UaW1lb3V0RGVtbyA9IGZ1bmN0aW9uICgpIHtcclxuICAgIHZhciBpbml0RGVtbyA9IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAkLnNlc3Npb25UaW1lb3V0KHtcclxuICAgICAgICAgICAgdGl0bGU6ICdTZXNzaW9uIFRpbWVvdXQgTm90aWZpY2F0aW9uJyxcclxuICAgICAgICAgICAgbWVzc2FnZTogJ1lvdXIgc2Vzc2lvbiBpcyBhYm91dCB0byBleHBpcmUuJyxcclxuICAgICAgICAgICAga2VlcEFsaXZlVXJsOiBIT1NUX1VSTCArICcvYXBpLy9zZXNzaW9uLXRpbWVvdXQva2VlcGFsaXZlLnBocCcsXHJcbiAgICAgICAgICAgIHJlZGlyVXJsOiAnP3A9cGFnZV91c2VyX2xvY2tfMScsXHJcbiAgICAgICAgICAgIGxvZ291dFVybDogJz9wPXBhZ2VfdXNlcl9sb2dpbl8xJyxcclxuICAgICAgICAgICAgd2FybkFmdGVyOiA1MDAwLCAvL3dhcm4gYWZ0ZXIgNSBzZWNvbmRzXHJcbiAgICAgICAgICAgIHJlZGlyQWZ0ZXI6IDE1MDAwLCAvL3JlZGlyZWN0IGFmdGVyIDE1IHNlY29ucyxcclxuICAgICAgICAgICAgaWdub3JlVXNlckFjdGl2aXR5OiB0cnVlLFxyXG4gICAgICAgICAgICBjb3VudGRvd25NZXNzYWdlOiAnUmVkaXJlY3RpbmcgaW4ge3RpbWVyfSBzZWNvbmRzLicsXHJcbiAgICAgICAgICAgIGNvdW50ZG93bkJhcjogdHJ1ZVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgLy9tYWluIGZ1bmN0aW9uIHRvIGluaXRpYXRlIHRoZSBtb2R1bGVcclxuICAgICAgICBpbml0OiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIGluaXREZW1vKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUU2Vzc2lvblRpbWVvdXREZW1vLmluaXQoKTtcclxufSk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/miscellaneous/session-timeout.js\n");

/***/ }),

/***/ 153:
/*!*************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/session-timeout.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\features\miscellaneous\session-timeout.js */"./resources/metronic/js/pages/features/miscellaneous/session-timeout.js");


/***/ })

/******/ });