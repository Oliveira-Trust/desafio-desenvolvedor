"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue_currency_input__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-currency-input */ "./node_modules/vue-currency-input/dist/index.esm.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'CurrencyInput',
  props: {
    modelValue: Number,
    // Vue 2: value
    options: Object
  },
  setup: function setup(props) {
    var _useCurrencyInput = (0,vue_currency_input__WEBPACK_IMPORTED_MODULE_0__.useCurrencyInput)(props.options),
        inputRef = _useCurrencyInput.inputRef;

    return {
      inputRef: inputRef
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=script&lang=js":
/*!****************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=script&lang=js ***!
  \****************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/transitions/transition.js");
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/dialog/dialog.js");
/* harmony import */ var _utils_getError__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/getError */ "./resources/js/utils/getError.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    TransitionRoot: _headlessui_vue__WEBPACK_IMPORTED_MODULE_1__.TransitionRoot,
    TransitionChild: _headlessui_vue__WEBPACK_IMPORTED_MODULE_1__.TransitionChild,
    Dialog: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.Dialog,
    DialogPanel: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.DialogPanel,
    DialogTitle: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.DialogTitle
  },
  data: function data() {
    return {
      isOpen: false,
      isLogin: true,
      isLoading: false,
      callback: null,
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      errors: {}
    };
  },
  methods: {
    fazerLogin: function fazerLogin(isLogin, value, callback) {
      if (this.$store.state.user.id > 0) {
        callback();
        return;
      }

      this.form = {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      };
      this.errors = {};
      this.isLoading = false;
      this.isLogin = isLogin;
      this.isOpen = value;
      this.callback = callback;
    },
    closeModal: function closeModal() {
      this.isOpen = false;
    },
    submit: function submit(forceLogin) {
      var _this = this;

      if (this.isLoading) {
        return;
      }

      this.isLoading = true;
      this.errors = {};
      var url = this.isLogin || forceLogin === true ? '/auth/login' : '/auth/register';
      this.axios.post(url, this.form).then(function (response) {
        _this.isLoading = false;

        if (_this.isLogin || forceLogin === true) {
          var user = response.data.user;

          _this.$store.commit('setUser', {
            id: user.id,
            name: user.name,
            email: user.email,
            is_admin: user.is_admin > 0,
            token: response.data.token
          });

          if (_this.callback && typeof _this.callback === "function") {
            _this.callback();
          }

          _this.closeModal();
        } else {
          //Fazer o login depois de realizar o cadastro
          _this.submit(true);
        }
      })["catch"](function (error) {
        _this.isLoading = false;

        if (error.response.status === 422 && error.response.data.errors) {
          _this.errors = error.response.data.errors;
        }
      });
    },
    logout: function logout() {
      var _this2 = this;

      this.axios.post('/auth/logout').then(function () {
        _this2.clearUserData();
      })["catch"](function (err) {
        _this2.clearUserData();
      });
    },
    clearUserData: function clearUserData() {
      this.$store.commit('removeUser');
      this.isLoading = true;
      this.errors = {};
    },
    getError: _utils_getError__WEBPACK_IMPORTED_MODULE_0__.getError
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js ***!
  \********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _utils_formatValue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/formatValue */ "./resources/js/utils/formatValue.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  mounted: function mounted() {
    this.load();
  },
  data: function data() {
    return {
      cotacoes: []
    };
  },
  methods: {
    load: function load() {
      var _this = this;

      this.axios.get('/api/quotation').then(function (response) {
        _this.cotacoes = response.data.data;
      });
    },
    formatValue: _utils_formatValue__WEBPACK_IMPORTED_MODULE_0__.formatValue
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=script&lang=js":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=script&lang=js ***!
  \***************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/transitions/transition.js");
/* harmony import */ var _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @headlessui/vue */ "./node_modules/@headlessui/vue/dist/components/dialog/dialog.js");
/* harmony import */ var _components_CurrencyInput__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/CurrencyInput */ "./resources/js/components/CurrencyInput.vue");
/* harmony import */ var _utils_getError__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/getError */ "./resources/js/utils/getError.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    TransitionRoot: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.TransitionRoot,
    TransitionChild: _headlessui_vue__WEBPACK_IMPORTED_MODULE_2__.TransitionChild,
    Dialog: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.Dialog,
    DialogPanel: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.DialogPanel,
    DialogTitle: _headlessui_vue__WEBPACK_IMPORTED_MODULE_3__.DialogTitle,
    CurrencyInput: _components_CurrencyInput__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      isOpen: false,
      isEdit: true,
      isLoading: false,
      callback: null,
      fee: null,
      form: this.resetForm(),
      errors: {}
    };
  },
  methods: {
    resetForm: function resetForm() {
      return {
        fee_type_id: 1,
        payment_type_id: 1,
        min_amount: 0,
        max_amount: 0,
        percent: 0,
        fixed_value: 0
      };
    },
    abrirModal: function abrirModal(fee, callback) {
      this.fee = fee;
      this.form = this.resetForm();
      this.errors = {};
      this.isLoading = false;
      this.isEdit = false;

      if (fee && fee.id > 0) {
        this.form = {
          fee_type_id: fee.fee_type_id,
          payment_type_id: fee.payment_type_id,
          min_amount: fee.min_amount,
          max_amount: fee.max_amount,
          percent: fee.percent,
          fixed_value: fee.fixed_value
        };
        this.isEdit = true;
      }

      this.isOpen = true;
      this.callback = callback;
    },
    closeModal: function closeModal() {
      if (this.callback && typeof this.callback === "function") {
        this.callback();
      }

      this.isOpen = false;
    },
    submit: function submit() {
      var _this = this;

      if (this.isLoading) {
        return;
      }

      this.isLoading = true;
      this.errors = {};

      if (!this.isEdit) {
        this.axios.post('/api/admin/fees', this.form).then(function (response) {
          _this.isLoading = false;

          _this.closeModal();
        })["catch"](function (error) {
          _this.isLoading = false;

          if (error.response.status === 422 && error.response.data.errors) {
            _this.errors = error.response.data.errors;
          }
        });
      } else {
        this.axios.put('/api/admin/fees/' + this.fee.id, this.form).then(function (response) {
          _this.isLoading = false;

          _this.closeModal();
        })["catch"](function (error) {
          _this.isLoading = false;

          if (error.response.status === 422 && error.response.data.errors) {
            _this.errors = error.response.data.errors;
          }
        });
      }
    },
    getError: _utils_getError__WEBPACK_IMPORTED_MODULE_1__.getError
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Quotation__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Quotation */ "./resources/js/pages/Quotation.vue");
/* harmony import */ var _components_LoginModal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/LoginModal */ "./resources/js/components/LoginModal.vue");
/* harmony import */ var _components_TaxaModal__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/TaxaModal */ "./resources/js/components/TaxaModal.vue");
/* harmony import */ var _components_MinhasCotacoes__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/MinhasCotacoes */ "./resources/js/components/MinhasCotacoes.vue");
/* harmony import */ var _utils_formatValue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../utils/formatValue */ "./resources/js/utils/formatValue.js");





/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    MinhasCotacoes: _components_MinhasCotacoes__WEBPACK_IMPORTED_MODULE_3__["default"],
    LoginModal: _components_LoginModal__WEBPACK_IMPORTED_MODULE_1__["default"],
    Quotation: _Quotation__WEBPACK_IMPORTED_MODULE_0__["default"],
    TaxaModal: _components_TaxaModal__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  computed: {
    isAdmin: function isAdmin() {
      return this.$store.state.user.is_admin;
    },
    isLoggedIn: function isLoggedIn() {
      return this.$store.state.user.id > 0;
    },
    name: function name() {
      return this.$store.state.user.name;
    }
  },
  mounted: function mounted() {
    this.buscarMoedas();
    this.buscarTaxas();
  },
  data: function data() {
    return {
      isAdminMode: false,
      isLoadingRefresh: false,
      moedas: [],
      taxas: []
    };
  },
  methods: {
    openLoginModal: function openLoginModal(isLogin) {
      if (this.$store.state.user.id > 0) {
        return;
      }

      this.$refs.loginModal.fazerLogin(isLogin, true);
    },
    logout: function logout() {
      this.isAdminMode = false;
      this.$refs.loginModal.logout();
    },
    carregarCotacoes: function carregarCotacoes() {
      this.$refs.cotacoes.load();
    },
    changeAdminMode: function changeAdminMode(value) {
      this.isAdminMode = value;
      this.buscarMoedas();
      this.buscarTaxas();
    },
    buscarMoedas: function buscarMoedas() {
      var _this = this;

      this.isLoadingRefresh = true;
      this.axios.get('/api/admin/currencies').then(function (response) {
        _this.isLoadingRefresh = false;
        _this.moedas = response.data.data;
      })["catch"](function () {
        _this.isLoadingRefresh = false;
      });
    },
    sincronizarMoedas: function sincronizarMoedas() {
      var _this2 = this;

      this.isLoadingRefresh = true;
      this.axios.get('/api/admin/currencies/refresh').then(function (response) {
        _this2.buscarMoedas();
      })["catch"](function () {
        _this2.isLoadingRefresh = false;
      });
    },
    buscarTaxas: function buscarTaxas() {
      var _this3 = this;

      this.axios.get('/api/admin/fees').then(function (response) {
        _this3.taxas = response.data.data;
      });
    },
    adicionarTaxa: function adicionarTaxa() {
      var _this4 = this;

      this.$refs.taxaModal.abrirModal(null, function () {
        _this4.buscarTaxas();
      });
    },
    editarTaxa: function editarTaxa(fee) {
      var _this5 = this;

      this.$refs.taxaModal.abrirModal(fee, function () {
        _this5.buscarTaxas();
      });
    },
    excluirTaxa: function excluirTaxa(fee) {
      var _this6 = this;

      if (window.confirm("Você tem certeza que quer excluir essa taxa?")) {
        this.axios["delete"]('/api/admin/fees/' + fee.id).then(function (response) {
          _this6.buscarTaxas();
        });
      }
    },
    formatValue: _utils_formatValue__WEBPACK_IMPORTED_MODULE_4__.formatValue
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_LoginModal__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/LoginModal */ "./resources/js/components/LoginModal.vue");
/* harmony import */ var _components_CurrencyInput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/CurrencyInput */ "./resources/js/components/CurrencyInput.vue");
/* harmony import */ var _utils_formatValue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../utils/formatValue */ "./resources/js/utils/formatValue.js");
/* harmony import */ var _utils_getError__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../utils/getError */ "./resources/js/utils/getError.js");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  components: {
    CurrencyInput: _components_CurrencyInput__WEBPACK_IMPORTED_MODULE_1__["default"],
    LoginModal: _components_LoginModal__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  mounted: function mounted() {
    $(function () {
      $('.has-input').click(function () {
        $(this).parent().find('input, select, textarea').click().focus();
      });
    });
  },
  computed: {
    currency_image_brazil: function currency_image_brazil() {
      return "/images/currencies/1.jpg";
    },
    currency_image: function currency_image() {
      return "/images/currencies/".concat(this.form.currency_id, ".jpg");
    }
  },
  data: function data() {
    return {
      form: {
        amount: 0,
        currency_id: 2,
        payment_type_id: 1
      },
      quotation: false,
      isLoading: false,
      errors: {},
      isEmailEnviado: false,
      isLoadingEmail: false
    };
  },
  methods: {
    submit: function submit() {
      var _this = this;

      if (this.isLoading) {
        return;
      }

      this.$refs.loginModal.fazerLogin(true, true, function () {
        _this.isLoading = true;
        _this.errors = {};

        _this.axios.post('/api/quotation', _this.form).then(function (response) {
          _this.quotation = response.data.data;
          _this.form = {
            amount: 0,
            currency_id: 2,
            payment_type_id: 1
          };

          _this.$emit('created');

          _this.isLoading = false;
        })["catch"](function (error) {
          _this.isLoading = false;

          if (error.response.status === 422 && error.response.data.errors) {
            _this.errors = error.response.data.errors;
          }
        });
      });
    },
    enviarEmail: function enviarEmail() {
      var _this2 = this;

      this.isLoadingEmail = true;
      this.axios.post("/api/quotation/".concat(this.quotation.id, "/email")).then(function () {
        _this2.isLoadingEmail = false;
        _this2.isEmailEnviado = true;
      })["catch"](function (error) {
        _this2.isLoadingEmail = false;
      });
    },
    limparCotacao: function limparCotacao() {
      this.quotation = false;
    },
    getError: _utils_getError__WEBPACK_IMPORTED_MODULE_3__.getError,
    formatValue: _utils_formatValue__WEBPACK_IMPORTED_MODULE_2__.formatValue
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e":
/*!***********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  ref: "inputRef",
  type: "text"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("input", _hoisted_1, null, 512
  /* NEED_PATCH */
  );
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f":
/*!********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f ***!
  \********************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "fixed inset-0 bg-black bg-opacity-25"
}, null, -1
/* HOISTED */
);

var _hoisted_2 = {
  "class": "fixed inset-0 overflow-y-auto"
};
var _hoisted_3 = {
  "class": "flex min-h-full items-center justify-center p-4 text-center"
};

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "email"
}, "Nome", -1
/* HOISTED */
);

var _hoisted_5 = {
  "class": "input-form-row"
};
var _hoisted_6 = {
  "class": "input-form-group h-10"
};
var _hoisted_7 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "email"
}, "E-mail", -1
/* HOISTED */
);

var _hoisted_9 = {
  "class": "input-form-row"
};
var _hoisted_10 = {
  "class": "input-form-group h-10"
};
var _hoisted_11 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "password"
}, "Senha", -1
/* HOISTED */
);

var _hoisted_13 = {
  "class": "input-form-row"
};
var _hoisted_14 = {
  "class": "input-form-group h-10"
};
var _hoisted_15 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "password_confirmation"
}, "Repetir senha", -1
/* HOISTED */
);

var _hoisted_17 = {
  "class": "input-form-row"
};
var _hoisted_18 = {
  "class": "input-form-group h-10"
};
var _hoisted_19 = {
  key: 0,
  "class": "msg-error"
};
var _hoisted_20 = {
  "class": "mt-10"
};
var _hoisted_21 = {
  key: 0,
  "class": "icon-loading mr-2"
};

var _hoisted_22 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "w-5 h-5",
  xmlns: "http://www.w3.org/2000/svg",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
})], -1
/* HOISTED */
);

var _hoisted_23 = [_hoisted_22];
var _hoisted_24 = {
  key: 1
};
var _hoisted_25 = {
  key: 2
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _this = this;

  var _component_TransitionChild = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionChild");

  var _component_DialogTitle = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DialogTitle");

  var _component_DialogPanel = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DialogPanel");

  var _component_Dialog = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Dialog");

  var _component_TransitionRoot = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionRoot");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_TransitionRoot, {
    appear: "",
    show: $data.isOpen,
    as: "template"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Dialog, {
        as: "div",
        onClose: $options.closeModal,
        "class": "relative z-10"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "duration-300 ease-out",
            "enter-from": "opacity-0",
            "enter-to": "opacity-100",
            leave: "duration-200 ease-in",
            "leave-from": "opacity-100",
            "leave-to": "opacity-0"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [_hoisted_1];
            }),
            _: 1
            /* STABLE */

          }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "duration-300 ease-out",
            "enter-from": "opacity-0 scale-95",
            "enter-to": "opacity-100 scale-100",
            leave: "duration-200 ease-in",
            "leave-from": "opacity-100 scale-100",
            "leave-to": "opacity-0 scale-95"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DialogPanel, {
                "class": "w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              }, {
                "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                  return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DialogTitle, {
                    as: "h3",
                    "class": "text-lg font-medium leading-6 text-gray-900"
                  }, {
                    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLogin ? 'Login' : 'Criar minha conta'), 1
                      /* TEXT */
                      )];
                    }),
                    _: 1
                    /* STABLE */

                  }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
                    onSubmit: _cache[4] || (_cache[4] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
                      return $options.submit && $options.submit.apply($options, arguments);
                    }, ["prevent"])),
                    "class": "mt-2"
                  }, [!$data.isLogin ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
                    key: 0,
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'name') !== ''
                    }])
                  }, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "text",
                    id: "name",
                    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
                      return $data.form.name = $event;
                    }),
                    placeholder: "Digite o seu nome"
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.name]])])]), $options.getError(_this.errors, 'name') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'name')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'email') !== ''
                    }])
                  }, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "email",
                    id: "email",
                    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
                      return $data.form.email = $event;
                    }),
                    placeholder: "Digite o seu email"
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.email]])])]), $options.getError(_this.errors, 'email') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'email')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'password') !== ''
                    }])
                  }, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "password",
                    id: "password",
                    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
                      return $data.form.password = $event;
                    }),
                    placeholder: "Digite a sua senha"
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.password]])])]), $options.getError(_this.errors, 'password') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'password')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), !$data.isLogin ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
                    key: 1,
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'password_confirmation') !== ''
                    }])
                  }, [_hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "password",
                    id: "password_confirmation",
                    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
                      return $data.form.password_confirmation = $event;
                    }),
                    placeholder: "Digite a sua senha novamente"
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.password_confirmation]])])]), $options.getError(_this.errors, 'password_confirmation') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_19, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'password_confirmation')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["button-login", {
                      'button-loading': $data.isLoading
                    }])
                  }, [$data.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_21, _hoisted_23)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_24, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLogin ? 'Realizando login...' : 'Realizando cadastro...'), 1
                  /* TEXT */
                  )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLogin ? 'Entrar' : 'Fazer cadastro'), 1
                  /* TEXT */
                  ))], 2
                  /* CLASS */
                  )])], 32
                  /* HYDRATE_EVENTS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
                    type: "button",
                    onClick: _cache[5] || (_cache[5] = function ($event) {
                      return $data.isLogin = !$data.isLogin;
                    }),
                    "class": "button-link mt-10"
                  }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLogin ? 'Não tem conta? Clique aqui para criar a sua conta gratuitamente.' : 'Já tem uma conta? Clique aqui para fazer o login.'), 1
                  /* TEXT */
                  )];
                }),
                _: 1
                /* STABLE */

              })];
            }),
            _: 1
            /* STABLE */

          })])])];
        }),
        _: 1
        /* STABLE */

      }, 8
      /* PROPS */
      , ["onClose"])];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["show"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46":
/*!************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46 ***!
  \************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "minhas-cotacoes"
};

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Minhas cotações", -1
/* HOISTED */
);

var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Data"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Valor em reais"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Preço de conversão"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Taxas"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Valor que você receberá")])], -1
/* HOISTED */
);

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br", null, null, -1
/* HOISTED */
);

var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br", null, null, -1
/* HOISTED */
);

var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br", null, null, -1
/* HOISTED */
);

var _hoisted_7 = {
  "class": "value"
};
var _hoisted_8 = {
  key: 0
};

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
  colspan: "5"
}, "Nenhuma cotação realizada.", -1
/* HOISTED */
);

var _hoisted_10 = [_hoisted_9];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", null, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.cotacoes, function (cotacao) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(cotacao.created_at), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(cotacao.amount)), 1
    /* TEXT */
    ), _hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Pagamento: " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(cotacao.payment_type_description), 1
    /* TEXT */
    )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(cotacao.price)), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Taxa de pagamento: R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(cotacao.fees['1'])), 1
    /* TEXT */
    ), _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Taxa de conversão: R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(cotacao.fees['2'])), 1
    /* TEXT */
    ), _hoisted_6]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(cotacao.exchanged_amount)) + " " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(cotacao.currency_code), 1
    /* TEXT */
    )]);
  }), 256
  /* UNKEYED_FRAGMENT */
  )), $data.cotacoes.length === 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", _hoisted_8, _hoisted_10)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc":
/*!*******************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "fixed inset-0 bg-black bg-opacity-25"
}, null, -1
/* HOISTED */
);

var _hoisted_2 = {
  "class": "fixed inset-0 overflow-y-auto"
};
var _hoisted_3 = {
  "class": "flex min-h-full items-center justify-center p-4 text-center"
};

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Qual o tipo de taxa?", -1
/* HOISTED */
);

var _hoisted_5 = {
  "class": "input-form-row no-shadow"
};
var _hoisted_6 = {
  "class": "flex mr-10 items-center"
};

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "fee_type_id_1",
  "class": "ml-2"
}, "Forma de pagamento", -1
/* HOISTED */
);

var _hoisted_8 = {
  "class": "flex mr-10 items-center"
};

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "fee_type_id_2",
  "class": "ml-2"
}, "Taxa de conversão", -1
/* HOISTED */
);

var _hoisted_10 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "Qual a forma de pagamento?", -1
/* HOISTED */
);

var _hoisted_12 = {
  "class": "input-form-row no-shadow"
};
var _hoisted_13 = {
  "class": "flex mr-10 items-center"
};

var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "payment_type_id_1",
  "class": "ml-2"
}, "Boleto", -1
/* HOISTED */
);

var _hoisted_15 = {
  "class": "flex mr-10 items-center"
};

var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "payment_type_id_2",
  "class": "ml-2"
}, "Cartão de crédito", -1
/* HOISTED */
);

var _hoisted_17 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_18 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "min_amount"
}, "Valor mínimo", -1
/* HOISTED */
);

var _hoisted_19 = {
  "class": "input-form-row h-10"
};
var _hoisted_20 = {
  "class": "input-form-group"
};

var _hoisted_21 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "has-input"
}, "BRL", -1
/* HOISTED */
);

var _hoisted_22 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_23 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "max_amount"
}, "Valor máximo", -1
/* HOISTED */
);

var _hoisted_24 = {
  "class": "input-form-row h-10"
};
var _hoisted_25 = {
  "class": "input-form-group"
};

var _hoisted_26 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "has-input"
}, "BRL", -1
/* HOISTED */
);

var _hoisted_27 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_28 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "percent"
}, "Taxa em porcentagem (%)", -1
/* HOISTED */
);

var _hoisted_29 = {
  "class": "input-form-row h-10"
};
var _hoisted_30 = {
  "class": "input-form-group"
};

var _hoisted_31 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "has-input"
}, "%", -1
/* HOISTED */
);

var _hoisted_32 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_33 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "fixed_value"
}, "Taxa fixa (R$)", -1
/* HOISTED */
);

var _hoisted_34 = {
  "class": "input-form-row h-10"
};
var _hoisted_35 = {
  "class": "input-form-group"
};

var _hoisted_36 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "has-input"
}, "BRL", -1
/* HOISTED */
);

var _hoisted_37 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("small", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Útil caso precisar uma porcentagem + um pequeno valor fixo. "), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Ex: 4% + R$1,50")], -1
/* HOISTED */
);

var _hoisted_38 = {
  key: 0,
  "class": "msg-error"
};
var _hoisted_39 = {
  "class": "mt-10"
};
var _hoisted_40 = {
  key: 0,
  "class": "icon-loading mr-2"
};

var _hoisted_41 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "w-5 h-5",
  xmlns: "http://www.w3.org/2000/svg",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
})], -1
/* HOISTED */
);

var _hoisted_42 = [_hoisted_41];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _this = this;

  var _component_TransitionChild = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionChild");

  var _component_DialogTitle = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DialogTitle");

  var _component_CurrencyInput = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("CurrencyInput");

  var _component_DialogPanel = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DialogPanel");

  var _component_Dialog = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Dialog");

  var _component_TransitionRoot = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TransitionRoot");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_TransitionRoot, {
    appear: "",
    show: $data.isOpen,
    as: "template"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Dialog, {
        as: "div",
        onClose: $options.closeModal,
        "class": "relative z-10"
      }, {
        "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
          return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "duration-300 ease-out",
            "enter-from": "opacity-0",
            "enter-to": "opacity-100",
            leave: "duration-200 ease-in",
            "leave-from": "opacity-100",
            "leave-to": "opacity-0"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [_hoisted_1];
            }),
            _: 1
            /* STABLE */

          }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TransitionChild, {
            as: "template",
            enter: "duration-300 ease-out",
            "enter-from": "opacity-0 scale-95",
            "enter-to": "opacity-100 scale-100",
            leave: "duration-200 ease-in",
            "leave-from": "opacity-100 scale-100",
            "leave-to": "opacity-0 scale-95"
          }, {
            "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
              return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DialogPanel, {
                "class": "w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              }, {
                "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                  return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DialogTitle, {
                    as: "h3",
                    "class": "text-lg font-medium leading-6 text-gray-900"
                  }, {
                    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
                      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isEdit ? 'Editar taxa' : 'Cadastrar taxa'), 1
                      /* TEXT */
                      )];
                    }),
                    _: 1
                    /* STABLE */

                  }), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", {
                    onSubmit: _cache[8] || (_cache[8] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
                      return $options.submit && $options.submit.apply($options, arguments);
                    }, ["prevent"])),
                    "class": "mt-2"
                  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'fee_type_id') !== ''
                    }])
                  }, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "radio",
                    id: "fee_type_id_1",
                    name: "fee_type_id",
                    value: 1,
                    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
                      return $data.form.fee_type_id = $event;
                    })
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.fee_type_id]]), _hoisted_7]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "radio",
                    id: "fee_type_id_2",
                    name: "fee_type_id",
                    value: 2,
                    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
                      return $data.form.fee_type_id = $event;
                    })
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.fee_type_id]]), _hoisted_9])]), $options.getError(_this.errors, 'fee_type_id') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'fee_type_id')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), $data.form.fee_type_id === 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
                    key: 0,
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'payment_type_id') !== ''
                    }])
                  }, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "radio",
                    id: "payment_type_id_1",
                    name: "payment_type_id",
                    value: 1,
                    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
                      return $data.form.payment_type_id = $event;
                    })
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.payment_type_id]]), _hoisted_14]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
                    type: "radio",
                    id: "payment_type_id_2",
                    name: "payment_type_id",
                    value: 2,
                    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
                      return $data.form.payment_type_id = $event;
                    })
                  }, null, 512
                  /* NEED_PATCH */
                  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.payment_type_id]]), _hoisted_16])]), $options.getError(_this.errors, 'payment_type_id') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'payment_type_id')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'min_amount') !== ''
                    }])
                  }, [_hoisted_18, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [_hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_CurrencyInput, {
                    id: "min_amount",
                    modelValue: $data.form.min_amount,
                    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
                      return $data.form.min_amount = $event;
                    }),
                    options: {
                      currency: 'BRL',
                      hideCurrencySymbolOnFocus: true,
                      autoDecimalDigits: true,
                      precision: 2
                    }
                  }, null, 8
                  /* PROPS */
                  , ["modelValue"])])]), $options.getError(_this.errors, 'min_amount') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_22, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'min_amount')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'max_amount') !== ''
                    }])
                  }, [_hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_25, [_hoisted_26, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_CurrencyInput, {
                    id: "max_amount",
                    modelValue: $data.form.max_amount,
                    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
                      return $data.form.max_amount = $event;
                    }),
                    options: {
                      currency: 'BRL',
                      hideCurrencySymbolOnFocus: true,
                      autoDecimalDigits: true,
                      precision: 2
                    }
                  }, null, 8
                  /* PROPS */
                  , ["modelValue"])])]), $options.getError(_this.errors, 'max_amount') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'max_amount')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'percent') !== ''
                    }])
                  }, [_hoisted_28, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_29, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_30, [_hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_CurrencyInput, {
                    id: "percent",
                    modelValue: $data.form.percent,
                    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
                      return $data.form.percent = $event;
                    }),
                    options: {
                      currency: 'BRL',
                      currencyDisplay: 'hidden',
                      hideCurrencySymbolOnFocus: true,
                      autoDecimalDigits: true,
                      precision: 2
                    }
                  }, null, 8
                  /* PROPS */
                  , ["modelValue"])])]), $options.getError(_this.errors, 'percent') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_32, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'percent')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
                      'has-errors': $options.getError(_this.errors, 'fixed_value') !== ''
                    }])
                  }, [_hoisted_33, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [_hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_CurrencyInput, {
                    id: "fixed_value",
                    modelValue: $data.form.fixed_value,
                    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
                      return $data.form.fixed_value = $event;
                    }),
                    options: {
                      currency: 'BRL',
                      hideCurrencySymbolOnFocus: true,
                      autoDecimalDigits: true,
                      precision: 2
                    }
                  }, null, 8
                  /* PROPS */
                  , ["modelValue"])])]), _hoisted_37, $options.getError(_this.errors, 'fixed_value') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(_this.errors, 'fixed_value')), 1
                  /* TEXT */
                  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
                  /* CLASS */
                  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
                    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["button-login", {
                      'button-loading': $data.isLoading
                    }])
                  }, [$data.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_40, _hoisted_42)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLoading ? 'Gravando...' : 'Gravar'), 1
                  /* TEXT */
                  )], 2
                  /* CLASS */
                  )])], 32
                  /* HYDRATE_EVENTS */
                  )];
                }),
                _: 1
                /* STABLE */

              })];
            }),
            _: 1
            /* STABLE */

          })])])];
        }),
        _: 1
        /* STABLE */

      }, 8
      /* PROPS */
      , ["onClose"])];
    }),
    _: 1
    /* STABLE */

  }, 8
  /* PROPS */
  , ["show"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=template&id=71c33819":
/*!**********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=template&id=71c33819 ***!
  \**********************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "fixed w-full bg-white"
};
var _hoisted_2 = {
  "class": "container m-auto px-6 md:px-12 lg:px-6"
};
var _hoisted_3 = {
  "class": "flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0"
};

var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"w-full flex justify-between lg:w-auto\"><a href=\"#\" aria-label=\"logo\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-24 w-24\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg></a><button aria-label=\"humburger\" id=\"hamburger\" class=\"relative w-10 h-10 -mr-2 lg:hidden\"><div aria-hidden=\"true\" id=\"line\" class=\"inset-0 w-6 h-0.5 m-auto rounded bg-gray-500 transtion duration-300\"></div><div aria-hidden=\"true\" id=\"line2\" class=\"inset-0 w-6 h-0.5 mt-2 m-auto rounded bg-gray-500 transtion duration-300\"></div></button></div>", 1);

var _hoisted_5 = {
  hidden: "",
  "class": "w-full bg-white md:space-y-0 md:p-0 md:flex-nowrap md:bg-transparent lg:w-auto lg:flex"
};
var _hoisted_6 = {
  "class": "block w-full lg:items-center lg:flex"
};

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", {
  "class": "space-y-6 pb-6 tracking-wide font-medium text-gray-600 lg:pb-0 lg:pr-6 lg:items-center lg:flex lg:space-y-0"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
  href: "#",
  "class": "block md:px-3"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Cotação online")])]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
  href: "#",
  "class": "block md:px-3"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Moedas disponíveis")])]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
  href: "#",
  "class": "block md:px-3"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Saiba mais")])])], -1
/* HOISTED */
);

var _hoisted_8 = {
  "class": "border-t space-y-2 pt-2 lg:space-y-0 lg:space-x-2 lg:pt-0 lg:pl-2 lg:border-t-0 lg:border-l lg:items-center lg:flex"
};
var _hoisted_9 = {
  key: 0
};
var _hoisted_10 = {
  key: 1
};
var _hoisted_11 = {
  key: 2
};
var _hoisted_12 = {
  key: 3,
  "class": "ml-4"
};
var _hoisted_13 = {
  key: 4
};
var _hoisted_14 = {
  "class": "pt-32 pb-20 md:pt-40"
};
var _hoisted_15 = {
  key: 0,
  "class": "container m-auto px-6 md:px-12 lg:px-6"
};
var _hoisted_16 = {
  "class": "lg:flex lg:items-center lg:gap-x-16"
};

var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"space-y-8 lg:w-7/12\"><h1 class=\"font-bold text-gray-900 text-4xl md:text-5xl\">Fazer uma cotação online ficou ainda mais fácil com nossa ferramenta.</h1><p class=\"text-gray-600 lg:w-11/12\"> Faça uma cotação em BRL com as principais moedas do mundo. <br>Veja como é fácil. </p><span class=\"block font-semibold\">Siga os passos abaixo</span><div class=\"grid grid-cols-3 space-x-4 md:space-x-6 md:flex\"><a aria-label=\"add to slack\" href=\"#\" class=\"p-4 border border-gray-200 rounded-md hover:border-cyan-400 hover:shadow-lg\"><div class=\"flex justify-center space-x-4\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z\"></path></svg><span class=\"hidden font-medium md:block\">Escolha o valor em real (BRL)</span></div></a><a aria-label=\"add to chat\" href=\"#\" class=\"p-4 border border-gray-200 rounded-md hover:border-green-400 hover:shadow-lg\"><div class=\"flex justify-center space-x-4\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg><span class=\"hidden font-medium md:block\">Escolha a moeda de destino</span></div></a><a aria-label=\"add to zoom\" href=\"#\" class=\"p-4 border border-gray-200 rounded-md hover:border-blue-400 hover:shadow-lg\"><div class=\"flex justify-center space-x-4\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z\"></path></svg><span class=\"hidden font-medium md:block\">Pronto, simples assim!</span></div></a></div><div class=\"flex\"> 🔥🌟 <span>Você poderá também receber a cotação por </span><span class=\"font-semibold text-gray-700 flex\"><svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6 ml-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" stroke-width=\"2\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" d=\"M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z\"></path></svg> EMAIL </span></div></div>", 1);

var _hoisted_18 = {
  "class": "lg:block lg:w-5/12"
};
var _hoisted_19 = {
  key: 0,
  "class": "w-full"
};
var _hoisted_20 = {
  key: 1,
  "class": "container m-auto px-6 md:px-12 lg:px-6"
};
var _hoisted_21 = {
  "class": "flex flex-col"
};
var _hoisted_22 = {
  "class": "w-4/12"
};

var _hoisted_23 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Cotações", -1
/* HOISTED */
);

var _hoisted_24 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Moeda"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Preço Atual"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Data de alteração")])], -1
/* HOISTED */
);

var _hoisted_25 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-6 w-6",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
})], -1
/* HOISTED */
);

var _hoisted_26 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("p", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("small", null, "O sistema de cotação está configurado para atualizar os preços automaticamente a cada 1 hora. Essa opção pode ser fácilmente alterada.")], -1
/* HOISTED */
);

var _hoisted_27 = {
  "class": "w-full mt-20"
};

var _hoisted_28 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Taxas", -1
/* HOISTED */
);

var _hoisted_29 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Tipo"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Valor min."), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Valor max."), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Taxa (%)"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Taxa Fixa (R$)"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Atualizado em"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  colspan: "2"
}, "Ações")])], -1
/* HOISTED */
);

var _hoisted_30 = {
  key: 0
};
var _hoisted_31 = ["onClick"];

var _hoisted_32 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-6 w-6",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
})], -1
/* HOISTED */
);

var _hoisted_33 = [_hoisted_32];
var _hoisted_34 = ["onClick"];

var _hoisted_35 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-6 w-6",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M6 18L18 6M6 6l12 12"
})], -1
/* HOISTED */
);

var _hoisted_36 = [_hoisted_35];

var _hoisted_37 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  "class": "h-6 w-6",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M12 4v16m8-8H4"
})], -1
/* HOISTED */
);

var _hoisted_38 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Adicionar taxa ");

var _hoisted_39 = [_hoisted_37, _hoisted_38];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_Quotation = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Quotation");

  var _component_minhas_cotacoes = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("minhas-cotacoes");

  var _component_login_modal = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("login-modal");

  var _component_taxa_modal = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("taxa-modal");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("header", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("nav", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_8, [!$options.isLoggedIn ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[0] || (_cache[0] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.openLoginModal(false);
    }, ["prevent"])),
    type: "button",
    "class": "w-full py-3 px-6 rounded-md text-center transition active:bg-sky-200 focus:bg-sky-100 sm:w-max block text-cyan-600 font-semibold"
  }, " Criar uma conta grátis ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), !$options.isLoggedIn ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.openLoginModal(true);
    }, ["prevent"])),
    type: "button",
    "class": "w-full py-3 px-6 rounded-md text-center transition bg-cyan-500 hover:bg-cyan-600 active:bg-cyan-700 focus:bg-sky-600 sm:w-max font-semibold text-white"
  }, " Fazer login ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $options.isLoggedIn && $options.isAdmin ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_11, [!$data.isAdminMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    onClick: _cache[2] || (_cache[2] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.changeAdminMode(true);
    }, ["prevent"])),
    type: "button",
    "class": "w-full py-3 px-6 rounded-md text-center transition bg-red-500 hover:bg-red-600 active:bg-red-700 focus:bg-red-600 sm:w-max font-semibold text-white"
  }, " Ir para o painel Administrativo ")) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 1,
    onClick: _cache[3] || (_cache[3] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.changeAdminMode(false);
    }, ["prevent"])),
    type: "button",
    "class": "w-full py-3 px-6 rounded-md text-center transition bg-cyan-500 hover:bg-cyan-600 active:bg-cyan-700 focus:bg-sky-600 sm:w-max font-semibold text-white"
  }, " Ir para o painel de cotações "))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $options.isLoggedIn ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.name), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $options.isLoggedIn ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[4] || (_cache[4] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.logout && $options.logout.apply($options, arguments);
    }, ["prevent"])),
    type: "button",
    "class": "w-full py-3 px-6 rounded-md text-center transition active:bg-sky-200 focus:bg-sky-100 sm:w-max block text-cyan-600 font-semibold"
  }, " Sair ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [!$data.isAdminMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_Quotation, {
    onCreated: $options.carregarCotacoes
  }, null, 8
  /* PROPS */
  , ["onCreated"])])]), $options.isLoggedIn ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_minhas_cotacoes, {
    ref: "cotacoes"
  }, null, 512
  /* NEED_PATCH */
  )])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [_hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", null, [_hoisted_24, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.moedas, function (moeda) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(moeda.code), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(moeda.last_price), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(moeda.created_at), 1
    /* TEXT */
    )]);
  }), 256
  /* UNKEYED_FRAGMENT */
  ))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "button-link my-5 p-2",
    onClick: _cache[5] || (_cache[5] = function () {
      return $options.sincronizarMoedas && $options.sincronizarMoedas.apply($options, arguments);
    })
  }, [_hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLoadingRefresh ? 'Atualizando...' : 'Sincronizar utilizando a API'), 1
  /* TEXT */
  )]), _hoisted_26]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [_hoisted_28, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", null, [_hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.taxas, function (taxa) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(taxa.fee_type_description) + " ", 1
    /* TEXT */
    ), taxa.fee_type_id === 1 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(taxa.payment_type_description), 1
    /* TEXT */
    )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(taxa.min_amount)), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(taxa.max_amount)), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(taxa.percent)) + "%", 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue(taxa.fixed_value)), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(taxa.updated_at), 1
    /* TEXT */
    ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      onClick: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
        return $options.editarTaxa(taxa);
      }, ["prevent"]),
      title: "Editar"
    }, _hoisted_33, 8
    /* PROPS */
    , _hoisted_31)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      onClick: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
        return $options.excluirTaxa(taxa);
      }, ["prevent"]),
      title: "Excluir"
    }, _hoisted_36, 8
    /* PROPS */
    , _hoisted_34)])]);
  }), 256
  /* UNKEYED_FRAGMENT */
  ))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "button-link my-5 p-2",
    onClick: _cache[6] || (_cache[6] = function () {
      return $options.adicionarTaxa && $options.adicionarTaxa.apply($options, arguments);
    })
  }, _hoisted_39)])])]))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_login_modal, {
    ref: "loginModal"
  }, null, 512
  /* NEED_PATCH */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_taxa_modal, {
    ref: "taxaModal"
  }, null, 512
  /* NEED_PATCH */
  )]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a":
/*!**************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a ***!
  \**************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Preencha os campos abaixos e realize a sua cotação agora mesmo.", -1
/* HOISTED */
);

var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "amount"
}, "Valor em reais", -1
/* HOISTED */
);

var _hoisted_3 = {
  "class": "input-form-row"
};
var _hoisted_4 = ["src"];
var _hoisted_5 = {
  "class": "input-form-group"
};

var _hoisted_6 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "has-input"
}, "BRL", -1
/* HOISTED */
);

var _hoisted_7 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "currency_id"
}, "Qual moeda gostaria de comprar?", -1
/* HOISTED */
);

var _hoisted_9 = {
  "class": "input-form-row"
};
var _hoisted_10 = ["src"];
var _hoisted_11 = {
  "class": "input-form-group pr-4"
};

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: 2
}, "(USD) Dólar Americano", -1
/* HOISTED */
);

var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: 3
}, "(EUR) Euro", -1
/* HOISTED */
);

var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: 4
}, "(GBP) Libra Esterlina", -1
/* HOISTED */
);

var _hoisted_15 = [_hoisted_12, _hoisted_13, _hoisted_14];
var _hoisted_16 = {
  key: 0,
  "class": "msg-error"
};

var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "currency_id"
}, "Como gostaria de fazer o pagamento?", -1
/* HOISTED */
);

var _hoisted_18 = {
  "class": "input-form-row no-shadow"
};
var _hoisted_19 = {
  "class": "flex mr-10"
};

var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "radio-image has-input"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
  src: "/images/boleto.png",
  alt: "Boleto",
  title: "Boleto",
  "class": "h-10"
}), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "payment_type_id_1"
}, "Boleto")], -1
/* HOISTED */
);

var _hoisted_21 = {
  "class": "flex"
};

var _hoisted_22 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "radio-image has-input"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
  src: "/images/cartao-de-credito.png",
  alt: "Cartão de crédito",
  title: "Cartão de crédito",
  "class": "h-10"
}), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "payment_type_id_2"
}, "Cartão de crédito")], -1
/* HOISTED */
);

var _hoisted_23 = {
  key: 0,
  "class": "msg-error"
};
var _hoisted_24 = {
  "class": "input-form"
};
var _hoisted_25 = {
  key: 0,
  "class": "icon-loading mr-2"
};

var _hoisted_26 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("svg", {
  "class": "w-5 h-5",
  xmlns: "http://www.w3.org/2000/svg",
  fill: "none",
  viewBox: "0 0 24 24",
  stroke: "currentColor",
  "stroke-width": "2"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("path", {
  "stroke-linecap": "round",
  "stroke-linejoin": "round",
  d: "M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
})], -1
/* HOISTED */
);

var _hoisted_27 = [_hoisted_26];
var _hoisted_28 = {
  key: 1
};
var _hoisted_29 = {
  key: 2
};
var _hoisted_30 = {
  key: 1,
  "class": "quotation resultado"
};

var _hoisted_31 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h1", null, "Parabéns, sua cotação foi realizada com sucesso.", -1
/* HOISTED */
);

var _hoisted_32 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Você pagará ");

var _hoisted_33 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "separator"
}, null, -1
/* HOISTED */
);

var _hoisted_34 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Preço utilizado na conversão ");

var _hoisted_35 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "separator"
}, null, -1
/* HOISTED */
);

var _hoisted_36 = {
  "class": "taxas"
};

var _hoisted_37 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, "Taxas", -1
/* HOISTED */
);

var _hoisted_38 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Taxa de pagamento", -1
/* HOISTED */
);

var _hoisted_39 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "separator"
}, null, -1
/* HOISTED */
);

var _hoisted_40 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Taxa de conversão", -1
/* HOISTED */
);

var _hoisted_41 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "separator"
}, null, -1
/* HOISTED */
);

var _hoisted_42 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Você receberá ");

var _hoisted_43 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "separator"
}, null, -1
/* HOISTED */
);

var _hoisted_44 = {
  "class": "text-red-500"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_CurrencyInput = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("CurrencyInput");

  var _component_login_modal = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("login-modal");

  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", null, [$data.quotation === false ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("form", {
    key: 0,
    onSubmit: _cache[4] || (_cache[4] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.submit && $options.submit.apply($options, arguments);
    }, ["prevent"])),
    "class": "quotation"
  }, [_hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
      'has-errors': $options.getError(this.errors, 'amount') !== ''
    }])
  }, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $options.currency_image_brazil,
    "class": "h-10"
  }, null, 8
  /* PROPS */
  , _hoisted_4), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [_hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_CurrencyInput, {
    id: "amount",
    modelValue: $data.form.amount,
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.form.amount = $event;
    }),
    options: {
      currency: 'BRL',
      hideCurrencySymbolOnFocus: false,
      autoDecimalDigits: true,
      precision: 2
    }
  }, null, 8
  /* PROPS */
  , ["modelValue"])])]), $options.getError(this.errors, 'amount') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(this.errors, 'amount')), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
  /* CLASS */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
      'has-errors': $options.getError(this.errors, 'currency_id') !== ''
    }])
  }, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("img", {
    src: $options.currency_image,
    "class": "h-10"
  }, null, 8
  /* PROPS */
  , _hoisted_10), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    id: "currency_id",
    name: "currency_id",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.form.currency_id = $event;
    })
  }, _hoisted_15, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.currency_id]])])]), $options.getError(this.errors, 'currency_id') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(this.errors, 'currency_id')), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
  /* CLASS */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["input-form", {
      'has-errors': $options.getError(this.errors, 'payment_type_id') !== ''
    }])
  }, [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_19, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    id: "payment_type_id_1",
    name: "payment_type_id",
    value: 1,
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $data.form.payment_type_id = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.payment_type_id]]), _hoisted_20]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "radio",
    id: "payment_type_id_2",
    name: "payment_type_id",
    value: 2,
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $data.form.payment_type_id = $event;
    })
  }, null, 512
  /* NEED_PATCH */
  ), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio, $data.form.payment_type_id]]), _hoisted_22])]), $options.getError(this.errors, 'payment_type_id') !== '' ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("p", _hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.getError(this.errors, 'payment_type_id')), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)], 2
  /* CLASS */
  ), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_24, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
      'button-loading': $data.isLoading
    })
  }, [$data.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_25, _hoisted_27)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.isLoading ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_28, "Processando...")) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_29, "Fazer cotação agora"))], 2
  /* CLASS */
  )])], 32
  /* HYDRATE_EVENTS */
  )) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_30, [_hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_32, _hoisted_33, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue($data.quotation.amount)), 1
  /* TEXT */
  )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_34, _hoisted_35, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue($data.quotation.price)), 1
  /* TEXT */
  )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_36, [_hoisted_37, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_38, _hoisted_39, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue($data.quotation.fees['1'])), 1
  /* TEXT */
  )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_40, _hoisted_41, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "R$" + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue($data.quotation.fees['2'])), 1
  /* TEXT */
  )])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [_hoisted_42, _hoisted_43, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", _hoisted_44, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("b", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.formatValue($data.quotation.exchanged_amount)) + " " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.quotation.currency_code), 1
  /* TEXT */
  )])]), !$data.isEmailEnviado ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    type: "button",
    onClick: _cache[5] || (_cache[5] = function () {
      return $options.enviarEmail && $options.enviarEmail.apply($options, arguments);
    }),
    "class": "button-link mt-10"
  }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.isLoadingEmail ? 'Enviando email....' : 'Deseja enviar essa cotação por email? Clique aqui.'), 1
  /* TEXT */
  )) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.isEmailEnviado ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 1,
    type: "button",
    onClick: _cache[6] || (_cache[6] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {}, ["prevent"])),
    "class": "button-link mt-10"
  }, " Email enviado com sucesso. ")) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    onClick: _cache[7] || (_cache[7] = function () {
      return $options.limparCotacao && $options.limparCotacao.apply($options, arguments);
    }),
    "class": "button-link mt-2"
  }, " Realizar uma nova cotação. ")])), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_login_modal, {
    ref: "loginModal"
  }, null, 512
  /* NEED_PATCH */
  )]);
}

/***/ }),

/***/ "./resources/js/utils/formatValue.js":
/*!*******************************************!*\
  !*** ./resources/js/utils/formatValue.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "formatValue": () => (/* binding */ formatValue)
/* harmony export */ });
function formatValue(value) {
  return new Intl.NumberFormat('en-us', {
    style: 'decimal',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(value);
}

/***/ }),

/***/ "./resources/js/utils/getError.js":
/*!****************************************!*\
  !*** ./resources/js/utils/getError.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getError": () => (/* binding */ getError)
/* harmony export */ });
function getError(objErrors, field) {
  var err = objErrors[field];

  if (err && err.length > 0) {
    return err[0];
  }

  return '';
}

/***/ }),

/***/ "./node_modules/vue-currency-input/dist/index.esm.js":
/*!***********************************************************!*\
  !*** ./node_modules/vue-currency-input/dist/index.esm.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CurrencyDisplay": () => (/* binding */ CurrencyDisplay),
/* harmony export */   "ValueScaling": () => (/* binding */ ValueScaling),
/* harmony export */   "default": () => (/* binding */ useCurrencyInput),
/* harmony export */   "parse": () => (/* binding */ parse),
/* harmony export */   "useCurrencyInput": () => (/* binding */ useCurrencyInput)
/* harmony export */ });
/* harmony import */ var vue_demi__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-demi */ "./node_modules/vue-demi/lib/index.mjs");
/**
 * Vue Currency Input 2.4.0
 * (c) 2018-2022 Matthias Stiller
 * @license MIT
 */


const escapeRegExp = (str) => {
    return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
};
const removeLeadingZeros = (str) => {
    return str.replace(/^0+(0$|[^0])/, '$1');
};
const count = (str, search) => {
    return (str.match(new RegExp(escapeRegExp(search), 'g')) || []).length;
};
const substringBefore = (str, search) => {
    return str.substring(0, str.indexOf(search));
};

var CurrencyDisplay;
(function (CurrencyDisplay) {
    CurrencyDisplay["symbol"] = "symbol";
    CurrencyDisplay["narrowSymbol"] = "narrowSymbol";
    CurrencyDisplay["code"] = "code";
    CurrencyDisplay["name"] = "name";
    CurrencyDisplay["hidden"] = "hidden";
})(CurrencyDisplay || (CurrencyDisplay = {}));
var ValueScaling;
(function (ValueScaling) {
    ValueScaling["precision"] = "precision";
    ValueScaling["thousands"] = "thousands";
    ValueScaling["millions"] = "millions";
    ValueScaling["billions"] = "billions";
})(ValueScaling || (ValueScaling = {}));

const DECIMAL_SEPARATORS = [',', '.', '٫'];
const INTEGER_PATTERN = '(0|[1-9]\\d*)';
class CurrencyFormat {
    constructor(options) {
        var _a, _b, _c, _d, _e, _f;
        const { currency, currencyDisplay, locale, precision, accountingSign } = options;
        this.locale = locale;
        this.options = {
            style: 'currency',
            currency,
            currencySign: accountingSign ? 'accounting' : undefined,
            currencyDisplay: currencyDisplay !== CurrencyDisplay.hidden ? currencyDisplay : undefined
        };
        const numberFormat = new Intl.NumberFormat(locale, this.options);
        const formatParts = numberFormat.formatToParts(123456);
        this.currency = (_a = formatParts.find(({ type }) => type === 'currency')) === null || _a === void 0 ? void 0 : _a.value;
        this.digits = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9].map((i) => i.toLocaleString(locale));
        this.decimalSymbol = (_b = formatParts.find(({ type }) => type === 'decimal')) === null || _b === void 0 ? void 0 : _b.value;
        this.groupingSymbol = (_c = formatParts.find(({ type }) => type === 'group')) === null || _c === void 0 ? void 0 : _c.value;
        this.minusSign = (_d = numberFormat.formatToParts(-1).find(({ type }) => type === 'minusSign')) === null || _d === void 0 ? void 0 : _d.value;
        if (this.decimalSymbol === undefined) {
            this.minimumFractionDigits = this.maximumFractionDigits = 0;
        }
        else if (typeof precision === 'number') {
            this.minimumFractionDigits = this.maximumFractionDigits = precision;
        }
        else {
            this.minimumFractionDigits = (_e = precision === null || precision === void 0 ? void 0 : precision.min) !== null && _e !== void 0 ? _e : numberFormat.resolvedOptions().minimumFractionDigits;
            this.maximumFractionDigits = (_f = precision === null || precision === void 0 ? void 0 : precision.max) !== null && _f !== void 0 ? _f : numberFormat.resolvedOptions().maximumFractionDigits;
        }
        const getPrefix = (str) => {
            return substringBefore(str, this.digits[1]);
        };
        const getSuffix = (str) => {
            return str.substring(str.lastIndexOf(this.decimalSymbol ? this.digits[0] : this.digits[1]) + 1);
        };
        this.prefix = getPrefix(numberFormat.format(1));
        this.suffix = getSuffix(numberFormat.format(1));
        this.negativePrefix = getPrefix(numberFormat.format(-1));
        this.negativeSuffix = getSuffix(numberFormat.format(-1));
    }
    parse(str) {
        if (str) {
            const negative = this.isNegative(str);
            str = this.normalizeDigits(str);
            str = this.stripCurrency(str, negative);
            str = this.stripSignLiterals(str);
            const fraction = this.decimalSymbol ? `(?:${escapeRegExp(this.decimalSymbol)}(\\d*))?` : '';
            const match = this.stripGroupingSeparator(str).match(new RegExp(`^${INTEGER_PATTERN}${fraction}$`));
            if (match && this.isValidIntegerFormat(this.decimalSymbol ? str.split(this.decimalSymbol)[0] : str, Number(match[1]))) {
                return Number(`${negative ? '-' : ''}${this.onlyDigits(match[1])}.${this.onlyDigits(match[2] || '')}`);
            }
        }
        return null;
    }
    isValidIntegerFormat(formattedNumber, integerNumber) {
        const options = { ...this.options, minimumFractionDigits: 0 };
        return [
            this.stripCurrency(this.normalizeDigits(integerNumber.toLocaleString(this.locale, {
                ...options,
                useGrouping: true
            })), false),
            this.stripCurrency(this.normalizeDigits(integerNumber.toLocaleString(this.locale, {
                ...options,
                useGrouping: false
            })), false)
        ].includes(formattedNumber);
    }
    format(value, options = {
        minimumFractionDigits: this.minimumFractionDigits,
        maximumFractionDigits: this.maximumFractionDigits
    }) {
        return value != null ? value.toLocaleString(this.locale, { ...this.options, ...options }) : '';
    }
    toFraction(str) {
        return `${this.digits[0]}${this.decimalSymbol}${this.onlyLocaleDigits(str.substr(1)).substr(0, this.maximumFractionDigits)}`;
    }
    isFractionIncomplete(str) {
        return !!this.normalizeDigits(this.stripGroupingSeparator(str)).match(new RegExp(`^${INTEGER_PATTERN}${escapeRegExp(this.decimalSymbol)}$`));
    }
    isNegative(str) {
        return (str.startsWith(this.negativePrefix) ||
            (this.minusSign === undefined && (str.startsWith('(') || str.startsWith('-'))) ||
            (this.minusSign !== undefined && str.replace('-', this.minusSign).startsWith(this.minusSign)));
    }
    insertCurrency(str, negative) {
        return `${negative ? this.negativePrefix : this.prefix}${str}${negative ? this.negativeSuffix : this.suffix}`;
    }
    stripGroupingSeparator(str) {
        return this.groupingSymbol !== undefined ? str.replace(new RegExp(escapeRegExp(this.groupingSymbol), 'g'), '') : str;
    }
    stripSignLiterals(str) {
        if (this.minusSign !== undefined) {
            return str.replace('-', this.minusSign).replace(this.minusSign, '');
        }
        else {
            return str.replace(/[-()]/g, '');
        }
    }
    stripCurrency(str, negative) {
        return str.replace(negative ? this.negativePrefix : this.prefix, '').replace(negative ? this.negativeSuffix : this.suffix, '');
    }
    normalizeDecimalSeparator(str, from) {
        DECIMAL_SEPARATORS.forEach((s) => {
            str = str.substr(0, from) + str.substr(from).replace(s, this.decimalSymbol);
        });
        return str;
    }
    normalizeDigits(str) {
        if (this.digits[0] !== '0') {
            this.digits.forEach((digit, index) => {
                str = str.replace(new RegExp(digit, 'g'), String(index));
            });
        }
        return str;
    }
    onlyDigits(str) {
        return this.normalizeDigits(str).replace(/\D+/g, '');
    }
    onlyLocaleDigits(str) {
        return str.replace(new RegExp(`[^${this.digits.join('')}]*`, 'g'), '');
    }
}

class AbstractInputMask {
    constructor(currencyFormat) {
        this.currencyFormat = currencyFormat;
    }
}
class DefaultInputMask extends AbstractInputMask {
    conformToMask(str, previousConformedValue = '') {
        const negative = this.currencyFormat.isNegative(str);
        const isEmptyNegativeValue = (str) => str === '' &&
            negative &&
            !(this.currencyFormat.minusSign === undefined
                ? previousConformedValue === this.currencyFormat.negativePrefix + this.currencyFormat.negativeSuffix
                : previousConformedValue === this.currencyFormat.negativePrefix);
        const checkIncompleteValue = (str) => {
            if (isEmptyNegativeValue(str)) {
                return '';
            }
            else if (this.currencyFormat.maximumFractionDigits > 0) {
                if (this.currencyFormat.isFractionIncomplete(str)) {
                    return str;
                }
                else if (str.startsWith(this.currencyFormat.decimalSymbol)) {
                    return this.currencyFormat.toFraction(str);
                }
            }
            return null;
        };
        let value = str;
        value = this.currencyFormat.stripCurrency(value, negative);
        value = this.currencyFormat.stripSignLiterals(value);
        const incompleteValue = checkIncompleteValue(value);
        if (incompleteValue != null) {
            return this.currencyFormat.insertCurrency(incompleteValue, negative);
        }
        const [integer, ...fraction] = value.split(this.currencyFormat.decimalSymbol);
        const integerDigits = removeLeadingZeros(this.currencyFormat.onlyDigits(integer));
        const fractionDigits = this.currencyFormat.onlyDigits(fraction.join('')).substr(0, this.currencyFormat.maximumFractionDigits);
        const invalidFraction = fraction.length > 0 && fractionDigits.length === 0;
        const invalidNegativeValue = integerDigits === '' &&
            negative &&
            (this.currencyFormat.minusSign === undefined
                ? previousConformedValue === str.slice(0, -2) + this.currencyFormat.negativeSuffix
                : previousConformedValue === str.slice(0, -1));
        if (invalidFraction || invalidNegativeValue || isEmptyNegativeValue(integerDigits)) {
            return previousConformedValue;
        }
        else if (integerDigits.match(/\d+/)) {
            return {
                numberValue: Number(`${negative ? '-' : ''}${integerDigits}.${fractionDigits}`),
                fractionDigits
            };
        }
        else {
            return '';
        }
    }
}
class AutoDecimalDigitsInputMask extends AbstractInputMask {
    conformToMask(str, previousConformedValue = '') {
        if (str === '' ||
            (this.currencyFormat.parse(previousConformedValue) === 0 &&
                this.currencyFormat.stripCurrency(previousConformedValue, true).slice(0, -1) === this.currencyFormat.stripCurrency(str, true))) {
            return '';
        }
        const negative = this.currencyFormat.isNegative(str);
        const numberValue = this.currencyFormat.stripSignLiterals(str) === ''
            ? -0
            : Number(`${negative ? '-' : ''}${removeLeadingZeros(this.currencyFormat.onlyDigits(str))}`) / Math.pow(10, this.currencyFormat.maximumFractionDigits);
        return {
            numberValue,
            fractionDigits: numberValue.toFixed(this.currencyFormat.maximumFractionDigits).slice(-this.currencyFormat.maximumFractionDigits)
        };
    }
}

const DEFAULT_OPTIONS = {
    locale: undefined,
    currency: undefined,
    currencyDisplay: undefined,
    exportValueAsInteger: false,
    hideGroupingSeparatorOnFocus: true,
    hideCurrencySymbolOnFocus: true,
    hideNegligibleDecimalDigitsOnFocus: true,
    precision: undefined,
    autoDecimalDigits: false,
    valueRange: undefined,
    autoSign: true,
    useGrouping: true,
    valueScaling: undefined
};
class CurrencyInput {
    constructor(el, options) {
        this.el = el;
        this.numberValue = null;
        this.addEventListener();
        this.init(options);
        this.setValue(this.currencyFormat.parse(this.el.value));
    }
    setOptions(options) {
        this.init(options);
        this.applyFixedFractionFormat(this.numberValue, true);
    }
    getValue() {
        const numberValue = this.valueScaling && this.numberValue != null ? this.toInteger(this.numberValue, this.valueScaling) : this.numberValue;
        return { number: numberValue, formatted: this.formattedValue };
    }
    setValue(value) {
        const newValue = this.valueScaling !== undefined && value != null ? this.toFloat(value, this.valueScaling) : value;
        if (newValue !== this.numberValue) {
            this.applyFixedFractionFormat(newValue);
        }
    }
    dispatchEvent(eventName) {
        this.el.dispatchEvent(new CustomEvent(eventName, { detail: this.getValue() }));
    }
    init(options) {
        this.options = {
            ...DEFAULT_OPTIONS,
            ...options
        };
        if (this.options.autoDecimalDigits) {
            this.options.hideNegligibleDecimalDigitsOnFocus = false;
            this.el.setAttribute('inputmode', 'numeric');
        }
        else {
            this.el.setAttribute('inputmode', 'decimal');
        }
        this.currencyFormat = new CurrencyFormat(this.options);
        this.numberMask = this.options.autoDecimalDigits ? new AutoDecimalDigitsInputMask(this.currencyFormat) : new DefaultInputMask(this.currencyFormat);
        const valueScalingOptions = {
            [ValueScaling.precision]: this.currencyFormat.maximumFractionDigits,
            [ValueScaling.thousands]: 3,
            [ValueScaling.millions]: 6,
            [ValueScaling.billions]: 9
        };
        if (this.options.exportValueAsInteger) {
            this.valueScaling = valueScalingOptions[ValueScaling.precision];
        }
        else {
            this.valueScaling = this.options.valueScaling ? valueScalingOptions[this.options.valueScaling] : undefined;
        }
        this.valueScalingFractionDigits =
            this.valueScaling !== undefined && this.options.valueScaling !== ValueScaling.precision
                ? this.valueScaling + this.currencyFormat.maximumFractionDigits
                : this.currencyFormat.maximumFractionDigits;
        this.minValue = this.getMinValue();
        this.maxValue = this.getMaxValue();
    }
    getMinValue() {
        var _a, _b;
        let min = this.toFloat(-Number.MAX_SAFE_INTEGER);
        if (((_a = this.options.valueRange) === null || _a === void 0 ? void 0 : _a.min) !== undefined) {
            min = Math.max((_b = this.options.valueRange) === null || _b === void 0 ? void 0 : _b.min, this.toFloat(-Number.MAX_SAFE_INTEGER));
        }
        if (!this.options.autoSign && min < 0) {
            min = 0;
        }
        return min;
    }
    getMaxValue() {
        var _a, _b;
        let max = this.toFloat(Number.MAX_SAFE_INTEGER);
        if (((_a = this.options.valueRange) === null || _a === void 0 ? void 0 : _a.max) !== undefined) {
            max = Math.min((_b = this.options.valueRange) === null || _b === void 0 ? void 0 : _b.max, this.toFloat(Number.MAX_SAFE_INTEGER));
        }
        if (!this.options.autoSign && max < 0) {
            max = this.toFloat(Number.MAX_SAFE_INTEGER);
        }
        return max;
    }
    toFloat(value, maxFractionDigits) {
        return value / Math.pow(10, maxFractionDigits !== null && maxFractionDigits !== void 0 ? maxFractionDigits : this.valueScalingFractionDigits);
    }
    toInteger(value, maxFractionDigits) {
        return Number(value
            .toFixed(maxFractionDigits !== null && maxFractionDigits !== void 0 ? maxFractionDigits : this.valueScalingFractionDigits)
            .split('.')
            .join(''));
    }
    validateValueRange(value) {
        return value != null ? Math.min(Math.max(value, this.minValue), this.maxValue) : value;
    }
    applyFixedFractionFormat(number, forcedChange = false) {
        this.format(this.currencyFormat.format(this.validateValueRange(number)));
        if (number !== this.numberValue || forcedChange) {
            this.dispatchEvent('change');
        }
    }
    format(value, hideNegligibleDecimalDigits = false) {
        if (value != null) {
            if (this.decimalSymbolInsertedAt !== undefined) {
                value = this.currencyFormat.normalizeDecimalSeparator(value, this.decimalSymbolInsertedAt);
                this.decimalSymbolInsertedAt = undefined;
            }
            const conformedValue = this.numberMask.conformToMask(value, this.formattedValue);
            let formattedValue;
            if (typeof conformedValue === 'object') {
                const { numberValue, fractionDigits } = conformedValue;
                let { maximumFractionDigits, minimumFractionDigits } = this.currencyFormat;
                if (this.focus) {
                    minimumFractionDigits = hideNegligibleDecimalDigits
                        ? fractionDigits.replace(/0+$/, '').length
                        : Math.min(maximumFractionDigits, fractionDigits.length);
                }
                else if (Number.isInteger(numberValue) && !this.options.autoDecimalDigits && (this.options.precision === undefined || minimumFractionDigits === 0)) {
                    minimumFractionDigits = maximumFractionDigits = 0;
                }
                formattedValue =
                    this.toInteger(Math.abs(numberValue)) > Number.MAX_SAFE_INTEGER
                        ? this.formattedValue
                        : this.currencyFormat.format(numberValue, {
                            useGrouping: this.options.useGrouping && !(this.focus && this.options.hideGroupingSeparatorOnFocus),
                            minimumFractionDigits,
                            maximumFractionDigits
                        });
            }
            else {
                formattedValue = conformedValue;
            }
            if (this.options.autoSign) {
                if (this.maxValue <= 0 && !this.currencyFormat.isNegative(formattedValue) && this.currencyFormat.parse(formattedValue) !== 0) {
                    formattedValue = formattedValue.replace(this.currencyFormat.prefix, this.currencyFormat.negativePrefix);
                }
                if (this.minValue >= 0) {
                    formattedValue = formattedValue.replace(this.currencyFormat.negativePrefix, this.currencyFormat.prefix);
                }
            }
            if (this.options.currencyDisplay === CurrencyDisplay.hidden || (this.focus && this.options.hideCurrencySymbolOnFocus)) {
                formattedValue = formattedValue
                    .replace(this.currencyFormat.negativePrefix, this.currencyFormat.minusSign !== undefined ? this.currencyFormat.minusSign : '(')
                    .replace(this.currencyFormat.negativeSuffix, this.currencyFormat.minusSign !== undefined ? '' : ')')
                    .replace(this.currencyFormat.prefix, '')
                    .replace(this.currencyFormat.suffix, '');
            }
            this.el.value = formattedValue;
            this.numberValue = this.currencyFormat.parse(formattedValue);
        }
        else {
            this.el.value = '';
            this.numberValue = null;
        }
        this.formattedValue = this.el.value;
        this.dispatchEvent('input');
    }
    addEventListener() {
        this.el.addEventListener('input', (e) => {
            if (!e.detail) {
                const { value, selectionStart } = this.el;
                const inputEvent = e;
                if (selectionStart && inputEvent.data && DECIMAL_SEPARATORS.includes(inputEvent.data)) {
                    this.decimalSymbolInsertedAt = selectionStart - 1;
                }
                this.format(value);
                if (this.focus && selectionStart != null) {
                    const getCaretPositionAfterFormat = () => {
                        const { prefix, suffix, decimalSymbol, maximumFractionDigits, groupingSymbol } = this.currencyFormat;
                        let caretPositionFromLeft = value.length - selectionStart;
                        const newValueLength = this.formattedValue.length;
                        if (this.currencyFormat.minusSign === undefined && (value.startsWith('(') || value.startsWith('-')) && !value.endsWith(')')) {
                            return newValueLength - this.currencyFormat.negativeSuffix.length > 1 ? this.formattedValue.substring(selectionStart).length : 1;
                        }
                        if (this.formattedValue.substr(selectionStart, 1) === groupingSymbol &&
                            count(this.formattedValue, groupingSymbol) === count(value, groupingSymbol) + 1) {
                            return newValueLength - caretPositionFromLeft - 1;
                        }
                        if (newValueLength < caretPositionFromLeft) {
                            return selectionStart;
                        }
                        if (decimalSymbol !== undefined && value.indexOf(decimalSymbol) !== -1) {
                            const decimalSymbolPosition = value.indexOf(decimalSymbol) + 1;
                            if (Math.abs(newValueLength - value.length) > 1 && selectionStart <= decimalSymbolPosition) {
                                return this.formattedValue.indexOf(decimalSymbol) + 1;
                            }
                            else {
                                if (!this.options.autoDecimalDigits && selectionStart > decimalSymbolPosition) {
                                    if (this.currencyFormat.onlyDigits(value.substr(decimalSymbolPosition)).length - 1 === maximumFractionDigits) {
                                        caretPositionFromLeft -= 1;
                                    }
                                }
                            }
                        }
                        return this.options.hideCurrencySymbolOnFocus || this.options.currencyDisplay === CurrencyDisplay.hidden
                            ? newValueLength - caretPositionFromLeft
                            : Math.max(newValueLength - Math.max(caretPositionFromLeft, suffix.length), prefix.length);
                    };
                    this.setCaretPosition(getCaretPositionAfterFormat());
                }
            }
        }, { capture: true });
        this.el.addEventListener('focus', () => {
            this.focus = true;
            setTimeout(() => {
                const { value, selectionStart, selectionEnd } = this.el;
                this.format(value, this.options.hideNegligibleDecimalDigitsOnFocus);
                if (selectionStart != null && selectionEnd != null && Math.abs(selectionStart - selectionEnd) > 0) {
                    this.setCaretPosition(0, this.el.value.length);
                }
                else if (selectionStart != null) {
                    const caretPositionOnFocus = this.getCaretPositionOnFocus(value, selectionStart);
                    this.setCaretPosition(caretPositionOnFocus);
                }
            });
        });
        this.el.addEventListener('blur', () => {
            this.focus = false;
            this.applyFixedFractionFormat(this.numberValue);
        });
        this.el.addEventListener('change', (e) => {
            if (!e.detail) {
                this.dispatchEvent('change');
            }
        }, { capture: true });
    }
    getCaretPositionOnFocus(value, selectionStart) {
        if (this.numberValue == null) {
            return selectionStart;
        }
        const { prefix, negativePrefix, suffix, negativeSuffix, groupingSymbol, currency } = this.currencyFormat;
        const isNegative = this.numberValue < 0;
        const currentPrefix = isNegative ? negativePrefix : prefix;
        const prefixLength = currentPrefix.length;
        if (this.options.hideCurrencySymbolOnFocus || this.options.currencyDisplay === CurrencyDisplay.hidden) {
            if (isNegative) {
                if (selectionStart <= 1) {
                    return 1;
                }
                else if (value.endsWith(')') && selectionStart > value.indexOf(')')) {
                    return this.formattedValue.length - 1;
                }
            }
        }
        else {
            const suffixLength = isNegative ? negativeSuffix.length : suffix.length;
            if (selectionStart >= value.length - suffixLength) {
                return this.formattedValue.length - suffixLength;
            }
            else if (selectionStart < prefixLength) {
                return prefixLength;
            }
        }
        let result = selectionStart;
        if (this.options.hideCurrencySymbolOnFocus &&
            this.options.currencyDisplay !== CurrencyDisplay.hidden &&
            selectionStart >= prefixLength &&
            currency !== undefined &&
            currentPrefix.includes(currency)) {
            result -= prefixLength;
            if (isNegative) {
                result += 1;
            }
        }
        if (this.options.hideGroupingSeparatorOnFocus && groupingSymbol !== undefined) {
            result -= count(value.substring(0, selectionStart), groupingSymbol);
        }
        return result;
    }
    setCaretPosition(start, end = start) {
        this.el.setSelectionRange(start, end);
    }
}

const findInput = (el) => ((el === null || el === void 0 ? void 0 : el.matches('input')) ? el : el === null || el === void 0 ? void 0 : el.querySelector('input'));
var useCurrencyInput = (options, autoEmit) => {
    var _a;
    let numberInput;
    let input;
    const inputRef = (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    const formattedValue = (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    const numberValue = (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    const instance = (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.getCurrentInstance)();
    const emit = (event, value) => instance === null || instance === void 0 ? void 0 : instance.emit(event, value);
    const lazyModel = vue_demi__WEBPACK_IMPORTED_MODULE_0__.isVue3 && ((_a = instance === null || instance === void 0 ? void 0 : instance.attrs.modelModifiers) === null || _a === void 0 ? void 0 : _a.lazy);
    const modelValue = (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.computed)(() => instance === null || instance === void 0 ? void 0 : instance.props[vue_demi__WEBPACK_IMPORTED_MODULE_0__.isVue3 ? 'modelValue' : 'value']);
    const inputEvent = vue_demi__WEBPACK_IMPORTED_MODULE_0__.isVue3 ? 'update:modelValue' : 'input';
    const changeEvent = lazyModel ? 'update:modelValue' : 'change';
    const hasInputEventListener = !vue_demi__WEBPACK_IMPORTED_MODULE_0__.isVue3 || !lazyModel;
    const hasChangeEventListener = !vue_demi__WEBPACK_IMPORTED_MODULE_0__.isVue3 || lazyModel || !(instance === null || instance === void 0 ? void 0 : instance.attrs.onChange);
    const onInput = (e) => {
        if (e.detail) {
            if (autoEmit !== false && modelValue.value !== e.detail.number) {
                emit(inputEvent, e.detail.number);
            }
            numberValue.value = e.detail.number;
            formattedValue.value = e.detail.formatted;
        }
    };
    const onChange = (e) => {
        if (e.detail) {
            if (autoEmit !== false) {
                emit(changeEvent, e.detail.number);
            }
            numberValue.value = e.detail.number;
            formattedValue.value = e.detail.formatted;
        }
    };
    (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.watch)(inputRef, (value) => {
        var _a, _b;
        if (value) {
            input = findInput((_b = (_a = value) === null || _a === void 0 ? void 0 : _a.$el) !== null && _b !== void 0 ? _b : value);
            if (input) {
                numberInput = new CurrencyInput(input, options);
                if (hasInputEventListener) {
                    input.addEventListener('input', onInput);
                }
                if (hasChangeEventListener) {
                    input.addEventListener('change', onChange);
                }
                numberInput.setValue(modelValue.value);
            }
            else {
                console.error('No input element found. Please make sure that the "inputRef" template ref is properly assigned.');
            }
        }
        else {
            numberInput = null;
        }
    });
    (0,vue_demi__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(() => {
        if (hasInputEventListener) {
            input === null || input === void 0 ? void 0 : input.removeEventListener('input', onInput);
        }
        if (hasChangeEventListener) {
            input === null || input === void 0 ? void 0 : input.removeEventListener('change', onChange);
        }
    });
    return {
        inputRef,
        numberValue,
        formattedValue,
        setValue: (value) => numberInput === null || numberInput === void 0 ? void 0 : numberInput.setValue(value),
        setOptions: (options) => numberInput === null || numberInput === void 0 ? void 0 : numberInput.setOptions(options)
    };
};

const parse = (formattedValue, options) => {
    return new CurrencyFormat(options).parse(formattedValue);
};




/***/ }),

/***/ "./resources/js/components/CurrencyInput.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/CurrencyInput.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _CurrencyInput_vue_vue_type_template_id_22dd315e__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CurrencyInput.vue?vue&type=template&id=22dd315e */ "./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e");
/* harmony import */ var _CurrencyInput_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CurrencyInput.vue?vue&type=script&lang=js */ "./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_CurrencyInput_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_CurrencyInput_vue_vue_type_template_id_22dd315e__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/CurrencyInput.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/LoginModal.vue":
/*!************************************************!*\
  !*** ./resources/js/components/LoginModal.vue ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _LoginModal_vue_vue_type_template_id_5a9eff6f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoginModal.vue?vue&type=template&id=5a9eff6f */ "./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f");
/* harmony import */ var _LoginModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoginModal.vue?vue&type=script&lang=js */ "./resources/js/components/LoginModal.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_LoginModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_LoginModal_vue_vue_type_template_id_5a9eff6f__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/LoginModal.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/MinhasCotacoes.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/MinhasCotacoes.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MinhasCotacoes_vue_vue_type_template_id_56babe46__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MinhasCotacoes.vue?vue&type=template&id=56babe46 */ "./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46");
/* harmony import */ var _MinhasCotacoes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MinhasCotacoes.vue?vue&type=script&lang=js */ "./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_MinhasCotacoes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MinhasCotacoes_vue_vue_type_template_id_56babe46__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/MinhasCotacoes.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/TaxaModal.vue":
/*!***********************************************!*\
  !*** ./resources/js/components/TaxaModal.vue ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _TaxaModal_vue_vue_type_template_id_7f37e8dc__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TaxaModal.vue?vue&type=template&id=7f37e8dc */ "./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc");
/* harmony import */ var _TaxaModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TaxaModal.vue?vue&type=script&lang=js */ "./resources/js/components/TaxaModal.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_TaxaModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_TaxaModal_vue_vue_type_template_id_7f37e8dc__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/TaxaModal.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/pages/Index.vue":
/*!**************************************!*\
  !*** ./resources/js/pages/Index.vue ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_71c33819__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=71c33819 */ "./resources/js/pages/Index.vue?vue&type=template&id=71c33819");
/* harmony import */ var _Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js */ "./resources/js/pages/Index.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Index_vue_vue_type_template_id_71c33819__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/pages/Index.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/pages/Quotation.vue":
/*!******************************************!*\
  !*** ./resources/js/pages/Quotation.vue ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Quotation_vue_vue_type_template_id_aa1f6f5a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Quotation.vue?vue&type=template&id=aa1f6f5a */ "./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a");
/* harmony import */ var _Quotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Quotation.vue?vue&type=script&lang=js */ "./resources/js/pages/Quotation.vue?vue&type=script&lang=js");
/* harmony import */ var _Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_Users_nando_Sites_test_oliveiratrust_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Quotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Quotation_vue_vue_type_template_id_aa1f6f5a__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/pages/Quotation.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js":
/*!***************************************************************************!*\
  !*** ./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CurrencyInput_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CurrencyInput_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CurrencyInput.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/LoginModal.vue?vue&type=script&lang=js":
/*!************************************************************************!*\
  !*** ./resources/js/components/LoginModal.vue?vue&type=script&lang=js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LoginModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LoginModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LoginModal.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js":
/*!****************************************************************************!*\
  !*** ./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MinhasCotacoes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MinhasCotacoes_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MinhasCotacoes.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/TaxaModal.vue?vue&type=script&lang=js":
/*!***********************************************************************!*\
  !*** ./resources/js/components/TaxaModal.vue?vue&type=script&lang=js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TaxaModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TaxaModal_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TaxaModal.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/pages/Index.vue?vue&type=script&lang=js":
/*!**************************************************************!*\
  !*** ./resources/js/pages/Index.vue?vue&type=script&lang=js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/pages/Quotation.vue?vue&type=script&lang=js":
/*!******************************************************************!*\
  !*** ./resources/js/pages/Quotation.vue?vue&type=script&lang=js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Quotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Quotation_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Quotation.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CurrencyInput_vue_vue_type_template_id_22dd315e__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CurrencyInput_vue_vue_type_template_id_22dd315e__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CurrencyInput.vue?vue&type=template&id=22dd315e */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/CurrencyInput.vue?vue&type=template&id=22dd315e");


/***/ }),

/***/ "./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f":
/*!******************************************************************************!*\
  !*** ./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LoginModal_vue_vue_type_template_id_5a9eff6f__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LoginModal_vue_vue_type_template_id_5a9eff6f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LoginModal.vue?vue&type=template&id=5a9eff6f */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/LoginModal.vue?vue&type=template&id=5a9eff6f");


/***/ }),

/***/ "./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46 ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MinhasCotacoes_vue_vue_type_template_id_56babe46__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MinhasCotacoes_vue_vue_type_template_id_56babe46__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MinhasCotacoes.vue?vue&type=template&id=56babe46 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/MinhasCotacoes.vue?vue&type=template&id=56babe46");


/***/ }),

/***/ "./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TaxaModal_vue_vue_type_template_id_7f37e8dc__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_TaxaModal_vue_vue_type_template_id_7f37e8dc__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./TaxaModal.vue?vue&type=template&id=7f37e8dc */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/TaxaModal.vue?vue&type=template&id=7f37e8dc");


/***/ }),

/***/ "./resources/js/pages/Index.vue?vue&type=template&id=71c33819":
/*!********************************************************************!*\
  !*** ./resources/js/pages/Index.vue?vue&type=template&id=71c33819 ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_71c33819__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Index_vue_vue_type_template_id_71c33819__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Index.vue?vue&type=template&id=71c33819 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Index.vue?vue&type=template&id=71c33819");


/***/ }),

/***/ "./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a":
/*!************************************************************************!*\
  !*** ./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Quotation_vue_vue_type_template_id_aa1f6f5a__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Quotation_vue_vue_type_template_id_aa1f6f5a__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Quotation.vue?vue&type=template&id=aa1f6f5a */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/pages/Quotation.vue?vue&type=template&id=aa1f6f5a");


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/description/description.js":
/*!*********************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/description/description.js ***!
  \*********************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Description": () => (/* binding */ S),
/* harmony export */   "useDescriptions": () => (/* binding */ P)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/vue/dist/hooks/use-id.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
let u=Symbol("DescriptionContext");function h(){let n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(u,null);if(n===null)throw new Error("Missing parent");return n}function P({slot:n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)({}),name:o="Description",props:s={}}={}){let e=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)([]);function t(r){return e.value.push(r),()=>{let i=e.value.indexOf(r);i!==-1&&e.value.splice(i,1)}}return (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(u,{register:t,slot:n,name:o,props:s}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>e.value.length>0?e.value.join(" "):void 0)}let S=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"Description",props:{as:{type:[Object,String],default:"p"}},setup(n,{attrs:o,slots:s}){let e=h(),t=`headlessui-description-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_1__.useId)()}`;return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(e.register(t))),()=>{let{name:r="Description",slot:i=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)({}),props:c={}}=e,l=n,d={...Object.entries(c).reduce((f,[a,g])=>Object.assign(f,{[a]:(0,vue__WEBPACK_IMPORTED_MODULE_0__.unref)(g)}),{}),id:t};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_2__.render)({props:{...l,...d},slot:i.value,attrs:o,slots:s,name:r})}}});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/dialog/dialog.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/dialog/dialog.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Dialog": () => (/* binding */ He),
/* harmony export */   "DialogBackdrop": () => (/* binding */ Le),
/* harmony export */   "DialogDescription": () => (/* binding */ Ne),
/* harmony export */   "DialogOverlay": () => (/* binding */ je),
/* harmony export */   "DialogPanel": () => (/* binding */ We),
/* harmony export */   "DialogTitle": () => (/* binding */ Ke)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
/* harmony import */ var _keyboard_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ../../keyboard.js */ "./node_modules/@headlessui/vue/dist/keyboard.js");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/vue/dist/hooks/use-id.js");
/* harmony import */ var _components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../../components/focus-trap/focus-trap.js */ "./node_modules/@headlessui/vue/dist/components/focus-trap/focus-trap.js");
/* harmony import */ var _hooks_use_inert_others_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-inert-others.js */ "./node_modules/@headlessui/vue/dist/hooks/use-inert-others.js");
/* harmony import */ var _portal_portal_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ../portal/portal.js */ "./node_modules/@headlessui/vue/dist/components/portal/portal.js");
/* harmony import */ var _internal_stack_context_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../internal/stack-context.js */ "./node_modules/@headlessui/vue/dist/internal/stack-context.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/vue/dist/utils/match.js");
/* harmony import */ var _internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ../../internal/portal-force-root.js */ "./node_modules/@headlessui/vue/dist/internal/portal-force-root.js");
/* harmony import */ var _description_description_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../description/description.js */ "./node_modules/@headlessui/vue/dist/components/description/description.js");
/* harmony import */ var _utils_dom_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ../../utils/dom.js */ "./node_modules/@headlessui/vue/dist/utils/dom.js");
/* harmony import */ var _internal_open_closed_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../internal/open-closed.js */ "./node_modules/@headlessui/vue/dist/internal/open-closed.js");
/* harmony import */ var _hooks_use_outside_click_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../hooks/use-outside-click.js */ "./node_modules/@headlessui/vue/dist/hooks/use-outside-click.js");
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/owner.js */ "./node_modules/@headlessui/vue/dist/utils/owner.js");
/* harmony import */ var _hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ../../hooks/use-event-listener.js */ "./node_modules/@headlessui/vue/dist/hooks/use-event-listener.js");
/* harmony import */ var _internal_hidden_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../../internal/hidden.js */ "./node_modules/@headlessui/vue/dist/internal/hidden.js");
var me=(l=>(l[l.Open=0]="Open",l[l.Closed=1]="Closed",l))(me||{});let x=Symbol("DialogContext");function R(r){let i=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(x,null);if(i===null){let l=new Error(`<${r} /> is missing a parent <Dialog /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(l,R),l}return i}let T="DC8F892D-2EBD-447C-A4C8-A03058436FF4",He=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"Dialog",inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0},open:{type:[Boolean,String],default:T},initialFocus:{type:Object,default:null}},emits:{close:r=>!0},setup(r,{emit:i,attrs:l,slots:u,expose:a}){var B;let p=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(0),n=(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_1__.useOpenClosed)(),c=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>r.open===T&&n!==null?(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(n.value,{[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_1__.State.Open]:!0,[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_1__.State.Closed]:!1}):r.open),y=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(new Set),d=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),I=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),k=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_3__.getOwnerDocument)(d));if(a({el:d,$el:d}),!(r.open!==T||n!==null))throw new Error("You forgot to provide an `open` prop to the `Dialog`.");if(typeof c.value!="boolean")throw new Error(`You provided an \`open\` prop to the \`Dialog\`, but the value is not a boolean. Received: ${c.value===T?void 0:r.open}`);let f=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>c.value?0:1),M=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>f.value===0),C=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>p.value>1),V=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(x,null)!==null,Y=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>C.value?"parent":"leaf");(0,_hooks_use_inert_others_js__WEBPACK_IMPORTED_MODULE_4__.useInertOthers)(d,(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>C.value?M.value:!1)),(0,_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_5__.useStackProvider)({type:"Dialog",element:d,onUpdate:(t,o,e)=>{if(o==="Dialog")return (0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(t,{[_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_5__.StackMessage.Add](){y.value.add(e),p.value+=1},[_internal_stack_context_js__WEBPACK_IMPORTED_MODULE_5__.StackMessage.Remove](){y.value.delete(e),p.value-=1}})}});let q=(0,_description_description_js__WEBPACK_IMPORTED_MODULE_6__.useDescriptions)({name:"DialogDescription",slot:(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>({open:c.value}))}),G=`headlessui-dialog-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__.useId)()}`,w=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),D={titleId:w,panelRef:(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),dialogState:f,setTitleId(t){w.value!==t&&(w.value=t)},close(){i("close",!1)}};(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(x,D),(0,_hooks_use_outside_click_js__WEBPACK_IMPORTED_MODULE_8__.useOutsideClick)(()=>{var o,e,g;return[...Array.from((e=(o=k.value)==null?void 0:o.querySelectorAll("body > *"))!=null?e:[]).filter(s=>!(!(s instanceof HTMLElement)||s.contains((0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_9__.dom)(I))||D.panelRef.value&&s.contains(D.panelRef.value))),(g=D.panelRef.value)!=null?g:d.value]},(t,o)=>{f.value===0&&(C.value||(D.close(),(0,vue__WEBPACK_IMPORTED_MODULE_0__.nextTick)(()=>o==null?void 0:o.focus())))},_hooks_use_outside_click_js__WEBPACK_IMPORTED_MODULE_8__.Features.IgnoreScrollbars),(0,_hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_10__.useEventListener)((B=k.value)==null?void 0:B.defaultView,"keydown",t=>{t.defaultPrevented||t.key===_keyboard_js__WEBPACK_IMPORTED_MODULE_11__.Keys.Escape&&f.value===0&&(C.value||(t.preventDefault(),t.stopPropagation(),D.close()))}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(t=>{var A;if(f.value!==0||V)return;let o=k.value;if(!o)return;let e=o==null?void 0:o.documentElement,g=(A=o.defaultView)!=null?A:window,s=e.style.overflow,J=e.style.paddingRight,$=g.innerWidth-e.clientWidth;if(e.style.overflow="hidden",$>0){let Q=e.clientWidth-e.offsetWidth,X=$-Q;e.style.paddingRight=`${X}px`}t(()=>{e.style.overflow=s,e.style.paddingRight=J})}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(t=>{if(f.value!==0)return;let o=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_9__.dom)(d);if(!o)return;let e=new IntersectionObserver(g=>{for(let s of g)s.boundingClientRect.x===0&&s.boundingClientRect.y===0&&s.boundingClientRect.width===0&&s.boundingClientRect.height===0&&D.close()});e.observe(o),t(()=>e.disconnect())});function z(t){t.stopPropagation()}return()=>{let t={...l,ref:d,id:G,role:"dialog","aria-modal":f.value===0?!0:void 0,"aria-labelledby":w.value,"aria-describedby":q.value,onClick:z},{open:o,initialFocus:e,...g}=r,s={open:f.value===0};return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_12__.ForcePortalRoot,{force:!0},()=>[(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_portal_portal_js__WEBPACK_IMPORTED_MODULE_13__.Portal,()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_portal_portal_js__WEBPACK_IMPORTED_MODULE_13__.PortalGroup,{target:d.value},()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_12__.ForcePortalRoot,{force:!1},()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__.FocusTrap,{initialFocus:e,containers:y,features:M.value?(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(Y.value,{parent:_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__.FocusTrap.features.RestoreFocus,leaf:_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__.FocusTrap.features.All&~_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__.FocusTrap.features.FocusLock}):_components_focus_trap_focus_trap_js__WEBPACK_IMPORTED_MODULE_14__.FocusTrap.features.None},()=>(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.render)({props:{...g,...t},slot:s,attrs:l,slots:u,visible:f.value===0,features:_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.Features.RenderStrategy|_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.Features.Static,name:"Dialog"}))))),(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_16__.Hidden,{features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_16__.Features.Hidden,ref:I})])}}}),je=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"DialogOverlay",props:{as:{type:[Object,String],default:"div"}},setup(r,{attrs:i,slots:l}){let u=R("DialogOverlay"),a=`headlessui-dialog-overlay-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__.useId)()}`;function p(n){n.target===n.currentTarget&&(n.preventDefault(),n.stopPropagation(),u.close())}return()=>(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.render)({props:{...r,...{id:a,"aria-hidden":!0,onClick:p}},slot:{open:u.dialogState.value===0},attrs:i,slots:l,name:"DialogOverlay"})}}),Le=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"DialogBackdrop",props:{as:{type:[Object,String],default:"div"}},inheritAttrs:!1,setup(r,{attrs:i,slots:l,expose:u}){let a=R("DialogBackdrop"),p=`headlessui-dialog-backdrop-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__.useId)()}`,n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);return u({el:n,$el:n}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{if(a.panelRef.value===null)throw new Error("A <DialogBackdrop /> component is being used, but a <DialogPanel /> component is missing.")}),()=>{let c=r,y={id:p,ref:n,"aria-hidden":!0};return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_12__.ForcePortalRoot,{force:!0},()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_portal_portal_js__WEBPACK_IMPORTED_MODULE_13__.Portal,()=>(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.render)({props:{...i,...c,...y},slot:{open:a.dialogState.value===0},attrs:i,slots:l,name:"DialogBackdrop"})))}}}),We=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"DialogPanel",props:{as:{type:[Object,String],default:"div"}},setup(r,{attrs:i,slots:l,expose:u}){let a=R("DialogPanel"),p=`headlessui-dialog-panel-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__.useId)()}`;return u({el:a.panelRef,$el:a.panelRef}),()=>{let n={id:p,ref:a.panelRef};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.render)({props:{...r,...n},slot:{open:a.dialogState.value===0},attrs:i,slots:l,name:"DialogPanel"})}}}),Ke=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"DialogTitle",props:{as:{type:[Object,String],default:"h2"}},setup(r,{attrs:i,slots:l}){let u=R("DialogTitle"),a=`headlessui-dialog-title-${(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_7__.useId)()}`;return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{u.setTitleId(a),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(()=>u.setTitleId(null))}),()=>(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_15__.render)({props:{...r,...{id:a}},slot:{open:u.dialogState.value===0},attrs:i,slots:l,name:"DialogTitle"})}}),Ne=_description_description_js__WEBPACK_IMPORTED_MODULE_6__.Description;


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/focus-trap/focus-trap.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/focus-trap/focus-trap.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "FocusTrap": () => (/* binding */ V)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
/* harmony import */ var _internal_hidden_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../internal/hidden.js */ "./node_modules/@headlessui/vue/dist/internal/hidden.js");
/* harmony import */ var _utils_dom_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/dom.js */ "./node_modules/@headlessui/vue/dist/utils/dom.js");
/* harmony import */ var _utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../utils/focus-management.js */ "./node_modules/@headlessui/vue/dist/utils/focus-management.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/vue/dist/utils/match.js");
/* harmony import */ var _hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../hooks/use-tab-direction.js */ "./node_modules/@headlessui/vue/dist/hooks/use-tab-direction.js");
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../utils/owner.js */ "./node_modules/@headlessui/vue/dist/utils/owner.js");
/* harmony import */ var _hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../hooks/use-event-listener.js */ "./node_modules/@headlessui/vue/dist/hooks/use-event-listener.js");
var y=(e=>(e[e.None=1]="None",e[e.InitialFocus=2]="InitialFocus",e[e.TabLock=4]="TabLock",e[e.FocusLock=8]="FocusLock",e[e.RestoreFocus=16]="RestoreFocus",e[e.All=30]="All",e))(y||{});let V=Object.assign((0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"FocusTrap",props:{as:{type:[Object,String],default:"div"},initialFocus:{type:Object,default:null},features:{type:Number,default:30},containers:{type:Object,default:(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(new Set)}},inheritAttrs:!1,setup(o,{attrs:u,slots:n,expose:r}){let t=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);r({el:t,$el:t});let a=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(t));A({ownerDocument:a},(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>Boolean(o.features&16)));let e=N({ownerDocument:a,container:t,initialFocus:(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>o.initialFocus)},(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>Boolean(o.features&2)));C({ownerDocument:a,container:t,containers:o.containers,previousActiveElement:e},(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>Boolean(o.features&8)));let s=(0,_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_2__.useTabDirection)();function i(){let l=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_3__.dom)(t);!l||(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_4__.match)(s.value,{[_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_2__.Direction.Forwards]:()=>(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusIn)(l,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.Focus.First),[_hooks_use_tab_direction_js__WEBPACK_IMPORTED_MODULE_2__.Direction.Backwards]:()=>(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusIn)(l,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.Focus.Last)})}return()=>{let l={},T={"data-hi":"container",ref:t},{features:c,initialFocus:H,containers:R,...h}=o;return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment,[Boolean(c&4)&&(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_6__.Hidden,{as:"button",type:"button",onFocus:i,features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_6__.Features.Focusable}),(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_7__.render)({props:{...u,...h,...T},slot:l,attrs:u,slots:n,name:"FocusTrap"}),Boolean(c&4)&&(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(_internal_hidden_js__WEBPACK_IMPORTED_MODULE_6__.Hidden,{as:"button",type:"button",onFocus:i,features:_internal_hidden_js__WEBPACK_IMPORTED_MODULE_6__.Features.Focusable})])}}}),{features:y});function A({ownerDocument:o},u){let n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),r={value:!1};(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(u,(t,a)=>{var e;t!==a&&(!u.value||(r.value=!0,n.value||(n.value=(e=o.value)==null?void 0:e.activeElement)))},{immediate:!0}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)(u,(t,a,e)=>{t!==a&&(!u.value||e(()=>{r.value!==!1&&(r.value=!1,(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusElement)(n.value),n.value=null)}))},{immediate:!0})})}function N({ownerDocument:o,container:u,initialFocus:n},r){let t=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)([u,n,r],(a,e)=>{var T,c;if(a.every((H,R)=>(e==null?void 0:e[R])===H)||!r.value)return;let s=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_3__.dom)(u);if(!s)return;let i=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_3__.dom)(n),l=(T=o.value)==null?void 0:T.activeElement;if(i){if(i===l){t.value=l;return}}else if(s.contains(l)){t.value=l;return}i?(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusElement)(i):(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusIn)(s,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.Focus.First)===_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.FocusResult.Error&&console.warn("There are no focusable elements inside the <FocusTrap />"),t.value=(c=o.value)==null?void 0:c.activeElement},{immediate:!0,flush:"post"})}),t}function C({ownerDocument:o,container:u,containers:n,previousActiveElement:r},t){var a;(0,_hooks_use_event_listener_js__WEBPACK_IMPORTED_MODULE_8__.useEventListener)((a=o.value)==null?void 0:a.defaultView,"focus",e=>{if(!t.value)return;let s=new Set(n==null?void 0:n.value);s.add(u);let i=r.value;if(!i)return;let l=e.target;l&&l instanceof HTMLElement?_(s,l)?(r.value=l,(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusElement)(l)):(e.preventDefault(),e.stopPropagation(),(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusElement)(i)):(0,_utils_focus_management_js__WEBPACK_IMPORTED_MODULE_5__.focusElement)(r.value)},!0)}function _(o,u){var n;for(let r of o)if((n=r.value)!=null&&n.contains(u))return!0;return!1}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/portal/portal.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/portal/portal.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Portal": () => (/* binding */ R),
/* harmony export */   "PortalGroup": () => (/* binding */ L)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
/* harmony import */ var _internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../internal/portal-force-root.js */ "./node_modules/@headlessui/vue/dist/internal/portal-force-root.js");
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../utils/owner.js */ "./node_modules/@headlessui/vue/dist/utils/owner.js");
function c(t){let r=(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(t);if(!r){if(t===null)return null;throw new Error(`[Headless UI]: Cannot find ownerDocument for contextElement: ${t}`)}let o=r.getElementById("headlessui-portal-root");if(o)return o;let e=r.createElement("div");return e.setAttribute("id","headlessui-portal-root"),r.body.appendChild(e)}let R=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"Portal",props:{as:{type:[Object,String],default:"div"}},setup(t,{slots:r,attrs:o}){let e=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),p=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(e)),n=(0,_internal_portal_force_root_js__WEBPACK_IMPORTED_MODULE_2__.usePortalRoot)(),u=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(g,null),l=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(n===!0||u==null?c(e.value):u.resolveTarget());return (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(()=>{n||u!=null&&(l.value=u.resolveTarget())}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(()=>{var i,m;let a=(i=p.value)==null?void 0:i.getElementById("headlessui-portal-root");!a||l.value===a&&l.value.children.length<=0&&((m=l.value.parentElement)==null||m.removeChild(l.value))}),()=>{if(l.value===null)return null;let a={ref:e};return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(vue__WEBPACK_IMPORTED_MODULE_0__.Teleport,{to:l.value},(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.render)({props:{...t,...a},slot:{},attrs:o,slots:r,name:"Portal"}))}}}),g=Symbol("PortalGroupContext"),L=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"PortalGroup",props:{as:{type:[Object,String],default:"template"},target:{type:Object,default:null}},setup(t,{attrs:r,slots:o}){let e=(0,vue__WEBPACK_IMPORTED_MODULE_0__.reactive)({resolveTarget(){return t.target}});return (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(g,e),()=>{let{target:p,...n}=t;return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_3__.render)({props:n,slot:{},attrs:r,slots:o,name:"PortalGroup"})}}});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/transitions/transition.js":
/*!********************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/transitions/transition.js ***!
  \********************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "TransitionChild": () => (/* binding */ oe),
/* harmony export */   "TransitionRoot": () => (/* binding */ fe)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _hooks_use_id_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../hooks/use-id.js */ "./node_modules/@headlessui/vue/dist/hooks/use-id.js");
/* harmony import */ var _utils_match_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/match.js */ "./node_modules/@headlessui/vue/dist/utils/match.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
/* harmony import */ var _utils_transition_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./utils/transition.js */ "./node_modules/@headlessui/vue/dist/components/transitions/utils/transition.js");
/* harmony import */ var _utils_dom_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../utils/dom.js */ "./node_modules/@headlessui/vue/dist/utils/dom.js");
/* harmony import */ var _internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../internal/open-closed.js */ "./node_modules/@headlessui/vue/dist/internal/open-closed.js");
function d(e=""){return e.split(" ").filter(t=>t.trim().length>1)}let F=Symbol("TransitionContext");var ae=(a=>(a.Visible="visible",a.Hidden="hidden",a))(ae||{});function le(){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(F,null)!==null}function ie(){let e=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(F,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}function se(){let e=(0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(R,null);if(e===null)throw new Error("A <TransitionChild /> is used but it is missing a parent <TransitionRoot />.");return e}let R=Symbol("NestingContext");function w(e){return"children"in e?w(e.children):e.value.filter(({state:t})=>t==="visible").length>0}function K(e){let t=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)([]),a=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(!1);(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>a.value=!0),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(()=>a.value=!1);function s(r,n=_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Hidden){let l=t.value.findIndex(({id:i})=>i===r);l!==-1&&((0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(n,{[_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Unmount](){t.value.splice(l,1)},[_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Hidden](){t.value[l].state="hidden"}}),!w(t)&&a.value&&(e==null||e()))}function v(r){let n=t.value.find(({id:l})=>l===r);return n?n.state!=="visible"&&(n.state="visible"):t.value.push({id:r,state:"visible"}),()=>s(r,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Unmount)}return{children:t,register:v,unregister:s}}let _=_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.Features.RenderStrategy,oe=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:a,slots:s,expose:v}){if(!le()&&(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.hasOpenClosed)())return()=>(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(fe,{...e,onBeforeEnter:()=>t("beforeEnter"),onAfterEnter:()=>t("afterEnter"),onBeforeLeave:()=>t("beforeLeave"),onAfterLeave:()=>t("afterLeave")},s);let r=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null),n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)("visible"),l=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>e.unmount?_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Unmount:_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Hidden);v({el:r,$el:r});let{show:i,appear:x}=ie(),{register:h,unregister:p}=se(),B={value:!0},m=(0,_hooks_use_id_js__WEBPACK_IMPORTED_MODULE_4__.useId)(),c={value:!1},N=K(()=>{c.value||(n.value="hidden",p(m),t("afterLeave"))});(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{let o=h(m);(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(o)}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(()=>{if(l.value===_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.RenderStrategy.Hidden&&!!m){if(i&&n.value!=="visible"){n.value="visible";return}(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(n.value,{["hidden"]:()=>p(m),["visible"]:()=>h(m)})}});let k=d(e.enter),$=d(e.enterFrom),q=d(e.enterTo),O=d(e.entered),z=d(e.leave),G=d(e.leaveFrom),J=d(e.leaveTo);(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(()=>{if(n.value==="visible"){let o=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_5__.dom)(r);if(o instanceof Comment&&o.data==="")throw new Error("Did you forget to passthrough the `ref` to the actual DOM node?")}})});function Q(o){let S=B.value&&!x.value,u=(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_5__.dom)(r);!u||!(u instanceof HTMLElement)||S||(c.value=!0,i.value&&t("beforeEnter"),i.value||t("beforeLeave"),o(i.value?(0,_utils_transition_js__WEBPACK_IMPORTED_MODULE_6__.transition)(u,k,$,q,O,C=>{c.value=!1,C===_utils_transition_js__WEBPACK_IMPORTED_MODULE_6__.Reason.Finished&&t("afterEnter")}):(0,_utils_transition_js__WEBPACK_IMPORTED_MODULE_6__.transition)(u,z,G,J,O,C=>{c.value=!1,C===_utils_transition_js__WEBPACK_IMPORTED_MODULE_6__.Reason.Finished&&(w(N)||(n.value="hidden",p(m),t("afterLeave")))})))}return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{(0,vue__WEBPACK_IMPORTED_MODULE_0__.watch)([i],(o,S,u)=>{Q(u),B.value=!1},{immediate:!0})}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(R,N),(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.useOpenClosedProvider)((0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(n.value,{["visible"]:_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.State.Open,["hidden"]:_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.State.Closed}))),()=>{let{appear:o,show:S,enter:u,enterFrom:C,enterTo:de,entered:ve,leave:pe,leaveFrom:me,leaveTo:Te,...W}=e;return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.render)({props:{...W,...{ref:r}},slot:{},slots:s,attrs:a,features:_,visible:n.value==="visible",name:"TransitionChild"})}}}),ue=oe,fe=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({inheritAttrs:!1,props:{as:{type:[Object,String],default:"div"},show:{type:[Boolean],default:null},unmount:{type:[Boolean],default:!0},appear:{type:[Boolean],default:!1},enter:{type:[String],default:""},enterFrom:{type:[String],default:""},enterTo:{type:[String],default:""},entered:{type:[String],default:""},leave:{type:[String],default:""},leaveFrom:{type:[String],default:""},leaveTo:{type:[String],default:""}},emits:{beforeEnter:()=>!0,afterEnter:()=>!0,beforeLeave:()=>!0,afterLeave:()=>!0},setup(e,{emit:t,attrs:a,slots:s}){let v=(0,_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.useOpenClosed)(),r=(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>e.show===null&&v!==null?(0,_utils_match_js__WEBPACK_IMPORTED_MODULE_2__.match)(v.value,{[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.State.Open]:!0,[_internal_open_closed_js__WEBPACK_IMPORTED_MODULE_3__.State.Closed]:!1}):e.show);(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(()=>{if(![!0,!1].includes(r.value))throw new Error('A <Transition /> is used but it is missing a `:show="true | false"` prop.')});let n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(r.value?"visible":"hidden"),l=K(()=>{n.value="hidden"}),i=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(!0),x={show:r,appear:(0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(()=>e.appear||!i.value)};return (0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(()=>{i.value=!1,r.value?n.value="visible":w(l)||(n.value="hidden")})}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(R,l),(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(F,x),()=>{let h=(0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.omit)(e,["show","appear","unmount"]),p={unmount:e.unmount};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.render)({props:{...p,as:"template"},slot:{},slots:{...s,default:()=>[(0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(ue,{onBeforeEnter:()=>t("beforeEnter"),onAfterEnter:()=>t("afterEnter"),onBeforeLeave:()=>t("beforeLeave"),onAfterLeave:()=>t("afterLeave"),...a,...p,...h},s.default)]},attrs:{},features:_,visible:n.value==="visible",name:"Transition"})}}});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/components/transitions/utils/transition.js":
/*!**************************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/components/transitions/utils/transition.js ***!
  \**************************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Reason": () => (/* binding */ g),
/* harmony export */   "transition": () => (/* binding */ L)
/* harmony export */ });
/* harmony import */ var _utils_once_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../utils/once.js */ "./node_modules/@headlessui/vue/dist/utils/once.js");
/* harmony import */ var _utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/disposables.js */ "./node_modules/@headlessui/vue/dist/utils/disposables.js");
function m(e,...t){e&&t.length>0&&e.classList.add(...t)}function d(e,...t){e&&t.length>0&&e.classList.remove(...t)}var g=(i=>(i.Finished="finished",i.Cancelled="cancelled",i))(g||{});function F(e,t){let i=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__.disposables)();if(!e)return i.dispose;let{transitionDuration:n,transitionDelay:a}=getComputedStyle(e),[l,s]=[n,a].map(o=>{let[u=0]=o.split(",").filter(Boolean).map(r=>r.includes("ms")?parseFloat(r):parseFloat(r)*1e3).sort((r,c)=>c-r);return u});return l!==0?i.setTimeout(()=>t("finished"),l+s):t("finished"),i.add(()=>t("cancelled")),i.dispose}function L(e,t,i,n,a,l){let s=(0,_utils_disposables_js__WEBPACK_IMPORTED_MODULE_0__.disposables)(),o=l!==void 0?(0,_utils_once_js__WEBPACK_IMPORTED_MODULE_1__.once)(l):()=>{};return d(e,...a),m(e,...t,...i),s.nextFrame(()=>{d(e,...i),m(e,...n),s.add(F(e,u=>(d(e,...n,...t),m(e,...a),o(u))))}),s.add(()=>d(e,...t,...i,...n,...a)),s.add(()=>o("cancelled")),s.dispose}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-event-listener.js":
/*!***********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-event-listener.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useEventListener": () => (/* binding */ r)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function r(n,e,d,o){typeof window!="undefined"&&(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(t=>{n=n!=null?n:window,n.addEventListener(e,d,o),t(()=>n.removeEventListener(e,d,o))})}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-id.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-id.js ***!
  \***********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useId": () => (/* binding */ t)
/* harmony export */ });
let e=0;function n(){return++e}function t(){return n()}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-inert-others.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-inert-others.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useInertOthers": () => (/* binding */ g)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_owner_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/owner.js */ "./node_modules/@headlessui/vue/dist/utils/owner.js");
let l="body > *",i=new Set,r=new Map;function u(t){t.setAttribute("aria-hidden","true"),t.inert=!0}function s(t){let n=r.get(t);!n||(n["aria-hidden"]===null?t.removeAttribute("aria-hidden"):t.setAttribute("aria-hidden",n["aria-hidden"]),t.inert=n.inert)}function g(t,n=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(!0)){(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(d=>{if(!n.value||!t.value)return;let a=t.value,o=(0,_utils_owner_js__WEBPACK_IMPORTED_MODULE_1__.getOwnerDocument)(a);if(!!o){i.add(a);for(let e of r.keys())e.contains(a)&&(s(e),r.delete(e));o.querySelectorAll(l).forEach(e=>{if(e instanceof HTMLElement){for(let f of i)if(e.contains(f))return;i.size===1&&(r.set(e,{"aria-hidden":e.getAttribute("aria-hidden"),inert:e.inert}),u(e))}}),d(()=>{if(i.delete(a),i.size>0)o.querySelectorAll(l).forEach(e=>{if(e instanceof HTMLElement&&!r.has(e)){for(let f of i)if(e.contains(f))return;r.set(e,{"aria-hidden":e.getAttribute("aria-hidden"),inert:e.inert}),u(e)}});else for(let e of r.keys())s(e),r.delete(e)})}})}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-outside-click.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-outside-click.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": () => (/* binding */ s),
/* harmony export */   "useOutsideClick": () => (/* binding */ w)
/* harmony export */ });
/* harmony import */ var _use_window_event_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./use-window-event.js */ "./node_modules/@headlessui/vue/dist/hooks/use-window-event.js");
/* harmony import */ var _utils_dom_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/dom.js */ "./node_modules/@headlessui/vue/dist/utils/dom.js");
/* harmony import */ var _utils_micro_task_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utils/micro-task.js */ "./node_modules/@headlessui/vue/dist/utils/micro-task.js");
var s=(n=>(n[n.None=1]="None",n[n.IgnoreScrollbars=2]="IgnoreScrollbars",n))(s||{});function w(f,a,n=1){let i=!1;function l(r){if(i)return;i=!0,(0,_utils_micro_task_js__WEBPACK_IMPORTED_MODULE_0__.microTask)(()=>{i=!1});let o=r.target;if(!o.ownerDocument.documentElement.contains(o))return;let c=function t(e){return typeof e=="function"?t(e()):Array.isArray(e)||e instanceof Set?e:[e]}(f);if((n&2)===2){let t=20,e=o.ownerDocument.documentElement;if(r.clientX>e.clientWidth-t||r.clientX<t||r.clientY>e.clientHeight-t||r.clientY<t)return}for(let t of c){if(t===null)continue;let e=t instanceof HTMLElement?t:(0,_utils_dom_js__WEBPACK_IMPORTED_MODULE_1__.dom)(t);if(e!=null&&e.contains(o))return}a(r,o)}(0,_use_window_event_js__WEBPACK_IMPORTED_MODULE_2__.useWindowEvent)("pointerdown",l),(0,_use_window_event_js__WEBPACK_IMPORTED_MODULE_2__.useWindowEvent)("mousedown",l)}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-tab-direction.js":
/*!**********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-tab-direction.js ***!
  \**********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Direction": () => (/* binding */ d),
/* harmony export */   "useTabDirection": () => (/* binding */ n)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _use_window_event_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./use-window-event.js */ "./node_modules/@headlessui/vue/dist/hooks/use-window-event.js");
var d=(r=>(r[r.Forwards=0]="Forwards",r[r.Backwards=1]="Backwards",r))(d||{});function n(){let o=(0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(0);return (0,_use_window_event_js__WEBPACK_IMPORTED_MODULE_1__.useWindowEvent)("keydown",e=>{e.key==="Tab"&&(o.value=e.shiftKey?1:0)}),o}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/hooks/use-window-event.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/hooks/use-window-event.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "useWindowEvent": () => (/* binding */ w)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
function w(e,n,t){typeof window!="undefined"&&(0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(o=>{window.addEventListener(e,n,t),o(()=>window.removeEventListener(e,n,t))})}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/internal/hidden.js":
/*!**************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/internal/hidden.js ***!
  \**************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": () => (/* binding */ a),
/* harmony export */   "Hidden": () => (/* binding */ m)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
var a=(e=>(e[e.None=1]="None",e[e.Focusable=2]="Focusable",e[e.Hidden=4]="Hidden",e))(a||{});let m=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"Hidden",props:{as:{type:[Object,String],default:"div"},features:{type:Number,default:1}},setup(r,{slots:t,attrs:o}){return()=>{let{features:e,...d}=r,n={"aria-hidden":(e&2)===2?!0:void 0,style:{position:"absolute",width:1,height:1,padding:0,margin:-1,overflow:"hidden",clip:"rect(0, 0, 0, 0)",whiteSpace:"nowrap",borderWidth:"0",...(e&4)===4&&(e&2)!==2&&{display:"none"}}};return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.render)({props:{...d,...n},slot:{},attrs:o,slots:t,name:"Hidden"})}}});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/internal/open-closed.js":
/*!*******************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/internal/open-closed.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "State": () => (/* binding */ l),
/* harmony export */   "hasOpenClosed": () => (/* binding */ f),
/* harmony export */   "useOpenClosed": () => (/* binding */ p),
/* harmony export */   "useOpenClosedProvider": () => (/* binding */ c)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
let n=Symbol("Context");var l=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(l||{});function f(){return p()!==null}function p(){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(n,null)}function c(o){(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(n,o)}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/internal/portal-force-root.js":
/*!*************************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/internal/portal-force-root.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ForcePortalRoot": () => (/* binding */ P),
/* harmony export */   "usePortalRoot": () => (/* binding */ u)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _utils_render_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils/render.js */ "./node_modules/@headlessui/vue/dist/utils/render.js");
let e=Symbol("ForcePortalRootContext");function u(){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(e,!1)}let P=(0,vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent)({name:"ForcePortalRoot",props:{as:{type:[Object,String],default:"template"},force:{type:Boolean,default:!1}},setup(o,{slots:t,attrs:r}){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(e,o.force),()=>{let{force:f,...n}=o;return (0,_utils_render_js__WEBPACK_IMPORTED_MODULE_1__.render)({props:n,slot:{},slots:t,attrs:r,name:"ForcePortalRoot"})}}});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/internal/stack-context.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/internal/stack-context.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "StackMessage": () => (/* binding */ c),
/* harmony export */   "useStackContext": () => (/* binding */ a),
/* harmony export */   "useStackProvider": () => (/* binding */ s)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
let i=Symbol("StackContext");var c=(e=>(e[e.Add=0]="Add",e[e.Remove=1]="Remove",e))(c||{});function a(){return (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)(i,()=>{})}function s({type:n,element:o,onUpdate:e}){let m=a();function t(...r){e==null||e(...r),m(...r)}(0,vue__WEBPACK_IMPORTED_MODULE_0__.onMounted)(()=>{t(0,n,o),(0,vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted)(()=>{t(1,n,o)})}),(0,vue__WEBPACK_IMPORTED_MODULE_0__.provide)(i,t)}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/keyboard.js":
/*!*******************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/keyboard.js ***!
  \*******************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Keys": () => (/* binding */ o)
/* harmony export */ });
var o=(r=>(r.Space=" ",r.Enter="Enter",r.Escape="Escape",r.Backspace="Backspace",r.Delete="Delete",r.ArrowLeft="ArrowLeft",r.ArrowUp="ArrowUp",r.ArrowRight="ArrowRight",r.ArrowDown="ArrowDown",r.Home="Home",r.End="End",r.PageUp="PageUp",r.PageDown="PageDown",r.Tab="Tab",r))(o||{});


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/disposables.js":
/*!****************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/disposables.js ***!
  \****************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "disposables": () => (/* binding */ r)
/* harmony export */ });
function r(){let i=[],o=[],t={enqueue(e){o.push(e)},requestAnimationFrame(...e){let a=requestAnimationFrame(...e);t.add(()=>cancelAnimationFrame(a))},nextFrame(...e){t.requestAnimationFrame(()=>{t.requestAnimationFrame(...e)})},setTimeout(...e){let a=setTimeout(...e);t.add(()=>clearTimeout(a))},add(e){i.push(e)},dispose(){for(let e of i.splice(0))e()},async workQueue(){for(let e of o.splice(0))await e()}};return t}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/dom.js":
/*!********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/dom.js ***!
  \********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "dom": () => (/* binding */ t)
/* harmony export */ });
function t(l){return l==null||l.value==null?null:"$el"in l.value?l.value.$el:l.value}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/focus-management.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/focus-management.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Focus": () => (/* binding */ L),
/* harmony export */   "FocusResult": () => (/* binding */ N),
/* harmony export */   "FocusableMode": () => (/* binding */ M),
/* harmony export */   "focusElement": () => (/* binding */ H),
/* harmony export */   "focusIn": () => (/* binding */ P),
/* harmony export */   "getFocusableElements": () => (/* binding */ b),
/* harmony export */   "isFocusableElement": () => (/* binding */ F),
/* harmony export */   "sortByDomNode": () => (/* binding */ w)
/* harmony export */ });
/* harmony import */ var _match_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./match.js */ "./node_modules/@headlessui/vue/dist/utils/match.js");
/* harmony import */ var _owner_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./owner.js */ "./node_modules/@headlessui/vue/dist/utils/owner.js");
let c=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var L=(o=>(o[o.First=1]="First",o[o.Previous=2]="Previous",o[o.Next=4]="Next",o[o.Last=8]="Last",o[o.WrapAround=16]="WrapAround",o[o.NoScroll=32]="NoScroll",o))(L||{}),N=(n=>(n[n.Error=0]="Error",n[n.Overflow=1]="Overflow",n[n.Success=2]="Success",n[n.Underflow=3]="Underflow",n))(N||{}),T=(t=>(t[t.Previous=-1]="Previous",t[t.Next=1]="Next",t))(T||{});function b(e=document.body){return e==null?[]:Array.from(e.querySelectorAll(c))}var M=(t=>(t[t.Strict=0]="Strict",t[t.Loose=1]="Loose",t))(M||{});function F(e,r=0){var t;return e===((t=(0,_owner_js__WEBPACK_IMPORTED_MODULE_0__.getOwnerDocument)(e))==null?void 0:t.body)?!1:(0,_match_js__WEBPACK_IMPORTED_MODULE_1__.match)(r,{[0](){return e.matches(c)},[1](){let l=e;for(;l!==null;){if(l.matches(c))return!0;l=l.parentElement}return!1}})}function H(e){e==null||e.focus({preventScroll:!0})}let h=["textarea","input"].join(",");function v(e){var r,t;return(t=(r=e==null?void 0:e.matches)==null?void 0:r.call(e,h))!=null?t:!1}function w(e,r=t=>t){return e.slice().sort((t,l)=>{let n=r(t),i=r(l);if(n===null||i===null)return 0;let o=n.compareDocumentPosition(i);return o&Node.DOCUMENT_POSITION_FOLLOWING?-1:o&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function P(e,r,t=!0){var d;let l=(d=Array.isArray(e)?e.length>0?e[0].ownerDocument:document:e==null?void 0:e.ownerDocument)!=null?d:document,n=Array.isArray(e)?t?w(e):e:b(e),i=l.activeElement,o=(()=>{if(r&5)return 1;if(r&10)return-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),m=(()=>{if(r&1)return 0;if(r&2)return Math.max(0,n.indexOf(i))-1;if(r&4)return Math.max(0,n.indexOf(i))+1;if(r&8)return n.length-1;throw new Error("Missing Focus.First, Focus.Previous, Focus.Next or Focus.Last")})(),x=r&32?{preventScroll:!0}:{},f=0,s=n.length,u;do{if(f>=s||f+s<=0)return 0;let a=m+f;if(r&16)a=(a+s)%s;else{if(a<0)return 3;if(a>=s)return 1}u=n[a],u==null||u.focus(x),f+=o}while(u!==l.activeElement);return u.hasAttribute("tabindex")||u.setAttribute("tabindex","0"),r&6&&v(u)&&u.select(),2}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/match.js":
/*!**********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/match.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "match": () => (/* binding */ u)
/* harmony export */ });
function u(r,n,...a){if(r in n){let e=n[r];return typeof e=="function"?e(...a):e}let t=new Error(`Tried to handle "${r}" but there is no handler defined. Only defined handlers are: ${Object.keys(n).map(e=>`"${e}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(t,u),t}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/micro-task.js":
/*!***************************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/micro-task.js ***!
  \***************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "microTask": () => (/* binding */ t)
/* harmony export */ });
function t(e){typeof queueMicrotask=="function"?queueMicrotask(e):Promise.resolve().then(e).catch(o=>setTimeout(()=>{throw o}))}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/once.js":
/*!*********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/once.js ***!
  \*********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "once": () => (/* binding */ l)
/* harmony export */ });
function l(r){let e={called:!1};return(...t)=>{if(!e.called)return e.called=!0,r(...t)}}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/owner.js":
/*!**********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/owner.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getOwnerDocument": () => (/* binding */ e)
/* harmony export */ });
/* harmony import */ var _dom_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./dom.js */ "./node_modules/@headlessui/vue/dist/utils/dom.js");
function e(n){if(typeof window=="undefined")return null;if(n instanceof Node)return n.ownerDocument;if(n!=null&&n.hasOwnProperty("value")){let o=(0,_dom_js__WEBPACK_IMPORTED_MODULE_0__.dom)(n);if(o)return o.ownerDocument}return document}


/***/ }),

/***/ "./node_modules/@headlessui/vue/dist/utils/render.js":
/*!***********************************************************!*\
  !*** ./node_modules/@headlessui/vue/dist/utils/render.js ***!
  \***********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Features": () => (/* binding */ h),
/* harmony export */   "RenderStrategy": () => (/* binding */ b),
/* harmony export */   "compact": () => (/* binding */ S),
/* harmony export */   "omit": () => (/* binding */ R),
/* harmony export */   "render": () => (/* binding */ k)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _match_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./match.js */ "./node_modules/@headlessui/vue/dist/utils/match.js");
var h=(t=>(t[t.None=0]="None",t[t.RenderStrategy=1]="RenderStrategy",t[t.Static=2]="Static",t))(h||{}),b=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(b||{});function k({visible:n=!0,features:r=0,...e}){var t;if(n||r&2&&e.props.static)return i(e);if(r&1){let a=(t=e.props.unmount)==null||t?0:1;return (0,_match_js__WEBPACK_IMPORTED_MODULE_1__.match)(a,{[0](){return null},[1](){return i({...e,props:{...e.props,hidden:!0,style:{display:"none"}}})}})}return i(e)}function i({props:n,attrs:r,slots:e,slot:t,name:a}){var c;let{as:d,...s}=R(n,["unmount","static"]),o=(c=e.default)==null?void 0:c.call(e,t),u={};if(d==="template"){if(Object.keys(s).length>0||Object.keys(r).length>0){let[p,...f]=o!=null?o:[];if(!j(p)||f.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${a} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(s).concat(Object.keys(r)).map(l=>`  - ${l}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(l=>`  - ${l}`).join(`
`)].join(`
`));return (0,vue__WEBPACK_IMPORTED_MODULE_0__.cloneVNode)(p,Object.assign({},s,u))}return Array.isArray(o)&&o.length===1?o[0]:o}return (0,vue__WEBPACK_IMPORTED_MODULE_0__.h)(d,Object.assign({},s,u),o)}function S(n){let r=Object.assign({},n);for(let e in r)r[e]===void 0&&delete r[e];return r}function R(n,r=[]){let e=Object.assign({},n);for(let t of r)t in e&&delete e[t];return e}function j(n){return n==null?!1:typeof n.type=="string"||typeof n.type=="object"||typeof n.type=="function"}


/***/ }),

/***/ "./node_modules/vue-demi/lib/index.mjs":
/*!*********************************************!*\
  !*** ./node_modules/vue-demi/lib/index.mjs ***!
  \*********************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "BaseTransition": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.BaseTransition),
/* harmony export */   "Comment": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Comment),
/* harmony export */   "EffectScope": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.EffectScope),
/* harmony export */   "Fragment": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Fragment),
/* harmony export */   "KeepAlive": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.KeepAlive),
/* harmony export */   "ReactiveEffect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.ReactiveEffect),
/* harmony export */   "Static": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Static),
/* harmony export */   "Suspense": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Suspense),
/* harmony export */   "Teleport": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Teleport),
/* harmony export */   "Text": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Text),
/* harmony export */   "Transition": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.Transition),
/* harmony export */   "TransitionGroup": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.TransitionGroup),
/* harmony export */   "Vue": () => (/* reexport module object */ vue__WEBPACK_IMPORTED_MODULE_0__),
/* harmony export */   "Vue2": () => (/* binding */ Vue2),
/* harmony export */   "VueElement": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.VueElement),
/* harmony export */   "callWithAsyncErrorHandling": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.callWithAsyncErrorHandling),
/* harmony export */   "callWithErrorHandling": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.callWithErrorHandling),
/* harmony export */   "camelize": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.camelize),
/* harmony export */   "capitalize": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.capitalize),
/* harmony export */   "cloneVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.cloneVNode),
/* harmony export */   "compatUtils": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.compatUtils),
/* harmony export */   "compile": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.compile),
/* harmony export */   "computed": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.computed),
/* harmony export */   "createApp": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createApp),
/* harmony export */   "createBlock": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createBlock),
/* harmony export */   "createCommentVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode),
/* harmony export */   "createElementBlock": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock),
/* harmony export */   "createElementVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode),
/* harmony export */   "createHydrationRenderer": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createHydrationRenderer),
/* harmony export */   "createPropsRestProxy": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createPropsRestProxy),
/* harmony export */   "createRenderer": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createRenderer),
/* harmony export */   "createSSRApp": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createSSRApp),
/* harmony export */   "createSlots": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createSlots),
/* harmony export */   "createStaticVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode),
/* harmony export */   "createTextVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode),
/* harmony export */   "createVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.createVNode),
/* harmony export */   "customRef": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.customRef),
/* harmony export */   "defineAsyncComponent": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineAsyncComponent),
/* harmony export */   "defineComponent": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineComponent),
/* harmony export */   "defineCustomElement": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineCustomElement),
/* harmony export */   "defineEmits": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineEmits),
/* harmony export */   "defineExpose": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineExpose),
/* harmony export */   "defineProps": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineProps),
/* harmony export */   "defineSSRCustomElement": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.defineSSRCustomElement),
/* harmony export */   "del": () => (/* binding */ del),
/* harmony export */   "devtools": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.devtools),
/* harmony export */   "effect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.effect),
/* harmony export */   "effectScope": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.effectScope),
/* harmony export */   "getCurrentInstance": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.getCurrentInstance),
/* harmony export */   "getCurrentScope": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.getCurrentScope),
/* harmony export */   "getTransitionRawChildren": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.getTransitionRawChildren),
/* harmony export */   "guardReactiveProps": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.guardReactiveProps),
/* harmony export */   "h": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.h),
/* harmony export */   "handleError": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.handleError),
/* harmony export */   "hydrate": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.hydrate),
/* harmony export */   "initCustomFormatter": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.initCustomFormatter),
/* harmony export */   "initDirectivesForSSR": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.initDirectivesForSSR),
/* harmony export */   "inject": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.inject),
/* harmony export */   "install": () => (/* binding */ install),
/* harmony export */   "isMemoSame": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isMemoSame),
/* harmony export */   "isProxy": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isProxy),
/* harmony export */   "isReactive": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isReactive),
/* harmony export */   "isReadonly": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isReadonly),
/* harmony export */   "isRef": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isRef),
/* harmony export */   "isRuntimeOnly": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isRuntimeOnly),
/* harmony export */   "isShallow": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isShallow),
/* harmony export */   "isVNode": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.isVNode),
/* harmony export */   "isVue2": () => (/* binding */ isVue2),
/* harmony export */   "isVue3": () => (/* binding */ isVue3),
/* harmony export */   "markRaw": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.markRaw),
/* harmony export */   "mergeDefaults": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.mergeDefaults),
/* harmony export */   "mergeProps": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.mergeProps),
/* harmony export */   "nextTick": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.nextTick),
/* harmony export */   "normalizeClass": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass),
/* harmony export */   "normalizeProps": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.normalizeProps),
/* harmony export */   "normalizeStyle": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.normalizeStyle),
/* harmony export */   "onActivated": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onActivated),
/* harmony export */   "onBeforeMount": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onBeforeMount),
/* harmony export */   "onBeforeUnmount": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onBeforeUnmount),
/* harmony export */   "onBeforeUpdate": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onBeforeUpdate),
/* harmony export */   "onDeactivated": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onDeactivated),
/* harmony export */   "onErrorCaptured": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onErrorCaptured),
/* harmony export */   "onMounted": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onMounted),
/* harmony export */   "onRenderTracked": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onRenderTracked),
/* harmony export */   "onRenderTriggered": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onRenderTriggered),
/* harmony export */   "onScopeDispose": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onScopeDispose),
/* harmony export */   "onServerPrefetch": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onServerPrefetch),
/* harmony export */   "onUnmounted": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onUnmounted),
/* harmony export */   "onUpdated": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.onUpdated),
/* harmony export */   "openBlock": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.openBlock),
/* harmony export */   "popScopeId": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId),
/* harmony export */   "provide": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.provide),
/* harmony export */   "proxyRefs": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.proxyRefs),
/* harmony export */   "pushScopeId": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId),
/* harmony export */   "queuePostFlushCb": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.queuePostFlushCb),
/* harmony export */   "reactive": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.reactive),
/* harmony export */   "readonly": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.readonly),
/* harmony export */   "ref": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.ref),
/* harmony export */   "registerRuntimeCompiler": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.registerRuntimeCompiler),
/* harmony export */   "render": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "renderList": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.renderList),
/* harmony export */   "renderSlot": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot),
/* harmony export */   "resolveComponent": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent),
/* harmony export */   "resolveDirective": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.resolveDirective),
/* harmony export */   "resolveDynamicComponent": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.resolveDynamicComponent),
/* harmony export */   "resolveFilter": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.resolveFilter),
/* harmony export */   "resolveTransitionHooks": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.resolveTransitionHooks),
/* harmony export */   "set": () => (/* binding */ set),
/* harmony export */   "setBlockTracking": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.setBlockTracking),
/* harmony export */   "setDevtoolsHook": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.setDevtoolsHook),
/* harmony export */   "setTransitionHooks": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.setTransitionHooks),
/* harmony export */   "shallowReactive": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.shallowReactive),
/* harmony export */   "shallowReadonly": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.shallowReadonly),
/* harmony export */   "shallowRef": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.shallowRef),
/* harmony export */   "ssrContextKey": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.ssrContextKey),
/* harmony export */   "ssrUtils": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.ssrUtils),
/* harmony export */   "stop": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.stop),
/* harmony export */   "toDisplayString": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString),
/* harmony export */   "toHandlerKey": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toHandlerKey),
/* harmony export */   "toHandlers": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toHandlers),
/* harmony export */   "toRaw": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toRaw),
/* harmony export */   "toRef": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toRef),
/* harmony export */   "toRefs": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.toRefs),
/* harmony export */   "transformVNodeArgs": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.transformVNodeArgs),
/* harmony export */   "triggerRef": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.triggerRef),
/* harmony export */   "unref": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.unref),
/* harmony export */   "useAttrs": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useAttrs),
/* harmony export */   "useCssModule": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useCssModule),
/* harmony export */   "useCssVars": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useCssVars),
/* harmony export */   "useSSRContext": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useSSRContext),
/* harmony export */   "useSlots": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useSlots),
/* harmony export */   "useTransitionState": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.useTransitionState),
/* harmony export */   "vModelCheckbox": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox),
/* harmony export */   "vModelDynamic": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vModelDynamic),
/* harmony export */   "vModelRadio": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vModelRadio),
/* harmony export */   "vModelSelect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect),
/* harmony export */   "vModelText": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vModelText),
/* harmony export */   "vShow": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.vShow),
/* harmony export */   "version": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.version),
/* harmony export */   "warn": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.warn),
/* harmony export */   "watch": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.watch),
/* harmony export */   "watchEffect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect),
/* harmony export */   "watchPostEffect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.watchPostEffect),
/* harmony export */   "watchSyncEffect": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.watchSyncEffect),
/* harmony export */   "withAsyncContext": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withAsyncContext),
/* harmony export */   "withCtx": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withCtx),
/* harmony export */   "withDefaults": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withDefaults),
/* harmony export */   "withDirectives": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives),
/* harmony export */   "withKeys": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withKeys),
/* harmony export */   "withMemo": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withMemo),
/* harmony export */   "withModifiers": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers),
/* harmony export */   "withScopeId": () => (/* reexport safe */ vue__WEBPACK_IMPORTED_MODULE_0__.withScopeId)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


var isVue2 = false
var isVue3 = true
var Vue2 = undefined

function install() {}

function set(target, key, val) {
  if (Array.isArray(target)) {
    target.length = Math.max(target.length, key)
    target.splice(key, 1, val)
    return val
  }
  target[key] = val
  return val
}

function del(target, key) {
  if (Array.isArray(target)) {
    target.splice(key, 1)
    return
  }
  delete target[key]
}





/***/ })

}]);