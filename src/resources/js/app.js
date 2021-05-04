require('./bootstrap');

import Vue from 'vue';
window.axios = require('axios');

Vue.component('image-preview', require('./components/imagepreview/FeatureImage.vue').default);
Vue.component('first-image', require('./components/imagepreview/FirstImage.vue').default);
Vue.component('second-image', require('./components/imagepreview/SecondImage.vue').default);
Vue.component('category-drop-down', require('./components/CategoryDropDown.vue').default);
Vue.component('address-drop-down', require('./components/AddressDropDown.vue').default);
Vue.component('message', require('./components/Message.vue').default);

const app = new Vue({
    el: '#app',
});
