/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import './bootstrap'
import MapComponent from './components/Map.vue'
import HeaderComponent from './components/Header.vue'
import BeaconsPage from './components/BeaconsPage.vue'
import LocationPage from './components/LocationPage.vue'

window.Vue = Vue
window.Bus = new Vue({})

import ElementUi from 'element-ui'
import locale from 'element-ui/lib/locale/lang/ru-RU'
import DataTables from 'vue-data-tables'


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.use(ElementUi, { locale })
Vue.use(DataTables)

Vue.component('map-render', MapComponent)
Vue.component('app-header', HeaderComponent)
Vue.component('beacons-page', BeaconsPage)
Vue.component('location-page', LocationPage)

const app = new Vue({
  el: '#app'
})
