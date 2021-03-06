/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

String.prototype.replaceAll = function(search, replacement) {
    var target = this
    return target.replace(new RegExp(search, 'g'), replacement)
}

Date.prototype.toString = function() {
    const months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre']
    const day = this.getDate()
    const monthIndex = this.getMonth()
    const year = this.getFullYear()
    return day + ' de ' + months[monthIndex] + ' de ' + year
}

Date.prototype.toStringWithTime = function() {
    var hours = this.getHours()
    var mins = this.getMinutes()
    return this.toString() + ' a las ' + (hours < 10 ? '0': '') + hours + ':' + (mins < 10 ? '0': '') + mins
}


window.Vue = require('vue')

import Vue from 'vue'
import 'es6-promise/auto'
import axios from 'axios'
Vue.prototype.$http = axios

import App from './components/App'

import { INIT_STORE } from './vuex/actions'
import store from './vuex/store'
import { router } from './router'

Vue.directive('tooltip', function(el, binding){
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: 'hover'             
    })
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = function() {
    new Vue({
        el: '#app',
        store,
        router,
        components: { App },
    })
}

var current = 0
const step = function(total) {
    const progress = document.getElementById('progress')
    progress.style.width = ++current / total * 100 + '%'
}

store.dispatch(INIT_STORE, { step, callback: app })
