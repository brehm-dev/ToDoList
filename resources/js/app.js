/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
// window.Vue =
Vue.use(VueRouter)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('instance-loader', require('./components/InstanceLoader').default);
// Vue.component('schedule', require('./components/Schedule').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.EventBus = new Vue();

// const User = () => import('./components/User')
// const Schedule = () => import('./components/Schedule')
// const UserEdit = () => import('./components/user/UserEdit')
// const UserIndex = () => import('./components/user/UserIndex')
// const UserCreate = () => import('./components/user/UserCreate')
// const UserUpdate = () => import('./components/user/UserEdit')
// const UserDelete = () => import('./components/user/UserDelete')
// const ScheduleIndex = () => import('./components/schedule/ScheduleIndex')
// const ScheduleCreate = () => import('./components/schedule/ScheduleCreate')
//
// const Procedure = () => import('./components/Procedure')
// const ProcedureIndex = () => import('./components/procedure/ProcedureIndex')
// const ProcedureCreate = () => import('./components/procedure/ProcedureCreate')


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/user',
            components: 'User',
            meta: {requiresAuth: true},
            children: [
                {
                    name: 'UserIndex',
                    path: '/',
                    components: {
                        'UserIndex': () => import('./components/user/UserIndex')
                    }
                },
                {
                    name: 'UserEdit',
                    path: ':id',
                    component: {
                        'UserEdit': () => import('./components/user/UserEdit')
                    },
                    props: true
                },
                {
                    name: 'UserCreate',
                    path: '/',
                    components: {
                        'UserCreate': () => import('./components/user/UserCreate')
                    }
                },
                {
                    name: 'UserUpdate',
                    path: ':id',
                    components: {
                        'UserUpdate': () => import('./components/user/UserEdit')
                    }
                },
                {
                    name: 'UserDelete',
                    path: ':id',
                    component: () => import('./components/user/UserDelete'),
                    props: true
                }
            ]
        },
        {
            path: '/schedule',
            component: () => import('./components/Schedule'),
            meta: {
                requiresAuth: true
            },
            children: [
                {
                    name: 'ScheduleIndex',
                    path: '',
                    component: () => import('./components/schedule/ScheduleIndex')
                },
                {
                    name: 'ScheduleCreate',
                    path: '',
                    component: () => import('./components/schedule/ScheduleCreate')
                }
            ]
        },
        {
            path: '/schedule/:sid/procedure',
            component: () => import('./components/Procedure'),
            props: true,
            children: [
                {
                    name: 'ProcedureIndex',
                    path: '',
                    component: () => import('./components/procedure/ProcedureIndex'),
                    props: true,
                },
                {
                    name: 'ProcedureCreate',
                    path: '',
                    component: () => import('./components/procedure/ProcedureCreate'),
                    props: true,
                }
            ]
        }
    ]
})

const app = new Vue({
    el: '#app',
    data: function () {
        return {}
    },
    router: router,
});
