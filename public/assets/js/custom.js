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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom.js":
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("$(\"#menu-toggle\").on(\"click\", function (e) {\n  e.preventDefault();\n  $(\"#wrapper\").toggleClass(\"toggled\");\n});\n$(\".restore\").on(\"click\", function (event) {\n  event.preventDefault();\n  $(\"#record-name\").val($(this).attr('data-name'));\n  $(\"#frm-restore\").attr(\"action\", $(this).attr(\"data-route\"));\n});\n$(\"#btn-restore\").on(\"click\", function () {\n  $(this).prop('disabled', true).html('Aguarde...');\n  $(\"#frm-restore\").trigger(\"submit\");\n});\n$(\".delete\").on(\"click\", function (event) {\n  event.preventDefault();\n  $(\"#record-name-delete\").val($(this).attr('data-name-delete'));\n  $(\"#frm-delete\").attr(\"action\", $(this).attr(\"data-route-delete\"));\n});\n$(\"#btn-delete\").on(\"click\", function () {\n  $(this).prop('disabled', true).html('Aguarde...'); // $('#frm-delete').submit();\n\n  $(\"#frm-delete\").trigger(\"submit\");\n});\nsetTimeout(function () {\n  $(\".alert\").alert('close');\n}, 3000);\n$('.select2').select2({\n  theme: 'bootstrap4'\n});\n\nif ($('#table').length) {\n  var massDelete = function massDelete() {\n    if ($('#table tbody tr').hasClass('selected')) {\n      $('#mass-delete').removeClass('d-none');\n    } else {\n      $('#mass-delete').addClass('d-none');\n    }\n  };\n\n  massDelete();\n  var table = $('#table').DataTable();\n  $('#table tbody').on('click', 'tr', function () {\n    $(this).toggleClass('selected');\n    massDelete();\n  });\n  $('#mass-delete').on(\"click\", function () {\n    var row = $('#table tbody tr.selected');\n\n    if (row.length > 0) {\n      row.each(function (i, element) {\n        $.ajaxSetup({\n          headers: {\n            'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n          }\n        });\n        $.ajax({\n          type: 'DELETE',\n          url: $(this).attr('delete-id'),\n          dataType: 'json',\n          success: function success(msg) {\n            location.reload(true);\n          }\n        });\n      });\n    }\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY3VzdG9tLmpzP2IxZDIiXSwibmFtZXMiOlsiJCIsIm9uIiwiZSIsInByZXZlbnREZWZhdWx0IiwidG9nZ2xlQ2xhc3MiLCJldmVudCIsInZhbCIsImF0dHIiLCJwcm9wIiwiaHRtbCIsInRyaWdnZXIiLCJzZXRUaW1lb3V0IiwiYWxlcnQiLCJzZWxlY3QyIiwidGhlbWUiLCJsZW5ndGgiLCJtYXNzRGVsZXRlIiwiaGFzQ2xhc3MiLCJyZW1vdmVDbGFzcyIsImFkZENsYXNzIiwidGFibGUiLCJEYXRhVGFibGUiLCJyb3ciLCJlYWNoIiwiaSIsImVsZW1lbnQiLCJhamF4U2V0dXAiLCJoZWFkZXJzIiwiYWpheCIsInR5cGUiLCJ1cmwiLCJkYXRhVHlwZSIsInN1Y2Nlc3MiLCJtc2ciLCJsb2NhdGlvbiIsInJlbG9hZCJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JDLEVBQWxCLENBQXFCLE9BQXJCLEVBQThCLFVBQVVDLENBQVYsRUFBYTtBQUN2Q0EsR0FBQyxDQUFDQyxjQUFGO0FBQ0FILEdBQUMsQ0FBQyxVQUFELENBQUQsQ0FBY0ksV0FBZCxDQUEwQixTQUExQjtBQUNILENBSEQ7QUFLQUosQ0FBQyxDQUFDLFVBQUQsQ0FBRCxDQUFjQyxFQUFkLENBQWlCLE9BQWpCLEVBQTBCLFVBQVVJLEtBQVYsRUFBaUI7QUFDdkNBLE9BQUssQ0FBQ0YsY0FBTjtBQUNBSCxHQUFDLENBQUMsY0FBRCxDQUFELENBQWtCTSxHQUFsQixDQUFzQk4sQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRTyxJQUFSLENBQWEsV0FBYixDQUF0QjtBQUNBUCxHQUFDLENBQUMsY0FBRCxDQUFELENBQWtCTyxJQUFsQixDQUF1QixRQUF2QixFQUFpQ1AsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRTyxJQUFSLENBQWEsWUFBYixDQUFqQztBQUNILENBSkQ7QUFNQVAsQ0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQkMsRUFBbEIsQ0FBcUIsT0FBckIsRUFBOEIsWUFBWTtBQUN0Q0QsR0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRUSxJQUFSLENBQWEsVUFBYixFQUF5QixJQUF6QixFQUErQkMsSUFBL0IsQ0FBb0MsWUFBcEM7QUFDQVQsR0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQlUsT0FBbEIsQ0FBMEIsUUFBMUI7QUFDSCxDQUhEO0FBS0FWLENBQUMsQ0FBQyxTQUFELENBQUQsQ0FBYUMsRUFBYixDQUFnQixPQUFoQixFQUF5QixVQUFVSSxLQUFWLEVBQWlCO0FBQ3RDQSxPQUFLLENBQUNGLGNBQU47QUFDQUgsR0FBQyxDQUFDLHFCQUFELENBQUQsQ0FBeUJNLEdBQXpCLENBQTZCTixDQUFDLENBQUMsSUFBRCxDQUFELENBQVFPLElBQVIsQ0FBYSxrQkFBYixDQUE3QjtBQUNBUCxHQUFDLENBQUMsYUFBRCxDQUFELENBQWlCTyxJQUFqQixDQUFzQixRQUF0QixFQUFnQ1AsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRTyxJQUFSLENBQWEsbUJBQWIsQ0FBaEM7QUFDSCxDQUpEO0FBTUFQLENBQUMsQ0FBQyxhQUFELENBQUQsQ0FBaUJDLEVBQWpCLENBQW9CLE9BQXBCLEVBQTZCLFlBQVk7QUFDckNELEdBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUVEsSUFBUixDQUFhLFVBQWIsRUFBeUIsSUFBekIsRUFBK0JDLElBQS9CLENBQW9DLFlBQXBDLEVBRHFDLENBRXJDOztBQUNBVCxHQUFDLENBQUMsYUFBRCxDQUFELENBQWlCVSxPQUFqQixDQUF5QixRQUF6QjtBQUNILENBSkQ7QUFNQUMsVUFBVSxDQUFDLFlBQVk7QUFDbkJYLEdBQUMsQ0FBQyxRQUFELENBQUQsQ0FBWVksS0FBWixDQUFrQixPQUFsQjtBQUNILENBRlMsRUFFUCxJQUZPLENBQVY7QUFJQVosQ0FBQyxDQUFDLFVBQUQsQ0FBRCxDQUFjYSxPQUFkLENBQXNCO0FBQ2xCQyxPQUFLLEVBQUU7QUFEVyxDQUF0Qjs7QUFHQSxJQUFJZCxDQUFDLENBQUMsUUFBRCxDQUFELENBQVllLE1BQWhCLEVBQ0E7QUFBQSxNQVFTQyxVQVJULEdBUUEsU0FBU0EsVUFBVCxHQUFzQjtBQUNsQixRQUFJaEIsQ0FBQyxDQUFDLGlCQUFELENBQUQsQ0FBcUJpQixRQUFyQixDQUE4QixVQUE5QixDQUFKLEVBQStDO0FBQzNDakIsT0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQmtCLFdBQWxCLENBQThCLFFBQTlCO0FBQ0gsS0FGRCxNQUVPO0FBQ0hsQixPQUFDLENBQUMsY0FBRCxDQUFELENBQWtCbUIsUUFBbEIsQ0FBMkIsUUFBM0I7QUFDSDtBQUNKLEdBZEQ7O0FBQ0FILFlBQVU7QUFDVixNQUFJSSxLQUFLLEdBQUdwQixDQUFDLENBQUMsUUFBRCxDQUFELENBQVlxQixTQUFaLEVBQVo7QUFDQXJCLEdBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JDLEVBQWxCLENBQXFCLE9BQXJCLEVBQThCLElBQTlCLEVBQW9DLFlBQVk7QUFDNUNELEtBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUUksV0FBUixDQUFvQixVQUFwQjtBQUNBWSxjQUFVO0FBQ2IsR0FIRDtBQWFBaEIsR0FBQyxDQUFDLGNBQUQsQ0FBRCxDQUFrQkMsRUFBbEIsQ0FBcUIsT0FBckIsRUFBOEIsWUFBWTtBQUN0QyxRQUFJcUIsR0FBRyxHQUFHdEIsQ0FBQyxDQUFDLDBCQUFELENBQVg7O0FBQ0EsUUFBSXNCLEdBQUcsQ0FBQ1AsTUFBSixHQUFhLENBQWpCLEVBQW9CO0FBQ2hCTyxTQUFHLENBQUNDLElBQUosQ0FBUyxVQUFVQyxDQUFWLEVBQWFDLE9BQWIsRUFBc0I7QUFDM0J6QixTQUFDLENBQUMwQixTQUFGLENBQVk7QUFDUkMsaUJBQU8sRUFBRTtBQUNMLDRCQUFnQjNCLENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCTyxJQUE3QixDQUFrQyxTQUFsQztBQURYO0FBREQsU0FBWjtBQUtBUCxTQUFDLENBQUM0QixJQUFGLENBQU87QUFDSEMsY0FBSSxFQUFFLFFBREg7QUFFSEMsYUFBRyxFQUFFOUIsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRTyxJQUFSLENBQWEsV0FBYixDQUZGO0FBR0h3QixrQkFBUSxFQUFFLE1BSFA7QUFJSEMsaUJBQU8sRUFBRSxpQkFBVUMsR0FBVixFQUFlO0FBQ3BCQyxvQkFBUSxDQUFDQyxNQUFULENBQWdCLElBQWhCO0FBQ0g7QUFORSxTQUFQO0FBUUgsT0FkRDtBQWVIO0FBQ0osR0FuQkQ7QUFxQkMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY3VzdG9tLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJChcIiNtZW51LXRvZ2dsZVwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uIChlKSB7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICQoXCIjd3JhcHBlclwiKS50b2dnbGVDbGFzcyhcInRvZ2dsZWRcIik7XG59KTtcblxuJChcIi5yZXN0b3JlXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAkKFwiI3JlY29yZC1uYW1lXCIpLnZhbCgkKHRoaXMpLmF0dHIoJ2RhdGEtbmFtZScpKTtcbiAgICAkKFwiI2ZybS1yZXN0b3JlXCIpLmF0dHIoXCJhY3Rpb25cIiwgJCh0aGlzKS5hdHRyKFwiZGF0YS1yb3V0ZVwiKSk7XG59KTtcblxuJChcIiNidG4tcmVzdG9yZVwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgICAkKHRoaXMpLnByb3AoJ2Rpc2FibGVkJywgdHJ1ZSkuaHRtbCgnQWd1YXJkZS4uLicpO1xuICAgICQoXCIjZnJtLXJlc3RvcmVcIikudHJpZ2dlcihcInN1Ym1pdFwiKTtcbn0pO1xuXG4kKFwiLmRlbGV0ZVwiKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uIChldmVudCkge1xuICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgJChcIiNyZWNvcmQtbmFtZS1kZWxldGVcIikudmFsKCQodGhpcykuYXR0cignZGF0YS1uYW1lLWRlbGV0ZScpKTtcbiAgICAkKFwiI2ZybS1kZWxldGVcIikuYXR0cihcImFjdGlvblwiLCAkKHRoaXMpLmF0dHIoXCJkYXRhLXJvdXRlLWRlbGV0ZVwiKSk7XG59KTtcblxuJChcIiNidG4tZGVsZXRlXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24gKCkge1xuICAgICQodGhpcykucHJvcCgnZGlzYWJsZWQnLCB0cnVlKS5odG1sKCdBZ3VhcmRlLi4uJyk7XG4gICAgLy8gJCgnI2ZybS1kZWxldGUnKS5zdWJtaXQoKTtcbiAgICAkKFwiI2ZybS1kZWxldGVcIikudHJpZ2dlcihcInN1Ym1pdFwiKTtcbn0pO1xuXG5zZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAkKFwiLmFsZXJ0XCIpLmFsZXJ0KCdjbG9zZScpO1xufSwgMzAwMCk7XG5cbiQoJy5zZWxlY3QyJykuc2VsZWN0Mih7XG4gICAgdGhlbWU6ICdib290c3RyYXA0Jyxcbn0pO1xuaWYgKCQoJyN0YWJsZScpLmxlbmd0aClcbntcbm1hc3NEZWxldGUoKTtcbnZhciB0YWJsZSA9ICQoJyN0YWJsZScpLkRhdGFUYWJsZSgpO1xuJCgnI3RhYmxlIHRib2R5Jykub24oJ2NsaWNrJywgJ3RyJywgZnVuY3Rpb24gKCkge1xuICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ3NlbGVjdGVkJyk7XG4gICAgbWFzc0RlbGV0ZSgpO1xufSk7XG5cbmZ1bmN0aW9uIG1hc3NEZWxldGUoKSB7XG4gICAgaWYgKCQoJyN0YWJsZSB0Ym9keSB0cicpLmhhc0NsYXNzKCdzZWxlY3RlZCcpKSB7XG4gICAgICAgICQoJyNtYXNzLWRlbGV0ZScpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKTtcbiAgICB9IGVsc2Uge1xuICAgICAgICAkKCcjbWFzcy1kZWxldGUnKS5hZGRDbGFzcygnZC1ub25lJyk7XG4gICAgfVxufVxuXG4kKCcjbWFzcy1kZWxldGUnKS5vbihcImNsaWNrXCIsIGZ1bmN0aW9uICgpIHtcbiAgICBsZXQgcm93ID0gJCgnI3RhYmxlIHRib2R5IHRyLnNlbGVjdGVkJyk7XG4gICAgaWYgKHJvdy5sZW5ndGggPiAwKSB7XG4gICAgICAgIHJvdy5lYWNoKGZ1bmN0aW9uIChpLCBlbGVtZW50KSB7XG4gICAgICAgICAgICAkLmFqYXhTZXR1cCh7XG4gICAgICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgJC5hamF4KHtcbiAgICAgICAgICAgICAgICB0eXBlOiAnREVMRVRFJyxcbiAgICAgICAgICAgICAgICB1cmw6ICQodGhpcykuYXR0cignZGVsZXRlLWlkJyksXG4gICAgICAgICAgICAgICAgZGF0YVR5cGU6ICdqc29uJyxcbiAgICAgICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbiAobXNnKSB7XG4gICAgICAgICAgICAgICAgICAgIGxvY2F0aW9uLnJlbG9hZCh0cnVlKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxufSk7XG5cbn1cbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/custom.js\n");

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/custom.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ewerton/personal-projects/desafio-desenvolvedor/resources/js/custom.js */"./resources/js/custom.js");


/***/ })

/******/ });