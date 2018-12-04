require('./bootstrap');

window.Vue = require('vue');

Vue.component('cl-image', require('./components/CloudImage.vue'))
Vue.component('contact-form', require('./components/ContactForm.vue'))

const app = new Vue({
    el: '#root',
    data: {
    	menuVisable: false,
    }
});