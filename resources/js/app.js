/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//** Intalacion de sweetAlet2 */
import Vue from "vue";
import VueSweetalert2 from "vue-sweetalert2";

require("./bootstrap");
require("lightbox2");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueSweetalert2);

Vue.component("lista-skills", require("./components/ListaSkills.vue").default);
Vue.component(
    "estado-vacante",
    require("./components/EstadoVacante.vue").default
);
Vue.component(
    "eliminar-vacante",
    require("./components/EliminarVacante.vue").default
);

// Imprimir las variables de vue Js
console.log(Vue.prototype);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
