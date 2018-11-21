
require('./bootstrap');

window.Vue = require('vue');

Vue.component('site-render', require('./site-builder/render.vue'))
Vue.component('cl-image', require('./components/CloudImage.vue'))

new Vue({
    el: '#root'
});
