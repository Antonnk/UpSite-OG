
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
import PortalVue from 'portal-vue'
import store from './store'
Vue.use(Vuex)
Vue.use(PortalVue)

Vue.filter('striphtml', function (value) {
  var div = document.createElement("div");
  div.innerHTML = value;
  var text = div.textContent || div.innerText || "";
  return text;
});

Vue.component('cl-image', require('./components/CloudImage.vue'))
Vue.component('site-builder', require('./site-builder/index.vue'))
Vue.component('fetch-openhours', require('./site-builder/components/FetchOpenhours.vue'))

const app = new Vue({
    el: '#root',
    store
});
