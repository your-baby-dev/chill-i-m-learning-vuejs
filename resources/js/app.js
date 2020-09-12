/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('test-component', require('./components/TestComponent.vue').default);
Vue.component('child-component', require('./components/ChildComponent.vue').default);
Vue.component('images-component', require('./components/ImagesComponent.vue').default);

const app = new Vue({
    el: '#app',
});

