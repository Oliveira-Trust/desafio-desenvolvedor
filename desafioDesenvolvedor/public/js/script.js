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

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var currencyFrom = document.getElementById('currency_from');
var currencyTo = document.getElementById('currency_to');
var paymentType = document.getElementById('payment_type'); // validates if BRL is in range

document.getElementById('convert').addEventListener('click', function () {
  var message = document.getElementById('validation_range_value');
  currencyFrom.classList.remove('is-invalid');

  if (currencyFrom.value < 1000 || currencyFrom.value == '') {
    message.innerText = 'Valor deve ser maior que R$ 1.000,00';
    currencyFrom.classList.add('is-invalid');
    return false;
  }

  if (currencyFrom.value > 100000) {
    message.innerText = 'Valor deve ser menor que R$ 100.000,00';
    currencyFrom.classList.add('is-invalid');
    return false;
  }

  var price = priceQuotation(currencyTo.value);
  price.then(function (result) {
    sendValuesToController(currencyFrom.value, currencyTo.value, paymentType.value, result);
  });
});
/**
 *
 * @param {*} currencyTo
 * @returns data
 * @description Function to get the quote value
 */

function priceQuotation(currencyTo) {
  var url = "https://economia.awesomeapi.com.br/last/".concat(currencyTo, "-BRL");
  var settings = {
    method: 'GET',
    redirect: 'follow'
  };
  var data = fetch(url, settings).then(function (response) {
    return response.json();
  });
  return data;
}
/**
 *
 * @param {*} currencyFrom
 * @param {*} currencyTo
 * @param {*} paymentType
 * @param {*} currencyQuote
 * @description Function to send the information to the controller via ajax
 */


function sendValuesToController(currencyFrom, currencyTo, paymentType, currencyQuote) {
  var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  var url = document.getElementsByTagName('form')[0].getAttribute('action');
  var method = 'POST';
  var settings = {
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-TOKEN": token
    },
    method: method,
    credentials: "same-origin",
    body: JSON.stringify({
      currencyFrom: currencyFrom,
      currencyTo: currencyTo,
      paymentType: paymentType,
      currencyQuote: currencyQuote
    })
  };
  fetch(url, settings).then(function (response) {
    return response.text();
  }).then(function (result) {
    console.log(result);
  })["catch"](function (error) {
    return console.log('error', error);
  });
}

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/script.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\desafio-desenvolvedor\desafioDesenvolvedor\resources\js\script.js */"./resources/js/script.js");


/***/ })

/******/ });