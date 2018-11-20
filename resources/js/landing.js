require('./bootstrap');

window.Vue = require('vue');


Vue.component('cl-image', require('./components/CloudImage.vue'))

const app = new Vue({
    el: '#root'
});