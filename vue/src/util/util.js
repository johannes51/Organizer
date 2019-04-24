export function initialize(store, router) {
  router.beforeEach((to, from, next) => {
      const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
      const isLoggedIn = store.getters.isLoggedIn;
  
      if(requiresAuth && !isLoggedIn) {
          next('/login');
      } else if(to.path == '/login' && isLoggedIn) {
          next('/');
      } else {
          next();
      }
  });
  
  axios.interceptors.response.use(null, (error) => {
      if (error.response.status == 401) {
          store.commit('logout');
          router.push('/login');
      }

      return Promise.reject(error);
  });
}

export function loadData(store) {
    store.dispatch('loadProjects');
}