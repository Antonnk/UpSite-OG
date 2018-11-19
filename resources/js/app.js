
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
Vue.use(Vuex)
import store from './store'

Vue.component('cl-image', require('./components/CloudImage.vue'))
Vue.component('site-builder', require('./site-builder/index.vue'))

const app = new Vue({
    el: '#root',
    store
});
