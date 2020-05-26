import '@babel/polyfill'
import Vue from 'vue'
import './plugins/axios'
import './plugins/bootstrap-vue'
import App from './App.vue'
import router from './router'
import store from './store'

import { initialize } from './util/util';

import moment from 'moment-timezone'

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).tz("Europe/Berlin").format('DD/MM/YYYY HH:mm');
  }
})

Vue.config.productionTip = false

initialize(store, router)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
