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
/******/ 	return __webpack_require__(__webpack_require__.s = 55);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/editors/quill.js":
/*!*****************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// Class definition\nvar KTQuilDemos = function () {\n  // Private functions\n  var demo1 = function demo1() {\n    var quill = new Quill('#kt_quil_1', {\n      modules: {\n        toolbar: [[{\n          header: [1, 2, false]\n        }], ['bold', 'italic', 'underline'], ['image', 'code-block']]\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow' // or 'bubble'\n\n    });\n  };\n\n  var demo2 = function demo2() {\n    var Delta = Quill[\"import\"]('delta');\n    var quill = new Quill('#kt_quil_2', {\n      modules: {\n        toolbar: true\n      },\n      placeholder: 'Type your text here...',\n      theme: 'snow'\n    }); // Store accumulated changes\n\n    var change = new Delta();\n    quill.on('text-change', function (delta) {\n      change = change.compose(delta);\n    }); // Save periodically\n\n    setInterval(function () {\n      if (change.length() > 0) {\n        console.log('Saving changes', change);\n        /*\r\n        Send partial changes\r\n        $.post('/your-endpoint', {\r\n          partial: JSON.stringify(change)\r\n        });\r\n          Send entire document\r\n        $.post('/your-endpoint', {\r\n          doc: JSON.stringify(quill.getContents())\r\n        });\r\n        */\n\n        change = new Delta();\n      }\n    }, 5 * 1000); // Check for unsaved data\n\n    window.onbeforeunload = function () {\n      if (change.length() > 0) {\n        return 'There are unsaved changes. Are you sure you want to leave?';\n      }\n    };\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demo1();\n      demo2();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTQuilDemos.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy9lZGl0b3JzL3F1aWxsLmpzPzE5NTEiXSwibmFtZXMiOlsiS1RRdWlsRGVtb3MiLCJkZW1vMSIsInF1aWxsIiwiUXVpbGwiLCJtb2R1bGVzIiwidG9vbGJhciIsImhlYWRlciIsInBsYWNlaG9sZGVyIiwidGhlbWUiLCJkZW1vMiIsIkRlbHRhIiwiY2hhbmdlIiwib24iLCJkZWx0YSIsImNvbXBvc2UiLCJzZXRJbnRlcnZhbCIsImxlbmd0aCIsImNvbnNvbGUiLCJsb2ciLCJ3aW5kb3ciLCJvbmJlZm9yZXVubG9hZCIsImluaXQiLCJqUXVlcnkiLCJkb2N1bWVudCIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBLElBQUlBLFdBQVcsR0FBRyxZQUFXO0FBRXpCO0FBQ0EsTUFBSUMsS0FBSyxHQUFHLFNBQVJBLEtBQVEsR0FBVztBQUNuQixRQUFJQyxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUUsQ0FDTCxDQUFDO0FBQ0dDLGdCQUFNLEVBQUUsQ0FBQyxDQUFELEVBQUksQ0FBSixFQUFPLEtBQVA7QUFEWCxTQUFELENBREssRUFJTCxDQUFDLE1BQUQsRUFBUyxRQUFULEVBQW1CLFdBQW5CLENBSkssRUFLTCxDQUFDLE9BQUQsRUFBVSxZQUFWLENBTEs7QUFESixPQUR1QjtBQVVoQ0MsaUJBQVcsRUFBRSx3QkFWbUI7QUFXaENDLFdBQUssRUFBRSxNQVh5QixDQVdsQjs7QUFYa0IsS0FBeEIsQ0FBWjtBQWFILEdBZEQ7O0FBZ0JBLE1BQUlDLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVc7QUFDbkIsUUFBSUMsS0FBSyxHQUFHUCxLQUFLLFVBQUwsQ0FBYSxPQUFiLENBQVo7QUFDQSxRQUFJRCxLQUFLLEdBQUcsSUFBSUMsS0FBSixDQUFVLFlBQVYsRUFBd0I7QUFDaENDLGFBQU8sRUFBRTtBQUNMQyxlQUFPLEVBQUU7QUFESixPQUR1QjtBQUloQ0UsaUJBQVcsRUFBRSx3QkFKbUI7QUFLaENDLFdBQUssRUFBRTtBQUx5QixLQUF4QixDQUFaLENBRm1CLENBVW5COztBQUNBLFFBQUlHLE1BQU0sR0FBRyxJQUFJRCxLQUFKLEVBQWI7QUFDQVIsU0FBSyxDQUFDVSxFQUFOLENBQVMsYUFBVCxFQUF3QixVQUFTQyxLQUFULEVBQWdCO0FBQ3BDRixZQUFNLEdBQUdBLE1BQU0sQ0FBQ0csT0FBUCxDQUFlRCxLQUFmLENBQVQ7QUFDSCxLQUZELEVBWm1CLENBZ0JuQjs7QUFDQUUsZUFBVyxDQUFDLFlBQVc7QUFDbkIsVUFBSUosTUFBTSxDQUFDSyxNQUFQLEtBQWtCLENBQXRCLEVBQXlCO0FBQ3JCQyxlQUFPLENBQUNDLEdBQVIsQ0FBWSxnQkFBWixFQUE4QlAsTUFBOUI7QUFDQTtBQUNoQjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRWdCQSxjQUFNLEdBQUcsSUFBSUQsS0FBSixFQUFUO0FBQ0g7QUFDSixLQWhCVSxFQWdCUixJQUFJLElBaEJJLENBQVgsQ0FqQm1CLENBbUNuQjs7QUFDQVMsVUFBTSxDQUFDQyxjQUFQLEdBQXdCLFlBQVc7QUFDL0IsVUFBSVQsTUFBTSxDQUFDSyxNQUFQLEtBQWtCLENBQXRCLEVBQXlCO0FBQ3JCLGVBQU8sNERBQVA7QUFDSDtBQUNKLEtBSkQ7QUFLSCxHQXpDRDs7QUEyQ0EsU0FBTztBQUNIO0FBQ0FLLFFBQUksRUFBRSxnQkFBVztBQUNicEIsV0FBSztBQUNMUSxXQUFLO0FBQ1I7QUFMRSxHQUFQO0FBT0gsQ0FyRWlCLEVBQWxCOztBQXVFQWEsTUFBTSxDQUFDQyxRQUFELENBQU4sQ0FBaUJDLEtBQWpCLENBQXVCLFlBQVc7QUFDOUJ4QixhQUFXLENBQUNxQixJQUFaO0FBQ0gsQ0FGRCIsImZpbGUiOiIuL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9jcnVkL2Zvcm1zL2VkaXRvcnMvcXVpbGwuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBDbGFzcyBkZWZpbml0aW9uXHJcbnZhciBLVFF1aWxEZW1vcyA9IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZGVtbzEgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgcXVpbGwgPSBuZXcgUXVpbGwoJyNrdF9xdWlsXzEnLCB7XHJcbiAgICAgICAgICAgIG1vZHVsZXM6IHtcclxuICAgICAgICAgICAgICAgIHRvb2xiYXI6IFtcclxuICAgICAgICAgICAgICAgICAgICBbe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBoZWFkZXI6IFsxLCAyLCBmYWxzZV1cclxuICAgICAgICAgICAgICAgICAgICB9XSxcclxuICAgICAgICAgICAgICAgICAgICBbJ2JvbGQnLCAnaXRhbGljJywgJ3VuZGVybGluZSddLFxyXG4gICAgICAgICAgICAgICAgICAgIFsnaW1hZ2UnLCAnY29kZS1ibG9jayddXHJcbiAgICAgICAgICAgICAgICBdXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSB5b3VyIHRleHQgaGVyZS4uLicsXHJcbiAgICAgICAgICAgIHRoZW1lOiAnc25vdycgLy8gb3IgJ2J1YmJsZSdcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgZGVtbzIgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgRGVsdGEgPSBRdWlsbC5pbXBvcnQoJ2RlbHRhJyk7XHJcbiAgICAgICAgdmFyIHF1aWxsID0gbmV3IFF1aWxsKCcja3RfcXVpbF8yJywge1xyXG4gICAgICAgICAgICBtb2R1bGVzOiB7XHJcbiAgICAgICAgICAgICAgICB0b29sYmFyOiB0cnVlXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSB5b3VyIHRleHQgaGVyZS4uLicsXHJcbiAgICAgICAgICAgIHRoZW1lOiAnc25vdydcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gU3RvcmUgYWNjdW11bGF0ZWQgY2hhbmdlc1xyXG4gICAgICAgIHZhciBjaGFuZ2UgPSBuZXcgRGVsdGEoKTtcclxuICAgICAgICBxdWlsbC5vbigndGV4dC1jaGFuZ2UnLCBmdW5jdGlvbihkZWx0YSkge1xyXG4gICAgICAgICAgICBjaGFuZ2UgPSBjaGFuZ2UuY29tcG9zZShkZWx0YSk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIC8vIFNhdmUgcGVyaW9kaWNhbGx5XHJcbiAgICAgICAgc2V0SW50ZXJ2YWwoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGlmIChjaGFuZ2UubGVuZ3RoKCkgPiAwKSB7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnU2F2aW5nIGNoYW5nZXMnLCBjaGFuZ2UpO1xyXG4gICAgICAgICAgICAgICAgLypcclxuICAgICAgICAgICAgICAgIFNlbmQgcGFydGlhbCBjaGFuZ2VzXHJcbiAgICAgICAgICAgICAgICAkLnBvc3QoJy95b3VyLWVuZHBvaW50Jywge1xyXG4gICAgICAgICAgICAgICAgICBwYXJ0aWFsOiBKU09OLnN0cmluZ2lmeShjaGFuZ2UpXHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICAgICBTZW5kIGVudGlyZSBkb2N1bWVudFxyXG4gICAgICAgICAgICAgICAgJC5wb3N0KCcveW91ci1lbmRwb2ludCcsIHtcclxuICAgICAgICAgICAgICAgICAgZG9jOiBKU09OLnN0cmluZ2lmeShxdWlsbC5nZXRDb250ZW50cygpKVxyXG4gICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICAqL1xyXG4gICAgICAgICAgICAgICAgY2hhbmdlID0gbmV3IERlbHRhKCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9LCA1ICogMTAwMCk7XHJcblxyXG4gICAgICAgIC8vIENoZWNrIGZvciB1bnNhdmVkIGRhdGFcclxuICAgICAgICB3aW5kb3cub25iZWZvcmV1bmxvYWQgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgaWYgKGNoYW5nZS5sZW5ndGgoKSA+IDApIHtcclxuICAgICAgICAgICAgICAgIHJldHVybiAnVGhlcmUgYXJlIHVuc2F2ZWQgY2hhbmdlcy4gQXJlIHlvdSBzdXJlIHlvdSB3YW50IHRvIGxlYXZlPyc7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBwdWJsaWMgZnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGRlbW8xKCk7XHJcbiAgICAgICAgICAgIGRlbW8yKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUUXVpbERlbW9zLmluaXQoKTtcclxufSk7XHJcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/editors/quill.js\n");

/***/ }),

/***/ 55:
/*!***********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/editors/quill.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\crud\forms\editors\quill.js */"./resources/metronic/js/pages/crud/forms/editors/quill.js");


/***/ })

/******/ });