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
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/editors/ckeditor-balloon-block.js":
/*!**********************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/editors/ckeditor-balloon-block.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTCkeditorBalloonBlock = function () {\n  // Private functions\n  var demos = function demos() {\n    BalloonEditor.create(document.querySelector('#kt-ckeditor-1')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    BalloonEditor.create(document.querySelector('#kt-ckeditor-2')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    BalloonEditor.create(document.querySelector('#kt-ckeditor-3')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    BalloonEditor.create(document.querySelector('#kt-ckeditor-4')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n    BalloonEditor.create(document.querySelector('#kt-ckeditor-5')).then(function (editor) {\n      console.log(editor);\n    })[\"catch\"](function (error) {\n      console.error(error);\n    });\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demos();\n    }\n  };\n}(); // Initialization\n\n\njQuery(document).ready(function () {\n  KTCkeditorBalloonBlock.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL2NrZWRpdG9yLWJhbGxvb24tYmxvY2suanM/NjU4ZiJdLCJuYW1lcyI6WyJLVENrZWRpdG9yQmFsbG9vbkJsb2NrIiwiZGVtb3MiLCJCYWxsb29uRWRpdG9yIiwiY3JlYXRlIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwidGhlbiIsImVkaXRvciIsImNvbnNvbGUiLCJsb2ciLCJlcnJvciIsImluaXQiLCJqUXVlcnkiLCJyZWFkeSJdLCJtYXBwaW5ncyI6IkNBQ0E7O0FBRUEsSUFBSUEsc0JBQXNCLEdBQUcsWUFBWTtBQUNyQztBQUNBLE1BQUlDLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVk7QUFDcEJDLGlCQUFhLENBQ2pCQyxNQURJLENBQ0lDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF3QixnQkFBeEIsQ0FESixFQUVKQyxJQUZJLENBRUUsVUFBQUMsTUFBTSxFQUFJO0FBQ2hCQyxhQUFPLENBQUNDLEdBQVIsQ0FBYUYsTUFBYjtBQUNBLEtBSkksV0FLRyxVQUFBRyxLQUFLLEVBQUk7QUFDaEJGLGFBQU8sQ0FBQ0UsS0FBUixDQUFlQSxLQUFmO0FBQ0EsS0FQSTtBQVNBUixpQkFBYSxDQUNqQkMsTUFESSxDQUNJQyxRQUFRLENBQUNDLGFBQVQsQ0FBd0IsZ0JBQXhCLENBREosRUFFSkMsSUFGSSxDQUVFLFVBQUFDLE1BQU0sRUFBSTtBQUNoQkMsYUFBTyxDQUFDQyxHQUFSLENBQWFGLE1BQWI7QUFDQSxLQUpJLFdBS0csVUFBQUcsS0FBSyxFQUFJO0FBQ2hCRixhQUFPLENBQUNFLEtBQVIsQ0FBZUEsS0FBZjtBQUNBLEtBUEk7QUFTTlIsaUJBQWEsQ0FDWEMsTUFERixDQUNVQyxRQUFRLENBQUNDLGFBQVQsQ0FBd0IsZ0JBQXhCLENBRFYsRUFFRUMsSUFGRixDQUVRLFVBQUFDLE1BQU0sRUFBSTtBQUNoQkMsYUFBTyxDQUFDQyxHQUFSLENBQWFGLE1BQWI7QUFDQSxLQUpGLFdBS1MsVUFBQUcsS0FBSyxFQUFJO0FBQ2hCRixhQUFPLENBQUNFLEtBQVIsQ0FBZUEsS0FBZjtBQUNBLEtBUEY7QUFTTVIsaUJBQWEsQ0FDakJDLE1BREksQ0FDSUMsUUFBUSxDQUFDQyxhQUFULENBQXdCLGdCQUF4QixDQURKLEVBRUpDLElBRkksQ0FFRSxVQUFBQyxNQUFNLEVBQUk7QUFDaEJDLGFBQU8sQ0FBQ0MsR0FBUixDQUFhRixNQUFiO0FBQ0EsS0FKSSxXQUtHLFVBQUFHLEtBQUssRUFBSTtBQUNoQkYsYUFBTyxDQUFDRSxLQUFSLENBQWVBLEtBQWY7QUFDQSxLQVBJO0FBU05SLGlCQUFhLENBQ1hDLE1BREYsQ0FDVUMsUUFBUSxDQUFDQyxhQUFULENBQXdCLGdCQUF4QixDQURWLEVBRUVDLElBRkYsQ0FFUSxVQUFBQyxNQUFNLEVBQUk7QUFDaEJDLGFBQU8sQ0FBQ0MsR0FBUixDQUFhRixNQUFiO0FBQ0EsS0FKRixXQUtTLFVBQUFHLEtBQUssRUFBSTtBQUNoQkYsYUFBTyxDQUFDRSxLQUFSLENBQWVBLEtBQWY7QUFDQSxLQVBGO0FBUUEsR0E3Q0U7O0FBK0NBLFNBQU87QUFDSDtBQUNBQyxRQUFJLEVBQUUsZ0JBQVc7QUFDdEJWLFdBQUs7QUFDQztBQUpFLEdBQVA7QUFNSCxDQXZENEIsRUFBN0IsQyxDQXlEQTs7O0FBQ0FXLE1BQU0sQ0FBQ1IsUUFBRCxDQUFOLENBQWlCUyxLQUFqQixDQUF1QixZQUFXO0FBQzlCYix3QkFBc0IsQ0FBQ1csSUFBdkI7QUFDSCxDQUZEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL21ldHJvbmljL2pzL3BhZ2VzL2NydWQvZm9ybXMvZWRpdG9ycy9ja2VkaXRvci1iYWxsb29uLWJsb2NrLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxuXHJcbnZhciBLVENrZWRpdG9yQmFsbG9vbkJsb2NrID0gZnVuY3Rpb24gKCkgeyAgICBcclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZGVtb3MgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgQmFsbG9vbkVkaXRvclxyXG5cdFx0XHQuY3JlYXRlKCBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnI2t0LWNrZWRpdG9yLTEnICkgKVxyXG5cdFx0XHQudGhlbiggZWRpdG9yID0+IHtcclxuXHRcdFx0XHRjb25zb2xlLmxvZyggZWRpdG9yICk7XHJcblx0XHRcdH0gKVxyXG5cdFx0XHQuY2F0Y2goIGVycm9yID0+IHtcclxuXHRcdFx0XHRjb25zb2xlLmVycm9yKCBlcnJvciApO1xyXG5cdFx0XHR9ICk7XHJcblxyXG4gICAgICAgIEJhbGxvb25FZGl0b3JcclxuXHRcdFx0LmNyZWF0ZSggZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJyNrdC1ja2VkaXRvci0yJyApIClcclxuXHRcdFx0LnRoZW4oIGVkaXRvciA9PiB7XHJcblx0XHRcdFx0Y29uc29sZS5sb2coIGVkaXRvciApO1xyXG5cdFx0XHR9IClcclxuXHRcdFx0LmNhdGNoKCBlcnJvciA9PiB7XHJcblx0XHRcdFx0Y29uc29sZS5lcnJvciggZXJyb3IgKTtcclxuXHRcdFx0fSApO1xyXG5cclxuXHRcdEJhbGxvb25FZGl0b3JcclxuXHRcdFx0LmNyZWF0ZSggZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJyNrdC1ja2VkaXRvci0zJyApIClcclxuXHRcdFx0LnRoZW4oIGVkaXRvciA9PiB7XHJcblx0XHRcdFx0Y29uc29sZS5sb2coIGVkaXRvciApO1xyXG5cdFx0XHR9IClcclxuXHRcdFx0LmNhdGNoKCBlcnJvciA9PiB7XHJcblx0XHRcdFx0Y29uc29sZS5lcnJvciggZXJyb3IgKTtcclxuXHRcdFx0fSApO1xyXG5cclxuICAgICAgICBCYWxsb29uRWRpdG9yXHJcblx0XHRcdC5jcmVhdGUoIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICcja3QtY2tlZGl0b3ItNCcgKSApXHJcblx0XHRcdC50aGVuKCBlZGl0b3IgPT4ge1xyXG5cdFx0XHRcdGNvbnNvbGUubG9nKCBlZGl0b3IgKTtcclxuXHRcdFx0fSApXHJcblx0XHRcdC5jYXRjaCggZXJyb3IgPT4ge1xyXG5cdFx0XHRcdGNvbnNvbGUuZXJyb3IoIGVycm9yICk7XHJcblx0XHRcdH0gKTtcclxuXHJcblx0XHRCYWxsb29uRWRpdG9yXHJcblx0XHRcdC5jcmVhdGUoIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICcja3QtY2tlZGl0b3ItNScgKSApXHJcblx0XHRcdC50aGVuKCBlZGl0b3IgPT4ge1xyXG5cdFx0XHRcdGNvbnNvbGUubG9nKCBlZGl0b3IgKTtcclxuXHRcdFx0fSApXHJcblx0XHRcdC5jYXRjaCggZXJyb3IgPT4ge1xyXG5cdFx0XHRcdGNvbnNvbGUuZXJyb3IoIGVycm9yICk7XHJcblx0XHRcdH0gKTtcclxuXHR9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBwdWJsaWMgZnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcblx0XHRcdGRlbW9zKCk7IFxyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIEluaXRpYWxpemF0aW9uXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcbiAgICBLVENrZWRpdG9yQmFsbG9vbkJsb2NrLmluaXQoKTtcclxufSk7Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/editors/ckeditor-balloon-block.js\n");

/***/ }),

/***/ 50:
/*!****************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/editors/ckeditor-balloon-block.js ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\crud\forms\editors\ckeditor-balloon-block.js */"./resources/metronic/js/pages/crud/forms/editors/ckeditor-balloon-block.js");


/***/ })

/******/ });