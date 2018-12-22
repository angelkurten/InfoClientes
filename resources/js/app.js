
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import VeeValidate from 'vee-validate';
import VeeValidateLaravel from 'vee-validate-laravel';
Vue.use(VeeValidate);
Vue.use(VeeValidateLaravel);

Vue.prototype.$setErrorsFromResponse = function(errorResponse) {

    // only allow this function to be run if the validator exists
    if(!this.hasOwnProperty('$validator')) {
        return;
    }

    // clear errors
    this.$validator.errors.clear();

    // check if errors exist
    if(!errorResponse.hasOwnProperty('data')) {
        return;
    }

    let errorFields = Object.keys(errorResponse.data);
    // insert laravel errors
    errorFields.map(field => {
        let errorString = errorResponse.data[field].join(', ');
        this.$validator.errors.add({
            field: field,
            msg: errorString
        });
    });
};

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('container-client-component', require('./components/clients/ContainerComponent.vue').default);
Vue.component('select2', require('./components/select.vue').default);
Vue.component('list-clients-component', require('./components/clients/ListComponent.vue').default);
Vue.component('new-clients-component', require('./components/clients/NewComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
