import Vue from 'vue'
import Router from 'vue-router'

import ProjectsView from '@/views/ProjectsView.vue'
import LoginView from '@/views/LoginView.vue'
import DiaryView from '@/views/DiaryView.vue'
import LoansView from '@/views/LoansView.vue'
import WatchlistView from '@/views/WatchlistView.vue'
import MediaView from '@/views/MediaView.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: ProjectsView,
      meta: {
          requiresAuth: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/projects',
      name: 'projects',
      component: ProjectsView,
      meta: {
          requiresAuth: true
      }
    },
    {
      path: '/diary',
      name: 'diary',
      component: DiaryView,
      meta: {
          requiresAuth: true
      }
    },
    {
      path: '/media',
      name: 'media',
      component: MediaView
    },
    {
      path: '/watchlist',
      name: 'watchlist',
      component: WatchlistView
    },
    {
      path: '/loans',
      name: 'loans',
      component: LoansView,
      meta: {
          requiresAuth: true
      }
    }
  ]
})
