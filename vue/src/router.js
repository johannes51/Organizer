import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home.vue'
import Projects from './views/projects/Projects.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/projects',
      name: 'projects',
      component: Projects
    }
  ]
})
