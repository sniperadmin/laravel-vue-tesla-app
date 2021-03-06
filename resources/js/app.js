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

// Vue-Auth
import auth                  from '@websanova/vue-auth/dist/v2/vue-auth.esm.js';
import driverAuthBearer      from '@websanova/vue-auth/dist/drivers/auth/bearer.esm.js';
import driverHttpAxios       from '@websanova/vue-auth/dist/drivers/http/axios.1.x.esm.js';
import driverRouterVueRouter from '@websanova/vue-auth/dist/drivers/router/vue-router.2.x.esm.js';

const myaxios = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "Content-type": "application/json"
    }
});

Vue.use(Vuetify);
Vue.use(VueAxios, myaxios);
Vue.use(auth, {
    plugins: {
        http: myaxios, // Axios
        router: router
    },
    drivers: {
        auth: driverAuthBearer, // this is for auth JWT
        http: driverHttpAxios, // This is for axios
        router: driverRouterVueRouter, // this is the included router in auth pack
        oauth2: {}
    },
    options: {
        registerData: {},
        loginData: {},
        logoutData: {},
        fetchData: { url: 'auth/profile', method: 'GET', enabled: false },
        refreshData: { enabled: false },
        rolesKey: "type",
        notFoundRedirect: { name: "home" }
    },
    // rememberkey: "auth_remember",
    // tokenDefaultKey: "auth_token_default",
    // tokenImpersonateKey: "auth_token_impersonate",
    // stores: ["storage", "cookie"]
});

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
