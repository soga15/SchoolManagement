require('./bootstrap');

window.Vue = require('vue').default;

import vuetify from './plugins/vuetify'
import VueRouter from 'vue-router'



  
Vue.use(VueRouter)

const routes = [
   
    
    {   path: '/', 
        component: require('./components/layout/AppMainComponent.vue').default,
        redirect: { name: 'dashboard'},
        children: [
            {
                name: 'classes',
                path: 'classes',
                component: require('./components/classes/index.vue').default
            },
            {
                name: 'course',
                path: 'course',
                component: require('./components/course/index.vue').default
            },
            {
                name: 'subject',
                path: 'subject',
                component: require('./components/subject/index.vue').default
            },
            {
                name: 'dashboard',
                path: 'dashboard',
                component: require('./components/dashboard/index.vue').default
            },
            {
                name: 'role',
                path: 'role',
                component: require('./components/role/index.vue').default
            },
            {
                name: 'room',
                path: 'room',
                component: require('./components/room/index.vue').default
            },
            {
                name: 'student',
                path: 'student',
                component: require('./components/student/index.vue').default
            },
            {
                name: 'student_view',
                path: 'student/view/:id',
                component: require('./components/student/view.vue').default
            },
            {
                name: 'user',
                path: 'user',
                component: require('./components/user/index.vue').default
            },
            
        ]

    },
    { 
        path: '/auth', 
        component: require('./components/layout/AuthMainComponent.vue').default,
        redirect: { name: 'login' },
        children: [
            {
                name: 'login',
                path:'login',
                component: require('./components/auth/login.vue').default
            }
        ]
    },
    // { path: '/course', component: require('./components/course/index.vue').default },
    // { path: '/classes', component: require('./components/classes/index.vue').default },
    // { path: '/student', component: require('./components/student/index.vue').default },
    // { path: '/role', component: require('./components/role/index.vue').default },
    // { path: '/user', component: require('./components/user/index.vue').default }
    
  ]


    
const router = new VueRouter({
    routes 
})



/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-component', require('./components/MainComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify,
    router,
}).$mount('#app')





