"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_pages_financeiro_tipos-cobrancas_Form_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      id: null,
      ind_status: [],
      form: {
        nom_tipo_cobranca: '',
        ind_status: 1
      }
    };
  },

  /*watch: {
      'form.ind_status': function (val, oldVal) {
          if(val == 'A'){
              this.form.ind_status = true;
          }
      }
  },*/
  created: function created() {
    var _this$$route$params$i;

    this.id = (_this$$route$params$i = this.$route.params.id) !== null && _this$$route$params$i !== void 0 ? _this$$route$params$i : null;

    if (this.id != null) {
      this.getTipoCobranca(this.id);
    }

    this.getDominioItens('ind_status');
  },
  methods: {
    onSubmit: function onSubmit() {
      this.id == null ? this.store() : this.update(this.id);
    },
    getTipoCobranca: function getTipoCobranca(id) {
      var _this = this;

      axios.get("http://localhost:8000/api/tipos-cobrancas/".concat(id), this.form).then(function (response) {
        var data = response.data;
        _this.form.nom_tipo_cobranca = data.nom_tipo_cobranca;
      });
    },
    getDominioItens: function getDominioItens(dominioId) {
      var _this2 = this;

      axios.get("http://localhost:8000/api/dominios-itens/".concat(dominioId)).then(function (response) {
        console.log('response', response);

        if (response.data) {
          _this2.ind_status = response.data;
        }
      })["finally"](function () {});
    },
    store: function store() {
      axios.post("http://localhost:8000/api/tipos-cobrancas", this.form).then(function (response) {
        console.log('response', response);
      });
    },
    update: function update(id) {
      axios.put("http://localhost:8000/api/tipos-cobrancas/".concat(id), this.form).then(function (response) {
        console.log('response', response);
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/pages/financeiro/tipos-cobrancas/Form.vue":
/*!**************************************************************!*\
  !*** ./resources/js/pages/financeiro/tipos-cobrancas/Form.vue ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Form.vue?vue&type=template&id=43383b1d& */ "./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d&");
/* harmony import */ var _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Form.vue?vue&type=script&lang=js& */ "./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__.render,
  _Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/financeiro/tipos-cobrancas/Form.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Form.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_template_id_43383b1d___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Form.vue?vue&type=template&id=43383b1d& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/financeiro/tipos-cobrancas/Form.vue?vue&type=template&id=43383b1d& ***!
  \************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-header" }, [
        _vm._v("\n            Tipo de Cobrança\n        ")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body" }, [
        _c(
          "form",
          {
            on: {
              submit: function($event) {
                $event.preventDefault()
                return _vm.onSubmit.apply(null, arguments)
              }
            }
          },
          [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-12" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { attrs: { for: "val_maximo" } }, [
                    _vm._v("Tipo de Cobrança")
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.form.nom_tipo_cobranca,
                        expression: "form.nom_tipo_cobranca"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text", id: "val_maximo" },
                    domProps: { value: _vm.form.nom_tipo_cobranca },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.form,
                          "nom_tipo_cobranca",
                          $event.target.value
                        )
                      }
                    }
                  })
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-12" }, [
                _c("div", { staticClass: "form-group" }, [
                  _c("label", { attrs: { for: "ind_status" } }, [
                    _vm._v("Status")
                  ]),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.form.ind_status,
                          expression: "form.ind_status"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { name: "ind_status", id: "ind_status" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.$set(
                            _vm.form,
                            "ind_status",
                            $event.target.multiple
                              ? $$selectedVal
                              : $$selectedVal[0]
                          )
                        }
                      }
                    },
                    _vm._l(_vm.ind_status, function(status, key) {
                      return _c(
                        "option",
                        {
                          key: key,
                          domProps: { value: status.val_dominio_item }
                        },
                        [_vm._v(_vm._s(status.dsc_dominio_item))]
                      )
                    }),
                    0
                  )
                ])
              ])
            ]),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-primary btn-sm",
                attrs: { type: "submit" }
              },
              [
                _vm._v(
                  "\n                    " +
                    _vm._s(_vm.id == null ? "Criar" : "Salvar") +
                    "\n                "
                )
              ]
            )
          ]
        ),
        _vm._v(" "),
        _c("pre", [_vm._v(_vm._s(_vm.form))])
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);