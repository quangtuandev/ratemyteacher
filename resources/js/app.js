require('./bootstrap');

import Vue from 'vue'
import store from './store'
import routes from './router'
import VueI18n from 'vue-i18n'
import messages from './locale'
import rules from './validation'
import vueHeadful from 'vue-headful';
import { topProgressBar } from './config'
import app from './components/layouts/App'
import makeRouter from './router/middleware'
import VueProgressBar from 'vue-progressbar'
import SocialSharing from 'vue-social-sharing'
import VeeValidate, { Validator } from 'vee-validate'
import { config, dictionary } from './validation/config'

Vue.use(VueI18n)
Vue.use(SocialSharing);
Vue.use(VueProgressBar, topProgressBar)
Vue.component('vue-headful', vueHeadful);
Vue.use(VeeValidate, config)
for (let rule in rules) {
    Validator.extend(rule, rules[rule])
}

Validator.localize(dictionary);
let lang = localStorage.getItem('locale') || window.Laravel.locale

const i18n = new VueI18n({
    locale: lang,
    fallbackLocale: window.Laravel.fallbackLocale,
    messages
})
const router = makeRouter(routes)

window.moment.locale(lang)
var vm = new Vue({
    router,
    store,
    i18n,
    el: '#app',
    render: h => h(app)
});