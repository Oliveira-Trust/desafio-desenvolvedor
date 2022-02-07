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
/******/ 	return __webpack_require__(__webpack_require__.s = 53);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/editors/ckeditor-document.js":
/*!*****************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/editors/ckeditor-document.js ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTCkeditorDocument = function () {\n  // Private functions\n  var demos = function demos() {\n    DecoupledEditor.create(document.querySelector('#kt-ckeditor-1')).then(function (editor) {\n      var toolbarContainer = document.querySelector('#kt-ckeditor-1-toolbar');\n      toolbarContainer.appendChild(editor.ui.view.toolbar.element);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    DecoupledEditor.create(document.querySelector('#kt-ckeditor-2')).then(function (editor) {\n      var toolbarContainer = document.querySelector('#kt-ckeditor-2-toolbar');\n      toolbarContainer.appendChild(editor.ui.view.toolbar.element);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    DecoupledEditor.create(document.querySelector('#kt-ckeditor-3')).then(function (editor) {\n      var toolbarContainer = document.querySelector('#kt-ckeditor-3-toolbar');\n      toolbarContainer.appendChild(editor.ui.view.toolbar.element);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demos();\n    }\n  };\n}(); // Initialization\n\n\njQuery(document).ready(function () {\n  KTCkeditorDocument.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL2NrZWRpdG9yLWRvY3VtZW50LmpzPzQ3MDMiXSwibmFtZXMiOlsiS1RDa2VkaXRvckRvY3VtZW50IiwiZGVtb3MiLCJEZWNvdXBsZWRFZGl0b3IiLCJjcmVhdGUiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJ0aGVuIiwiZWRpdG9yIiwidG9vbGJhckNvbnRhaW5lciIsImFwcGVuZENoaWxkIiwidWkiLCJ2aWV3IiwidG9vbGJhciIsImVsZW1lbnQiLCJlcnJvciIsImNvbnNvbGUiLCJpbml0IiwialF1ZXJ5IiwicmVhZHkiXSwibWFwcGluZ3MiOiJDQUNBOztBQUVBLElBQUlBLGtCQUFrQixHQUFHLFlBQVk7QUFDakM7QUFDQSxNQUFJQyxLQUFLLEdBQUcsU0FBUkEsS0FBUSxHQUFZO0FBQ3BCQyxtQkFBZSxDQUNWQyxNQURMLENBQ2FDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF3QixnQkFBeEIsQ0FEYixFQUVLQyxJQUZMLENBRVcsVUFBQUMsTUFBTSxFQUFJO0FBQ2IsVUFBTUMsZ0JBQWdCLEdBQUdKLFFBQVEsQ0FBQ0MsYUFBVCxDQUF3Qix3QkFBeEIsQ0FBekI7QUFFQUcsc0JBQWdCLENBQUNDLFdBQWpCLENBQThCRixNQUFNLENBQUNHLEVBQVAsQ0FBVUMsSUFBVixDQUFlQyxPQUFmLENBQXVCQyxPQUFyRDtBQUNILEtBTkwsV0FPWSxVQUFBQyxLQUFLLEVBQUk7QUFDYkMsYUFBTyxDQUFDRCxLQUFSLENBQWVBLEtBQWY7QUFDSCxLQVRMO0FBV0FaLG1CQUFlLENBQ1ZDLE1BREwsQ0FDYUMsUUFBUSxDQUFDQyxhQUFULENBQXdCLGdCQUF4QixDQURiLEVBRUtDLElBRkwsQ0FFVyxVQUFBQyxNQUFNLEVBQUk7QUFDYixVQUFNQyxnQkFBZ0IsR0FBR0osUUFBUSxDQUFDQyxhQUFULENBQXdCLHdCQUF4QixDQUF6QjtBQUVBRyxzQkFBZ0IsQ0FBQ0MsV0FBakIsQ0FBOEJGLE1BQU0sQ0FBQ0csRUFBUCxDQUFVQyxJQUFWLENBQWVDLE9BQWYsQ0FBdUJDLE9BQXJEO0FBQ0gsS0FOTCxXQU9ZLFVBQUFDLEtBQUssRUFBSTtBQUNiQyxhQUFPLENBQUNELEtBQVIsQ0FBZUEsS0FBZjtBQUNILEtBVEw7QUFXQVosbUJBQWUsQ0FDVkMsTUFETCxDQUNhQyxRQUFRLENBQUNDLGFBQVQsQ0FBd0IsZ0JBQXhCLENBRGIsRUFFS0MsSUFGTCxDQUVXLFVBQUFDLE1BQU0sRUFBSTtBQUNiLFVBQU1DLGdCQUFnQixHQUFHSixRQUFRLENBQUNDLGFBQVQsQ0FBd0Isd0JBQXhCLENBQXpCO0FBRUFHLHNCQUFnQixDQUFDQyxXQUFqQixDQUE4QkYsTUFBTSxDQUFDRyxFQUFQLENBQVVDLElBQVYsQ0FBZUMsT0FBZixDQUF1QkMsT0FBckQ7QUFDSCxLQU5MLFdBT1ksVUFBQUMsS0FBSyxFQUFJO0FBQ2JDLGFBQU8sQ0FBQ0QsS0FBUixDQUFlQSxLQUFmO0FBQ0gsS0FUTDtBQVVILEdBakNEOztBQW1DQSxTQUFPO0FBQ0g7QUFDQUUsUUFBSSxFQUFFLGdCQUFXO0FBQ2JmLFdBQUs7QUFDUjtBQUpFLEdBQVA7QUFNSCxDQTNDd0IsRUFBekIsQyxDQTZDQTs7O0FBQ0FnQixNQUFNLENBQUNiLFFBQUQsQ0FBTixDQUFpQmMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QmxCLG9CQUFrQixDQUFDZ0IsSUFBbkI7QUFDSCxDQUZEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL21ldHJvbmljL2pzL3BhZ2VzL2NydWQvZm9ybXMvZWRpdG9ycy9ja2VkaXRvci1kb2N1bWVudC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xyXG4vLyBDbGFzcyBkZWZpbml0aW9uXHJcblxyXG52YXIgS1RDa2VkaXRvckRvY3VtZW50ID0gZnVuY3Rpb24gKCkgeyAgICBcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZGVtb3MgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgRGVjb3VwbGVkRWRpdG9yXHJcbiAgICAgICAgICAgIC5jcmVhdGUoIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICcja3QtY2tlZGl0b3ItMScgKSApXHJcbiAgICAgICAgICAgIC50aGVuKCBlZGl0b3IgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc3QgdG9vbGJhckNvbnRhaW5lciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICcja3QtY2tlZGl0b3ItMS10b29sYmFyJyApO1xyXG5cclxuICAgICAgICAgICAgICAgIHRvb2xiYXJDb250YWluZXIuYXBwZW5kQ2hpbGQoIGVkaXRvci51aS52aWV3LnRvb2xiYXIuZWxlbWVudCApO1xyXG4gICAgICAgICAgICB9IClcclxuICAgICAgICAgICAgLmNhdGNoKCBlcnJvciA9PiB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCBlcnJvciApO1xyXG4gICAgICAgICAgICB9ICk7XHJcblxyXG4gICAgICAgIERlY291cGxlZEVkaXRvclxyXG4gICAgICAgICAgICAuY3JlYXRlKCBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnI2t0LWNrZWRpdG9yLTInICkgKVxyXG4gICAgICAgICAgICAudGhlbiggZWRpdG9yID0+IHtcclxuICAgICAgICAgICAgICAgIGNvbnN0IHRvb2xiYXJDb250YWluZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnI2t0LWNrZWRpdG9yLTItdG9vbGJhcicgKTtcclxuXHJcbiAgICAgICAgICAgICAgICB0b29sYmFyQ29udGFpbmVyLmFwcGVuZENoaWxkKCBlZGl0b3IudWkudmlldy50b29sYmFyLmVsZW1lbnQgKTtcclxuICAgICAgICAgICAgfSApXHJcbiAgICAgICAgICAgIC5jYXRjaCggZXJyb3IgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5lcnJvciggZXJyb3IgKTtcclxuICAgICAgICAgICAgfSApO1xyXG5cclxuICAgICAgICBEZWNvdXBsZWRFZGl0b3JcclxuICAgICAgICAgICAgLmNyZWF0ZSggZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJyNrdC1ja2VkaXRvci0zJyApIClcclxuICAgICAgICAgICAgLnRoZW4oIGVkaXRvciA9PiB7XHJcbiAgICAgICAgICAgICAgICBjb25zdCB0b29sYmFyQ29udGFpbmVyID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJyNrdC1ja2VkaXRvci0zLXRvb2xiYXInICk7XHJcblxyXG4gICAgICAgICAgICAgICAgdG9vbGJhckNvbnRhaW5lci5hcHBlbmRDaGlsZCggZWRpdG9yLnVpLnZpZXcudG9vbGJhci5lbGVtZW50ICk7XHJcbiAgICAgICAgICAgIH0gKVxyXG4gICAgICAgICAgICAuY2F0Y2goIGVycm9yID0+IHtcclxuICAgICAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoIGVycm9yICk7XHJcbiAgICAgICAgICAgIH0gKTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIC8vIHB1YmxpYyBmdW5jdGlvbnNcclxuICAgICAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgZGVtb3MoKTsgXHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxuLy8gSW5pdGlhbGl6YXRpb25cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUQ2tlZGl0b3JEb2N1bWVudC5pbml0KCk7XHJcbn0pOyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/editors/ckeditor-document.js\n");

/***/ }),

/***/ 53:
/*!***********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/editors/ckeditor-document.js ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\crud\forms\editors\ckeditor-document.js */"./resources/metronic/js/pages/crud/forms/editors/ckeditor-document.js");


/***/ })

/******/ });