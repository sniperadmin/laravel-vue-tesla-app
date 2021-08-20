/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import App from './components/App.vue';
require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuetify from 'vuetify/dist/vuetify';
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css"

import axios from 'axios'
import VueAxios from 'vue-axios'
import router from './router'

Vue.use(Vuetify);
Vue.use(VueAxios, axios);
// Vue.use(router)

const vuetify = new Vuetify({
    theme: {
        dark: true,
    },
});

new Vue({
    vuetify,
    router,
    render: (h) => h(App)
}).$mount('#todo');
