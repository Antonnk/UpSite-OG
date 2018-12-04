webpackJsonp([0],{

/***/ 224:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(14)
/* script */
var __vue_script__ = __webpack_require__(284)
/* template */
var __vue_template__ = __webpack_require__(285)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/site-builder/theme/CafeRender.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1b012665", Component.options)
  } else {
    hotAPI.reload("data-v-1b012665", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 284:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__store__ = __webpack_require__(74);
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
//



/* harmony default export */ __webpack_exports__["default"] = ({
	props: {
		value: {
			type: Object,
			default: function _default() {
				return __WEBPACK_IMPORTED_MODULE_0__store__["a" /* default */].getters.content;
			}
		}
	},
	data: function data(vm) {
		return {
			content: vm.value
		};
	}
});

/***/ }),

/***/ 285:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "main",
    { staticClass: "bg-brown-lighter h-screen flex flex-col" },
    [
      _c(
        "header",
        {
          staticClass:
            "container mx-auto flex py-6 items-baseline justify-between flex-no-shrink"
        },
        [
          _c("div", { staticClass: "flex-1" }, [
            _c(
              "svg",
              {
                staticClass: "fill-current text-green",
                attrs: {
                  xmlns: "http://www.w3.org/2000/svg",
                  width: "24",
                  height: "24",
                  viewBox: "0 0 24 24"
                }
              },
              [
                _c("path", {
                  attrs: {
                    d:
                      "M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"
                  }
                })
              ]
            ),
            _vm._v(" "),
            _c(
              "svg",
              {
                staticClass: "fill-current text-green",
                attrs: {
                  xmlns: "http://www.w3.org/2000/svg",
                  width: "24",
                  height: "24",
                  viewBox: "0 0 24 24"
                }
              },
              [
                _c("path", {
                  attrs: {
                    d:
                      "M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                  }
                })
              ]
            )
          ]),
          _vm._v(" "),
          _vm._m(0)
        ]
      ),
      _vm._v(" "),
      _c(
        "section",
        {
          staticClass: "container mx-auto flex items-start flex-no-shrink py-4"
        },
        [
          _c("div", { staticClass: "w-1/2 pr-3" }, [
            _c("h1", { staticClass: "flex-1 text-green text-4xl" }, [
              _vm._v(_vm._s(_vm.content.name))
            ]),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _c("h2", {
              staticClass: "text-brown mb-1",
              domProps: { innerHTML: _vm._s(_vm.content.title) }
            }),
            _vm._v(" "),
            _c("p", { domProps: { innerHTML: _vm._s(_vm.content.intro) } })
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "flex justify-end w-1/2" },
            [
              _c("cl-image", {
                staticClass: "border-b-8 border-r-8 border-brown",
                attrs: {
                  "public-id": _vm.content.intro_image,
                  options: { crop: "fill", width: 400, height: 400 }
                }
              })
            ],
            1
          )
        ]
      ),
      _vm._v(" "),
      _c("section", { staticClass: "bg-brown-light text-green mt-12" }, [
        _c("div", { staticClass: "container mx-auto" }, [
          _c("div", { staticClass: "flex" }, [
            _c("div", { staticClass: "flex flex-col w-2/3 py-12" }, [
              _c("h2", { staticClass: "text-4xl mb-4" }, [
                _vm._v(_vm._s(_vm.content.menu_title))
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "mr-16" }, [
                _c(
                  "ul",
                  { staticClass: "list-reset flex-1" },
                  _vm._l(_vm.content.menu, function(item) {
                    return _c("li", { staticClass: "flex mb-2" }, [
                      _c("span", { staticClass: "flex-1" }, [
                        _vm._v(
                          "\n\t\t\t\t\t\t\t\t\t" +
                            _vm._s(item.name) +
                            "\n\t\t\t\t\t\t\t\t"
                        )
                      ]),
                      _vm._v(" "),
                      _c("b", [
                        _vm._v(
                          "\n\t\t\t\t\t\t\t\t\t" +
                            _vm._s(item.price) +
                            "\n\t\t\t\t\t\t\t\t"
                        )
                      ]),
                      _vm._v(" "),
                      _c("b", [_vm._v("kr")])
                    ])
                  })
                )
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "flex-1 w-1/3" },
              [
                _c(
                  "cl-image",
                  {
                    staticClass: "bg-cover bg-no-repeat h-full w-full",
                    attrs: {
                      options: {
                        crop: "scale",
                        width: 500,
                        effect: "colorize:50",
                        color: "#f2e3b4"
                      },
                      "public-id": _vm.content.menu_image
                    }
                  },
                  [_c("i")]
                )
              ],
              1
            )
          ])
        ])
      ]),
      _vm._v(" "),
      _c("section", { staticClass: "bg-green text-brown-light flex-1" }, [
        _c("div", { staticClass: "container mx-auto py-12 mb-12 flex" }, [
          _c("div", { staticClass: "flex-1" }, [
            _c("h2", { staticClass: "mb-2" }, [_vm._v("Her kan du finde os")]),
            _vm._v(" "),
            _c("address", [
              _vm._v(
                "\n\t\t\t\t\t" + _vm._s(_vm.content.contact.address.street)
              ),
              _c("br"),
              _vm._v(
                "\n\t\t\t\t\t" +
                  _vm._s(_vm.content.contact.address.postcode) +
                  " " +
                  _vm._s(_vm.content.contact.address.city) +
                  "\n\t\t\t\t"
              )
            ]),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _c("span", [_vm._v(_vm._s(_vm.content.contact.email))]),
            _c("br"),
            _vm._v(" "),
            _c("span", [_vm._v(_vm._s(_vm.content.contact.phone))]),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _c("br"),
            _vm._v(" "),
            _c("p", [
              _vm._v("\n\t\t\t\t\t" + _vm._s(_vm.content.social.instagram)),
              _c("br"),
              _vm._v(
                "\n\t\t\t\t\t" +
                  _vm._s(_vm.content.social.facebook) +
                  "\n\t\t\t\t"
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "flex-1" })
        ])
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "flex-1 text-right text-green" }, [
      _vm._v("Idag åben til "),
      _c("b", [_vm._v("18:00")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1b012665", module.exports)
  }
}

/***/ })

});