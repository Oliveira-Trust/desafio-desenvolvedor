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
/******/ 	return __webpack_require__(__webpack_require__.s = 148);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/cropper.js":
/*!***********************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/cropper.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTCropperDemo = function () {\n  // Private functions\n  var initCropperDemo = function initCropperDemo() {\n    var image = document.getElementById('image');\n    var options = {\n      crop: function crop(event) {\n        document.getElementById('dataX').value = Math.round(event.detail.x);\n        document.getElementById('dataY').value = Math.round(event.detail.y);\n        document.getElementById('dataWidth').value = Math.round(event.detail.width);\n        document.getElementById('dataHeight').value = Math.round(event.detail.height);\n        document.getElementById('dataRotate').value = event.detail.rotate;\n        document.getElementById('dataScaleX').value = event.detail.scaleX;\n        document.getElementById('dataScaleY').value = event.detail.scaleY;\n        var lg = document.getElementById('cropper-preview-lg');\n        lg.innerHTML = '';\n        lg.appendChild(cropper.getCroppedCanvas({\n          width: 256,\n          height: 160\n        }));\n        var md = document.getElementById('cropper-preview-md');\n        md.innerHTML = '';\n        md.appendChild(cropper.getCroppedCanvas({\n          width: 128,\n          height: 80\n        }));\n        var sm = document.getElementById('cropper-preview-sm');\n        sm.innerHTML = '';\n        sm.appendChild(cropper.getCroppedCanvas({\n          width: 64,\n          height: 40\n        }));\n        var xs = document.getElementById('cropper-preview-xs');\n        xs.innerHTML = '';\n        xs.appendChild(cropper.getCroppedCanvas({\n          width: 32,\n          height: 20\n        }));\n      }\n    };\n    var cropper = new Cropper(image, options);\n    var buttons = document.getElementById('cropper-buttons');\n    var methods = buttons.querySelectorAll('[data-method]');\n    methods.forEach(function (button) {\n      button.addEventListener('click', function (e) {\n        var method = button.getAttribute('data-method');\n        var option = button.getAttribute('data-option');\n        var option2 = button.getAttribute('data-second-option');\n\n        try {\n          option = JSON.parse(option);\n        } catch (e) {}\n\n        var result;\n\n        if (!option2) {\n          result = cropper[method](option, option2);\n        } else if (option) {\n          result = cropper[method](option);\n        } else {\n          result = cropper[method]();\n        }\n\n        if (method === 'getCroppedCanvas') {\n          var modal = document.getElementById('getCroppedCanvasModal');\n          var modalBody = modal.querySelector('.modal-body');\n          modalBody.innerHTML = '';\n          modalBody.appendChild(result);\n        }\n\n        var input = document.querySelector('#putData');\n\n        try {\n          input.value = JSON.stringify(result);\n        } catch (e) {\n          if (!result) {\n            input.value = result;\n          }\n        }\n      });\n    }); // set aspect ratio option buttons\n\n    var radioOptions = document.getElementById('setAspectRatio').querySelectorAll('[name=\"aspectRatio\"]');\n    radioOptions.forEach(function (button) {\n      button.addEventListener('click', function (e) {\n        cropper.setAspectRatio(e.target.value);\n      });\n    }); // set view mode\n\n    var viewModeOptions = document.getElementById('viewMode').querySelectorAll('[name=\"viewMode\"]');\n    viewModeOptions.forEach(function (button) {\n      button.addEventListener('click', function (e) {\n        cropper.destroy();\n        cropper = new Cropper(image, Object.assign({}, options, {\n          viewMode: e.target.value\n        }));\n      });\n    });\n    var toggleoptions = document.getElementById('toggleOptionButtons').querySelectorAll('[type=\"checkbox\"]');\n    toggleoptions.forEach(function (checkbox) {\n      checkbox.addEventListener('click', function (e) {\n        var appendOption = {};\n        appendOption[e.target.getAttribute('name')] = e.target.checked;\n        options = Object.assign({}, options, appendOption);\n        cropper.destroy();\n        cropper = new Cropper(image, options);\n      });\n    });\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      initCropperDemo();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTCropperDemo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvZmVhdHVyZXMvbWlzY2VsbGFuZW91cy9jcm9wcGVyLmpzP2M1ODAiXSwibmFtZXMiOlsiS1RDcm9wcGVyRGVtbyIsImluaXRDcm9wcGVyRGVtbyIsImltYWdlIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIm9wdGlvbnMiLCJjcm9wIiwiZXZlbnQiLCJ2YWx1ZSIsIk1hdGgiLCJyb3VuZCIsImRldGFpbCIsIngiLCJ5Iiwid2lkdGgiLCJoZWlnaHQiLCJyb3RhdGUiLCJzY2FsZVgiLCJzY2FsZVkiLCJsZyIsImlubmVySFRNTCIsImFwcGVuZENoaWxkIiwiY3JvcHBlciIsImdldENyb3BwZWRDYW52YXMiLCJtZCIsInNtIiwieHMiLCJDcm9wcGVyIiwiYnV0dG9ucyIsIm1ldGhvZHMiLCJxdWVyeVNlbGVjdG9yQWxsIiwiZm9yRWFjaCIsImJ1dHRvbiIsImFkZEV2ZW50TGlzdGVuZXIiLCJlIiwibWV0aG9kIiwiZ2V0QXR0cmlidXRlIiwib3B0aW9uIiwib3B0aW9uMiIsIkpTT04iLCJwYXJzZSIsInJlc3VsdCIsIm1vZGFsIiwibW9kYWxCb2R5IiwicXVlcnlTZWxlY3RvciIsImlucHV0Iiwic3RyaW5naWZ5IiwicmFkaW9PcHRpb25zIiwic2V0QXNwZWN0UmF0aW8iLCJ0YXJnZXQiLCJ2aWV3TW9kZU9wdGlvbnMiLCJkZXN0cm95IiwiT2JqZWN0IiwiYXNzaWduIiwidmlld01vZGUiLCJ0b2dnbGVvcHRpb25zIiwiY2hlY2tib3giLCJhcHBlbmRPcHRpb24iLCJjaGVja2VkIiwiaW5pdCIsImpRdWVyeSIsInJlYWR5Il0sIm1hcHBpbmdzIjoiQ0FFQTs7QUFDQSxJQUFJQSxhQUFhLEdBQUcsWUFBVztBQUU3QjtBQUNBLE1BQUlDLGVBQWUsR0FBRyxTQUFsQkEsZUFBa0IsR0FBVztBQUMvQixRQUFJQyxLQUFLLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixPQUF4QixD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eEIsRUFBK0MwQixnQkFBL0MsQ0FBZ0UsbUJBQWhFLENBQXBCO0FBQ0F5QixpQkFBYSxDQUFDeEIsT0FBZCxDQUFzQixVQUFTeUIsUUFBVCxFQUFtQjtBQUN2Q0EsY0FBUSxDQUFDdkIsZ0JBQVQsQ0FBMEIsT0FBMUIsRUFBbUMsVUFBU0MsQ0FBVCxFQUFZO0FBQzdDLFlBQUl1QixZQUFZLEdBQUcsRUFBbkI7QUFDQUEsb0JBQVksQ0FBQ3ZCLENBQUMsQ0FBQ2UsTUFBRixDQUFTYixZQUFULENBQXNCLE1BQXRCLENBQUQsQ0FBWixHQUE4Q0YsQ0FBQyxDQUFDZSxNQUFGLENBQVNTLE9BQXZEO0FBQ0FyRCxlQUFPLEdBQUcrQyxNQUFNLENBQUNDLE1BQVAsQ0FBYyxFQUFkLEVBQWtCaEQsT0FBbEIsRUFBMkJvRCxZQUEzQixDQUFWO0FBQ0FuQyxlQUFPLENBQUM2QixPQUFSO0FBQ0E3QixlQUFPLEdBQUcsSUFBSUssT0FBSixDQUFZekIsS0FBWixFQUFtQkcsT0FBbkIsQ0FBVjtBQUNELE9BTkQ7QUFPRCxLQVJEO0FBVUQsR0F6R0Q7O0FBMkdBLFNBQU87QUFDTDtBQUNBc0QsUUFBSSxFQUFFLGdCQUFXO0FBQ2YxRCxxQkFBZTtBQUNoQjtBQUpJLEdBQVA7QUFNRCxDQXBIbUIsRUFBcEI7O0FBc0hBMkQsTUFBTSxDQUFDekQsUUFBRCxDQUFOLENBQWlCMEQsS0FBakIsQ0FBdUIsWUFBVztBQUNoQzdELGVBQWEsQ0FBQzJELElBQWQ7QUFDRCxDQUZEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL21ldHJvbmljL2pzL3BhZ2VzL2ZlYXR1cmVzL21pc2NlbGxhbmVvdXMvY3JvcHBlci5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIid1c2Ugc3RyaWN0JztcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUQ3JvcHBlckRlbW8gPSBmdW5jdGlvbigpIHtcclxuXHJcbiAgLy8gUHJpdmF0ZSBmdW5jdGlvbnNcclxuICB2YXIgaW5pdENyb3BwZXJEZW1vID0gZnVuY3Rpb24oKSB7XHJcbiAgICB2YXIgaW1hZ2UgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnaW1hZ2UnKTtcclxuXHJcbiAgICB2YXIgb3B0aW9ucyA9IHtcclxuICAgICAgY3JvcDogZnVuY3Rpb24oZXZlbnQpIHtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGF0YVgnKS52YWx1ZSA9IE1hdGgucm91bmQoZXZlbnQuZGV0YWlsLngpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkYXRhWScpLnZhbHVlID0gTWF0aC5yb3VuZChldmVudC5kZXRhaWwueSk7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RhdGFXaWR0aCcpLnZhbHVlID0gTWF0aC5yb3VuZChldmVudC5kZXRhaWwud2lkdGgpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkYXRhSGVpZ2h0JykudmFsdWUgPSBNYXRoLnJvdW5kKGV2ZW50LmRldGFpbC5oZWlnaHQpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkYXRhUm90YXRlJykudmFsdWUgPSBldmVudC5kZXRhaWwucm90YXRlO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkYXRhU2NhbGVYJykudmFsdWUgPSBldmVudC5kZXRhaWwuc2NhbGVYO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkYXRhU2NhbGVZJykudmFsdWUgPSBldmVudC5kZXRhaWwuc2NhbGVZO1xyXG5cclxuICAgICAgICB2YXIgbGcgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY3JvcHBlci1wcmV2aWV3LWxnJyk7XHJcbiAgICAgICAgbGcuaW5uZXJIVE1MID0gJyc7XHJcbiAgICAgICAgbGcuYXBwZW5kQ2hpbGQoY3JvcHBlci5nZXRDcm9wcGVkQ2FudmFzKHt3aWR0aDogMjU2LCBoZWlnaHQ6IDE2MH0pKTtcclxuXHJcbiAgICAgICAgdmFyIG1kID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nyb3BwZXItcHJldmlldy1tZCcpO1xyXG4gICAgICAgIG1kLmlubmVySFRNTCA9ICcnO1xyXG4gICAgICAgIG1kLmFwcGVuZENoaWxkKGNyb3BwZXIuZ2V0Q3JvcHBlZENhbnZhcyh7d2lkdGg6IDEyOCwgaGVpZ2h0OiA4MH0pKTtcclxuXHJcbiAgICAgICAgdmFyIHNtID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nyb3BwZXItcHJldmlldy1zbScpO1xyXG4gICAgICAgIHNtLmlubmVySFRNTCA9ICcnO1xyXG4gICAgICAgIHNtLmFwcGVuZENoaWxkKGNyb3BwZXIuZ2V0Q3JvcHBlZENhbnZhcyh7d2lkdGg6IDY0LCBoZWlnaHQ6IDQwfSkpO1xyXG5cclxuICAgICAgICB2YXIgeHMgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY3JvcHBlci1wcmV2aWV3LXhzJyk7XHJcbiAgICAgICAgeHMuaW5uZXJIVE1MID0gJyc7XHJcbiAgICAgICAgeHMuYXBwZW5kQ2hpbGQoY3JvcHBlci5nZXRDcm9wcGVkQ2FudmFzKHt3aWR0aDogMzIsIGhlaWdodDogMjB9KSk7XHJcbiAgICAgIH0sXHJcbiAgICB9O1xyXG5cclxuICAgIHZhciBjcm9wcGVyID0gbmV3IENyb3BwZXIoaW1hZ2UsIG9wdGlvbnMpO1xyXG5cclxuICAgIHZhciBidXR0b25zID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nyb3BwZXItYnV0dG9ucycpO1xyXG4gICAgdmFyIG1ldGhvZHMgPSBidXR0b25zLnF1ZXJ5U2VsZWN0b3JBbGwoJ1tkYXRhLW1ldGhvZF0nKTtcclxuICAgIG1ldGhvZHMuZm9yRWFjaChmdW5jdGlvbihidXR0b24pIHtcclxuICAgICAgYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgIHZhciBtZXRob2QgPSBidXR0b24uZ2V0QXR0cmlidXRlKCdkYXRhLW1ldGhvZCcpO1xyXG4gICAgICAgIHZhciBvcHRpb24gPSBidXR0b24uZ2V0QXR0cmlidXRlKCdkYXRhLW9wdGlvbicpO1xyXG4gICAgICAgIHZhciBvcHRpb24yID0gYnV0dG9uLmdldEF0dHJpYnV0ZSgnZGF0YS1zZWNvbmQtb3B0aW9uJyk7XHJcblxyXG4gICAgICAgIHRyeSB7XHJcbiAgICAgICAgICBvcHRpb24gPSBKU09OLnBhcnNlKG9wdGlvbik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGNhdGNoIChlKSB7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICB2YXIgcmVzdWx0O1xyXG4gICAgICAgIGlmICghb3B0aW9uMikge1xyXG4gICAgICAgICAgcmVzdWx0ID0gY3JvcHBlclttZXRob2RdKG9wdGlvbiwgb3B0aW9uMik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2UgaWYgKG9wdGlvbikge1xyXG4gICAgICAgICAgcmVzdWx0ID0gY3JvcHBlclttZXRob2RdKG9wdGlvbik7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGVsc2Uge1xyXG4gICAgICAgICAgcmVzdWx0ID0gY3JvcHBlclttZXRob2RdKCk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBpZiAobWV0aG9kID09PSAnZ2V0Q3JvcHBlZENhbnZhcycpIHtcclxuICAgICAgICAgIHZhciBtb2RhbCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXRDcm9wcGVkQ2FudmFzTW9kYWwnKTtcclxuICAgICAgICAgIHZhciBtb2RhbEJvZHkgPSBtb2RhbC5xdWVyeVNlbGVjdG9yKCcubW9kYWwtYm9keScpO1xyXG4gICAgICAgICAgbW9kYWxCb2R5LmlubmVySFRNTCA9ICcnO1xyXG4gICAgICAgICAgbW9kYWxCb2R5LmFwcGVuZENoaWxkKHJlc3VsdCk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICB2YXIgaW5wdXQgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjcHV0RGF0YScpO1xyXG4gICAgICAgIHRyeSB7XHJcbiAgICAgICAgICBpbnB1dC52YWx1ZSA9IEpTT04uc3RyaW5naWZ5KHJlc3VsdCk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIGNhdGNoIChlKSB7XHJcbiAgICAgICAgICBpZiAoIXJlc3VsdCkge1xyXG4gICAgICAgICAgICBpbnB1dC52YWx1ZSA9IHJlc3VsdDtcclxuICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gc2V0IGFzcGVjdCByYXRpbyBvcHRpb24gYnV0dG9uc1xyXG4gICAgdmFyIHJhZGlvT3B0aW9ucyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzZXRBc3BlY3RSYXRpbycpLnF1ZXJ5U2VsZWN0b3JBbGwoJ1tuYW1lPVwiYXNwZWN0UmF0aW9cIl0nKTtcclxuICAgIHJhZGlvT3B0aW9ucy5mb3JFYWNoKGZ1bmN0aW9uKGJ1dHRvbikge1xyXG4gICAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbihlKSB7XHJcbiAgICAgICAgY3JvcHBlci5zZXRBc3BlY3RSYXRpbyhlLnRhcmdldC52YWx1ZSk7XHJcbiAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgLy8gc2V0IHZpZXcgbW9kZVxyXG4gICAgdmFyIHZpZXdNb2RlT3B0aW9ucyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd2aWV3TW9kZScpLnF1ZXJ5U2VsZWN0b3JBbGwoJ1tuYW1lPVwidmlld01vZGVcIl0nKTtcclxuICAgIHZpZXdNb2RlT3B0aW9ucy5mb3JFYWNoKGZ1bmN0aW9uKGJ1dHRvbikge1xyXG4gICAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbihlKSB7XHJcbiAgICAgICAgY3JvcHBlci5kZXN0cm95KCk7XHJcbiAgICAgICAgY3JvcHBlciA9IG5ldyBDcm9wcGVyKGltYWdlLCBPYmplY3QuYXNzaWduKHt9LCBvcHRpb25zLCB7dmlld01vZGU6IGUudGFyZ2V0LnZhbHVlfSkpO1xyXG4gICAgICB9KTtcclxuICAgIH0pO1xyXG5cclxuICAgIHZhciB0b2dnbGVvcHRpb25zID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3RvZ2dsZU9wdGlvbkJ1dHRvbnMnKS5xdWVyeVNlbGVjdG9yQWxsKCdbdHlwZT1cImNoZWNrYm94XCJdJyk7XHJcbiAgICB0b2dnbGVvcHRpb25zLmZvckVhY2goZnVuY3Rpb24oY2hlY2tib3gpIHtcclxuICAgICAgY2hlY2tib3guYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbihlKSB7XHJcbiAgICAgICAgdmFyIGFwcGVuZE9wdGlvbiA9IHt9O1xyXG4gICAgICAgIGFwcGVuZE9wdGlvbltlLnRhcmdldC5nZXRBdHRyaWJ1dGUoJ25hbWUnKV0gPSBlLnRhcmdldC5jaGVja2VkO1xyXG4gICAgICAgIG9wdGlvbnMgPSBPYmplY3QuYXNzaWduKHt9LCBvcHRpb25zLCBhcHBlbmRPcHRpb24pO1xyXG4gICAgICAgIGNyb3BwZXIuZGVzdHJveSgpO1xyXG4gICAgICAgIGNyb3BwZXIgPSBuZXcgQ3JvcHBlcihpbWFnZSwgb3B0aW9ucyk7XHJcbiAgICAgIH0pXHJcbiAgICB9KVxyXG5cclxuICB9O1xyXG5cclxuICByZXR1cm4ge1xyXG4gICAgLy8gcHVibGljIGZ1bmN0aW9uc1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgIGluaXRDcm9wcGVyRGVtbygpO1xyXG4gICAgfSxcclxuICB9O1xyXG59KCk7XHJcblxyXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG4gIEtUQ3JvcHBlckRlbW8uaW5pdCgpO1xyXG59KTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/features/miscellaneous/cropper.js\n");

/***/ }),

/***/ 148:
/*!*****************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/cropper.js ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\dev\PHP\Laravel\8.0\competitividade_app\resources\metronic\js\pages\features\miscellaneous\cropper.js */"./resources/metronic/js/pages/features/miscellaneous/cropper.js");


/***/ })

/******/ });